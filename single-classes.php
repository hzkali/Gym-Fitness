<?php
/*
Template Name: Class
*/
get_header();
?>
<div class="theme-page relative">
	<div class="vc_row wpb_row vc_row-fluid page-header vertical-align-table full-width">
		<div class="vc_row wpb_row vc_inner vc_row-fluid">
			<div class="page-header-left">
				<ul class="bread-crumb">
					<li>
						<a href="<?php echo esc_url(get_home_url()); ?>" title="<?php esc_attr_e('Home', 'gymbase'); ?>">
							<?php _e('Home', 'gymbase'); ?>
						</a>
					</li>
					<li class="separator">
						&nbsp;
					</li>
					<li>
						<?php the_title(); ?>
					</li>
				</ul>
			</div>
			<?php
			/*get page with class template set*/
			$post_template_page_array = get_pages(array(
				'post_type' => 'page',
				'post_status' => 'publish',
				//'number' => 1,
				'meta_key' => '_wp_page_template',
				'meta_value' => 'single-classes.php'
			));
			if(count($post_template_page_array))
			{
				$post_template_page_array = array_values($post_template_page_array);
				$post_template_page = $post_template_page_array[0];
				$sidebar = get_post(get_post_meta($post_template_page->ID, "page_sidebar_header", true));
				if(isset($sidebar) && !(int)get_post_meta($sidebar->ID, "hidden", true) && is_active_sidebar($sidebar->post_name)):
				?>
				<div class="page-header-right<?php echo ((int)get_post_meta($sidebar->ID, "hide_on_mobiles", true) ? ' hide-on-mobiles' : ''); ?>">
					<?php
					dynamic_sidebar($sidebar->post_name);
					?>
				</div>
				<?php
				endif;
			}
			else
			{
				$sidebars_count = wp_count_posts("gymbase_sidebars");
				if((empty((array)$sidebars_count) || !$sidebars_count->publish) && is_active_sidebar("header"))
				{
					?>
					<div class="page-header-right">
						<?php
						dynamic_sidebar("header");
						?>
					</div>
					<?php
				}
			}
			?>
		</div>
		<div class="vc_row wpb_row vc_inner vc_row-fluid">
			<?php $subtitle = get_post_meta(get_the_ID(), "gymbase_subtitle", true);?>
			<h1 class="page-title"><span><?php the_title();?></span><?php if($subtitle):?><p class="alternate"><?php echo $subtitle;?></p><?php endif;?></h1>
		</div>
	</div>
	<div class="clearfix">
		<?php
		if(function_exists("vc_map"))
		{
			if(count($post_template_page_array) && isset($post_template_page))
			{
				$vcBase = new Vc_Base();
				$vcBase->addShortcodesCustomCss($post_template_page->ID);
				echo wpb_js_remove_wpautop(apply_filters('the_content', $post_template_page->post_content));
				global $post;
				$post = $post_template_page;
				setup_postdata($post);
			}
			else
				echo wpb_js_remove_wpautop(apply_filters('the_content', '[vc_row top_margin="page-margin-top-section"][vc_column][single_class][/vc_column][/vc_row]'));
		}
		else
		{
			gb_get_theme_file("/shortcodes/single-class.php");
			echo do_shortcode(apply_filters('the_content', '<div class="vc_row wpb_row vc_row-fluid page-margin-top-section"><div class="vc_col-sm-12 wpb_column vc_column_container">' . gb_theme_single_class(array()) . '</div></div>'));
		}
		?>
	</div>
</div>
<?php
get_footer(); 
?>