<!DOCTYPE html>
<html <?php language_attributes(); ?>>
	<?php global $theme_options; ?>
	<head>
		<!--meta-->
		<meta http-equiv="content-type" content="text/html; charset=<?php echo esc_attr(get_bloginfo("charset")); ?>" />
		<meta name="generator" content="WordPress <?php echo esc_attr(get_bloginfo("version")); ?>" />
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
		<meta name="description" content="<?php echo esc_html(get_bloginfo('description')); ?>" />
		<meta name="format-detection" content="telephone=no" />
		<!--style-->
		<link rel="alternate" type="application/rss+xml" title="<?php esc_attr_e('RSS 2.0', 'gymbase'); ?>" href="<?php echo esc_url(get_bloginfo("rss2_url")); ?>" />
		<link rel="pingback" href="<?php echo esc_url(get_bloginfo("pingback_url")); ?>" />
		<?php
		if((!function_exists('has_site_icon') || !has_site_icon()) && !empty($theme_options["favicon_url"]))
		{
			?>
			<link rel="shortcut icon" href="<?php echo (empty($theme_options["favicon_url"]) ? esc_url(get_template_directory_uri() . "/images/favicon.ico") : esc_url($theme_options["favicon_url"])); ?>" />
			<?php 
		}
		wp_head(); 
		?>
	</head>
	<body <?php body_class(); ?>>
		<?php
		$sidebars_count = wp_count_posts("gymbase_sidebars");
		if((empty((array)$sidebars_count) || !$sidebars_count->publish) && is_active_sidebar("header-top"))
		{
			?>
			<div class="header-top-sidebar-container">
				<div class="header-top-sidebar clearfix">
					<?php
					dynamic_sidebar("header-top");
					?>
				</div>
			</div>
			<?php
		}
		else
		{
			$sidebar = get_page_by_title("Header Top", OBJECT, 'gymbase_sidebars');
			if(isset($sidebar) && !(int)get_post_meta($sidebar->ID, "hidden", true) && is_active_sidebar($sidebar->post_name)):
			?>
			<div class="header-top-sidebar-container<?php echo ((int)get_post_meta($sidebar->ID, "hide_on_mobiles", true) ? ' hide-on-mobiles' : ''); ?>">
				<div class="header-top-sidebar clearfix">
					<?php
					dynamic_sidebar($sidebar->post_name);
					?>
				</div>
			</div>
			<?php
			endif;
		}
		?>
		<div class="header-container <?php echo (((!empty($_COOKIE['gb_sticky_menu']) && (int)$_COOKIE['gb_sticky_menu']==1) || (!empty($theme_options["sticky_menu"]) && (int)$theme_options["sticky_menu"]==1 && (!isset($_COOKIE['gb_sticky_menu']) || (int)$_COOKIE['gb_sticky_menu']==1 ))) ? "sticky" : "");?>">
			<div class="header clearfix">
				<div class="logo-container">
					<a href="<?php echo esc_url(get_home_url()); ?>" title="<?php echo esc_attr(get_bloginfo("name")); ?>">
						<?php if($theme_options["logo_url"]!=""): ?>
						<img src="<?php echo esc_url($theme_options["logo_url"]); ?>" alt="logo" />
						<?php endif; ?>
						<?php if($theme_options["logo_first_part_text"]!=""): ?>
						<span class="logo-left"><?php echo $theme_options["logo_first_part_text"]; ?></span>
						<?php 
						endif;
						if($theme_options["logo_second_part_text"]!=""):
						?>
						<span class="logo-right"><?php echo $theme_options["logo_second_part_text"]; ?></span>
						<?php endif; ?>
					</a>
				</div>
				<a href="#" class="mobile-menu-switch">
					<span class="line"></span>
					<span class="line"></span>
					<span class="line"></span>
					<span class="line"></span>
				</a>
				<?php
				//Get menu object
				$locations = get_nav_menu_locations();
				if(isset($locations["main-menu"]))
				{
					$main_menu_object = get_term($locations["main-menu"], "nav_menu");
					if(has_nav_menu("main-menu") && $main_menu_object->count>0) 
					{
						?>
						<div class="menu-container clearfix">
						<?php
						wp_nav_menu(array(
							"container" => "nav",
							"theme_location" => "main-menu",
							"menu_class" => "sf-menu"
						));
						?>
						</div>
						<?php
						/*wp_nav_menu(array(
							'container_class' => 'mobile_menu',
							'theme_location' => 'main-menu', // your theme location here
							'walker'         => new Walker_Nav_Menu_Dropdown(),
							'items_wrap'     => '<select>%3$s</select>',
						));*/
					}
				}
				$sidebars_count = wp_count_posts("gymbase_sidebars");
				if((empty((array)$sidebars_count) || !$sidebars_count->publish) && is_active_sidebar("header-top-right"))
				{
					?>
					<div class="header-top-right-sidebar clearfix">
					<?php
					dynamic_sidebar('header-top-right');
					?>
					</div>
					<?php
				}
				else
				{
					$sidebar = get_page_by_title("Header Top Right", OBJECT, 'gymbase_sidebars');
					if(isset($sidebar) && !(int)get_post_meta($sidebar->ID, "hidden", true) && is_active_sidebar($sidebar->post_name)):
					?>
					<div class="header-top-right-sidebar clearfix<?php echo ((int)get_post_meta($sidebar->ID, "hide_on_mobiles", true) ? ' hide-on-mobiles' : ''); ?>">
						<?php
						dynamic_sidebar($sidebar->post_name);
						?>
					</div>
					<?php
					endif;
				}
				?>
			</div>
		</div>
		<?php
		if(isset($locations["main-menu"]))
		{
		?>
		<div class="mobile-menu-container clearfix">
			<?php
			wp_nav_menu(array(
				'container'			=> 'nav',
				'container_class'	=> 'mobile-menu' . (!isset($theme_options["collapsible_mobile_submenus"]) || (int)$theme_options["collapsible_mobile_submenus"] ? " collapsible-mobile-submenus" : ""),
				'theme_location'	=> 'main-menu',
				"walker" => (!isset($theme_options["collapsible_mobile_submenus"]) || (int)$theme_options["collapsible_mobile_submenus"] ? new Mobile_Menu_Walker_Nav_Menu() : '')
			));
			?>
		</div>
		<?php
		}
		?>
	<!-- /Header -->