<?php
//blog
function gb_theme_blog($atts)
{
	extract(shortcode_atts(array(
		"categories" => "",
		"count" => "3",
		"order" => "desc",
		"orderby" => "date",
		"pagination" => 1
	), $atts));
	$is_search_results = (int)is_search();
	$output = "";
	ob_start();
	?>
		<ul class="blog clearfix">
			<?php
			$args = array( 
				'post_type' => 'post',
				'post_status' => 'publish',
				'posts_per_page' => $count,
				'paged' => get_query_var('paged'),
				'cat' => (get_query_var('cat')!="" ? get_query_var('cat') : $categories),
				'tag' => get_query_var('tag'),
				'monthnum' => get_query_var('monthnum'),
				'day' => get_query_var('day'),
				'year' => get_query_var('year'),
				'w' => get_query_var('week'),
				'order' => $order,
				'orderby' => $orderby
			);
			if(!empty(get_query_var('s')))
			{
				$args['s'] = get_query_var('s');
			}
			query_posts($args);
			if(have_posts()) : while (have_posts()) : the_post();
			?>
				<li <?php post_class('class'); ?>>
					<div class="comment-box">
						<div class="first-row">
							<?php the_time("d"); ?><span class="second-row"><?php echo strtoupper(date_i18n("M, Y", get_post_time())); ?></span>
						</div>
						<?php $comments_count = get_comments_number();?>
						<a class="comments-number" href="<?php echo esc_url(get_comments_link()); ?>" title="<?php echo esc_attr($comments_count) . ' ' . ($comments_count==1 ? esc_attr__('Comment', 'gymbase') : esc_attr__('Comments', 'gymbase')); ?>">
							<?php echo esc_attr($comments_count) . ' ' . ($comments_count==1 ? esc_attr__('Comment', 'gymbase') : esc_attr__('Comments', 'gymbase')); ?>
						</a>
					</div>
					<div class="post-content">
						<?php
						if(has_post_thumbnail()):
						?>
						<a class="post-image" href="<?php echo esc_url(get_the_permalink()); ?>" title="<?php echo esc_attr(get_the_title()); ?>">
							<?php the_post_thumbnail("blog-post-thumb", array("alt" => get_the_title(), "title" => "")); ?>
						</a>
						<?php
						endif;
						?>
						<h3>
							<a href="<?php echo esc_url(get_the_permalink()); ?>" title="<?php echo esc_attr(get_the_title()); ?>">
								<?php the_title(); ?>
							</a>
						</h3>
						<div class="text">
							<?php the_excerpt(); ?>
						</div>
						<div class="post-footer">
							<a class="gb-button more" href="<?php echo esc_url(get_the_permalink()); ?>" title="<?php esc_attr_e("READ MORE", 'gymbase'); ?>"><?php _e("READ MORE", 'gymbase'); ?></a>
							<ul class="post-footer-details">
								<li class="post-footer-author"><?php _e('POSTED BY', 'gymbase'); echo " "; if(get_the_author_meta("user_url")!=""):?><a class="author" href="<?php echo esc_url(get_the_author_meta("user_url")); ?>" title="<?php esc_attr(get_the_author()); ?>"><?php the_author(); ?></a><?php else: the_author(); endif; ?></li>
								<?php
								$categories = get_the_category();
								if(count($categories))
								{
								?>
								<li class="post-footer-category">
								<?php
								_e('IN', 'gymbase');
								foreach($categories as $key=>$category)
								{
									?>
									<a href="<?php echo esc_url(get_category_link($category->term_id)); ?>" title="<?php echo (empty($category->description) ? sprintf(esc_attr__('View all posts filed under %s', 'gymbase'), $category->name) : esc_attr(strip_tags(apply_filters('category_description', $category->description, $category)))); ?>">
										<?php echo $category->name; ?>
									</a>
								<?php
									echo ($category != end($categories) ? ', ' : '');
								}
								?>
								</li>
								<?php
								}
								?>
							</ul>
						</div>
					</div>
				</li>
			<?php
			endwhile; 
			else:
				$output .= '<div class="vc_row wpb_row vc_row-fluid margin-top-20">' . ($is_search_results ? sprintf(__('No results found for "%s"', 'gymbase'), esc_attr(get_query_var('s'))) : __('No posts found', 'gymbase')) . '</div>';
			endif;
			?>
		</ul>
		<?php
		if($pagination)
		{
			gb_get_theme_file("/pagination.php");
			gb_pagination(false, '', 2, false, true, '', 'page-margin-top');
		}
		//Reset Query
		wp_reset_query();
		?>
	<?php
	$output .= ob_get_contents();
	ob_end_clean();
	
	return $output;  
}

//visual composer
function gb_theme_blog_vc_init()
{
	$post_categories = get_terms("category");

	$categories = array("All" => "");
	foreach($post_categories as $c){
		$cat = get_category($c);
		$categories[$cat->name] = $cat->term_id;
	}
	vc_map(array(
		"name" => __("Blog", 'gymbase'),
		"base" => "blog",
		"class" => "",
		"controls" => "full",
		"show_settings_on_create" => true,
		"icon" => "icon-wpb-layer-blog",
		"category" => __('GymBase', 'gymbase'),
		"params" => array(
			array(
				"type" => "dropdown",
				"class" => "",
				"heading" => __("Pagination", 'gymbase'),
				"param_name" => "pagination",
				"value" => array(__("Yes", 'gymbase') => 1, __("No", 'gymbase') => 0)
			),
			array(
				"type" => "dropdownmulti",
				"class" => "",
				"heading" => __("Post categories", 'gymbase'),
				"param_name" => "categories",
				"value" => $categories
			),
			array(
				"type" => "textfield",
				"class" => "",
				"heading" => __("Count", 'gymbase'),
				"param_name" => "count",
				"value" => "3"
			),
			array(
				"type" => "dropdown",
				"class" => "",
				"heading" => __("Order", 'gymbase'),
				"param_name" => "order",
				"value" => array(__("DESC", 'gymbase') => "desc", __("ASC", 'gymbase') => "asc")
			),
			array(
				"type" => "dropdown",
				"class" => "",
				"heading" => __("Order by", 'gymbase'),
				"param_name" => "orderby",
				"value" => array(__("Date", 'gymbase') => "date", __("Title", 'gymbase') => "title", __("Menu order", 'gymbase') => "menu_order")
			)
		)
	));
}
add_action("init", "gb_theme_blog_vc_init");
