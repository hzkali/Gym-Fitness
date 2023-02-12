<?php
/*
Template Name: 404 page
*/
header("HTTP/1.1 404 Not Found");
header("Status: 404 Not Found");
get_header();
?>
<div class="theme-page">
	<div class="clearfix">
		<?php
		if(function_exists("vc_map"))
		{
			/*get page with 404 page template set*/
			$not_found_template_page_array = get_pages(array(
				'post_type' => 'page',
				'post_status' => 'publish',
				'number' => 1,
				'meta_key' => '_wp_page_template',
				'meta_value' => '404.php'
			));
			if(count($not_found_template_page_array))
			{
				$not_found_template_page = $not_found_template_page_array[0];
				if(count($not_found_template_page_array) && isset($not_found_template_page))
				{
					echo wpb_js_remove_wpautop(apply_filters('the_content', $not_found_template_page->post_content));
					global $post;
					$post = $not_found_template_page;
					setup_postdata($post);
				}
				else
					echo wpb_js_remove_wpautop(apply_filters('the_content', '[vc_row el_position="first last" el_class="margin-top-100"][vc_column][featured_item icon="document-missing" title="' . esc_attr__("404. The page you requested was not found.", 'gymbase') . '" title_link="0" title_border="1" icon_link="0"]We’re sorry, but we can’t seem to find the page you requested.<br>This might be because you have typed the web address incorrectly.[/featured_item][show_all_button title="' . esc_attr__("BACK TO HOME", 'gymbase') . '" url="' . esc_url(get_home_url()) . '" show_arrow="1"][/vc_column][/vc_row]'));
			}
			else
			{
				echo wpb_js_remove_wpautop(apply_filters('the_content', '[vc_row el_position="first last" el_class="margin-top-100"][vc_column][featured_item icon="document-missing" title="' . esc_attr__("404. The page you requested was not found.", 'gymbase') . '" title_link="0" title_border="1" icon_link="0"]We’re sorry, but we can’t seem to find the page you requested.<br>This might be because you have typed the web address incorrectly.[/featured_item][show_all_button title="' . esc_attr__("BACK TO HOME", 'gymbase') . '" url="' . esc_url(get_home_url()) . '" show_arrow="1"][/vc_column][/vc_row]'));
			}
		}
		else
		{
			?>
			<div class="vc_row wpb_row vc_row-fluid margin-top-100">
				<div class="wpb_column vc_column_container vc_col-sm-12">
					<div class="wpb_wrapper">
						<div class="feature-item">
							<div class="icon features-document-missing"></div>
							<h4 class="with-border"><?php _e("404. The page you requested was not found.", 'gymbase'); ?></h4>
							<p><?php _e("We’re sorry, but we can’t seem to find the page you requested.<br>This might be because you have typed the web address incorrectly.", 'gymbase'); ?></p>
						</div>
						<div class="show-all clearfix page-margin-top align-left">
							<a class="more gb-button template-arrow-horizontal-1-after" href="<?php echo esc_url(get_home_url()); ?>" title="<?php esc_attr_e("BACK TO HOME", 'gymbase'); ?>"><?php _e("BACK TO HOME", 'gymbase'); ?></a>
						</div>
					</div>
				</div>
			</div>
			<?php
		}
		?>
	</div>
</div>
<?php
get_footer(); 
?>
