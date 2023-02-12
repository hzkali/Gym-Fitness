<?php
//post
function gb_theme_our_clients_carousel($atts)
{
	extract(shortcode_atts(array(
		"images" => "",
		"id" => "our_clients",
		"title" => __("Recommended Brands", 'gymbase'),
		"type" => "carousel",
		"onclick" => "link_image",
		"custom_links" => "",
		"custom_links_target" => "",
		"autoplay" => "",
		"pause_on_hover" => 1,
		"scroll" => 1,
		"effect" => "scroll",
		"easing" => "swing",
		"duration" => 500,
		"hide_pagination_control" => "",
		"top_margin" => "none",
		"el_class" => ""
	), $atts));
	if($effect=="_fade")
		$effect = "fade";
	if(strpos($easing, 'ease')!==false)
	{
		$newEasing = 'ease';
		if(strpos($easing, 'inout')!==false)
			$newEasing .= 'InOut';
		else if(strpos($easing, 'in')!==false)
			$newEasing .= 'In';
		else if(strpos($easing, 'out')!==false)
			$newEasing .= 'Out';
		$newEasing .= ucfirst(substr($easing, strlen($newEasing), strlen($easing)-strlen($newEasing)));
	}
	else
		$newEasing = $easing;
	
	if ($onclick=="custom_link")
		$custom_links = explode(',', $custom_links);
	$output = "";
	if($type=="list" && $title!="")
	{
		$output .= '<h4>' . $title . '</h4>';
	}
	$output .= '<div class="our-clients-list-container' . ($top_margin!="none" ? ' ' . esc_attr($top_margin) : '') . ($el_class!="" ? ' ' . esc_attr($el_class) : '') . (!empty($type) ? ' type-' . esc_attr($type) : '') . '">';
	if($type=="carousel" && ($title!="" || $hide_pagination_control!=='yes'))
	{
		$output .= '<div class="vc_col-sm-2 wpb_column vc_column_container">';
		if($title!="")
		{
			$output .= '<h4>' . $title . '</h4>';
		}
		if($hide_pagination_control!=='yes')
		{
			$output .= '<ul class="clearfix controls' . ($title!="" ? ' page-margin-top' : '') . '">
				<li><a href="#" id="' . esc_attr($id) . '_prev" class="scrolling-list-control-left template-arrow-horizontal-7"></a></li>
				<li><a href="#" id="' . esc_attr($id) . '_next" class="scrolling-list-control-right template-arrow-horizontal-7"></a></li>
			</ul>';
		}
		$output .= '</div>';
	}
	$output .= '<ul class="our-clients-list id-' . esc_attr($id) . ' autoplay-' . ($autoplay=='yes' ? '1' : '0') . ' pause_on_hover-' . esc_attr($pause_on_hover) . ' scroll-' . esc_attr($scroll) . ' effect-' . esc_attr($effect) . ' easing-' . esc_attr($newEasing) . ' duration-' . esc_attr($duration) . (!empty($type) ? ' type-' . esc_attr($type) : '') . '">';
	$images = explode(',', $images);
	$i = 0;
	foreach($images as $attach_id)
	{
		if(($i==0 || $i%6==0) && $type!="carousel")
		{
			if($i%6==0 && $i>0)
			{
				$output .= '</ul></li>';
			}
			$output .= '<li class="vc_row wpb_row vc_row-fluid"><ul>';
		}
		$output .= '<li class="vc_col-sm-2 wpb_column vc_column_container">';
		if($onclick=="link_image")
		{
			$attachment_image = wp_get_attachment_image_src($attach_id, "full");
			$image_url = $attachment_image[0];
			$output .= '<a href="' . esc_url($image_url) . '" class="fancybox">' . wp_get_attachment_image($attach_id, "full", false, array("alt" => "")) . '</a>';
		}
		else if($onclick=="custom_link" && isset($custom_links[$i]) && $custom_links[$i]!="")
			$output .= '<a href="' . esc_url($custom_links[$i]) . '"' . ($custom_links_target=="_blank" ? ' target="_blank"' : '') . '>' . wp_get_attachment_image($attach_id, "full", false, array("alt" => "")) . '</a>';
		else
			$output .= wp_get_attachment_image($attach_id, "full", false, array("alt" => ""));
		$output .= '</li>';
		$i++;
	}
	if($type!="carousel")
	{
		$output .= '</ul></li>';
	}
	$output .= '</ul>';
	$output .= '</div>';
	return $output;
}


//visual composer
class WPBakeryShortCode_Our_Clients_Carousel extends WPBakeryShortCode {
	public function content( $atts, $content = null ) {
        return gb_theme_our_clients_carousel($atts);
    }
   public function singleParamHtmlHolder($param, $value) {
		$output = '';
        // Compatibility fixes
        $old_names = array('yellow_message', 'blue_message', 'green_message', 'button_green', 'button_grey', 'button_yellow', 'button_blue', 'button_red', 'button_orange');
        $new_names = array('alert-block', 'alert-info', 'alert-success', 'btn-success', 'btn', 'btn-info', 'btn-primary', 'btn-danger', 'btn-warning');
        $value = str_ireplace($old_names, $new_names, $value);

        $param_name = isset($param['param_name']) ? $param['param_name'] : '';
        $type = isset($param['type']) ? $param['type'] : '';
        $class = isset($param['class']) ? $param['class'] : '';

        if ( isset($param['holder']) == true && $param['holder'] !== 'hidden' ) {
            $output .= '<'.$param['holder'].' class="wpb_vc_param_value ' . esc_attr($param_name) . ' ' . esc_attr($type) . ' ' . esc_attr($class) . '" name="' . esc_attr($param_name) . '">'.$value.'</'.$param['holder'].'>';
        }
        if($param_name == 'images') {
            $images_ids = empty($value) ? array() : explode(',', trim($value));
            $output .= '<ul class="attachment-thumbnails'.( empty($images_ids) ? ' image-exists' : '' ).'" data-name="' . esc_attr($param_name) . '">';
            foreach($images_ids as $image) {
                $img = wpb_getImageBySize(array( 'attach_id' => (int)$image, 'thumb_size' => 'small-thumb' ));
                $output .= ( $img ? '<li>'.$img['thumbnail'].'</li>' : '<li><img width="150" height="150" test="'.esc_attr($image).'" src="' . WPBakeryVisualComposer::getInstance()->assetURL('vc/blank.gif') . '" class="attachment-thumbnail" alt="" title="" /></li>');
            }
            $output .= '</ul>';
            $output .= '<a href="#" class="column_edit_trigger' . ( !empty($images_ids) ? ' image-exists' : '' ) . '">' . __( 'Add images', 'gymbase' ) . '</a>';

        }
        return $output;
	}
}
//visual composer
function gb_theme_our_clients_carousel_vc_init()
{
	$target_arr = array(
		__( 'Same window', 'gymbase' ) => '_self',
		__( 'New window', 'gymbase' ) => "_blank"
	);
	$params = array(
		array(
			'type' => 'attach_images',
			'heading' => __( 'Images', 'gymbase' ),
			'param_name' => 'images',
			'value' => '',
			'description' => __( 'Select images from media library.', 'gymbase' )
		),
		array(
			'type' => 'textfield',
			'heading' => __( 'Id', 'gymbase' ),
			'param_name' => 'id',
			'value' => "our_clients"
		),
		array(
			'type' => 'textfield',
			'heading' => __( 'Title', 'gymbase' ),
			'param_name' => 'title',
			'value' => __("Recommended Brands", 'gymbase')
		),
		array(
			'type' => 'dropdown',
			'heading' => __( 'Type', 'gymbase' ),
			'param_name' => 'type',
			'value' => array(
				__( 'Carousel', 'gymbase' ) => 'carousel',
				__( 'List', 'gymbase' ) => 'list'
			)
		),
		array(
			'type' => 'dropdown',
			'heading' => __( 'On click action', 'gymbase' ),
			'param_name' => 'onclick',
			'value' => array(
				__( 'Open prettyPhoto', 'gymbase' ) => 'link_image',
				__( 'None', 'gymbase' ) => 'link_no',
				__( 'Open custom links', 'gymbase' ) => 'custom_link'
			),
			'description' => __( 'Select action for click event.', 'gymbase' )
		),
		array(
			'type' => 'exploded_textarea',
			'heading' => __( 'Custom links', 'gymbase' ),
			'param_name' => 'custom_links',
			'description' => __( 'Enter links for each slide (Note: divide links with linebreaks (Enter)).', 'gymbase' ),
			'dependency' => array(
				'element' => 'onclick',
				'value' => array( 'custom_link' )
			)
		),
		array(
			'type' => 'dropdown',
			'heading' => __( 'Custom link target', 'gymbase' ),
			'param_name' => 'custom_links_target',
			'description' => __( 'Select how to open custom links.', 'gymbase' ),
			'dependency' => array(
				'element' => 'onclick',
				'value' => array( 'custom_link' )
			),
			'value' => $target_arr
		),
		array(
			'type' => 'checkbox',
			'heading' => __( 'Slider autoplay', 'gymbase' ),
			'param_name' => 'autoplay',
			'description' => __( 'Enable autoplay mode.', 'gymbase' ),
			'value' => array( __( 'Yes', 'gymbase' ) => 'yes' ),
			'dependency' => array(
				'element' => 'type',
				'value' => array( 'carousel' )
			)
		),
		array(
			"type" => "dropdown",
			"class" => "",
			"heading" => __("Pause on hover", 'gymbase'),
			"param_name" => "pause_on_hover",
			"value" => array(__("Yes", 'gymbase') => 1, __("No", 'gymbase') => 0),
			"dependency" => Array('element' => "autoplay", 'value' => 'yes')
		),
		array(
			"type" => "textfield",
			"class" => "",
			"heading" => __("Scroll", 'gymbase'),
			"param_name" => "scroll",
			"value" => 1,
			"description" => __("Number of items to scroll in one step", 'gymbase'),
			'dependency' => array(
				'element' => 'type',
				'value' => array( 'carousel' )
			)
		),
		array(
			"type" => "dropdown",
			"class" => "",
			"heading" => __("Effect", 'gymbase'),
			"param_name" => "effect",
			"value" => array(
				__("scroll", 'gymbase') => "scroll", 
				__("none", 'gymbase') => "none", 
				__("directscroll", 'gymbase') => "directscroll",
				__("fade", 'gymbase') => "_fade",
				__("crossfade", 'gymbase') => "crossfade",
				__("cover", 'gymbase') => "cover",
				__("uncover", 'gymbase') => "uncover"
			),
			'dependency' => array(
				'element' => 'type',
				'value' => array( 'carousel' )
			)
		),
		array(
			"type" => "dropdown",
			"class" => "",
			"heading" => __("Sliding easing", 'gymbase'),
			"param_name" => "easing",
			"value" => array(
				__("swing", 'gymbase') => "swing", 
				__("linear", 'gymbase') => "linear", 
				__("easeInQuad", 'gymbase') => "easeInQuad",
				__("easeOutQuad", 'gymbase') => "easeOutQuad",
				__("easeInOutQuad", 'gymbase') => "easeInOutQuad",
				__("easeInCubic", 'gymbase') => "easeInCubic",
				__("easeOutCubic", 'gymbase') => "easeOutCubic",
				__("easeInOutCubic", 'gymbase') => "easeInOutCubic",
				__("easeInQuart", 'gymbase') => "easeInQuart",
				__("easeOutQuart", 'gymbase') => "easeOutQuart",
				__("easeInOutQuart", 'gymbase') => "easeInOutQuart",
				__("easeInSine", 'gymbase') => "easeInSine",
				__("easeOutSine", 'gymbase') => "easeOutSine",
				__("easeInOutSine", 'gymbase') => "easeInOutSine",
				__("easeInExpo", 'gymbase') => "easeInExpo",
				__("easeOutExpo", 'gymbase') => "easeOutExpo",
				__("easeInOutExpo", 'gymbase') => "easeInOutExpo",
				__("easeInQuint", 'gymbase') => "easeInQuint",
				__("easeOutQuint", 'gymbase') => "easeOutQuint",
				__("easeInOutQuint", 'gymbase') => "easeInOutQuint",
				__("easeInCirc", 'gymbase') => "easeInCirc",
				__("easeOutCirc", 'gymbase') => "easeOutCirc",
				__("easeInOutCirc", 'gymbase') => "easeInOutCirc",
				__("easeInElastic", 'gymbase') => "easeInElastic",
				__("easeOutElastic", 'gymbase') => "easeOutElastic",
				__("easeInOutElastic", 'gymbase') => "easeInOutElastic",
				__("easeInBack", 'gymbase') => "easeInBack",
				__("easeOutBack", 'gymbase') => "easeOutBack",
				__("easeInOutBack", 'gymbase') => "easeInOutBack",
				__("easeInBounce", 'gymbase') => "easeInBounce",
				__("easeOutBounce", 'gymbase') => "easeOutBounce",
				__("easeInOutBounce", 'gymbase') => "easeInOutBounce"
			),
			'dependency' => array(
				'element' => 'type',
				'value' => array( 'carousel' )
			)
		),
		array(
			"type" => "textfield",
			"class" => "",
			"heading" => __("Sliding transition speed (ms)", 'gymbase'),
			"param_name" => "duration",
			"value" => 500,
			'dependency' => array(
				'element' => 'type',
				'value' => array( 'carousel' )
			)
		),
		array(
			'type' => 'checkbox',
			'heading' => __( 'Hide pagination control', 'gymbase' ),
			'param_name' => 'hide_pagination_control',
			'description' => __( 'If checked, pagination controls will be hidden.', 'gymbase' ),
			'value' => array( __( 'Yes', 'gymbase' ) => 'yes' ),
			'dependency' => array(
				'element' => 'type',
				'value' => array( 'carousel' )
			)
		),
		array(
			"type" => "dropdown",
			"class" => "",
			"heading" => __("Top margin", 'gymbase'),
			"param_name" => "top_margin",
			"value" => array(__("None", 'gymbase') => "none", __("Page (small)", 'gymbase') => "page-margin-top", __("Section (large)", 'gymbase') => "page-margin-top-section")
		),
		array(
			'type' => 'textfield',
			'heading' => __( 'Extra class name', 'gymbase' ),
			'param_name' => 'el_class',
			'description' => __( 'If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'gymbase' )
		)
	);
	
	vc_map( array(
		"name" => __("Our Clients List", 'gymbase'),
		"base" => "our_clients_carousel",
		"class" => "",
		"controls" => "full",
		"show_settings_on_create" => true,
		"icon" => "icon-wpb-layer-carousel",
		"category" => __('GymBase', 'gymbase'),
		"params" => $params
	));
}
add_action("init", "gb_theme_our_clients_carousel_vc_init");
?>
