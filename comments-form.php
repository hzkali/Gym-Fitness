<?php 
if(comments_open())
{
	global $terms_checkbox;
	global $terms_message;
	global $top_margin;
	global $theme_options;
	?>
<div class="vc_row wpb_row vc_inner<?php echo (!empty($top_margin) && $top_margin!='none' ? ' ' . esc_attr($top_margin) : ''); ?>">
	<h4>
		<?php _e("Leave a Reply", 'gymbase'); ?>
	</h4>
	<form class="gb-comment-form margin-top-37" id="comment-form" method="post" action="#">
	<?php
	if(get_option('comment_registration') && !is_user_logged_in())
	{
	?>
	<p><?php echo sprintf(__("You must be <a href='%s'>logged in</a> to post a comment.", 'gymbase'), wp_login_url(esc_url(get_permalink()))); ?></p>
	<?php
	}
	else
	{
	?>
		<div class="vc_row vc_row-fluid wpb_row vc_inner flex-box">
			<fieldset class="vc_col-sm-6 wpb_column vc_column_container">
				<div class="gb-block">
					<label><?php _e('YOUR NAME', 'gymbase'); ?></label>
					<input class="text_input" name="name" type="text" value="">
				</div>
				<div class="gb-block">
					<label><?php _e('YOUR EMAIL', 'gymbase'); ?></label>
					<input class="text_input" name="email" type="text" value="">
				</div>
				<div class="gb-block">
					<label><?php _e('WEBSITE (OPTIONAL)', 'gymbase'); ?></label>
					<input class="text_input" name="website" type="text" value="">
				</div>
			</fieldset>
			<fieldset class="vc_col-sm-6 wpb_column vc_column_container">
				<div class="gb-block textarea-block">
					<label><?php _e('COMMENT', 'gymbase'); ?></label>
					<textarea name="message"></textarea>
				</div>
			</fieldset>
		</div>
		<div class="vc_row wpb_row vc_inner margin-top-30">
			<div class="vc_col-sm-12 wpb_column vc_column_container <?php echo ((int)$theme_options["google_recaptcha_comments"] ? 'fieldset-with-recaptcha' : 'align-right');?>">
				<?php
				if((int)$terms_checkbox)
				{
				?>
					<div class="terms-container gb-block">
						<input type="checkbox" name="terms" id="comment-formterms" value="1"><label for="comment-formterms" class="alternate"><?php echo urldecode(base64_decode($terms_message)); ?></label>
					</div>
					<div class="recaptcha-container">
				<?php
				}
				?>
				<div class="vc_row wpb_row vc_inner margin-top-15 padding-bottom-16<?php echo ((int)$theme_options["google_recaptcha_comments"] ? ' button-with-recaptcha' : '');?>">
					<a href="#cancel" id="cancel-comment" title="<?php echo esc_html_e('CANCEL REPLY', 'gymbase'); ?>"><?php echo __('CANCEL REPLY', 'gymbase'); ?></a>
					<a class="more submit-comment-form" href="#" title="<?php echo esc_html_e('POST COMMENT', 'gymbase'); ?>"><span><?php echo __('POST COMMENT', 'gymbase'); ?></span></a>
				</div>
				<?php
				if((int)$theme_options["google_recaptcha_comments"])
				{
					if($theme_options["recaptcha_site_key"]!="" && $theme_options["recaptcha_secret_key"]!="")
					{
						wp_enqueue_script("google-recaptcha-v2");
						?>
						<div class="g-recaptcha-wrapper gb-block"><div class="g-recaptcha" data-theme="dark" data-sitekey="<?php echo esc_attr($theme_options["recaptcha_site_key"]); ?>"></div></div>
						<?php
					}
					else
					{
					?>
						<p><?php _e("Error while loading reCapcha. Please set the reCaptcha keys under Theme Options in admin area", 'gymbase'); ?></p>
					<?php
					}
				}
				if((int)$terms_checkbox)
				{
				?>
				</div>
				<?php
				}
				?>
				<input type="hidden" name="action" value="theme_comment_form">
				<input type="hidden" name="comment_parent_id" value="0">
				<input type="hidden" name="paged" value="1">
				<input type="hidden" name="prevent_scroll" value="0">
			</div>
		</div>
	<?php
	}
	global $post;
	?>
		<fieldset>
			<input type="hidden" name="post_id" value="<?php echo esc_attr(get_the_ID()); ?>">
			<input type="hidden" name="post_type" value="<?php echo esc_attr($post->post_type); ?>">
		</fieldset>
	</form>
</div>
<?php
}
?>