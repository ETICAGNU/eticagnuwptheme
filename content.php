<article id="post-<?php the_ID() ?>" <?php post_class() ?>>
	<header class="entry-header">
		<h1 class="entry-title">
			<a href="<?php the_permalink() ?>" title="<?php echo esc_attr(sprintf('Enlace a %s', the_title_attribute('echo=0'))); ?>" rel="bookmark"><?php the_title() ?></a>
		</h1>
		<?php if ('post' == get_post_type()) : ?>
			<div class="entry-meta">
				<?php eticagnu_main_posted_on() ?>
			</div>
		<?php endif ?>
	</header>

	<?php if (is_search()) : ?>
		<div class="entry-summary">
			<?php the_excerpt() ?>
		</div>
	<?php else : ?>
		<div class="entry-content">
			<?php if (has_post_thumbnail()) : ?>
				<?php the_post_thumbnail('thumbnail', array('class' => 'thumbnail')); ?>
			<?php endif ?>
			<?php the_excerpt() ?>
			<?php wp_link_pages(array('before' => '<div class="page-links">' . 'Páginas:', 'after' => '</div>')); ?>
		</div>
	<?php endif ?>

	<footer class="entry-meta">
		<?php if ('post' == get_post_type()) : ?>
			<?php $categoriesList = get_the_category_list(', '); ?>
			<?php if ($categoriesList && eticagnu_main_categorized_blog()) : ?>
				<span class="cat-links">
					<?php printf('%1$s', $categoriesList); ?>
				</span>
			<?php endif ?>

			<?php $tags_list = get_the_tag_list('', ', '); ?>
			<?php if ($tags_list) : ?>
				<span class="sep"> | </span>
				<span class="tag-links">
					<?php printf('Temas: %1$s', $tags_list); ?>
				</span>
			<?php endif ?>
		<?php endif ?>

		<?php if (!post_password_required() && ( comments_open() || '0' != get_comments_number() )) : ?>
			<span class="sep"> | </span>
			<span class="comments-link"><?php comments_popup_link('Deja un comentario', '1 Comentario', '% Comentarios'); ?></span>
		<?php endif; ?>

		<?php edit_post_link('Editar', '<span class="sep"> | </span><span class="edit-link">', '</span>'); ?>
	</footer>
</article>
