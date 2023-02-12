<?php
//Adds a box to the main column on the Page edit screens
function gb_theme_add_custom_box() 
{
    add_meta_box( 
        "options",
        __("Options", 'gymbase'),
        "gb_theme_inner_custom_box",
        "page",
		"normal",
		"high"
    );
	add_meta_box( 
        "options",
        __("Options", 'gymbase'),
        "gb_theme_inner_custom_box_post",
        "post",
		"normal",
		"high"
    );
}
add_action("add_meta_boxes", "gb_theme_add_custom_box");
//backwards compatible (before WP 3.0)
//add_action("admin_init", "theme_add_custom_box", 1);

// Prints the box content
function gb_theme_inner_custom_box($post)
{
	//Use nonce for verification
	wp_nonce_field(plugin_basename( __FILE__ ), "gymbase_noncename");
	echo '
	<table>
		<tr>
			<td>
				<label for="subtitle">' . __('Subtitle', 'gymbase') . ':</label>
			</td>
			<td>
				<input class="regular-text" type="text" id="subtitle" name="subtitle" value="' . esc_attr(get_post_meta($post->ID, "gymbase_subtitle", true)) . '" />
			</td>
		</tr>
	</table>
	';
}

// Prints the box content post
function gb_theme_inner_custom_box_post($post)
{
	//Use nonce for verification
	wp_nonce_field(plugin_basename( __FILE__ ), "gymbase_noncename");

	//The actual fields for data entry
	$subtitle = get_post_meta($post->ID, "gymbase_subtitle", true);
	echo '
	<table>
		<tr>
			<td>
				<label for="subtitle">' . __('Subtitle', 'gymbase') . ':</label>
			</td>
			<td>
				<input class="regular-text" type="text" id="subtitle" name="subtitle" value="' . esc_attr(get_post_meta($post->ID, "gymbase_subtitle", true)) . '" />
			</td>
		</tr>
	</table>
	';
}

//When the post is saved, saves our custom data
function gb_theme_save_postdata($post_id) 
{
	// verify if this is an auto save routine. 
	// If it is our form has not been submitted, so we dont want to do anything
	if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) 
		return;

	//verify this came from the our screen and with proper authorization,
	//because save_post can be triggered at other times
	if(!isset($_POST['gymbase_noncename']) || !wp_verify_nonce($_POST['gymbase_noncename'], plugin_basename( __FILE__ )))
		return;


	// Check permissions
	if(!current_user_can('edit_post', $post_id))
		return;
		
	//OK, we're authenticated: we need to find and save the data
	if(isset($_POST["subtitle"]))
		update_post_meta($post_id, "gymbase_subtitle", $_POST["subtitle"]);	
	if(isset($_POST["page_sidebar_header"]))
		update_post_meta($post_id, "page_sidebar_header", $_POST["page_sidebar_header"]);
	if(isset($_POST["page_sidebar_top"]))
		update_post_meta($post_id, "page_sidebar_top", $_POST["page_sidebar_top"]);
	if(isset($_POST["page_sidebar_footer_top"]))
		update_post_meta($post_id, "page_sidebar_footer_top", $_POST["page_sidebar_footer_top"]);
	if(isset($_POST["page_sidebar_footer_bottom"]))
		update_post_meta($post_id, "page_sidebar_footer_bottom", $_POST["page_sidebar_footer_bottom"]);
	update_post_meta($post_id, "gymbase_page_sidebars", array_values(array_filter(array(
		(!empty($_POST["page_sidebar_header"]) ? $_POST["page_sidebar_header"] : NULL),
		(!empty($_POST["page_sidebar_top"]) ? $_POST["page_sidebar_top"] : NULL),
		(!empty($_POST["page_sidebar_footer_top"]) ? $_POST["page_sidebar_footer_top"] : NULL),
		(!empty($_POST["page_sidebar_footer_bottom"]) ? $_POST["page_sidebar_footer_bottom"] : NULL)
	))));
	if(isset($_POST["main_slider"]))
		update_post_meta($post_id, "main_slider", $_POST["main_slider"]);
}
add_action("save_post", "gb_theme_save_postdata");
?>