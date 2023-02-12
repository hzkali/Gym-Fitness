<?php
//contact form
function gb_theme_contact_form_shortcode($atts)
{
	global $theme_options;
	extract(shortcode_atts(array(
		"id" => "contact-form",
		"submit_label" => __("SEND MESSAGE", 'gymbase'),
		"name_label" => __("YOUR NAME", 'gymbase'),
		"name_required" => 1,
		"email_label" => __("YOUR EMAIL", 'gymbase'),
		"email_required" => 1,
		"website_label" => __("WEBSITE (OPTIONAL)", 'gymbase'),
		"website_required" => 0,
		"message_label" => __("MESSAGE", 'gymbase'),
		"message_required" => 1,
		"terms_checkbox" => 0,
		"terms_message" => "UGxlYXNlJTIwYWNjZXB0JTIwdGVybXMlMjBhbmQlMjBjb25kaXRpb25z",
		"top_margin" => "none",
		"el_class" => ""
	), $atts));
	
	$output = "";
	$output .= '<form class="gb-contact-form ' . ($top_margin!="none" ? esc_attr($top_margin) : '') . ($el_class!="" ? ' ' . esc_attr($el_class) : '') . '" id="' . esc_attr($id) . '" method="post" action="#">
		<div class="vc_row wpb_row vc_inner flex-box">
			<fieldset class="vc_col-sm-6 wpb_column vc_column_container">
				<div class="gb-block">
					' . (!empty($name_label) ? '<label>' . $name_label . '</label>' : '') . '
					<input class="text_input" name="name" type="text" value=""' . ((int)$name_required ? ' data-required="1"' : '') . '>
				</div>
				<div class="gb-block">
					' . (!empty($email_label) ? '<label>' . $email_label . '</label>' : '') . '
					<input class="text_input" name="email" type="text" value=""' . ((int)$email_required ? ' data-required="1"' : '') . '>
				</div>
				<div class="gb-block">
					' . (!empty($website_label) ? '<label>' . $website_label . '</label>' : '') . '
					<input class="text_input" name="website" type="text" value=""' . ((int)$website_required ? ' data-required="1"' : '') . '>
				</div>
			</fieldset>
			<fieldset class="vc_col-sm-6 wpb_column vc_column_container">
				<div class="gb-block textarea-block">
					' . (!empty($message_label) ? '<label>' . $message_label . '</label>' : '') . '
					<textarea name="message"' . ((int)$message_required ? ' data-required="1"' : '') . '></textarea>
				</div>
			</fieldset>
		</div>
		<div class="vc_row wpb_row vc_inner margin-top-30">
			<div class="vc_col-sm-12 wpb_column vc_column_container' . ((int)$theme_options["google_recaptcha"] ? ' fieldset-with-recaptcha' : '') . '">
				<input type="hidden" name="action" value="theme_contact_form">
				<input type="hidden" name="id" value="' . esc_attr($id) . '">';
				if((int)$terms_checkbox)
				{
					$output .= '<div class="terms-container gb-block">
						<input type="checkbox" name="terms" id="' . esc_attr($id) . 'terms" value="1"><label for="' . esc_attr($id) . 'terms">' . urldecode(base64_decode($terms_message)) . '</label>
					</div>';
					if((int)$theme_options["google_recaptcha"])
					{
						$output .= '<div class="recaptcha-container">';
					}
				}
				$output .= '<div class="vc_row wpb_row vc_inner' . ((int)$theme_options["google_recaptcha"] ? ' button-with-recaptcha' : ' align-center') . '">
					<a class="more submit-contact-form" href="#" title="' . esc_attr($submit_label) . '">' . $submit_label . '</a>
				</div>';
				if((int)$theme_options["google_recaptcha"])
				{
					if($theme_options["recaptcha_site_key"]!="" && $theme_options["recaptcha_secret_key"]!="")
					{
						wp_enqueue_script("google-recaptcha-v2");
						$output .= '<div class="g-recaptcha-wrapper gb-block"><div class="g-recaptcha" data-theme="dark" data-sitekey="' . esc_attr($theme_options["recaptcha_site_key"]) . '"></div></div>';
					}
					else
						$output .= '<p>' . __("Error while loading reCapcha. Please set the reCaptcha keys under Theme Options in admin area", 'gymbase') . '</p>';
					if((int)$terms_checkbox)
					{
						$output .= '</div>';
					}
				}
	$output .= '</div>
		</div>
	</form>';
	return $output;
}

//visual composer
function gb_theme_contact_form_vc_init()
{
	global $theme_options;
	vc_map( array(
		"name" => __("Contact form", 'gymbase'),
		"base" => "gymbase_contact_form",
		"class" => "",
		"controls" => "full",
		"show_settings_on_create" => true,
		"icon" => "icon-wpb-layer-contact-form",
		"category" => __('GymBase', 'gymbase'),
		"params" => array(
			array(
				"type" => "textfield",
				"class" => "",
				"heading" => __("Id", 'gymbase'),
				"param_name" => "id",
				"value" => "contact-form",
				"description" => __("Please provide unique id for each contact form on the same page/post", 'gymbase')
			),
			array(
				"type" => "textfield",
				"class" => "",
				"heading" => __("Submit label", 'gymbase'),
				"param_name" => "submit_label",
				"value" => __("SEND MESSAGE", 'gymbase')
			),
			array(
				"type" => "textfield",
				"class" => "",
				"heading" => __("Name label", 'gymbase'),
				"param_name" => "name_label",
				"value" => __("YOUR NAME", 'gymbase')
			),
			array(
				"type" => "dropdown",
				"class" => "",
				"heading" => __("Name field required", 'gymbase'),
				"param_name" => "name_required",
				"value" => array(__("Yes", 'gymbase') => 1, __("No", 'gymbase') => 0)
			),
			array(
				"type" => "textfield",
				"class" => "",
				"heading" => __("Email label", 'gymbase'),
				"param_name" => "email_label",
				"value" => __("YOUR EMAIL", 'gymbase')
			),
			array(
				"type" => "dropdown",
				"class" => "",
				"heading" => __("Email field required", 'gymbase'),
				"param_name" => "email_required",
				"value" => array(__("Yes", 'gymbase') => 1, __("No", 'gymbase') => 0)
			),
			array(
				"type" => "textfield",
				"class" => "",
				"heading" => __("Website label", 'gymbase'),
				"param_name" => "website_label",
				"value" => __("WEBSITE (OPTIONAL)", 'gymbase')
			),
			array(
				"type" => "dropdown",
				"class" => "",
				"heading" => __("Website field required", 'gymbase'),
				"param_name" => "website_required",
				"value" => array(__("Yes", 'gymbase') => 1, __("No", 'gymbase') => 0),
				"std" => 0
			),
			array(
				"type" => "textfield",
				"class" => "",
				"heading" => __("Message label", 'gymbase'),
				"param_name" => "message_label",
				"value" => __("MESSAGE", 'gymbase')
			),
			array(
				"type" => "dropdown",
				"class" => "",
				"heading" => __("Message field required", 'gymbase'),
				"param_name" => "message_required",
				"value" => array(__("Yes", 'gymbase') => 1, __("No", 'gymbase') => 0)
			),
			array(
				"type" => "dropdown",
				"class" => "",
				"heading" => __("Terms and conditions checkbox", 'gymbase'),
				"param_name" => "terms_checkbox",
				"value" => array(__("Yes", 'gymbase') => 1, __("No", 'gymbase') => 0),
				"std" => 0
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
				"value" => ((int)$theme_options["google_recaptcha"] ? __("Yes", 'gymbase') : __("No", 'gymbase')),
				"description" => sprintf(__("You can change this setting under <a href='%s' title='Theme Options'>Theme Options</a>", 'gymbase'), esc_url(admin_url("themes.php?page=ThemeOptions")))
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
		)
	));
}
add_action("init", "gb_theme_contact_form_vc_init");

//contact form submit
function gb_theme_contact_form()
{
	ob_start();
	global $theme_options;

    $result = array();
	$result["isOk"] = true;
	$verify_recaptcha = array();
	
	if(((isset($_POST["terms"]) && (int)$_POST["terms"]) || !isset($_POST["terms"])) && (((int)$theme_options["google_recaptcha"] && !empty($_POST["g-recaptcha-response"])) || !(int)$theme_options["google_recaptcha"]) && ((isset($_POST["name_required"]) && (int)$_POST["name_required"] && $_POST["name"]!="") || (!isset($_POST["name_required"]) || !(int)$_POST["name_required"])) && ((isset($_POST["email_required"]) && (int)$_POST["email_required"] && $_POST["email"]!="" && preg_match("#^[_a-zA-Z0-9-]+(\.[_a-zA-Z0-9-]+)*@[a-zA-Z0-9-]+(\.[a-zA-Z0-9-]+)*(\.[a-zA-Z]{2,12})$#", $_POST["email"])) || (!isset($_POST["email_required"]) || !(int)$_POST["email_required"])) && ((isset($_POST["website_required"]) && (int)$_POST["website_required"] && $_POST["website"]!="") || (!isset($_POST["website_required"]) || !(int)$_POST["website_required"])) && ((isset($_POST["message_required"]) && (int)$_POST["message_required"] && $_POST["message"]!="") || (!isset($_POST["message_required"]) || !(int)$_POST["message_required"])))
	{
		if((int)$theme_options["google_recaptcha"])
		{
			$data = array(
				"secret" => $theme_options["recaptcha_secret_key"],
				"response" => $_POST["g-recaptcha-response"]
			);
			$remote_response = wp_remote_post("https://www.google.com/recaptcha/api/siteverify", array(
				"body" => $data,
				"sslverify" => false,
			));
			$verify_recaptcha = json_decode($remote_response["body"], true);
		}
		if(((int)$theme_options["google_recaptcha"] && isset($verify_recaptcha["success"]) && (int)$verify_recaptcha["success"]) || !(int)$theme_options["google_recaptcha"])
		{
			$values = array(
				"name" => $_POST["name"],
				"email" => $_POST["email"],
				"website" => $_POST["website"],
				"message" => $_POST["message"]
			);
			$values = gb_theme_stripslashes_deep($values);
			$values = array_map("htmlspecialchars", $values);
			
			$headers[] = 'Reply-To: ' . $values["name"] . ' <' . $values["email"] . '>' . "\r\n";
			$headers[] = 'From: ' . (!empty($theme_options["cf_admin_name_from"]) ? $theme_options["cf_admin_name_from"] : $theme_options["cf_admin_name"]) . ' <' . (!empty($theme_options["cf_admin_email_from"]) ? $theme_options["cf_admin_email_from"] : $theme_options["cf_admin_email"]) . '>' . "\r\n";
			$headers[] = 'Content-type: text/html';
			$subject = $theme_options["cf_email_subject"];
			$subject = str_replace("[name]", $values["name"], $subject);
			$subject = str_replace("[email]", $values["email"], $subject); 
			$subject = str_replace("[website]", $values["website"], $subject);
			$subject = str_replace("[message]", $values["message"], $subject);
			$body = $theme_options["cf_template"];
			$body = str_replace("[name]", $values["name"], $body);
			$body = str_replace("[email]", $values["email"], $body); 
			$body = str_replace("[website]", $values["website"], $body);
			$body = str_replace("[message]", $values["message"], $body);
			
			if(wp_mail($theme_options["cf_admin_name"] . ' <' . $theme_options["cf_admin_email"] . '>', $subject, $body, $headers))
				$result["submit_message"] = (!empty($theme_options["cf_thankyou_message"]) ? $theme_options["cf_thankyou_message"] : __("Thank you for contacting us", 'gymbase'));
			else
			{
				$result["isOk"] = false;
				$result["error_message"] = $GLOBALS['phpmailer']->ErrorInfo;
				$result["submit_message"] = (!empty($theme_options["cf_error_message"]) ? $theme_options["cf_error_message"] : __("Sorry, we can't send this message", 'gymbase'));
			}
		}
		else
		{
			$result["isOk"] = false;
			$result["error_captcha"] = (!empty($theme_options["cf_recaptcha_message"]) ? $theme_options["cf_recaptcha_message"] : __("Please verify captcha.", 'gymbase'));
		}
	}
	else
	{
		$result["isOk"] = false;
		if(isset($_POST["name_required"]) && (int)$_POST["name_required"] && $_POST["name"]=="")
			$result["error_name"] = (!empty($theme_options["cf_name_message"]) ? $theme_options["cf_name_message"] : __("Please enter your name.", 'gymbase'));
		if(isset($_POST["email_required"]) && (int)$_POST["email_required"] && ($_POST["email"]=="" || !preg_match("#^[_a-zA-Z0-9-]+(\.[_a-zA-Z0-9-]+)*@[a-zA-Z0-9-]+(\.[a-zA-Z0-9-]+)*(\.[a-zA-Z]{2,12})$#", $_POST["email"])))
			$result["error_email"] = (!empty($theme_options["cf_email_message"]) ? $theme_options["cf_email_message"] : __("Please enter valid e-mail.", 'gymbase'));
		if(isset($_POST["website_required"]) && (int)$_POST["website_required"] && $_POST["website"]=="")
			$result["error_website"] = (!empty($theme_options["cf_website_message"]) ? $theme_options["cf_website_message"] : __("Please enter website url.", 'gymbase'));
		if(isset($_POST["message_required"]) && (int)$_POST["message_required"] && $_POST["message"]=="")
			$result["error_message"] = (!empty($theme_options["cf_message_message"]) ? $theme_options["cf_message_message"] : __("Please enter your message.", 'gymbase'));
		if((int)$theme_options["google_recaptcha"] && empty($_POST["g-recaptcha-response"]))
			$result["error_captcha"] = (!empty($theme_options["cf_recaptcha_message"]) ? $theme_options["cf_recaptcha_message"] : __("Please verify captcha.", 'gymbase'));
		if(isset($_POST["terms"]) && !(int)$_POST["terms"])
			$result["error_terms"] = (!empty($theme_options["cf_terms_message"]) ? $theme_options["cf_terms_message"] : __("Checkbox is required.", 'gymbase'));
	}
	$system_message = ob_get_clean();
	$result["system_message"] = $system_message;
	echo @json_encode($result);
	exit();
}
add_action("wp_ajax_theme_contact_form", "gb_theme_contact_form");
add_action("wp_ajax_nopriv_theme_contact_form", "gb_theme_contact_form");
?>