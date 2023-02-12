<?php
//slider
gb_get_theme_file("/shortcodes/slider.php");
//blog
gb_get_theme_file("/shortcodes/blog.php");
//single post
gb_get_theme_file("/shortcodes/single-post.php");
//comments
gb_get_theme_file("/shortcodes/comments.php");
if(is_plugin_active('gymbase_trainers/gymbase_trainers.php'))
{
	//trainer
	gb_get_theme_file("/shortcodes/single-trainer.php");
}
if(is_plugin_active('gymbase_classes/gymbase_classes.php'))
{
	//class
	gb_get_theme_file("/shortcodes/single-class.php");
}
if(is_plugin_active('gymbase_galleries/gymbase_galleries.php'))
{
	//gallery
	gb_get_theme_file("/shortcodes/single-gymbase_gallery.php");
}
//items_list
gb_get_theme_file("/shortcodes/items_list.php");
//featured item
gb_get_theme_file("/shortcodes/featured_item.php");
//testimonials
gb_get_theme_file("/shortcodes/testimonials.php");
//our clients
gb_get_theme_file("/shortcodes/our_clients_carousel.php");
//timetable
gb_get_theme_file("/shortcodes/timetable.php");
//map
gb_get_theme_file("/shortcodes/map.php");
//counter box
gb_get_theme_file("/shortcodes/counter_box.php");
//timeline item
gb_get_theme_file("/shortcodes/timeline_item.php");
//timeline carousel
gb_get_theme_file("/shortcodes/timeline_carousel.php");
//icon
gb_get_theme_file("/shortcodes/icon.php");
//cart icon
gb_get_theme_file("/shortcodes/cart_icon.php");

//row inner
$attributes = array(
	array(
		"type" => "dropdown",
		"class" => "",
		"heading" => __("Type", 'gymbase'),
		"param_name" => "type",
		"value" => array(__("Default", 'gymbase') => "",  __("Full width", 'gymbase') => "full-width", __("Paralax background", 'gymbase') => "full-width mc-parallax", __("Paralax background with overlay", 'gymbase') => "full-width gb-parallax gb-overlay", __("Counter boxes container", 'gymbase') => "counters-group", __("Cost calculator form", 'gymbase') => "cost-calculator-container"),
		"description" => __("Select row type", "gymbase")
	),
	array(
		"type" => "textfield",
		"heading" => __("Form action url", 'gymbase'),
		"param_name" => "action",
		"dependency" => Array('element' => "type", 'value' => "cost-calculator-container")
	),
	array(
		"type" => "dropdown",
		"class" => "",
		"heading" => __("Top margin", 'gymbase'),
		"param_name" => "top_margin",
		"value" => array(__("None", 'gymbase') => "none",  __("Page (small)", 'gymbase') => "page-margin-top", __("Section (large)", 'gymbase') => "page-margin-top-section"),
		"description" => __("Select top margin value for your row", "gymbase")
	)
);
vc_add_params('vc_row_inner', $attributes);

$attributes = array(
	array(
		"type" => "dropdown",
		"class" => "",
		"heading" => __("GymBase navigation indicator", 'gymbase'),
		"param_name" => "gb_navigation",
		"value" => array(__("Enable", 'gymbase') => "1",  __("Disable", 'gymbase') => "0")
	)
);
vc_add_params('rev_slider_vc', $attributes);

//tabs
$attributes = array(
	array(
		"type" => "dropdown",
		"class" => "",
		"heading" => __("Type", 'gymbase'),
		"param_name" => "type",
		"value" => array(__("Vertical", 'gymbase') => "vertical",  __("Horizontal", 'gymbase') => "horizontal")
	)
);
vc_add_params('vc_tabs', $attributes);
vc_add_params('vc_nested_tabs', $attributes);
//accordion
$attributes = array(
	array(
		"type" => "textfield",
		"class" => "",
		"heading" => __("Subtitle", 'gymbase'),
		"param_name" => "subtitle",
		"value" => ""
	)
);
vc_add_params('vc_accordion_tab', $attributes);

//row
vc_map( array(
	'name' => __( 'Row', 'gymbase' ),
	'base' => 'vc_row',
	'is_container' => true,
	'icon' => 'icon-wpb-row',
	'show_settings_on_create' => false,
	'category' => __( 'Content', 'gymbase' ),
	'class' => 'vc_main-sortable-element',
	'description' => __( 'Place content elements inside the row', 'gymbase' ),
	'params' => array(
		array(
			"type" => "dropdown",
			"class" => "",
			"heading" => __("Type", 'gymbase'),
			"param_name" => "type",
			"value" => array(__("Default", 'gymbase') => "", __("Full width", 'gymbase') => "full-width", __("Paralax background", 'gymbase') => "full-width gb-parallax", __("Paralax background with overlay", 'gymbase') => "full-width gb-parallax gb-overlay", __("Counter boxes container", 'gymbase') => "counters-group", __("Cost calculator form", 'gymbase') => "cost-calculator-container"),
			"description" => __("Select row type", "gymbase")
		),
		array(
			"type" => "textfield",
			"heading" => __("Form action url", 'gymbase'),
			"param_name" => "action",
			"dependency" => Array('element' => "type", 'value' => "cost-calculator-container")
		),
		array(
			"type" => "dropdown",
			"class" => "",
			"heading" => __("Top margin", 'gymbase'),
			"param_name" => "top_margin",
			"value" => array(__("None", 'gymbase') => "none",  __("Page (small)", 'gymbase') => "page-margin-top", __("Section (large)", 'gymbase') => "page-margin-top-section"),
			"description" => __("Select top margin value for your row", "gymbase")
		),
		array(
			'type' => 'dropdown',
			'heading' => __( 'Row stretch', 'gymbase' ),
			'param_name' => 'full_width',
			'value' => array(
				__( 'Default', 'gymbase' ) => '',
				__( 'Stretch row', 'gymbase' ) => 'stretch_row',
				__( 'Stretch row and content', 'gymbase' ) => 'stretch_row_content',
				__( 'Stretch row and content (no paddings)', 'gymbase' ) => 'stretch_row_content_no_spaces',
			),
			'description' => __( 'Select stretching options for row and content (Note: stretched may not work properly if parent container has "overflow: hidden" CSS property).', 'gymbase' ),
		),
		array(
			'type' => 'dropdown',
			'heading' => __( 'Columns gap', 'gymbase' ),
			'param_name' => 'gap',
			'value' => array(
				'0px' => '0',
				'1px' => '1',
				'2px' => '2',
				'3px' => '3',
				'4px' => '4',
				'5px' => '5',
				'10px' => '10',
				'15px' => '15',
				'20px' => '20',
				'25px' => '25',
				'30px' => '30',
				'35px' => '35',
			),
			'std' => '0',
			'description' => __( 'Select gap between columns in row.', 'gymbase' ),
		),
		array(
			'type' => 'checkbox',
			'heading' => __( 'Full height row?', 'gymbase' ),
			'param_name' => 'full_height',
			'description' => __( 'If checked row will be set to full height.', 'gymbase' ),
			'value' => array( __( 'Yes', 'gymbase' ) => 'yes' ),
		),
		array(
			'type' => 'dropdown',
			'heading' => __( 'Columns position', 'gymbase' ),
			'param_name' => 'columns_placement',
			'value' => array(
				__( 'Middle', 'gymbase' ) => 'middle',
				__( 'Top', 'gymbase' ) => 'top',
				__( 'Bottom', 'gymbase' ) => 'bottom',
				__( 'Stretch', 'gymbase' ) => 'stretch',
			),
			'description' => __( 'Select columns position within row.', 'gymbase' ),
			'dependency' => array(
				'element' => 'full_height',
				'not_empty' => true,
			),
		),
		array(
			'type' => 'checkbox',
			'heading' => __( 'Equal height', 'gymbase' ),
			'param_name' => 'equal_height',
			'description' => __( 'If checked columns will be set to equal height.', 'gymbase' ),
			'value' => array( __( 'Yes', 'gymbase' ) => 'yes' ),
		),
		array(
			'type' => 'dropdown',
			'heading' => __( 'Content position', 'gymbase' ),
			'param_name' => 'content_placement',
			'value' => array(
				__( 'Default', 'gymbase' ) => '',
				__( 'Top', 'gymbase' ) => 'top',
				__( 'Middle', 'gymbase' ) => 'middle',
				__( 'Bottom', 'gymbase' ) => 'bottom',
			),
			'description' => __( 'Select content position within columns.', 'gymbase' ),
		),
		array(
			'type' => 'checkbox',
			'heading' => __( 'Use video background?', 'gymbase' ),
			'param_name' => 'video_bg',
			'description' => __( 'If checked, video will be used as row background.', 'gymbase' ),
			'value' => array( __( 'Yes', 'gymbase' ) => 'yes' ),
		),
		array(
			'type' => 'textfield',
			'heading' => __( 'YouTube link', 'gymbase' ),
			'param_name' => 'video_bg_url',
			'value' => 'https://www.youtube.com/watch?v=lMJXxhRFO1k',
			// default video url
			'description' => __( 'Add YouTube link.', 'gymbase' ),
			'dependency' => array(
				'element' => 'video_bg',
				'not_empty' => true,
			),
		),
		array(
			'type' => 'dropdown',
			'heading' => __( 'Parallax', 'gymbase' ),
			'param_name' => 'video_bg_parallax',
			'value' => array(
				__( 'None', 'gymbase' ) => '',
				__( 'Simple', 'gymbase' ) => 'content-moving',
				__( 'With fade', 'gymbase' ) => 'content-moving-fade',
			),
			'description' => __( 'Add parallax type background for row.', 'gymbase' ),
			'dependency' => array(
				'element' => 'video_bg',
				'not_empty' => true,
			),
		),
		array(
			'type' => 'dropdown',
			'heading' => __( 'Parallax', 'gymbase' ),
			'param_name' => 'parallax',
			'value' => array(
				__( 'None', 'gymbase' ) => '',
				__( 'Simple', 'gymbase' ) => 'content-moving',
				__( 'With fade', 'gymbase' ) => 'content-moving-fade',
			),
			'description' => __( 'Add parallax type background for row (Note: If no image is specified, parallax will use background image from Design Options).', 'gymbase' ),
			'dependency' => array(
				'element' => 'video_bg',
				'is_empty' => true,
			),
		),
		array(
			'type' => 'attach_image',
			'heading' => __( 'Image', 'gymbase' ),
			'param_name' => 'parallax_image',
			'value' => '',
			'description' => __( 'Select image from media library.', 'gymbase' ),
			'dependency' => array(
				'element' => 'parallax',
				'not_empty' => true,
			),
		),
		array(
			'type' => 'textfield',
			'heading' => __( 'Parallax speed', 'gymbase' ),
			'param_name' => 'parallax_speed_video',
			'value' => '1.5',
			'description' => __( 'Enter parallax speed ratio (Note: Default value is 1.5, min value is 1)', 'gymbase' ),
			'dependency' => array(
				'element' => 'video_bg_parallax',
				'not_empty' => true,
			),
		),
		array(
			'type' => 'textfield',
			'heading' => __( 'Parallax speed', 'gymbase' ),
			'param_name' => 'parallax_speed_bg',
			'value' => '1.5',
			'description' => __( 'Enter parallax speed ratio (Note: Default value is 1.5, min value is 1)', 'gymbase' ),
			'dependency' => array(
				'element' => 'parallax',
				'not_empty' => true,
			),
		),
		vc_map_add_css_animation( false ),
		array(
			'type' => 'el_id',
			'heading' => __( 'Row ID', 'gymbase' ),
			'param_name' => 'el_id',
			'description' => sprintf( __( 'Enter row ID (Note: make sure it is unique and valid according to <a href="%s" target="_blank">w3c specification</a>).', 'gymbase' ), 'https://www.w3schools.com/tags/att_global_id.asp' ),
		),
		array(
			'type' => 'checkbox',
			'heading' => __( 'Disable row', 'gymbase' ),
			'param_name' => 'disable_element',
			// Inner param name.
			'description' => __( 'If checked the row won\'t be visible on the public side of your website. You can switch it back any time.', 'gymbase' ),
			'value' => array( __( 'Yes', 'gymbase' ) => 'yes' ),
		),
		array(
			'type' => 'textfield',
			'heading' => __( 'Extra class name', 'gymbase' ),
			'param_name' => 'el_class',
			'description' => __( 'Style particular content element differently - add a class name and refer to it in custom CSS.', 'gymbase' ),
		),
		array(
			'type' => 'css_editor',
			'heading' => __( 'CSS box', 'gymbase' ),
			'param_name' => 'css',
			'group' => __( 'Design Options', 'gymbase' ),
		)
	),
	'js_view' => 'VcRowView'
) );

//column
$vc_column_width_list = array(
	__('1 column - 1/12', 'gymbase') => '1/12',
	__('2 columns - 1/6', 'gymbase') => '1/6',
	__('3 columns - 1/4', 'gymbase') => '1/4',
	__('4 columns - 1/3', 'gymbase') => '1/3',
	__('5 columns - 5/12', 'gymbase') => '5/12',
	__('6 columns - 1/2', 'gymbase') => '1/2',
	__('7 columns - 7/12', 'gymbase') => '7/12',
	__('8 columns - 2/3', 'gymbase') => '2/3',
	__('9 columns - 3/4', 'gymbase') => '3/4',
	__('10 columns - 5/6', 'gymbase') => '5/6',
	__('11 columns - 11/12', 'gymbase') => '11/12',
	__('12 columns - 1/1', 'gymbase') => '1/1'
);
$attributes = array(
	array(
		"type" => "dropdown",
		"class" => "",
		"heading" => __("Column type", 'gymbase'),
		"param_name" => "type",
		"value" => array(__("Default", 'gymbase') => "",  __("Cost calculator form", 'gymbase') => "cost-calculator-container"),
		"dependency" => Array('element' => "width", 'value' => array_map('strval', array_values((array_slice($vc_column_width_list, 0, -1)))))
	),
	array(
		"type" => "textfield",
		"heading" => __("Form action url", 'gymbase'),
		"param_name" => "action",
		"dependency" => Array('element' => "type", 'value' => "cost-calculator-container")
	),
	array(
		"type" => "dropdown",
		"class" => "",
		"heading" => __("Top margin", 'gymbase'),
		"param_name" => "top_margin",
		"value" => array(__("None", 'gymbase') => "none",  __("Page (small)", 'gymbase') => "page-margin-top", __("Section (large)", 'gymbase') => "page-margin-top-section"),
		"description" => __("Select top margin value for your column", "gymbase")
	)
);
vc_add_params('vc_column_inner', $attributes);
vc_map( array(
	'name' => __( 'Column', 'gymbase' ),
	'base' => 'vc_column',
	'is_container' => true,
	'content_element' => false,
	'description' => __( 'Place content elements inside the column', 'gymbase' ),
	'params' => array(
		array(
			"type" => "dropdown",
			"class" => "",
			"heading" => __("Column type", 'gymbase'),
			"param_name" => "type",
			"value" => array(__("Default", 'gymbase') => "", __("Cost calculator form", 'gymbase') => "cost-calculator-container"),
			"dependency" => Array('element' => "width", 'value' => array_map('strval', array_values((array_slice($vc_column_width_list, 0, -1)))))
		),
		array(
			"type" => "textfield",
			"heading" => __("Form action url", 'gymbase'),
			"param_name" => "action",
			"dependency" => Array('element' => "type", 'value' => "cost-calculator-container")
		),
		array(
			"type" => "dropdown",
			"class" => "",
			"heading" => __("Top margin", 'gymbase'),
			"param_name" => "top_margin",
			"value" => array(__("None", 'gymbase') => "none",  __("Page (small)", 'gymbase') => "page-margin-top", __("Section (large)", 'gymbase') => "page-margin-top-section"),
			"description" => __("Select top margin value for your column", "gymbase")
		),
		array(
			'type' => 'checkbox',
			'heading' => __( 'Use video background?', 'gymbase' ),
			'param_name' => 'video_bg',
			'description' => __( 'If checked, video will be used as row background.', 'gymbase' ),
			'value' => array( __( 'Yes', 'gymbase' ) => 'yes' ),
		),
		array(
			'type' => 'textfield',
			'heading' => __( 'YouTube link', 'gymbase' ),
			'param_name' => 'video_bg_url',
			'value' => 'https://www.youtube.com/watch?v=lMJXxhRFO1k',
			// default video url
			'description' => __( 'Add YouTube link.', 'gymbase' ),
			'dependency' => array(
				'element' => 'video_bg',
				'not_empty' => true,
			),
		),
		array(
			'type' => 'dropdown',
			'heading' => __( 'Parallax', 'gymbase' ),
			'param_name' => 'video_bg_parallax',
			'value' => array(
				__( 'None', 'gymbase' ) => '',
				__( 'Simple', 'gymbase' ) => 'content-moving',
				__( 'With fade', 'gymbase' ) => 'content-moving-fade',
			),
			'description' => __( 'Add parallax type background for row.', 'gymbase' ),
			'dependency' => array(
				'element' => 'video_bg',
				'not_empty' => true,
			),
		),
		array(
			'type' => 'dropdown',
			'heading' => __( 'Parallax', 'gymbase' ),
			'param_name' => 'parallax',
			'value' => array(
				__( 'None', 'gymbase' ) => '',
				__( 'Simple', 'gymbase' ) => 'content-moving',
				__( 'With fade', 'gymbase' ) => 'content-moving-fade',
			),
			'description' => __( 'Add parallax type background for row (Note: If no image is specified, parallax will use background image from Design Options).', 'gymbase' ),
			'dependency' => array(
				'element' => 'video_bg',
				'is_empty' => true,
			),
		),
		array(
			'type' => 'attach_image',
			'heading' => __( 'Image', 'gymbase' ),
			'param_name' => 'parallax_image',
			'value' => '',
			'description' => __( 'Select image from media library.', 'gymbase' ),
			'dependency' => array(
				'element' => 'parallax',
				'not_empty' => true,
			),
		),
		array(
			'type' => 'textfield',
			'heading' => __( 'Parallax speed', 'gymbase' ),
			'param_name' => 'parallax_speed_video',
			'value' => '1.5',
			'description' => __( 'Enter parallax speed ratio (Note: Default value is 1.5, min value is 1)', 'gymbase' ),
			'dependency' => array(
				'element' => 'video_bg_parallax',
				'not_empty' => true,
			),
		),
		array(
			'type' => 'textfield',
			'heading' => __( 'Parallax speed', 'gymbase' ),
			'param_name' => 'parallax_speed_bg',
			'value' => '1.5',
			'description' => __( 'Enter parallax speed ratio (Note: Default value is 1.5, min value is 1)', 'gymbase' ),
			'dependency' => array(
				'element' => 'parallax',
				'not_empty' => true,
			),
		),
		vc_map_add_css_animation( false ),
		array(
			'type' => 'el_id',
			'heading' => __( 'Element ID', 'gymbase' ),
			'param_name' => 'el_id',
			'description' => sprintf( __( 'Enter element ID (Note: make sure it is unique and valid according to <a href="%s" target="_blank">w3c specification</a>).', 'gymbase' ), 'https://www.w3schools.com/tags/att_global_id.asp' ),
		),
		array(
			'type' => 'textfield',
			'heading' => __( 'Extra class name', 'gymbase' ),
			'param_name' => 'el_class',
			'description' => __( 'Style particular content element differently - add a class name and refer to it in custom CSS.', 'gymbase' ),
		),
		array(
			'type' => 'css_editor',
			'heading' => __( 'CSS box', 'gymbase' ),
			'param_name' => 'css',
			'group' => __( 'Design Options', 'gymbase' ),
		),
		array(
			'type' => 'dropdown',
			'heading' => __( 'Width', 'gymbase' ),
			'param_name' => 'width',
			'value' => $vc_column_width_list,
			'group' => __( 'Responsive Options', 'gymbase' ),
			'description' => __( 'Select column width.', 'gymbase' ),
			'std' => '1/1',
		),
		array(
			'type' => 'column_offset',
			'heading' => __( 'Responsiveness', 'gymbase' ),
			'param_name' => 'offset',
			'group' => __( 'Responsive Options', 'gymbase' ),
			'description' => __( 'Adjust column for different screen sizes. Control width, offset and visibility settings.', 'gymbase' ),
		)
	),
	'js_view' => 'VcColumnView'
) );

//widgetised sidebar
vc_map( array(
	'name' => __( 'Widgetised Sidebar', 'gymbase' ),
	'base' => 'vc_widget_sidebar',
	'class' => 'wpb_widget_sidebar_widget',
	'icon' => 'icon-wpb-layout_sidebar',
	'category' => __( 'Structure', 'gymbase' ),
	'description' => __( 'WordPress widgetised sidebar', 'gymbase' ),
	'params' => array(
		array(
			'type' => 'textfield',
			'heading' => __( 'Widget title', 'gymbase' ),
			'param_name' => 'title',
			'description' => __( 'Enter text used as widget title (Note: located above content element).', 'gymbase' )
		),
		array(
			'type' => 'widgetised_sidebars',
			'heading' => __( 'Sidebar', 'gymbase' ),
			'param_name' => 'sidebar_id',
			'description' => __( 'Select widget area to display.', 'gymbase' )
		),
		array(
			'type' => 'textfield',
			'heading' => __( 'Extra class name', 'gymbase' ),
			'param_name' => 'el_class',
			'description' => __( 'Style particular content element differently - add a class name and refer to it in custom CSS.', 'gymbase' )
		),
		array(
			"type" => "dropdown",
			"class" => "",
			"heading" => __("Top margin", 'gymbase'),
			"param_name" => "top_margin",
			"value" => array(__("None", 'gymbase') => "none",  __("Page (small)", 'gymbase') => "page-margin-top", __("Section (large)", 'gymbase') => "page-margin-top-section"),
			"description" => __("Select top margin value for your sidebar", "gymbase")
		)
	)
) );

//list pages
function gb_theme_list_pages($atts, $content)
{
	$output = "";
	
	$output .= "<h3>" . __("Page List:", 'gymbase') . "</h3><ul>";
	$args = array(
		'post_type' => 'page',
		'post_status' => 'publish',
		'posts_per_page' => -1,
		'orderby' => 'title', 
		'order' => 'ASC',
		'suppress_filters' => 0
	);
	query_posts($args);
	if(have_posts()) : while (have_posts()) : the_post();
		global $post;
		$output .= "<li>" . get_the_title() . "</li>";
	endwhile;
	endif;
	wp_reset_query();
	
	$output .= "</ul>";
	
	return $output;
}

//single page link
function single_page_link($atts)
{
	global $post;
	extract(shortcode_atts(array(
		"label" => __("Read more", 'gymbase'),
		"icon" => "template-arrow-horizontal-1-after"
	), $atts));
	
	return '<a class="alternate read-more' . ($icon!="" ? ' ' . esc_attr($icon) : '') . '" href="' . esc_url(get_permalink()) . '" title="' . esc_attr($label) . '">' . $label . '</a>';
}

//box_header
function gb_theme_box_header($atts, $content)
{
	extract(shortcode_atts(array(
		"type" => "h3",
		"class" => "",
		"bottom_border" => 1,
		"animation" => 0,
		"top_margin" => "none"
	), $atts));
	return '<' . $type . ' class="box-header' . ($class!="" ? " " . esc_attr($class) : "") . (!(int)$bottom_border ? ' no-border' : ((int)$animation ? ' animation-slide' : '')) . ($top_margin!="none" ? ' ' . esc_attr($top_margin) : '') . '">' . do_shortcode($content) . '</' . $type . '>';
}

//visual composer
vc_map( array(
	"name" => __("Box header", 'gymbase'),
	"base" => "box_header",
	"class" => "",
	"controls" => "full",
	"show_settings_on_create" => true,
	"icon" => "icon-wpb-layer-box-header",
	"category" => __('GymBase', 'gymbase'),
	"params" => array(
		array(
			"type" => "textfield",
			"holder" => "div",
			"class" => "",
			"heading" => __("Title", 'gymbase'),
			"param_name" => "content",
			"value" => __("Sample Header", 'gymbase')
		),
		array(
			"type" => "dropdown",
			"class" => "",
			"heading" => __("Type", 'gymbase'),
			"param_name" => "type",
			"value" => array(__("H3", 'gymbase') => "h3",  __("H1", 'gymbase') => "h1", __("H2", 'gymbase') => "h2", __("H4", 'gymbase') => "h4", __("H5", 'gymbase') => "h5")
		),
		array(
			"type" => "dropdown",
			"class" => "",
			"heading" => __("Bottom border", 'gymbase'),
			"param_name" => "bottom_border",
			"value" => array(__("yes", 'gymbase') => 1,  __("no", 'gymbase') => 0)
		),
		array(
			"type" => "dropdown",
			"class" => "",
			"heading" => __("Bottom border animation", 'gymbase'),
			"param_name" => "animation",
			"value" => array(__("no", 'gymbase') => 0,  __("yes", 'gymbase') => 1),
			"dependency" => Array('element' => "bottom_border", 'value' => '1')
		),
		array(
			"type" => "textfield",
			"holder" => "div",
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
	)
));

//show all
function gb_theme_show_all_button($atts)
{
	extract(shortcode_atts(array(
		"url" => "blog",
		"title" => __("SEE MORE", 'gymbase'),
		"show_arrow" => 1,
		"align" => "right",
		"el_class" => "",
		"top_margin" => "page-margin-top"
	), $atts));
	return '<div class="show-all clearfix' . ($top_margin!="none" ? ' ' . esc_attr($top_margin) : '') . ($align!="right" ? ' align-' . esc_attr($align) : '') . '"><a class="more gb-button' . ((int)$show_arrow ? ' template-arrow-horizontal-1-after' : '') . ($el_class!="" ? ' ' . esc_attr($el_class) : '') . '" href="' . esc_attr($url) . '" title="' . esc_attr($title) . '">' . $title . '</a></div>';
}

//visual composer
vc_map( array(
	"name" => __("Show all button", 'gymbase'),
	"base" => "show_all_button",
	"class" => "",
	"controls" => "full",
	"show_settings_on_create" => true,
	"icon" => "icon-wpb-ui-button",
	"category" => __('GymBase', 'gymbase'),
	"params" => array(
		array(
			"type" => "textfield",
			"holder" => "div",
			"class" => "",
			"heading" => __("Title", 'gymbase'),
			"param_name" => "title",
			"value" => __("Show all", 'gymbase')
		),
		array(
			"type" => "textfield",
			"holder" => "div",
			"class" => "",
			"heading" => __("Url", 'gymbase'),
			"param_name" => "url",
			"value" => "blog"
		),
		array(
			"type" => "dropdown",
			"class" => "",
			"heading" => __("Show arrow icon", 'gymbase'),
			"param_name" => "show_arrow",
			"value" => array(__("Yes", 'gymbase') => 1, __("No", 'gymbase') => 0)
		),
		array(
			"type" => "dropdown",
			"class" => "",
			"heading" => __("Align", 'gymbase'),
			"param_name" => "align",
			"value" => array(__("Right", 'gymbase') => "right", __("Left", 'gymbase') => "left", __("Center", 'gymbase') => "center", __("Float", 'gymbase') => "float")
		),
		array(
			'type' => 'textfield',
			'heading' => __( 'Extra class name', 'gymbase' ),
			'param_name' => 'el_class',
			'description' => __( 'Style particular content element differently - add a class name and refer to it in custom CSS.', 'gymbase' ),
		),
		array(
			"type" => "dropdown",
			"class" => "",
			"heading" => __("Top margin", 'gymbase'),
			"param_name" => "top_margin",
			"value" => array(__("None", 'gymbase') => "none", __("Page (small)", 'gymbase') => "page-margin-top", __("Section (large)", 'gymbase') => "page-margin-top-section"),
			"std" => "page-margin-top"
		)
	)
));

//box_header
function gb_theme_info_text($atts, $content)
{
	extract(shortcode_atts(array(
		"color" => "white",
		"class" => "",
		"top_margin" => ""
	), $atts));
	return '<h4 class="info_' . esc_attr($color) . ' ' . esc_attr($class) . ' ' . esc_attr($top_margin) .'">' . do_shortcode($content) . '</h4>';
}

//visual composer
vc_map( array(
	"name" => __("Info text", 'gymbase'),
	"base" => "info_text",
	"class" => "",
	"controls" => "full",
	"show_settings_on_create" => true,
	"icon" => "icon-wpb-layer-shape-text",
	"category" => __('GymBase', 'gymbase'),
	"params" => array(
		array(
			"type" => "textfield",
			"holder" => "div",
			"class" => "",
			"heading" => __("Text", 'gymbase'),
			"param_name" => "content",
			"value" => ""
		),
		array(
			"type" => "dropdown",
			"holder" => "",
			"class" => "",
			"heading" => __("Color", 'gymbase'),
			"param_name" => "color",
			"value" => array(__("White", 'gymbase') => "white", __("Green", 'gymbase') => "green")
		),
		array(
			"type" => "textfield",
			"holder" => "div",
			"class" => "",
			"heading" => __("Class", 'gymbase'),
			"param_name" => "class",
			"value" => ""
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

?>