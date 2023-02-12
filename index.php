<?php get_header(); ?>
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
					<?php echo __("Latest Posts", 'gymbase');?>
				</li>
			</ul>
		</div>
	</div>
	<div class="vc_row wpb_row vc_inner vc_row-fluid">
		<h1 class="page-title"><?php echo __("Latest Posts", 'gymbase'); ?></h1>
	</div>
	<div class="clearfix">
		<?php
		if(function_exists("vc_map"))
			echo do_shortcode(apply_filters('the_content', '[vc_row top_margin="page-margin-top"][vc_column width="2/3"][box_header type="h5" bottom_border="1" animation="1"]' . __("Latest News", 'gymbase') . '[/box_header][blog pagination="0" count="' . esc_attr(get_option('posts_per_page')) . '"][show_all_button show_arrow="1"][/vc_column][vc_column width="1/3"][vc_widget_sidebar sidebar_id="home-right"][/vc_column][/vc_row]'));	
		else
		{
			gb_get_theme_file("/shortcodes/blog.php");
			echo '<div class="vc_row wpb_row vc_row-fluid page-margin-top"><div class="wpb_column vc_column_container vc_col-sm-12"><div class="wpb_wrapper"><h5 class="box-header animation-slide">' . __("Latest News", 'gymbase') . '</h5>' .
			gb_theme_blog(array(
				"categories" => "",
				"count" => esc_attr(get_option('posts_per_page')),
				"order" => "desc",
				"orderby" => "date",
				"pagination" => 1
			)) . '</div></div></div>';
		}
		paginate_links();
		?>
	</div>
</div>
<?php get_footer(); ?>