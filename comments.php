<?php
if(comments_open())
{
if(have_comments()):
	?>
		<div class="comment-box">
			<div class="comments-number top-border">
				<?php echo $comments_count = get_comments_number(); echo " " . ($comments_count!=1 ? __("Comments", 'gymbase') : __("Comment", 'gymbase')); ?>
			</div>
		</div>
		<ul id="comments-list">
			<?php
			paginate_comments_links();
			wp_list_comments(array(
				'avatar_size' => 100,
				'page' => (isset($_GET["paged"]) ? (int)$_GET["paged"] : 1),
				'per_page' => '5',
				'callback' => 'gb_theme_comments_list'
			));
			?>
		</ul>
		<?php
		global $post;
		$query = $wpdb->prepare("SELECT COUNT(*) AS count FROM $wpdb->comments WHERE comment_approved = 1 AND comment_post_ID = %d AND comment_parent = 0", get_the_ID());
		$parents = $wpdb->get_row($query);
		if($parents->count>5)
			gb_comments_pagination(2, ceil($parents->count/5));
		?>
		</ul>
	<?php
endif;
}
else
{
	if(have_comments()):
	?>
	<ul id="comments-list">
		<?php
		wp_list_comments(array(
			'type' => 'pings',
			'avatar_size' => 100,
			'page' => (isset($_GET["paged"]) ? (int)$_GET["paged"] : 1),
			'per_page' => '5',
			'callback' => 'gb_theme_comments_list'
		));
		?>
	</ul>
	<?php
endif;
}
function gb_theme_comments_list($comment, $args, $depth)
{
	global $post;
	$GLOBALS['comment'] = $comment;
?>
	<li <?php comment_class('comment clearfix'); ?> id="comment-<?php echo esc_attr(get_comment_ID()); ?>">
		<div class="comment-author-avatar">
			<?php echo get_avatar( $comment->comment_author_email, $args['avatar_size'] ); ?>
		</div>
		<div class="comment-details">
			<ul class="post-footer-details">
				<li><span><?php _e("BY ", 'gymbase');?></span><?php comment_author_link();?></li>
				<li><?php comment_date();/*printf(__(' %1$s at %2$s', 'gymbase'), get_comment_date(),  get_comment_time());*/ ?></li>
				<?php edit_comment_link(__('(Edit)', 'gymbase'),'<li>','</li>');?>
			</ul>
			<?php comment_text(); ?>
			<a class="template-arrow-horizontal-1-after reply-button alternate" href="#<?php echo esc_attr(get_comment_ID()); ?>" title="<?php esc_attr_e('Reply', 'gymbase'); ?>">
				<?php _e('Reply', 'gymbase'); ?>
			</a>
		</div>
<?php
}
function gb_comments_pagination($range, $pages)
{
	$paged = (!isset($_GET["paged"]) || (int)$_GET["paged"]==0 ? 1 : (int)$_GET["paged"]);
	$showitems = ($range * 2)+1;
	
	echo "<ul class='pagination page-margin-top-section'>";
	if($paged > 2 && $paged > $range+1 && $showitems < $pages) echo "<li class='gb-first-page'><a class='more gb-button template-arrow-horizontal-1' href='#page-1/'></a></li>";
	echo "<li class='gb-prev-page'><a class='more gb-button template-arrow-horizontal-1' href='#page-" . esc_attr(($paged-1)) . "/'>" . __("PREV", 'gymbase') . "</a></li>";

	for ($i=1; $i <= $pages; $i++)
	{
		if (1 != $pages &&( !($i >= $paged+$range+1 || $i <= $paged-$range-1) || $pages <= $showitems ))
		{
			echo "<li" . ($paged == $i ? " class='selected'" : "") . ">" . ($paged == $i ? "<span>".$i."</span>":"<a href='#page-" . absint($i) . "/'>".$i."</a>") . "</li>";
		}
	}

	echo "<li class='gb-next-page'><a class='more gb-button template-arrow-horizontal-1-after' href='#page-" . esc_attr(($paged+1)) . "'>" . __("NEXT", 'gymbase') . "</a></li>";  
	if ($paged < $pages-1 &&  $paged+$range-1 < $pages && $showitems < $pages) echo "<li class='gb-last-page'><a class='more gb-button template-arrow-horizontal-1-after' href='#page-" . esc_attr($pages) . "/'></a></li>";
	echo "</ul>";
}
?>