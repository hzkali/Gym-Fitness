<?php
class gb_social_icons_widget extends WP_Widget 
{
	/** constructor */
	function __construct()
	{
		$widget_options = array(
			'classname' => 'social-icons-widget',
			'description' => __('Displays Social Icons', 'gymbase')
		);
		$control_options = array('width' => 700);
        parent::__construct('gymbase_social_icons', __('Social Icons', 'gymbase'), $widget_options, $control_options);
    }
	
	/** @see WP_Widget::widget */
    function widget($args, $instance) 
	{
        extract($args);

		//these are our widget options
		$title = isset($instance['title']) ? $instance['title'] : '';
		$icon_type = isset($instance['icon_type']) ? (array)$instance["icon_type"] : array("");
		$icon_value = isset($instance['icon_value']) ? $instance["icon_value"] : '';
		$icon_target = isset($instance['icon_target']) ? $instance["icon_target"] : '';
		$icon_display = isset($instance['icon_display']) ? $instance["icon_display"] : "";

		echo $before_widget;
		if(isset($title) && $title!="")
		{
			echo $before_title . $title . $after_title;
		} 
		$arrayEmpty = true;
		for($i=0; $i<count($icon_type); $i++)
		{
			if($icon_type[$i]!="")
				$arrayEmpty = false;
		}
		if(!$arrayEmpty):
		?>
		<ul class="social-icons clearfix">
			<?php
			for($i=0; $i<count($icon_type); $i++)
			{
				if($icon_type[$i]!=""):
			?>
			<li<?php echo ($icon_display[$i]=="mobile_only" ? ' class="show-on-mobiles"' : ''); ?>><a <?php echo ($icon_target[$i]=="new_window" ? " target='_blank' " : ""); ?>href="<?php echo esc_url($icon_value[$i]);?>" class="social-<?php echo esc_attr($icon_type[$i]); ?>"></a></li>
			<?php
				endif;
			}
			?>
		</ul>
		<?php
		endif;
        echo $after_widget;
    }
	
	/** @see WP_Widget::update */
    function update($new_instance, $old_instance) 
	{
		$instance = $old_instance;
		$instance['title'] = isset($new_instance['title']) ? $new_instance['title'] : '';
		$icon_type = isset($new_instance['icon_type']) ? (array)$new_instance['icon_type'] : array("");
		while(end($icon_type)==="")
			array_pop($icon_type);
		$instance['icon_type'] = isset($icon_type) ? $icon_type : "";
		$instance['icon_value'] = isset($new_instance['icon_value']) ? $new_instance['icon_value'] : "";
		$instance['icon_target'] = isset($new_instance['icon_target']) ? $new_instance['icon_target'] : "";
		$instance['icon_display'] = isset($new_instance['icon_display']) ? $new_instance['icon_display'] : "";
		return $instance;
    }
	
	 /** @see WP_Widget::form */
	function form($instance) 
	{
		$title = isset($instance['title']) ? esc_attr($instance['title']) : '';
		if(!isset($instance["icon_type"])):
		?>
			<input type="hidden" id="widget-social-icons-button_id" value="<?php echo esc_attr($this->get_field_id('add_new_button')); ?>">
		<?php
		endif;
		$icon_type = (isset($instance["icon_type"]) ? (array)$instance["icon_type"] : array(""));
		$icon_value = isset($instance['icon_value']) ? $instance["icon_value"] : '';
		$icon_target = isset($instance['icon_target']) ? $instance["icon_target"] : '';
		$icon_display = (isset($instance["icon_display"]) ? $instance["icon_display"] : '');
		$icons = array(
			__("angies-list", 'gymbase') => "angies-list",
			__("behance", 'gymbase') => "behance",
			__("deviantart", 'gymbase') => "deviantart",
			__("dribbble", 'gymbase') => "dribbble",
			__("email", 'gymbase') => "email",
			__("envato", 'gymbase') => "envato",
			__("facebook", 'gymbase') => "facebook",
			__("flickr", 'gymbase') => "flickr",
			__("foursquare", 'gymbase') => "foursquare",
			__("github", 'gymbase') => "github",
			__("google-plus", 'gymbase') => "google-plus",
			__("houzz", 'gymbase') => "houzz",
			__("instagram", 'gymbase') => "instagram",
			__("linkedin", 'gymbase') => "linkedin",
			__("location", 'gymbase') => "location",
			__("mobile", 'gymbase') => "mobile",
			__("paypal", 'gymbase') => "paypal",
			__("pinterest", 'gymbase') => "pinterest",
			__("reddit", 'gymbase') => "reddit",
			__("rss", 'gymbase') => "rss",
			__("skype", 'gymbase') => "skype",
			__("soundcloud", 'gymbase') => "soundcloud",
			__("spotify", 'gymbase') => "spotify",
			__("stumbleupon", 'gymbase') => "stumbleupon",
			__("tumblr", 'gymbase') => "tumblr",
			__("twitter", 'gymbase') => "twitter",
			__("whatsapp", 'gymbase') => "whatsapp",
			__("weibo", 'gymbase') => "weibo",
			__("vimeo", 'gymbase') => "vimeo",
			__("vine", 'gymbase') => "vine",
			__("vk", 'gymbase') => "vk",
			__("xing", 'gymbase') => "xing",
			__("yelp", 'gymbase') => "yelp",
			__("youtube", 'gymbase') => "youtube"
		);
		?>
		<p>
			<label for="<?php echo esc_attr($this->get_field_id('title')); ?>"><?php _e('Title', 'gymbase'); ?></label>
			<input class="widefat" id="<?php echo esc_attr($this->get_field_id('title')); ?>" name="<?php echo esc_attr($this->get_field_name('title')); ?>" type="text" value="<?php echo esc_attr($title); ?>" />
		</p>
		<?php
		for($i=0; $i<(count($icon_type)<4 ? 4 : count($icon_type)); $i++)
		{
		?>
		<p>
			<label for="<?php echo esc_attr($this->get_field_id('icon_type')) . absint($i); ?>"><?php _e('Icon type', 'gymbase'); ?></label>
			<select id="<?php echo esc_attr($this->get_field_id('icon_type')) . absint($i); ?>" name="<?php echo esc_attr($this->get_field_name('icon_type')); ?>[]">
				<option value="">-</option>
				<?php foreach($icons as $ico)
				{
				?>
				<option value="<?php echo (isset($ico) ? esc_attr($ico) : ''); ?>"<?php echo (isset($icon_type[$i]) && $ico==$icon_type[$i] ? " selected='selected'" : "") ?>><?php echo $ico; ?></option>
				<?php
				}
				?>
			</select>
			<input style="width: 220px;" type="text" class="regular-text" value="<?php echo (isset($icon_value[$i]) ? esc_attr($icon_value[$i]) : ''); ?>" name="<?php echo esc_attr($this->get_field_name('icon_value')); ?>[]">
			<select name="<?php echo esc_attr($this->get_field_name('icon_target')); ?>[]">
				<option value="same_window"<?php echo (isset($icon_target[$i]) && $icon_target[$i]=="same_window" ? " selected='selected'" : ""); ?>><?php _e('same window', 'gymbase'); ?></option>
				<option value="new_window"<?php echo (isset($icon_target[$i]) && $icon_target[$i]=="new_window" ? " selected='selected'" : ""); ?>><?php _e('new window', 'gymbase'); ?></option>
			</select>
			<select name="<?php echo esc_attr($this->get_field_name('icon_display')); ?>[]">
				<option value="always"<?php echo (isset($icon_display[$i]) && $icon_display[$i]=="always" ? " selected='selected'" : ""); ?>><?php _e('show always', 'gymbase'); ?></option>
				<option value="mobile_only"<?php echo (isset($icon_display[$i]) && $icon_display[$i]=="mobile_only" ? " selected='selected'" : ""); ?>><?php _e('show only on mobiles', 'gymbase'); ?></option>
			</select>
		</p>
		<?php
		}
		?>
		<p>
			<input type="button" class="button" name="<?php echo esc_attr($this->get_field_name('add_new_button')); ?>" id="<?php echo esc_attr($this->get_field_id('add_new_button')); ?>" value="<?php esc_attr_e('Add icon', 'gymbase'); ?>" />
		</p>
		<?php
	}
}
?>