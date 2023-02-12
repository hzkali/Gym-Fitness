<?php
get_header();
global $post;
$post = get_post(get_option("woocommerce_shop_page_id"));
setup_postdata($post);
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
				$sidebar = get_post(get_post_meta(get_the_ID(), "page_sidebar_header", true));
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
			<?php $subtitle = get_post_meta(get_the_ID(), "gymbase_subtitle", true);?>
			<h1 class="page-title"><span><?php the_title();?></span><?php if($subtitle):?><p class="alternate"><?php echo $subtitle;?></p><?php endif;?></h1>
		</div>
	</div>
	<div class="clearfix">
		<div class="vc_row wpb_row vc_row-fluid page-margin-top-section">
			<?php
			if(is_active_sidebar('sidebar-shop'))
			{
				$sidebar = get_page_by_title("Sidebar Shop", OBJECT, "gymbase_sidebars");
			}
			$sidebars_count = wp_count_posts("gymbase_sidebars");
			?>
			<div class="vc_col-sm-<?php echo ((is_active_sidebar('sidebar-shop') && isset($sidebar) && !(int)get_post_meta($sidebar->ID, "hidden", true)) || (empty((array)$sidebars_count) || !$sidebars_count->publish) ? '9' : '12'); ?> wpb_column vc_column_container ">
				<div class="wpb_wrapper">
					<?php
					if(have_posts()):
						woocommerce_content();
					else:
						_e("No products found", 'gymbase');
					endif;
					?>
				</div> 
			</div>
			<?php
			if(is_active_sidebar('sidebar-shop'))
			{
				$sidebars_count = wp_count_posts("gymbase_sidebars");
				if(empty((array)$sidebars_count) || !$sidebars_count->publish)
				{
					?>
					<div class="vc_col-sm-3 wpb_column vc_column_container">
						<div class="wpb_wrapper">
							<div class="wpb_widgetised_column wpb_content_element clearfix">
								<div class="wpb_wrapper">
									<?php dynamic_sidebar('sidebar-shop'); ?>
								</div>
							</div>
						</div>
					</div>
					<?php
				}
				else if(isset($sidebar) && !(int)get_post_meta($sidebar->ID, "hidden", true))
				{
					?>
					<div class="vc_col-sm-3 wpb_column vc_column_container<?php echo ((int)get_post_meta($sidebar->ID, "hide_on_mobiles", true) ? ' hide-on-mobiles' : ''); ?>">
						<div class="wpb_wrapper">
							<div class="wpb_widgetised_column wpb_content_element clearfix">
								<div class="wpb_wrapper">
									<?php dynamic_sidebar('sidebar-shop'); ?>
								</div>
							</div>
						</div>
					</div>
					<?php
				}
			}
			?>
		</div>
	</div>
</div>
<?php
global $post;
$post = get_post(get_option("woocommerce_shop_page_id"));
setup_postdata($post);
get_footer(); 
?>