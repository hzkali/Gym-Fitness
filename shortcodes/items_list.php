<?php
//items list
function gb_theme_items_list($atts, $content)
{
	extract(shortcode_atts(array(
		"type" => "items",
		"visible" => "3",
		"list_header" => "",
		"header_type" => "h4",
		"bottom_border" => 1,
		"animation" => 1,
		"class" => "",
		"top_margin_header" => "none",
		"top_margin" => "none"
	), $atts));
	
	if($type=="simple" || $type=="normal")
	{
		$type = "items";
	}
	$output = "";
	if($type=="scrolling")
	{
		$output .= '<div class="clearfix scrolling-controls' . ($top_margin_header!="none" ? ' ' . esc_attr($top_margin_header) : '') . '">';
		if($list_header!="")
			$output .= '<div class="header-left">';
	}
	if($list_header!="")
		$output .= '<' . $header_type . ' class="box-header' . (!(int)$bottom_border ? ' no-border' : ((int)$animation ? ' animation-slide' : '')) . ($top_margin_header!="none" && $type!="scrolling" ? ' ' . esc_attr($top_margin_header) : '') . '">' . $list_header . '</' . $header_type . '>';
	if($type=="scrolling")
	{
		if($list_header!="")
			$output .= '</div>';
		$output .= '<div class="header-right">
			<a href="#" class="scrolling-list-control-left template-arrow-horizontal-3"></a>
			<a href="#" class="scrolling-list-control-right template-arrow-horizontal-3"></a>
		</div>
	</div>
	<div class="scrolling-list-wrapper"><div class="scrolling-list-fix-block"></div>';
	}
	$output .= '<ul class="' . esc_attr($type) . '-list alternate' . ($type=='scrolling' ? ' visible-' . esc_attr($visible) : '') . ($class!='' ? ' ' . esc_attr($class) : '') . ($top_margin!="none" ? ' ' . esc_attr($top_margin) : '') . '">' . wpb_js_remove_wpautop($content) . '</ul>';
	if($type=="scrolling")
		$output .= '</div>';
	return $output;
}

//item
function gb_theme_item($atts, $content)
{
	extract(shortcode_atts(array(
		"icon" => "",
		"class" => "",
		"value" => "",
		"url" => "",
		"url_target" => "",
		"border_color" => "none",
		"text_color" => "",
		"value_color" => ""
	), $atts));
	
	$output = '
	<li class="' . ($icon!="" ? ($icon!="" ? 'template-' . esc_attr($icon) . ' ': '') . ($class!="" ? esc_attr($class) . ' ' : '') : '') . ($border_color=='none' ? 'no-border ' : '') . 'clearfix"' . ($border_color!='' ? ' style="border-bottom: ' . ($border_color=='none' ? 'none' : '1px solid ' . esc_attr($border_color) . '') . ';"' : '') . '>';
		$output .= '<' . ($url!="" ? 'a href="' . esc_url($url) . '"' . ($url_target=='new_window' ? ' target="_blank"' : '') : 'span') . ($text_color!='' ? ' style="color: ' . esc_attr($text_color) . ';"' : '') . '>' . do_shortcode($content) . '</' . ($url!="" ? 'a' : 'span') . '>';
		if($value!=""  )
			$output .= '<div class="value"' . ($value_color!='' ? ' style="color: ' . esc_attr($value_color) . ';"' : '') . '>' . do_shortcode($value) . '</div>';
	$output .= '
	</li>';
	return $output;
}

//visual composer
vc_map( array(
	"name" => __("Items list", 'gymbase'),
	"base" => "items_list",
	"class" => "",
	"controls" => "full",
	"show_settings_on_create" => true,
	"icon" => "icon-wpb-layer-items-list",
	"category" => __('GymBase', 'gymbase'),
	"params" => array(
		array(
			"type" => "dropdown",
			"class" => "",
			"heading" => __("Type", 'gymbase'),
			"param_name" => "type",
			"value" => array(__("Items list", 'gymbase') => 'items', __("Scrolling list", 'gymbase') => 'scrolling')
		),
		array(
			"type" => "textfield",
			"class" => "",
			"heading" => __("Visible", 'gymbase'),
			"param_name" => "visible",
			"value" => "3",
			"dependency" => Array('element' => "type", 'value' => 'scrolling')
		),
		array(
			"type" => "textfield",
			"class" => "",
			"heading" => __("Header", 'gymbase'),
			"param_name" => "list_header",
			"value" => ""
		),
		array(
			"type" => "dropdown",
			"class" => "",
			"heading" => __("Header type", 'gymbase'),
			"param_name" => "header_type",
			"std" => "h4",
			"value" => array( __("H1", 'gymbase') => "h1", __("H2", 'gymbase') => "h2", __("H3", 'gymbase') => "h3", __("H4", 'gymbase') => "h4", __("H5", 'gymbase') => "h5")
		),
		array(
			"type" => "dropdown",
			"class" => "",
			"heading" => __("Header border", 'gymbase'),
			"param_name" => "bottom_border",
			"value" => array(__("yes", 'gymbase') => 1,  __("no", 'gymbase') => 0)
		),
		array(
			"type" => "dropdown",
			"class" => "",
			"heading" => __("Header border animation", 'gymbase'),
			"param_name" => "animation",
			"value" => array(__("yes", 'gymbase') => 1, __("no", 'gymbase') => 0),
			"dependency" => Array('element' => "bottom_border", 'value' => '1')
		),
		array(
			"type" => "dropdown",
			"class" => "",
			"heading" => __("Top margin header", 'gymbase'),
			"param_name" => "top_margin_header",
			"value" => array(__("None", 'gymbase') => "none", __("Page (small)", 'gymbase') => "page-margin-top", __("Section (large)", 'gymbase') => "page-margin-top-section")
		),
		array(
			"type" => "textarea_html",
			"holder" => "div",
			"class" => "",
			"heading" => __("Content", 'gymbase'),
			"param_name" => "content",
			"value" => ""
		),
		array(
			"type" => "listitem",
			"class" => "",
			"param_name" => "additembutton",
			"value" => __("Add list item", 'gymbase')
		),
		array(
			"type" => "listitemwindow",
			"class" => "",
			"param_name" => "additemwindow",
			"value" => ""
		),
		array(
			"type" => "dropdown",
			"class" => "",
			"heading" => __("Top margin", 'gymbase'),
			"param_name" => "top_margin",
			"value" => array(__("None", 'gymbase') => "none", __("Page (small)", 'gymbase') => "page-margin-top", __("Section (large)", 'gymbase') => "page-margin-top-section")
		),
		array(
			"type" => "textfield",
			"class" => "",
			"heading" => __("Extra class name", 'gymbase'),
			"param_name" => "class",
			"description" => __("Specifies the custom css class for the list.", 'gymbase'),
			"value" => ""
		)
	)
));
?>