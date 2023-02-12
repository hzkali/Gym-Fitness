<?php
function gb_pagination($ajax = false, $pages = '', $range = 2, $query_string = false, $outputEcho = true, $action = '', $top_margin = 'none')
{
	$showitems = ($range * 2)+1;  

	global $paged;
	if(empty($paged)) $paged = 1;

	if($pages == '')
	{
		global $wp_query;
		$pages = $wp_query->max_num_pages;
		if(!$pages)
		{
			$pages = 1;
		}
	}

	if(1 != $pages)
	{
		if($query_string)
			parse_str($_SERVER["QUERY_STRING"], $query_string_array);
		
		$output = "<ul class='pagination" . ($ajax ? " ajax" : "") . ($action ? " " . esc_attr($action) : "") . ($top_margin!="none" ? " " . esc_attr($top_margin) : "") . "'>";
		if($paged > 2 && $paged > $range+1 && $showitems < $pages) $output .= "<li class='gb-first-page'><a class='more gb-button template-arrow-horizontal-1' href='".($query_string ? "?" . esc_url(http_build_query(array_merge($query_string_array,  array("paged"=>1)))) : esc_url(get_pagenum_link(1)))."'></a></li>";
		if($paged > 1 && $showitems < $pages) $output .= "<li class='gb-prev-page'><a class='more gb-button template-arrow-horizontal-1' href='".($query_string ? "?" . esc_url(http_build_query(array_merge($query_string_array,  array("paged"=>$paged-1)))) : esc_url(get_pagenum_link($paged - 1)))."'>" . __("PREV", 'gymbase') . "</a></li>";

		for ($i=1; $i <= $pages; $i++)
		{
			if (1 != $pages &&( !($i >= $paged+$range+1 || $i <= $paged-$range-1) || $pages <= $showitems ))
			{
				$output .= "<li" . ($paged == $i ? " class='selected'" : "") . ">" . ($paged == $i && !$ajax ? "<span>".$i."</span>":"<a href='".($query_string ? "?" . esc_url(http_build_query(array_merge($query_string_array,  array("paged"=>$i)))) : esc_url(get_pagenum_link($i)))."'>".$i."</a>") . "</li>";
			}
		}

		if ($paged < $pages && $showitems < $pages) $output .= "<li class='gb-next-page'><a class='more gb-button template-arrow-horizontal-1-after' href='".($query_string ? "?" . esc_url(http_build_query(array_merge($query_string_array,  array("paged"=>$paged + 1)))) : esc_url(get_pagenum_link($paged + 1)))."'>" . __("NEXT", 'gymbase') . "</a></li>";  
		if ($paged < $pages-1 &&  $paged+$range-1 < $pages && $showitems < $pages) $output .= "<li class='gb-last-page'><a class='more gb-button template-arrow-horizontal-1-after' href='".($query_string ? "?" . esc_url(http_build_query(array_merge($query_string_array,  array("paged"=>$pages)))) : esc_url(get_pagenum_link($pages)))."'></a></li>";
		$output .= "</ul>";
		if($ajax)
			$output .= "<span class='gb-preloader pagination-preloader" . ($top_margin!="none" ? " " . esc_attr($top_margin) : "") . "'></span>";
		if($outputEcho)
			echo $output;
		else
			return $output;
	}
}
?>