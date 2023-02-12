<?php
//contact info - old shortcode for compatibility with old content
function gb_theme_contact_info($atts, $content)
{
	extract(shortcode_atts(array(
		"top_margin" => "page_margin_top"
	), $atts));
	return '<div class="contact_details ' . esc_attr($top_margin) . '">' . do_shortcode($content) . '</div>';
	
}

//contact info - new shortcode, compatible with VC
function gb_theme_contact_info_vc($atts, $content)
{
	extract(shortcode_atts(array(
		"id" => "map",
		"width" => "",
		"height" => "300px",
		"class" => "contact_details_map",
		"map_type" => "ROADMAP",
		"lat" => "-37.732304",
		"lng" => "144.868641",
		"marker_lat" => "-37.732304",
		"marker_lng" => "144.868641",
		"zoom" => "12",
		"scrollwheel" => "true",
		"streetviewcontrol" => "false",
		"maptypecontrol" => "false",
		"map_icon_url" => get_template_directory_uri() . "/images/map_pointer.png",
		"icon_width" => 29,
		"icon_height" => 38,
		"icon_anchor_x" => 14,
		"icon_anchor_y" => 37,
		"top_margin" => "page_margin_top"
	), $atts));
	
	// contact details shortcode, compatibility with old content
	$contact_details_shortcode = '[contact_details]' . preg_replace('#(\[[\/]?contact_details\]|\[gymbase_map[^\]]*\])#', '', $content) . '[/contact_details]';
	
	// google map shortcode
	if($id!="" && $lat!="" && $lng!="" && $marker_lat!="" && $marker_lng!="") {
		$map_shortcode = '[gymbase_map id="' . esc_attr($id) . '" width="' . esc_attr($width) . '" height="' . esc_attr($height) . '" class="' . esc_attr($class) . '" map_type="' . esc_attr($map_type) . '" lat="' . esc_attr($lat) . '" lng="' . esc_attr($lng) . '" marker_lat="' . esc_attr($marker_lat) . '" marker_lng="' . esc_attr($marker_lng) . '" zoom="' . esc_attr($zoom) . '" scrollwheel="' . esc_attr($scrollwheel) . '" streetviewcontrol="' . esc_attr($streetviewcontrol) . '" maptypecontrol="' . esc_attr($maptypecontrol) . '" map_icon_url="' . esc_attr($map_icon_url) . '" icon_width="' . esc_attr($icon_width) . '" icon_height="' . esc_attr($icon_height) . '" icon_anchor_x="' . esc_attr($icon_anchor_x) . '" icon_anchor_y="' . esc_attr($icon_anchor_y) . '"]';
	}
	
	return '<div class="contact_details ' . esc_attr($top_margin) . '">' . do_shortcode($contact_details_shortcode) . do_shortcode($map_shortcode) . '</div>';
}

//visual composer
function gb_theme_contact_info_vc_init()
{
	global $theme_options;
	vc_map( array(
		"name" => __("Contact Info [deprecated]", 'gymbase'),
		"base" => "contact_info_vc",
		"class" => "",
		"controls" => "full",
		"show_settings_on_create" => true,
		"icon" => "icon-wpb-layer-testimonials",
		"category" => __('GymBase', 'gymbase'),
		"deprecated" => "6.1",
		"params" => array(
			array(
				"type" => "readonly",
				"class" => "",
				"heading" => __("Google API Key", 'gymbase'),
				"param_name" => "api_key",
				"value" => $theme_options["google_api_code"],
				"description" => sprintf(__("Please provide valid Google API Key under <a href='%s' title='Theme Options'>Theme Options</a>", 'gymbase'), esc_url(admin_url("themes.php?page=ThemeOptions")))
			),
			array(
				"type" => "textarea",
				"class" => "",
				"heading" => __("Details", 'gymbase'),
				"param_name" => "content",
				"description" => __("Please provide your contact details, don't use shortcodes: [contact_details] [gymbase_map]", 'gymbase'),
				"value" => ""
			),
			array(
				"type" => "textfield",
				"class" => "",
				"heading" => __("Id", 'gymbase'),
				"param_name" => "id",
				"value" => "map",
				"description" => __("Please provide unique id for each map on the same page/post", 'gymbase')
			),
			array(
				"type" => "textfield",
				"class" => "",
				"heading" => __("Class", 'gymbase'),
				"param_name" => "class",
				"value" => "contact_details_map",
				"description" => __("Specifies custom class for the map container.", 'gymbase')
			),
			array(
				"type" => "dropdown",
				"class" => "",
				"heading" => __("Map type", 'gymbase'),
				"param_name" => "map_type",
				"value" => array(__("Roadmap", 'gymbase') => "ROADMAP", __("Satellite", 'gymbase') => "SATELLITE", __("Hybrid", 'gymbase') => "HYBRID", __("Terrain", 'gymbase') => "TERRAIN")
			),
			array(
				"type" => "textfield",
				"class" => "",
				"heading" => __("Latitude", 'gymbase'),
				"param_name" => "lat",
				"value" => "-37.732304",
				"description" => __("You can use this <a href='http://www.birdtheme.org/useful/v3tool.html' target='_blank'>http://www.birdtheme.org/useful/v3tool.html</a> tool to designate coordinates", 'gymbase')
			),
			array(
				"type" => "textfield",
				"class" => "",
				"heading" => __("Longitude", 'gymbase'),
				"param_name" => "lng",
				"value" => "144.868641",
				"description" => __("You can use this <a href='http://www.birdtheme.org/useful/v3tool.html' target='_blank'>http://www.birdtheme.org/useful/v3tool.html</a> tool to designate coordinates", 'gymbase')
			),
			array(
				"type" => "textfield",
				"class" => "",
				"heading" => __("Marker/Point Latitude", 'gymbase'),
				"param_name" => "marker_lat",
				"value" => "-37.732304",
				"description" => __("You can use this <a href='http://www.birdtheme.org/useful/v3tool.html' target='_blank'>http://www.birdtheme.org/useful/v3tool.html</a> tool to designate coordinates", 'gymbase')
			),
			array(
				"type" => "textfield",
				"class" => "",
				"heading" => __("Marker/point Longitude", 'gymbase'),
				"param_name" => "marker_lng",
				"value" => "144.868641",
				"description" => __("You can use this <a href='http://www.birdtheme.org/useful/v3tool.html' target='_blank'>http://www.birdtheme.org/useful/v3tool.html</a> tool to designate coordinates", 'gymbase')
			),
			array(
				"type" => "dropdown",
				"heading" => __("Map Zoom", "gymbase"),
				"param_name" => "zoom",
				"value" => array(__("12 - Default", "gymbase") => 12, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 13, 14, 15, 16, 17, 18, 19, 20)
			),
			array(
				"type" => "dropdown",
				"class" => "",
				"heading" => __("Street view control", 'gymbase'),
				"param_name" => "streetviewcontrol",
				"value" => array(__("no", 'gymbase') => "false", __("yes", 'gymbase') => "true")
			),
			array(
				"type" => "dropdown",
				"class" => "",
				"heading" => __("Enable scrollwheel", 'gymbase'),
				"param_name" => "scrollwheel",
				"value" => array(__("yes", 'gymbase') => "true", __("no", 'gymbase') => "false")
			),
			array(
				"type" => "dropdown",
				"class" => "",
				"heading" => __("Map type control", 'gymbase'),
				"param_name" => "maptypecontrol",
				"value" => array(__("no", 'gymbase') => "false", __("yes", 'gymbase') => "true")
			),
			array(
				"type" => "textfield",
				"class" => "",
				"heading" => __("Marker/Point icon url", 'gymbase'),
				"param_name" => "map_icon_url",
				"value" => get_template_directory_uri() . "/images/map_pointer.png"
			),
			array(
				"type" => "textfield",
				"class" => "",
				"heading" => __("Icon width", 'gymbase'),
				"param_name" => "icon_width",
				"value" => 29
			),
			array(
				"type" => "textfield",
				"class" => "",
				"heading" => __("Icon height", 'gymbase'),
				"param_name" => "icon_height",
				"value" => 38
			),
			array(
				"type" => "textfield",
				"class" => "",
				"heading" => __("Icon anchor x", 'gymbase'),
				"param_name" => "icon_anchor_x",
				"value" => 14
			),
			array(
				"type" => "textfield",
				"class" => "",
				"heading" => __("Icon anchor y", 'gymbase'),
				"param_name" => "icon_anchor_y",
				"value" => 37
			),
			array(
				"type" => "dropdown",
				"class" => "",
				"heading" => __("Top margin", 'gymbase'),
				"param_name" => "top_margin",
				"value" => array( __("Page (small)", 'gymbase') => "page_margin_top", __("Section (large)", 'gymbase') => "page_margin_top_section", __("None", 'gymbase') => "page_margin_top_none")
			)
		)
	));
}
add_action("init", "gb_theme_contact_info_vc_init");

//google map details
function gb_theme_contact_details($atts, $content)
{
	global $theme_options;
	
	$output = '<div class="contact_details_about">';
	if($theme_options["contact_logo_first_part_text"]!="")
		$output .= '<span class="logo-left">' . $theme_options["contact_logo_first_part_text"] . '</span>';
	if($theme_options["contact_logo_second_part_text"]!="")
		$output .= '<span class="logo-right">' . $theme_options["contact_logo_second_part_text"] . '</span>';
	$output .= do_shortcode(apply_filters('the_content', $content));
	if($theme_options["contact_phone"]!="" || $theme_options["contact_fax"]!="" || $theme_options["contact_email"]!="")
		$output .= '<ul class="contact_data">'
			. ($theme_options["contact_phone"]!="" ? '<li class="template-mobile">' . $theme_options["contact_phone"] . '</li>' : '')
			. ($theme_options["contact_fax"]!="" ? '<li class="template-mobile">' . $theme_options["contact_fax"] . '</li>' : '')		
			. ($theme_options["contact_email"]!="" ? '<li class="template-email">' . $theme_options["contact_email"] . '</li>' : '')				
		. '</ul>';
	$output .= '</div>';
	return $output;
}

//google map
function gb_theme_map_shortcode($atts)
{
	extract(shortcode_atts(array(
		"id" => "map",
		"width" => "100%",
		"height" => "480px",
		"class" => "contact-details-map",
		"map_type" => "ROADMAP",
		"lat" => "48.785438",
		"lng" => "2.463482",
		"marker_lat" => "48.785438",
		"marker_lng" => "2.463482",
		"zoom" => "12",
		"scrollwheel" => "true",
		"streetviewcontrol" => "false",
		"maptypecontrol" => "false",
		"mapstyles" => "gymbase",
		"map_icon_url" => get_template_directory_uri() . "/images/map_pointer.png",
		"icon_width" => 34,
		"icon_height" => 47,
		"icon_anchor_x" => 17,
		"icon_anchor_y" => 47,
		"top_margin" => "none"
	), $atts));
	wp_enqueue_script("google-maps-v3");
	$map_type = strtoupper($map_type);
	$width = (substr($width, -1)!="%" && substr($width, -2)!="px" ? $width . "px" : $width);
	$height = (substr($height, -1)!="%" && substr($height, -2)!="px" ? $height . "px" : $height);
	$output = "<div id='" . esc_attr($id) . "'" . ($width!="" || $height!="" ? " style='" . ($width!="" ? "width:" . esc_attr($width) . ";" : "") . ($height!="" ? "height:" . esc_attr($height) . ";" : "") . "'" : "") . " class='" . ($class!="" ? " " . esc_attr($class) : "") . ($top_margin!="none" ? ' ' . esc_attr($top_margin) : '') . "'></div>";
	$script = "if(typeof(theme_google_maps)=='undefined') 
	{
		var theme_google_maps=[];
	}
	var map_$id = null;
	var coordinate_$id;
	try
    {
        coordinate_$id=new google.maps.LatLng($lat, $lng);
        var mapOptions= 
        {
            zoom:$zoom,
			scrollwheel: $scrollwheel,
            center:coordinate_$id,
            mapTypeId:google.maps.MapTypeId.$map_type,
			streetViewControl:$streetviewcontrol,
			mapTypeControl:$maptypecontrol
        };
		if('$mapstyles'=='gymbase')
		{
			mapOptions.styles = [{'elementType': 'geometry','stylers': [{'color': '#343436'}]},{'elementType': 'labels.icon','stylers': [{'visibility': 'off'}]},{'elementType': 'labels.text.fill','stylers': [{'color': '#999999'}]},{'elementType': 'labels.text.stroke','stylers': [{'color': '#222224'}]},{'featureType': 'administrative.land_parcel','stylers': [{'visibility': 'off'}]},{'featureType': 'road','elementType': 'geometry.fill','stylers': [{'color': '#222224'}]},{'featureType': 'road','elementType': 'labels.text.fill','stylers': [{'color': '#8a8a8a'}]},{'featureType': 'water','elementType': 'geometry','stylers': [{'color': '#222224'}]},{'featureType': 'water','elementType': 'labels.text.fill','stylers': [{'visibility': 'off'}]}];
		}
        var map_$id = new google.maps.Map(document.getElementById('$id'),mapOptions);
		theme_google_maps.push({map: map_$id, coordinate: coordinate_$id});";
	if($marker_lat!="" && $marker_lng!="")
	{
	$script .= "
		var marker_$id = new google.maps.Marker({
			position: new google.maps.LatLng($marker_lat, $marker_lng),
			map: map_$id" . ($map_icon_url!="" ? ", icon: new google.maps.MarkerImage('$map_icon_url', new google.maps.Size($icon_width, $icon_height), null, new google.maps.Point($icon_anchor_x, $icon_anchor_y))" : "") . "
		});";
		/*var infowindow = new google.maps.InfoWindow();
		infowindow.setContent('<p style=\'color:#000;\'>your html content</p>');
		infowindow.open(map_$id,marker_$id);*/
	}
	$script .= "
    }
    catch(e) {};
	jQuery(document).ready(function($){
		$(window).resize(function(){
			if(map_$id!=null)
				map_$id.setCenter(coordinate_$id);
		});
	});";
	wp_add_inline_script("google-maps-v3", $script);
	return $output;
}

//visual composer
function gb_theme_google_map_vc_init()
{
	global $theme_options;
	vc_map( array(
		"name" => __("Google map", 'gymbase'),
		"base" => "gymbase_map",
		"class" => "",
		"controls" => "full",
		"show_settings_on_create" => true,
		"icon" => "icon-wpb-map-pin",
		"category" => __('GymBase', 'gymbase'),
		"params" => array(
			array(
				"type" => "readonly",
				"class" => "",
				"heading" => __("Google API Key", 'gymbase'),
				"param_name" => "api_key",
				"value" => $theme_options["google_api_code"],
				"description" => sprintf(__("Please provide valid Google API Key under <a href='%s' title='Theme Options'>Theme Options</a>", 'gymbase'), esc_url(admin_url("themes.php?page=ThemeOptions")))
			),
			array(
				"type" => "textfield",
				"class" => "",
				"heading" => __("Id", 'gymbase'),
				"param_name" => "id",
				"value" => "map",
				"description" => __("Please provide unique id for each map on the same page/post", 'gymbase')
			),
			array(
				"type" => "textfield",
				"class" => "",
				"heading" => __("Width", 'gymbase'),
				"param_name" => "width",
				"value" => "100%"
			),
			array(
				"type" => "textfield",
				"class" => "",
				"heading" => __("Height", 'gymbase'),
				"param_name" => "height",
				"value" => "480px"
			),
			array(
				"type" => "textfield",
				"class" => "",
				"heading" => __("Class", 'gymbase'),
				"param_name" => "class",
				"value" => "contact-details-map",
				"description" => __("Specifies custom class for the map container.", 'gymbase')
			),
			array(
				"type" => "dropdown",
				"class" => "",
				"heading" => __("Map type", 'gymbase'),
				"param_name" => "map_type",
				"value" => array(__("Roadmap", 'gymbase') => "ROADMAP", __("Satellite", 'gymbase') => "SATELLITE", __("Hybrid", 'gymbase') => "HYBRID", __("Terrain", 'gymbase') => "TERRAIN")
			),
			array(
				"type" => "textfield",
				"class" => "",
				"heading" => __("Latitude", 'gymbase'),
				"param_name" => "lat",
				"value" => "48.785438",
				"description" => __("You can use this <a href='http://www.birdtheme.org/useful/v3tool.html' target='_blank'>http://www.birdtheme.org/useful/v3tool.html</a> tool to designate coordinates", 'gymbase')
			),
			array(
				"type" => "textfield",
				"class" => "",
				"heading" => __("Longitude", 'gymbase'),
				"param_name" => "lng",
				"value" => "2.463482",
				"description" => __("You can use this <a href='http://www.birdtheme.org/useful/v3tool.html' target='_blank'>http://www.birdtheme.org/useful/v3tool.html</a> tool to designate coordinates", 'gymbase')
			),
			array(
				"type" => "textfield",
				"class" => "",
				"heading" => __("Marker/Point Latitude", 'gymbase'),
				"param_name" => "marker_lat",
				"value" => "48.785438",
				"description" => __("You can use this <a href='http://www.birdtheme.org/useful/v3tool.html' target='_blank'>http://www.birdtheme.org/useful/v3tool.html</a> tool to designate coordinates", 'gymbase')
			),
			array(
				"type" => "textfield",
				"class" => "",
				"heading" => __("Marker/point Longitude", 'gymbase'),
				"param_name" => "marker_lng",
				"value" => "2.463482",
				"description" => __("You can use this <a href='http://www.birdtheme.org/useful/v3tool.html' target='_blank'>http://www.birdtheme.org/useful/v3tool.html</a> tool to designate coordinates", 'gymbase')
			),
			array(
				"type" => "dropdown",
				"heading" => __("Map Zoom", "gymbase"),
				"param_name" => "zoom",
				"value" => array(1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20),
				"std" => 15
			),
			array(
				"type" => "dropdown",
				"class" => "",
				"heading" => __("Street view control", 'gymbase'),
				"param_name" => "streetviewcontrol",
				"value" => array(__("no", 'gymbase') => "false", __("yes", 'gymbase') => "true")
			),
			array(
				"type" => "dropdown",
				"class" => "",
				"heading" => __("Enable scrollwheel", 'gymbase'),
				"param_name" => "scrollwheel",
				"value" => array(__("yes", 'gymbase') => "true", __("no", 'gymbase') => "false")
			),
			array(
				"type" => "dropdown",
				"class" => "",
				"heading" => __("Map type control", 'gymbase'),
				"param_name" => "maptypecontrol",
				"value" => array(__("no", 'gymbase') => "false", __("yes", 'gymbase') => "true")
			),
			array(
				"type" => "dropdown",
				"class" => "",
				"heading" => __("Map styles", 'gymbase'),
				"param_name" => "mapstyles",
				"value" => array(__("GymBase styled map", 'gymbase') => "gymbase", __("Default Google map", 'gymbase') => "default")
			),
			array(
				"type" => "textfield",
				"class" => "",
				"heading" => __("Marker/Point icon url", 'gymbase'),
				"param_name" => "map_icon_url",
				"value" => get_template_directory_uri() . "/images/map_pointer.png"
			),
			array(
				"type" => "textfield",
				"class" => "",
				"heading" => __("Icon width", 'gymbase'),
				"param_name" => "icon_width",
				"value" => 34
			),
			array(
				"type" => "textfield",
				"class" => "",
				"heading" => __("Icon height", 'gymbase'),
				"param_name" => "icon_height",
				"value" => 47
			),
			array(
				"type" => "textfield",
				"class" => "",
				"heading" => __("Icon anchor x", 'gymbase'),
				"param_name" => "icon_anchor_x",
				"value" => 17
			),
			array(
				"type" => "textfield",
				"class" => "",
				"heading" => __("Icon anchor y", 'gymbase'),
				"param_name" => "icon_anchor_y",
				"value" => 47
			),
			array(
				"type" => "dropdown",
				"class" => "",
				"heading" => __("Top margin", 'gymbase'),
				"param_name" => "top_margin",
				"value" => array(__("None", 'gymbase') => "none", __("Page (small)", 'gymbase') => "page-margin-top", __("Section (large)", 'gymbase') => "page-margin-top-section")
			)
		)
	));
}
add_action("init", "gb_theme_google_map_vc_init");

?>