<?php 
/*
Template Name: Home
*/
get_header();
$slider_id = get_post_meta(get_the_ID(), "main_slider", true);

if(substr($slider_id, 0, 10)=="gymba_them")
	echo do_shortcode("[slider]");
else if(substr($slider_id, 0, 10)=="revolution")
	echo do_shortcode("[rev_slider " . substr($slider_id, 27) . "]");
else if(!empty($slider_id))
	echo do_shortcode("[layerslider id='" . substr($slider_id, 27) . "']");
?>
<div class="theme-page relative">
	<?php if(substr($slider_id, 0, 10)=="gymba_them" && $theme_options["home_page_top_hint"]!=""): ?>
	<div class="top-hint">
		<?php echo $theme_options["home_page_top_hint"]; ?>
	</div>
	<?php
	endif;
	if(substr($slider_id, 0, 10)=="gymba_them")
	{
		echo do_shortcode("[slider_content]");
	}
	$sidebars_count = wp_count_posts("gymbase_sidebars");
	if((empty((array)$sidebars_count) || !$sidebars_count->publish) && is_active_sidebar('home-top'))
	{
		?>
		<div class="home-box-container-list vc_row clearfix wpb_widgetised_column">
			<?php
			dynamic_sidebar('home-top');
			?>
		</div>
		<?php
	}
	else
	{
		$sidebar = get_post(get_post_meta(get_the_ID(), "page_sidebar_top", true));
		if(isset($sidebar) && !(int)get_post_meta($sidebar->ID, "hidden", true) && is_active_sidebar($sidebar->post_name))
		{
		?>
		<div class="home-box-container-list vc_row clearfix wpb_widgetised_column<?php echo ((substr($slider_id, 0, 10)=="revolution" || substr($slider_id, 0, 10)=="aaaaalayer") && !(int)get_post_meta($sidebar->ID, "hidden", true) && is_active_sidebar($sidebar->post_name) ? ' margin-minus' : '') . ((int)get_post_meta($sidebar->ID, "hide_on_mobiles", true) ? ' hide-on-mobiles' : ''); ?>">
			<div class="wpb_wrapper">
				<ul>
					<?php
					dynamic_sidebar($sidebar->post_name);
					?>
				</ul>
			</div>
		</div>
		<?php
		}
	}
	?>
	<div class="clearfix">
		<?php
		if(have_posts()) : while (have_posts()) : the_post();
			the_content();
		endwhile; endif;
		?>
	</div>
</div>
<?php
get_footer(); 
?>