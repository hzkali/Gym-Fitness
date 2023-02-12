<?php
//gallery shortcode
function gymbase_gallery_shortcode($atts, $content='', $tag='gymbase_gallery')
{
	global $post;

	extract(shortcode_atts(array(
		"shortcode_type" => "",
		"ids" => "",
		"category" => "",
		"order_by" => "menu_order",
		"order" => "ASC",
		"type" => "list_with_details",
		"layout" => "gallery-4-columns",
		"layout_type" => "compact",
		"featured_image_size" => "default",
		"image_box_link" => 0,
		"display_headers" => 1,
		"load_content_description" => 1,
		"display_method" => "dm_filters",
		"all_label" => ($tag=='gymbase_gallery' ? __("All Classes", 'gymbase') : ""),
		"id" => "carousel",
		"autoplay" => 0,
		"pause_on_hover" => 1,
		"scroll" => 1,
		"effect" => "scroll",
		"easing" => "swing",
		"duration" => 500,
		"el_class" => "",
		"top_margin" => "none"
	), $atts));
	
	$featured_image_size = str_replace("gb_", "", $featured_image_size);
	
	if($display_method=="dm_carousel")
	{
		if($effect=="_fade")
			$effect = "fade";
		if(strpos('ease', $easing)!==false)
		{
			$newEasing = 'ease';
			if(strpos('InOut'. $easing)!==false)
				$newEasing .= 'InOut';
			else if(strpos('In'. $easing)!==false)
				$newEasing .= 'In';
			else if(strpos('Out'. $easing)!==false)
				$newEasing .= 'Out';
			$newEasing .= ucfirst(substr($easing, strlen($newEasing), strlen($easing)-strlen($newEasing)));
		}
		else
			$newEasing = $easing;
	}
	
	$ids = explode(",", $ids);
	if($ids[0]=="-" || $ids[0]=="")
	{
		unset($ids[0]);
		$ids = array_values($ids);
	}
	$category = explode(",", $category);
	if($category[0]=="-" || $category[0]=="")
	{
		unset($category[0]);
		$category = array_values($category);
	}
	if(empty($shortcode_type))
		$shortcode_type = $tag;
	/*query_posts(array(
		'post__in' => $ids,
		'post_type' => $shortcode_type,
		'posts_per_page' => '-1',
		'post_status' => 'publish',
		$shortcode_type . '_category' => implode(",", $category),
		'orderby' => implode(" ", explode(",", $order_by)), 
		'order' => $order
	));*/
	$posts_list = get_posts(array(
		'post__in' => $ids,
		'post_type' => $shortcode_type,
		'posts_per_page' => '-1',
		'post_status' => 'publish',
		$shortcode_type . '_category' => implode(",", $category),
		'orderby' => implode(" ", explode(",", $order_by)), 
		'order' => $order
	));
	
	$output = "";
	//if(have_posts())
	if(count($posts_list))
	{
		//filters
		if($type=="list_with_details" || $type=="list")
		{
			$categories_count = count($category);
			if($display_method=="dm_filters" && ($categories_count || $all_label!=""))
			{
				$output .= '<ul class="tabs-navigation isotope-filters clearfix">';
				if($all_label!="")
					$output .= '<li>
							<a class="selected" href="#filter-*" title="' . ($all_label!='' ? esc_attr($all_label) : '') . '">' . ($all_label!='' ? esc_attr($all_label) : '') . '</a>
						</li>';
				for($i=0; $i<$categories_count; $i++)
				{
					$term = get_term_by('slug', $category[$i], $shortcode_type . "_category");
					if($term)
					{
						$output .= '<li>
								<a href="#filter-' . esc_attr(trim($category[$i])) . '" title="' . esc_attr($term->name) . '">' . $term->name . '</a>
							</li>';
					}
				}
				$output .= '</ul>';
			}
		}
		//details
		if($type=="list_with_details" || $type=="details")
		{
			$output .= '<ul class="gallery-item-details-list clearfix' . ($type=="details" ? ' not-hidden' : ' list-with-details') . ($top_margin!="none" ? ' ' . esc_attr($top_margin) : '') . ($el_class!="" ? ' ' . esc_attr($el_class) : '') . '">';
			global $post;
			$currentPost = $post;
			foreach($posts_list as $post) 
			{
				setup_postdata($post);
				//while(have_posts()): the_post();
				$output .= '<li id="gallery-details-' . esc_attr($post->post_name) . '" class="gallery-item-details clearfix">
					<div class="vc_row wpb_row vc_row-fluid">
						<div class="vc_col-sm-6 wpb_column vc_column_container">
							<div class="image-box' . (!has_post_thumbnail() ? ' fixed-height' : '') . '">';
							if(has_post_thumbnail())
							{
								if((int)$image_box_link)
								{
									$output .= '<a href="' . esc_url(get_permalink()) . '" title="' . esc_attr(get_the_title()) . '">';
								}
								$image_title = get_post_meta(get_the_ID(), "image_title", true);
								$video_url = get_post_meta(get_the_ID(), "video_url", true);
								if($video_url!="")
									$large_image_url = $video_url;
								else
								{
									$attachment_image = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()), "large");
									$large_image_url = $attachment_image[0];
								}
								$external_url = get_post_meta(get_the_ID(), "external_url", true);
								$external_url_target = get_post_meta(get_the_ID(), "external_url_target", true);
								$iframe_url = get_post_meta(get_the_ID(), "iframe_url", true);
								$output .= get_the_post_thumbnail(get_the_ID(), "gymbase-gallery-image", array("alt" => get_the_title(), "title" => ""));
							}
							if($type=="details")
							{
								$output .= '<div class="description"><h4>' . get_the_title() . '</h4>
								<p class="gb-subtitle">' . get_post_meta(get_the_ID(), "subtitle", true) . '</p></div>';
							}
							if(has_post_thumbnail() && (int)$image_box_link)
							{
								$output .= '</a>';
							}
							if($type!="details" || (has_post_thumbnail() && !(int)$image_box_link))
							{
								$output .= '<ul class="controls">';
									if($type!="details")
									{
										$output .= '<li>
											<a href="#gallery-details-close" class="close template-remove-2"></a>
										</li>
										<li>
											<a href="#" class="prev template-arrow-horizontal-7"></a>
										</li>
										<li>
											<a href="#" class="next template-arrow-horizontal-7"></a>
										</li>';
									}
									if(has_post_thumbnail() && !(int)$image_box_link)
									{
										$output .= '<li class="action-control">
											<a' . ($external_url!="" && $external_url_target=="new_window" ? ' target="_blank"' : '') . ' href="' . ($external_url=="" ? ($iframe_url!="" ? $iframe_url . "?iframe=true" : $large_image_url) : $external_url) . '" class="template-plus-2 fancybox' . ($video_url!="" ? '-video' : ($iframe_url!="" ? '-iframe' : ($external_url!="" ? '-url' : ''))) . ' open' . ($video_url!="" ? '-video' : ($iframe_url!="" ? '-iframe' : ($external_url!="" ? '-url' : ''))) . '-lightbox" title="' . esc_attr(get_the_title()) . '" rel="gbgallery"></a>
										</li>';
									}
								$output .= '</ul>';
							}
							$output .= '</div>
						</div>
						<div class="vc_col-sm-6 wpb_column vc_column_container">
							<div class="details-box">';
							if((int)$display_headers)
							{
								if($type=="list_with_details")
								{
									$gallery_categories = array_filter((array)get_the_terms(get_the_ID(), $shortcode_type . "_category"));
									$gallery_categories_count = count($gallery_categories);
									$gallery_categories_string = "";
									$i = 0;
									foreach($gallery_categories as $gallery_category)
									{
										$gallery_categories_string .= urldecode($gallery_category->name) . ($i+1<$gallery_categories_count ? ', ' : '');
										$i++;
									}
									$output .= '<ul class="title-box">
										<li><h3 class="title-header">' . get_the_title() . '</h3></li>
										' . ($gallery_categories_string!="" ? '<li><p class="alternate">' . $gallery_categories_string . '</p></li>' : '') . '
									</ul>';
								}
								else
								{
									$output .= '<h3 class="title-header">' . get_the_title() . '</h3>';
								}
							}
							if($shortcode_type=="trainers" && (int)$load_content_description)
							{
								$output .= (function_exists("wpb_js_remove_wpautop") ? wpb_js_remove_wpautop(get_post_meta(get_the_ID(), "trainer_description", true)) : apply_filters('the_content', get_post_meta(get_the_ID(), "trainer_description", true)));
							}
							else
							{
								$output .= (function_exists("wpb_js_remove_wpautop") ? wpb_js_remove_wpautop(apply_filters('the_content', get_the_content())) : apply_filters('the_content', get_the_content()));
							}
							$output .= '</div>
						</div>
					</div>
				</li>';
			//endwhile;
			}
			$post = $currentPost;
			$output .= '</ul>';
		}
		if($type!="details")
		{
			if($display_method=="dm_carousel")
				$output .= '<ul class="gb-gallery layout-type-' . esc_attr($layout_type) . ' ' . esc_attr($layout) . ' ' . esc_attr($display_method) . ' horizontal-carousel ' . esc_attr($id) . ' id-' . esc_attr($id) . ' autoplay-' . esc_attr($autoplay) . ' pause_on_hover-' . esc_attr($pause_on_hover) . ' scroll-' . esc_attr($scroll) . ' effect-' . esc_attr($effect) . ' easing-' . esc_attr($newEasing) . ' duration-' . esc_attr($duration) . ($top_margin!="none" ? ' ' . esc_attr($top_margin) : '') . ($el_class!="" ? ' ' . esc_attr($el_class) : '') . '">';
			else
				$output .= '<ul class="gb-gallery layout-type-' . esc_attr($layout_type) . ' ' . esc_attr($layout) . ($top_margin!="none" ? ' ' . esc_attr($top_margin) : '') . ($el_class!="" ? ' ' . esc_attr($el_class) : '') . '">';
			global $post;
			$currentPost = $post;
			$j=1;
			foreach($posts_list as $post) 
			{
				setup_postdata($post);
			//while(have_posts()): the_post();
				$categories = array_filter((array)get_the_terms(get_the_ID(), $shortcode_type . "_category"));
				$categories_count = count($categories);
				$categories_string = "";
				$i = 0;
				foreach($categories as $category)
				{
					$categories_string .= urldecode($category->slug) . ($i+1<$categories_count ? ' ' : '');
					$i++;
				}
				if($display_method=="dm_filters")
					$output .= '<li class="' . esc_attr($categories_string) . '" id="gallery-item-' . esc_attr($post->post_name) . '">
						<div class="gallery-box">';
				else
					$output .= '<li class="gallery-box gallery-box-' . esc_attr($j) . '" id="gallery-item-' . esc_attr($post->post_name) . '">';
					if(has_post_thumbnail())
						$output .= get_the_post_thumbnail(get_the_ID(), ($featured_image_size!="default" ? $featured_image_size : ($layout=="gallery-2-columns" ? "gymbase-gallery-image" : ($layout=="gallery-3-columns" ? "gymbase-gallery-medium-thumb" : "gymbase-gallery-square-thumb"))), array("alt" => get_the_title(), "title" => ""));
				$output .= '
						<div class="description">
							<h4 class="template-arrow-horizontal-7-after">' . get_the_title() . '</h4>
							<p class="gb-subtitle">' . get_post_meta(get_the_ID(), ($shortcode_type=="classes" ? "gymbase_" : "") . "subtitle", true) . '</p>
						</div>
						<ul class="controls">';
							if($type!="list" || (int)$image_box_link)
							{
								$output .= '
								<li>
									<a href="' . ($type=="list" && (int)$image_box_link ? esc_url(get_permalink()) : '#gallery-details-' . esc_attr($post->post_name)) . '" class="open-details"></a>
								</li>';
							}
							if(has_post_thumbnail())
							{
								$output .= '<li>';
								$video_url = get_post_meta(get_the_ID(), "video_url", true);
								if($video_url!="")
									$large_image_url = $video_url;
								else
								{
									$attachment_image = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()), "large");
									$large_image_url = $attachment_image[0];
								}
								$external_url = get_post_meta(get_the_ID(), "external_url", true);
								$external_url_target = get_post_meta(get_the_ID(), "external_url_target", true);
								$iframe_url = get_post_meta(get_the_ID(), "iframe_url", true);
								$output .= '<a' . ($external_url!="" && $external_url_target=="new_window" ? ' target="_blank"' : '') . ' href="' . ($external_url=="" ? ($iframe_url!="" ? $iframe_url . "?iframe=true" : $large_image_url) : $external_url) . '" class="template-plus-2 fancybox' . ($video_url!="" ? '-video' : ($iframe_url!="" ? '-iframe' : ($external_url!="" ? '-url' : ''))) . ' open' . ($video_url!="" ? '-video' : ($iframe_url!="" ? '-iframe' : ($external_url!="" ? '-url' : ''))) . '-lightbox" title="' . esc_attr(get_the_title()) . '" rel="gbgallery"></a>
								</li>';
							}
						$output .= '</ul>';
				if($display_method=="dm_filters")
					$output .= '</div>';
				$output .= '</li>';
				$j++;
			}	
			$post = $currentPost;
			//endwhile;
			$output .= '</ul>';
			if($display_method=="dm_carousel")
			{
				$output .= '<ul class="clearfix controls page-margin-top">
					<li><a href="#" id="' . esc_attr($id) . '_prev" class="scrolling-list-control-left template-arrow-horizontal-7"></a></li>
					<li><a href="#" id="' . esc_attr($id) . '_next" class="scrolling-list-control-right template-arrow-horizontal-7"></a></li>
				</ul>';
			}
		}
	}
	//Reset Query
	wp_reset_query();
	return $output;
}
?>