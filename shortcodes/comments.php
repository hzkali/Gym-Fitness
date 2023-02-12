<?php
//comments component
function gb_theme_comments($atts)
{
	global $terms_checkbox;
	global $terms_message;
	global $top_margin;
	extract(shortcode_atts(array(
		"show_comments_form" => 1,
		"show_comments_list" => 1,
		"terms_checkbox" => 0,
		"terms_message" => "UGxlYXNlJTIwYWNjZXB0JTIwdGVybXMlMjBhbmQlMjBjb25kaXRpb25z",
		"top_margin" => "none"
	), $atts));
	
	$output = "";
	if((int)$show_comments_list)
	{
		$output .= '<div class="comments-list-container clearfix' . ($top_margin!='none' ? ' ' . esc_attr($top_margin) : '') . '">';
		ob_start();
		comments_template();
		$output .= ob_get_contents();
		ob_end_clean();
		$output .= '</div>';
	}
	if((int)$show_comments_form)
	{
		ob_start();
		gb_get_theme_file("/comments-form.php");
		$output .= ob_get_contents();
		ob_end_clean();
	}
	return $output;
}

//visual composer
function gb_theme_comments_vc_init()
{
	global $theme_options;
	vc_map( array(
		"name" => __("Comments", 'gymbase'),
		"base" => "comments",
		"class" => "",
		"controls" => "full",
		"show_settings_on_create" => true,
		"icon" => "icon-wpb-layer-testimonials",
		"category" => __('GymBase', 'gymbase'),
		"params" => array(
			array(
				"type" => "dropdown",
				"class" => "",
				"heading" => __("Show comments form", 'gymbase'),
				"param_name" => "show_comments_form",
				"value" => array(__("Yes", 'gymbase') => 1, __("No", 'gymbase') => 0)
			),
			array(
				"type" => "dropdown",
				"class" => "",
				"heading" => __("Terms and conditions checkbox", 'gymbase'),
				"param_name" => "terms_checkbox",
				"value" => array(__("Yes", 'gymbase') => 1, __("No", 'gymbase') => 0),
				"std" => 0,
				"dependency" => Array('element' => "show_comments_form", 'value' => "1")
			),
			array(
				"type" => "textarea_raw_html",
				"class" => "",
				"heading" => __("Terms and conditions message", 'gymbase'),
				"param_name" => "terms_message",
				"value" => "UGxlYXNlJTIwYWNjZXB0JTIwdGVybXMlMjBhbmQlMjBjb25kaXRpb25z",
				"dependency" => Array('element' => "terms_checkbox", 'value' => "1")
			),
			array(
				"type" => "readonly",
				"class" => "",
				"heading" => __("reCaptcha", 'gymbase'),
				"param_name" => "recaptcha",
				"value" => ((int)$theme_options["google_recaptcha_comments"] ? __("Yes", 'gymbase') : __("No", 'gymbase')),
				"description" => sprintf(__("You can change this setting under <a href='%s' title='Theme Options'>Theme Options</a>", 'gymbase'), esc_url(admin_url("themes.php?page=ThemeOptions"))),
				"dependency" => Array('element' => "show_comments_form", 'value' => "1")
			),
			array(
				"type" => "dropdown",
				"class" => "",
				"heading" => __("Show comments list", 'gymbase'),
				"param_name" => "show_comments_list",
				"value" => array(__("Yes", 'gymbase') => 1, __("No", 'gymbase') => 0)
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
add_action("init", "gb_theme_comments_vc_init");