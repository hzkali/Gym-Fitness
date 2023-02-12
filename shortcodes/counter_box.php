<?php
//post
function gb_theme_counter_box($atts, $content)
{
	extract(shortcode_atts(array(
		"type" => "single",
		"value" => "",
		"value_sign" => "",
		"duration" => 2000,
		"animation_start" => "",
		"class" => "",
		"top_margin" => "none"
	), $atts));
	
	$output = "";
	$output .= '<div class="counter-box' . ($type=="group" ? ' group-counter-box' : '') . ($class!="" ? ' ' . esc_attr($class) : '') . ($top_margin!="none" ? ' ' . esc_attr($top_margin) : '') . '">';
	if($content!="")
		$output .= '<p class="alternate">' . wpb_js_remove_wpautop($content) . '</p>';
	if($type!="single")
		$output .= '<div class="progress-container">
						<div class="progress-bar animated-element duration-' . esc_attr((int)$duration) . ' animation-height"' . ((int)$animation_start>0 ? ' data-animation-start="' . esc_attr((int)$animation_start) . '"' : '') . '></div>
						<div class="number-container"><span class="number animated-element" data-value="' . esc_attr($value) . '"' . ((int)$animation_start>0 ? ' data-animation-start="' . esc_attr((int)$animation_start) . '"' : '') . '></span>' . ($value_sign!="" ? '<span class="number-sign">' . $value_sign . '</span>' : '') . '</div>
					</div>';
	if($type=="single")
		$output .= '<div class="progress-container">
						<div class="progress-bar animated-element duration-' . esc_attr((int)$duration) . ' animation-height"' . ((int)$animation_start>0 ? ' data-animation-start="' . esc_attr((int)$animation_start) . '"' : '') . '></div>
						<div class="number-container"><span class="number animated-element" data-value="' . esc_attr($value) . '"' . ((int)$animation_start>0 ? ' data-animation-start="' . esc_attr((int)$animation_start) . '"' : '') . '></span>' . ($value_sign!="" ? '<span class="number-sign">' . $value_sign . '</span>' : '') . '</div>
					</div>';
	$output .= '</div>';
	return $output;
}


//visual composer
function gb_theme_counter_box_vc_init()
{
	$params = array(
		array(
			"type" => "dropdown",
			"class" => "",
			"heading" => __("Type", 'gymbase'),
			"param_name" => "type",
			"value" => array(__("Single", 'gymbase') => "single", __("Group", 'gymbase') => "group"),
			"description" => __("Choose 'Group' type if you would like to use top value of counter boxes group as max value, the rest in the group will grow proportionally to it then. 'Single' will be good choice for percentage values, 'Group' for number values.", 'gymbase')
		),
		array(
			"type" => "textfield",
			"class" => "",
			"heading" => __("Value", 'gymbase'),
			"param_name" => "value",
			"value" => ""
		),
		array(
			"type" => "textfield",
			"class" => "",
			"heading" => __("Value sign", 'gymbase'),
			"param_name" => "value_sign",
			"value" => ""
		),
		array(
			"type" => "textarea_html",
			"holder" => "div",
			"class" => "",
			"heading" => __("Text", 'gymbase'),
			"param_name" => "content",
			"value" => ""
		),
		array(
			"type" => "textfield",
			"class" => "",
			"heading" => __("Animation duration", 'gymbase'),
			"param_name" => "duration",
			"value" => "2000"
		),
		array(
			"type" => "textfield",
			"class" => "",
			"heading" => __("Animation start position", 'gymbase'),
			"param_name" => "animation_start",
			"value" => ""
		),
		array(
			"type" => "textfield",
			"class" => "",
			"heading" => __("Extra class name", 'gymbase'),
			"param_name" => "class",
			"value" => ""
		),
		array(
			"type" => "dropdown",
			"class" => "",
			"heading" => __("Top margin", 'gymbase'),
			"param_name" => "top_margin",
			"value" => array(__("None", 'gymbase') => "none", __("Page (small)", 'gymbase') => "page-margin-top", __("Section (large)", 'gymbase') => "page-margin-top-section")
		)
	);
	
	vc_map( array(
		"name" => __("Counter Box", 'gymbase'),
		"base" => "counter_box",
		"class" => "",
		"controls" => "full",
		"show_settings_on_create" => true,
		"icon" => "icon-wpb-layer-counter-box",
		"category" => __('GymBase', 'gymbase'),
		"params" => $params
	));
}
add_action("init", "gb_theme_counter_box_vc_init");
?>
