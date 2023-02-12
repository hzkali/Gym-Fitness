<?php
$themename = "gymbase";

//plugins activator
require_once("plugins_activator.php");

//for is_plugin_active
include_once( ABSPATH . 'wp-admin/includes/plugin.php');

if(function_exists("vc_remove_element"))
{
	vc_remove_element("vc_gmaps");
}

//theme options
gb_get_theme_file("/theme-options.php");

//menu walker
gb_get_theme_file("/mobile-menu-walker.php");

//custom meta box
gb_get_theme_file("/meta-box.php");

//dropdown menu
gb_get_theme_file("/nav-menu-dropdown-walker.php");

//gallery functions
gb_get_theme_file("/gallery-functions.php");
if(function_exists("vc_map"))
{
	//contact_form
	gb_get_theme_file("/contact_form.php");
}

//comments
gb_get_theme_file("/comments-functions.php");

//widgets
gb_get_theme_file("/widgets/widget-cart-icon.php");
gb_get_theme_file("/widgets/widget-upcoming-classes.php");
gb_get_theme_file("/widgets/widget-home-box.php");
gb_get_theme_file("/widgets/widget-classes.php");
gb_get_theme_file("/widgets/widget-footer-box.php");
gb_get_theme_file("/widgets/widget-contact-details.php");
gb_get_theme_file("/widgets/widget-scrolling-recent-posts.php");
gb_get_theme_file("/widgets/widget-scrolling-most-commented.php");
gb_get_theme_file("/widgets/widget-scrolling-most-viewed.php");
gb_get_theme_file("/widgets/widget-social-icons.php");

//shortcodes
if(function_exists("vc_map"))
	gb_get_theme_file("/shortcodes/shortcodes.php");

//admin functions
gb_get_theme_file("/admin/functions.php");

function gb_theme_after_setup_theme()
{
	if(!get_option("gymbase_installed") || !get_option("wpb_js_content_types") || !get_option("gymbase_vc_access_rules"))
	{		
		$theme_options = array(
			"favicon_url" => get_template_directory_uri() . "/images/favicon.ico",
			"logo_url" => get_template_directory_uri() . "/images/logo.png",
			"logo_first_part_text" => "",
			"logo_second_part_text" => __("GYMBASE", 'gymbase'),
			"footer_text_left" => sprintf(__('© Copyright - <a title="%s" href="%s" target="_blank" rel="nofollow">GymBase Theme</a> by <a href="%s" title="%s" target="_blank">QuanticaLabs</a>', 'gymbase'), esc_attr__('GymBase Theme', 'gymbase'), esc_url(__('https://1.envato.market/gymbase-responsive-gym-fitness-wordpress-theme', 'gymbase')), esc_url(__('https://quanticalabs.com', 'gymbase')), esc_attr__('QuanticaLabs', 'gymbase')),
			"home_page_top_hint" => __("Give us a call: +123 356 123 124", 'gymbase'),
			"sticky_menu" => 1,
			"responsive" => 1,
			"scroll_top" => 1,
			"animations" => 1,
			"collapsible_mobile_submenus" => 1,
			"slider_image_url" => array("", "", ""),
			"slider_image_title" => array("", "", ""),
			"slider_image_subtitle" => array("", "", ""),
			"slider_image_link" => array("", "", ""),
			"slider_autoplay" => "true",
			"slide_interval" => 5000,
			"slider_effect" => "slide",
			"slider_transition" => "swing",
			"slider_transition_speed" => 500,
			"show_share_box" => "true",
			"social_icon_type" => array(),
			"social_icon_url" => array(),
			"social_icon_target"=> array(),
			"header_font" => "",
			"header_font_subset" => "",
			"subheader_font" => "",
			"subheader_font_subset" => "",
			"tertiary_font" => "",
			"tertiary_font_subset" => "",
			"google_api_code" => "",
			"google_recaptcha" => "",
			"google_recaptcha_comments" => "",
			"recaptcha_site_key" => "",
			"recaptcha_secret_key" => "",
			"collapsible_mobile_submenus" => 1,
			"ga_tracking_id" => "",
			"ga_tracking_code" => "",
			"header_background_color" => "",
			"body_background_color" => "",
			"footer_background_color" => "",
			"body_headers_color" => "",
			"body_headers_border_color" => "",
			"body_text_color" => "",
			"body_text2_color" => "",
			"footer_headers_color" => "",
			"footer_headers_border_color" => "",
			"footer_text_color" => "",
			"timeago_label_color" => "",
			"sentence_color" => "",
			"sentence_author_color" => "",
			"logo_first_part_text_color" => "",
			"logo_second_part_text_color" => "",
			"body_button_color" => "",
			"body_button_hover_color" => "",
			"body_button_background_color" => "",
			"body_button_hover_background_color" => "",
			"body_button_border_hover_color" => "",
			"body_button_border_color" => "",
			"footer_button_color" => "",
			"footer_button_hover_color" => "",
			"footer_button_background_color" => "",
			"footer_button_hover_background_color" => "",
			"footer_button_border_hover_color" => "",
			"footer_button_border_color" => "",
			"menu_link_color" => "",
			"menu_active_color" => "",
			"menu_hover_color" => "",
			"submenu_background_color" => "",
			"submenu_color" => "",
			"submenu_hover_color" => "",
			"mobile_menu_link_color" => "",
			"mobile_menu_link_hover_color" => "",
			"mobile_menu_position_background_color" => "",
			"mobile_menu_active_link_color" => "",
			"dropdownmenu_background_color" => "",
			"dropdownmenu_hover_background_color" => "",
			"dropdownmenu_text_color" => "",
			"dropdownmenu_hover_text_color" => "",
			"form_hint_color" => "",
			"form_field_label_color" => "",
			"form_field_text_color" => "",
			"form_field_border_color" => "",
			"link_color" => "",
			"link_hover_color" => "",
			"date_box_color" => "",
			"date_box_text_color" => "",
			"date_box_comments_number_text_color" => "",
			"date_box_comments_number_border_color" => "",
			"date_box_comments_number_hover_border_color" => "",
			"gallery_box_color" => "",
			"gallery_box_text_first_line_color" => "",
			"gallery_box_text_second_line_color" => "",
			"gallery_box_hover_color" => "",
			"gallery_box_hover_text_first_line_color" => "",
			"gallery_box_hover_text_second_line_color" => "",
			"timetable_box_color" => "",
			"timetable_box_hover_color" => "",
			"featured_icon_color" => "",
			"counter_box_progress_bar_color" => "",
			"counter_box_border_color" => "",
			"item_list_icon_color" => "",
			"pricing_box_price_color" => "",
			"bordered_columns_border_color" => "",
			"testimonials_icon_color" => "",
			"testimonials_border_color" => "",
			"gallery_details_box_border_color" => "",
			"bread_crumb_border_color" => "",
			"accordion_item_border_color" => "",
			"accordion_item_border_hover_color" => "",
			"accordion_item_border_active_color" => "",
			"copyright_area_border_color" => "",
			//"top_hint_background_color" => "",
			//"top_hint_text_color" => "",
			"comment_reply_button_color" => "",
			"post_author_link_color" => "",
			"contact_details_box_background_color" => "",
			"cf_admin_name" => get_option("admin_email"),
			"cf_admin_email" => get_option("admin_email"),
			"cf_admin_name_from" => "",
			"cf_admin_email_from" => "",
			"cf_smtp_host" => "",
			"cf_smtp_username" => "",
			"cf_smtp_password" => "",
			"cf_smtp_port" => "",
			"cf_smtp_secure" => "",
			"cf_email_subject" => __("GymBase WP: Contact from WWW", 'gymbase'),
			"cf_template" => "<html>
	<head>
	</head>
	<body>
		<div><b>First and last name</b>: [name]</div>
		<div><b>E-mail</b>: [email]</div>
		<div><b>Website</b>: [website]</div>
		<div><b>Message</b>: [message]</div>
	</body>
</html>",
			"cf_name_message" => __("Please enter your name.", 'gymbase'),
			"cf_email_message" => __("Please enter valid e-mail.", 'gymbase'),
			"cf_website_message" => __("Please enter website url.", 'gymbase'),
			"cf_message_message" => __("Please enter your message.", 'gymbase'),
			"cf_recaptcha_message" => __("Please verify captcha.", 'gymbase'),
			"cf_terms_message" => __("Checkbox is required.", 'gymbase'),
			"cf_thankyou_message" => __("Thank you for contacting us", 'gymbase'),
			"cf_error_message" => __("Sorry, we can't send this message", 'gymbase'),
			"cf_name_message_comments" => __("Please enter your name.", 'gymbase'),
			"cf_email_message_comments" => __("Please enter valid e-mail.", 'gymbase'),
			"cf_comment_message_comments" => __("Please enter your message.", 'gymbase'),
			"cf_recaptcha_message_comments" => __("Please verify captcha.", 'gymbase'),
			"cf_terms_message_comments" => __("Checkbox is required.", 'gymbase'),
			"cf_thankyou_message_comments" => __("Your comment has been added.", 'gymbase'),
			"cf_error_message_comments" => __("Error while adding comment.", 'gymbase'),
			"contact_logo_first_part_text" => __("GYM", 'gymbase'),
			"contact_logo_second_part_text" => __("BASE", 'gymbase'),
			"contact_phone" => __("+123 655 655", 'gymbase'),
			"contact_fax" => __("+123 755 755", 'gymbase'),
			"contact_email" => __("gymbase@mail.com", 'gymbase')
		);
		add_option("gymbase_options", $theme_options);
		
		add_option("wpb_js_content_types", array(
			"page",
			"classes",
			"trainers",
			"gymbase_gallery",)
		);
		
		$admin_role = get_role("administrator");
		$admin_role->add_cap("vc_access_rules_post_types", "custom" );
		$admin_role->add_cap("vc_access_rules_post_types/post");
		$admin_role->add_cap("vc_access_rules_post_types/page");
		$admin_role->add_cap("vc_access_rules_post_types/classes");
		$admin_role->add_cap("vc_access_rules_post_types/trainers");
		$admin_role->add_cap("vc_access_rules_post_types/gymbase_gallery");
		add_option("gymbase_vc_access_rules", 1);
		
		add_option("gymbase_installed", 1);
	}
	//set default cost calculator options
	if(is_plugin_active("ql-cost-calculator/ql-cost-calculator.php"))
	{
		if(!get_option("gymbase_cost_calculator_installed"))
		{
			$cost_calculator_global_form_options = array(
				"calculator_skin" => "gymbase",
				"main_color" => "409915",
				"box_color" => "222224",
				"text_color" => "FFFFFF",
				"border_color" => "515151",
				"label_color" => "FFFFFF",
				"form_label_color" => "FFFFFF",
				"inactive_color" => "343436",
				"primary_font_custom" => "",
				"primary_font" => "",
				"primary_font_subset" => "",
				"secondary_font_custom" => "",
				"secondary_font" => "",
				"secondary_font_subset" => "",
				"send_email" => 1,
				"save_calculation" => 1,
				"calculation_status" => "draft",
				"google_recaptcha" => 0,
				"recaptcha_site_key" => "",
				"recaptcha_secret_key" => ""
			);
			update_option("cost_calculator_global_form_options", $cost_calculator_global_form_options);
			add_option("gymbase_cost_calculator_installed", 1);
		}
	}

	//Make theme available for translation
	//Translations can be filed in the /languages/ directory
	load_theme_textdomain('gymbase', get_template_directory() . '/languages');
	
	//register blog post thumbnail & portfolio thumbnail
	add_theme_support("post-thumbnails");
	add_image_size("blog-post-thumb", 670, 447, true);
	add_image_size("gymbase-gallery-image", 615, 410, true);
	add_image_size("gymbase-gallery-medium-thumb", 480, 320, true);
	add_image_size("gymbase-gallery-square-thumb", 320, 320, true);
	
	//woocommerce
	add_theme_support("woocommerce", array(
		'gallery_thumbnail_image_width' => 150)
	);
	add_theme_support("wc-product-gallery-zoom");
	add_theme_support("wc-product-gallery-lightbox");
	add_theme_support("wc-product-gallery-slider");
	//enable custom background
	add_theme_support("custom-background"); //3.4
	//add_custom_background(); //deprecated
	//enable feed links
	add_theme_support("automatic-feed-links");
	//title tag
	add_theme_support("title-tag");
	
	//gutenberg
	add_theme_support("wp-block-styles");
	add_theme_support("align-wide");
	
	if(function_exists("register_nav_menu"))
	{
		register_nav_menu("main-menu", "Main Menu");
		register_nav_menu("footer-menu", "Footer Menu");
	}
	
	//custom theme filters
	add_filter('wp_title', 'gb_wp_title_filter', 10, 2);
	add_filter('upload_mimes', 'gb_custom_upload_files');
	add_filter('wp_list_categories','gb_category_count_span');
	add_filter('get_archives_link', 'gb_archive_count_span');
	add_filter('widget_tag_cloud_args', 'gb_set_tag_cloud_sizes');
	add_filter('site_transient_update_plugins', 'gb_filter_update_vc_plugin', 10, 2);
	add_filter("image_size_names_choose", "gb_theme_image_sizes");
	add_filter('excerpt_more', 'gb_theme_excerpt_more', 99);
	//using shortcodes in sidebar
	add_filter("widget_text", "do_shortcode");
		
	//custom theme woocommerce filters
	add_filter('woocommerce_pagination_args' , 'gb_woo_custom_override_pagination_args');
	add_filter('woocommerce_product_single_add_to_cart_text', 'gb_woo_custom_cart_button_text');
	add_filter('woocommerce_product_add_to_cart_text', 'gb_woo_custom_cart_button_text');
	add_filter('loop_shop_columns', 'gb_woo_custom_loop_columns');
	add_filter('woocommerce_product_description_heading', 'gb_woo_custom_product_description_heading');
	add_filter('woocommerce_checkout_fields' , 'gb_woo_custom_override_checkout_fields');
	add_filter('woocommerce_show_page_title', 'gb_woo_custom_show_page_title');
	add_filter('loop_shop_per_page', 'gb_loop_shop_per_page', 20);
	add_filter('woocommerce_review_gravatar_size', 'gb_woo_custom_review_gravatar_size');
	add_filter('theme_page_templates', 'gb_woocommerce_page_templates' , 11, 3);
	
	//custom theme actions
	add_action('wp_ajax_gymbase_get_font_subsets', 'gb_ajax_get_font_subsets');
	if(!function_exists('_wp_render_title_tag')) 
		add_action('wp_head', 'gb_theme_slug_render_title');
	//custom vc templates
	if(is_plugin_active("js_composer/js_composer.php") && function_exists("vc_set_default_editor_post_types"))
		add_action("vc_load_default_templates_action", "gb_custom_template_for_vc");
	
	//custom theme woocommerce actions
	remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_title', 5);
	remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_rating', 10);
	remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_price', 10);
	remove_action('woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_rating', 5);
	//remove_action('woocommerce_before_shop_loop', 'woocommerce_result_count', 20);
	add_action('woocommerce_single_product_summary', 'woocommerce_template_single_rating', 5);
	add_action('woocommerce_single_product_summary', 'woocommerce_template_single_title', 10);
	add_action('woocommerce_single_product_summary', 'woocommerce_template_single_price', 10);
	
	//phpMailer
	add_action('phpmailer_init', 'gb_phpmailer_init');
	
	//content width
	if(!isset($content_width)) 
		$content_width = 1230;
}
add_action("after_setup_theme", "gb_theme_after_setup_theme");
function gb_theme_switch_theme($theme_template)
{
	delete_option("gymbase_installed");
}
add_action("switch_theme", "gb_theme_switch_theme");

function gb_theme_widgets_init()
{
	//register sidebars
	if(function_exists("register_sidebar"))
	{
		//register custom sidebars
		$sidebars_list = get_posts(array( 
			'post_type' => 'gymbase_sidebars',
			'posts_per_page' => '-1',
			'post_status' => 'publish',
			'orderby' => 'menu_order',
			'order' => 'ASC'
		));
		if(count($sidebars_list))
		{
			foreach($sidebars_list as $sidebar)
			{
				$before_widget = get_post_meta($sidebar->ID, "before_widget", true);
				$after_widget = get_post_meta($sidebar->ID, "after_widget", true);
				$before_title = get_post_meta($sidebar->ID, "before_title", true);
				$after_title = get_post_meta($sidebar->ID, "after_title", true);
				register_sidebar(array(
					"id" => $sidebar->post_name,
					"name" => $sidebar->post_title,
					'before_widget' => ($before_widget!='' && $before_widget!='empty' ? $before_widget : ''),
					'after_widget' => ($after_widget!='' && $after_widget!='empty' ? $after_widget : ''),
					'before_title' => ($before_title!='' && $before_title!='empty' ? $before_title : ''),
					'after_title' => ($after_title!='' && $after_title!='empty' ? $after_title : '')
				));
			}
		}
		else
		{
			//backward compatibility with older versions of theme (12.1 and lower)
			register_sidebar(array(
				"id" => "home-top",
				"name" => __("Sidebar Home Top", 'gymbase'),
				'before_widget' => '',
				'after_widget' => '',
				'before_title' => '<h3>',
				'after_title' => '</h3>'
			));
			register_sidebar(array(
				"id" => "home-right",
				"name" => __("Sidebar Home Right", 'gymbase'),
				'before_widget' => '<div id="%1$s" class="widget %2$s sidebar-box">',
				'after_widget' => '</div>',
				'before_title' => '<h5 class="box-header">',
				'after_title' => '</h5>'
			));
			register_sidebar(array(
				"id" => "header-top",
				"name" => __("Sidebar Header Top", 'gymbase'),
				'before_widget' => '',
				'after_widget' => '',
				'before_title' => '',
				'after_title' => ''
			));
			register_sidebar(array(
				"id" => "header-top-right",
				"name" => __("Sidebar Header Top Right", 'gymbase'),
				'before_widget' => '',
				'after_widget' => '',
				'before_title' => '',
				'after_title' => ''
			));
			register_sidebar(array(
				"id" => "header",
				"name" => __("Sidebar Header", 'gymbase'),
				'before_widget' => '',
				'after_widget' => '',
				'before_title' => '',
				'after_title' => ''
			));
			register_sidebar(array(
				"id" => "right",
				"name" => __("Sidebar Right", 'gymbase'),
				'before_widget' => '',
				'after_widget' => '',
				'before_title' => '<h3>',
				'after_title' => '</h3>'
			));
			register_sidebar(array(
				"id" => "blog",
				"name" => __("Sidebar Blog", 'gymbase'),
				'before_widget' => '<div id="%1$s" class="widget %2$s sidebar-box">',
				'after_widget' => '</div>',
				'before_title' => '<h5 class="box-header animation-slide">',
				'after_title' => '</h5>'
			));
			register_sidebar(array(
				"id" => "footer-top",
				"name" => __("Sidebar Footer Top", 'gymbase'),
				'before_widget' => '',
				'after_widget' => '',
				'before_title' => '<h3>',
				'after_title' => '</h3>'
			));
			register_sidebar(array(
				"id" => "footer-bottom",
				"name" => __("Sidebar Footer Bottom", 'gymbase'),
				'before_widget' => '<div id="%1$s" class="widget %2$s vc_col-sm-4 wpb_column vc_column_container">',
				'after_widget' => '</div>',
				'before_title' => '<h5 class="box-header animation-slide">',
				'after_title' => '</h5>'
			));
			register_sidebar(array(
				"id" => "sidebar-shop",
				"name" => __("Sidebar Shop", 'gymbase'),
				'before_widget' => '<div id="%1$s" class="widget %2$s sidebar-box">',
				'after_widget' => '</div>',
				'before_title' => '<h5 class="box-header">',
				'after_title' => '</h5>'
			));
		}
		register_widget("gb_cart_icon_widget");
		register_widget("gb_classes_widget");
		register_widget("gb_contact_details_widget");
		register_widget("gb_footer_box_widget");
		register_widget("gb_home_box_widget");
		register_widget("gb_scrolling_most_commented_widget");
		register_widget("gb_scrolling_most_viewed_widget");
		register_widget("gb_scrolling_recent_posts_widget");
		register_widget("gb_social_icons_widget");
		register_widget("gb_upcoming_classes_widget");
	}
}
add_action("widgets_init", "gb_theme_widgets_init");

//theme options
global $theme_options;
$theme_options = array(
	"favicon_url" => '',
	"logo_url" => '',
	"logo_first_part_text" => '',
	"logo_second_part_text" => '',
	"footer_text_left" => '',
	"home_page_top_hint" => '',
	"sticky_menu" => '',
	"responsive" => '',
	"scroll_top" => '',
	"animations" => '',
	"collapsible_mobile_submenus" => '',
	"terms_checkbox_comments" => '',
	"terms_message_comments" => '',
	"google_api_code" => '',
	"google_recaptcha" => '',
	"google_recaptcha_comments" => '',
	"recaptcha_site_key" =>'',
	"recaptcha_secret_key" => '',
	"ga_tracking_id" => '',
	"ga_tracking_code" => '',
	"slider_image_url" => '',
	"slider_image_title" => '',
	"slider_image_subtitle" => '',
	"slider_image_link" => '',
	"slider_autoplay" => '',
	"slide_interval" => '',
	"slider_effect" => '',
	"slider_transition" => '',
	"slider_transition_speed" => '',
	"show_share_box" => '',
	"social_icon_type" => '',
	"social_icon_url" => '',
	"social_icon_target" => '',
	"cf_admin_name" => '',
	"cf_admin_email" => '',
	"cf_admin_name_from" => '',
	"cf_admin_email_from" => '',
	"cf_smtp_host" => '',
	"cf_smtp_username" => '',
	"cf_smtp_password" => '',
	"cf_smtp_port" => '',
	"cf_smtp_secure" => '',
	"cf_email_subject" => '',
	"cf_template" => '',
	"cf_name_message" => '',
	"cf_email_message" => '',
	"cf_website_message" => '',
	"cf_message_message" => '',
	"cf_recaptcha_message" => '',
	"cf_terms_message" => '',
	"cf_thankyou_message" => '',
	"cf_error_message" => '',
	"cf_name_message_comments" => '',
	"cf_email_message_comments" => '',
	"cf_comment_message_comments" => '',
	"cf_recaptcha_message_comments" => '',
	"cf_terms_message_comments" => '',
	"cf_thankyou_message_comments" => '',
	"cf_error_message_comments" => '',
	"contact_logo_first_part_text" => '',
	"contact_logo_second_part_text" => '',
	"contact_phone" => '',
	"contact_fax" => '',
	"contact_email" => '',
	"header_background_color" => '',
	"body_background_color" => '',
	"footer_background_color" => '',
	"link_color" => '',
	"link_hover_color" => '',
	"body_headers_color" => '',
	"body_headers_border_color" => '',
	"body_text_color" => '',
	"body_text2_color" => '',
	"footer_headers_color" => '',
	"footer_headers_border_color" => '',
	"footer_text_color" => '',
	"timeago_label_color" => '',
	"sentence_color" => '',
	"sentence_author_color" => '',
	"logo_first_part_text_color" => '',
	"logo_second_part_text_color" => '',
	"body_button_color" => '',
	"body_button_hover_color" => '',
	"body_button_background_color" => '',
	"body_button_hover_background_color" => '',
	"body_button_border_color" => '',
	"body_button_border_hover_color" => '',
	"footer_button_color" => '',
	"footer_button_hover_color" => '',
	"footer_button_background_color" => '',
	"footer_button_hover_background_color" => '',
	"footer_button_border_color" => '',
	"footer_button_border_hover_color" => '',
	"menu_link_color" => '',
	"menu_active_color" => '',
	"menu_hover_color" => '',
	"submenu_background_color" => '',
	"submenu_color" => '',
	"submenu_hover_color" => '',
	"mobile_menu_link_color" => '',
	"mobile_menu_link_hover_color" => '',
	"mobile_menu_position_background_color" => '',
	"mobile_menu_active_link_color" => '',
	"dropdownmenu_background_color" => '',
	"dropdownmenu_hover_background_color" => '',
	"dropdownmenu_text_color" => '',
	"dropdownmenu_hover_text_color" => '',
	"form_hint_color" => '',
	"form_field_label_color" => '',
	"form_field_text_color" => '',
	"form_field_border_color" => '',
	"date_box_color" => '',
	"date_box_text_color" => '',
	"date_box_comments_number_text_color" => '',
	"date_box_comments_number_border_color" => '',
	"date_box_comments_number_hover_border_color" => '',
	"gallery_box_color" => '',
	"gallery_box_text_first_line_color" => '',
	"gallery_box_text_second_line_color" => '',
	"gallery_box_hover_color" => '',
	"gallery_box_hover_text_first_line_color" => '',
	"gallery_box_hover_text_second_line_color" => '',
	"timetable_box_color" => '',
	"timetable_box_hover_color" => '',
	"featured_icon_color" => '',
	"counter_box_progress_bar_color" => '',
	"counter_box_border_color" => '',
	"item_list_icon_color" => '',
	"pricing_box_price_color" => '',
	"bordered_columns_border_color" => '',
	"testimonials_icon_color" => '',
	"testimonials_border_color" => '',
	"gallery_details_box_border_color" => '',
	"bread_crumb_border_color" => '',
	"accordion_item_border_color" => '',
	"accordion_item_border_hover_color" => '',
	"accordion_item_border_active_color" => '',
	"copyright_area_border_color" => '',
	"top_hint_background_color" => '',
	"top_hint_text_color" => '',
	"comment_reply_button_color" => '',
	"post_author_link_color" => '',
	"contact_details_box_background_color" => '',
	"header_font" => '',
	"header_font_subset" => '',
	"subheader_font" => '',
	"subheader_font_subset" => '',
	"tertiary_font" => '',
	"tertiary_font_subset" => ''
);
$theme_options = gb_theme_stripslashes_deep(array_merge($theme_options, (array)get_option("gymbase_options")));

function gb_theme_enqueue_scripts()
{
	global $theme_options;
	//style
	if(!empty($theme_options["header_font"]))
	{
		wp_enqueue_style("google-font-header", "//fonts.googleapis.com/css?family=" . urlencode($theme_options["header_font"]) . (!empty($theme_options["header_font_subset"]) ? "&subset=" . implode(",", $theme_options["header_font_subset"]) : ""));
	}
	else
	{
		wp_enqueue_style("google-font-raleway", "//fonts.googleapis.com/css?family=Raleway:300,400,500,600&amp;subset=latin,latin-ext");
	}
	if(!empty($theme_options["subheader_font"]))
	{
		wp_enqueue_style("google-font-subheader", "//fonts.googleapis.com/css?family=" . urlencode($theme_options["subheader_font"]) . (!empty($theme_options["subheader_font_subset"]) ? "&subset=" . implode(",", $theme_options["subheader_font_subset"]) : ""));
	}
	else
	{
		wp_enqueue_style("google-font-lato", "//fonts.googleapis.com/css?family=Lato:400&amp;subset=latin,latin-ext");
	}
	if(!empty($theme_options["tertiary_font"]))
	{
		wp_enqueue_style("google-font-tertiary", "//fonts.googleapis.com/css?family=" . urlencode($theme_options["tertiary_font"]) . (!empty($theme_options["tertiary_font_subset"]) ? "&subset=" . implode(",", $theme_options["tertiary_font_subset"]) : ""));
	}
	else
	{
		wp_enqueue_style("google-font-garamond", "//fonts.googleapis.com/css?family=EB+Garamond:400i&amp;subset=latin,latin-ext");
	}
	wp_enqueue_style("reset", get_template_directory_uri() . "/style/reset.css");
	wp_enqueue_style("superfish", get_template_directory_uri() . "/style/superfish.css");
	wp_enqueue_style("prettyPhoto", get_template_directory_uri() ."/style/prettyPhoto.css");
	//wp_enqueue_style("jquery-fancybox", get_template_directory_uri() . "/style/fancybox/jquery.fancybox.css");
	wp_enqueue_style("jquery-qtip", get_template_directory_uri() . "/style/jquery.qtip.css");
	wp_enqueue_style("odometer", get_template_directory_uri() ."/style/odometer-theme-default.css");
	if(((int)$theme_options["animations"] || !isset($theme_options["animations"])) && (isset($_COOKIE["gb_animations"]) && $_COOKIE["gb_animations"]==1 || !isset($_COOKIE["gb_animations"])))
	{
		wp_enqueue_style("animations", get_template_directory_uri() ."/style/animations.css");
		if(is_rtl())
			wp_enqueue_style("animations", get_template_directory_uri() ."/style/animations_rtl.css");
	}
	wp_enqueue_style("main", get_stylesheet_uri());
	if((int)$theme_options["responsive"])
		wp_enqueue_style("responsive", get_template_directory_uri() . "/style/responsive.css");
	else
		wp_enqueue_style("no-responsive", get_template_directory_uri() . "/style/no_responsive.css");

	if(is_plugin_active('woocommerce/woocommerce.php'))
	{
		wp_enqueue_style("woocommerce-custom", get_template_directory_uri() ."/woocommerce/style.css");
		if((int)$theme_options["responsive"])
			wp_enqueue_style("woocommerce-responsive", get_template_directory_uri() ."/woocommerce/responsive.css");
		else
			wp_dequeue_style("woocommerce-smallscreen");
	}
	wp_enqueue_style("gb-template", get_template_directory_uri() ."/fonts/template/style.css");
	wp_enqueue_style("gb-features", get_template_directory_uri() ."/fonts/features/style.css");
	wp_enqueue_style("gb-social", get_template_directory_uri() ."/fonts/social/style.css");
	
	wp_enqueue_style("custom", get_template_directory_uri() . "/custom.css");
	
	ob_start();
	gb_get_theme_file("/custom_colors.php");
	$custom_colors_css = ob_get_clean();
	wp_add_inline_style("custom", $custom_colors_css);
	
	//js
	wp_enqueue_script("jquery");
	wp_enqueue_script("jquery-ui-core", array("jquery"));
	wp_enqueue_script("jquery-ui-accordion", array("jquery"));
	wp_enqueue_script("jquery-ui-tabs", array("jquery"));
	wp_enqueue_script("jquery-ba-bqq", get_template_directory_uri() . "/js/jquery.ba-bbq.min.js", array("jquery"));
	wp_enqueue_script("jquery-easing", get_template_directory_uri() . "/js/jquery.easing.1.4.1.js", array("jquery"));
	wp_enqueue_script("jquery-carouFredSel", get_template_directory_uri() . "/js/jquery.carouFredSel-6.2.1-packed.js", array("jquery"));
	wp_enqueue_script("jquery-timeago", get_template_directory_uri() . "/js/jquery.timeago.js", array("jquery"));
	wp_enqueue_script("jquery-hint", get_template_directory_uri() . "/js/jquery.hint.js", array("jquery"));
	wp_enqueue_script("jquery-imagesloaded", get_template_directory_uri() . "/js/jquery.imagesloaded-packed.js", array("jquery"));
	wp_enqueue_script("jquery-isotope", get_template_directory_uri() . "/js/jquery.isotope-packed.js", array("jquery"));
	wp_enqueue_script("jquery-prettyPhoto", get_template_directory_uri() ."/js/jquery.prettyPhoto.js", array("jquery"), false, true);
	//wp_enqueue_script("jquery-fancybox", get_template_directory_uri() . "/js/jquery.fancybox-1.3.4.pack.js", array("jquery"));
	wp_enqueue_script("jquery-qtip", get_template_directory_uri() . "/js/jquery.qtip.min.js", array("jquery"));
	wp_enqueue_script("jquery-block-ui", get_template_directory_uri() . "/js/jquery.blockUI.js", array("jquery"));
	wp_enqueue_script("jquery-parallax", get_template_directory_uri() ."/js/jquery.parallax.min.js", array("jquery"), false, true);
	wp_enqueue_script("jquery-odometer", get_template_directory_uri() ."/js/odometer.min.js", array("jquery", "theme-main" ), false, true);
	if(!empty($theme_options['ga_tracking_id']))
	{
		wp_enqueue_script("google-analytics", "https://www.googletagmanager.com/gtag/js?id=" . esc_attr($theme_options["ga_tracking_id"]), array(), false, true);
	}
	wp_register_script("google-maps-v3", "//maps.google.com/maps/api/js" . ($theme_options["google_api_code"]!="" ? "?key=" . esc_attr($theme_options["google_api_code"]) : ""), array(), false, true);
	wp_register_script("google-recaptcha-v2", "https://google.com/recaptcha/api.js", array(), false, true);
	if(function_exists("is_customize_preview") && !is_customize_preview())
		wp_enqueue_script("theme-main", get_template_directory_uri() . "/js/main.js", array("jquery", "jquery-ui-core", "jquery-ui-accordion", "jquery-ui-tabs"));
	if(!empty($theme_options['ga_tracking_id']))
	{
		$inline_script = "window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', '" . $theme_options['ga_tracking_id'] . "');";
		wp_add_inline_script("google-analytics", $inline_script);
	}
	if(!empty($theme_options['ga_tracking_code']))
	{
		$inline_script = $theme_options['ga_tracking_code'];
		wp_add_inline_script("jquery", $inline_script);
	}
	
	//ajaxurl
	$data["ajaxurl"] = admin_url("admin-ajax.php");
	//themename
	$data["themename"] = "gymbase";
	//slider
	$data["slider_autoplay"] = $theme_options["slider_autoplay"];
	$data["slide_interval"] = $theme_options["slide_interval"];
	$data["slider_effect"] = $theme_options["slider_effect"];
	$data["slider_transition"] = $theme_options["slider_transition"];
	$data["slider_transition_speed"] = $theme_options["slider_transition_speed"];
	//pass data to javascript
	$params = array(
		'l10n_print_after' => 'config = ' . json_encode($data) . ';'
	);
	wp_localize_script("theme-main", "config", $params);
}
add_action("wp_enqueue_scripts", "gb_theme_enqueue_scripts", 12);

//function to display number of posts
function getPostViews($postID)
{
    $count_key = 'post_views_count';
    $count = get_post_meta($postID, $count_key, true);
    if($count=='')
	{
        delete_post_meta($postID, $count_key);
        add_post_meta($postID, $count_key, '0');
    }
    return (int)$count;
}

//function to count views
function setPostViews($postID) 
{
    $count_key = 'post_views_count';
    $count = get_post_meta($postID, $count_key, true);
    if($count=='')
	{
        delete_post_meta($postID, $count_key);
        add_post_meta($postID, $count_key, 1);
    }
	else
	{
        $count++;
        update_post_meta($postID, $count_key, $count);
    }
}
/* --- phpMailer config --- */
function gb_phpmailer_init($mail) 
{
	global $theme_options;
	$mail->CharSet='UTF-8';

	$smtp = $theme_options["cf_smtp_host"];
	if(!empty($smtp))
	{
		$mail->IsSMTP();
		$mail->SMTPAuth = true; 
		//$mail->SMTPDebug = 2;
		$mail->Host = $theme_options["cf_smtp_host"];
		$mail->Username = $theme_options["cf_smtp_username"];
		$mail->Password = $theme_options["cf_smtp_password"];
		if((int)$theme_options["cf_smtp_port"]>0)
			$mail->Port = (int)$theme_options["cf_smtp_port"];
		$mail->SMTPSecure = $theme_options["cf_smtp_secure"];
	}
}

if(!function_exists('_wp_render_title_tag')) 
{
    function gb_theme_slug_render_title() 
	{
		echo ''. wp_title('-', true, 'right') . '';
    }
}
function gb_wp_title_filter($title, $sep)
{
	//$title = get_bloginfo('name') . " | " . (is_home() || is_front_page() ? get_bloginfo('description') : $title);
	return $title;
}

function gb_custom_template_for_vc() 
{
    $data = array();
    $data['name'] = __('Single Post Template', 'gymbase');
    $data['weight'] = 0;
    $data['image_path'] = preg_replace( '/\s/', '%20', get_template_directory_uri() . '/admin/images/visual_composer/layout.png');
    $data['custom_class'] = 'custom_template_for_vc_custom_template';
    $data['content'] = <<<CONTENT
		[vc_row top_margin="page-margin-top-section"][vc_column width="2/3"][single_post show_post_title="1" show_post_featured_image="1" show_post_excerpt="0" show_post_date="1" show_post_date_image="1" show_post_views="1" show_post_comments="1" show_post_author="1" show_post_categories="1" show_post_tags="1" show_share_box="1" icons_count="3" icon_type0="twitter" icon_url0="https://twitter.com/intent/tweet?text={URL}" icon_target0="_blank" icon_type1="facebook" icon_url1="https://www.facebook.com/sharer/sharer.php?u={URL}" icon_target1="_blank" icon_type2="pinterest" icon_url2="https://pinterest.com/pin/create/button/?url=&amp;media={URL}" icon_target2="_blank" show_post_tags_bottom="0"][comments show_comments_form="1" terms_checkbox="1" show_comments_list="1" top_margin="page-margin-top-section"][/vc_column][vc_column width="1/3"][vc_widget_sidebar sidebar_id="blog"][/vc_column][/vc_row]
CONTENT;
    vc_add_default_templates($data);
	
	$data = array();
    $data['name'] = __('Blog Template', 'gymbase');
    $data['weight'] = 0;
    $data['image_path'] = preg_replace( '/\s/', '%20', get_template_directory_uri() . '/admin/images/visual_composer/layout.png');
    $data['custom_class'] = 'custom_template_for_vc_custom_template';
    $data['content'] = <<<CONTENT
		[vc_row top_margin="page-margin-top-section"][vc_column width="2/3"][blog pagination="1" count="3"][/vc_column][vc_column width="1/3"][vc_widget_sidebar sidebar_id="blog"][/vc_column][/vc_row]
CONTENT;
    vc_add_default_templates($data);
	
	$data = array();
    $data['name'] = __('Search Template', 'gymbase');
    $data['weight'] = 0;
    $data['image_path'] = preg_replace( '/\s/', '%20', get_template_directory_uri() . '/admin/images/visual_composer/layout.png');
    $data['custom_class'] = 'custom_template_for_vc_custom_template';
    $data['content'] = <<<CONTENT
		[vc_row top_margin="page-margin-top-section"][vc_column width="2/3"][blog pagination="1" count="3"][/vc_column][vc_column width="1/3"][vc_widget_sidebar sidebar_id="blog"][/vc_column][/vc_row]
CONTENT;
    vc_add_default_templates($data);
	
	$data = array();
    $data['name'] = __('Single Class Template', 'gymbase');
    $data['weight'] = 0;
    $data['image_path'] = preg_replace( '/\s/', '%20', get_template_directory_uri() . '/admin/images/visual_composer/layout.png');
    $data['custom_class'] = 'custom_template_for_vc_custom_template';
    $data['content'] = <<<CONTENT
		[vc_row top_margin="page-margin-top-section"][vc_column][single_class][/vc_column][/vc_row]
CONTENT;
    vc_add_default_templates($data);
	
	$data = array();
    $data['name'] = __('Single Gallery Template', 'gymbase');
    $data['weight'] = 0;
    $data['image_path'] = preg_replace( '/\s/', '%20', get_template_directory_uri() . '/admin/images/visual_composer/layout.png');
    $data['custom_class'] = 'custom_template_for_vc_custom_template';
    $data['content'] = <<<CONTENT
		[vc_row][vc_column][single_gallery][/vc_column][/vc_row]
CONTENT;
    vc_add_default_templates($data);
	
	$data = array();
    $data['name'] = __('Single Trainer Template', 'gymbase');
    $data['weight'] = 0;
    $data['image_path'] = preg_replace( '/\s/', '%20', get_template_directory_uri() . '/admin/images/visual_composer/layout.png');
    $data['custom_class'] = 'custom_template_for_vc_custom_template';
    $data['content'] = <<<CONTENT
		[vc_row top_margin="page-margin-top-section"][vc_column][single_trainer][/vc_column][/vc_row]
CONTENT;
    vc_add_default_templates($data);
	
	$data = array();
    $data['name'] = __('Trainer Layout Template', 'gymbase');
    $data['weight'] = 0;
    $data['image_path'] = preg_replace( '/\s/', '%20', get_template_directory_uri() . '/admin/images/visual_composer/layout.png');
    $data['custom_class'] = 'custom_template_for_vc_custom_template';
    $data['content'] = <<<CONTENT
		[vc_row][vc_column width="1/2"][vc_column_text el_class="padding-top-0 padding-right-70"]Amitee first got into Crossfit in 2015 as a member at Crossfit Youth and became an over night addict, not only to the results of the workouts but to the community of people. Fitness has always played a major part in Amitee's life, as a teenager he was playing national level hockey and competing in Athletics.

On his quest to become a better coach Amitee went on several different courses to improve his knowledge in the different areas of Crossfit ranging from weightlifting to gymnastics.[/vc_column_text][vc_single_image image="1034" img_size="full" add_caption="yes" onclick="link_image" el_class="margin-top-20"][/vc_column][vc_column width="1/2"][vc_single_image image="1034" img_size="full" add_caption="yes" onclick="link_image"][vc_column_text el_class="margin-top-20 padding-left-70"]On this quest to become a better coach Liam went on several different courses to improve his knowledge in the different areas of Crossfit ranging from weightlifting to gymnastics. Amitee has really taken to Olympic weightlifting and has recently qualified for the United States of America Championships.[/vc_column_text][vc_column_text el_class="align-left padding-left-70"]
<blockquote>Of course it's hard. It's supposed to be hard. If it were easy, everybody would do it. Hard is what makes it great
<label>LIAM HARPAUL</label></blockquote>
[/vc_column_text][/vc_column][/vc_row][vc_row el_class="margin-top-20"][vc_column][vc_separator][/vc_column][/vc_row][vc_row top_margin="page-margin-top"][vc_column width="1/3"][box_header type="h4" bottom_border="0" class="margin-top-28"]Qualifications[/box_header][items_list bottom_border="0" additembutton="" class="margin-top-20"][item icon="arrow-horizontal-7" border_color="none"]Certificate III &amp; IV personal trainer[/item][item icon="arrow-horizontal-7" border_color="none"]2 Years Experience[/item][item icon="arrow-horizontal-7" border_color="none"]Certified First Aid &amp; CPR[/item][item icon="arrow-horizontal-7" border_color="none"]BWL Level 1 Award in Coaching Weight Lifting[/item][item icon="arrow-horizontal-7" border_color="none"]Level 1 Award in Strenght &amp; Conditioning[/item][/items_list][/vc_column][vc_column width="2/3"][vc_row_inner][vc_column_inner el_class="padding-box" width="1/3"][vc_column_text el_class="gb-subtitle"]POSITION[/vc_column_text][box_header type="h4" bottom_border="0"]Fitness Coach[/box_header][vc_column_text el_class="gb-subtitle margin-top-30"]HOMETOWN[/vc_column_text][box_header type="h4" bottom_border="0"]Oakland[/box_header][vc_column_text el_class="gb-subtitle margin-top-30"]LANGUAGES[/vc_column_text][box_header type="h4" bottom_border="0"]Englisch, French[/box_header][/vc_column_inner][vc_column_inner el_class="padding-box" width="1/3" css=".vc_custom_1576249259195{background-color: #409915 !important;}"][vc_column_text el_class="gb-subtitle"]EXPERIENCE[/vc_column_text][box_header type="h4" bottom_border="0"]12 years[/box_header][vc_column_text el_class="gb-subtitle margin-top-30"]STRESS BUSTER[/vc_column_text][box_header type="h4" bottom_border="0"]Heavy squats[/box_header][vc_column_text el_class="gb-subtitle margin-top-30"]INSTAGRAM[/vc_column_text][box_header type="h4" bottom_border="0"]@amitee_loiselle[/box_header][/vc_column_inner][vc_column_inner el_class="padding-box" width="1/3"][vc_column_text el_class="gb-subtitle"]TWITTER[/vc_column_text][box_header type="h4" bottom_border="0"]@_loiselle[/box_header][vc_column_text el_class="gb-subtitle margin-top-30"]EMAIL[/vc_column_text][box_header type="h4" bottom_border="0"]coach@gymbase.com[/box_header][/vc_column_inner][/vc_row_inner][/vc_column][/vc_row][vc_row top_margin="page-margin-top"][vc_column][vc_separator][/vc_column][/vc_row][vc_row][vc_column][box_header type="h2" bottom_border="1" animation="1" class="align-center" top_margin="page-margin-top-section"]Join Amitee's Classes[/box_header][vc_column_text el_class="align-center margin-top-10"]Want to get fitter, leaner and stronger? Amitee's classes will kick you into shape in no time.[/vc_column_text][timetable hour_category="Loiselle" classes_url="https://quanticalabs.com/wp_themes/gymbase/classes" filter_title="" row_height="62" tip_block="1"][/vc_column][/vc_row]
CONTENT;
    vc_add_default_templates($data);
	
	$data = array();
    $data['name'] = __('Class Layout Template', 'gymbase');
    $data['weight'] = 0;
    $data['image_path'] = preg_replace( '/\s/', '%20', get_template_directory_uri() . '/admin/images/visual_composer/layout.png');
    $data['custom_class'] = 'custom_template_for_vc_custom_template';
    $data['content'] = <<<CONTENT
		[vc_row][vc_column width="1/2"][box_header type="h2" bottom_border="0"]Active Adults is a high-energy fitness class with moves that cater for total beginners to total addicts[/box_header][vc_column_text el_class="margin-top-20"]The class is lead by an instructor who leads participants through various exercises to a contemporary music soundtrack. The aim is to develop numerous domains of physical fitness, particularly cardiovascular fitness, cardio stamina and flexibility.[/vc_column_text][vc_row_inner el_class="margin-top-20"][vc_column_inner width="1/3"][vc_column_text el_class="gb-subtitle"]Intensity[/vc_column_text][box_header type="h4" bottom_border="0"]Medium - High[/box_header][/vc_column_inner][vc_column_inner width="1/3"][vc_column_text el_class="gb-subtitle"]Feel[/vc_column_text][box_header type="h4" bottom_border="0"]Empowered[/box_header][/vc_column_inner][vc_column_inner width="1/3"][vc_column_text el_class="gb-subtitle"]Maximize[/vc_column_text][box_header type="h4" bottom_border="0"]Cardio Stamina[/box_header][/vc_column_inner][/vc_row_inner][/vc_column][vc_column width="1/2"][box_header type="h4" bottom_border="0"]Class Benefits[/box_header][vc_row_inner type="counters-group" el_class="margin-top-30"][vc_column_inner width="1/4"][counter_box value="35" value_sign="%" class="gray"]Strength[/counter_box][/vc_column_inner][vc_column_inner width="1/4"][counter_box value="75" value_sign="%"]Cardio[/counter_box][/vc_column_inner][vc_column_inner width="1/4"][counter_box value="100" value_sign="%"]Fat Burning[/counter_box][/vc_column_inner][vc_column_inner width="1/4"][counter_box value="60" value_sign="%"]Flexibility[/counter_box][/vc_column_inner][/vc_row_inner][/vc_column][/vc_row][vc_row type="full-width" top_margin="page-margin-top-section" el_class="flex-box"][vc_column width="2/3" css=".vc_custom_1580821938102{background-color: #28282a !important;}" el_class="column-limited padding-top-100 padding-bottom-100"][vc_row_inner][vc_column_inner width="1/2"][featured_item icon="document-missing" title="No long-term contract" title_link="1" title_border="1" icon_link="1"]Our popular month to month plan is offered as pay as you work-out with no longterm contract[/featured_item][featured_item icon="gym-2" title="Best equipment" title_link="1" title_border="1" icon_link="1" top_margin="page-margin-top"]Practice on the best equipment global brands that addresses a wide range of people[/featured_item][/vc_column_inner][vc_column_inner width="1/2"][featured_item icon="stopwatch" title="Excercise round the clock" title_link="1" title_border="1" icon_link="1"]Take advantage from gym's benefits 24 hours a day, 7 days a week in each plans available[/featured_item][featured_item icon="tablet" title="Dedicated gym app" title_link="1" title_border="1" icon_link="1" top_margin="page-margin-top"]App users can book space at your gym's classes, with personal trainers[/featured_item][/vc_column_inner][/vc_row_inner][/vc_column][vc_column width="1/3" css=".vc_custom_1582809738743{background-image: url(https://quanticalabs.com/wptest/gymbase-new/files/2020/02/placeholder-640.png?id=1035) !important;background-position: center !important;background-repeat: no-repeat !important;background-size: cover !important;}"][vc_single_image image="1034" img_size="full" el_class="flex-hide"][/vc_column][/vc_row][vc_row el_class="margin-top-100"][vc_column width="1/2"][vc_row_inner el_class="side-items"][vc_column_inner][vc_single_image image="1037" img_size="full" onclick="link_image" el_class="side-image"][vc_single_image image="1037" img_size="full" alignment="right" onclick="link_image" el_class="margin-top-100"][vc_raw_html el_class="side-table"]JTNDZGl2JTIwY2xhc3MlM0QlMjJ0YWJsZS1jb250YWluZXIlMjIlM0UlMEElM0N0YWJsZSUyMGNsYXNzJTNEJTIybWFyZ2luLXRvcC00MCUyMGFsdGVybmF0ZSUyMiUzRSUwQSUwOSUzQ3RoZWFkJTNFJTBBJTA5JTA5JTNDdHIlM0UlMEElMDklMDklMDklM0N0aCUyMGNvbHNwYW4lM0QlMjIyJTIyJTNFJTNDaDQlM0VDbGFzcyUyMFByaWNlcyUzQyUyRmg0JTNFJTNDJTJGdGglM0UlMEElMDklMDklM0MlMkZ0ciUzRSUwQSUwOSUzQyUyRnRoZWFkJTNFJTBBJTA5JTNDdGJvZHklM0UlMEElMDklMDklM0N0ciUzRSUwQSUwOSUwOSUwOSUzQ3RkJTNFJTNDZGl2JTNFRHJvcC1pbiUzQyUyRmRpdiUzRSUzQyUyRnRkJTNFJTBBJTA5JTA5JTA5JTNDdGQlM0UlM0NkaXYlM0UlMjQ1LjkwJTNDJTJGZGl2JTNFJTNDJTJGdGQlM0UlMEElMDklMDklM0MlMkZ0ciUzRSUwQSUwOSUwOSUzQ3RyJTNFJTBBJTA5JTA5JTA5JTNDdGQlM0UlM0NkaXYlM0UxMCUyMFB1bmNoJTIwUGFzcyUzQyUyRmRpdiUzRSUzQyUyRnRkJTNFJTBBJTA5JTA5JTA5JTNDdGQlM0UlM0NkaXYlM0UlMjQ0Ny4yMCUzQyUyRmRpdiUzRSUzQyUyRnRkJTNFJTBBJTA5JTA5JTNDJTJGdHIlM0UlMEElMDklMDklM0N0ciUzRSUwQSUwOSUwOSUwOSUzQ3RkJTNFJTNDZGl2JTNFMS1Nb250aCUyMFBhc3MlM0MlMkZkaXYlM0UlM0MlMkZ0ZCUzRSUwQSUwOSUwOSUwOSUzQ3RkJTNFJTNDZGl2JTNFJTI0NDUuMDAlM0MlMkZkaXYlM0UlM0MlMkZ0ZCUzRSUwQSUwOSUwOSUzQyUyRnRyJTNFJTBBJTA5JTA5JTNDdHIlM0UlMEElMDklMDklMDklM0N0ZCUzRSUzQ2RpdiUzRTMtTW9udGglMjBQYXNzJTNDJTJGZGl2JTNFJTNDJTJGdGQlM0UlMEElMDklMDklMDklM0N0ZCUzRSUzQ2RpdiUzRSUyNDEyOC45MCUzQyUyRmRpdiUzRSUzQyUyRnRkJTNFJTBBJTA5JTA5JTNDJTJGdHIlM0UlMEElMDklMDklM0N0ciUzRSUwQSUwOSUwOSUwOSUzQ3RkJTNFJTNDZGl2JTNFMS1ZZWFyJTIwUGFzcyUzQyUyRmRpdiUzRSUzQyUyRnRkJTNFJTBBJTA5JTA5JTA5JTNDdGQlM0UlM0NkaXYlM0UlMjQ0MDUuMDAlM0MlMkZkaXYlM0UlM0MlMkZ0ZCUzRSUwQSUwOSUwOSUzQyUyRnRyJTNFJTBBJTA5JTNDJTJGdGJvZHklM0UlMEElM0MlMkZ0YWJsZSUzRSUwQSUzQyUyRmRpdiUzRQ==[/vc_raw_html][/vc_column_inner][/vc_row_inner][/vc_column][vc_column width="1/2" el_class="padding-left-70"][box_header type="h5" bottom_border="1" animation="1"]Get Started[/box_header][box_header type="h2" bottom_border="0" class="margin-top-30"]What to know for your first Active Adults class[/box_header][vc_column_text el_class="margin-top-10"]The Active Adults is all about sports-inspired moves. Because there is the option to do a lot of running and jumping, cross-training sneakers with padding are ideal. You may feel most comfortable in shorts and a dry-fit shirt that provides plenty of wicking for sweat.[/vc_column_text][vc_column_text el_class="padding-top-0"]Active Adults is aerobics, sports and strength combined, incorporating your entire body. If you're just starting out, you'll be given low-impact options that'll tailor each workout to your fitness level.[/vc_column_text][box_header type="h4" bottom_border="0" class="margin-top-10"]What to Bring to Class[/box_header][items_list bottom_border="1" animation="0" additembutton="" class="margin-top-20"][item value="" url="" url_target="new_window" icon="arrow-horizontal-7" text_color="" value_color="" border_color="none"]Water bootle (water will be available)[/item][item value="" url="" url_target="new_window" icon="arrow-horizontal-7" text_color="" value_color="" border_color="none"]Towel[/item][item value="" url="" url_target="new_window" icon="arrow-horizontal-7" text_color="" value_color="" border_color="none"]Loose-fitting tank tops and shorts[/item][item value="" url="" url_target="new_window" icon="arrow-horizontal-7" text_color="" value_color="" border_color="none"]High-athletic socks and sweatbands[/item][item value="" url="" url_target="new_window" icon="arrow-horizontal-7" text_color="" value_color="" border_color="none"]High-impact sports bra (women)[/item][/items_list][/vc_column][/vc_row]
CONTENT;
    vc_add_default_templates($data);
}

//add new mimes for upload dummy content files (code can be removed after dummy content import)
function gb_custom_upload_files($mimes) 
{
	$mimes = array_merge($mimes, array('xml' => 'application/xml'), array('json' => 'application/json'), array('zip' => 'application/zip'), array('gz' => 'application/x-gzip'), array('ico' => 'image/x-icon'));
    return $mimes;
}
function gb_filter_update_vc_plugin($date) 
{
    if(!empty($date->checked["js_composer/js_composer.php"]))
        unset($date->checked["js_composer/js_composer.php"]);
    if(!empty($date->response["js_composer/js_composer.php"]))
        unset($date->response["js_composer/js_composer.php"]);
    return $date;
}
function gb_theme_image_sizes($sizes)
{
	$addsizes = array(
		"blog-post-thumb" => __("Blog post thumbnail", 'gymbase'),
		"gymbase-gallery-image" => __("Gallery image", 'gymbase'),
		"gymbase-gallery-medium-thumb" => __("Gallery medium thumbnail", 'gymbase'),
		"gymbase-gallery-square-thumb" => __("Gallery square thumbnail", 'gymbase')
	);
	$newsizes = array_merge($sizes, $addsizes);
	return $newsizes;
}
function gb_category_count_span($links) 
{
	$links = str_replace('</a> (', '<span>', $links);
	$links = str_replace('</a> <span class="count">(', '<span>', $links);
	$links = str_replace(')</span>', '</span></a>', $links);
	$links = str_replace(')', '</span></a>', $links);
	return $links;
}
function gb_archive_count_span($links) 
{
	if(strpos($links, "option")===false)
	{
		$links = str_replace('</a>&nbsp;(', '<span>', $links);
		$links = str_replace(')', '</span></a>', $links);
	}
	return $links;
}
function gb_set_tag_cloud_sizes($args)
{
	$args['smallest'] = 12;
	$args['default'] = 12;
	$args['largest'] = 12;
	$args['unit'] = "px";
	return $args;
}
//excerpt
function gb_theme_excerpt_more($more) 
{
	return '';
}

/* --- Theme WooCommerce Custom Filters Functions --- */
function gb_woo_custom_override_pagination_args($args) 
{
	$args['prev_text'] = __('&lsaquo;', 'gymbase');
	$args['next_text'] = __('&rsaquo;', 'gymbase');
	return $args;
}

function gb_woo_custom_cart_button_text() 
{
	return __('Add to cart', 'gymbase');
}

if(!function_exists('loop_columns')) 
{
	function gb_woo_custom_loop_columns() 
	{
		return 3; // 3 products per row
	}
}

function gb_woo_custom_product_description_heading() 
{
    return '';
}

function gb_woo_custom_show_page_title()
{
	return false;
}

function gb_loop_shop_per_page($cols)
{
	return 6;
}

function gb_woo_custom_override_checkout_fields($fields) 
{
	$fields['billing']['billing_first_name']['placeholder'] = __("First Name", 'gymbase');
	$fields['billing']['billing_last_name']['placeholder'] = __("Last Name", 'gymbase');
	$fields['billing']['billing_company']['placeholder'] = __("Company Name", 'gymbase');
	$fields['billing']['billing_email']['placeholder'] = __("Email Address", 'gymbase');
	$fields['billing']['billing_phone']['placeholder'] = __("Phone", 'gymbase');
	return $fields;
}

function gb_woo_custom_review_gravatar_size()
{
	return 100;
}

function gb_woocommerce_page_templates($page_templates, $class, $post)
{
	if(is_plugin_active('woocommerce/woocommerce.php'))
	{
		$shop_page_id = wc_get_page_id('shop');
		if($post && absint($shop_page_id) === absint($post->ID))
		{
			$page_templates["path-to-template/full-width.php"] = "Template Name";
		}
	}
 	return $page_templates;
}

/**
 * Returns datetime in iso8601 format
 * @param type $time - optional string representation of datetime
 * @return type - datetime in iso8601 format
 */
function get_datetime_iso8601($time = null) 
{
	$offset = get_option('gmt_offset');
	$timezone = ($offset < 0 ? '-' : '+') . (abs($offset)<10 ? '0'.abs($offset) : abs($offset)) . '00' ;
	return date('Y-m-d\TH:i:s', (empty($time) ? time() : strtotime($time))) . $timezone;
}

// default locate_template() method returns file PATH, we need file URL for javascript and css
//function locate_template_uri($file)
//{
//	$website_path = str_replace("\\", "/", realpath(ABSPATH));
//	$site_url = site_url();
//	$file_path = str_replace("\\", "/", locate_template(ltrim($file, "/")));
//	$file_url = str_replace($website_path, $site_url, $file_path);
//	return $file_url;
//}
function gb_get_theme_file($file)
{
	if(file_exists(get_stylesheet_directory() . $file))
        require_once(get_stylesheet_directory() . $file);
    else
        require_once(get_template_directory() . $file);
}

//gymbase get_font_subsets
function gb_ajax_get_font_subsets()
{
	if($_POST["font"]!="")
	{
		$subsets = '';
		$fontExplode = explode(":", $_POST["font"]);
		$subsets_array = gb_get_google_font_subset($fontExplode[0]);
		
		foreach($subsets_array as $subset)
			$subsets .= '<option value="' . esc_attr($subset) . '">' . $subset . '</option>';
		
		echo "gb_start" . $subsets . "gb_end";
	}
	exit();
}

/**
 * Returns array of Google Fonts
 * @return array of Google Fonts
 */
function gb_get_google_fonts()
{
	//get google fonts
	$fontsArray = get_option("gymbase_google_fonts");
	//update if option doesn't exist or it was modified more than 2 weeks ago
	if($fontsArray===FALSE || count((array)$fontsArray)==0 || (time()-$fontsArray->last_update>2*7*24*60*60))
	{
		$google_api_url = 'https://quanticalabs.com/.tools/GoogleFont/font.txt';
		$fontsJson = wp_remote_retrieve_body(wp_remote_get($google_api_url, array('sslverify' => false )));
		$fontsArray = json_decode($fontsJson);
		$fontsArray->last_update = time();		
		update_option("gymbase_google_fonts", $fontsArray);
	}
	return $fontsArray;
}

/**
 * Returns array of subsets for provided Google Font
 * @param type $font - Google font
 * @return array of subsets for provided Google Font
 */
function gb_get_google_font_subset($font)
{
	$subsets = array();
	//get google fonts
	$fontsArray = gb_get_google_fonts();		
	$fontsCount = count($fontsArray->items);
	for($i=0; $i<$fontsCount; $i++)
	{
		if($fontsArray->items[$i]->family==$font)
		{
			for($j=0, $max=count($fontsArray->items[$i]->subsets); $j<$max; $j++)
			{
				$subsets[] = $fontsArray->items[$i]->subsets[$j];
			}
			break;
		}
	}
	return $subsets;
}