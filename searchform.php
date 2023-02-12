<form class="search" action="<?php echo esc_url(get_home_url()); ?>">
	<input name="s" class="search-input template-search alternate" type="text" value="<?php echo (!empty(get_query_var('s')) ? esc_attr(get_query_var('s')) : esc_attr__('Search...', 'gymbase')); ?>" placeholder="<?php esc_attr_e('Search...', 'gymbase'); ?>" />
	<div class="search-submit-container">
		<input type="submit" class="search-submit" value="">
		<span class="template-search"></span>
	</div>
</form>