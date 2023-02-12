<?php
class gb_upcoming_classes_widget extends WP_Widget 
{
	/** constructor */
	function __construct()
	{
		$widget_options = array(
			'classname' => 'gb-upcoming-classes-widget',
			'description' => __('Displays upcoming classes scrolling list', 'gymbase')
		);

        parent::__construct('gymbase_upcoming_classes', __('Upcoming Classes', 'gymbase'), $widget_options);
    }
	
	/** @see WP_Widget::widget */
    function widget($args, $instance) 
	{
		global $wpdb;
		extract($args);
		
		//these are our widget options
		$title = isset($instance['title']) ? $instance['title'] : "";
		$title_color = isset($instance['title_color']) ? $instance['title_color'] : "";
		$subtitle = isset($instance['subtitle']) ? $instance['subtitle'] : "";
		$subtitle_color = isset($instance['subtitle_color']) ? $instance['subtitle_color'] : "";
		$count = isset($instance['count']) ? $instance['count'] : "";
		$mode = isset($instance['mode']) ? $instance['mode'] : "";
		$hour_minute_separator = isset($instance['hour_minute_separator']) ? $instance['hour_minute_separator'] : ".";
		$time_mode = isset($instance['time_mode']) ? $instance['time_mode'] : "";
		$timezone = isset($instance['timezone']) ? $instance['timezone'] : "";
		$classes_page = isset($instance['classes_page']) ? $instance['classes_page'] : "";
		$categories = isset($instance['categories']) ? $instance['categories'] : "";
		$color = isset($instance['color']) ? $instance['color'] : "";
		$background_color = isset($instance['background_color']) ? $instance['background_color'] : "";
		$text_color = isset($instance['text_color']) ? $instance['text_color'] : "";
		$item_border_color = isset($instance['item_border_color']) ? $instance['item_border_color'] : "";

		echo $before_widget;
		
		if($time_mode=="server")
		{
			$phpDayNumber = date('N', current_time('timestamp', ($timezone=="utc" ? 1 : 0)));
			if($phpDayNumber==7)
				$phpDayNumber = 1;
			else
				$phpDayNumber++;
		}		
		$query = $wpdb->prepare("SELECT TIME_FORMAT(t1.start, '%s') AS start, TIME_FORMAT(t1.end, '%s') AS end, t2.post_title, t2.post_name FROM ".$wpdb->prefix."class_hours AS t1 
			LEFT JOIN {$wpdb->posts} AS t2 ON t1.class_id=t2.ID 
			LEFT JOIN {$wpdb->posts} AS t3 ON t1.weekday_id=t3.ID", "%H" . $hour_minute_separator . "%i", "%H" . $hour_minute_separator . "%i");
		if(!empty($categories))
			$query .= "
				LEFT JOIN $wpdb->term_relationships ON(t2.ID = $wpdb->term_relationships.object_id)
				LEFT JOIN $wpdb->term_taxonomy ON($wpdb->term_relationships.term_taxonomy_id = $wpdb->term_taxonomy.term_taxonomy_id)
				LEFT JOIN $wpdb->terms ON($wpdb->term_taxonomy.term_id = $wpdb->terms.term_id)
				WHERE $wpdb->terms.slug IN ('" . join("','", esc_sql((array)$categories)) . "')
				AND $wpdb->term_taxonomy.taxonomy = 'classes_category'
				AND";
		else
			$query .= "
				WHERE";
		$query .= "
			t2.post_type='classes' 
			AND t2.post_status='publish'
			AND 
			t3.post_type='gymbase_weekdays' 
			AND 
			t3.menu_order=" . ($time_mode=="server" ? $wpdb->prepare("%s", $phpDayNumber) : "DAYOFWEEK(CURDATE())") . " 
			AND 
			SUBTIME(t1.start, " . ($time_mode=="server" ? $wpdb->prepare("TIME('%s')", date('H:i:s', current_time('timestamp', ($timezone=="utc" ? 1 : 0)))) : "CURRENT_TIME()") . ")>0
			GROUP BY t1.class_hours_id
			ORDER BY t1.start, t1.end";
		if((int)$count>0)
			$query .= $wpdb->prepare(" LIMIT %d" , $count);
		$class_hours = $wpdb->get_results($query);
		$class_hours_count = count($class_hours);
		$output = '';
		$output .= '<li class="home-box-container upcoming-classes-container' . ($class_hours_count>3 ? ' controls-active' : '') . ($color!="" ? ' ' . esc_attr($color) : '') . '"' . ($background_color!='' ? ' style="background-color: #' . esc_attr($background_color) . ';"' : '') . '>
			<div class="home-box">';
				if($title) 
				{
					if($title_color!="")
						$before_title = str_replace(">", " style='color: #" . esc_attr($title_color) . ";'>",$before_title);
					$output .= $before_title . $title . $after_title;
				}
				if($subtitle!="")
				{
					$output .= '<h4' . ($subtitle_color!="" ? ' style="color: #' . esc_attr($subtitle_color) . ';"' : '') . '>' . $subtitle . '</h4>';
				}
			$output .= '<div class="clearfix scrolling-controls' . ($subtitle=="" ? ' small-space' : '') . '">
				<div class="header-right">
					<a href="#" class="scrolling-list-control-left template-arrow-horizontal-3"></a>
					<a href="#" class="scrolling-list-control-right template-arrow-horizontal-3"></a>
				</div>
			</div>
			<div class="scrolling-list-wrapper"><div class="scrolling-list-fix-block"' . ($background_color!='' ? ' style="background-color: #' . esc_attr($background_color) . ';"' : '') . '></div>';
		if($class_hours_count):
				$output .= '[items_list class="upcoming-classes clearfix"]';
				for($i=0; $i<$class_hours_count; $i++)
				{
					if($mode=="12h")
					{
						$class_hours[$i]->start = date("h" . $hour_minute_separator . "i a", strtotime($class_hours[$i]->start));
						$class_hours[$i]->end = date("h" . $hour_minute_separator . "i a", strtotime($class_hours[$i]->end));
					}
					$output .= '[item' . ($text_color!='' ? ' value_color="#' . esc_attr($text_color) . '"' : '') . ($item_border_color!='' ? ' border_color="#' . esc_attr($item_border_color) . '"' : '') . ' value="' .  esc_attr($class_hours[$i]->start) . ' - ' .  esc_attr($class_hours[$i]->end) . '"]<a href="' . esc_url(get_permalink($classes_page)) . '#' . urldecode($class_hours[$i]->post_name) . '" title="' . esc_attr($class_hours[$i]->post_title) . '">' . $class_hours[$i]->post_title . '</a>[/item]';
				}
		$output .= '[/items_list]';
		else:
			$output .= '<p class="message">' . __('No upcoming classes for today', 'gymbase') . '</p>';
		endif;
		$output .= '</div>
			</div>
		</li>';

		echo do_shortcode($output);
        echo $after_widget;
    }
	
	/** @see WP_Widget::update */
    function update($new_instance, $old_instance) 
	{
		$instance = $old_instance;
		$instance['title'] = isset($new_instance['title']) ? strip_tags($new_instance['title']) : '';
		$instance['title_color'] = isset($new_instance['title_color']) ? strip_tags($new_instance['title_color']) : '';
		$instance['subtitle'] = isset($new_instance['subtitle']) ? strip_tags($new_instance['subtitle']) : '';
		$instance['subtitle_color'] = isset($new_instance['subtitle_color']) ? strip_tags($new_instance['subtitle_color']) : '';
		$instance['count'] = isset($new_instance['count']) ? strip_tags($new_instance['count']) : '';
		$instance['mode'] = isset($new_instance['mode']) ? strip_tags($new_instance['mode']) : '';
		$instance['hour_minute_separator'] = isset($new_instance['hour_minute_separator']) ? strip_tags($new_instance['hour_minute_separator']) : '';
		$instance['time_mode'] = isset($new_instance['time_mode']) ? strip_tags($new_instance['time_mode']) : '';
		$instance['timezone'] = isset($new_instance['timezone']) ? strip_tags($new_instance['timezone']) : '';
		$instance['classes_page'] = isset($new_instance['classes_page']) ? strip_tags($new_instance['classes_page']) : '';
		$instance['categories'] = isset($new_instance['categories']) ? $new_instance['categories'] : '';
		$instance['color'] = isset($new_instance['color']) ? strip_tags($new_instance['color']) : '';
		$instance['background_color'] = isset($new_instance['background_color']) ? strip_tags($new_instance['background_color']) : '';
		$instance['text_color'] = isset($new_instance['text_color']) ? strip_tags($new_instance['text_color']) : '';
		$instance['item_border_color'] = isset($new_instance['item_border_color']) ? strip_tags($new_instance['item_border_color']) : '';
		return $instance;
    }
	
	 /** @see WP_Widget::form */
	function form($instance) 
	{
		$title = isset($instance['title']) ? esc_attr($instance['title']) : '';
		$title_color = isset($instance['title_color']) ? esc_attr($instance['title_color']) : '';
		$subtitle = isset($instance['subtitle']) ? esc_attr($instance['subtitle']) : '';
		$subtitle_color = isset($instance['subtitle_color']) ? esc_attr($instance['subtitle_color']) : '';
		$count = isset($instance['count']) ? esc_attr($instance['count']) : '';
		$mode = isset($instance['mode']) ? esc_attr($instance['mode']) : '';
		$time_mode = isset($instance['time_mode']) ? esc_attr($instance['time_mode']) : '';
		$hour_minute_separator = isset($instance['hour_minute_separator']) ? esc_attr($instance['hour_minute_separator']) : '';
		$timezone = isset($instance['timezone']) ? esc_attr($instance['timezone']) : '';
		$classes_page = isset($instance['classes_page']) ? esc_attr($instance['classes_page']) : '';
		$categories = isset($instance['categories']) ? $instance['categories'] : '';
		$color = isset($instance['color']) ? esc_attr($instance['color']) : '';
		$background_color = isset($instance['background_color']) ? esc_attr($instance['background_color']) : '';
		$text_color = isset($instance['text_color']) ? esc_attr($instance['text_color']) : '';
		$item_border_color = isset($instance['item_border_color']) ? esc_attr($instance['item_border_color']) : '';
		?>
		<p>
			<label for="<?php echo esc_attr($this->get_field_id('title')); ?>"><?php _e('Title', 'gymbase'); ?></label>
			<input class="widefat" id="<?php echo esc_attr($this->get_field_id('title')); ?>" name="<?php echo esc_attr($this->get_field_name('title')); ?>" type="text" value="<?php echo esc_attr($title); ?>" />
		</p>
		<p>
			<label for="<?php echo esc_attr($this->get_field_id('title_color')); ?>"><?php _e('Title color', 'gymbase'); ?></label>
			<input class="widefat color" id="<?php echo esc_attr($this->get_field_id('title_color')); ?>" name="<?php echo esc_attr($this->get_field_name('title_color')); ?>" type="text" value="<?php echo esc_attr($title_color); ?>" data-default-color="FFFFFF" />
		</p>
		<p>
			<label for="<?php echo esc_attr($this->get_field_id('subtitle')); ?>"><?php _e('Subtitle', 'gymbase'); ?></label>
			<input class="widefat" id="<?php echo esc_attr($this->get_field_id('subtitle')); ?>" name="<?php echo esc_attr($this->get_field_name('subtitle')); ?>" type="text" value="<?php echo esc_attr($subtitle); ?>" />
		</p>
		<p>
			<label for="<?php echo esc_attr($this->get_field_id('subtitle_color')); ?>"><?php _e('Subtitle color', 'gymbase'); ?></label>
			<input class="widefat color" id="<?php echo esc_attr($this->get_field_id('subtitle_color')); ?>" name="<?php echo esc_attr($this->get_field_name('subtitle_color')); ?>" type="text" value="<?php echo esc_attr($subtitle_color); ?>" data-default-color="FFFFFF" />
		</p>
		<p>
			<label for="<?php echo esc_attr($this->get_field_id('count')); ?>"><?php _e('Count', 'gymbase'); ?></label>
			<input class="widefat" id="<?php echo esc_attr($this->get_field_id('count')); ?>" name="<?php echo esc_attr($this->get_field_name('count')); ?>" type="text" value="<?php echo esc_attr($count); ?>" />
		</p>
		<p>
			<label for="<?php echo esc_attr($this->get_field_id('mode')); ?>"><?php _e('Mode', 'gymbase'); ?></label>
			<select name="<?php echo esc_attr($this->get_field_name('mode')); ?>">
				<option value="24h"<?php echo ($mode=="24h" ? " selected='selected'" : ""); ?>><?php _e('24h', 'gymbase'); ?></option>
				<option value="12h"<?php echo ($mode=="12h" ? " selected='selected'" : ""); ?>><?php _e('12h', 'gymbase'); ?></option>
			</select>
		</p>
		<p>
			<label for="<?php echo esc_attr($this->get_field_id('hour_minute_separator')); ?>"><?php _e('Hour minute separator', 'gymbase'); ?></label>
			<select name="<?php echo esc_attr($this->get_field_name('hour_minute_separator')); ?>">
				<option value="."<?php echo ($hour_minute_separator=="." ? " selected='selected'" : ""); ?>><?php _e('.', 'gymbase'); ?></option>
				<option value=":"<?php echo ($hour_minute_separator==":" ? " selected='selected'" : ""); ?>><?php _e(':', 'gymbase'); ?></option>
			</select>
		</p>
		<p>
			<label for="<?php echo esc_attr($this->get_field_id('time_mode')); ?>"><?php _e('Time from', 'gymbase'); ?></label>
			<select id="upcoming_classes_time_from" name="<?php echo esc_attr($this->get_field_name('time_mode')); ?>">
				<option value="server"<?php echo ($time_mode=="server" ? " selected='selected'" : ""); ?>><?php _e('server', 'gymbase'); ?></option>
				<option value="database"<?php echo ($time_mode=="database" ? " selected='selected'" : ""); ?>><?php _e('database', 'gymbase'); ?></option>
			</select>
		</p>
		<p class="upcoming_classes_timezone_row" <?php echo ($time_mode=="database" ? " style='display: none;'" : ""); ?>>
			<label for="<?php echo esc_attr($this->get_field_id('timezone')); ?>"><?php _e('Timezone', 'gymbase'); ?></label>
			<select name="<?php echo esc_attr($this->get_field_name('timezone')); ?>">
				<option value="localtime"<?php echo ($timezone=="localtime" ? " selected='selected'" : ""); ?>><?php _e('localtime', 'gymbase'); echo " (now: " .  date('H:i:s', current_time('timestamp')) . ")"; ?></option>
				<option value="utc"<?php echo ($timezone=="utc" ? " selected='selected'" : ""); ?>><?php _e('utc', 'gymbase'); echo " (now: " .  date('H:i:s', current_time('timestamp', 1)) . ")"; ?></option>
			</select>
		</p>
		<p>
			<label for="<?php echo esc_attr($this->get_field_id('classes_page')); ?>"><?php _e('Classes Page', 'gymbase'); ?></label>
			<select id="<?php echo esc_attr($this->get_field_id('classes_page')); ?>" name="<?php echo esc_attr($this->get_field_name('classes_page')); ?>">
				<?php
				$args = array(
					'post_type' => 'page',
					'post_status' => 'publish',
					'posts_per_page' => -1,
					'orderby' => 'title', 
					'order' => 'ASC',
					'suppress_filters' => true
				);
				query_posts($args);
				if(have_posts()) : while (have_posts()) : the_post();
					global $post;
				?>
					<option <?php echo ($classes_page==get_the_ID() ? ' selected="selected"':'');?> value='<?php the_ID(); ?>'><?php the_title(); ?></option>
				<?php
				endwhile;
				endif;
				wp_reset_query();
				?>
			</select>
		</p>
		<p>
			<label for="<?php echo esc_attr($this->get_field_id('categories')); ?>"><?php _e('Categories', 'gymbase'); ?></label>
			<select multiple="multiple" id="<?php echo esc_attr($this->get_field_id('categories')); ?>" name="<?php echo esc_attr($this->get_field_name('categories')); ?>[]">
			<?php
			$classes_categories = get_terms("classes_category");
			foreach($classes_categories as $classes_category)
			{
			?>
				<option <?php echo (is_array($categories) && in_array($classes_category->slug, $categories) ? ' selected="selected"':'');?> value='<?php echo esc_attr($classes_category->slug);?>'><?php echo $classes_category->name; ?></option>
			<?php
			}
			?>
			</select>
		</p>
		<p>
			<label for="<?php echo esc_attr($this->get_field_id('color')); ?>"><?php _e('Color', 'gymbase'); ?></label>
			<select id="<?php echo esc_attr($this->get_field_id('color')); ?>" name="<?php echo esc_attr($this->get_field_name('color')); ?>">
				<option value=""<?php echo (empty($color) ? ' selected="selected"' : ''); ?>><?php _e('default', 'gymbase'); ?></option>
				<option <?php echo ($color=='white' ? ' selected="selected"':'');?> value='white'><?php _e("white", 'gymbase'); ?></option>
				<option <?php echo ($color=='light-green' ? ' selected="selected"':'');?> value='light-green'><?php _e("light-green", 'gymbase'); ?></option>
				<option <?php echo ($color=='green' ? ' selected="selected"':'');?> value='green'><?php _e("green", 'gymbase'); ?></option>
				<option <?php echo ($color=='dark' ? ' selected="selected"':'');?> value='dark'><?php _e("dark", 'gymbase'); ?></option>
			</select>
			<?php _e('or pick custom one: ', 'gymbase'); ?>
			<input type="text" class="regular-text color" value="<?php echo esc_attr($background_color); ?>" id="<?php echo esc_attr($this->get_field_id('background_color')); ?>" name="<?php echo esc_attr($this->get_field_name('background_color')); ?>" data-default-color="FFFFFF">
		</p>
		<p>
			<label for="<?php echo esc_attr($this->get_field_id('text_color')); ?>"><?php _e('Text color', 'gymbase'); ?></label>
			<input class="widefat color" id="<?php echo esc_attr($this->get_field_id('text_color')); ?>" name="<?php echo esc_attr($this->get_field_name('text_color')); ?>" type="text" value="<?php echo esc_attr($text_color); ?>" data-default-color="FFFFFF" />
		</p>
		<p>
			<label for="<?php echo esc_attr($this->get_field_id('item_border_color')); ?>"><?php _e('Item border color', 'gymbase'); ?></label>
			<input class="widefat color" id="<?php echo esc_attr($this->get_field_id('item_border_color')); ?>" name="<?php echo esc_attr($this->get_field_name('item_border_color')); ?>" type="text" value="<?php echo esc_attr($item_border_color); ?>" data-default-color="FFFFFF" />
		</p>
		<?php
	}
}
?>