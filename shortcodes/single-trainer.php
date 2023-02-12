<?php
//trainer
function gb_theme_single_trainer($atts)
{
	extract(shortcode_atts(array(
		"top_margin" => "none"
	), $atts));
	
	global $post;
	setup_postdata($post);
	
	$output = "";
	if(!empty($top_margin) && $top_margin!="none")
		$output .= '<div class="' . esc_attr($top_margin) . '">';
	if(get_post_type()=="trainers")
		$output .= (function_exists("wpb_js_remove_wpautop") ? wpb_js_remove_wpautop(apply_filters('the_content', get_the_content())) : apply_filters('the_content', get_the_content()));
	if(!empty($top_margin) && $top_margin!="none")
		$output .= '</div>';
		
	return $output;
}

//visual composer
function gb_theme_single_trainer_vc_init()
{
	$params = array(
		array(
			"type" => "dropdown",
			"class" => "",
			"heading" => __("Top margin", 'gymbase'),
			"param_name" => "top_margin",
			"value" => array(__("None", 'gymbase') => "none", __("Page (small)", 'gymbase') => "page-margin-top", __("Section (large)", 'gymbase') => "page-margin-top-section")
		)
	);
	
	vc_map( array(
		"name" => __("Single Trainer Template", 'gymbase'),
		"base" => "single_trainer",
		"class" => "",
		"controls" => "full",
		"show_settings_on_create" => true,
		"icon" => "icon-wpb-layer-custom-post-type",
		"category" => __('GymBase', 'gymbase'),
		"params" => $params
	));
}
add_action("init", "gb_theme_single_trainer_vc_init");
?>
