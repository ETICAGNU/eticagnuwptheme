<?php
if (post_password_required())
	return;
?>

<div id="comments" class="comments-area">
	<?php if (have_comments()) : ?>
		<h2 class="comments-title">
			<?php printf(_n('Un comentario en &ldquo;%2$s&rdquo;', '%1$s comentarios en &ldquo;%2$s&rdquo;', get_comments_number(), 'eticagnu_main'), number_format_i18n(get_comments_number()), '<span>' . get_the_title() . '</span>') ?>
		</h2>

		<?php if (get_comment_pages_count() > 1 && get_option('page_comments')) : ?>
			<nav role="navigation" id="comment-nav-above" class="site-navigation comment-navigation">
				<div class="nav-previous"><?php previous_comments_link('&larr; Comentarios anteriores'); ?></div>
				<div class="nav-next"><?php next_comments_link('Comentarios recientes &rarr;'); ?></div>
			</nav>
		<?php endif ?>

		<ol class="commentlist">
			<?php
			wp_list_comments(array(
				'callback' => 'eticagnu_main_comment'
			))
			?>
		</ol>

		<?php if (get_comment_pages_count() > 1 && get_option('page_comments')) : ?>
			<nav role="navigation" id="comment-nav-below" class="site-navigation comment-navigation">
				<div class="nav-previous"><?php previous_comments_link('&larr; Comentarios anteriores'); ?></div>
				<div class="nav-next"><?php next_comments_link('Comentarios recientes &rarr;'); ?></div>
			</nav>
		<?php endif ?>

	<?php endif ?>

	<?php if (!comments_open() && '0' != get_comments_number() && post_type_supports(get_post_type(), 'comments')) : ?>
		<p class="nocomments">Los comentarios están cerrados</p>
	<?php endif; ?>

	<?php comment_form(); ?>
</div>
