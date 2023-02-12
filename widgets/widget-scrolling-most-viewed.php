<?php
class gb_scrolling_most_viewed_widget extends WP_Widget 
{
	/** constructor */
	function __construct() 
	{
		$widget_options = array(
			'classname' => 'scrolling-most-viewed-widget',
			'description' => __('Displays scrolling most viewed posts list', 'gymbase')
		);
        parent::__construct('gymbase_scrolling_most_viewed', __('Scrolling Most Viewed Posts', 'gymbase'), $widget_options);
    }
	
	/** @see WP_Widget::widget */
    function widget($args, $instance) 
	{
        extract($args);

		//these are our widget options
		$title = isset($instance['title']) ? $instance['title'] : '';
		$animation = isset($instance['animation']) ? $instance['animation'] : "";
		$count = isset($instance['count']) ? $instance['count'] : '';

		//get recent posts
		query_posts(array( 
			'post_type' => 'post',
			'post_status' => 'publish',
			'posts_per_page' => $count,
			'meta_key' => 'post_views_count',
			'orderby' => 'meta_value_num', 
			'order' => 'DESC'
		));
		
		echo $before_widget;
		?>
		<div class="clearfix scrolling-controls">
			<div class="header-left">
				<?php
				if($title) 
				{
					echo ((int)$animation ? str_replace("box-header", "box-header animation-slide", $before_title) : str_replace("animation-slide", "", $before_title)) . apply_filters("widget_title", $title) . $after_title;
				}
				?>
			</div>
			<div class="header-right">
				<a href="#" class="scrolling-list-control-left template-arrow-horizontal-3"></a>
				<a href="#" class="scrolling-list-control-right template-arrow-horizontal-3"></a>
			</div>
		</div>
		<div class="scrolling-list-wrapper">
			<ul class="scrolling-list alternate most-viewed">
				<?php
				if(have_posts()) : while (have_posts()) : the_post();
				?>
				<li>
					<a href="<?php echo esc_url(get_the_permalink()); ?>" title="<?php echo esc_attr(get_the_title()); ?>">
						<div class="left">
							<span class="text"><?php the_title(); ?></span>
							<abbr title="<?php echo esc_attr(date_i18n(get_option('date_format'), get_post_time())); ?>" class="timeago"><?php echo date_i18n(get_option('date_format'), get_post_time()); ?></abbr>
						</div>
						<span class="number">
							<?php echo getPostViews(get_the_ID()); ?>
						</span>
					</a>
				</li>
				<?php
				endwhile; endif;
				wp_reset_query();
				?>
			</ul>
		</div>
		<?php
        echo $after_widget;
    }
	
	/** @see WP_Widget::update */
    function update($new_instance, $old_instance) 
	{
		$instance = $old_instance;
		$instance['title'] = isset($new_instance['title']) ? strip_tags($new_instance['title']) : '';
		$instance['animation'] = isset($new_instance['animation']) ? strip_tags($new_instance['animation']) : "";
		$instance['count'] = isset($new_instance['count']) ? strip_tags($new_instance['count']) : '';
		return $instance;
    }
	
	 /** @see WP_Widget::form */
	function form($instance) 
	{
		$title = isset($instance['title']) ? esc_attr($instance['title']) : '';
		$animation = isset($instance['animation']) ? esc_attr($instance['animation']) : "";
		$count = isset($instance['count']) ? esc_attr($instance['count']) : '';
		?>
		<p>
			<label for="<?php echo esc_attr($this->get_field_id('title')); ?>"><?php _e('Title', 'gymbase'); ?></label>
			<input class="widefat" id="<?php echo esc_attr($this->get_field_id('title')); ?>" name="<?php echo esc_attr($this->get_field_name('title')); ?>" type="text" value="<?php echo esc_attr($title); ?>" />
		</p>
		<p>
			<label for="<?php echo esc_attr($this->get_field_id('animation')); ?>"><?php _e('Title border animation', 'gymbase'); ?></label>
			<select id="<?php echo esc_attr($this->get_field_id('animation')); ?>" name="<?php echo esc_attr($this->get_field_name('animation')); ?>">
				<option value="0"><?php _e('no', 'gymbase'); ?></option>
				<option value="1"<?php echo ((int)$animation==1 ? ' selected="selected"' : ''); ?>><?php _e('yes', 'gymbase'); ?></option>
			</select>
		</p>
		<p>
			<label for="<?php echo esc_attr($this->get_field_id('count')); ?>"><?php _e('Count', 'gymbase'); ?></label>
			<input class="widefat" id="<?php echo esc_attr($this->get_field_id('count')); ?>" name="<?php echo esc_attr($this->get_field_name('count')); ?>" type="text" value="<?php echo esc_attr($count); ?>" />
		</p>
		<?php
	}
}
?>