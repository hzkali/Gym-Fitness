<?php
/*
Template Name: Single post
*/
get_header();
setPostViews(get_the_ID());
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
					<?php
					$post_template_page_array = get_pages(array(
						'post_type' => 'page',
						'post_status' => 'publish',
						'number' => 1,
						'meta_key' => '_wp_page_template',
						'meta_value' => 'template-blog.php',
						'sort_order' => 'ASC',
						'sort_column' => 'menu_order',
					));
					if(count($post_template_page_array))
					{
						$post_template_page = $post_template_page_array[0];
					}
					?>
					<li><?php if(count($post_template_page_array) && isset($post_template_page))
						{
							echo '<a href="' . esc_url(get_permalink($post_template_page->ID)) . '" title="' . esc_attr__("Blog", 'gymbase') . '">' . __("BLOG", 'gymbase') . '</a>';
						}
						else
							echo __("BLOG", 'gymbase');?>
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
			/*get page with single post template set*/
			$post_template_page_array = get_pages(array(
				'post_type' => 'page',
				'post_status' => 'publish',
				//'number' => 1,
				'meta_key' => '_wp_page_template',
				'meta_value' => 'single.php'
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
				echo wpb_js_remove_wpautop(apply_filters('the_content', '[vc_row top_margin="page-margin-top-section"][vc_column width="2/3"][single_post show_post_title="1" show_post_featured_image="1" show_post_excerpt="0" show_post_date="1" show_post_date_image="1" show_post_views="1" show_post_comments="1" show_post_author="1" show_post_categories="1" show_post_tags="1" show_share_box="1" icons_count="3" icon_type0="twitter" icon_url0="https://twitter.com/intent/tweet?text={URL}" icon_target0="_blank" icon_type1="facebook" icon_url1="https://www.facebook.com/sharer/sharer.php?u={URL}" icon_target1="_blank" icon_type2="pinterest" icon_url2="https://pinterest.com/pin/create/button/?url=&amp;media={URL}" icon_target2="_blank" show_post_tags_bottom="0"][comments show_comments_form="1" terms_checkbox="1" show_comments_list="1" top_margin="page-margin-top-section"][/vc_column][vc_column width="1/3"][vc_widget_sidebar sidebar_id="blog"][/vc_column][/vc_row]'));
		}
		else
		{
			gb_get_theme_file("/shortcodes/single-post.php");
			gb_get_theme_file("/shortcodes/comments.php");
			echo '<div class="vc_row wpb_row vc_row-fluid page-margin-top-section"><div class="vc_col-sm-12 wpb_column vc_column_container">' . gb_theme_single_post(array()) . gb_theme_comments(array("top_margin" => "page-margin-top-section")) . '</div></div>';
		}
		?>
	</div>
	<?php
	/*
		<div class="vc_row wpb_row vc_row-fluid">
			<div class="vc_col-sm-8 wpb_column vc_column_container">
				<ul class="blog clearfix">
					<?php
					if(have_posts()) : while (have_posts()) : the_post();
					?>
						<li <?php post_class('class'); ?>>
							<div class="comment_box">
								<div class="first_row">
									<?php the_time("d"); ?><span class="second_row"><?php echo strtoupper(date_i18n("M", get_post_time())); ?></span>
								</div>
								<a class="comments_number" href="<?php comments_link(); ?>" title="<?php comments_number('0 ' . __('Comments', 'gymbase')); ?>">
									<?php comments_number('0 ' . __('Comments', 'gymbase')); ?>
								</a>
							</div>
							<div class="post_content">
								<?php
								if(has_post_thumbnail()):
									$attachment_image = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()), "large");
									$large_image_url = $attachment_image[0];
								?>
								<a class="post_image fancybox" href="<?php echo $large_image_url; ?>" title="<?php the_title(); ?>">
									<?php the_post_thumbnail("blog-post-thumb", array("alt" => get_the_title(), "title" => "")); ?>
								</a>
								<?php
								endif;
								?>
								<h2>
									<a href="<?php echo esc_url(get_the_permalink()); ?>" title="<?php echo esc_attr(get_the_title()); ?>">
										<?php the_title(); ?>
									</a>
								</h2>
								<div class="text">
									<?php 
									the_content(); 
									wp_link_pages(array(
										"before" => '<ul class="pagination post_pagination page_margin_top"><li>',
										"after" => '</li></ul>',
										"link_before" => '<span>',
										"link_after" => '</span>',
										"separator" => '</li><li>'
									));
									?>
								</div>
								<?php
								if(isset($theme_options["show_share_box"]) && $theme_options["show_share_box"]==="true"):
									?>
									<div class="share_box clearfix">
										<h5 class="box_header"><?php _e('Share:', 'gymbase');?></h5>
										<ul class="social_icons clearfix">
											<?php
											$slides_count = count($theme_options["social_icon_url"]);
											for($i=0; $i<$slides_count; $i++):
												if($theme_options["social_icon_url"][$i]=="")
													continue;
												$large_image_url = "";
												if(has_post_thumbnail())
												{
													$thumb_id = get_post_thumbnail_id(get_the_ID());
													$attachment_image = wp_get_attachment_image_src($thumb_id, "large");
													$large_image_url = $attachment_image[0];
												}
												?>
												<li><a <?php echo ($theme_options["social_icon_target"][$i]=="new_window" ? " target='_blank'" : ""); ?> href="<?php echo esc_url(str_replace("{MEDIA_URL}", $large_image_url, str_replace("{TITLE}", urlencode(get_the_title()), str_replace("{URL}", get_permalink(), $theme_options["social_icon_url"][$i]))));?>" class="social_icon <?php echo esc_attr($theme_options["social_icon_type"][$i]);?>"></a></li>
												<?php
											endfor;
											?>
										</ul>
									</div>
									<?php
								endif;
								?>
								<div class="post_footer">
									<ul class="categories">
										<li class="posted_by"><?php _e('Posted by', 'gymbase'); echo " "; if(get_the_author_meta("user_url")!=""):?><a class="author" href="<?php the_author_meta("user_url"); ?>" title="<?php the_author(); ?>"><?php the_author(); ?></a><?php else: the_author(); endif; ?></li>
										<?php
										$categories = get_the_category();
										foreach($categories as $key=>$category)
										{
											?>
											<li>
												<a href="<?php echo get_category_link($category->term_id ); ?>" title="<?php echo (empty($category->description) ? sprintf(__('View all posts filed under %s', 'gymbase'), $category->name) : esc_attr(strip_tags(apply_filters('category_description', $category->description, $category)))); ?>">
													<?php echo $category->name; ?>
												</a>
											</li>
										<?php
										}
										?>
									</ul>
								</div>
							</div>
						</li>
					<?php
					endwhile; endif;
					?>
				</ul>
				<?php
				comments_template();
				gb_get_theme_file("/comments-form.php");
				?>
			</div>
			<div class="vc_col-sm-4 wpb_column vc_column_container">
				<?php
				if(is_active_sidebar('blog'))
					get_sidebar('blog');
				?>
			</div>
		</div>
	</div>*/?>
</div>
<?php
get_footer(); 
?>