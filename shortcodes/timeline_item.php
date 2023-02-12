<?php
//post
function gb_theme_timeline_item($atts, $content)
{
	extract(shortcode_atts(array(
		"label" => "",
		"label_style" => "default",
		"title" => "",
		"animations" => "1",
		"animation_delay" => 0,
		"top_margin" => "none",
		"el_class" => ""
	), $atts));
	
	$output = "";
	$output .= '<div class="timeline-item' . ($top_margin!="none" ? ' ' . esc_attr($top_margin) : '') . ($el_class!="" ? ' ' . esc_attr($el_class) : '') . '">';
	if($label!="")
	{
		//$output .= '<div class="timeline-left vertical-align-cell"><div class="label-container"' . ((int)$label_position!=0 ? ' style="top:' . esc_attr($label_position) . 'px;"' : '') . '>' . ((int)$animations ? '<div class="animated-element animation-slideLeft10">' : '') . '<span class="label-triangle"></span><label>' . $label . '</label>' . ((int)$animations ? '</div>' : '') . '<span class="timeline-circle' . ((int)$animations ? ' animated-element animation-scale' : '') . '"></span></div></div>';
		$output .= '<div class="label-container' . ($label_style!="default" ? ' white' : '') . '"><div><label>' . $label . '</label></div><span class="timeline-circle' . ((int)$animations ? ' animated-element animation-scale' . ((int)$animation_delay>0 ? ' delay-' . (int)esc_attr($animation_delay) : '') : '') . '"></span></div>';
	}
	if($title!="" || $content!="")
	{
		/*$output .= '<div class="timeline-content-container vertical-align-cell">
		<div class="flex-container animated-element animation-slideLeft10">
			<div class="timeline-arrow-container">
				<div class="timeline-arrow"></div>
			</div>
			<div class="timeline-content">';*/
		$output .= '<div class="timeline-content-container">
			<div class="timeline-content">';
		if($title!="")
			$output .= '<h4>' . $title . '</h4>';
		if($content!="")
			$output .= '<p>' . $content . '</p>';
		$output .= '</div></div>';
	}
	$output .= '</div>';
	return $output;
}


//wpbakery page builder
function gb_theme_timeline_item_vc_init()
{
	$params = array(
		array(
			"type" => "textfield",
			"class" => "",
			"heading" => __("Label", 'gymbase'),
			"param_name" => "label",
			"value" => ""
		),
		array(
			"type" => "dropdown",
			"class" => "",
			"heading" => __("Label style", 'gymbase'),
			"param_name" => "label_style",
			"value" => array(__("Default", 'gymbase') => "default", __("White", 'gymbase') => "white")
		),
		array(
			"type" => "textfield",
			"class" => "",
			"heading" => __("Title", 'gymbase'),
			"param_name" => "title",
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
			"type" => "dropdown",
			"class" => "",
			"heading" => __("Animations", 'gymbase'),
			"param_name" => "animations",
			"value" => array(__("Yes", 'gymbase') => 1, __("No", 'gymbase') => 0)
		),
		array(
			"type" => "textfield",
			"class" => "",
			"heading" => __("Animation delay", 'gymbase'),
			"param_name" => "animation_delay",
			"value" => 0
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
		"name" => __("Timeline Item", 'gymbase'),
		"base" => "timeline_item",
		"class" => "",
		"controls" => "full",
		"show_settings_on_create" => true,
		"icon" => "icon-wpb-layer-timeline-item",
		"category" => __('GymBase', 'gymbase'),
		"params" => $params
	));
}
add_action("init", "gb_theme_timeline_item_vc_init");
?>
