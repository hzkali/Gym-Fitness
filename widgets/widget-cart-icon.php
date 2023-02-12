<?php
class gb_cart_icon_widget extends WP_Widget 
{
	/** constructor */
	function __construct() 
	{
		$widget_options = array(
			'classname' => 'gb_cart_icon_widget',
			'description' => __('Displays Shop Cart Icon', 'gymbase')
		);
        parent::__construct('gymbase_cart_icon', __('Woocommerce Shop Cart Icon', 'gymbase'), $widget_options);
    }
	
	/** @see WP_Widget::widget */
    function widget($args, $instance) 
	{
        extract($args);

		//these are our widget options		
		$cart_items_number = (isset($instance["cart_items_number"]) ? $instance["cart_items_number"] : "");
		$icon_target = (isset($instance["icon_target"]) ? $instance["icon_target"] : "");
		$icon_display = (isset($instance["icon_display"]) ? $instance["icon_display"] : "");

		echo $before_widget;
		echo do_shortcode("[gb_cart_icon cart_items_number='{$cart_items_number}' icon_target='{$icon_target}'" . ($icon_display!="always" ? " class='{$icon_display}'" : "") . "]");
        echo $after_widget;
    }
	
	/** @see WP_Widget::update */
    function update($new_instance, $old_instance)
	{
		$instance = $old_instance;
		$instance['cart_items_number'] = (isset($new_instance["cart_items_number"]) ? strip_tags($new_instance['cart_items_number']) : "");
		$instance['icon_target'] = (isset($new_instance["icon_target"]) ? $new_instance['icon_target'] : "");
		$instance['icon_display'] = (isset($new_instance["icon_display"]) ? $new_instance['icon_display'] : "");
		return $instance;
    }
	
	 /** @see WP_Widget::form */
	function form($instance) 
	{
		$cart_items_number = (isset($instance["cart_items_number"]) ? esc_attr($instance["cart_items_number"]) : "");
		$icon_target = (isset($instance["icon_target"]) ? $instance["icon_target"] : "");
		$icon_display = (isset($instance["icon_display"]) ? $instance["icon_display"] : "");
		?>
		<p>
			<label for="<?php echo esc_attr($this->get_field_id('cart_items_number')); ?>"><?php _e('Show cart items number', 'gymbase'); ?></label>
			<select id="<?php echo esc_attr($this->get_field_id('cart_items_number')); ?>" name="<?php echo esc_attr($this->get_field_name('cart_items_number')); ?>">
				<option value="yes"<?php echo ($cart_items_number=="yes" ? ' selected="selected"' : ''); ?>><?php _e('yes', 'gymbase'); ?></option>
				<option value="no"<?php echo ($cart_items_number=="no" ? ' selected="selected"' : ''); ?>><?php _e('no', 'gymbase'); ?></option>
			</select>
		</p>
		<p>
			<label for="<?php echo esc_attr($this->get_field_id('icon_target')); ?>"><?php _e('Icon target', 'gymbase'); ?></label>
			<select name="<?php echo esc_attr($this->get_field_name('icon_target')); ?>">
				<option value="same_window"<?php echo ($icon_target=="same_window" ? " selected='selected'" : ""); ?>><?php _e('same window', 'gymbase'); ?></option>
				<option value="new_window"<?php echo ($icon_target=="new_window" ? " selected='selected'" : ""); ?>><?php _e('new window', 'gymbase'); ?></option>
			</select>
		</p>
		<p>
			<label for="<?php echo esc_attr($this->get_field_id('icon_display')); ?>"><?php _e('Icon display', 'gymbase'); ?></label>
			<select name="<?php echo esc_attr($this->get_field_name('icon_display')); ?>">
				<option value="always"<?php echo ($icon_display=="always" ? " selected='selected'" : ""); ?>><?php _e('show always', 'gymbase'); ?></option>
				<option value="show-on-mobiles"<?php echo ($icon_display=="show-on-mobiles" ? " selected='selected'" : ""); ?>><?php _e('show only on mobiles', 'gymbase'); ?></option>
				<option value="show-on-desktop"<?php echo ($icon_display=="show-on-desktop" ? " selected='selected'" : ""); ?>><?php _e('show only on desktop', 'gymbase'); ?></option>
			</select>
		</p>
		<?php
	}
}
?>