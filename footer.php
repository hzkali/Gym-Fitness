		<?php global $theme_options; 
		$sidebars_count = wp_count_posts("gymbase_sidebars");
		if((empty((array)$sidebars_count) || !$sidebars_count->publish) && (is_active_sidebar('footer-top') || is_active_sidebar('footer-bottom')))
		{
			?>
			<div class="footer-container">
				<div class="footer">
					<ul class="footer-banner-box-container clearfix">
						<?php
						if(is_active_sidebar('footer-top'))
							dynamic_sidebar('footer-top');
						?>
					</ul>
					<div class="footer-box-container vc_row wpb_row vc_row-fluid row-4-4 clearfix">
						<?php
						if(is_active_sidebar('footer-bottom'))
							dynamic_sidebar('footer-bottom');
						?>
					</div>
				</div>
			</div>
			<?php
		}
		else
		{
			$sidebar_footer_top = null;
			$sidebar_footer_top_meta = get_post_meta(get_the_ID(), "page_sidebar_footer_top", true);
			if($sidebar_footer_top_meta)
			{
				$sidebar_footer_top = get_post($sidebar_footer_top_meta);
			}
			$sidebar = null;
			$sidebar_meta = get_post_meta(get_the_ID(), "page_sidebar_footer_bottom", true);
			if($sidebar_meta)
			{
				$sidebar = get_post($sidebar_meta);
			}
			if((isset($sidebar_footer_top) && !(int)get_post_meta($sidebar_footer_top->ID, "hidden", true) && is_active_sidebar($sidebar_footer_top->post_name)) || (isset($sidebar) && !(int)get_post_meta($sidebar->ID, "hidden", true) && is_active_sidebar($sidebar->post_name)))
			{
			?>
			<div class="footer-container">
				<div class="footer">
					<?php
					if(isset($sidebar_footer_top) && !(int)get_post_meta($sidebar_footer_top->ID, "hidden", true) && is_active_sidebar($sidebar_footer_top->post_name))
					{
					?>
					<ul class="footer-banner-box-container clearfix<?php echo ((int)get_post_meta($sidebar_footer_top->ID, "hide_on_mobiles", true) ? ' hide-on-mobiles' : ''); ?>">
						<?php
						dynamic_sidebar($sidebar_footer_top->post_name);
						?>
					</ul>
					<?php
					}
					if(isset($sidebar) && !(int)get_post_meta($sidebar->ID, "hidden", true) && is_active_sidebar($sidebar->post_name))
					{
					?>
					<div class="footer-box-container vc_row wpb_row vc_row-fluid row-4-4 clearfix<?php echo ((int)get_post_meta($sidebar->ID, "hide_on_mobiles", true) ? ' hide-on-mobiles' : ''); ?>">
						<?php
							dynamic_sidebar($sidebar->post_name);
						?>
					</div>
					<?php
					}
					?>
				</div>
			</div>
			<?php
			}
		}
		$locations = get_nav_menu_locations();
		if(isset($locations["footer-menu"]))
			$footer_menu_object = get_term($locations["footer-menu"], "nav_menu");
		if($theme_options["footer_text_left"]!="" || (has_nav_menu("footer-menu") && $footer_menu_object->count>0) || is_active_sidebar('copyright-area')): ?>
		<div class="copyright-area-container">
			<div class="copyright-area clearfix">
				<?php if($theme_options["footer_text_left"]!=""): ?>
				<div class="copyright-text alternate">
				<?php
				echo do_shortcode($theme_options["footer_text_left"]);
				?>
				</div>
				<?php
				endif;
				if(is_active_sidebar('copyright-area'))
				{
					$sidebar = get_page_by_title("Copyright Area", OBJECT, "gymbase_sidebars");
					if(isset($sidebar) && !(int)get_post_meta($sidebar->ID, "hidden", true))
					{
						if((int)get_post_meta($sidebar->ID, "hide_on_mobiles", true))
						{
						?>
						<div class="hide-on-mobiles">
						<?php
						}
						dynamic_sidebar('copyright-area');
						if((int)get_post_meta($sidebar->ID, "hide_on_mobiles", true))
						{
						?>
						</div>
						<?php
						}
					}
				}
				if(has_nav_menu("footer-menu") && $footer_menu_object->count>0) 
				{
					wp_nav_menu(array(
						"theme_location" => "footer-menu",
						"menu_class" => "footer-menu"
					));
				}
				?>
			</div>
		</div>
		<?php endif; ?>
		<?php if((int)$theme_options["scroll_top"]): ?>
		<a href="#top" class="scroll-top animated-element template-arrow-vertical-3" title="<?php esc_attr_e("Scroll to top", 'gymbase'); ?>"></a>
		<?php
		endif;
		wp_footer(); ?>
	</body>
</html>