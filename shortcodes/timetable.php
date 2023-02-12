<?php
//timetable
function gb_theme_timetable($atts, $content)
{
	wp_register_style("gymbase_timetable_inline_style", false);
	wp_enqueue_style("gymbase_timetable_inline_style");
	$inline_style = '';
	extract(shortcode_atts(array(
		"class" => "",
		"class_category" => "",
		"classes_url" => get_home_url() . "/classes/",
		"filter_style" => "",
		"filter_title" => __("All Classes", 'gymbase'),
		"tip_block" => 1,
		"mode" => "",
		"hour_category" => "",
		"row_height" => 42,
		"top_margin" => "none",
		"hour_minute_separator" => ".",
		"description_mobile" => 0
	), $atts));
	$classes_array = array_filter(array_map('trim', explode(",", $class)));
	$classes_category_array = array_filter(array_map('trim', explode(",", $class_category)));	

	$output = '';
	$classes_list_html = '';
	$filter_label = $filter_title;
	if($filter_title!="")
	{
		$classes_list_html .= '<li>
			<a href="#all-classes" title="' . esc_attr($filter_title) . '">
				' . $filter_title . '
			</a>
		</li>';
	}
	if(empty($class_category))
	{
		//filter by classes
		$classes_array_count = count($classes_array);
		for($i=0; $i<$classes_array_count; $i++)
		{
			query_posts(array(
				"name" => $classes_array[$i],
				'post_type' => 'classes',
				'post_status' => 'publish'
			));
			if(have_posts())
			{
				the_post();
				$classes_list_html .= '<li>
					<a href="#' . esc_attr($classes_array[$i]) . '" title="' . esc_attr(get_the_title()) . '">
						' . get_the_title() . '
					</a>
				</li>';
				if($filter_title=="" && $i==0)
				{
					$filter_label = get_the_title();
				}
			}
		}
	} 
	else
	{
		//filter by class categories
		$classes_category_array_count = count($classes_category_array);
		for($i=0; $i<$classes_category_array_count; $i++)
		{
			$class_category_info = get_terms(
				array(
					"classes_category"
				), 
				array(
					"slug" => $classes_category_array[$i],	
				)
			);
			if(!empty($class_category_info[0]))
			{
				$classes_list_html .= '<li>
					<a href="#' . esc_attr($class_category_info[0]->slug) . '" title="' . esc_attr($class_category_info[0]->name) . '">
						' . $class_category_info[0]->name . '
					</a>
				</li>';
				if($filter_title=="" && $i==0)
				{
					$filter_label = $class_category_info[0]->name;
				}
			}
		}
		//get classes for each class category	
		if(!empty($class_category))
		{
			$classes_array = array();
			$classes_array_by_category = array();
			global $post;
			foreach($classes_category_array as $val)
			{
				$classes_array_by_category[$val] = array();
				query_posts(array(
					'classes_category' => $val,
					'post_type' => 'classes',
					'post_status' => 'publish',
					'posts_per_page' => -1,
				));
				while ( have_posts() ) : the_post();
					$classes_array[] = $post->post_name;
					$classes_array_by_category[$val][] = $post->post_name;
				endwhile;
			}
		}
	}
	if((int)$row_height!=42)
	{
		$inline_style .= ((int)$row_height!=31 ? '.timetable td{height: ' . (int)$row_height . (substr($row_height, -2)!="px" ? 'px' : '') . ';}' : '');
	}
	$output = '';
	if($filter_style=="dropdown_list")
	{
		$output .= '<ul class="clearfix tabs-box-navigation sf-menu' . ($top_margin!="none" ? ' ' . esc_attr($top_margin) : '') . '">
			<li class="tabs-box-navigation-selected template-plus-2-after">
				<span>' . $filter_label . '</span>
				<ul class="sub-menu">' . $classes_list_html . '</ul>
			</li>
		</ul>';
	}
	$output .= '<div class="tabs ' . ($top_margin!="none" ? ' ' . esc_attr($top_margin) : '') . '">
		<ul class="clearfix tabs-navigation"' . ($filter_style=="dropdown_list" ? ' style="display: none;"' : '') . '>' . $classes_list_html . '</ul>';
	if($filter_title!="" || (empty($classes_array) && empty($classes_category_array)))
		$output .= '<div id="all-classes">' . gb_get_timetable($classes_url, $classes_array, $mode, $hour_category, $hour_minute_separator, $tip_block, $description_mobile) . '</div>';
	foreach((!empty($class_category) ? $classes_array_by_category : $classes_array) as $key=>$val)
		$output .= '<div id="' . (!empty($class_category) ? $key : $val) . '">' . gb_get_timetable($classes_url, $val, $mode, $hour_category, $hour_minute_separator, $tip_block, $description_mobile) . '</div>';
	$output .= '</div>';
	//Reset Query
	wp_reset_query();
	wp_add_inline_style("gymbase_timetable_inline_style", $inline_style);
	return $output;
}

function gb_hour_in_array($hour, $array)
{
	$array_count = count($array);
	for($i=0; $i<$array_count; $i++)
	{
		if(!isset($array[$i]["displayed"]))
			$array[$i]["displayed"] = false;
		if(!isset($array[$i]["start"]))
			$array[$i]["start"] = false;
		if((bool)$array[$i]["displayed"]!=true && (int)$array[$i]["start"]==(int)$hour)
			return true;
	}
	return false;
}
function gb_get_rowspan_value($hour, $array, $rowspan, $hour_minute_separator = null)
{
	$array_count = count($array);
	$found = false;
	$hours = array();
	for($i=(int)$hour; $i<(int)$hour+$rowspan; $i++)
		$hours[] = $i;
	for($i=0; $i<$array_count; $i++)
	{
		if(in_array((int)$array[$i]["start"], $hours))
		{
			$end_explode = explode($hour_minute_separator, $array[$i]["end"]);
			$end_hour = (int)$array[$i]["end"] + ((int)$end_explode[1]>0 ? 1 : 0);
			if($end_hour-(int)$hour>1 && $end_hour-(int)$hour>$rowspan)
			{
				$rowspan = $end_hour-(int)$hour;
				$found = true;
			}
		}
		
	}
	if(!$found)
		return $rowspan;
	else
		return gb_get_rowspan_value($hour, $array, $rowspan, $hour_minute_separator);
}
function gb_get_row_content($classes, $classes_url, $mode, $hour_minute_separator = null)
{
	$content = "";
	
	$tooltip = "";
	foreach($classes as $key=>$details)
	{
		$color = "";
		$textcolor = ""; 
                $temp = explode('_',$key);
		$key = $temp[0]; 
		if(count($classes)>1)
		{
			$color = get_post_meta($details["id"], "gymbase_color", true);
		}
		$text_color = get_post_meta($details["id"], "gymbase_text_color", true);
		$content .= ($content!="" ? '<br>' : '') . '<a' . ($color!="" || $text_color!="" ? ' style="' . ($color!="" ? 'background-color: #' . esc_attr($color) . ';' : '') . ($text_color!="" ? 'color: #' . esc_attr($text_color) . ';' : '') . '"': '') . ' href="' . esc_url($classes_url) . '#' . urldecode($details["name"]) . '" title="' .  esc_attr($key) . '">' . $key . '</a>';
		$hours_count = count($details["hours"]);
		for($i=0; $i<$hours_count; $i++)
		{
			if($mode=="12h")
			{
				$hoursExplode = explode(" - ", $details["hours"][$i]);
				$details["hours"][$i] = date("h" . $hour_minute_separator . "i a", strtotime($hoursExplode[0])) . " - " . date("h" . $hour_minute_separator . "i a", strtotime($hoursExplode[1]));
			}
			$content .= ($i!=0 ? '<br>' : '');
			if($details["before_hour_text"][$i]!="")
				$content .= "<div class='before-hour-text'>" . do_shortcode($details["before_hour_text"][$i]) . "</div>";
			$content .= '<div class="hours">' . $details["hours"][$i] . "</div>";
			if($details["after_hour_text"][$i]!="")
				$content .= "<div class='after-hour-text'>" . do_shortcode($details["after_hour_text"][$i]) . "</div>";
			if($details["trainers"][$i]!="")
				$content .= "<div class='class-trainers'>" . $details["trainers"][$i] . "</div>";	
			$class_link_tooltip = '<a href="' . esc_url($classes_url) . '#' . urldecode($details["name"]) . '" title="' .  esc_attr($key) . '">' . $key . '</a>';
			$tooltip .= ($tooltip!="" && $details["tooltip"][$i]!="" ? '<br><br>' : '' ) . ($details["tooltip"][$i]!="" ? $class_link_tooltip : '') . $details["tooltip"][$i];
		}
	}
	if($tooltip!="")
		$content .= '<div class="tooltip-text"><div class="tooltip-content">' . $tooltip . '</div><span class="tooltip-arrow"></span></div>';	
	return $content;
}
function gb_get_timetable($classes_url, $class = null, $mode = null, $hour_category = null, $hour_minute_separator = null, $tip_block = 1, $description_mobile = 0)
{
	global $blog_id;
	global $wpdb;
	if($hour_category!=null)
		$hour_category = explode(",", $hour_category);
	$output = ""; 
	$query = $wpdb->prepare("SELECT TIME_FORMAT(t1.start, '%s') AS start, TIME_FORMAT(t1.end, '%s') AS end, t1.tooltip AS tooltip, t1.before_hour_text AS before_hour_text, t1.after_hour_text AS after_hour_text, t1.trainers AS trainers, t2.ID AS class_id, t2.post_title AS class_title, t2.post_name AS post_name, t3.post_title, t3.menu_order FROM ".$wpdb->prefix."class_hours AS t1 
			LEFT JOIN {$wpdb->posts} AS t2 ON t1.class_id=t2.ID 
			LEFT JOIN {$wpdb->posts} AS t3 ON t1.weekday_id=t3.ID 
			WHERE 
			t2.post_type='classes'
			AND t2.post_status='publish'", "%H" . $hour_minute_separator . "%i", "%H" . $hour_minute_separator . "%i");
	if(is_array($class) && count($class))
		$query .= "
			AND t2.post_name IN('" . join("','", esc_sql($class)) . "')";
	else if($class!=null)
		$query .= $wpdb->prepare("
			AND t2.post_name='%s'", strtolower(urlencode($class)));
	if($hour_category!=null)
		$query .= "
			AND t1.category IN('" . join("','", esc_sql($hour_category)) . "')";
	$query .= "
			AND 
			t3.post_type='gymbase_weekdays'
			ORDER BY FIELD(t3.menu_order,2,3,4,5,6,7,1), t1.start, t1.end";
	$class_hours = $wpdb->get_results($query);
	if(!count($class_hours))
		return __('No class hours available!' , 'gymbase');
	$class_hours_tt = array();
	foreach($class_hours as $class_hour)
	{
		$trainersString = "";
		if($class_hour->trainers!="")
		{
			query_posts(array( 
				'post__in' => explode(",", $class_hour->trainers),
				'post_type' => 'trainers',
				'posts_per_page' => '-1',
				'post_status' => 'publish',
				'orderby' => 'post_title', 
				'order' => 'DESC'
			));
			while(have_posts()): the_post();
				$trainersString .= get_the_title() . "<br>";
			endwhile;
			if($trainersString!="")
				$trainersString = substr($trainersString, 0, -4);
		}
		$class_hours_tt[($class_hour->menu_order>1 ? $class_hour->menu_order-1 : 7)][] = array(
			"start" => $class_hour->start,
			"end" => $class_hour->end,
			"tooltip" => $class_hour->tooltip,
			"before_hour_text" => $class_hour->before_hour_text,
			"after_hour_text" => $class_hour->after_hour_text,
			"trainers" => $trainersString,
			"tooltip" => $class_hour->tooltip,
			"id" => $class_hour->class_id,
			"title" => $class_hour->class_title,
			"name" => $class_hour->post_name
		);
	}

	$output .= '<table class="timetable">
				<thead>
					<tr>
						<th></th>';
	//get weekdays
	$query = "SELECT post_title, menu_order FROM {$wpdb->posts}
			WHERE 
			post_type='gymbase_weekdays'
			AND post_status='publish'
			ORDER BY FIELD(menu_order,2,3,4,5,6,7,1)";
	$weekdays = $wpdb->get_results($query);
	foreach($weekdays as $weekday)
	{
		$output .= '	<th>' . $weekday->post_title . '</th>';
	}
	$output .= '	</tr>
				</thead>
				<tbody>';
	//get min anx max hour
	$query = $wpdb->prepare("SELECT min(TIME_FORMAT(t1.start, '%s')) AS min, max(REPLACE(TIME_FORMAT(t1.end, '%s'), '%s', '%s')) AS max FROM ".$wpdb->prefix."class_hours AS t1
			LEFT JOIN {$wpdb->posts} AS t2 ON t1.class_id=t2.ID 
			LEFT JOIN {$wpdb->posts} AS t3 ON t1.weekday_id=t3.ID 
			WHERE 
			t2.post_type='classes'
			AND t2.post_status='publish'", "%H" . $hour_minute_separator . "%i", "%H" . $hour_minute_separator . "%i", "00" . $hour_minute_separator . "00", "24" . $hour_minute_separator . "00");
	if(is_array($class) && count($class))
		$query .= "
			AND t2.post_name IN('" . join("','", esc_sql($class)) . "')";
	else if($class!=null)
		$query .= $wpdb->prepare("
			AND t2.post_name='%s'", strtolower(urlencode($class)));
	if($hour_category!=null)
		$query .= "
			AND t1.category IN('" . join("','", esc_sql($hour_category)) . "')";
	$query .= "
			AND 
			t3.post_type='gymbase_weekdays'";
	$hours = $wpdb->get_row($query);
	if($hours->min!=null && $hours->max!=null)
	{
		$drop_columns = array();
		$l = 0;
		$max_explode = explode($hour_minute_separator, $hours->max);
		$max_hour = (int)$hours->max + ((int)$max_explode[1]>0 ? 1 : 0);
		for($i=(int)$hours->min; $i<$max_hour; $i++)
		{
			$start = str_pad($i, 2, '0', STR_PAD_LEFT) . $hour_minute_separator . '00';
			$end = str_replace("24", "00", str_pad($i+1, 2, '0', STR_PAD_LEFT)) . $hour_minute_separator . '00';
			if($mode=="12h")
			{
				$start = date("h" . $hour_minute_separator . "i a", strtotime($start));
				$end = date("h" . $hour_minute_separator . "i a", strtotime($end));
			}
			$output .= '<tr class="row_' . ($l+1) . ($l%2==0 ? ' row-gray' : '') . '">
							<td>
								' . $start . ' - ' . $end . '
							</td>';
							for($j=1; $j<=count($weekdays); $j++)
							{
								if(!isset($drop_columns[$i]["columns"]))
									$drop_columns[$i]["columns"] = '';
								if(!in_array($j, (array)$drop_columns[$i]["columns"]))
								{
									if(isset($class_hours_tt[$j]) && gb_hour_in_array($i, $class_hours_tt[$j]))
									{
										$rowspan = gb_get_rowspan_value($i, $class_hours_tt[$j], 1, $hour_minute_separator);
										if($rowspan>1)
										{
											for($k=1; $k<$rowspan; $k++)
												$drop_columns[$i+$k]["columns"][] = $j;	
										}
										$array_count = count($class_hours_tt[$j]);
										$hours = array();
										for($k=(int)$i; $k<(int)$i+$rowspan; $k++)
											$hours[] = $k;
										$classes = array();
										for($k=0; $k<$array_count; $k++)
										{
											if(in_array((int)$class_hours_tt[$j][$k]["start"], $hours))
											{
												$classes[$class_hours_tt[$j][$k]["title"].'_'.$k]["name"] = $class_hours_tt[$j][$k]["name"];
												$classes[$class_hours_tt[$j][$k]["title"].'_'.$k]["tooltip"][] = $class_hours_tt[$j][$k]["tooltip"];
												$classes[$class_hours_tt[$j][$k]["title"].'_'.$k]["before_hour_text"][] = $class_hours_tt[$j][$k]["before_hour_text"];
												$classes[$class_hours_tt[$j][$k]["title"].'_'.$k]["after_hour_text"][] = $class_hours_tt[$j][$k]["after_hour_text"];
												$classes[$class_hours_tt[$j][$k]["title"].'_'.$k]["trainers"][] = $class_hours_tt[$j][$k]["trainers"];
												$classes[$class_hours_tt[$j][$k]["title"].'_'.$k]["id"] = $class_hours_tt[$j][$k]["id"];
												$classes[$class_hours_tt[$j][$k]["title"].'_'.$k]["hours"][] = $class_hours_tt[$j][$k]["start"] . " - " . $class_hours_tt[$j][$k]["end"];
												$class_hours_tt[$j][$k]["displayed"] = true;
											}
										}
										$color = "";
										$text_color = "";
										if(count($classes)==1)
										{
											$color = get_post_meta($classes[key($classes)]["id"], "gymbase_color", true);
											$text_color = get_post_meta($classes[key($classes)]["id"], "gymbase_text_color", true);
										}
										$output .= '<td' . ($color!="" || $text_color!="" ? ' style="' . ($color!="" ? 'background-color: #' . esc_attr($color) . ';' : '') . ($text_color!="" ? 'color: #' . esc_attr($text_color) . ';' : '') . '"': '') . ' class="event' . (count(array_filter(array_values($classes[key($classes)]['tooltip']))) ? ' tooltip' : '' ) . '"' . ($rowspan>1 ? ' rowspan="' . esc_attr($rowspan) . '"' : '') . '>';
										$output .= gb_get_row_content($classes, $classes_url, $mode, $hour_minute_separator);
										$output .= '</td>';
									}
									else
										$output .= '<td></td>';
								}
							}
			$output .= '</tr>';
			$l++;
		}
	}
	if((int)$tip_block)
	{
	$output .= '	<tr class="tip-row">
						<td colspan="8" class="last">
							<div class="tip template-comment-1">
								' . __("Click on the class name to get additional info", 'gymbase') . '
							</div>
						</td>
					</tr>';
	}
	$output .= '</tbody>
			</table>
			<div class="timetable small">';
	$l = 0;
	foreach($weekdays as $weekday)
	{
		$weekday_fixed_number = ($weekday->menu_order>1 ? $weekday->menu_order-1 : 7);
		if(isset($class_hours_tt[$weekday_fixed_number]))
		{
			$output .= '<h3 class="box-header' . ($l>0 ? ' page-margin-top' : '') . '">
				' . $weekday->post_title . '
			</h3>
			<ul class="items-list page-margin-top">';
				$class_hours_count = count($class_hours_tt[$weekday_fixed_number]);
					
				for($i=0; $i<$class_hours_count; $i++)
				{
					if($mode=="12h")
					{
						if(empty($class_hours_tt[$weekday_fixed_number][$i]))
							continue;
						$class_hours_tt[$weekday_fixed_number][$i]["start"] = date("h" . $hour_minute_separator . "i a", strtotime($class_hours_tt[$weekday_fixed_number][$i]["start"]));
						$class_hours_tt[$weekday_fixed_number][$i]["end"] = date("h" . $hour_minute_separator . "i a", strtotime($class_hours_tt[$weekday_fixed_number][$i]["end"]));
					}
					if(isset($class_hours_tt[$weekday_fixed_number][$i]))
					{
						$output .= '<li>
								<a href="' . esc_url($classes_url) . '#' . urldecode($class_hours_tt[$weekday_fixed_number][$i]["name"]) . '" title="' . esc_attr($class_hours_tt[$weekday_fixed_number][$i]["title"]) . '">
									' . $class_hours_tt[$weekday_fixed_number][$i]["title"] . '
								</a>
								<div class="value">
									' . $class_hours_tt[$weekday_fixed_number][$i]["start"] . ' - ' . $class_hours_tt[$weekday_fixed_number][$i]["end"] . '
								</div>';
						if((int)$description_mobile)
						{
								$output .= '<span class="event_description">
									<span class="event_description_1">'.do_shortcode($class_hours_tt[$weekday_fixed_number][$i]["before_hour_text"]).'</span>
									<span class="event_description_2">'.do_shortcode($class_hours_tt[$weekday_fixed_number][$i]["after_hour_text"]).'</span>
								</span>';
						}
						$output .= '</li>';
					}
				}
			$output .= '</ul>';
			$l++;
		}
	}
	$output .= '</div>';
	return $output;
}
//visual composer
function gb_theme_timetable_vc_init()
{
	//get classes list
	$classes_list = get_posts(array(
		'posts_per_page' => -1,
		'orderby' => 'menu_order',
		'order' => 'ASC',
		'post_type' => 'classes'
	));
	$classes_array = array();
	$classes_array[__("All", 'gymbase')] = "";
	foreach($classes_list as $class)
		$classes_array[$class->post_title . " (id:" . $class->ID . ")"] = $class->post_name;
	
	//get all pages
	$classes_page = get_page_by_title("classes");	
	$pages_list = get_posts(array(
		'posts_per_page' => -1,
		'orderby' => 'title',
		'order' => 'ASC',
		'post_type' => 'page',
		'post__not_in' => !empty($classes_page->ID) ? array($classes_page->ID) : ""
	));
	if(!empty($classes_page)) {
		array_unshift($pages_list, $classes_page);
	}
	$pages_array = array();
	foreach($pages_list as $page)
		$pages_array[$page->post_title . " (id:" . $page->ID . ")"] = home_url() . "/" . $page->post_name;
	
	//get all class categories
	$class_categories = get_terms(array(
		"classes_category"
	));
	$class_categories_array = array();
	if(!is_wp_error($class_categories))
	{
		$class_categories_array[__("All", 'gymbase')] = "";
		foreach($class_categories as $class_category)
			$class_categories_array[$class_category->name] = $class_category->slug;
	}
	
	//get all hour categories
	global $wpdb;
	global $blog_id;
	$query = "SELECT distinct(category) AS category FROM ".$wpdb->prefix."class_hours AS t1
			LEFT JOIN {$wpdb->posts} AS t2 ON t1.class_id=t2.ID 
			WHERE 
			t2.post_type='classes'
			AND t2.post_status='publish'
			AND category<>''";
	$hour_categories = $wpdb->get_results($query);
	$hour_categories_array = array();
	$hour_categories_array[__("All", 'gymbase')] = "";
	foreach($hour_categories as $hour_category)
		$hour_categories_array[$hour_category->category] = $hour_category->category;
	
	vc_map( array(
		"name" => __("Timetable", 'gymbase'),
		"base" => "timetable",
		"class" => "",
		"controls" => "full",
		"show_settings_on_create" => true,
		"icon" => "icon-wpb-layer-timetable",
		"category" => __('GymBase', 'gymbase'),
		"params" => array(
			array(
				"type" => "dropdownmulti",
				"class" => "",
				"heading" => __("Display selected", 'gymbase'),
				"param_name" => "class",
				"value" => $classes_array
			),
			array(
				"type" => "dropdown",
				"class" => "",
				"heading" => __("Mode", 'gymbase'),
				"param_name" => "mode",
				"value" => array(__("24h (military time)", 'gymbase') => "", __("12h (am/pm)", 'gymbase') => "12h")
			),
			array(
				"type" => "dropdownmulti",
				"class" => "",
				"heading" => __("Display from class category", 'gymbase'),
				"param_name" => "class_category",
				"value" => $class_categories_array
			),
			array(
				"type" => "dropdownmulti",
				"class" => "",
				"heading" => __("Display from hour category", 'gymbase'),
				"param_name" => "hour_category",
				"value" => $hour_categories_array
			),
			array(
				"type" => (count($pages_array) ? "dropdown" : "textfield"),
				"class" => "",
				"heading" => __("Classes page", 'gymbase'),
				"param_name" => "classes_url",
				"value" => (count($pages_array) ? $pages_array : ''),
			),
			array(
				"type" => "dropdown",
				"class" => "",
				"heading" => __("Hour minute separator", 'gymbase'),
				"param_name" => "hour_minute_separator",
				"value" => array(".", ":")
			),
			array(
				"type" => "dropdown",
				"class" => "",
				"heading" => __("Filter style", 'gymbase'),
				"param_name" => "filter_style",
				"value" => array(__("tabs", 'gymbase') => "", __("dropdown list", 'gymbase') => "dropdown_list" )
			),
			array(
				"type" => "textfield",
				"class" => "",
				"heading" => __("Filter title", 'gymbase'),
				"param_name" => "filter_title",
				"value" => __("All Classes", 'gymbase')
			),
			array(
				"type" => "textfield",
				"class" => "",
				"heading" => __("Row height (in px)", 'gymbase'),
				"param_name" => "row_height",
				"value" => "42",					
			),
			array(
				"type" => "dropdown",
				"class" => "",
				"heading" => __("Display tip block", 'gymbase'),
				"param_name" => "tip_block",
				"value" => array(__("Yes", 'gymbase') => 1, __("No", 'gymbase') => "0")
			),
			array(
				"type" => "dropdown",
				"class" => "",
				"heading" => __("Display before and after hour text on mobiles", 'gymbase'),
				"param_name" => "description_mobile",
				"value" => array(__("No", 'gymbase') => "0", __("Yes", 'gymbase') => 1)
			),
			array(
				"type" => "dropdown",
				"class" => "",
				"heading" => __("Top margin", 'gymbase'),
				"param_name" => "top_margin",
				"value" => array(__("None", 'gymbase') => "none", __("Page (small)", 'gymbase') => "page-margin-top", __("Section (large)", 'gymbase') => "page-margin-top-section")
			)
		)
	));
}
add_action("init", "gb_theme_timetable_vc_init");

?>