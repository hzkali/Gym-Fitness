<?php
//admin menu
function gb_theme_admin_menu() 
{
	add_theme_page(__("Theme Options", 'gymbase') ,__("Theme Options", 'gymbase'), "edit_theme_options", "ThemeOptions", "gymbase_options");
}
add_action("admin_menu", "gb_theme_admin_menu");

function gb_theme_stripslashes_deep($value)
{
	$value = is_array($value) ?
				array_map('stripslashes_deep', $value) :
				stripslashes($value);

	return $value;
}

function gymbase_save_options()
{
	ob_start();
	$theme_options = array(
		"favicon_url" => $_POST["favicon_url"],
		"logo_url" => $_POST["logo_url"],
		"logo_first_part_text" => $_POST["logo_first_part_text"],
		"logo_second_part_text" => $_POST["logo_second_part_text"],
		"footer_text_left" => $_POST["footer_text_left"],
		"home_page_top_hint" => $_POST["home_page_top_hint"],
		"sticky_menu" => (int)$_POST["sticky_menu"],
		"responsive" => (int)$_POST["responsive"],
		"scroll_top" => (int)$_POST["scroll_top"],
		"animations" => (int)$_POST["animations"],
		"collapsible_mobile_submenus" => $_POST["collapsible_mobile_submenus"],
		"google_api_code" => $_POST["google_api_code"],
		"google_recaptcha" => $_POST["google_recaptcha"],
		"google_recaptcha_comments" => $_POST["google_recaptcha_comments"],
		"recaptcha_site_key" => $_POST["recaptcha_site_key"],
		"recaptcha_secret_key" => $_POST["recaptcha_secret_key"],
		"ga_tracking_id" => $_POST["ga_tracking_id"],
		"ga_tracking_code" => $_POST["ga_tracking_code"],
		"slider_image_url" => array_filter($_POST["slider_image_url"]),
		"slider_image_title" => array_filter($_POST["slider_image_title"]),
		"slider_image_subtitle" => array_filter($_POST["slider_image_subtitle"]),
		"slider_image_link" => array_filter($_POST["slider_image_link"]),
		"slider_autoplay" => $_POST["slider_autoplay"],
		"slide_interval" => (int)$_POST["slide_interval"],
		"slider_effect" => $_POST["slider_effect"],
		"slider_transition" => $_POST["slider_transition"],
		"slider_transition_speed" => (int)$_POST["slider_transition_speed"],
		"show_share_box" => $_POST["show_share_box"],
		"social_icon_type" => $_POST["social_icon_type"],
		"social_icon_url" => $_POST["social_icon_url"],
		"social_icon_target" => $_POST["social_icon_target"],
		"cf_admin_name" => $_POST["cf_admin_name"],
		"cf_admin_email" => $_POST["cf_admin_email"],
		"cf_admin_name_from" => $_POST["cf_admin_name_from"],
		"cf_admin_email_from" => $_POST["cf_admin_email_from"],
		"cf_smtp_host" => $_POST["cf_smtp_host"],
		"cf_smtp_username" => $_POST["cf_smtp_username"],
		"cf_smtp_password" => $_POST["cf_smtp_password"],
		"cf_smtp_port" => $_POST["cf_smtp_port"],
		"cf_smtp_secure" => $_POST["cf_smtp_secure"],
		"cf_email_subject" => $_POST["cf_email_subject"],
		"cf_template" => $_POST["cf_template"],
		"cf_name_message" => $_POST["cf_name_message"],
		"cf_email_message" => $_POST["cf_email_message"],
		"cf_website_message" => $_POST["cf_website_message"],
		"cf_message_message" => $_POST["cf_message_message"],
		"cf_recaptcha_message" => $_POST["cf_recaptcha_message"],
		"cf_terms_message" => $_POST["cf_terms_message"],
		"cf_thankyou_message" => $_POST["cf_thankyou_message"],
		"cf_error_message" => $_POST["cf_error_message"],
		"cf_name_message_comments" => $_POST["cf_name_message_comments"],
		"cf_email_message_comments" => $_POST["cf_email_message_comments"],
		"cf_comment_message_comments" => $_POST["cf_comment_message_comments"],
		"cf_recaptcha_message_comments" => $_POST["cf_recaptcha_message_comments"],
		"cf_terms_message_comments" => $_POST["cf_terms_message_comments"],
		"cf_thankyou_message_comments" => $_POST["cf_thankyou_message_comments"],
		"cf_error_message_comments" => $_POST["cf_error_message_comments"],
		"contact_logo_first_part_text" => $_POST["contact_logo_first_part_text"],
		"contact_logo_second_part_text" => $_POST["contact_logo_second_part_text"],
		"contact_phone" => $_POST["contact_phone"],
		"contact_fax" => $_POST["contact_fax"],
		"contact_email" => $_POST["contact_email"],
		"header_background_color" => $_POST["header_background_color"],
		"body_background_color" => $_POST["body_background_color"],
		"footer_background_color" => $_POST["footer_background_color"],
		"link_color" => $_POST["link_color"],
		"link_hover_color" => $_POST["link_hover_color"],
		"body_headers_color" => $_POST["body_headers_color"],
		"body_headers_border_color" => $_POST["body_headers_border_color"],
		"body_text_color" => $_POST["body_text_color"],
		"body_text2_color" => $_POST["body_text2_color"],
		"footer_headers_color" => $_POST["footer_headers_color"],
		"footer_headers_border_color" => $_POST["footer_headers_border_color"],
		"footer_text_color" => $_POST["footer_text_color"],
		"timeago_label_color" => $_POST["timeago_label_color"],
		"sentence_color" => $_POST["sentence_color"],
		"sentence_author_color" => $_POST["sentence_author_color"],
		"logo_first_part_text_color" => $_POST["logo_first_part_text_color"],
		"logo_second_part_text_color" => $_POST["logo_second_part_text_color"],
		"body_button_color" => $_POST["body_button_color"],
		"body_button_hover_color" => $_POST["body_button_hover_color"],
		"body_button_background_color" => $_POST["body_button_background_color"],
		"body_button_hover_background_color" => $_POST["body_button_hover_background_color"],
		"body_button_border_color" => $_POST["body_button_border_color"],
		"body_button_border_hover_color" => $_POST["body_button_border_hover_color"],
		"footer_button_color" => $_POST["footer_button_color"],
		"footer_button_hover_color" => $_POST["footer_button_hover_color"],
		"footer_button_background_color" => $_POST["footer_button_background_color"],
		"footer_button_hover_background_color" => $_POST["footer_button_hover_background_color"],
		"footer_button_border_color" => $_POST["footer_button_border_color"],
		"footer_button_border_hover_color" => $_POST["footer_button_border_hover_color"],
		"menu_link_color" => $_POST["menu_link_color"],
		"menu_active_color" => $_POST["menu_active_color"],
		"menu_hover_color" => $_POST["menu_hover_color"],
		"submenu_background_color" => $_POST["submenu_background_color"],
		"submenu_color" => $_POST["submenu_color"],
		"submenu_hover_color" => $_POST["submenu_hover_color"],
		"mobile_menu_link_color" => $_POST["mobile_menu_link_color"],
		"mobile_menu_link_hover_color" => $_POST["mobile_menu_link_hover_color"],
		"mobile_menu_position_background_color" => $_POST["mobile_menu_position_background_color"],
		"mobile_menu_active_link_color" => $_POST["mobile_menu_active_link_color"],
		"dropdownmenu_background_color" => $_POST["dropdownmenu_background_color"],
		"dropdownmenu_hover_background_color" => $_POST["dropdownmenu_hover_background_color"],
		"dropdownmenu_text_color" => $_POST["dropdownmenu_text_color"],
		"dropdownmenu_hover_text_color" => $_POST["dropdownmenu_hover_text_color"],
		"form_hint_color" => $_POST["form_hint_color"],
		"form_field_label_color" => $_POST["form_field_label_color"],
		"form_field_text_color" => $_POST["form_field_text_color"],
		"form_field_border_color" => $_POST["form_field_border_color"],
		"date_box_color" => $_POST["date_box_color"],
		"date_box_text_color" => $_POST["date_box_text_color"],
		"date_box_comments_number_text_color" => $_POST["date_box_comments_number_text_color"],
		"date_box_comments_number_border_color" => $_POST["date_box_comments_number_border_color"],
		"date_box_comments_number_hover_border_color" => $_POST["date_box_comments_number_hover_border_color"],
		"gallery_box_color" => $_POST["gallery_box_color"],
		"gallery_box_text_first_line_color" => $_POST["gallery_box_text_first_line_color"],
		"gallery_box_text_second_line_color" => $_POST["gallery_box_text_second_line_color"],
		"gallery_box_hover_color" => $_POST["gallery_box_hover_color"],
		"gallery_box_hover_text_first_line_color" => $_POST["gallery_box_hover_text_first_line_color"],
		"gallery_box_hover_text_second_line_color" => $_POST["gallery_box_hover_text_second_line_color"],
		"timetable_box_color" => $_POST["timetable_box_color"],
		"timetable_box_hover_color" => $_POST["timetable_box_hover_color"],
		"featured_icon_color" => $_POST["featured_icon_color"],
		"counter_box_progress_bar_color" => $_POST["counter_box_progress_bar_color"],
		"counter_box_border_color" => $_POST["counter_box_border_color"],
		"item_list_icon_color" => $_POST["item_list_icon_color"],
		"pricing_box_price_color" => $_POST["pricing_box_price_color"],
		"bordered_columns_border_color" => $_POST["bordered_columns_border_color"],
		"testimonials_icon_color" => $_POST["testimonials_icon_color"],
		"testimonials_border_color" => $_POST["testimonials_border_color"],
		"gallery_details_box_border_color" => $_POST["gallery_details_box_border_color"],
		"bread_crumb_border_color" => $_POST["bread_crumb_border_color"],
		"accordion_item_border_color" => $_POST["accordion_item_border_color"],
		"accordion_item_border_hover_color" => $_POST["accordion_item_border_hover_color"],
		"accordion_item_border_active_color" => $_POST["accordion_item_border_active_color"],
		"copyright_area_border_color" => $_POST["copyright_area_border_color"],
		//"top_hint_background_color" => $_POST["top_hint_background_color"],
		//"top_hint_text_color" => $_POST["top_hint_text_color"],
		"comment_reply_button_color" => $_POST["comment_reply_button_color"],
		"post_author_link_color" => $_POST["post_author_link_color"],
		"contact_details_box_background_color" => $_POST["contact_details_box_background_color"],
		"header_font" => $_POST["header_font"],
		"header_font_subset" => (isset($_POST["header_font_subset"]) ? $_POST["header_font_subset"] : ""),
		"subheader_font" => $_POST["subheader_font"],
		"subheader_font_subset" => (isset($_POST["subheader_font_subset"]) ? $_POST["subheader_font_subset"] : ""),
		"tertiary_font" => $_POST["tertiary_font"],
		"tertiary_font_subset" => (isset($_POST["tertiary_font_subset"]) ? $_POST["tertiary_font_subset"] : "")
	);
	update_option("gymbase_options", $theme_options);
	$system_message = ob_get_clean();
	$_POST["system_message"] = $system_message;
	echo json_encode($_POST);
	exit();
}
add_action('wp_ajax_gymbase_save', 'gymbase_save_options');

function gymbase_options() 
{
	if(isset($_POST["action"]) && $_POST["action"]=="gymbase_save")
	{
		$theme_options = (array)get_option("gymbase_options");
		$theme_options = array(
			"logo_url" => $_POST["logo_url"],
			"logo_first_part_text" => $_POST["logo_first_part_text"],
			"logo_second_part_text" => $_POST["logo_second_part_text"],
			"footer_text_left" => $_POST["footer_text_left"],
			"home_page_top_hint" => $_POST["home_page_top_hint"],
			"sticky_menu" => (int)$_POST["sticky_menu"],
			"responsive" => (int)$_POST["responsive"],
			"scroll_top" => (int)$_POST["scroll_top"],
			"animations" => (int)$_POST["animations"],
			"collapsible_mobile_submenus" => $_POST["collapsible_mobile_submenus"],
			"google_api_code" => $_POST["google_api_code"],
			"google_recaptcha" => $_POST["google_recaptcha"],
			"google_recaptcha_comments" => $_POST["google_recaptcha_comments"],
			"recaptcha_site_key" => $_POST["recaptcha_site_key"],
			"recaptcha_secret_key" => $_POST["recaptcha_secret_key"],
			"ga_tracking_id" => $_POST["ga_tracking_id"],
			"ga_tracking_code" => $_POST["ga_tracking_code"],
			"slider_image_url" => array_filter($_POST["slider_image_url"]),
			"slider_image_title" => array_filter($_POST["slider_image_title"]),
			"slider_image_subtitle" => array_filter($_POST["slider_image_subtitle"]),
			"slider_image_link" => array_filter($_POST["slider_image_link"]),
			"slider_autoplay" => $_POST["slider_autoplay"],
			"slide_interval" => (int)$_POST["slide_interval"],
			"slider_effect" => $_POST["slider_effect"],
			"slider_transition" => $_POST["slider_transition"],
			"slider_transition_speed" => (int)$_POST["slider_transition_speed"],
			"show_share_box" => $_POST["show_share_box"],
			"social_icon_type" => $_POST["social_icon_type"],
			"social_icon_url" => $_POST["social_icon_url"],
			"social_icon_target" => $_POST["social_icon_target"],
			"cf_admin_name" => $_POST["cf_admin_name"],
			"cf_admin_email" => $_POST["cf_admin_email"],
			"cf_admin_name_from" => $_POST["cf_admin_name_from"],
			"cf_admin_email_from" => $_POST["cf_admin_email_from"],
			"cf_smtp_host" => $_POST["cf_smtp_host"],
			"cf_smtp_username" => $_POST["cf_smtp_username"],
			"cf_smtp_password" => $_POST["cf_smtp_password"],
			"cf_smtp_port" => $_POST["cf_smtp_port"],
			"cf_smtp_secure" => $_POST["cf_smtp_secure"],
			"cf_email_subject" => $_POST["cf_email_subject"],
			"cf_template" => $_POST["cf_template"],
			"cf_name_message" => $_POST["cf_name_message"],
			"cf_email_message" => $_POST["cf_email_message"],
			"cf_website_message" => $_POST["cf_website_message"],
			"cf_message_message" => $_POST["cf_message_message"],
			"cf_recaptcha_message" => $_POST["cf_recaptcha_message"],
			"cf_terms_message" => $_POST["cf_terms_message"],
			"cf_thankyou_message" => $_POST["cf_thankyou_message"],
			"cf_error_message" => $_POST["cf_error_message"],
			"cf_name_message_comments" => $_POST["cf_name_message_comments"],
			"cf_email_message_comments" => $_POST["cf_email_message_comments"],
			"cf_comment_message_comments" => $_POST["cf_comment_message_comments"],
			"cf_recaptcha_message_comments" => $_POST["cf_recaptcha_message_comments"],
			"cf_terms_message_comments" => $_POST["cf_terms_message_comments"],
			"cf_thankyou_message_comments" => $_POST["cf_thankyou_message_comments"],
			"cf_error_message_comments" => $_POST["cf_error_message_comments"],
			"contact_logo_first_part_text" => $_POST["contact_logo_first_part_text"],
			"contact_logo_second_part_text" => $_POST["contact_logo_second_part_text"],
			"contact_phone" => $_POST["contact_phone"],
			"contact_fax" => $_POST["contact_fax"],
			"contact_email" => $_POST["contact_email"],
			"header_background_color" => $_POST["header_background_color"],
			"body_background_color" => $_POST["body_background_color"],
			"footer_background_color" => $_POST["footer_background_color"],
			"link_color" => $_POST["link_color"],
			"link_hover_color" => $_POST["link_hover_color"],
			"body_headers_color" => $_POST["body_headers_color"],
			"body_headers_border_color" => $_POST["body_headers_border_color"],
			"body_text_color" => $_POST["body_text_color"],
			"body_text2_color" => $_POST["body_text2_color"],
			"footer_headers_color" => $_POST["footer_headers_color"],
			"footer_headers_border_color" => $_POST["footer_headers_border_color"],
			"footer_text_color" => $_POST["footer_text_color"],
			"timeago_label_color" => $_POST["timeago_label_color"],
			"sentence_color" => $_POST["sentence_color"],
			"sentence_author_color" => $_POST["sentence_author_color"],
			"logo_first_part_text_color" => $_POST["logo_first_part_text_color"],
			"logo_second_part_text_color" => $_POST["logo_second_part_text_color"],
			"body_button_color" => $_POST["body_button_color"],
			"body_button_hover_color" => $_POST["body_button_hover_color"],
			"body_button_background_color" => $_POST["body_button_background_color"],
			"body_button_hover_background_color" => $_POST["body_button_hover_background_color"],
			"body_button_border_color" => $_POST["body_button_border_color"],
			"body_button_border_hover_color" => $_POST["body_button_border_hover_color"],
			"footer_button_color" => $_POST["footer_button_color"],
			"footer_button_hover_color" => $_POST["footer_button_hover_color"],
			"footer_button_background_color" => $_POST["footer_button_background_color"],
			"footer_button_hover_background_color" => $_POST["footer_button_hover_background_color"],
			"footer_button_border_color" => $_POST["footer_button_border_color"],
			"footer_button_border_hover_color" => $_POST["footer_button_border_hover_color"],
			"menu_link_color" => $_POST["menu_link_color"],
			"menu_active_color" => $_POST["menu_active_color"],
			"menu_hover_color" => $_POST["menu_hover_color"],
			"submenu_background_color" => $_POST["submenu_background_color"],
			"submenu_color" => $_POST["submenu_color"],
			"submenu_hover_color" => $_POST["submenu_hover_color"],
			"mobile_menu_link_color" => $_POST["mobile_menu_link_color"],
			"mobile_menu_link_hover_color" => $_POST["mobile_menu_link_hover_color"],
			"mobile_menu_position_background_color" => $_POST["mobile_menu_position_background_color"],
			"mobile_menu_active_link_color" => $_POST["mobile_menu_active_link_color"],
			"dropdownmenu_background_color" => $_POST["dropdownmenu_background_color"],
			"dropdownmenu_hover_background_color" => $_POST["dropdownmenu_background_color"],
			"dropdownmenu_text_color" => $_POST["dropdownmenu_text_color"],
			"dropdownmenu_hover_text_color" => $_POST["dropdownmenu_text_color"],
			"form_hint_color" => $_POST["form_hint_color"],
			"form_field_label_color" => $_POST["form_field_label_color"],
			"form_field_text_color" => $_POST["form_field_text_color"],
			"form_field_border_color" => $_POST["form_field_border_color"],
			"date_box_color" => $_POST["date_box_color"],
			"date_box_text_color" => $_POST["date_box_text_color"],
			"date_box_comments_number_text_color" => $_POST["date_box_comments_number_text_color"],
			"date_box_comments_number_border_color" => $_POST["date_box_comments_number_border_color"],
			"date_box_comments_number_hover_border_color" => $_POST["date_box_comments_number_hover_border_color"],
			"gallery_box_text_first_line_color" => $_POST["gallery_box_text_first_line_color"],
			"gallery_box_text_second_line_color" => $_POST["gallery_box_text_second_line_color"],
			"gallery_box_hover_color" => $_POST["gallery_box_hover_color"],
			"gallery_box_hover_text_first_line_color" => $_POST["gallery_box_hover_text_first_line_color"],
			"gallery_box_hover_text_second_line_color" => $_POST["gallery_box_hover_text_second_line_color"],
			"timetable_box_color" => $_POST["timetable_box_color"],
			"timetable_box_hover_color" => $_POST["timetable_box_hover_color"],
			"featured_icon_color" => $_POST["featured_icon_color"],
			"counter_box_progress_bar_color" => $_POST["counter_box_progress_bar_color"],
			"counter_box_border_color" => $_POST["counter_box_border_color"],
			"item_list_icon_color" => $_POST["item_list_icon_color"],
			"pricing_box_price_color" => $_POST["pricing_box_price_color"],
			"bordered_columns_border_color" => $_POST["bordered_columns_border_color"],
			"testimonials_icon_color" => $_POST["testimonials_icon_color"],
			"testimonials_border_color" => $_POST["testimonials_border_color"],
			"gallery_details_box_border_color" => $_POST["gallery_details_box_border_color"],
			"bread_crumb_border_color" => $_POST["bread_crumb_border_color"],
			"accordion_item_border_color" => $_POST["accordion_item_border_color"],
			"accordion_item_border_hover_color" => $_POST["accordion_item_border_hover_color"],
			"accordion_item_border_active_color" => $_POST["accordion_item_border_active_color"],
			"copyright_area_border_color" => $_POST["copyright_area_border_color"],
			//"top_hint_background_color" => $_POST["top_hint_background_color"],
			//"top_hint_text_color" => $_POST["top_hint_text_color"],
			"comment_reply_button_color" => $_POST["comment_reply_button_color"],
			"post_author_link_color" => $_POST["post_author_link_color"],
			"contact_details_box_background_color" => $_POST["contact_details_box_background_color"],
			"header_font" => $_POST["header_font"],
			"subheader_font" => $_POST["subheader_font"],
			"tertiary_font" => $_POST["tertiary_font"]
		);
		update_option("gymbase_options", $theme_options);
	}
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
		//"top_hint_background_color" => '',
		//"top_hint_text_color" => '',
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
	$theme_options = gb_theme_stripslashes_deep(array_merge($theme_options, get_option("gymbase_options"))); 
	if(isset($_POST["action"]) && $_POST["action"]=="gymbase_save")
	{
	?>
	<div class="updated"> 
		<p>
			<strong>
				<?php _e('Options saved', 'gymbase'); ?>
			</strong>
		</p>
	</div>
	<?php
	}
	//get google fonts	
	$fontsArray = gb_get_google_fonts();	
	?>
	<form class="theme_options" action="<?php echo esc_url($_SERVER['REQUEST_URI']); ?>" method="post" id="theme-options-panel">
		<div class="header">
			<div class="header_left">
				<h3>
					<a href="<?php echo esc_url(__('https://1.envato.market/quanticalabs-portfolio-themeforest', 'gymbase')); ?>" title="<?php esc_attr_e("QuanticaLabs", 'gymbase'); ?>">
						<?php _e("QuanticaLabs", 'gymbase'); ?>
					</a>
				</h3>
				<h5><?php _e("Theme Options", 'gymbase'); ?></h5>
			</div>
			<div class="header_right">
				<div class="description">
					<h3>
						<a href="<?php echo esc_url(__('https://1.envato.market/gymbase-responsive-gym-fitness-wordpress-theme', 'gymbase')); ?>" title="<?php esc_attr_e("GymBase - Gym Fitness WordPress Theme", 'gymbase'); ?>" rel="nofollow">
							<?php _e("Gymbase - Gym Fitness WordPress Theme", 'gymbase'); ?>
						</a>
					</h3>
					<h5><?php _e("Version 14.6", 'gymbase'); ?></h5>
					<a class="description_link" target="_blank" href="<?php echo esc_url(get_template_directory_uri() . '/documentation/index.html'); ?>"><?php _e("Documentation", 'gymbase'); ?></a>
					<a class="description_link" target="_blank" href="<?php echo esc_url(__('https://support.quanticalabs.com', 'gymbase')); ?>"><?php _e("Support Forum", 'gymbase'); ?></a>
					<a class="description_link" target="_blank" href="<?php echo esc_url(__('https://1.envato.market/gymbase-responsive-gym-fitness-wordpress-theme', 'gymbase')); ?>" rel="nofollow"><?php _e("Theme site", 'gymbase'); ?></a>
				</div>
				<a class="logo" href="<?php echo esc_url(__('https://1.envato.market/quanticalabs-portfolio-themeforest', 'gymbase')); ?>" title="<?php esc_attr_e("QuanticaLabs", 'gymbase'); ?>">
					&nbsp;
				</a>
			</div>
		</div>
		<div class="content clearfix">
			<ul class="menu">
				<li>
					<a href='#tab-main' class="selected">
						<span class="dashicons dashicons-hammer"></span>
						<?php _e('Main', 'gymbase'); ?>
					</a>
				</li>
				<?php
				/*<li>
					<a href="#tab-slider">
						<?php _e('Slider', 'gymbase'); ?>
						<span class="plugin"></span>
					</a>
				</li>*/
				?>
				<li>
					<a href="#tab-contact-form">
						<span class="dashicons dashicons-email-alt"></span>
						<?php _e('Contact Form', 'gymbase'); ?>
					</a>
				</li>
				<?php
				/*
				<li>
					<a href="#tab-social-share">
						<?php _e('Social Share', 'gymbase'); ?>
						<span class="plugin"></span>
					</a>
				</li>
				<li>
					<a href="#tab-contact-details">
						<?php _e('Contact Details', 'gymbase'); ?>
						<span class="plugin"></span>
					</a>
				</li>*/
				?>
				<li>
					<a href="#tab-colors">
						<span class="dashicons dashicons-art"></span>
						<?php _e('Colors', 'gymbase'); ?>
					</a>
					<ul class="submenu">
						<li>
							<a href="#tab-colors_general">
								<?php _e('General', 'gymbase'); ?>
							</a>
						</li>
						<li>
							<a href="#tab-colors_text">
								<?php _e('Text', 'gymbase'); ?>
							</a>
						</li>
						<li>
							<a href="#tab-colors_buttons">
								<?php _e('Buttons', 'gymbase'); ?>
							</a>
						</li>
						<li>
							<a href="#tab-colors_menu">
								<?php _e('Menu', 'gymbase'); ?>
							</a>
						</li>
						<li>
							<a href="#tab-colors_forms">
								<?php _e('Forms', 'gymbase'); ?>
							</a>
						</li>
						<li>
							<a href="#tab-colors_miscellaneous">
								<?php _e('Miscellaneous', 'gymbase'); ?>
							</a>
						</li>
					</ul>
				</li>
				<li>
					<a href="#tab-fonts">
						<span class="dashicons dashicons-editor-textcolor"></span>
						<?php _e('Fonts', 'gymbase'); ?>
					</a>
				</li>
			</ul>
			<div id="tab-main" class="settings" style="display: block;">
				<h3><?php _e('Main', 'gymbase'); ?></h3>
				<ul class="form_field_list">
					<?php
					if(is_plugin_active('ql_importer/ql_importer.php'))
					{
					?>
					<li>
						<label for="import_dummy"><?php _e('DUMMY CONTENT IMPORT', 'gymbase'); ?></label>
						<input type="button" class="button" name="gymbase_import_dummy" id="import_dummy" value="<?php esc_attr_e('Import dummy content', 'gymbase'); ?>">
						<img id="dummy_content_preloader" src="<?php echo esc_url(get_template_directory_uri() . '/admin/images/ajax-loader.gif'); ?>">
						<img id="dummy_content_tick" src="<?php echo esc_url(get_template_directory_uri() . '/admin/images/tick.png'); ?>">
						<div id="dummy_templates_sidebars">
							<label class="small_label" for="import_templates_sidebars"><input type="checkbox" name="gymbase_import_templates_sidebars" id="import_templates_sidebars" value="1"><?php _e('Import only template pages and sidebars', 'gymbase'); ?></label>
						</div>
						<div id="dummy_content_info"></div>
					</li>
					<?php
					if(is_plugin_active('woocommerce/woocommerce.php')):
					?>
					<li>
						<label for="import_shop_dummy"><?php _e('DUMMY SHOP CONTENT IMPORT', 'gymbase'); ?></label>
						<input type="button" class="button" name="gymbase_import_shop_dummy" id="import_shop_dummy" value="<?php esc_attr_e('Import shop dummy content', 'gymbase'); ?>">
						<img id="dummy_shop_content_preloader" src="<?php echo esc_url(get_template_directory_uri() . '/admin/images/ajax-loader.gif'); ?>">
						<img id="dummy_shop_content_tick" src="<?php echo esc_url(get_template_directory_uri() . '/admin/images/tick.png'); ?>">
						<div id="dummy_shop_content_info"></div>
					</li>
					<?php
					endif;
					}
					else
					{
					?>
					<li>
						<label for="import_dummy"><?php _e('DUMMY CONTENT IMPORT', 'gymbase'); ?></label>
						<label class="small_label"><?php printf(__('Please <a href="%s" title="Install Plugins">install and activate</a> Theme Dummy Content Importer plugin to enable dummy content import option.', 'gymbase'), menu_page_url('install-required-plugins', false)); ?></label>
					</li>
					<?php
					}
					?>
					<li>
						<label for="favicon_url"><?php _e('FAVICON URL', 'gymbase'); ?></label>
						<div>
							<input type="text" class="regular-text" value="<?php echo (isset($theme_options["favicon_url"]) ? esc_attr($theme_options["favicon_url"]) : ""); ?>" id="favicon_url" name="favicon_url">
							<input type="button" class="button" name="gymbase_upload_button" id="favicon_url_upload_button" value="<?php esc_attr_e('Insert favicon', 'gymbase'); ?>" />
						</div>
					</li>
					<li>
						<label for="logo_url"><?php _e('LOGO URL', 'gymbase'); ?></label>
						<div>
							<input type="text" class="regular-text" value="<?php echo esc_attr($theme_options["logo_url"]); ?>" id="logo_url" name="logo_url">
							<input type="button" class="button" name="gymbase_upload_button" id="logo_url_upload_button" value="<?php esc_attr_e('Insert logo', 'gymbase'); ?>" />
						</div>
					</li>
					<li>
						<label for="logo_first_part_text"><?php _e('LOGO FIRST PART TEXT', 'gymbase'); ?></label>
						<div>
							<input type="text" class="regular-text" value="<?php echo esc_attr($theme_options["logo_first_part_text"]); ?>" id="logo_first_part_text" name="logo_first_part_text">
						</div>
					</li>
					<li>
						<label for="logo_second_part_text"><?php _e('LOGO SECOND PART TEXT', 'gymbase'); ?></label>
						<div>
							<input type="text" class="regular-text" value="<?php echo esc_attr($theme_options["logo_second_part_text"]); ?>" id="logo_second_part_text" name="logo_second_part_text">
						</div>
					</li>
					<li>
						<label for="footer_text_left"><?php _e('FOOTER TEXT LEFT', 'gymbase'); ?></label>
						<div>
							<input type="text" class="regular-text" value="<?php echo esc_attr($theme_options["footer_text_left"]); ?>" id="footer_text_left" name="footer_text_left">
						</div>
					</li>
					<?php /*<li>
						<label for="home_page_top_hint"><?php _e('HOME PAGE TOP HINT', 'gymbase'); ?></label>
						<div>
							<input type="text" class="regular-text" value="<?php echo esc_attr($theme_options["home_page_top_hint"]); ?>" id="home_page_top_hint" name="home_page_top_hint">
						</div>
					</li>*/?>
					<li>
						<label for="sticky_menu"><?php _e('STICKY MENU', 'gymbase'); ?></label>
						<div>
							<select id="sticky_menu" name="sticky_menu">
								<option value="1"<?php echo (isset($theme_options["sticky_menu"]) && (int)$theme_options["sticky_menu"]==1 ? " selected='selected'" : "") ?>><?php _e('yes', 'gymbase'); ?></option>
								<option value="0"<?php echo (isset($theme_options["sticky_menu"]) && (int)$theme_options["sticky_menu"]==0 ? " selected='selected'" : "") ?>><?php _e('no', 'gymbase'); ?></option>
							</select>
						</div>
					</li>
					<li>
						<label for="responsive"><?php _e('RESPONSIVE', 'gymbase'); ?></label>
						<div>
							<select id="responsive" name="responsive">
								<option value="1"<?php echo ((int)$theme_options["responsive"]==1 ? " selected='selected'" : "") ?>><?php _e('yes', 'gymbase'); ?></option>
								<option value="0"<?php echo ((int)$theme_options["responsive"]==0 ? " selected='selected'" : "") ?>><?php _e('no', 'gymbase'); ?></option>
							</select>
						</div>
					</li>
					<li>
						<label for="scroll_top"><?php _e('SCROLL TO TOP ICON', 'gymbase'); ?></label>
						<div>
							<select id="scroll_top" name="scroll_top">
								<option value="1"<?php echo ((int)$theme_options["scroll_top"]==1 ? " selected='selected'" : "") ?>><?php _e('yes', 'gymbase'); ?></option>
								<option value="0"<?php echo ((int)$theme_options["scroll_top"]==0 ? " selected='selected'" : "") ?>><?php _e('no', 'gymbase'); ?></option>
							</select>
						</div>
					</li>
					<li>
						<label for="animations"><?php _e('ANIMATIONS', 'gymbase'); ?></label>
						<div>
							<select id="animations" name="animations">
								<option value="1" <?php echo (isset($theme_options["animations"]) && (int)$theme_options["animations"]==1 ? " selected='selected'" : "") ?>><?php _e('enabled', 'gymbase'); ?></option>
								<option value="0" <?php echo (isset($theme_options["animations"]) && (int)$theme_options["animations"]==0 ? " selected='selected'" : "") ?>><?php _e('disabled', 'gymbase'); ?></option>	
							</select>
						</div>
					</li>
					<li>
						<label for="collapsible_mobile_submenus"><?php _e('Collapsible mobile submenus', 'gymbase'); ?></label>
						<div>
							<select id="collapsible_mobile_submenus" name="collapsible_mobile_submenus">
								<option value="1"<?php echo (!isset($theme_options["collapsible_mobile_submenus"]) || (int)$theme_options["collapsible_mobile_submenus"]==1 ? " selected='selected'" : "") ?>><?php _e('yes', 'gymbase'); ?></option>
								<option value="0"<?php echo ((int)$theme_options["collapsible_mobile_submenus"]==0 ? " selected='selected'" : "") ?>><?php _e('no', 'gymbase'); ?></option>
							</select>
						</div>
					</li>
					<li>
						<label for="google_recaptcha"><?php _e('Use reCaptcha in contact forms', 'gymbase'); ?></label>
						<div>
							<select id="google_recaptcha" name="google_recaptcha">
								<option value="0"<?php echo (!(int)$theme_options["google_recaptcha"] ? " selected='selected'" : "") ?>><?php _e('no', 'gymbase'); ?></option>
								<option value="1"<?php echo ((int)$theme_options["google_recaptcha"] ? " selected='selected'" : "") ?>><?php _e('yes', 'gymbase'); ?></option>
							</select>
						</div>
					</li>
					<li>
						<label for="google_recaptcha_comments"><?php _e('Use reCaptcha in comment forms', 'gymbase'); ?></label>
						<div>
							<select id="google_recaptcha_comments" name="google_recaptcha_comments">
								<option value="0"<?php echo (!(int)$theme_options["google_recaptcha_comments"] ? " selected='selected'" : "") ?>><?php _e('no', 'gymbase'); ?></option>
								<option value="1"<?php echo ((int)$theme_options["google_recaptcha_comments"] ? " selected='selected'" : "") ?>><?php _e('yes', 'gymbase'); ?></option>
							</select>
						</div>
					</li>
					<li class="google-recaptcha-depends<?php echo (!(int)$theme_options["google_recaptcha"] ? ' hidden' : ''); ?>">
						<label for="recaptcha_site_key"><?php _e('Google reCaptcha Site key', 'gymbase'); ?></label>
						<div>
							<input type="text" class="regular-text" value="<?php echo esc_attr($theme_options["recaptcha_site_key"]); ?>" id="recaptcha_site_key" name="recaptcha_site_key">
							<span class="description"><?php printf(__('You can generate reCaptcha keys <a href="%s" target="_blank" title="Get reCaptcha keys">here</a>', 'gymbase'), "https://www.google.com/recaptcha/admin"); ?></span>
						</div>
					</li>
					<li class="google-recaptcha-depends"<?php echo (!(int)$theme_options["google_recaptcha"] ? ' hidden' : ''); ?>>
						<label for="recaptcha_secret_key"><?php _e('Google reCaptcha Secret key', 'gymbase'); ?></label>
						<div>
							<input type="text" class="regular-text" value="<?php echo esc_attr($theme_options["recaptcha_secret_key"]); ?>" id="recaptcha_secret_key" name="recaptcha_secret_key">
							<span class="description"><?php printf(__('You can generate reCaptcha keys <a href="%s" target="_blank" title="Get reCaptcha keys">here</a>', 'gymbase'), "https://www.google.com/recaptcha/admin"); ?></span>
						</div>
					</li>
					<li>
						<label for="google_api_code"><?php _e('Google Maps API Key', 'gymbase'); ?></label>
						<div>
							<input type="text" class="regular-text" value="<?php echo esc_attr($theme_options["google_api_code"]); ?>" id="google_api_code" name="google_api_code">
							<span class="description"><?php printf(__('You can generate API Key <a href="%s" target="_blank" title="Generate API Key">here</a>', 'gymbase'), "https://developers.google.com/maps/documentation/javascript/get-api-key"); ?></span>
						</div>
					</li>
					<li>
						<label for="ga_tracking_id"><?php _e('Google Analytics tracking id', 'gymbase'); ?></label>
						<div>
							<input type="text" class="regular-text" value="<?php echo esc_attr($theme_options["ga_tracking_id"]); ?>" id="ga_tracking_id" name="ga_tracking_id">
							<label class="small_label"><?php esc_html_e('Tracking id format: UA-XXXXXXXX-XX', 'gymbase'); ?></label>
						</div>
					</li>
					<li>
						<label for="ga_tracking_code"><?php _e('Google Analytics tracking code', 'gymbase'); ?></label>
						<div>
							<textarea id="ga_tracking_code" name="ga_tracking_code"><?php echo esc_html($theme_options["ga_tracking_code"]); ?></textarea>
							<label class="small_label"><?php esc_html_e('Optional. If tracking id has been provided, tracking code is not required.', 'gymbase'); ?></label>
						</div>
					</li>
				</ul>
			</div>
			<div id="tab-slider" class="settings">
				<h3><?php _e('Slider', 'gymbase'); ?></h3>
				<ul class="form_field_list">
					<?php
					$slides_count = count($theme_options["slider_image_url"]);
					if($slides_count==0)
						$slides_count = 3;
					for($i=0; $i<$slides_count; $i++)
					{
					?>
					<li class="slider_image_url_row">
						<label><?php _e('SLIDER IMAGE URL', 'gymbase'); echo " " . ($i+1); ?></label>
						<div>
							<input class="regular-text" type="text" id="gymbase_slider_image_url_<?php echo absint(($i+1)); ?>" name="slider_image_url[]" value="<?php echo esc_attr($theme_options["slider_image_url"][$i]); ?>" />
							<input type="button" class="button" name="gymbase_upload_button" id="gymbase_slider_image_url_button_<?php echo absint(($i+1)); ?>" value="<?php esc_attr_e('Browse', 'gymbase'); ?>" />
						</div>
					</li>
					<li class="slider_image_title_row">
						<label><?php _e('SLIDER IMAGE TITLE', 'gymbase'); echo " " . ($i+1); ?></label>
						<div>
							<input class="regular-text" type="text" id="gymbase_slider_image_title_<?php echo absint(($i+1)); ?>" name="slider_image_title[]" value="<?php echo esc_attr($theme_options["slider_image_title"][$i]); ?>" />
						</div>
					</li>
					<li class="slider_image_subtitle_row">
						<label><?php _e('SLIDER IMAGE SUBTITLE', 'gymbase'); echo " " . ($i+1); ?></label>
						<div>
							<input class="regular-text" type="text" id="gymbase_slider_image_subtitle_<?php echo absint(($i+1)); ?>" name="slider_image_subtitle[]" value="<?php echo esc_attr($theme_options["slider_image_subtitle"][$i]); ?>" />
						</div>
					</li>
					<li class="slider_image_link_row">
						<label><?php _e('SLIDER IMAGE LINK', 'gymbase'); echo " " . ($i+1); ?></label>
						<div>
							<input class="regular-text" type="text" id="gymbase_slider_image_link_<?php echo absint(($i+1)); ?>" name="slider_image_link[]" value="<?php echo esc_attr($theme_options["slider_image_link"][$i]); ?>" />
						</div>
					</li>
					<?php
					}
					?>
					<li>
						<input type="button" class="button" name="gymbase_add_new_button" id="gymbase_add_new_button" value="<?php esc_attr_e('Add slider image', 'gymbase'); ?>" />
					</li>
					<li>
						<label><?php _e('AUTOPLAY', 'gymbase'); ?></label>
						<div>
							<select id="slider_autoplay" name="slider_autoplay">
								<option value="true"<?php echo ($theme_options["slider_autoplay"]=="true" ? " selected='selected'" : "") ?>><?php _e('yes', 'gymbase'); ?></option>
								<option value="false"<?php echo ($theme_options["slider_autoplay"]=="false" ? " selected='selected'" : "") ?>><?php _e('no', 'gymbase'); ?></option>
							</select>
						</div>
					</li>
					<li>
						<label for="slide_interval"><?php _e('SLIDE INTERVAL:', 'gymbase'); ?></label>
						<div>
							<input type="text" class="regular-text" id="slide_interval" name="slide_interval" value="<?php echo (int)esc_attr($theme_options["slide_interval"]); ?>" />
						</div>
					</li>
					<li>
						<label for="slider_effect"><?php _e('EFFECT:', 'gymbase'); ?></label>
						<div>
							<select id="slider_effect" name="slider_effect">
								<option value="scroll"<?php echo ($theme_options["slider_effect"]=="scroll" ? " selected='selected'" : "") ?>><?php _e('scroll', 'gymbase'); ?></option>
								<option value="none"<?php echo ($theme_options["slider_effect"]=="none" ? " selected='selected'" : "") ?>><?php _e('none', 'gymbase'); ?></option>
								<option value="directscroll"<?php echo ($theme_options["slider_effect"]=="directscroll" ? " selected='selected'" : "") ?>><?php _e('directscroll', 'gymbase'); ?></option>
								<option value="fade"<?php echo ($theme_options["slider_effect"]=="fade" ? " selected='selected'" : "") ?>><?php _e('fade', 'gymbase'); ?></option>
								<option value="crossfade"<?php echo ($theme_options["slider_effect"]=="crossfade" ? " selected='selected'" : "") ?>><?php _e('crossfade', 'gymbase'); ?></option>
								<option value="cover"<?php echo ($theme_options["slider_effect"]=="cover" ? " selected='selected'" : "") ?>><?php _e('cover', 'gymbase'); ?></option>
								<option value="uncover"<?php echo ($theme_options["slider_effect"]=="uncover" ? " selected='selected'" : "") ?>><?php _e('uncover', 'gymbase'); ?></option>
							</select>
						</div>
					</li>
					<li>
						<label for="slider_transition"><?php _e('TRANSITION:', 'gymbase'); ?></label>
						<div>
							<select id="slider_transition" name="slider_transition">
								<option value="swing"<?php echo ($theme_options["slider_transition"]=="swing" ? " selected='selected'" : "") ?>><?php _e('swing', 'gymbase'); ?></option>
								<option value="linear"<?php echo ($theme_options["slider_transition"]=="linear" ? " selected='selected'" : "") ?>><?php _e('linear', 'gymbase'); ?></option>
								<option value="easeInQuad"<?php echo ($theme_options["slider_transition"]=="easeInQuad" ? " selected='selected'" : "") ?>><?php _e('easeInQuad', 'gymbase'); ?></option>
								<option value="easeOutQuad"<?php echo ($theme_options["slider_transition"]=="easeOutQuad" ? " selected='selected'" : "") ?>><?php _e('easeOutQuad', 'gymbase'); ?></option>
								<option value="easeInOutQuad"<?php echo ($theme_options["slider_transition"]=="easeInOutQuad" ? " selected='selected'" : "") ?>><?php _e('easeInOutQuad', 'gymbase'); ?></option>
								<option value="easeInCubic"<?php echo ($theme_options["slider_transition"]=="easeInCubic" ? " selected='selected'" : "") ?>><?php _e('easeInCubic', 'gymbase'); ?></option>
								<option value="easeOutCubic"<?php echo ($theme_options["slider_transition"]=="easeOutCubic" ? " selected='selected'" : "") ?>><?php _e('easeOutCubic', 'gymbase'); ?></option>
								<option value="easeInOutCubic"<?php echo ($theme_options["slider_transition"]=="easeInOutCubic" ? " selected='selected'" : "") ?>><?php _e('easeInOutCubic', 'gymbase'); ?></option>
								<option value="easeInOutCubic"<?php echo ($theme_options["slider_transition"]=="easeInOutCubic" ? " selected='selected'" : "") ?>><?php _e('easeInOutCubic', 'gymbase'); ?></option>
								<option value="easeInQuart"<?php echo ($theme_options["slider_transition"]=="easeInQuart" ? " selected='selected'" : "") ?>><?php _e('easeInQuart', 'gymbase'); ?></option>
								<option value="easeOutQuart"<?php echo ($theme_options["slider_transition"]=="easeOutQuart" ? " selected='selected'" : "") ?>><?php _e('easeOutQuart', 'gymbase'); ?></option>
								<option value="easeInOutQuart"<?php echo ($theme_options["slider_transition"]=="easeInOutQuart" ? " selected='selected'" : "") ?>><?php _e('easeInOutQuart', 'gymbase'); ?></option>
								<option value="easeInSine"<?php echo ($theme_options["slider_transition"]=="easeInSine" ? " selected='selected'" : "") ?>><?php _e('easeInSine', 'gymbase'); ?></option>
								<option value="easeOutSine"<?php echo ($theme_options["slider_transition"]=="easeOutSine" ? " selected='selected'" : "") ?>><?php _e('easeOutSine', 'gymbase'); ?></option>
								<option value="easeInOutSine"<?php echo ($theme_options["slider_transition"]=="easeInOutSine" ? " selected='selected'" : "") ?>><?php _e('easeInOutSine', 'gymbase'); ?></option>
								<option value="easeInExpo"<?php echo ($theme_options["slider_transition"]=="easeInExpo" ? " selected='selected'" : "") ?>><?php _e('easeInExpo', 'gymbase'); ?></option>
								<option value="easeOutExpo"<?php echo ($theme_options["slider_transition"]=="easeOutExpo" ? " selected='selected'" : "") ?>><?php _e('easeOutExpo', 'gymbase'); ?></option>
								<option value="easeInOutExpo"<?php echo ($theme_options["slider_transition"]=="easeInOutExpo" ? " selected='selected'" : "") ?>><?php _e('easeInOutExpo', 'gymbase'); ?></option>
								<option value="easeInQuint"<?php echo ($theme_options["slider_transition"]=="easeInQuint" ? " selected='selected'" : "") ?>><?php _e('easeInQuint', 'gymbase'); ?></option>
								<option value="easeOutQuint"<?php echo ($theme_options["slider_transition"]=="easeOutQuint" ? " selected='selected'" : "") ?>><?php _e('easeOutQuint', 'gymbase'); ?></option>
								<option value="easeInOutQuint"<?php echo ($theme_options["slider_transition"]=="easeInOutQuint" ? " selected='selected'" : "") ?>><?php _e('easeInOutQuint', 'gymbase'); ?></option>
								<option value="easeInCirc"<?php echo ($theme_options["slider_transition"]=="easeInCirc" ? " selected='selected'" : "") ?>><?php _e('easeInCirc', 'gymbase'); ?></option>
								<option value="easeOutCirc"<?php echo ($theme_options["slider_transition"]=="easeOutCirc" ? " selected='selected'" : "") ?>><?php _e('easeOutCirc', 'gymbase'); ?></option>
								<option value="easeInOutCirc"<?php echo ($theme_options["slider_transition"]=="easeInOutCirc" ? " selected='selected'" : "") ?>><?php _e('easeInOutCirc', 'gymbase'); ?></option>
								<option value="easeInElastic"<?php echo ($theme_options["slider_transition"]=="easeInElastic" ? " selected='selected'" : "") ?>><?php _e('easeInElastic', 'gymbase'); ?></option>
								<option value="easeOutElastic"<?php echo ($theme_options["slider_transition"]=="easeOutElastic" ? " selected='selected'" : "") ?>><?php _e('easeOutElastic', 'gymbase'); ?></option>
								<option value="easeInOutElastic"<?php echo ($theme_options["slider_transition"]=="easeInOutElastic" ? " selected='selected'" : "") ?>><?php _e('easeInOutElastic', 'gymbase'); ?></option>
								<option value="easeInBack"<?php echo ($theme_options["slider_transition"]=="easeInBack" ? " selected='selected'" : "") ?>><?php _e('easeInBack', 'gymbase'); ?></option>
								<option value="easeOutBack"<?php echo ($theme_options["slider_transition"]=="easeOutBack" ? " selected='selected'" : "") ?>><?php _e('easeOutBack', 'gymbase'); ?></option>
								<option value="easeInOutBack"<?php echo ($theme_options["slider_transition"]=="easeOutCirc" ? " selected='selected'" : "") ?>><?php _e('easeInOutBack', 'gymbase'); ?></option>
								<option value="easeInBounce"<?php echo ($theme_options["slider_transition"]=="easeInBounce" ? " selected='selected'" : "") ?>><?php _e('easeInBounce', 'gymbase'); ?></option>
								<option value="easeOutBounce"<?php echo ($theme_options["slider_transition"]=="easeOutBounce" ? " selected='selected'" : "") ?>><?php _e('easeOutBounce', 'gymbase'); ?></option>
								<option value="easeInOutBounce"<?php echo ($theme_options["slider_transition"]=="easeInOutBounce" ? " selected='selected'" : "") ?>><?php _e('easeInOutBounce', 'gymbase'); ?></option>
							</select>
						</div>
					</li>
					<li>
						<label for="slider_transition_speed"><?php _e('TRANSITION SPEED:', 'gymbase'); ?></label>
						<div>
							<input type="text" class="regular-text" id="slider_transition_speed" name="slider_transition_speed" value="<?php echo (int)esc_attr($theme_options["slider_transition_speed"]); ?>" />
						</div>
					</li>
				</ul>
			</div>
			<div id="tab-contact-form" class="settings">
				<h3><?php _e('Contact Form', 'gymbase'); ?></h3>
				<h4><?php _e('ADMIN EMAIL CONFIG', 'gymbase');	?></h4>
				<ul class="form_field_list">
					<li>
						<label for="cf_admin_name"><?php _e('NAME (SEND TO)', 'gymbase'); ?></label>
						<div>
							<input type="text" class="regular-text" value="<?php echo esc_attr($theme_options["cf_admin_name"]); ?>" id="cf_admin_name" name="cf_admin_name">
						</div>
					</li>
					<li>
						<label for="cf_admin_email"><?php _e('EMAIL (SEND TO)', 'gymbase'); ?></label>
						<div>
							<input type="text" class="regular-text" value="<?php echo esc_attr($theme_options["cf_admin_email"]); ?>" id="cf_admin_email" name="cf_admin_email">
						</div>
					</li>
					<li>
						<label for="cf_admin_name_from"><?php _e('NAME (SEND FROM) - OPTIONAL', 'gymbase'); ?></label>
						<div>
							<input type="text" class="regular-text" value="<?php echo esc_attr($theme_options["cf_admin_name_from"]); ?>" id="cf_admin_name_from" name="cf_admin_name_from">
							<label class="small_label"><?php esc_html_e("If not set, 'NAME (SEND TO)' will be used", 'gymbase'); ?></label>
						</div>
					</li>
					<li>
						<label for="cf_admin_email_from"><?php _e('EMAIL (SEND FROM) - OPTIONAL', 'gymbase'); ?></label>
						<div>
							<input type="text" class="regular-text" value="<?php echo esc_attr($theme_options["cf_admin_email_from"]); ?>" id="cf_admin_email_from" name="cf_admin_email_from">
							<label class="small_label"><?php esc_html_e("If not set, 'EMAIL (SEND TO)' will be used", 'gymbase'); ?></label>
						</div>
					</li>
				</ul>
				<h4><?php _e('ADMIN SMTP CONFIG (OPTIONAL)', 'gymbase'); ?></h4>
				<ul class="form_field_list">
					<li>
						<label for="cf_smtp_host"><?php _e('HOST', 'gymbase'); ?></label>
						<div>
							<input type="text" class="regular-text" value="<?php echo esc_attr($theme_options["cf_smtp_host"]); ?>" id="cf_smtp_host" name="cf_smtp_host">
						</div>
					</li>
					<li>
						<label for="cf_smtp_username"><?php _e('USERNAME', 'gymbase'); ?></label>
						<div>
							<input type="text" class="regular-text" value="<?php echo esc_attr($theme_options["cf_smtp_username"]); ?>" id="cf_smtp_username" name="cf_smtp_username">
						</div>
					</li>
					<li>
						<label for="cf_smtp_password"><?php _e('PASSWORD', 'gymbase'); ?></label>
						<div>
							<input type="password" class="regular-text" value="<?php echo esc_attr($theme_options["cf_smtp_password"]); ?>" id="cf_smtp_password" name="cf_smtp_password">
						</div>
					</li>
					<li>
						<label for="cf_smtp_port"><?php _e('PORT', 'gymbase'); ?></label>
						<div>
							<input type="text" class="regular-text" value="<?php echo esc_attr($theme_options["cf_smtp_port"]); ?>" id="cf_smtp_port" name="cf_smtp_port">
						</div>
					</li>
					<li>
						<label for="cf_smtp_secure"><?php _e('SMTP SECURE', 'gymbase'); ?></label>
						<div>
							<select id="cf_smtp_secure" name="cf_smtp_secure">
								<option value=""<?php echo ($theme_options["cf_smtp_secure"]=="" ? " selected='selected'" : "") ?>>-</option>
								<option value="ssl"<?php echo ($theme_options["cf_smtp_secure"]=="ssl" ? " selected='selected'" : "") ?>><?php _e('ssl', 'gymbase'); ?></option>
								<option value="tls"<?php echo ($theme_options["cf_smtp_secure"]=="tls" ? " selected='selected'" : "") ?>><?php _e('tls', 'gymbase'); ?></option>
							</select>
						</div>
					</li>
				</ul>
				<h4><?php _e('EMAIL CONFIG', 'gymbase'); ?></h4>
				<ul class="form_field_list">
					<li>
						<label for="cf_email_subject"><?php _e('EMAIL SUBJECT', 'gymbase'); ?></label>
						<div>
							<input type="text" class="regular-text" value="<?php echo esc_attr($theme_options["cf_email_subject"]); ?>" id="cf_email_subject" name="cf_email_subject">
						</div>
					</li>
					<li>
						<label for="cf_template"><?php _e('TEMPLATE', 'gymbase'); ?></label>
						<div>
							<?php _e("Available shortcodes:", 'gymbase'); ?><br><strong>[name]</strong>, <strong>[email]</strong>, <strong>[website]</strong>, <strong>[message]</strong>, <strong>[form_data]</strong><br><br>
							<?php wp_editor($theme_options["cf_template"], "cf_template");?>
						</div>
					</li>
				</ul>
				<h4><?php _e('CONTACT FORM MESSAGES', 'gymbase'); ?></h4>
				<ul class="form_field_list">
					<li>
						<label for="cf_name_message"><?php _e('Name field required message', 'gymbase'); ?></label>
						<div>
							<input type="text" class="regular-text" value="<?php echo esc_attr($theme_options["cf_name_message"]); ?>" id="cf_name_message" name="cf_name_message">
						</div>
					</li>
					<li>
						<label for="cf_email_message"><?php _e('Email field required message', 'gymbase'); ?></label>
						<div>
							<input type="text" class="regular-text" value="<?php echo esc_attr($theme_options["cf_email_message"]); ?>" id="cf_email_message" name="cf_email_message">
						</div>
					</li>
					<li>
						<label for="cf_website_message"><?php _e('Website field required message', 'gymbase'); ?></label>
						<div>
							<input type="text" class="regular-text" value="<?php echo esc_attr($theme_options["cf_website_message"]); ?>" id="cf_website_message" name="cf_website_message">
						</div>
					</li>
					<li>
						<label for="cf_message_message"><?php _e('Message field required message', 'gymbase'); ?></label>
						<div>
							<input type="text" class="regular-text" value="<?php echo esc_attr($theme_options["cf_message_message"]); ?>" id="cf_message_message" name="cf_message_message">
						</div>
					</li>
					<li>
						<label for="cf_recaptcha_message"><?php _e('reCaptcha required message', 'gymbase'); ?></label>
						<div>
							<input type="text" class="regular-text" value="<?php echo esc_attr($theme_options["cf_recaptcha_message"]); ?>" id="cf_recaptcha_message" name="cf_recaptcha_message">
						</div>
					</li>
					<li>
						<label for="cf_terms_message"><?php _e('Terms and conditions checkbox required message', 'gymbase'); ?></label>
						<div>
							<input type="text" class="regular-text" value="<?php echo esc_attr($theme_options["cf_terms_message"]); ?>" id="cf_terms_message" name="cf_terms_message">
						</div>
					</li>
					<li>
						<label for="cf_thankyou_message"><?php _e('Form thank you message', 'gymbase'); ?></label>
						<div>
							<input type="text" class="regular-text" value="<?php echo esc_attr($theme_options["cf_thankyou_message"]); ?>" id="cf_thankyou_message" name="cf_thankyou_message">
						</div>
					</li>
					<li>
						<label for="cf_error_message"><?php _e('Form error message', 'gymbase'); ?></label>
						<div>
							<input type="text" class="regular-text" value="<?php echo esc_attr($theme_options["cf_error_message"]); ?>" id="cf_error_message" name="cf_error_message">
						</div>
					</li>
				</ul>
				<h4><?php _e('COMMENTS FORM MESSAGES', 'gymbase'); ?></h4>
				<ul class="form_field_list">
					<li>
						<label for="cf_name_message_comments"><?php _e('Name field required message', 'gymbase'); ?></label>
						<div>
							<input type="text" class="regular-text" value="<?php echo esc_attr($theme_options["cf_name_message_comments"]); ?>" id="cf_name_message_comments" name="cf_name_message_comments">
						</div>
					</li>
					<li>
						<label for="cf_email_message_comments"><?php _e('Email field required message', 'gymbase'); ?></label>
						<div>
							<input type="text" class="regular-text" value="<?php echo esc_attr($theme_options["cf_email_message_comments"]); ?>" id="cf_email_message_comments" name="cf_email_message_comments">
						</div>
					</li>
					<li>
						<label for="cf_comment_message_comments"><?php _e('Comment field required message', 'gymbase'); ?></label>
						<div>
							<input type="text" class="regular-text" value="<?php echo esc_attr($theme_options["cf_comment_message_comments"]); ?>" id="cf_comment_message_comments" name="cf_comment_message_comments">
						</div>
					</li>
					<li>
						<label for="cf_recaptcha_message_comments"><?php _e('reCaptcha required message', 'gymbase'); ?></label>
						<div>
							<input type="text" class="regular-text" value="<?php echo esc_attr($theme_options["cf_recaptcha_message_comments"]); ?>" id="cf_recaptcha_message_comments" name="cf_recaptcha_message_comments">
						</div>
					</li>
					<li>
						<label for="cf_terms_message_comments"><?php _e('Terms and conditions checkbox required message', 'gymbase'); ?></label>
						<div>
							<input type="text" class="regular-text" value="<?php echo esc_attr($theme_options["cf_terms_message_comments"]); ?>" id="cf_terms_message_comments" name="cf_terms_message_comments">
						</div>
					</li>
					<li>
						<label for="cf_thankyou_message_comments"><?php _e('Form thank you message', 'gymbase'); ?></label>
						<div>
							<input type="text" class="regular-text" value="<?php echo esc_attr($theme_options["cf_thankyou_message_comments"]); ?>" id="cf_thankyou_message_comments" name="cf_thankyou_message_comments">
						</div>
					</li>
					<li>
						<label for="cf_error_message_comments"><?php _e('Form error message', 'gymbase'); ?></label>
						<div>
							<input type="text" class="regular-text" value="<?php echo esc_attr($theme_options["cf_error_message_comments"]); ?>" id="cf_error_message_comments" name="cf_error_message_comments">
						</div>
					</li>
				</ul>
			</div>
			<div id="tab-social-share" class="settings">
				<h3><?php _e('Social Share', 'gymbase'); ?></h3>
				<ul class="form_field_list">
					<li>
						<label for="show_share_box"><?php _e('Show share box', 'gymbase'); ?></label>
						<div>
							<select id="show_share_box" name="show_share_box">
								<option value="false"<?php echo (isset($theme_options["show_share_box"]) && $theme_options["show_share_box"]=="false" ? " selected='selected'" : "") ?>><?php _e('no', 'gymbase'); ?></option>
								<option value="true"<?php echo (isset($theme_options["show_share_box"]) && $theme_options["show_share_box"]=="true" ? " selected='selected'" : "") ?>><?php _e('yes', 'gymbase'); ?></option>								
							</select>
							<span class="description"><?php _e("Share box will be displayed at the end of each post, just before post author and categories information.", 'gymbase'); ?></span>
						</div>
					</li>
					<?php 
					$social_icons = array(
						"facebook",
						"google",
						"skype",
						"twitter",
						"instagram",
						"linkedin",
						"mail",
						"reddit",
						"stumbleupon",
						"tumblr",
						"pinterest",
					);
					$slides_count = (isset($theme_options["social_icon_url"]) ? count($theme_options["social_icon_url"]) : 0);
					if($slides_count==0)
						$slides_count = 4;
					for($i=0; $i<$slides_count; $i++)
					{
					?>
					<li class="social_icon_type_row">
						<label><?php echo ($i+1) . ". "; _e('Social icon type', 'gymbase'); ?></label>
						<div>
							<select name="social_icon_type[]" id="gymbase_social_icon_type_<?php echo absint(($i+1)); ?>">
								<?php
								foreach($social_icons as $social_icon):
									?>
									<option value="<?php echo esc_attr($social_icon); ?>"<?php echo (isset($theme_options['social_icon_type'][$i]) && $social_icon==$theme_options['social_icon_type'][$i] ? " selected='selected'" : "") ?>><?php echo $social_icon; ?></option>
									<?php
								endforeach;
								?>
							</select>			
						</div>
					</li>
					<li class="social_icon_url_row">
						<label><?php echo ($i+1) . ". "; _e('Social icon url', 'gymbase'); ?></label>
						<div>
							<input class="regular-text" type="text" name="social_icon_url[]" value="<?php echo (isset($theme_options["social_icon_url"][$i]) ? esc_attr($theme_options["social_icon_url"][$i]) : ""); ?>"  id="gymbase_social_icon_url_<?php echo absint(($i+1)); ?>"/>
							<span class="description"><?php _e("Use <strong>{URL}</strong> constant to have current post url in the link. You can also use <strong>{TITLE}</strong> variable and {MEDIA_URL} variable. Example: https://www.facebook.com/sharer.php?u=<strong>{URL}</strong> You can use <a href='https://www.sharelinkgenerator.com/' target='_blank'>Share Link Generator</a> to create share link", 'gymbase'); ?></span>
						</div>
					</li>
					<li class="social_icon_target_row">
						<label><?php echo ($i+1) . ". "; _e('Social icon target', 'gymbase'); ?></label>
						<div>
							<select name="social_icon_target[]" id="gymbase_social_icon_target_<?php echo absint(($i+1)); ?>">
								<option value="same_window"<?php echo (isset($theme_options["social_icon_target"][$i]) && $theme_options["social_icon_target"][$i]=="same_window" ? " selected='selected'" : ""); ?>><?php _e("same window", 'gymbase'); ?></option>
								<option value="new_window"<?php echo (isset($theme_options["social_icon_target"][$i]) && $theme_options["social_icon_target"][$i]=="new_window" ? " selected='selected'" : ""); ?>><?php _e("new window", 'gymbase'); ?></option>
							</select>
						</div>
					</li>
					<?php
					}
					?>
					<li>
						<input type="button" class="button" name="gymbase_add_new_icon_button" id="gymbase_add_new_icon_button" value="<?php esc_attr_e('Add social icon', 'gymbase'); ?>" />
					</li>
				</ul>
			</div>
			<div id="tab-contact-details" class="settings">
				<h3><?php _e('Contact Details', 'gymbase'); ?></h3>
				<ul class="form_field_list">
					<li>
						<label for="contact_logo_first_part_text"><?php _e('CONTACT LOGO FIRST PART TEXT', 'gymbase'); ?></label>
						<div>
							<input type="text" class="regular-text" value="<?php echo esc_attr($theme_options["contact_logo_first_part_text"]); ?>" id="contact_logo_first_part_text" name="contact_logo_first_part_text">
						</div>
					</li>
					<li>
						<label for="contact_logo_second_part_text"><?php _e('CONTACT LOGO SECOND PART TEXT', 'gymbase'); ?></label>
						<div>
							<input type="text" class="regular-text" value="<?php echo esc_attr($theme_options["contact_logo_second_part_text"]); ?>" id="contact_logo_second_part_text" name="contact_logo_second_part_text">
						</div>
					</li>
					<li>
						<label for="contact_phone"><?php _e('CONTACT PHONE', 'gymbase'); ?></label>
						<div>
							<input type="text" class="regular-text" value="<?php echo esc_attr($theme_options["contact_phone"]); ?>" id="contact_phone" name="contact_phone">
						</div>
					</li>
					<li>
						<label for="contact_fax"><?php _e('CONTACT FAX', 'gymbase'); ?></label>
						<div>
							<input type="text" class="regular-text" value="<?php echo esc_attr($theme_options["contact_fax"]); ?>" id="contact_fax" name="contact_fax">
						</div>
					</li>
					<li>
						<label for="contact_email"><?php _e('CONTACT EMAIL', 'gymbase'); ?></label>
						<div>
							<input type="text" class="regular-text" value="<?php echo esc_attr($theme_options["contact_email"]); ?>" id="contact_phone" name="contact_email">
						</div>
					</li>
				</ul>
			</div>
			<div id="tab-colors" class="settings">
				<h3><?php _e('Colors', 'gymbase'); ?></h3>
				<div id="tab-colors_general" class="subsettings">
					<h4><?php _e('GENERAL', 'gymbase'); ?></h4>
					<ul class="form_field_list">
						<li>
							<label for="header_background_color"><?php _e('Header background color', 'gymbase'); ?></label>
							<div>
								<span class="color_preview" style="background-color: #<?php echo !empty($theme_options["header_background_color"]) ? esc_attr($theme_options["header_background_color"]) : "FFFFFF"; ?>"></span>
								<input type="text" class="regular-text color" value="<?php echo esc_attr($theme_options["header_background_color"]); ?>" id="header_background_color" name="header_background_color" data-default-color="FFFFFF">
							</div>
						</li>
						<li>
							<label for="body_background_color"><?php _e('Body background color', 'gymbase'); ?></label>
							<div>
								<span class="color_preview" style="background-color: #<?php echo !empty($theme_options["body_background_color"]) ? esc_attr($theme_options["body_background_color"]) : "222224"; ?>"></span>
								<input type="text" class="regular-text color" value="<?php echo esc_attr($theme_options["body_background_color"]); ?>" id="body_background_color" name="body_background_color" data-default-color="222224">
							</div>
						</li>
						<li>
							<label for="footer_background_color"><?php _e('Footer background color', 'gymbase'); ?></label>
							<div>
								<span class="color_preview" style="background-color: #<?php echo !empty($theme_options["footer_background_color"]) ? esc_attr($theme_options["footer_background_color"]) : "343436"; ?>"></span>
								<input type="text" class="regular-text color" value="<?php echo esc_attr($theme_options["footer_background_color"]); ?>" id="footer_background_color" name="footer_background_color" data-default-color="343436">
							</div>
						</li>
						<li>
							<label for="link_color"><?php _e('Link color', 'gymbase'); ?></label>
							<div>
								<span class="color_preview" style="background-color: #<?php echo !empty($theme_options["link_color"]) ? esc_attr($theme_options["link_color"]) : "FFFFFF"; ?>"></span>
								<input type="text" class="regular-text color" value="<?php echo esc_attr($theme_options["link_color"]); ?>" id="link_color" name="link_color" data-default-color="FFFFFF">
							</div>
						</li>
						<li>
							<label for="link_hover_color"><?php _e('Link hover color', 'gymbase'); ?></label>
							<div>
								<span class="color_preview" style="background-color: #<?php echo !empty($theme_options["link_hover_color"]) ? esc_attr($theme_options["link_hover_color"]) : "FFFFFF"; ?>"></span>
								<input type="text" class="regular-text color" value="<?php echo esc_attr($theme_options["link_hover_color"]); ?>" id="link_hover_color" name="link_hover_color" data-default-color="FFFFFF">
							</div>
						</li>
					</ul>
				</div>
				<div id="tab-colors_text" class="subsettings">
					<h4><?php _e('TEXT', 'gymbase'); ?></h4>
					<ul class="form_field_list">
						<li>
							<label for="body_headers_color"><?php _e('Body headers color', 'gymbase'); ?></label>
							<div>
								<span class="color_preview" style="background-color: #<?php echo !empty($theme_options["body_headers_color"]) ? esc_attr($theme_options["body_headers_color"]) : "ffffff"; ?>"></span>
								<input type="text" class="regular-text color" value="<?php echo esc_attr($theme_options["body_headers_color"]); ?>" id="body_headers_color" name="body_headers_color" data-default-color="ffffff">
							</div>
						</li>
						<li>
							<label for="body_headers_border_color"><?php _e('Body headers border color', 'gymbase'); ?></label>
							<div>
								<span class="color_preview" style="background-color: #<?php echo !empty($theme_options["body_headers_border_color"]) ? esc_attr($theme_options["body_headers_border_color"]) : "409915"; ?>"></span>
								<input type="text" class="regular-text color" value="<?php echo esc_attr($theme_options["body_headers_border_color"]); ?>" id="body_headers_border_color" name="body_headers_border_color" data-default-color="409915">
								<span class="description"><?php _e('Enter \'none\' for no border', 'gymbase'); ?></span>
							</div>
						</li>
						<li>
							<label for="body_text_color"><?php _e('Body text color', 'gymbase'); ?></label>
							<div>
								<span class="color_preview" style="background-color: #<?php echo !empty($theme_options["body_text_color"]) ? esc_attr($theme_options["body_text_color"]) : "C5C5C5"; ?>"></span>
								<input type="text" class="regular-text color" value="<?php echo esc_attr($theme_options["body_text_color"]); ?>" id="body_text_color" name="body_text_color" data-default-color="C5C5C5">
							</div>
						</li>
						<li>
							<label for="body_text2_color"><?php _e('Body text 2 color', 'gymbase'); ?></label>
							<div>
								<span class="color_preview" style="background-color: #<?php echo !empty($theme_options["body_text2_color"]) ? esc_attr($theme_options["body_text2_color"]) : "999999"; ?>"></span>
								<input type="text" class="regular-text color" value="<?php echo esc_attr($theme_options["body_text2_color"]); ?>" id="body_text2_color" name="body_text2_color" data-default-color="999999">
							</div>
						</li>
						<li>
							<label for="footer_headers_color"><?php _e('Footer headers color', 'gymbase'); ?></label>
							<div>
								<span class="color_preview" style="background-color: #<?php echo !empty($theme_options["footer_headers_color"]) ? esc_attr($theme_options["footer_headers_color"]) : "ffffff"; ?>"></span>
								<input type="text" class="regular-text color" value="<?php echo esc_attr($theme_options["footer_headers_color"]); ?>" id="footer_headers_color" name="footer_headers_color" data-default-color="ffffff">
							</div>
						</li>
						<li>
							<label for="footer_headers_border_color"><?php _e('Footer headers border color', 'gymbase'); ?></label>
							<div>
								<span class="color_preview" style="background-color: #<?php echo !empty($theme_options["footer_headers_border_color"]) ? esc_attr($theme_options["footer_headers_border_color"]) : "409915"; ?>"></span>
								<input type="text" class="regular-text color" value="<?php echo esc_attr($theme_options["footer_headers_border_color"]); ?>" id="footer_headers_border_color" name="footer_headers_border_color" data-default-color="409915">
								<span class="description"><?php _e('Enter \'none\' for no border', 'gymbase'); ?></span>
							</div>
						</li>
						<li>
							<label for="footer_text_color"><?php _e('Footer text color', 'gymbase'); ?></label>
							<div>
								<span class="color_preview" style="background-color: #<?php echo !empty($theme_options["footer_text_color"]) ? esc_attr($theme_options["footer_text_color"]) : "C5C5C5"; ?>"></span>
								<input type="text" class="regular-text color" value="<?php echo esc_attr($theme_options["footer_text_color"]); ?>" id="footer_text_color" name="footer_text_color" data-default-color="C5C5C5">
							</div>
						</li>
						<li>
							<label for="timeago_label_color"><?php _e('Timeago label color', 'gymbase'); ?></label>
							<div>
								<span class="color_preview" style="background-color: #<?php echo !empty($theme_options["timeago_label_color"]) ? esc_attr($theme_options["timeago_label_color"]) : "999999"; ?>"></span>
								<input type="text" class="regular-text color" value="<?php echo esc_attr($theme_options["timeago_label_color"]); ?>" id="timeago_label_color" name="timeago_label_color" data-default-color="999999">
							</div>
						</li>
						<li>
							<label for="sentence_color"><?php _e('Sentence color', 'gymbase'); ?></label>
							<div>
								<span class="color_preview" style="background-color: #<?php echo !empty($theme_options["sentence_color"]) ? esc_attr($theme_options["sentence_color"]) : "FFFFFF"; ?>"></span>
								<input type="text" class="regular-text color" value="<?php echo esc_attr($theme_options["sentence_color"]); ?>" id="sentence_color" name="sentence_color" data-default-color="FFFFFF">
							</div>
						</li>
						<li>
							<label for="sentence_author_color"><?php _e('Sentence author color', 'gymbase'); ?></label>
							<div>
								<span class="color_preview" style="background-color: #<?php echo !empty($theme_options["sentence_author_color"]) ? esc_attr($theme_options["sentence_author_color"]) : "FFFFFF"; ?>"></span>
								<input type="text" class="regular-text color" value="<?php echo esc_attr($theme_options["sentence_author_color"]); ?>" id="sentence_author_color" name="sentence_author_color" data-default-color="FFFFFF">
							</div>
						</li>
						<li>
							<label for="logo_first_part_text_color"><?php _e('Logo first part text color', 'gymbase'); ?></label>
							<div>
								<span class="color_preview" style="background-color: #<?php echo !empty($theme_options["logo_first_part_text_color"]) ? esc_attr($theme_options["logo_first_part_text_color"]) : "409915"; ?>"></span>
								<input type="text" class="regular-text color" value="<?php echo esc_attr($theme_options["logo_first_part_text_color"]); ?>" id="logo_first_part_text_color" name="logo_first_part_text_color" data-default-color="409915">
							</div>
						</li>
						<li>
							<label for="logo_second_part_text_color"><?php _e('Logo second part text color', 'gymbase'); ?></label>
							<div>
								<span class="color_preview" style="background-color: #<?php echo !empty($theme_options["logo_second_part_text_color"]) ? esc_attr($theme_options["logo_second_part_text_color"]) : "000000"; ?>"></span>
								<input type="text" class="regular-text color" value="<?php echo esc_attr($theme_options["logo_second_part_text_color"]); ?>" id="logo_second_part_text_color" name="logo_second_part_text_color" data-default-color="000000">
							</div>
						</li>
					</ul>
				</div>
				<div id="tab-colors_buttons" class="subsettings">
					<h4><?php _e('BUTTONS', 'gymbase');?></h4>
					<ul class="form_field_list">
						<li>
							<label for="body_button_color"><?php _e('Body button text color', 'gymbase'); ?></label>
							<div>
								<span class="color_preview" style="background-color: #<?php echo !empty($theme_options["body_button_color"]) ? esc_attr($theme_options["body_button_color"]) : "FFFFFF"; ?>"></span>
								<input type="text" class="regular-text color" value="<?php echo esc_attr($theme_options["body_button_color"]); ?>" id="body_button_color" name="body_button_color" data-default-color="FFFFFF">
							</div>
						</li>
						<li>
							<label for="body_button_hover_color"><?php _e('Body button text hover color', 'gymbase'); ?></label>
							<div>
								<span class="color_preview" style="background-color: #<?php echo !empty($theme_options["body_button_hover_color"]) ? esc_attr($theme_options["body_button_hover_color"]) : "FFFFFF"; ?>"></span>
								<input type="text" class="regular-text color" value="<?php echo esc_attr($theme_options["body_button_hover_color"]); ?>" id="body_button_hover_color" name="body_button_hover_color" data-default-color="FFFFFF">
							</div>
						</li>
						<li>
							<label for="body_button_background_color"><?php _e('Body button background color', 'gymbase'); ?></label>
							<div>
								<span class="color_preview" style="background-color: #<?php echo !empty($theme_options["body_button_background_color"]) ? esc_attr($theme_options["body_button_background_color"]) : "transparent"; ?>"></span>
								<input type="text" class="regular-text color" value="<?php echo esc_attr($theme_options["body_button_background_color"]); ?>" id="body_button_background_color" name="body_button_background_color" data-default-color="transparent">
							</div>
						</li>
						<li>
							<label for="body_button_hover_background_color"><?php _e('Body button hover background color', 'gymbase'); ?></label>
							<div>
								<span class="color_preview" style="background-color: #<?php echo !empty($theme_options["body_button_hover_background_color"]) ? esc_attr($theme_options["body_button_hover_background_color"]) : "409915"; ?>"></span>
								<input type="text" class="regular-text color" value="<?php echo esc_attr($theme_options["body_button_hover_background_color"]); ?>" id="body_button_hover_background_color" name="body_button_hover_background_color" data-default-color="409915">
							</div>
						</li>
						<li>
							<label for="body_button_border_color"><?php _e('Body button border color', 'gymbase'); ?></label>
							<div>
								<span class="color_preview" style="background-color: #<?php echo !empty($theme_options["body_button_border_color"]) ? esc_attr($theme_options["body_button_border_color"]) : "515151"; ?>"></span>
								<input type="text" class="regular-text color" value="<?php echo esc_attr($theme_options["body_button_border_color"]); ?>" id="body_button_border_color" name="body_button_border_color" data-default-color="515151">
							</div>
						</li>
						<li>
							<label for="body_button_border_hover_color"><?php _e('Body button border hover color', 'gymbase'); ?></label>
							<div>
								<span class="color_preview" style="background-color: #<?php echo !empty($theme_options["body_button_border_hover_color"]) ? esc_attr($theme_options["body_button_border_hover_color"]) : "409915"; ?>"></span>
								<input type="text" class="regular-text color" value="<?php echo esc_attr($theme_options["body_button_border_hover_color"]); ?>" id="body_button_border_hover_color" name="body_button_border_hover_color" data-default-color="409915">
							</div>
						</li>
						<li>
							<label for="footer_button_color"><?php _e('Footer button text color', 'gymbase'); ?></label>
							<div>
								<span class="color_preview" style="background-color: #<?php echo !empty($theme_options["footer_button_color"]) ? esc_attr($theme_options["footer_button_color"]) : "FFFFFF"; ?>"></span>
								<input type="text" class="regular-text color" value="<?php echo esc_attr($theme_options["footer_button_color"]); ?>" id="footer_button_color" name="footer_button_color" data-default-color="FFFFFF">
							</div>
						</li>
						<li>
							<label for="footer_button_hover_color"><?php _e('Footer button text hover color', 'gymbase'); ?></label>
							<div>
								<span class="color_preview" style="background-color: #<?php echo !empty($theme_options["footer_button_hover_color"]) ? esc_attr($theme_options["footer_button_hover_color"]) : "FFFFFF"; ?>"></span>
								<input type="text" class="regular-text color" value="<?php echo esc_attr($theme_options["footer_button_hover_color"]); ?>" id="footer_button_hover_color" name="footer_button_hover_color" data-default-color="FFFFFF">
							</div>
						</li>
						<li>
							<label for="footer_button_background_color"><?php _e('Footer button background color', 'gymbase'); ?></label>
							<div>
								<span class="color_preview" style="background-color: #<?php echo !empty($theme_options["footer_button_background_color"]) ? esc_attr($theme_options["footer_button_background_color"]) : "transparent"; ?>"></span>
								<input type="text" class="regular-text color" value="<?php echo esc_attr($theme_options["footer_button_background_color"]); ?>" id="footer_button_background_color" name="footer_button_background_color" data-default-color="transparent">
							</div>
						</li>
						<li>
							<label for="footer_button_hover_background_color"><?php _e('Footer button hover background color', 'gymbase'); ?></label>
							<div>
								<span class="color_preview" style="background-color: #<?php echo !empty($theme_options["footer_button_hover_background_color"]) ? esc_attr($theme_options["footer_button_hover_background_color"]) : "409915"; ?>"></span>
								<input type="text" class="regular-text color" value="<?php echo esc_attr($theme_options["footer_button_hover_background_color"]); ?>" id="footer_button_hover_background_color" name="footer_button_hover_background_color" data-default-color="409915">
							</div>
						</li>
						<li>
							<label for="footer_button_border_color"><?php _e('Footer button border color', 'gymbase'); ?></label>
							<div>
								<span class="color_preview" style="background-color: #<?php echo !empty($theme_options["footer_button_border_color"]) ? esc_attr($theme_options["footer_button_border_color"]) : "515151"; ?>"></span>
								<input type="text" class="regular-text color" value="<?php echo esc_attr($theme_options["footer_button_border_color"]); ?>" id="footer_button_border_color" name="footer_button_border_color" data-default-color="515151">
							</div>
						</li>
						<li>
							<label for="footer_button_border_hover_color"><?php _e('Footer button border hover color', 'gymbase'); ?></label>
							<div>
								<span class="color_preview" style="background-color: #<?php echo !empty($theme_options["footer_button_border_hover_color"]) ? esc_attr($theme_options["footer_button_border_hover_color"]) : "409915"; ?>"></span>
								<input type="text" class="regular-text color" value="<?php echo esc_attr($theme_options["footer_button_border_hover_color"]); ?>" id="footer_button_border_hover_color" name="footer_button_border_hover_color" data-default-color="409915">
							</div>
						</li>
					</ul>
				</div>
				<div id="tab-colors_menu" class="subsettings">
					<h4><?php _e('MENU', 'gymbase');?></h4>
					<ul class="form_field_list">
						<li>
							<label for="menu_link_color"><?php _e('Link color', 'gymbase'); ?></label>
							<div>
								<span class="color_preview" style="background-color: #<?php echo !empty($theme_options["menu_link_color"]) ? esc_attr($theme_options["menu_link_color"]) : "444444"; ?>"></span>
								<input type="text" class="regular-text color" value="<?php echo esc_attr($theme_options["menu_link_color"]); ?>" id="menu_link_color" name="menu_link_color" data-default-color="444444">
							</div>
						</li>
						<li>
							<label for="menu_active_color"><?php _e('Active color', 'gymbase'); ?></label>
							<div>
								<span class="color_preview" style="background-color: #<?php echo !empty($theme_options["menu_active_color"]) ? esc_attr($theme_options["menu_active_color"]) : "409915"; ?>"></span>
								<input type="text" class="regular-text color" value="<?php echo esc_attr($theme_options["menu_active_color"]); ?>" id="menu_active_color" name="menu_active_color" data-default-color="409915">
							</div>
						</li>
						<li>
							<label for="menu_hover_color"><?php _e('Hover color', 'gymbase'); ?></label>
							<div>
								<span class="color_preview" style="background-color: #<?php echo !empty($theme_options["menu_hover_color"]) ? esc_attr($theme_options["menu_hover_color"]) : "409915"; ?>"></span>
								<input type="text" class="regular-text color" value="<?php echo esc_attr($theme_options["menu_hover_color"]); ?>" id="menu_hover_color" name="menu_hover_color" data-default-color="409915">
							</div>
						</li>
						<li>
							<label for="submenu_background_color"><?php _e('Submenu background color', 'gymbase'); ?></label>
							<div>
								<span class="color_preview" style="background-color: #<?php echo !empty($theme_options["submenu_background_color"]) ? esc_attr($theme_options["submenu_background_color"]) : "111111"; ?>"></span>
								<input type="text" class="regular-text color" value="<?php echo esc_attr($theme_options["submenu_background_color"]); ?>" id="submenu_background_color" name="submenu_background_color" data-default-color="111111">
							</div>
						</li>
						<li>
							<label for="submenu_color"><?php _e('Submenu link color', 'gymbase'); ?></label>
							<div>
								<span class="color_preview" style="background-color: #<?php echo !empty($theme_options["submenu_color"]) ? esc_attr($theme_options["submenu_color"]) : "999999"; ?>"></span>
								<input type="text" class="regular-text color" value="<?php echo esc_attr($theme_options["submenu_color"]); ?>" id="submenu_color" name="submenu_color" data-default-color="999999">
							</div>
						</li>
						<li>
							<label for="submenu_hover_color"><?php _e('Submenu hover link color', 'gymbase'); ?></label>
							<div>
								<span class="color_preview" style="background-color: #<?php echo !empty($theme_options["submenu_hover_color"]) ? esc_attr($theme_options["submenu_hover_color"]) : "FFFFFF"; ?>"></span>
								<input type="text" class="regular-text color" value="<?php echo esc_attr($theme_options["submenu_hover_color"]); ?>" id="submenu_hover_color" name="submenu_hover_color" data-default-color="FFFFFF">
							</div>
						</li>
						<li>
							<label for="mobile_menu_position_background_color"><?php _e('Mobile menu background color', 'gymbase'); ?></label>
							<div>
								<span class="color_preview" style="background-color: #<?php echo !empty($theme_options["mobile_menu_position_background_color"]) ? esc_attr($theme_options["mobile_menu_position_background_color"]) : "111111"; ?>"></span>
								<input type="text" class="regular-text color" value="<?php echo esc_attr($theme_options["mobile_menu_position_background_color"]); ?>" id="mobile_menu_position_background_color" name="mobile_menu_position_background_color" data-default-color="111111">
							</div>
						</li>
						<li>
							<label for="mobile_menu_link_color"><?php _e('Mobile menu link color', 'gymbase'); ?></label>
							<div>
								<span class="color_preview" style="background-color: #<?php echo !empty($theme_options["mobile_menu_link_color"]) ? esc_attr($theme_options["mobile_menu_link_color"]) : "999999"; ?>"></span>
								<input type="text" class="regular-text color" value="<?php echo esc_attr($theme_options["mobile_menu_link_color"]); ?>" id="mobile_menu_link_color" name="mobile_menu_link_color" data-default-color="999999">
							</div>
						</li>
						<li>
							<label for="mobile_menu_link_hover_color"><?php _e('Mobile menu link hover color', 'gymbase'); ?></label>
							<div>
								<span class="color_preview" style="background-color: #<?php echo !empty($theme_options["mobile_menu_link_hover_color"]) ? esc_attr($theme_options["mobile_menu_link_hover_color"]) : "FFFFFF"; ?>"></span>
								<input type="text" class="regular-text color" value="<?php echo esc_attr($theme_options["mobile_menu_link_hover_color"]); ?>" id="mobile_menu_link_hover_color" name="mobile_menu_link_hover_color" data-default-color="FFFFFF">
							</div>
						</li>
						<li>
							<label for="mobile_menu_active_link_color"><?php _e('Mobile menu active link color', 'gymbase'); ?></label>
							<div>
								<span class="color_preview" style="background-color: #<?php echo !empty($theme_options["mobile_menu_active_link_color"]) ? esc_attr($theme_options["mobile_menu_active_link_color"]) : "FFFFFF"; ?>"></span>
								<input type="text" class="regular-text color" value="<?php echo esc_attr($theme_options["mobile_menu_active_link_color"]); ?>" id="mobile_menu_active_link_color" name="mobile_menu_active_link_color" data-default-color="FFFFFF">
							</div>
						</li>
						<li>
							<label for="dropdownmenu_background_color"><?php _e('Dropdown menu background color', 'gymbase'); ?></label>
							<div>
								<span class="color_preview" style="background-color: #<?php echo (!empty($theme_options["dropdownmenu_background_color"]) ? esc_attr($theme_options["dropdownmenu_background_color"]) : '409915'); ?>;"></span>
								<input type="text" class="regular-text color" value="<?php echo (!empty($theme_options["dropdownmenu_background_color"]) ? esc_attr($theme_options["dropdownmenu_background_color"]) : ""); ?>" id="dropdownmenu_background_color" name="dropdownmenu_background_color" data-default-color="409915">
							</div>
						</li>
						<li>
							<label for="dropdownmenu_hover_background_color"><?php _e('Dropdown menu hover background color', 'gymbase'); ?></label>
							<div>
								<span class="color_preview" style="background-color: #<?php echo (!empty($theme_options["dropdownmenu_hover_background_color"]) ? esc_attr($theme_options["dropdownmenu_hover_background_color"]) : '111111'); ?>;"></span>
								<input type="text" class="regular-text color" value="<?php echo (!empty($theme_options["dropdownmenu_hover_background_color"]) ? esc_attr($theme_options["dropdownmenu_hover_background_color"]) : ""); ?>" id="dropdownmenu_hover_background_color" name="dropdownmenu_hover_background_color" data-default-color="111111">
							</div>
						</li>
						<li>
							<label for="dropdownmenu_text_color"><?php _e('Dropdown menu text color', 'gymbase'); ?></label>
							<div>
								<span class="color_preview" style="background-color: #<?php echo (!empty($theme_options["dropdownmenu_text_color"]) ? esc_attr($theme_options["dropdownmenu_text_color"]) : 'FFFFFF'); ?>;"></span>
								<input type="text" class="regular-text color" value="<?php echo (!empty($theme_options["dropdownmenu_text_color"]) ? esc_attr($theme_options["dropdownmenu_text_color"]) : ""); ?>" id="dropdownmenu_text_color" name="dropdownmenu_text_color" data-default-color="FFFFFF">
							</div>
						</li>
						<li>
							<label for="dropdownmenu_hover_text_color"><?php _e('Dropdown menu hover text color', 'gymbase'); ?></label>
							<div>
								<span class="color_preview" style="background-color: #<?php echo (!empty($theme_options["dropdownmenu_hover_text_color"]) ? esc_attr($theme_options["dropdownmenu_hover_text_color"]) : 'FFFFFF'); ?>;"></span>
								<input type="text" class="regular-text color" value="<?php echo (!empty($theme_options["dropdownmenu_hover_text_color"]) ? esc_attr($theme_options["dropdownmenu_hover_text_color"]) : ""); ?>" id="dropdownmenu_hover_text_color" name="dropdownmenu_hover_text_color" data-default-color="FFFFFF">
							</div>
						</li>
					</ul>
				</div>
				<div id="tab-colors_forms" class="subsettings">
					<h4><?php _e('FORMS', 'gymbase');?></h4>
					<ul class="form_field_list">
						<li>
							<label for="form_hint_color"><?php _e('Form hint color', 'gymbase'); ?></label>
							<div>
								<span class="color_preview" style="background-color: #<?php echo !empty($theme_options["form_hint_color"]) ? esc_attr($theme_options["form_hint_color"]) : "C5C5C5"; ?>"></span>
								<input type="text" class="regular-text color" value="<?php echo esc_attr($theme_options["form_hint_color"]); ?>" id="form_hint_color" name="form_hint_color" data-default-color="C5C5C5">
							</div>
						</li>
						<li>
							<label for="form_field_label_color"><?php _e('Form field label color', 'gymbase'); ?></label>
							<div>
								<span class="color_preview" style="background-color: #<?php echo !empty($theme_options["form_field_label_color"]) ? esc_attr($theme_options["form_field_label_color"]) : "999999"; ?>"></span>
								<input type="text" class="regular-text color" value="<?php echo esc_attr($theme_options["form_field_label_color"]); ?>" id="form_field_label_color" name="form_field_label_color" data-default-color="999999">
							</div>
						</li>
						<li>
							<label for="form_field_text_color"><?php _e('Form field text color', 'gymbase'); ?></label>
							<div>
								<span class="color_preview" style="background-color: #<?php echo !empty($theme_options["form_field_text_color"]) ? esc_attr($theme_options["form_field_text_color"]) : "FFFFFF"; ?>"></span>
								<input type="text" class="regular-text color" value="<?php echo esc_attr($theme_options["form_field_text_color"]); ?>" id="form_field_text_color" name="form_field_text_color" data-default-color="FFFFFF">
							</div>
						</li>
						<li>
							<label for="form_field_border_color"><?php _e('Form field border color', 'gymbase'); ?></label>
							<div>
								<span class="color_preview" style="background-color: #<?php echo !empty($theme_options["form_field_border_color"]) ? esc_attr($theme_options["form_field_border_color"]) : "515151"; ?>"></span>
								<input type="text" class="regular-text color" value="<?php echo esc_attr($theme_options["form_field_border_color"]); ?>" id="form_field_border_color" name="form_field_border_color" data-default-color="515151">
								<span class="description"><?php _e('Enter \'none\' for no border', 'gymbase'); ?></span>
							</div>
						</li>
					</ul>
				</div>
				<div id="tab-colors_miscellaneous" class="subsettings">
					<h4><?php _e('MISCELLANEOUS', 'gymbase'); ?></h4>
					<ul class="form_field_list">
						<li>
							<label for="date_box_color"><?php _e('Date box background color', 'gymbase'); ?></label>
							<div>
								<span class="color_preview" style="background-color: #<?php echo !empty($theme_options["date_box_color"]) ? esc_attr($theme_options["date_box_color"]) : "409915"; ?>"></span>
								<input type="text" class="regular-text color" value="<?php echo esc_attr($theme_options["date_box_color"]); ?>" id="date_box_color" name="date_box_color" data-default-color="409915">
							</div>
						</li>
						<li>
							<label for="date_box_text_color"><?php _e('Date box text color', 'gymbase'); ?></label>
							<div>
								<span class="color_preview" style="background-color: #<?php echo !empty($theme_options["date_box_text_color"]) ? esc_attr($theme_options["date_box_text_color"]) : "FFFFFF"; ?>"></span>
								<input type="text" class="regular-text color" value="<?php echo esc_attr($theme_options["date_box_text_color"]); ?>" id="date_box_text_color" name="date_box_text_color" data-default-color="FFFFFF">
							</div>
						</li>
						<li>
							<label for="date_box_comments_number_text_color"><?php _e('Date box comments number text color', 'gymbase'); ?></label>
							<div>
								<span class="color_preview" style="background-color: #<?php echo !empty($theme_options["date_box_comments_number_text_color"]) ? esc_attr($theme_options["date_box_comments_number_text_color"]) : "FFFFFF"; ?>"></span>
								<input type="text" class="regular-text color" value="<?php echo esc_attr($theme_options["date_box_comments_number_text_color"]); ?>" id="date_box_comments_number_text_color" name="date_box_comments_number_text_color" data-default-color="FFFFFF">
							</div>
						</li>
						<li>
							<label for="date_box_comments_number_border_color"><?php _e('Date box comments number border color', 'gymbase'); ?></label>
							<div>
								<span class="color_preview" style="background-color: #<?php echo !empty($theme_options["date_box_comments_number_border_color"]) ? esc_attr($theme_options["date_box_comments_number_border_color"]) : "515151"; ?>"></span>
								<input type="text" class="regular-text color" value="<?php echo esc_attr($theme_options["date_box_comments_number_border_color"]); ?>" id="date_box_comments_number_border_color" name="date_box_comments_number_border_color" data-default-color="515151">
								<span class="description"><?php _e('Enter \'none\' for no border', 'gymbase'); ?></span>
							</div>
						</li>
						<li>
							<label for="date_box_comments_number_hover_border_color"><?php _e('Date box comments number hover border color', 'gymbase'); ?></label>
							<div>
								<span class="color_preview" style="background-color: #<?php echo !empty($theme_options["date_box_comments_number_hover_border_color"]) ? esc_attr($theme_options["date_box_comments_number_hover_border_color"]) : "409915"; ?>"></span>
								<input type="text" class="regular-text color" value="<?php echo esc_attr($theme_options["date_box_comments_number_hover_border_color"]); ?>" id="date_box_comments_number_hover_border_color" name="date_box_comments_number_hover_border_color" data-default-color="409915">
								<span class="description"><?php _e('Enter \'none\' for no border', 'gymbase'); ?></span>
							</div>
						</li>
						<li>
							<label for="gallery_details_box_border_color"><?php _e('Gallery details box border color', 'gymbase'); ?></label>
							<div>
								<span class="color_preview" style="background-color: #<?php echo !empty($theme_options["gallery_details_box_border_color"]) ? esc_attr($theme_options["gallery_details_box_border_color"]) : "409915"; ?>"></span>
								<input type="text" class="regular-text color" value="<?php echo esc_attr($theme_options["gallery_details_box_border_color"]); ?>" id="gallery_details_box_border_color" name="gallery_details_box_border_color" data-default-color="409915">
								<span class="description"><?php _e('Enter \'none\' for no border', 'gymbase'); ?></span>
							</div>
						</li>
						<li>
							<label for="gallery_box_color"><?php _e('Gallery box color', 'gymbase'); ?></label>
							<div>
								<span class="color_preview" style="background-color: #<?php echo !empty($theme_options["gallery_box_color"]) ? esc_attr($theme_options["gallery_box_color"]) : "409915"; ?>"></span>
								<input type="text" class="regular-text color" value="<?php echo esc_attr($theme_options["gallery_box_color"]); ?>" id="gallery_box_color" name="gallery_box_color" data-default-color="409915">
							</div>
						</li>
						<li>
							<label for="gallery_box_text_first_line_color"><?php _e('Gallery box text first line color', 'gymbase'); ?></label>
							<div>
								<span class="color_preview" style="background-color: #<?php echo !empty($theme_options["gallery_box_text_first_line_color"]) ? esc_attr($theme_options["gallery_box_text_first_line_color"]) : "FFFFFF"; ?>"></span>
								<input type="text" class="regular-text color" value="<?php echo esc_attr($theme_options["gallery_box_text_first_line_color"]); ?>" id="gallery_box_text_first_line_color" name="gallery_box_text_first_line_color" data-default-color="FFFFFF">
							</div>
						</li>
						<li>
							<label for="gallery_box_text_second_line_color"><?php _e('Gallery box text second line color', 'gymbase'); ?></label>
							<div>
								<span class="color_preview" style="background-color: #<?php echo !empty($theme_options["gallery_box_text_second_line_color"]) ? esc_attr($theme_options["gallery_box_text_second_line_color"]) : "999999"; ?>"></span>
								<input type="text" class="regular-text color" value="<?php echo esc_attr($theme_options["gallery_box_text_second_line_color"]); ?>" id="gallery_box_text_second_line_color" name="gallery_box_text_second_line_color" data-default-color="999999">
							</div>
						</li>
						<li>
							<label for="gallery_box_hover_color"><?php _e('Gallery box hover color', 'gymbase'); ?></label>
							<div>
								<span class="color_preview" style="background-color: #<?php echo !empty($theme_options["gallery_box_hover_color"]) ? esc_attr($theme_options["gallery_box_hover_color"]) : "409915"; ?>"></span>
								<input type="text" class="regular-text color" value="<?php echo esc_attr($theme_options["gallery_box_hover_color"]); ?>" id="gallery_box_hover_color" name="gallery_box_hover_color" data-default-color="409915">
							</div>
						</li>
						<li>
							<label for="gallery_box_hover_text_first_line_color"><?php _e('Gallery box hover text first line color', 'gymbase'); ?></label>
							<div>
								<span class="color_preview" style="background-color: #<?php echo !empty($theme_options["gallery_box_hover_text_first_line_color"]) ? esc_attr($theme_options["gallery_box_hover_text_first_line_color"]) : "FFFFFF"; ?>"></span>
								<input type="text" class="regular-text color" value="<?php echo esc_attr($theme_options["gallery_box_hover_text_first_line_color"]); ?>" id="gallery_box_hover_text_first_line_color" name="gallery_box_hover_text_first_line_color" data-default-color="FFFFFF">
							</div>
						</li>
						<li>
							<label for="gallery_box_hover_text_second_line_color"><?php _e('Gallery box hover text second line color', 'gymbase'); ?></label>
							<div>
								<span class="color_preview" style="background-color: #<?php echo !empty($theme_options["gallery_box_hover_text_second_line_color"]) ? esc_attr($theme_options["gallery_box_hover_text_second_line_color"]) : "000000"; ?>"></span>
								<input type="text" class="regular-text color" value="<?php echo esc_attr($theme_options["gallery_box_hover_text_second_line_color"]); ?>" id="gallery_box_hover_text_second_line_color" name="gallery_box_hover_text_second_line_color" data-default-color="000000">
							</div>
						</li>
						<li>
							<label for="timetable_box_color"><?php _e('Timetable box color', 'gymbase'); ?></label>
							<div>
								<span class="color_preview" style="background-color: #<?php echo !empty($theme_options["timetable_box_color"]) ? esc_attr($theme_options["timetable_box_color"]) : "409915"; ?>"></span>
								<input type="text" class="regular-text color" value="<?php echo esc_attr($theme_options["timetable_box_color"]); ?>" id="timetable_box_color" name="timetable_box_color" data-default-color="409915">
							</div>
						</li>
						<li>
							<label for="timetable_box_hover_color"><?php _e('Timetable box hover color', 'gymbase'); ?></label>
							<div>
								<span class="color_preview" style="background-color: #<?php echo !empty($theme_options["timetable_box_hover_color"]) ? esc_attr($theme_options["timetable_box_hover_color"]) : "FFFFFF"; ?>"></span>
								<input type="text" class="regular-text color" value="<?php echo esc_attr($theme_options["timetable_box_hover_color"]); ?>" id="timetable_box_hover_color" name="timetable_box_hover_color" data-default-color="FFFFFF">
							</div>
						</li>
						<li>
							<label for="featured_icon_color"><?php _e('Featured icon color', 'gymbase'); ?></label>
							<div>
								<span class="color_preview" style="background-color: #<?php echo !empty($theme_options["featured_icon_color"]) ? esc_attr($theme_options["featured_icon_color"]) : "409915"; ?>"></span>
								<input type="text" class="regular-text color" value="<?php echo esc_attr($theme_options["featured_icon_color"]); ?>" id="featured_icon_color" name="featured_icon_color" data-default-color="409915">
							</div>
						</li>
						<li>
							<label for="counter_box_progress_bar_color"><?php _e('Counter box progress bar color', 'gymbase'); ?></label>
							<div>
								<span class="color_preview" style="background-color: #<?php echo !empty($theme_options["counter_box_progress_bar_color"]) ? esc_attr($theme_options["counter_box_progress_bar_color"]) : "409915"; ?>"></span>
								<input type="text" class="regular-text color" value="<?php echo esc_attr($theme_options["counter_box_progress_bar_color"]); ?>" id="counter_box_progress_bar_color" name="counter_box_progress_bar_color" data-default-color="409915">
							</div>
						</li>
						<li>
							<label for="counter_box_border_color"><?php _e('Counter box border color', 'gymbase'); ?></label>
							<div>
								<span class="color_preview" style="background-color: #<?php echo !empty($theme_options["counter_box_border_color"]) ? esc_attr($theme_options["counter_box_border_color"]) : "515151"; ?>"></span>
								<input type="text" class="regular-text color" value="<?php echo esc_attr($theme_options["counter_box_border_color"]); ?>" id="counter_box_border_color" name="counter_box_border_color" data-default-color="515151">
							</div>
						</li>
						<li>
							<label for="item_list_icon_color"><?php _e('Item list icon color', 'gymbase'); ?></label>
							<div>
								<span class="color_preview" style="background-color: #<?php echo !empty($theme_options["item_list_icon_color"]) ? esc_attr($theme_options["item_list_icon_color"]) : "409915"; ?>"></span>
								<input type="text" class="regular-text color" value="<?php echo esc_attr($theme_options["item_list_icon_color"]); ?>" id="item_list_icon_color" name="item_list_icon_color" data-default-color="409915">
							</div>
						</li>
						<li>
							<label for="pricing_box_price_color"><?php _e('Pricing box price color', 'gymbase'); ?></label>
							<div>
								<span class="color_preview" style="background-color: #<?php echo !empty($theme_options["pricing_box_price_color"]) ? esc_attr($theme_options["pricing_box_price_color"]) : "59B42D"; ?>"></span>
								<input type="text" class="regular-text color" value="<?php echo esc_attr($theme_options["pricing_box_price_color"]); ?>" id="pricing_box_price_color" name="pricing_box_price_color" data-default-color="59B42D">
							</div>
						</li>
						<li>
							<label for="bordered_columns_border_color"><?php _e('Bordered columns border color', 'gymbase'); ?></label>
							<div>
								<span class="color_preview" style="background-color: #<?php echo !empty($theme_options["bordered_columns_border_color"]) ? esc_attr($theme_options["bordered_columns_border_color"]) : "515151"; ?>"></span>
								<input type="text" class="regular-text color" value="<?php echo esc_attr($theme_options["bordered_columns_border_color"]); ?>" id="bordered_columns_border_color" name="bordered_columns_border_color" data-default-color="515151">
							</div>
						</li>
						<li>
							<label for="testimonials_icon_color"><?php _e('Testimonials icon color', 'gymbase'); ?></label>
							<div>
								<span class="color_preview" style="background-color: #<?php echo !empty($theme_options["testimonials_icon_color"]) ? esc_attr($theme_options["testimonials_icon_color"]) : "409915"; ?>"></span>
								<input type="text" class="regular-text color" value="<?php echo esc_attr($theme_options["testimonials_icon_color"]); ?>" id="testimonials_icon_color" name="testimonials_icon_color" data-default-color="409915">
							</div>
						</li>
						<li>
							<label for="testimonials_border_color"><?php _e('Testimonials border color', 'gymbase'); ?></label>
							<div>
								<span class="color_preview" style="background-color: #<?php echo !empty($theme_options["testimonials_border_color"]) ? esc_attr($theme_options["testimonials_border_color"]) : "515151"; ?>"></span>
								<input type="text" class="regular-text color" value="<?php echo esc_attr($theme_options["testimonials_border_color"]); ?>" id="testimonials_border_color" name="testimonials_border_color" data-default-color="515151">
							</div>
						</li>
						<li>
							<label for="bread_crumb_border_color"><?php _e('Bread crumb separator color', 'gymbase'); ?></label>
							<div>
								<span class="color_preview" style="background-color: #<?php echo !empty($theme_options["bread_crumb_border_color"]) ? esc_attr($theme_options["bread_crumb_border_color"]) : "999999"; ?>"></span>
								<input type="text" class="regular-text color" value="<?php echo esc_attr($theme_options["bread_crumb_border_color"]); ?>" id="bread_crumb_border_color" name="bread_crumb_border_color" data-default-color="999999">
							</div>
						</li>
						<li>
							<label for="accordion_item_border_color"><?php _e('Accordion item border color', 'gymbase'); ?></label>
							<div>
								<span class="color_preview" style="background-color: #<?php echo !empty($theme_options["accordion_item_border_color"]) ? esc_attr($theme_options["accordion_item_border_color"]) : "515151"; ?>"></span>
								<input type="text" class="regular-text color" value="<?php echo esc_attr($theme_options["accordion_item_border_color"]); ?>" id="accordion_item_border_color" name="accordion_item_border_color" data-default-color="515151">
								<span class="description"><?php _e('Enter \'none\' for no border', 'gymbase'); ?></span>
							</div>
						</li>
						<li>
							<label for="accordion_item_border_hover_color"><?php _e('Accordion item border hover color', 'gymbase'); ?></label>
							<div>
								<span class="color_preview" style="background-color: #<?php echo !empty($theme_options["accordion_item_border_hover_color"]) ? esc_attr($theme_options["accordion_item_border_hover_color"]) : "409915"; ?>"></span>
								<input type="text" class="regular-text color" value="<?php echo esc_attr($theme_options["accordion_item_border_hover_color"]); ?>" id="accordion_item_border_hover_color" name="accordion_item_border_hover_color" data-default-color="409915">
								<span class="description"><?php _e('Enter \'none\' for no border', 'gymbase'); ?></span>
							</div>
						</li>
						<li>
							<label for="accordion_item_border_active_color"><?php _e('Accordion item border active color', 'gymbase'); ?></label>
							<div>
								<span class="color_preview" style="background-color: #<?php echo !empty($theme_options["accordion_item_border_active_color"]) ? esc_attr($theme_options["accordion_item_border_active_color"]) : "409915"; ?>"></span>
								<input type="text" class="regular-text color" value="<?php echo esc_attr($theme_options["accordion_item_border_active_color"]); ?>" id="accordion_item_border_active_color" name="accordion_item_border_active_color" data-default-color="409915">
								<span class="description"><?php _e('Enter \'none\' for no border', 'gymbase'); ?></span>
							</div>
						</li>
						<li>
							<label for="copyright_area_border_color"><?php _e('Copyright area background color', 'gymbase'); ?></label>
							<div>
								<span class="color_preview" style="background-color: #<?php echo !empty($theme_options["copyright_area_border_color"]) ? esc_attr($theme_options["copyright_area_border_color"]) : "222224"; ?>"></span>
								<input type="text" class="regular-text color" value="<?php echo esc_attr($theme_options["copyright_area_border_color"]); ?>" id="copyright_area_border_color" name="copyright_area_border_color" data-default-color="222224">
								<span class="description"><?php _e('Enter \'none\' for no border', 'gymbase'); ?></span>
							</div>
						</li>
						<?php
						/*
						<li>
							<label for="top_hint_background_color"><?php _e('Top hint background color', 'gymbase'); ?></label>
							<div>
								<span class="color_preview" style="background-color: #<?php echo !empty($theme_options["top_hint_background_color"]) ? esc_attr($theme_options["top_hint_background_color"]) : "409915"; ?>"></span>
								<input type="text" class="regular-text color" value="<?php echo esc_attr($theme_options["top_hint_background_color"]); ?>" id="top_hint_background_color" name="top_hint_background_color" data-default-color="409915">
							</div>
						</li>
						<li>
							<label for="top_hint_text_color"><?php _e('Top hint text color', 'gymbase'); ?></label>
							<div>
								<span class="color_preview" style="background-color: #<?php echo !empty($theme_options["top_hint_text_color"]) ? esc_attr($theme_options["top_hint_text_color"]) : "FFFFFF"; ?>"></span>
								<input type="text" class="regular-text color" value="<?php echo esc_attr($theme_options["top_hint_text_color"]); ?>" id="top_hint_text_color" name="top_hint_text_color" data-default-color="FFFFFF">
							</div>
						</li>*/
						?>
						<li>
							<label for="comment_reply_button_color"><?php _e('Comment reply button color', 'gymbase'); ?></label>
							<div>
								<span class="color_preview" style="background-color: #<?php echo !empty($theme_options["comment_reply_button_color"]) ? esc_attr($theme_options["comment_reply_button_color"]) : "FFFFFF"; ?>"></span>
								<input type="text" class="regular-text color" value="<?php echo esc_attr($theme_options["comment_reply_button_color"]); ?>" id="comment_reply_button_color" name="comment_reply_button_color" data-default-color="FFFFFF">
							</div>
						</li>
						<li>
							<label for="post_author_link_color"><?php _e('Post author link color', 'gymbase'); ?></label>
							<div>
								<span class="color_preview" style="background-color: #<?php echo !empty($theme_options["post_author_link_color"]) ? esc_attr($theme_options["post_author_link_color"]) : "FFFFFF"; ?>"></span>
								<input type="text" class="regular-text color" value="<?php echo esc_attr($theme_options["post_author_link_color"]); ?>" id="post_author_link_color" name="post_author_link_color" data-default-color="FFFFFF">
							</div>
						</li>
						<li>
							<label for="contact_details_box_background_color"><?php _e('Contact details box background color [deprecated]', 'gymbase'); ?></label>
							<div>
								<span class="color_preview" style="background-color: #<?php echo !empty($theme_options["contact_details_box_background_color"]) ? esc_attr($theme_options["contact_details_box_background_color"]) : "FFFFFF"; ?>"></span>
								<input type="text" class="regular-text color" value="<?php echo esc_attr($theme_options["contact_details_box_background_color"]); ?>" id="contact_details_box_background_color" name="contact_details_box_background_color" data-default-color="FFFFFF">
							</div>
						</li>
					</ul>
				</div>
			</div>
			<div id="tab-fonts" class="settings">
				<h3><?php _e('Fonts', 'gymbase'); ?></h3>
				<ul class="form_field_list">
					<li>
						<label for="header_font"><?php _e('Primary font', 'gymbase'); ?></label>
						<div>
							<select id="header_font" name="header_font">
								<option<?php echo (isset($theme_options["header_font"]) && $theme_options["header_font"]=="" ? " selected='selected'" : ""); ?>  value=""><?php _e("Default (Raleway)", 'gymbase'); ?></option>
								<?php
								$fontsCount = count($fontsArray->items);
								for($i=0; $i<$fontsCount; $i++)
								{
								?>
									
									<?php
									$variantsCount = count($fontsArray->items[$i]->variants);
									if($variantsCount>1)
									{
										for($j=0; $j<$variantsCount; $j++)
										{
										?>
											<option<?php echo (isset($theme_options["header_font"]) && $theme_options["header_font"]==$fontsArray->items[$i]->family . ":" . $fontsArray->items[$i]->variants[$j] ? " selected='selected'" : ""); ?> value="<?php echo esc_attr($fontsArray->items[$i]->family . ":" . $fontsArray->items[$i]->variants[$j]); ?>"><?php echo $fontsArray->items[$i]->family . ":" . $fontsArray->items[$i]->variants[$j]; ?></option>
										<?php
										}
									}
									else
									{
									?>
									<option<?php echo (isset($theme_options["header_font"]) && $theme_options["header_font"]==$fontsArray->items[$i]->family ? " selected='selected'" : ""); ?> value="<?php echo esc_attr($fontsArray->items[$i]->family); ?>"><?php echo $fontsArray->items[$i]->family; ?></option>
									<?php
									}
								}
								?>
							</select>
							<img class="theme_font_subset_preloader" src="<?php echo esc_url(get_template_directory_uri());?>/admin/images/ajax-loader.gif" />
							<label class="font_subset" for="header_font_subset" style="<?php echo (!empty($theme_options["header_font"]) ? "display: block;" : ""); ?>"><?php _e('Header font subset', 'gymbase'); ?></label>
							<select id="header_font_subset" class="font_subset" name="header_font_subset[]" multiple="multiple" style="<?php echo (!empty($theme_options["header_font"]) ? "display: block;" : ""); ?>">
								<?php
								if(!empty($theme_options["header_font"]))
								{
									$fontExplode = explode(":", $theme_options["header_font"]);
									$font_subset = gb_get_google_font_subset($fontExplode[0]);
									foreach($font_subset as $subset)
										echo "<option value='" . esc_attr($subset) . "' " . (in_array($subset, (array)$theme_options["header_font_subset"]) ? "selected='selected'" : "") . ">" . $subset . "</option>";							
								}
								?>
							</select>
						</div>
					</li>
					<li>
						<label for="subheader_font"><?php _e('Secondary font', 'gymbase'); ?></label>
						<div>
							<select id="subheader_font" name="subheader_font">
								<option<?php echo (isset($theme_options["subheader_font"]) && $theme_options["subheader_font"]=="" ? " selected='selected'" : ""); ?>  value=""><?php _e("Default (Lato)", 'gymbase'); ?></option>
								<?php
								$fontsCount = count($fontsArray->items);
								for($i=0; $i<$fontsCount; $i++)
								{
								?>
									
									<?php
									$variantsCount = count($fontsArray->items[$i]->variants);
									if($variantsCount>1)
									{
										for($j=0; $j<$variantsCount; $j++)
										{
										?>
											<option<?php echo (isset($theme_options["subheader_font"]) && $theme_options["subheader_font"]==$fontsArray->items[$i]->family . ":" . $fontsArray->items[$i]->variants[$j] ? " selected='selected'" : ""); ?> value="<?php echo esc_attr($fontsArray->items[$i]->family . ":" . $fontsArray->items[$i]->variants[$j]); ?>"><?php echo $fontsArray->items[$i]->family . ":" . $fontsArray->items[$i]->variants[$j]; ?></option>
										<?php
										}
									}
									else
									{
									?>
									<option<?php echo (isset($theme_options["subheader_font"]) && $theme_options["subheader_font"]==$fontsArray->items[$i]->family ? " selected='selected'" : ""); ?> value="<?php echo esc_attr($fontsArray->items[$i]->family); ?>"><?php echo $fontsArray->items[$i]->family; ?></option>
									<?php
									}
								}
								?>
							</select>
							<img class="theme_font_subset_preloader" src="<?php echo esc_url(get_template_directory_uri());?>/admin/images/ajax-loader.gif" />
							<label class="font_subset" for="subheader_font_subset" style="<?php echo (!empty($theme_options["subheader_font"]) ? "display: block;" : ""); ?>"><?php _e('Subheader font subset', 'gymbase'); ?></label>
							<select id="subheader_font_subset" class="font_subset" name="subheader_font_subset[]" multiple="multiple" style="<?php echo (!empty($theme_options["subheader_font"]) ? "display: block;" : ""); ?>">
								<?php
								if(!empty($theme_options["subheader_font"]))
								{
									$fontExplode = explode(":", $theme_options["subheader_font"]);
									$font_subset = gb_get_google_font_subset($fontExplode[0]);
									foreach($font_subset as $subset)
										echo "<option value='" . esc_attr($subset) . "' " . (in_array($subset, (array)$theme_options["subheader_font_subset"]) ? "selected='selected'" : "") . ">" . $subset . "</option>";							
								}
								?>
							</select>
						</div>
					</li>
					<li>
						<label for="tertiary_font"><?php _e('Tertiary font', 'gymbase'); ?></label>
						<div>
							<select id="tertiary_font" name="tertiary_font">
								<option<?php echo (isset($theme_options["tertiary_font"]) && $theme_options["tertiary_font"]=="" ? " selected='selected'" : ""); ?>  value=""><?php _e("Default (EB Garamond)", 'gymbase'); ?></option>
								<?php
								$fontsCount = count($fontsArray->items);
								for($i=0; $i<$fontsCount; $i++)
								{
								?>
									
									<?php
									$variantsCount = count($fontsArray->items[$i]->variants);
									if($variantsCount>1)
									{
										for($j=0; $j<$variantsCount; $j++)
										{
										?>
											<option<?php echo (isset($theme_options["tertiary_font"]) && $theme_options["tertiary_font"]==$fontsArray->items[$i]->family . ":" . $fontsArray->items[$i]->variants[$j] ? " selected='selected'" : ""); ?> value="<?php echo esc_attr($fontsArray->items[$i]->family . ":" . $fontsArray->items[$i]->variants[$j]); ?>"><?php echo $fontsArray->items[$i]->family . ":" . $fontsArray->items[$i]->variants[$j]; ?></option>
										<?php
										}
									}
									else
									{
									?>
									<option<?php echo (isset($theme_options["tertiary_font"]) && $theme_options["tertiary_font"]==$fontsArray->items[$i]->family ? " selected='selected'" : ""); ?> value="<?php echo esc_attr($fontsArray->items[$i]->family); ?>"><?php echo $fontsArray->items[$i]->family; ?></option>
									<?php
									}
								}
								?>
							</select>
							<img class="theme_font_subset_preloader" src="<?php echo esc_url(get_template_directory_uri());?>/admin/images/ajax-loader.gif" />
							<label class="font_subset" for="tertiary_font_subset" style="<?php echo (!empty($theme_options["tertiary_font"]) ? "display: block;" : ""); ?>"><?php _e('Tertiary font subset', 'gymbase'); ?></label>
							<select id="tertiary_font_subset" class="font_subset" name="tertiary_font_subset[]" multiple="multiple" style="<?php echo (!empty($theme_options["tertiary_font"]) ? "display: block;" : ""); ?>">
								<?php
								if(!empty($theme_options["tertiary_font"]))
								{
									$fontExplode = explode(":", $theme_options["tertiary_font"]);
									$font_subset = gb_get_google_font_subset($fontExplode[0]);
									foreach($font_subset as $subset)
										echo "<option value='" . esc_attr($subset) . "' " . (in_array($subset, (array)$theme_options["tertiary_font_subset"]) ? "selected='selected'" : "") . ">" . $subset . "</option>";							
								}
								?>
							</select>
						</div>
					</li>
				</ul>
			</div>
		</div>
		<div class="footer">
			<div class="footer_left">
				<ul class="social-list">
					<li><a target="_blank" href="<?php echo esc_url(__('https://www.facebook.com/QuanticaLabs/', 'gymbase')); ?>" class="social-facebook" title="<?php esc_attr_e('Facebook', 'gymbase'); ?>"></a></li>
					<li><a target="_blank" href="<?php echo esc_url(__('https://twitter.com/quanticalabs', 'gymbase')); ?>" class="social-twitter" title="<?php esc_attr_e('Twitter', 'gymbase'); ?>"></a></li>
					<li><a target="_blank" href="<?php echo esc_url(__('https://www.pinterest.com/quanticalabs/', 'gymbase')); ?>" class="social-pinterest" title="<?php esc_attr_e('Pinterest', 'gymbase'); ?>"></a></li>
					<li><a target="_blank" href="<?php echo esc_url(__('https://1.envato.market/quanticalabs', 'gymbase')); ?>" class="social-envato" title="<?php esc_attr_e('Envato', 'gymbase'); ?>"></a></li>
					<li><a target="_blank" href="<?php echo esc_url(__('https://www.behance.net/quanticalabs', 'gymbase')); ?>" class="social-behance" title="<?php esc_attr_e('Behance', 'gymbase'); ?>"></a></li>
					<li><a target="_blank" href="<?php echo esc_url(__('https://dribbble.com/QuanticaLabs', 'gymbase')); ?>" class="social-dribbble" title="<?php esc_attr_e('Dribbble', 'gymbase'); ?>"></a></li>
				</ul>
			</div>
			<div class="footer_right">
				<input type="hidden" name="action" value="gymbase_save" />
				<input type="submit" name="submit" value="<?php esc_attr_e('Save Options', 'gymbase'); ?>" />
				<img id="theme_options_preloader" src="<?php echo esc_url(get_template_directory_uri() . '/admin/images/ajax-loader.gif'); ?>" />
				<img id="theme_options_tick" src="<?php echo esc_url(get_template_directory_uri() . '/admin/images/tick.png'); ?>" />
			</div>
		</div>
	</form>
	<?php
}
?>