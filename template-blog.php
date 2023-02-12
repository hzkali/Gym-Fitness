<?php 
/*
Template Name: Blog
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
						<?php
						if(is_archive())
						{
							if(is_day())
								$archive_header = __("Daily archives: ", 'gymbase') . get_the_date(); 
							else if(is_month())
								$archive_header = __("Monthly archives: ", 'gymbase') . get_the_date('F, Y');
							else if(is_year())
								$archive_header = __("Yearly archives: ", 'gymbase') . get_the_date('Y');
							else
								$archive_header = "Archives";
						}
						echo (is_category() || is_archive() ? (is_category() ? single_cat_title("", false) : $archive_header) : get_the_title());?>
					</li>
				</ul>
			</div>
			<?php
			$page_sidebar_header = get_post_meta(get_the_ID(), "page_sidebar_header", true);
			$sidebar = null;
			if(is_category() || is_archive())
			{
				/*get page with blog template set*/
				$post_template_page_array = get_pages(array(
					'post_type' => 'page',
					'post_status' => 'publish',
					'number' => 1,
					'meta_key' => '_wp_page_template',
					'meta_value' => 'template-blog.php',
					'sort_order' => 'ASC',
					'sort_column' => 'menu_order',
				));
				$post_template_page = $post_template_page_array[0];
				if($page_sidebar_header)
					$sidebar = get_post(get_post_meta($post_template_page->ID, "page_sidebar_header", true));
			}
			else
			{
				if($page_sidebar_header)
					$sidebar = get_post(get_post_meta(get_the_ID(), "page_sidebar_header", true));
			}
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
			else
			{
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
			?>
		</div>
		<div class="vc_row wpb_row vc_inner vc_row-fluid">
			<?php
			if(is_archive())
			{
				if(is_day())
					$archive_header = __("Daily archives: ", 'gymbase') . get_the_date(); 
				else if(is_month())
					$archive_header = __("Monthly archives: ", 'gymbase') . get_the_date('F, Y');
				else if(is_year())
					$archive_header = __("Yearly archives: ", 'gymbase') . get_the_date('Y');
				else
					$archive_header = "Archives";
			}
			$subtitle = get_post_meta(get_the_ID(), "gymbase_subtitle", true);
			?>
			<h1 class="page-title"><span><?php echo (is_category() || is_archive() ? (is_category() ? single_cat_title("", false) : $archive_header) : get_the_title());?></span><?php if($subtitle):?><p class="alternate"><?php echo $subtitle;?></p><?php endif;?></h1>
		</div>
	</div>
	<div class="clearfix">
		<?php
		if(is_category() || is_archive())
		{
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
					echo wpb_js_remove_wpautop(apply_filters('the_content', '[vc_row top_margin="page-margin-top-section"][vc_column width="2/3"][blog pagination="1" count="' . esc_attr(get_option('posts_per_page')) . '"][/vc_column][vc_column width="1/3"][vc_widget_sidebar sidebar_id="blog"][/vc_column][/vc_row]'));
			}
			else
			{
				gb_get_theme_file("/shortcodes/blog.php");
				echo '<div class="vc_row wpb_row vc_row-fluid page-margin-top-section padding-bottom-100">' . gb_theme_blog(array(
					"categories" => "",
					"count" => "3",
					"order" => "desc",
					"orderby" => "date",
					"pagination" => 1
				)) . '</div>';
			}
		}
		else
		{
			if(have_posts()) : while (have_posts()) : the_post();
				the_content();
			endwhile; endif;
		}
		?>
	</div>
</div>
<?php
get_footer(); 
?>