<?php
class gb_contact_details_widget extends WP_Widget 
{
	/** constructor */
	function __construct() 
	{
		$widget_options = array(
			'classname' => 'gb-contact-details-widget',
			'description' => __('Displays Contact Details Box', 'gymbase')
		);
		$control_options = array('width' => 665);
        parent::__construct('gymbase_contact_details', __('Contact Details Box', 'gymbase'), $widget_options, $control_options);
    }
	
	/** @see WP_Widget::widget */
    function widget($args, $instance)
	{
        extract($args);

		//these are our widget options
		$title = isset($instance['title']) ? $instance['title'] : '';
		$address_line_1 = isset($instance['address_line_1']) ? $instance['address_line_1'] : '';
		$address_line_2 = isset($instance['address_line_2']) ? $instance['address_line_2'] : '';
		$address_line_3 = isset($instance['address_line_3']) ? $instance['address_line_3'] : '';
		$contact_line_1 = isset($instance['contact_line_1']) ? $instance['contact_line_1'] : '';
		$contact_line_2 = isset($instance['contact_line_2']) ? $instance['contact_line_2'] : '';
		$contact_line_3 = isset($instance['contact_line_3']) ? $instance['contact_line_3'] : '';
		$animation = isset($instance['animation']) ? $instance['animation'] : "";
		$content = isset($instance['content']) ? $instance['content'] : "";
		$icon_type = isset($instance["icon_type"]) ? (array)$instance["icon_type"] : array("");
		$icon_value = isset($instance['icon_value']) ? $instance["icon_value"] : '';

		echo $before_widget;
		if($title) 
		{
			echo ((int)$animation ? str_replace("box-header", "box-header animation-slide", $before_title) : str_replace("animation-slide", "", $before_title)) . apply_filters("widget_title", $title) . $after_title;
		}
		if($address_line_1!="" || $contact_line_1!="" || $address_line_2!="" || $contact_line_2!="" || $address_line_3!="" || $contact_line_3!="")
		{
		?>
		<ul class="footer-contact-info-container clearfix">
			<?php
			if($address_line_1!="" || $contact_line_1!="")
			{
			?>
			<li class="footer-contact-info-row">
				<div class="footer-contact-info-left">
					<?php echo $address_line_1; ?>
				</div>
				<div class="footer-contact-info-right">
					<?php echo $contact_line_1; ?>
				</div>
			</li>
			<?php
			}
			if($address_line_2!="" || $contact_line_2!="")
			{
			?>
			<li class="footer-contact-info-row">
				<div class="footer-contact-info-left">
					<?php echo $address_line_2; ?>
				</div>
				<div class="footer-contact-info-right">
					<?php echo $contact_line_2; ?>
				</div>
			</li>
			<?php
			}
			if($address_line_3!="" || $contact_line_3!="")
			{
			?>
			<li class="footer-contact-info-row">
				<div class="footer-contact-info-left">
					<?php echo $address_line_3; ?>
				</div>
				<div class="footer-contact-info-right">
					<?php echo $contact_line_3; ?>
				</div>
			</li>
			<?php
			}
			?>
		</ul>
		<?php
		}
		if($content!='')
			echo '<p class="alternate">' . do_shortcode(apply_filters("widget_text", $content)) . '</p>';
		$arrayEmpty = true;
		for($i=0; $i<count($icon_type); $i++)
		{
			if($icon_type[$i]!="")
				$arrayEmpty = false;
		}
		if(!$arrayEmpty):
		?>
		<ul class="contact-data">
			<?php
			for($i=0; $i<count($icon_type); $i++)
			{
				if($icon_type[$i]!=""):
			?>
			<li class="clearfix template-<?php echo esc_attr($icon_type[$i]); ?>"><div class="value alternate"><?php echo $icon_value[$i];?></div></li>
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
		$instance['title'] = isset($new_instance['title']) ? strip_tags($new_instance['title']) : '';
		$instance['address_line_1'] = isset($new_instance['address_line_1']) ? $new_instance['address_line_1'] : '';
		$instance['address_line_2'] = isset($new_instance['address_line_2']) ? $new_instance['address_line_2'] : '';
		$instance['address_line_3'] = isset($new_instance['address_line_3']) ? $new_instance['address_line_3'] : '';
		$instance['contact_line_1'] = isset($new_instance['contact_line_1']) ? $new_instance['contact_line_1'] : '';
		$instance['contact_line_2'] = isset($new_instance['contact_line_2']) ? $new_instance['contact_line_2'] : '';
		$instance['contact_line_3'] = isset($new_instance['contact_line_3']) ? $new_instance['contact_line_3'] : '';
		$instance['animation'] = isset($new_instance['animation']) ? strip_tags($new_instance['animation']) : "";
		$instance['content'] = isset($new_instance['content']) ? $new_instance['content'] : "";
		$icon_type = isset($new_instance['icon_type']) ? (array)$new_instance['icon_type'] : array("");
		while(end($icon_type)==="")
			array_pop($icon_type);
		$instance['icon_type'] = isset($icon_type) ? $icon_type : "";
		$instance['icon_value'] = isset($new_instance['icon_value']) ? $new_instance['icon_value'] : '';
		return $instance;
    }
	
	 /** @see WP_Widget::form */
	function form($instance) 
	{
		if(!isset($instance["icon_type"])):
		?>
			<input type="hidden" id="widget-contact-details-button_id" value="<?php echo esc_attr($this->get_field_id('add_new_button')); ?>">
		<?php
		endif;
		$title = isset($instance['title']) ? esc_attr($instance['title']) : '';
		$address_line_1 = isset($instance['address_line_1']) ? esc_attr($instance['address_line_1']) : '';
		$address_line_2 = isset($instance['address_line_2']) ? esc_attr($instance['address_line_2']) : '';
		$address_line_3 = isset($instance['address_line_3']) ? esc_attr($instance['address_line_3']) : '';
		$contact_line_1 = isset($instance['contact_line_1']) ? esc_attr($instance['contact_line_1']) : '';
		$contact_line_2 = isset($instance['contact_line_2']) ? esc_attr($instance['contact_line_2']) : '';
		$contact_line_3 = isset($instance['contact_line_3']) ? esc_attr($instance['contact_line_3']) : '';
		$animation = isset($instance['animation']) ? esc_attr($instance['animation']) : "";
		$content = isset($instance['content']) ? esc_attr($instance['content']) : "";
		$icon_type = (isset($instance["icon_type"]) ? (array)$instance["icon_type"] : array(""));
		$icon_value = isset($instance['icon_value']) ? $instance["icon_value"] : "";
		$icons = array(
			"arrow-circle",
			"arrow-horizontal-1",
			"arrow-horizontal-2",
			"arrow-horizontal-3",
			"arrow-horizontal-4",
			"arrow-horizontal-5",
			"arrow-horizontal-6",
			"arrow-horizontal-7",
			"arrow-vertical-1",
			"arrow-vertical-3",
			"arrow-vertical-4",
			"arrow-vertical-5",
			"arrow-vertical-6",
			"arrow-vertical-7",
			"cart",
			"check",
			"chevron",
			"comment-1",
			"comment-2",
			"email",
			"location",
			"menu-1",
			"menu-2",
			"minus-1",
			"minus-2",
			"mobile",
			"plus-1",
			"plus-2",
			"remove-1",
			"remove-2",
			"search",
			"tick-1",
			"tick-2",
			"quote",
			"quote-2"
		);?>
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
			<label for="<?php echo esc_attr($this->get_field_id('content')); ?>"><?php _e('Content', 'gymbase'); ?></label>
			<textarea rows="10" class="widefat" id="<?php echo esc_attr($this->get_field_id('content')); ?>" name="<?php echo esc_attr($this->get_field_name('content')); ?>"><?php echo $content; ?></textarea>
		</p>
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
				<?php for($j=0; $j<count($icons); $j++)
				{
				?>
				<option value="<?php echo esc_attr($icons[$j]); ?>"<?php echo (isset($icon_type[$i]) && $icons[$j]==$icon_type[$i] ? " selected='selected'" : "") ?>><?php echo $icons[$j]; ?></option>
				<?php
				}
				?>
			</select>
			<input style="width: 445px;" type="text" class="regular-text" value="<?php echo isset($icon_value[$i]) ? esc_attr($icon_value[$i]) : ""; ?>" name="<?php echo esc_attr($this->get_field_name('icon_value')); ?>[]">
		</p>
		<?php
		}
		?>
		<p>
			<input type="button" class="button" name="<?php echo esc_attr($this->get_field_name('add_new_button')); ?>" id="<?php echo esc_attr($this->get_field_id('add_new_button')); ?>" value="<?php esc_attr_e('Add icon', 'gymbase'); ?>" />
		</p>
		<p>
			<label for="<?php echo esc_attr($this->get_field_id('address_line_1')); ?>"><?php _e('address_line_1 (deprecated)', 'gymbase'); ?></label>
			<input class="widefat" id="<?php echo esc_attr($this->get_field_id('address_line_1')); ?>" name="<?php echo esc_attr($this->get_field_name('address_line_1')); ?>" type="text" value="<?php echo esc_attr($address_line_1); ?>" />
		</p>
		<p>
			<label for="<?php echo esc_attr($this->get_field_id('address_line_2')); ?>"><?php _e('address_line_2 (deprecated)', 'gymbase'); ?></label>
			<input class="widefat" id="<?php echo esc_attr($this->get_field_id('address_line_2')); ?>" name="<?php echo esc_attr($this->get_field_name('address_line_2')); ?>" type="text" value="<?php echo esc_attr($address_line_2); ?>" />
		</p>
		<p>
			<label for="<?php echo esc_attr($this->get_field_id('address_line_3')); ?>"><?php _e('address_line_3 (deprecated)', 'gymbase'); ?></label>
			<input class="widefat" id="<?php echo esc_attr($this->get_field_id('address_line_3')); ?>" name="<?php echo esc_attr($this->get_field_name('address_line_3')); ?>" type="text" value="<?php echo esc_attr($address_line_3); ?>" />
		</p>
		<p>
			<label for="<?php echo esc_attr($this->get_field_id('contact_line_1')); ?>"><?php _e('contact_line_1 (deprecated)', 'gymbase'); ?></label>
			<input class="widefat" id="<?php echo esc_attr($this->get_field_id('contact_line_1')); ?>" name="<?php echo esc_attr($this->get_field_name('contact_line_1')); ?>" type="text" value="<?php echo esc_attr($contact_line_1); ?>" />
		</p>
		<p>
			<label for="<?php echo esc_attr($this->get_field_id('contact_line_2')); ?>"><?php _e('contact_line_2 (deprecated)', 'gymbase'); ?></label>
			<input class="widefat" id="<?php echo esc_attr($this->get_field_id('contact_line_2')); ?>" name="<?php echo esc_attr($this->get_field_name('contact_line_2')); ?>" type="text" value="<?php echo esc_attr($contact_line_2); ?>" />
		</p>
		<p>
			<label for="<?php echo esc_attr($this->get_field_id('contact_line_3')); ?>"><?php _e('contact_line_3 (deprecated)', 'gymbase'); ?></label>
			<input class="widefat" id="<?php echo esc_attr($this->get_field_id('contact_line_3')); ?>" name="<?php echo esc_attr($this->get_field_name('contact_line_3')); ?>" type="text" value="<?php echo esc_attr($contact_line_3); ?>" />
		</p>
		<?php
	}
}
?>