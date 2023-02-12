<?php
//post
function gb_theme_timeline_carousel($atts, $content)
{
	extract(shortcode_atts(array(
		"id" => "timeline_carousel",
		"timeline_count" => 1,
		"autoplay" => 0,
		"pause_on_hover" => 1,
		"scroll" => 1,
		"effect" => "scroll",
		"easing" => "swing",
		"duration" => 500,
		"ontouch" => 0,
		"onmouse" => 0,
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
	
	$output = "";
	$output .= '<ul class="horizontal-carousel timeline-carousel' . ($top_margin!="none" ? ' ' . esc_attr($top_margin) : '') . ($el_class!="" ? ' ' . esc_attr($el_class) : '') . ' id-' . esc_attr($id) . ' autoplay-' . esc_attr($autoplay) . ' pause_on_hover-' . esc_attr($pause_on_hover) . ' scroll-' . esc_attr($scroll) . ' effect-' . esc_attr($effect) . ' easing-' . esc_attr($newEasing) . ' duration-' . esc_attr($duration) . ((int)$ontouch ? ' ontouch' : '') . ((int)$onmouse ? ' onmouse' : '') . '">';
	for($i=0; $i<$timeline_count; $i++)
	{
		$output .= '<li class="timeline-item">';
			if(!empty($atts["label" . $i]))
			{
				$output .= '<div class="label-container' . (isset($atts["label_style" . $i]) && $atts["label_style" . $i]=="white" ? ' white' : '') . '"><div><label>' . $atts["label" . $i] . '</label></div><span class="timeline-circle"></span></div>';
			}
		if($atts["title" . $i]!="" || $atts["content" . $i]!="")
		{
			$output .= '<div class="timeline-content-container">
				<div class="timeline-content">';
			if($atts["title" . $i]!="")
				$output .= '<h4>' . $atts["title" . $i] . '</h4>';
			if($atts["content" . $i]!="")
				$output .= '<p>' . $atts["content" . $i] . '</p>';
			$output .= '</div></div>';
		}
		$output .= '</li>';
	}
	$output .= '</ul>
	<ul class="clearfix controls">
		<li><a href="#" id="' . esc_attr($id) . '_prev" class="scrolling-list-control-left template-arrow-horizontal-7"></a></li>
		<li><a href="#" id="' . esc_attr($id) . '_next" class="scrolling-list-control-right template-arrow-horizontal-7"></a></li>
	</ul>';
	return $output;
}


//wpbakery page builder
function gb_theme_timeline_carousel_vc_init()
{
	$count = array();
	for($i=1; $i<=30; $i++)
		$count[$i] = $i;
	
	$params = array(
		array(
			"type" => "textfield",
			"class" => "",
			"heading" => __("Id", 'gymbase'),
			"param_name" => "id",
			"value" => "timeline_carousel",
			"description" => __("Please provide unique id for each timeline carousel on the same page/post", 'gymbase')
		),
		array(
			"type" => "dropdown",
			"class" => "",
			"heading" => __("Number of items", 'gymbase'),
			"param_name" => "timeline_count",
			"value" => $count
		)
	);
	for($i=0; $i<30; $i++)
	{
		$params[] = array(
			"type" => "textfield",
			"class" => "",
			"heading" => __("Label", 'gymbase') . " " . ($i+1),
			"param_name" => "label".$i,
			"value" => ""
		);
		$params[] = array(
			"type" => "dropdown",
			"class" => "",
			"heading" => __("Label style", 'gymbase') . " " . ($i+1),
			"param_name" => "label_style".$i,
			"value" => array(__("Default", 'gymbase') => "default", __("White", 'gymbase') => "white")
		);
		$params[] = array(
			"type" => "textfield",
			"class" => "",
			"heading" => __("Title", 'gymbase') . " " . ($i+1),
			"param_name" => "title".$i,
			"value" => ""
		);
		$params[] = array(
			"type" => "textarea",
			"holder" => "div",
			"class" => "",
			"heading" => __("Text", 'gymbase') . " " . ($i+1),
			"param_name" => "content".$i,
			"value" => ""
		);
	}
	$params = array_merge($params, array(
		array(
			"type" => "dropdown",
			"class" => "",
			"heading" => __("Autoplay", 'gymbase'),
			"param_name" => "autoplay",
			"value" => array(__("No", 'gymbase') => 0, __("Yes", 'gymbase') => 1)
		),
		array(
			"type" => "dropdown",
			"class" => "",
			"heading" => __("Pause on hover", 'gymbase'),
			"param_name" => "pause_on_hover",
			"value" => array(__("Yes", 'gymbase') => 1, __("No", 'gymbase') => 0),
			"dependency" => Array('element' => "autoplay", 'value' => '1')
		),
		array(
			"type" => "textfield",
			"class" => "",
			"heading" => __("Scroll", 'gymbase'),
			"param_name" => "scroll",
			"value" => 1,
			"description" => __("Number of items to scroll in one step", 'gymbase')
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
			)
		),
		array(
			"type" => "textfield",
			"class" => "",
			"heading" => __("Sliding transition speed (ms)", 'gymbase'),
			"param_name" => "duration",
			"value" => 500
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
	));
	
	vc_map( array(
		"name" => __("Timeline Carousel", 'gymbase'),
		"base" => "timeline_carousel",
		"class" => "",
		"controls" => "full",
		"show_settings_on_create" => true,
		"icon" => "icon-wpb-layer-timeline-item",
		"admin_enqueue_js"  => array(get_template_directory_uri().'/admin/js/timeline_carousel_vc.js'),
		"category" => __('GymBase', 'gymbase'),
		"params" => $params
	));
}
add_action("init", "gb_theme_timeline_carousel_vc_init");
?>
