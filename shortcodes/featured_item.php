<?php
//post
function gb_theme_featured_item($atts, $content)
{
	extract(shortcode_atts(array(
		"icon" => "none",
		"title" => "",
		"number" => "",
		"url" => "",
		"title_link" => 1,
		"title_border" => 1,
		"icon_link" => 1,
		"icon_color" => "default",
		"clickable_box" => 0,
		"hover_background" => 1,
		"align" => "left",
		"class" => "",
		"top_margin" => "none"
	), $atts));
	
	$output = "";
	if(!empty($number) ? ' feature-item-number' : '')
	{
		$output .= '<div class="feature-item-container">';
	}
	$output .= '<div class="feature-item' . (!empty($number) ? ' feature-item-number' : '') . ((int)$clickable_box ? ' feature-item-clickable-box' : '') . ((int)$hover_background ? ' feature-item-hover-background' : '') . ($align!="left" ? ' align-' . esc_attr($align) : '') . ($class!="" ? ' ' . esc_attr($class) : '') . ($top_margin!="none" ? ' ' . esc_attr($top_margin) : '') . '"' . ((int)$clickable_box && !empty($url) ? ' data-url="' . esc_attr($url) . '"' : '') . '>';
	if(!empty($number))
		$output .= '<span class="list-number number animated-element" data-value="' . esc_attr((int)$number) . '">0</span>';
	if(!empty($url) && (int)$icon_link && $icon!="" && $icon!="none")
		$output .= '<a href="' . esc_url($url) . '" class="feature-item-icon-url">&nbsp;</a>';
	if($icon!="" && $icon!="none")
		$output .= '<div class="icon features-' . esc_attr($icon) . ($icon_color=="white" ? ' white' : '') . '"></div>';
	if($title!="")
		$output .= '<h4' . ((int)$title_border ? ' class="with-border"' : '') . '>' . (!empty($url) && (int)$title_link ? '<a href="' . esc_url($url) . '">' : '') . $title . (!empty($url) && (int)$title_link ? '</a>' : '') . '</h4>';
	if($content!="")
		$output .= '<p>' . wpb_js_remove_wpautop($content) . '</p>';
	$output .= '</div>';
	if(!empty($number) ? ' feature-item-number' : '')
	{
		$output .= '</div>';
	}
	return $output;
}


//visual composer
function gb_theme_featured_item_vc_init()
{
	$params = array(
		array(
			"type" => "dropdown",
			"class" => "",
			"heading" => __("Icon", 'gymbase'),
			"param_name" => "icon",
			"value" => array(
				__("none", 'gymbase') => "none",
				__("address", 'gymbase') => "address",
				__("app", 'gymbase') => "app",
				__("apple", 'gymbase') => "apple",
				__("arrows", 'gymbase') => "arrows",
				__("bar-graph", 'gymbase') => "bar-graph",
				__("battery", 'gymbase') => "battery",
				__("bicycle", 'gymbase') => "bicycle",
				__("book", 'gymbase') => "book",
				__("box", 'gymbase') => "box",
				__("boxing", 'gymbase') => "boxing",
				__("brain", 'gymbase') => "brain",
				__("briefcase", 'gymbase') => "briefcase",
				__("burns", 'gymbase') => "burns",
				__("calendar-info", 'gymbase') => "calendar-info",
				__("calendar-plus", 'gymbase') => "calendar-plus",
				__("calendar-tick", 'gymbase') => "calendar-tick",
				__("cart", 'gymbase') => "cart",
				__("certificate", 'gymbase') => "certificate",
				__("chart-1", 'gymbase') => "chart-1",
				__("chart-2", 'gymbase') => "chart-2",
				__("chat", 'gymbase') => "chat",
				__("clock", 'gymbase') => "clock",
				__("config", 'gymbase') => "config",
				__("coupon", 'gymbase') => "coupon",
				__("credit-card", 'gymbase') => "credit-card",
				__("cross", 'gymbase') => "cross",
				__("cycling", 'gymbase') => "cycling",
				__("diary", 'gymbase') => "diary",
				__("dna", 'gymbase') => "dna",
				__("document", 'gymbase') => "document",
				__("document-missing", 'gymbase') => "document-missing",
				__("drink", 'gymbase') => "drink",
				__("dumbbell-1", 'gymbase') => "dumbbell-1",
				__("dumbbell-2", 'gymbase') => "dumbbell-2",
				__("email", 'gymbase') => "email",
				__("facebook", 'gymbase') => "facebook",
				__("first-aid", 'gymbase') => "first-aid",
				__("gallery", 'gymbase') => "gallery",
				__("glasses", 'gymbase') => "glasses",
				__("graph", 'gymbase') => "graph",
				__("group-1", 'gymbase') => "group-1",
				__("group-2", 'gymbase') => "group-2",
				__("gym-1", 'gymbase') => "gym-1",
				__("gym-2", 'gymbase') => "gym-2",
				__("hand-grip", 'gymbase') => "hand-grip",
				__("hand-squeezer", 'gymbase') => "hand-squeezer",
				__("heart", 'gymbase') => "heart",
				__("heart-beat", 'gymbase') => "heart-beat",
				__("home", 'gymbase') => "home",
				__("id-1", 'gymbase') => "id-1",
				__("id-2", 'gymbase') => "id-2",
				__("id-3", 'gymbase') => "id-3",
				__("image", 'gymbase') => "image",
				__("keyboard", 'gymbase') => "keyboard",
				__("lab", 'gymbase') => "lab",
				__("laptop", 'gymbase') => "laptop",
				__("leaf", 'gymbase') => "leaf",
				__("lifeline", 'gymbase') => "lifeline",
				__("list", 'gymbase') => "list",
				__("location", 'gymbase') => "location",
				__("lock", 'gymbase') => "lock",
				__("lockers", 'gymbase') => "lockers",
				__("map", 'gymbase') => "map",
				__("martial-art", 'gymbase') => "martial-art",
				__("medical-bed", 'gymbase') => "medical-bed",
				__("medical-document", 'gymbase') => "medical-document",
				__("medical-results", 'gymbase') => "medical-results",
				__("minus", 'gymbase') => "minus",
				__("mobile", 'gymbase') => "mobile",
				__("money", 'gymbase') => "money",
				__("movie", 'gymbase') => "movie",
				__("muscle", 'gymbase') => "muscle",
				__("network", 'gymbase') => "network",
				__("paypal", 'gymbase') => "paypal",
				__("pen", 'gymbase') => "pen",
				__("people", 'gymbase') => "people",
				__("percent", 'gymbase') => "percent",
				__("phone", 'gymbase') => "phone",
				__("pill", 'gymbase') => "pill",
				__("pin", 'gymbase') => "pin",
				__("pingpong", 'gymbase') => "pingpong",
				__("play", 'gymbase') => "play",
				__("plus", 'gymbase') => "plus",
				__("presentation", 'gymbase') => "presentation",
				__("printer", 'gymbase') => "printer",
				__("protein", 'gymbase') => "protein",
				__("pulse", 'gymbase') => "pulse",
				__("scale", 'gymbase') => "scale",
				__("science", 'gymbase') => "science",
				__("screen", 'gymbase') => "screen",
				__("shower", 'gymbase') => "shower",
				__("signpost", 'gymbase') => "signpost",
				__("sneakers", 'gymbase') => "sneakers",
				__("soccer", 'gymbase') => "soccer",
				__("spa", 'gymbase') => "spa",
				__("spa-bamboo", 'gymbase') => "spa-bamboo",
				__("spa-lotion", 'gymbase') => "spa-lotion",
				__("speaker", 'gymbase') => "speaker",
				__("squash", 'gymbase') => "squash",
				__("stopwatch", 'gymbase') => "stopwatch",
				__("tablet", 'gymbase') => "tablet",
				__("tags", 'gymbase') => "tags",
				__("tennis", 'gymbase') => "tennis",
				__("test-tube", 'gymbase') => "test-tube",
				__("tick", 'gymbase') => "tick",
				__("time", 'gymbase') => "time",
				__("twitter", 'gymbase') => "twitter",
				__("video", 'gymbase') => "video",
				__("wallet", 'gymbase') => "wallet",
				__("weightlifting", 'gymbase') => "weightlifting",
				__("youtube", 'gymbase') => "youtube"
			)
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
			"type" => "textfield",
			"class" => "",
			"heading" => __("Number value", 'gymbase'),
			"param_name" => "number",
			"value" => ""
		),
		array(
			"type" => "textfield",
			"class" => "",
			"heading" => __("Url", 'gymbase'),
			"param_name" => "url",
			"value" => ""
		),
		array(
			"type" => "dropdown",
			"class" => "",
			"heading" => __("Title link", 'gymbase'),
			"param_name" => "title_link",
			"value" => array(__("Yes", 'gymbase') => 1, __("No", 'gymbase') => 0)
		),
		array(
			"type" => "dropdown",
			"class" => "",
			"heading" => __("Title border", 'gymbase'),
			"param_name" => "title_border",
			"value" => array(__("Yes", 'gymbase') => 1, __("No", 'gymbase') => 0)
		),
		array(
			"type" => "dropdown",
			"class" => "",
			"heading" => __("Icon link", 'gymbase'),
			"param_name" => "icon_link",
			"value" => array(__("Yes", 'gymbase') => 1, __("No", 'gymbase') => 0)
		),
		array(
			"type" => "dropdown",
			"class" => "",
			"heading" => __("Icon color", 'gymbase'),
			"param_name" => "icon_color",
			"value" => array(__("Default", 'gymbase') => "default", __("White", 'gymbase') => "white")
		),
		array(
			"type" => "dropdown",
			"class" => "",
			"heading" => __("Clickable box", 'gymbase'),
			"param_name" => "clickable_box",
			"value" => array(__("Yes", 'gymbase') => 1, __("No", 'gymbase') => 0),
			"std" => 0
		),
		array(
			"type" => "dropdown",
			"class" => "",
			"heading" => __("White background on hover", 'gymbase'),
			"param_name" => "hover_background",
			"value" => array(__("Yes", 'gymbase') => 1, __("No", 'gymbase') => 0),
			"description" => __("Works only under bordered columns section", 'gymbase')
		),
		array(
			"type" => "dropdown",
			"class" => "",
			"heading" => __("Align", 'gymbase'),
			"param_name" => "align",
			"value" => array(__("Left", 'gymbase') => "left", __("Center", 'gymbase') => "center", __("Right", 'gymbase') => "right")
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
		"name" => __("Featured Item", 'gymbase'),
		"base" => "featured_item",
		"class" => "",
		"controls" => "full",
		"show_settings_on_create" => true,
		"icon" => "icon-wpb-layer-features-list",
		"category" => __('GymBase', 'gymbase'),
		"params" => $params
	));
}
add_action("init", "gb_theme_featured_item_vc_init");
?>
