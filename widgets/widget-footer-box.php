<?php
class gb_footer_box_widget extends WP_Widget 
{
	/** constructor */
	function __construct()
	{
		$widget_options = array(
			'classname' => 'gb-footer-box-widget',
			'description' => __('Displays Box with some content', 'gymbase')
		);
		$control_options = array('width' => 332);
        parent::__construct('gymbase_footer_box', __('Footer Box', 'gymbase'), $widget_options, $control_options);
    }
	
	/** @see WP_Widget::widget */
    function widget($args, $instance) 
	{
        extract($args);

		//these are our widget options
		$title = isset($instance['title']) ? $instance['title'] : "";
		$title_color = isset($instance['title_color']) ? $instance['title_color'] : "";
		$url = isset($instance['url']) ? $instance['url'] : "";
		$subtitle = isset($instance['subtitle']) ? $instance['subtitle'] : "";
		$subtitle_color = isset($instance['subtitle_color']) ? $instance['subtitle_color'] : "";
		$color = isset($instance['color']) ? $instance['color'] : "";
		$custom_color = isset($instance['custom_color']) ? $instance['custom_color'] : "";
		$icon = isset($instance['icon']) ? $instance['icon'] : "";
		$icon_color = isset($instance['icon_color']) ? $instance['icon_color'] : "";

		echo $before_widget;
		?>
		<li class="footer-banner-box <?php echo esc_attr($color); ?>"<?php echo ($custom_color!="" ? ' style="background-color: #' . esc_attr($custom_color) . '"' : ''); ?>>
			<div class="footer-box">
				<?php if($icon!=""):?>
				<div class="icon features-<?php echo esc_attr($icon);?>"<?php echo ($icon_color!="" ? " style='color: #" . esc_attr($icon_color) . ";'" : "");?>></div>
				<?php endif; ?>
				<?php
				if($title) 
				{
					if($title_color!="")
						$before_title = str_replace(">", " style='color: #" . esc_attr($title_color) . ";'>",$before_title);
					echo $before_title . ($url!="" ? '<a href="' . esc_attr($url) . '"' . ($title_color!="" ? ' style="color: #' . esc_attr($title_color) . ';"' : '') . ' title="' . esc_attr($title) . '">' : '') . $title . ($url!="" ? '</a>' : '') . $after_title;
				}
				?>
				<?php if($subtitle!=""): ?>
				<h4<?php echo ($subtitle_color!="" ? " style='color: #" . esc_attr($subtitle_color) . ";'" : ""); ?>><?php echo $subtitle; ?></h4>
				<?php endif; ?>
			</div>
		</li>
		<?php
        echo $after_widget;
    }
	
	/** @see WP_Widget::update */
    function update($new_instance, $old_instance) 
	{
		$instance = $old_instance;
		$instance['title'] = isset($new_instance['title']) ? strip_tags($new_instance['title']) : '';
		$instance['title_color'] = isset($new_instance['title_color']) ? strip_tags($new_instance['title_color']) : '';
		$instance['url'] = isset($new_instance['url']) ? strip_tags($new_instance['url']) : '';
		$instance['subtitle'] = isset($new_instance['subtitle']) ? strip_tags($new_instance['subtitle']) : '';
		$instance['subtitle_color'] = isset($new_instance['subtitle_color']) ? strip_tags($new_instance['subtitle_color']) : '';
		$instance['color'] = isset($new_instance['color']) ? strip_tags($new_instance['color']) : '';
		$instance['custom_color'] = isset($new_instance['custom_color']) ? strip_tags($new_instance['custom_color']) : '';
		$instance['icon'] = isset($new_instance['icon']) ? strip_tags($new_instance['icon']) : '';
		$instance['icon_color'] = isset($new_instance['icon_color']) ? strip_tags($new_instance['icon_color']) : '';
		return $instance;
    }
	
	 /** @see WP_Widget::form */
	function form($instance) 
	{
		$title = isset($instance['title']) ? esc_attr($instance['title']) : '';
		$title_color = isset($instance['title_color']) ? esc_attr($instance['title_color']) : '';
		$url = isset($instance['url']) ? esc_attr($instance['url']) : '';
		$subtitle = isset($instance['subtitle']) ? esc_attr($instance['subtitle']) : '';
		$subtitle_color = isset($instance['subtitle_color']) ? esc_attr($instance['subtitle_color']) : '';
		$color = isset($instance['color']) ? esc_attr($instance['color']) : '';
		$custom_color = isset($instance['custom_color']) ? esc_attr($instance['custom_color']) : '';
		$icon = isset($instance['icon']) ? esc_attr($instance['icon']) : '';
		$icon_color = isset($instance['icon_color']) ? esc_attr($instance['icon_color']) : '';
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
			<label for="<?php echo esc_attr($this->get_field_id('url')); ?>"><?php _e('Url', 'gymbase'); ?></label>
			<input class="widefat" id="<?php echo esc_attr($this->get_field_id('url')); ?>" name="<?php echo esc_attr($this->get_field_name('url')); ?>" type="text" value="<?php echo esc_attr($url); ?>" />
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
			<label for="<?php echo esc_attr($this->get_field_id('color')); ?>"><?php _e('Color', 'gymbase'); ?></label>
			<select id="<?php echo esc_attr($this->get_field_id('color')); ?>" name="<?php echo esc_attr($this->get_field_name('color')); ?>">
				<option value=""<?php echo (empty($color) ? ' selected="selected"' : ''); ?>><?php _e('default', 'gymbase'); ?></option>
				<option <?php echo ($color=='white' ? ' selected="selected"':'');?> value='white'><?php _e("white", 'gymbase'); ?></option>
				<option <?php echo ($color=='light-green' ? ' selected="selected"':'');?> value='light-green'><?php _e("light-green", 'gymbase'); ?></option>
				<option <?php echo ($color=='green' ? ' selected="selected"':'');?> value='green'><?php _e("green", 'gymbase'); ?></option>
				<option <?php echo ($color=='dark' ? ' selected="selected"':'');?> value='dark'><?php _e("dark", 'gymbase'); ?></option>
			</select>
			<?php _e('or pick custom one: ', 'gymbase'); ?>
			<input type="text" class="regular-text color" value="<?php echo esc_attr($custom_color); ?>" id="<?php echo esc_attr($this->get_field_id('custom_color')); ?>" name="<?php echo esc_attr($this->get_field_name('custom_color')); ?>" data-default-color="FFFFFF">
		</p>
		<p>
			<label for="<?php echo esc_attr($this->get_field_id('icon')); ?>"><?php _e('Icon', 'gymbase'); ?></label>
			<select id="<?php echo esc_attr($this->get_field_id('icon')); ?>" name="<?php echo esc_attr($this->get_field_name('icon')); ?>">
				<option <?php echo ($icon=='' ? ' selected="selected"':'');?> value=''>-</option>
				<option <?php echo ($icon=='address' ? ' selected="selected"':'');?> value='address'><?php _e("address", 'gymbase'); ?></option>
				<option <?php echo ($icon=='app' ? ' selected="selected"':'');?> value='app'><?php _e("app", 'gymbase'); ?></option>
				<option <?php echo ($icon=='apple' ? ' selected="selected"':'');?> value='apple'><?php _e("apple", 'gymbase'); ?></option>
				<option <?php echo ($icon=='arrows' ? ' selected="selected"':'');?> value='arrows'><?php _e("arrows", 'gymbase'); ?></option>
				<option <?php echo ($icon=='bar-graph' ? ' selected="selected"':'');?> value='bar-graph'><?php _e("bar-graph", 'gymbase'); ?></option>
				<option <?php echo ($icon=='battery' ? ' selected="selected"':'');?> value='battery'><?php _e("battery", 'gymbase'); ?></option>
				<option <?php echo ($icon=='bicycle' ? ' selected="selected"':'');?> value='bicycle'><?php _e("bicycle", 'gymbase'); ?></option>
				<option <?php echo ($icon=='book' ? ' selected="selected"':'');?> value='book'><?php _e("book", 'gymbase'); ?></option>
				<option <?php echo ($icon=='box' ? ' selected="selected"':'');?> value='box'><?php _e("box", 'gymbase'); ?></option>
				<option <?php echo ($icon=='boxing' ? ' selected="selected"':'');?> value='boxing'><?php _e("boxing", 'gymbase'); ?></option>
				<option <?php echo ($icon=='brain' ? ' selected="selected"':'');?> value='brain'><?php _e("brain", 'gymbase'); ?></option>
				<option <?php echo ($icon=='briefcase' ? ' selected="selected"':'');?> value='briefcase'><?php _e("briefcase", 'gymbase'); ?></option>
				<option <?php echo ($icon=='burns' ? ' selected="selected"':'');?> value='burns'><?php _e("burns", 'gymbase'); ?></option>
				<option <?php echo ($icon=='calendar-info' ? ' selected="selected"':'');?> value='calendar-info'><?php _e("calendar-info", 'gymbase'); ?></option>
				<option <?php echo ($icon=='calendar-plus' ? ' selected="selected"':'');?> value='calendar-plus'><?php _e("calendar-plus", 'gymbase'); ?></option>
				<option <?php echo ($icon=='calendar-tick' ? ' selected="selected"':'');?> value='calendar-tick'><?php _e("calendar-tick", 'gymbase'); ?></option>
				<option <?php echo ($icon=='cart' ? ' selected="selected"':'');?> value='cart'><?php _e("cart", 'gymbase'); ?></option>
				<option <?php echo ($icon=='certificate' ? ' selected="selected"':'');?> value='certificate'><?php _e("certificate", 'gymbase'); ?></option>
				<option <?php echo ($icon=='chart-1' ? ' selected="selected"':'');?> value='chart-1'><?php _e("chart-1", 'gymbase'); ?></option>
				<option <?php echo ($icon=='chart-2' ? ' selected="selected"':'');?> value='chart-2'><?php _e("chart-2", 'gymbase'); ?></option>
				<option <?php echo ($icon=='chat' ? ' selected="selected"':'');?> value='chat'><?php _e("chat", 'gymbase'); ?></option>
				<option <?php echo ($icon=='clock' ? ' selected="selected"':'');?> value='clock'><?php _e("clock", 'gymbase'); ?></option>
				<option <?php echo ($icon=='config' ? ' selected="selected"':'');?> value='config'><?php _e("config", 'gymbase'); ?></option>
				<option <?php echo ($icon=='coupon' ? ' selected="selected"':'');?> value='coupon'><?php _e("coupon", 'gymbase'); ?></option>
				<option <?php echo ($icon=='credit-card' ? ' selected="selected"':'');?> value='credit-card'><?php _e("credit-card", 'gymbase'); ?></option>
				<option <?php echo ($icon=='cross' ? ' selected="selected"':'');?> value='cross'><?php _e("cross", 'gymbase'); ?></option>
				<option <?php echo ($icon=='cycling' ? ' selected="selected"':'');?> value='cycling'><?php _e("cycling", 'gymbase'); ?></option>
				<option <?php echo ($icon=='diary' ? ' selected="selected"':'');?> value='diary'><?php _e("diary", 'gymbase'); ?></option>
				<option <?php echo ($icon=='dna' ? ' selected="selected"':'');?> value='dna'><?php _e("dna", 'gymbase'); ?></option>
				<option <?php echo ($icon=='document' ? ' selected="selected"':'');?> value='document'><?php _e("document", 'gymbase'); ?></option>
				<option <?php echo ($icon=='document-missing' ? ' selected="selected"':'');?> value='document-missing'><?php _e("document-missing", 'gymbase'); ?></option>
				<option <?php echo ($icon=='drink' ? ' selected="selected"':'');?> value='drink'><?php _e("drink", 'gymbase'); ?></option>
				<option <?php echo ($icon=='dumbbell-1' ? ' selected="selected"':'');?> value='dumbbell-1'><?php _e("dumbbell-1", 'gymbase'); ?></option>
				<option <?php echo ($icon=='dumbbell-2' ? ' selected="selected"':'');?> value='dumbbell-2'><?php _e("dumbbell-2", 'gymbase'); ?></option>
				<option <?php echo ($icon=='email' ? ' selected="selected"':'');?> value='email'><?php _e("email", 'gymbase'); ?></option>
				<option <?php echo ($icon=='facebook' ? ' selected="selected"':'');?> value='facebook'><?php _e("facebook", 'gymbase'); ?></option>
				<option <?php echo ($icon=='first-aid' ? ' selected="selected"':'');?> value='first-aid'><?php _e("first-aid", 'gymbase'); ?></option>
				<option <?php echo ($icon=='gallery' ? ' selected="selected"':'');?> value='gallery'><?php _e("gallery", 'gymbase'); ?></option>
				<option <?php echo ($icon=='glasses' ? ' selected="selected"':'');?> value='glasses'><?php _e("glasses", 'gymbase'); ?></option>
				<option <?php echo ($icon=='graph' ? ' selected="selected"':'');?> value='graph'><?php _e("graph", 'gymbase'); ?></option>
				<option <?php echo ($icon=='group-1' ? ' selected="selected"':'');?> value='group-1'><?php _e("group-1", 'gymbase'); ?></option>
				<option <?php echo ($icon=='group-2' ? ' selected="selected"':'');?> value='group-2'><?php _e("group-2", 'gymbase'); ?></option>
				<option <?php echo ($icon=='gym-1' ? ' selected="selected"':'');?> value='gym-1'><?php _e("gym-1", 'gymbase'); ?></option>
				<option <?php echo ($icon=='gym-2' ? ' selected="selected"':'');?> value='gym-2'><?php _e("gym-2", 'gymbase'); ?></option>
				<option <?php echo ($icon=='hand-grip' ? ' selected="selected"':'');?> value='hand-grip'><?php _e("hand-grip", 'gymbase'); ?></option>
				<option <?php echo ($icon=='hand-squeezer' ? ' selected="selected"':'');?> value='hand-squeezer'><?php _e("hand-squeezer", 'gymbase'); ?></option>
				<option <?php echo ($icon=='heart' ? ' selected="selected"':'');?> value='heart'><?php _e("heart", 'gymbase'); ?></option>
				<option <?php echo ($icon=='heart-beat' ? ' selected="selected"':'');?> value='heart-beat'><?php _e("heart-beat", 'gymbase'); ?></option>
				<option <?php echo ($icon=='home' ? ' selected="selected"':'');?> value='home'><?php _e("home", 'gymbase'); ?></option>
				<option <?php echo ($icon=='id-1' ? ' selected="selected"':'');?> value='id-1'><?php _e("id-1", 'gymbase'); ?></option>
				<option <?php echo ($icon=='id-2' ? ' selected="selected"':'');?> value='id-2'><?php _e("id-2", 'gymbase'); ?></option>
				<option <?php echo ($icon=='id-3' ? ' selected="selected"':'');?> value='id-3'><?php _e("id-3", 'gymbase'); ?></option>
				<option <?php echo ($icon=='image' ? ' selected="selected"':'');?> value='image'><?php _e("image", 'gymbase'); ?></option>
				<option <?php echo ($icon=='keyboard' ? ' selected="selected"':'');?> value='keyboard'><?php _e("keyboard", 'gymbase'); ?></option>
				<option <?php echo ($icon=='lab' ? ' selected="selected"':'');?> value='lab'><?php _e("lab", 'gymbase'); ?></option>
				<option <?php echo ($icon=='laptop' ? ' selected="selected"':'');?> value='laptop'><?php _e("laptop", 'gymbase'); ?></option>
				<option <?php echo ($icon=='leaf' ? ' selected="selected"':'');?> value='leaf'><?php _e("leaf", 'gymbase'); ?></option>
				<option <?php echo ($icon=='lifeline' ? ' selected="selected"':'');?> value='lifeline'><?php _e("lifeline", 'gymbase'); ?></option>
				<option <?php echo ($icon=='list' ? ' selected="selected"':'');?> value='list'><?php _e("list", 'gymbase'); ?></option>
				<option <?php echo ($icon=='location' ? ' selected="selected"':'');?> value='location'><?php _e("location", 'gymbase'); ?></option>
				<option <?php echo ($icon=='lock' ? ' selected="selected"':'');?> value='lock'><?php _e("lock", 'gymbase'); ?></option>
				<option <?php echo ($icon=='lockers' ? ' selected="selected"':'');?> value='lockers'><?php _e("lockers", 'gymbase'); ?></option>
				<option <?php echo ($icon=='map' ? ' selected="selected"':'');?> value='map'><?php _e("map", 'gymbase'); ?></option>
				<option <?php echo ($icon=='martial-art' ? ' selected="selected"':'');?> value='martial-art'><?php _e("martial-art", 'gymbase'); ?></option>
				<option <?php echo ($icon=='medical-bed' ? ' selected="selected"':'');?> value='medical-bed'><?php _e("medical-bed", 'gymbase'); ?></option>
				<option <?php echo ($icon=='medical-document' ? ' selected="selected"':'');?> value='medical-document'><?php _e("medical-document", 'gymbase'); ?></option>
				<option <?php echo ($icon=='medical-results' ? ' selected="selected"':'');?> value='medical-results'><?php _e("medical-results", 'gymbase'); ?></option>
				<option <?php echo ($icon=='minus' ? ' selected="selected"':'');?> value='minus'><?php _e("minus", 'gymbase'); ?></option>
				<option <?php echo ($icon=='mobile' ? ' selected="selected"':'');?> value='mobile'><?php _e("mobile", 'gymbase'); ?></option>
				<option <?php echo ($icon=='money' ? ' selected="selected"':'');?> value='money'><?php _e("money", 'gymbase'); ?></option>
				<option <?php echo ($icon=='movie' ? ' selected="selected"':'');?> value='movie'><?php _e("movie", 'gymbase'); ?></option>
				<option <?php echo ($icon=='muscle' ? ' selected="selected"':'');?> value='muscle'><?php _e("muscle", 'gymbase'); ?></option>
				<option <?php echo ($icon=='network' ? ' selected="selected"':'');?> value='network'><?php _e("network", 'gymbase'); ?></option>
				<option <?php echo ($icon=='paypal' ? ' selected="selected"':'');?> value='paypal'><?php _e("paypal", 'gymbase'); ?></option>
				<option <?php echo ($icon=='pen' ? ' selected="selected"':'');?> value='pen'><?php _e("pen", 'gymbase'); ?></option>
				<option <?php echo ($icon=='people' ? ' selected="selected"':'');?> value='people'><?php _e("people", 'gymbase'); ?></option>
				<option <?php echo ($icon=='percent' ? ' selected="selected"':'');?> value='percent'><?php _e("percent", 'gymbase'); ?></option>
				<option <?php echo ($icon=='phone' ? ' selected="selected"':'');?> value='phone'><?php _e("phone", 'gymbase'); ?></option>
				<option <?php echo ($icon=='pill' ? ' selected="selected"':'');?> value='pill'><?php _e("pill", 'gymbase'); ?></option>
				<option <?php echo ($icon=='pin' ? ' selected="selected"':'');?> value='pin'><?php _e("pin", 'gymbase'); ?></option>
				<option <?php echo ($icon=='pingpong' ? ' selected="selected"':'');?> value='pingpong'><?php _e("pingpong", 'gymbase'); ?></option>
				<option <?php echo ($icon=='play' ? ' selected="selected"':'');?> value='play'><?php _e("play", 'gymbase'); ?></option>
				<option <?php echo ($icon=='plus' ? ' selected="selected"':'');?> value='plus'><?php _e("plus", 'gymbase'); ?></option>
				<option <?php echo ($icon=='presentation' ? ' selected="selected"':'');?> value='presentation'><?php _e("presentation", 'gymbase'); ?></option>
				<option <?php echo ($icon=='printer' ? ' selected="selected"':'');?> value='printer'><?php _e("printer", 'gymbase'); ?></option>
				<option <?php echo ($icon=='protein' ? ' selected="selected"':'');?> value='protein'><?php _e("protein", 'gymbase'); ?></option>
				<option <?php echo ($icon=='pulse' ? ' selected="selected"':'');?> value='pulse'><?php _e("pulse", 'gymbase'); ?></option>
				<option <?php echo ($icon=='scale' ? ' selected="selected"':'');?> value='scale'><?php _e("scale", 'gymbase'); ?></option>
				<option <?php echo ($icon=='science' ? ' selected="selected"':'');?> value='science'><?php _e("science", 'gymbase'); ?></option>
				<option <?php echo ($icon=='screen' ? ' selected="selected"':'');?> value='screen'><?php _e("screen", 'gymbase'); ?></option>
				<option <?php echo ($icon=='shower' ? ' selected="selected"':'');?> value='shower'><?php _e("shower", 'gymbase'); ?></option>
				<option <?php echo ($icon=='signpost' ? ' selected="selected"':'');?> value='signpost'><?php _e("signpost", 'gymbase'); ?></option>
				<option <?php echo ($icon=='sneakers' ? ' selected="selected"':'');?> value='sneakers'><?php _e("sneakers", 'gymbase'); ?></option>
				<option <?php echo ($icon=='soccer' ? ' selected="selected"':'');?> value='soccer'><?php _e("soccer", 'gymbase'); ?></option>
				<option <?php echo ($icon=='spa' ? ' selected="selected"':'');?> value='spa'><?php _e("spa", 'gymbase'); ?></option>
				<option <?php echo ($icon=='spa-bamboo' ? ' selected="selected"':'');?> value='spa-bamboo'><?php _e("spa-bamboo", 'gymbase'); ?></option>
				<option <?php echo ($icon=='spa-lotion' ? ' selected="selected"':'');?> value='spa-lotion'><?php _e("spa-lotion", 'gymbase'); ?></option>
				<option <?php echo ($icon=='speaker' ? ' selected="selected"':'');?> value='speaker'><?php _e("speaker", 'gymbase'); ?></option>
				<option <?php echo ($icon=='squash' ? ' selected="selected"':'');?> value='squash'><?php _e("squash", 'gymbase'); ?></option>
				<option <?php echo ($icon=='stopwatch' ? ' selected="selected"':'');?> value='stopwatch'><?php _e("stopwatch", 'gymbase'); ?></option>
				<option <?php echo ($icon=='tablet' ? ' selected="selected"':'');?> value='tablet'><?php _e("tablet", 'gymbase'); ?></option>
				<option <?php echo ($icon=='tags' ? ' selected="selected"':'');?> value='tags'><?php _e("tags", 'gymbase'); ?></option>
				<option <?php echo ($icon=='tennis' ? ' selected="selected"':'');?> value='tennis'><?php _e("tennis", 'gymbase'); ?></option>
				<option <?php echo ($icon=='test-tube' ? ' selected="selected"':'');?> value='test-tube'><?php _e("test-tube", 'gymbase'); ?></option>
				<option <?php echo ($icon=='tick' ? ' selected="selected"':'');?> value='tick'><?php _e("tick", 'gymbase'); ?></option>
				<option <?php echo ($icon=='time' ? ' selected="selected"':'');?> value='time'><?php _e("time", 'gymbase'); ?></option>
				<option <?php echo ($icon=='twitter' ? ' selected="selected"':'');?> value='twitter'><?php _e("twitter", 'gymbase'); ?></option>
				<option <?php echo ($icon=='video' ? ' selected="selected"':'');?> value='video'><?php _e("video", 'gymbase'); ?></option>
				<option <?php echo ($icon=='wallet' ? ' selected="selected"':'');?> value='wallet'><?php _e("wallet", 'gymbase'); ?></option>
				<option <?php echo ($icon=='weightlifting' ? ' selected="selected"':'');?> value='weightlifting'><?php _e("weightlifting", 'gymbase'); ?></option>
				<option <?php echo ($icon=='youtube' ? ' selected="selected"':'');?> value='youtube'><?php _e("youtube", 'gymbase'); ?></option>
			</select>
			<?php _e('icon color', 'gymbase'); ?>
			<input class="regular-text color" id="<?php echo esc_attr($this->get_field_id('icon_color')); ?>" name="<?php echo esc_attr($this->get_field_name('icon_color')); ?>" type="text" value="<?php echo esc_attr($icon_color); ?>" data-default-color="222224" />
		</p>
		<?php
	}
}
?>