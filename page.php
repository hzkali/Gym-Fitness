<?php
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
	<div class="clearfix<?php echo (function_exists("has_blocks") && has_blocks() ? ' has-gutenberg-blocks' : '');?>">
		<?php
		if(!function_exists("vc_map") && !has_blocks())
		{
			echo '<div class="vc_row wpb_row vc_row-fluid page-margin-top padding-bottom-70 single-page">';
		}
		if(have_posts()) : while (have_posts()) : the_post();
			the_content();
			wp_link_pages(array(
				'before' => '<div class="vc_row wpb_row vc_row-fluid">',
				'after' => '</div>'
			));
		if(!function_exists("vc_map") && !has_blocks())
		{
			echo '</div>';
		}
		endwhile; endif;
		?>
	</div>
</div>
<?php
get_footer(); 
?>