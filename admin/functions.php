<?php
function gb_theme_admin_init()
{
	wp_register_script("theme-colorpicker", get_template_directory_uri() . "/admin/js/colorpicker.js", array("jquery"));
	wp_register_script("theme-admin", get_template_directory_uri() . "/admin/js/theme_admin.js", array("jquery", "theme-colorpicker"));
	wp_register_script("jquery-bqq", get_template_directory_uri() . "/admin/js/jquery.ba-bbq.min.js", array("jquery"));
	wp_register_script("theme-admin-widgets", get_template_directory_uri() . "/admin/js/theme_admin_widgets.js", array("jquery"));
	wp_register_style("theme-colorpicker", get_template_directory_uri() . "/admin/style/colorpicker.css");
	wp_register_style("theme-admin-style", get_template_directory_uri() . "/admin/style/style.css");
}
add_action("admin_init", "gb_theme_admin_init");

function gb_theme_admin_print_scripts()
{
	wp_enqueue_script('jquery');
	wp_enqueue_script('jquery-bqq');
	wp_enqueue_script('jquery-ui-core');
	wp_enqueue_script('jquery-ui-tabs');
	wp_enqueue_script('theme-admin');
	wp_enqueue_script('media-upload');
	wp_enqueue_script('thickbox');
	wp_enqueue_style('thickbox');
	wp_enqueue_style("google-font-open-sans", "//fonts.googleapis.com/css?family=Open+Sans:400,600");
	wp_enqueue_style("google-font-raleway", "//fonts.googleapis.com/css?family=Raleway:300,400,500,600&amp;subset=latin,latin-ext");
	wp_enqueue_style("google-font-lato", "//fonts.googleapis.com/css?family=Lato:400&amp;subset=latin,latin-ext");
	wp_enqueue_style("google-font-garamond", "//fonts.googleapis.com/css?family=EB+Garamond:400i&amp;subset=latin,latin-ext");
	wp_enqueue_style("gb-social", get_template_directory_uri() ."/fonts/social/style.css");
	
	$sidebars = array(
		"default" => array(
			array(
				"name" => "header",
				"label" => __("header", 'gymbase')
			),
			array(
				"name" => "footer_top",
				"label" => __("footer top", 'gymbase')
			),
			array(
				"name" => "footer_bottom",
				"label" => __("footer bottom", 'gymbase')
			)
		),
		"template-blog.php" => array(
			array(
				"name" => "header",
				"label" => __("header", 'gymbase')
			),
			array(
				"name" => "footer_top",
				"label" => __("footer top", 'gymbase')
			),
			array(
				"name" => "footer_bottom",
				"label" => __("footer bottom", 'gymbase')
			)
		),
		"single.php" => array(
			array(
				"name" => "header",
				"label" => __("header", 'gymbase')
			),
			array(
				"name" => "footer_top",
				"label" => __("footer top", 'gymbase')
			),
			array(
				"name" => "footer_bottom",
				"label" => __("footer bottom", 'gymbase')
			)
		),
		"single-trainers.php" => array(
			array(
				"name" => "header",
				"label" => __("header", 'gymbase')
			),
			array(
				"name" => "footer_top",
				"label" => __("footer top", 'gymbase')
			),
			array(
				"name" => "footer_bottom",
				"label" => __("footer bottom", 'gymbase')
			)
		),
		"single-classes.php" => array(
			array(
				"name" => "header",
				"label" => __("header", 'gymbase')
			),
			array(
				"name" => "footer_top",
				"label" => __("footer top", 'gymbase')
			),
			array(
				"name" => "footer_bottom",
				"label" => __("footer bottom", 'gymbase')
			)
		),
		"single-gymbase_gallery.php" => array(
			array(
				"name" => "header",
				"label" => __("header", 'gymbase')
			),
			array(
				"name" => "footer_top",
				"label" => __("footer top", 'gymbase')
			),
			array(
				"name" => "footer_bottom",
				"label" => __("footer bottom", 'gymbase')
			)
		),
		"search.php" => array(
			array(
				"name" => "header",
				"label" => __("header", 'gymbase')
			),
			array(
				"name" => "footer_top",
				"label" => __("footer top", 'gymbase')
			),
			array(
				"name" => "footer_bottom",
				"label" => __("footer bottom", 'gymbase')
			)
		),
		"template-default-without-breadcrumbs.php" => array(
			array(
				"name" => "footer_top",
				"label" => __("footer top", 'gymbase')
			),
			array(
				"name" => "footer_bottom",
				"label" => __("footer bottom", 'gymbase')
			)
		),
		"template-home.php" => array(
			array(
				"name" => "top",
				"label" => __("top", 'gymbase')
			),
			array(
				"name" => "footer_top",
				"label" => __("footer top", 'gymbase')
			),
			array(
				"name" => "footer_bottom",
				"label" => __("footer bottom", 'gymbase')
			)
		),
		"404.php" => array(
			array(
				"name" => "header",
				"label" => __("header", 'gymbase')
			),
			array(
				"name" => "footer_top",
				"label" => __("footer top", 'gymbase')
			),
			array(
				"name" => "footer_bottom",
				"label" => __("footer bottom", 'gymbase')
			)
		),
		"template-empty.php" => array(),
		"template-empty-with-footer.php" => array(
			array(
				"name" => "footer_top",
				"label" => __("footer top", 'gymbase')
			),
			array(
				"name" => "footer_bottom",
				"label" => __("footer bottom", 'gymbase')
			)
		)
	);
	//get theme sidebars
	$theme_sidebars = array();
	$theme_sidebars_array = get_posts(array(
		'post_type' => 'gymbase_sidebars',
		'posts_per_page' => '-1',
		'nopaging' => true,
		'post_status' => 'publish',
		'orderby' => 'menu_order',
		'order' => 'ASC'
	));
	$theme_sidebars[0]["id"] = -1;
	$theme_sidebars[0]["title"] = __("None", 'gymbase');
	for($i=1; $i<=count($theme_sidebars_array); $i++)
	{
		$theme_sidebars[$i]["id"] = $theme_sidebars_array[$i-1]->ID;
		$theme_sidebars[$i]["title"] = $theme_sidebars_array[$i-1]->post_title;
	}
	//get theme sliders
	$sliderAllShortcodeIds = array();
	global $theme_options;
	$slides_count = count($theme_options["slider_image_url"]);
	if((int)$slides_count>0)
	{
		$sliderAllShortcodeIds[] = "gymba_theme_default_slider_From Theme Options (deprecated)";
	}
	//get revolution sliders
	if(is_plugin_active('revslider/revslider.php'))
	{
		global $wpdb;
		$rs = $wpdb->get_results( 
		"
		SELECT id, title, alias
		FROM ".$wpdb->prefix."revslider_sliders
		ORDER BY id ASC LIMIT 100
		"
		);
		if($rs) 
		{
			foreach($rs as $slider)
			{
				$sliderAllShortcodeIds[] = "revolution_slider_settings_" . $slider->alias;
			}
		}
	}
	//get layer sliders
	if(is_plugin_active('LayerSlider/layerslider.php'))
	{
		global $wpdb;
		$ls = $wpdb->get_results(
		"
		SELECT id, name, date_c
		FROM ".$wpdb->prefix."layerslider
		WHERE flag_hidden = '0' AND flag_deleted = '0'
		ORDER BY date_c ASC LIMIT 999
		"
		);
		$layer_sliders = array();
		if($ls)
		{
			foreach($ls as $slider)
			{
				$sliderAllShortcodeIds[] = "aaaaalayer_slider_settings_" . $slider->id;
			}
		}
	}
	//sort slider ids
	sort($sliderAllShortcodeIds);
	$data = array(
		'img_url' =>  get_template_directory_uri() . "/images/",
		'admin_img_url' =>  get_template_directory_uri() . "/admin/images/",
		'sidebar_label' => __('Sidebar', 'gymbase'),
		'slider_label' => __('Main Slider', 'gymbase'),
		'sidebars' => $sidebars,
		'theme_sidebars' => $theme_sidebars,
		'page_sidebars' => get_post_meta(get_the_ID(), "gymbase_page_sidebars", true),
		'theme_sliders' => $sliderAllShortcodeIds,
		'main_slider' => get_post_meta(get_the_ID(), "main_slider", true),
		'create_slider_text' => (is_plugin_active('revslider/revslider.php') ? sprintf(__("Create slider <a href='%s'>here</a>", 'gymbase'), esc_url(admin_url("admin.php?page=revslider"))) : sprintf(__("Activate Revolution Slider <a href='%s'>here</a>", 'gymbase'), esc_url(admin_url("themes.php?page=install-required-plugins&plugin_status=activate")))),
		'themename' => 'gymbase',
		'import_confirmation_message' => __('Please confirm the dummy data import.', 'gymbase'),
		'shop_import_confirmation_message' => __('Please confirm the shop dummy data import.', 'gymbase'),
		'import_in_progress_message' => __("Please wait and don't reload the page when import is in progress!", 'gymbase'),
		'import_error_message' => __('Error during import:', 'gymbase')
	);
	//pass data to javascript
	$params = array(
		'l10n_print_after' => 'config = ' . json_encode($data) . ';'
	);
	wp_localize_script("theme-admin", "config", $params);
}

function gb_theme_admin_print_scripts_colorpicker()
{	
	wp_enqueue_script('theme-admin');
	wp_enqueue_script('theme-colorpicker');
	wp_enqueue_style('theme-colorpicker');
}

function gb_theme_admin_print_scripts_widgets()
{	
	wp_enqueue_script('theme-admin-widgets');
}

function gb_theme_admin_print_scripts_all()
{
	wp_enqueue_style('theme-admin-style');
}

function gb_theme_admin_menu_theme_options() 
{
	add_action("admin_print_scripts", "gb_theme_admin_print_scripts_all");
	add_action("admin_print_scripts-post-new.php", "gb_theme_admin_print_scripts");
	add_action("admin_print_scripts-post.php", "gb_theme_admin_print_scripts");
	add_action("admin_print_scripts-appearance_page_ThemeOptions", "gb_theme_admin_print_scripts");
	add_action("admin_print_scripts-widgets.php", "gb_theme_admin_print_scripts_colorpicker");
	add_action("admin_print_scripts-appearance_page_ThemeOptions", "gb_theme_admin_print_scripts_colorpicker");
	add_action("admin_print_scripts-post-new.php", "gb_theme_admin_print_scripts_colorpicker");
	add_action("admin_print_scripts-post.php", "gb_theme_admin_print_scripts_colorpicker");
	add_action("admin_print_scripts-widgets.php", "gb_theme_admin_print_scripts_widgets");
}
add_action("admin_menu", "gb_theme_admin_menu_theme_options");

//visual composer
//dropdownmulti
function gb_dropdownmultiple_settings_field($settings, $value)
{
	$value = ($value==null ? array() : $value);
	if(!is_array($value))
		$value = explode(",", $value);
	$output = '<select name="'.esc_attr($settings['param_name']).'" class="wpb_vc_param_value wpb-input wpb-select '.esc_attr($settings['param_name']).' '.esc_attr($settings['type']).'" multiple>';
			foreach ( $settings['value'] as $text_val => $val ) {
				if ( is_numeric($text_val) && is_string($val) || is_numeric($text_val) && is_numeric($val) ) {
					$text_val = $val;
				}
			   // $val = strtolower(str_replace(array(" "), array("_"), $val));
				$selected = '';
				if ( in_array($val,$value) ) $selected = ' selected="selected"';
				$output .= '<option class="'.esc_attr($val).'" value="'.esc_attr($val).'"'.esc_attr($selected).'>'.$text_val.'</option>';
			}
			$output .= '</select>';
	return $output;
}
//hidden
function gb_hidden_settings_field($settings, $value) 
{
   return '<input name="'.esc_attr($settings['param_name'])
			 .'" class="wpb_vc_param_value wpb-textinput '
			 .esc_attr($settings['param_name']).' '.esc_attr($settings['type']).'_field" type="hidden" value="'
			 .esc_attr($value).'"/>';
}
//readonly
function gb_readonly_settings_field($settings, $value) 
{
   return '<input name="'.esc_attr($settings['param_name'])
			 .'" class="wpb_vc_param_value wpb-textinput '
			 .esc_attr($settings['param_name']).' '.esc_attr($settings['type']).'_field" type="text" readonly="readonly" value="'
			 .esc_attr($value).'"/>';
}
//add item button
function gb_listitem_settings_field($settings, $value)
{
	$value = explode(",", $value);
	$output = '<input type="button" value="' . esc_attr__('Add list item', 'gymbase') . '" name="'.esc_attr($settings['param_name']).'" class="button '.esc_attr($settings['param_name']).' '.esc_attr($settings['type']).'" style="width: auto; padding: 0 10px 1px;"/>';
	return $output;
}
//add item window
function gb_listitemwindow_settings_field($settings, $value)
{
	$value = explode(",", $value);
	$output = '<div class="listitemwindow vc_panel vc_shortcode-edit-form" name="'.esc_attr($settings['param_name']).'">
		<div class="vc_panel-heading">
			<a class="vc_close" href="#" title="' . esc_attr__("Close panel", 'gymbase') . '"><i class="vc_icon"></i></a>
			<h3 class="vc_panel-title">' . __('Add New List Item', 'gymbase') . '</h3>
		</div>
		<div class="modal-body wpb-edit-form" style="display: block;min-height: auto;">
			<div class="vc_row-fluid wpb_el_type_textfield">
				<div class="wpb_element_label">' . __("Text", 'gymbase') . '</div>
				<div class="edit_form_line">
					<input type="text" value="" class="wpb_vc_param_value wpb-textinput textfield" name="item_content">
				</div>
			</div>
			<div class="vc_row-fluid wpb_el_type_textfield">
				<div class="wpb_element_label">' . __("Value", 'gymbase') . '</div>
				<div class="edit_form_line">
					<input type="text" value="" class="wpb_vc_param_value wpb-textinput textfield" name="item_value">
				</div>
			</div>
			<div class="vc_row-fluid wpb_el_type_textfield">
				<div class="wpb_element_url">' . __("Url", 'gymbase') . '</div>
				<div class="edit_form_line">
					<input type="text" value="" class="wpb_vc_param_value wpb-textinput textfield" name="item_url">
				</div>
			</div>
			<div class="vc_row-fluid wpb_el_type_dropdown">
				<div class="wpb_element_label">' . __("Url target", 'gymbase') . '</div>
				<div class="edit_form_line">
					<select class="wpb_vc_param_value wpb-input wpb-select item_url_target dropdown" name="item_url_target">
						<option selected="selected" value="new_window">' . __("new window", 'gymbase') . '</option>
						<option value="same_window">' . __("same window", 'gymbase') . '</option>
					</select>
				</div>
			</div>
			<div class="vc_row-fluid wpb_el_type_dropdown">
				<div class="wpb_element_label">' . __("Icon", 'gymbase') . '</div>
				<div class="edit_form_line">
					<select class="wpb_vc_param_value wpb-input wpb-select item_type dropdown" name="item_icon">
						<option selected="selected" value="" class="">' . __("-", 'gymbase') . '</option>
						<option value="arrow-circle">' . __("circle", 'gymbase') . '</option>
						<option value="arrow-horizontal-1">' . __("horizontal-1", 'gymbase') . '</option>
						<option value="arrow-horizontal-2">' . __("horizontal-2", 'gymbase') . '</option>
						<option value="arrow-horizontal-3">' . __("horizontal-3", 'gymbase') . '</option>
						<option value="arrow-horizontal-4">' . __("horizontal-4", 'gymbase') . '</option>
						<option value="arrow-horizontal-5">' . __("horizontal-5", 'gymbase') . '</option>
						<option value="arrow-horizontal-6">' . __("horizontal-6", 'gymbase') . '</option>
						<option value="arrow-horizontal-7">' . __("horizontal-7", 'gymbase') . '</option>
						<option value="arrow-vertical-1">' . __("vertical-1", 'gymbase') . '</option>
						<option value="arrow-vertical-3">' . __("vertical-3", 'gymbase') . '</option>
						<option value="arrow-vertical-4">' . __("vertical-4", 'gymbase') . '</option>
						<option value="arrow-vertical-5">' . __("vertical-5", 'gymbase') . '</option>
						<option value="arrow-vertical-6">' . __("vertical-6", 'gymbase') . '</option>
						<option value="arrow-vertical-7">' . __("vertical-7", 'gymbase') . '</option>
						<option value="cart">' . __("cart", 'gymbase') . '</option>
						<option value="check">' . __("check", 'gymbase') . '</option>
						<option value="chevron">' . __("chevron", 'gymbase') . '</option>
						<option value="comment-1">' . __("comment-1", 'gymbase') . '</option>
						<option value="comment-2">' . __("comment-2", 'gymbase') . '</option>
						<option value="email">' . __("email", 'gymbase') . '</option>
						<option value="location">' . __("location", 'gymbase') . '</option>
						<option value="menu-1">' . __("menu-1", 'gymbase') . '</option>
						<option value="menu-2">' . __("menu-2", 'gymbase') . '</option>
						<option value="minus-1">' . __("minus-1", 'gymbase') . '</option>
						<option value="minus-2">' . __("minus-2", 'gymbase') . '</option>
						<option value="mobile">' . __("mobile", 'gymbase') . '</option>
						<option value="plus-1">' . __("plus-1", 'gymbase') . '</option>
						<option value="plus-2">' . __("plus-2", 'gymbase') . '</option>
						<option value="remove-1">' . __("remove-1", 'gymbase') . '</option>
						<option value="remove-2">' . __("remove-2", 'gymbase') . '</option>
						<option value="search">' . __("search", 'gymbase') . '</option>
						<option value="tick-1">' . __("tick-1", 'gymbase') . '</option>
						<option value="tick-2">' . __("tick-2", 'gymbase') . '</option>
						<option value="quote">' . __("quote", 'gymbase') . '</option>
						<option value="quote-2">' . __("quote-2", 'gymbase') . '</option>
					</select>
				</div>
			</div>
			<div class="wpb_el_type_colorpicker vc_wrapper-param-type-colorpicker vc_shortcode-param vc_column" data-vc-ui-element="panel-shortcode-param" data-vc-shortcode-param-name="item_content_color" data-param_type="colorpicker" data-param_settings="{&quot;type&quot;:&quot;colorpicker&quot;}">
				<div class="wpb_element_label">' . __("Custom text color", 'gymbase') . '</div>
				<div class="edit_form_line">
					<div class="color-group">
						<div class="wp-picker-container vc_color-picker">
							<span class="wp-picker-input-wrap">
								<input name="item_content_color" class="wpb_vc_param_value wpb-textinput item_content_color colorpicker_field vc_color-control wp-color-picker" type="text">
								<input class="button button-small hidden wp-picker-clear" value="Clear" type="button">
							</span>
						</div>
					</div>
				</div>
			</div>
			<div class="wpb_el_type_colorpicker vc_wrapper-param-type-colorpicker vc_shortcode-param vc_column" data-vc-ui-element="panel-shortcode-param" data-vc-shortcode-param-name="item_value_color" data-param_type="colorpicker" data-param_settings="{&quot;type&quot;:&quot;colorpicker&quot;}">
				<div class="wpb_element_label">' . __("Custom value color", 'gymbase') . '</div>
				<div class="edit_form_line">
					<div class="color-group">
						<div class="wp-picker-container vc_color-picker">
							<span class="wp-picker-input-wrap">
								<input name="item_value_color" class="wpb_vc_param_value wpb-textinput item_value_color colorpicker_field vc_color-control wp-color-picker" type="text">
								<input class="button button-small hidden wp-picker-clear" value="Clear" type="button">
							</span>
						</div>
					</div>
				</div>
			</div>
			<div class="wpb_el_type_colorpicker vc_wrapper-param-type-colorpicker vc_shortcode-param vc_column" data-vc-ui-element="panel-shortcode-param" data-vc-shortcode-param-name="item_border_color" data-param_type="colorpicker" data-param_settings="{&quot;type&quot;:&quot;colorpicker&quot;}">
				<div class="wpb_element_label">' . __("Custom border color", 'gymbase') . '</div>
				<div class="edit_form_line">
					<div class="color-group">
						<div class="wp-picker-container vc_color-picker">
							<span class="wp-picker-input-wrap">
								<input name="item_border_color" class="wpb_vc_param_value wpb-textinput item_border_color colorpicker_field vc_color-control wp-color-picker" type="text">
								<input class="button button-small hidden wp-picker-clear" value="Clear" type="button">
								<span class="description clear">' . __('Set to <em>none</em> for no border', 'gymbase') . '</span>
							</span>
						</div>
					</div>
				</div>
			</div>
			<div class="edit_form_actions" style="padding-top: 20px;">
				<a id="add-item-shortcode" class="button-primary" href="#">' . __("Add Item", 'gymbase') . '</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a class="cancel-item-options button" href="#">' . __("Cancel", 'gymbase') . '</a>
			</div>
		</div>
	</div>';
	return $output;
}
?>