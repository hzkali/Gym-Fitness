<?php
//post
function gb_theme_single_post($atts)
{
	extract(shortcode_atts(array(
		"featured_image_size" => "default",
		"show_post_title" => 1,
		"show_post_featured_image" => 1,
		"show_post_excerpt" => 0,
		"show_post_categories" => 1,
		"show_post_tags" => 1,
		"show_post_date" => 1,
		"show_post_date_image" => 1,
		"show_post_author" => 1,
		"show_share_box" => 1,
		"show_post_views" => 1,
		"show_post_comments" => 1,
		"icons_count" => 1
	), $atts));
	
	$featured_image_size = str_replace("gb_", "", $featured_image_size);
	
	global $post;
	setup_postdata($post);
	
	$output = "";
	$post_classes = get_post_class("post");
	$output .= '<div class="blog clearfix"><div class="single ';
	foreach($post_classes as $key=>$post_class)
		$output .= ($key>0 ? ' ' : '') . esc_attr($post_class);
	$output .= '">';
	$output .= '<div class="comment-box">
		<div class="first-row">
			' . date_i18n('d', get_post_time()) . '<span class="second-row">' . strtoupper(date_i18n("M, Y", get_post_time())) . '</span>
		</div>';
		$comments_count = get_comments_number();
	$output .= '<a class="comments-number scroll-to-comments" href="' . esc_url(get_comments_link()) . '" title="' . esc_attr($comments_count) . ' ' . ($comments_count==1 ? esc_html__('comment', 'gymbase') : esc_html__('comments', 'gymbase')) . '">
			' . esc_attr($comments_count) . ' ' . ($comments_count==1 ? esc_attr__('Comment', 'gymbase') : esc_attr__('Comments', 'gymbase')) . '
		</a>
	</div>';
	$output .= '<div class="post-content">';
	if(has_post_thumbnail() && (int)$show_post_featured_image)
	{
		$thumb_id = get_post_thumbnail_id(get_the_ID());
		$attachment_image = wp_get_attachment_image_src($thumb_id, "large");
		$large_image_url = $attachment_image[0];
		$output .= '<a class="post-image fancybox" href="' . esc_url($large_image_url) . '" title="' . esc_attr(get_the_title()) . '">' . get_the_post_thumbnail(get_the_ID(), ($featured_image_size!="default" ? $featured_image_size : "blog-post-thumb"), array("alt" => "", "title" => "")) . '</a>';
	}
	if($show_post_title) 
		$output .= '<h3><a href="' . esc_url(get_permalink()) . '" title="' . esc_attr(get_the_title()) . '">' . get_the_title() . '</a></h3>';
	$output .= '<div class="text">';
	if((int)$show_post_excerpt)
		$output .= '<p>' . apply_filters("the_excerpt", get_the_excerpt()) . '</p>';
	if(get_post_type()=="post")
		$output .= (function_exists("wpb_js_remove_wpautop") ? wpb_js_remove_wpautop(apply_filters('the_content', get_the_content())) : apply_filters('the_content', get_the_content()));
	$output .= '</div>';
	if($show_share_box && (int)$icons_count)
	{
		$output .= '<div class="share-box clearfix">
						<label>' . __("SHARE:", 'gymbase') . '</label>
						<ul class="social-icons clearfix">';
		for($i=0; $i<$icons_count; $i++)
		{
			if(isset($atts["icon_type" . $i]))
			{
				$large_image_url = "";
				if(has_post_thumbnail() && (int)$show_post_featured_image)
				{
					$thumb_id = get_post_thumbnail_id(get_the_ID());
					$attachment_image = wp_get_attachment_image_src($thumb_id, "large");
					$large_image_url = $attachment_image[0];
				}
				$output .= '<li><a' . (isset($atts["icon_target" . $i]) && $atts["icon_target" . $i]=="_blank" ? ' target="_blank"' : '') . ' title="" href="' . esc_url(str_replace("{MEDIA_URL}", $large_image_url, str_replace("{TITLE}", urlencode(get_the_title()), str_replace("{URL}", esc_url(get_permalink()), $atts["icon_url" . $i])))) . '" class="social-' . esc_attr($atts["icon_type" . $i]) . '"></a></li>';
			}
		}
		$output .= '</ul></div>';
	}
	if((int)$show_post_date || (int)$show_post_author || (int)$show_post_categories || (int)$show_post_tags || (int)$show_post_views || (int)$show_post_comments || is_sticky(get_the_ID()))
	{
		$output .= '<div class="post-footer">';
		$output .= '<a class="gb-button more scroll-to-comment-form" href="' . esc_url(get_the_permalink()) . '#comment-form" title="' . esc_attr__("POST COMMENT", 'gymbase') . '">' . __("POST COMMENT", 'gymbase') . '</a>';
		if((int)$show_post_date || (int)$show_post_author || (int)$show_post_categories || (int)$show_post_tags || is_sticky(get_the_ID()))
		{
			$output .= '<ul class="post-footer-details">';
			if(is_sticky(get_the_ID()))
			{
				$output .= '<li class="sticky-label">' . __("STICKY POST", 'gymbase') . '</li>';
			}
			if((int)$show_post_author)
			{
				$output .= '<li class="post-footer-author">' . __('POSTED BY', 'gymbase') . ' ' . (get_the_author_meta("user_url")!="" ? '<a class="author" href="' . esc_url(get_the_author_meta("user_url")) . '" title="' . esc_attr(get_the_author()) . '">' . get_the_author() . '</a>' : get_the_author()) . '</li>';
			}
			if((int)$show_post_categories)
			{
				$categories = get_the_category();
				$output .= '<li class="post-footer-category">' . __("IN ", 'gymbase');
				foreach($categories as $key=>$category)
				{
					$output .= '<a class="category-' . esc_attr($category->term_id) . '" href="' . esc_url(get_category_link($category->term_id)) . '" ';
					if(empty($category->description))
						$output .= 'title="' . sprintf(__('View all posts filed under %s', 'gymbase'), esc_attr($category->name)) . '"';
					else
						$output .= 'title="' . esc_attr(strip_tags(apply_filters('category_description', $category->description, $category))) . '"';
					$output .= '>' . $category->name . '</a>' . ($category != end($categories) ? ', ' : '');
				}
				$output .= '</li>';
			}
			
			if((int)$show_post_tags)
			{
				$tags = get_the_tags();
				if($tags)
				{
					$output .= '<li>' . __("Tags ", 'gymbase');
					foreach($tags as $key=>$tag)
					{
						$output .= '<a href="' . esc_url(get_tag_link($tag->term_id)) . '" ';
						if(empty($tag->description))
							$output .= 'title="' . sprintf(__('View all posts filed under %s', 'gymbase'), esc_attr($tag->name)) . '"';
						else
							$output .= 'title="' . esc_attr(strip_tags(apply_filters('tag_description', $tag->description, $tag))) . '"';
						$output .= '>' . $tag->name . '</a>' . ($tag != end($tags) ? ', ' : '');
					}
					$output .= '</li>';
				}
			}
			$output .= '</ul>';
		}
		$output .= '</div>';
	}
	$output .= wp_link_pages(array(
		"before" => '<ul class="pagination post-pagination page-margin-top"><li>',
		"after" => '</li></ul>',
		"link_before" => '<span>',
		"link_after" => '</span>',
		"separator" => '</li><li>',
		"echo" => 0
	));
	$output .= '</div></div></div>';
	return $output;
}


//visual composer
function gb_theme_single_post_vc_init()
{
	//image sizes
	$image_sizes_array = array();
	$image_sizes_array[__("Default", 'gymbase')] = "default";
	global $_wp_additional_image_sizes;
	foreach(get_intermediate_image_sizes() as $s) 
	{
		if(isset($_wp_additional_image_sizes[$s])) 
		{
			$width = intval($_wp_additional_image_sizes[$s]['width']);
			$height = intval($_wp_additional_image_sizes[$s]['height']);
		} 
		else
		{
			$width = get_option($s.'_size_w');
			$height = get_option($s.'_size_h');
		}
		$image_sizes_array[$s . " (" . $width . "x" . $height . ")"] = "cm_" . $s;
	}
	$params = array(
		array(
			"type" => "dropdown",
			"class" => "",
			"heading" => __("Featured image size", 'gymbase'),
			"param_name" => "featured_image_size",
			"value" => $image_sizes_array
		),
		array(
			"type" => "dropdown",
			"class" => "",
			"heading" => __("Show post title", 'gymbase'),
			"param_name" => "show_post_title",
			"value" => array(__("Yes", 'gymbase') => 1, __("No", 'gymbase') => 0)
		),
		array(
			"type" => "dropdown",
			"class" => "",
			"heading" => __("Show post featured image", 'gymbase'),
			"param_name" => "show_post_featured_image",
			"value" => array(__("Yes", 'gymbase') => 1, __("No", 'gymbase') => 0)
		),
		array(
			"type" => "dropdown",
			"class" => "",
			"heading" => __("Show post excerpt", 'gymbase'),
			"param_name" => "show_post_excerpt",
			"value" => array(__("Yes", 'gymbase') => 1, __("No", 'gymbase') => 0),
			"std" => 0
		),
		array(
			"type" => "dropdown",
			"class" => "",
			"heading" => __("Show post date", 'gymbase'),
			"param_name" => "show_post_date",
			"value" => array(__("Yes", 'gymbase') => 1, __("No", 'gymbase') => 0)
		),
		array(
			"type" => "dropdown",
			"class" => "",
			"heading" => __("Show post date on featured image", 'gymbase'),
			"param_name" => "show_post_date_image",
			"value" => array(__("Yes", 'gymbase') => 1, __("No", 'gymbase') => 0)
		),
		array(
			"type" => "dropdown",
			"class" => "",
			"heading" => __("Show post views number", 'gymbase'),
			"param_name" => "show_post_views",
			"value" => array(__("Yes", 'gymbase') => 1, __("No", 'gymbase') => 0)
		),
		array(
			"type" => "dropdown",
			"class" => "",
			"heading" => __("Show comments number", 'gymbase'),
			"param_name" => "show_post_comments",
			"value" => array(__("Yes", 'gymbase') => 1, __("No", 'gymbase') => 0)
		),
		array(
			"type" => "dropdown",
			"class" => "",
			"heading" => __("Show post author", 'gymbase'),
			"param_name" => "show_post_author",
			"value" => array(__("Yes", 'gymbase') => 1, __("No", 'gymbase') => 0)
		),
		array(
			"type" => "dropdown",
			"class" => "",
			"heading" => __("Show post categories", 'gymbase'),
			"param_name" => "show_post_categories",
			"value" => array(__("Yes", 'gymbase') => 1, __("No", 'gymbase') => 0)
		),
		array(
			"type" => "dropdown",
			"class" => "",
			"heading" => __("Show post tags", 'gymbase'),
			"param_name" => "show_post_tags",
			"value" => array(__("Yes", 'gymbase') => 1, __("No", 'gymbase') => 0)
		),
		array(
			"type" => "dropdown",
			"class" => "",
			"heading" => __("Show share box", 'gymbase'),
			"param_name" => "show_share_box",
			"value" => array(__("Yes", 'gymbase') => 1, __("No", 'gymbase') => 0)
		)
	);
	$count = array();
	for($i=1; $i<=30; $i++)
		$count[$i] = $i;
	$icons = array(
		__("angies-list", 'gymbase') => "angies-list",
		__("behance", 'gymbase') => "behance",
		__("deviantart", 'gymbase') => "deviantart",
		__("dribbble", 'gymbase') => "dribbble",
		__("email", 'gymbase') => "email",
		__("envato", 'gymbase') => "envato",
		__("facebook", 'gymbase') => "facebook",
		__("flickr", 'gymbase') => "flickr",
		__("foursquare", 'gymbase') => "foursquare",
		__("github", 'gymbase') => "github",
		__("google-plus", 'gymbase') => "google-plus",
		__("houzz", 'gymbase') => "houzz",
		__("instagram", 'gymbase') => "instagram",
		__("linkedin", 'gymbase') => "linkedin",
		__("location", 'gymbase') => "location",
		__("mobile", 'gymbase') => "mobile",
		__("paypal", 'gymbase') => "paypal",
		__("pinterest", 'gymbase') => "pinterest",
		__("reddit", 'gymbase') => "reddit",
		__("rss", 'gymbase') => "rss",
		__("skype", 'gymbase') => "skype",
		__("soundcloud", 'gymbase') => "soundcloud",
		__("spotify", 'gymbase') => "spotify",
		__("stumbleupon", 'gymbase') => "stumbleupon",
		__("tumblr", 'gymbase') => "tumblr",
		__("twitter", 'gymbase') => "twitter",
		__("whatsapp", 'gymbase') => "whatsapp",
		__("weibo", 'gymbase') => "weibo",
		__("vimeo", 'gymbase') => "vimeo",
		__("vine", 'gymbase') => "vine",
		__("vk", 'gymbase') => "vk",
		__("xing", 'gymbase') => "xing",
		__("yelp", 'gymbase') => "yelp",
		__("youtube", 'gymbase') => "youtube"
	);
	$params[] = array(
		"type" => "dropdown",
		"class" => "",
		"heading" => __("Number of social icons", 'gymbase'),
		"param_name" => "icons_count",
		"value" => $count,
		"dependency" => Array('element' => "show_share_box", 'value' => '1')
	);
	for($i=0; $i<25; $i++)
	{
		$params[] = array(
			"type" => "dropdown",
			"heading" => __("Icon type", 'gymbase') . " " . ($i+1),
			"param_name" => "icon_type" . $i,
			"value" => $icons,
			"dependency" => Array('element' => "show_share_box", 'value' => '1')
		);
		$params[] = array(
			"type" => "textfield",
			"class" => "",
			"heading" => __("Icon url", 'gymbase') . " " . ($i+1),
			"param_name" => "icon_url" . $i,
			"value" => "",
			"dependency" => Array('element' => "show_share_box", 'value' => '1'),
			"description" => sprintf(__("Use <strong>{URL}</strong> constant to have current post url in the link. You can also use <strong>{TITLE}</strong> variable and {MEDIA_URL} variable. Example: https://www.facebook.com/sharer.php?u=<strong>{URL}</strong> You can use <a href='%s' target='_blank'>Share Link Generator</a> to create share link", 'gymbase'), esc_url(__("https://www.sharelinkgenerator.com/", 'gymbase')))
		);
		$params[] = array(
			"type" => "dropdown",
			"class" => "",
			"heading" => __("Icon target", 'gymbase') . " " . ($i+1),
			"param_name" => "icon_target" . $i,
			"value" => array(__("Same window", 'gymbase') => "", __("New window", 'gymbase') => "_blank"),
			"dependency" => Array('element' => "show_share_box", 'value' => '1')
		);
	}
	vc_map( array(
		"name" => __("Post", 'gymbase'),
		"base" => "single_post",
		"class" => "",
		"controls" => "full",
		"show_settings_on_create" => true,
		"icon" => "icon-wpb-layer-post",
		"category" => __('GymBase', 'gymbase'),
		"params" => $params
	));
}
add_action("init", "gb_theme_single_post_vc_init");
?>