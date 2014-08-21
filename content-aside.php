<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <header class="entry-header">
        <h1 class="entry-title">
			<a href="<?php the_permalink(); ?>" title="<?php echo esc_attr(sprintf('Enlace a %s', the_title_attribute('echo=0'))); ?>" rel="bookmark"><?php the_title(); ?></a>
		</h1>
    </header>

	<?php if (is_search()) : ?>
		<div class="entry-summary">
			<?php the_excerpt(); ?>
		</div>
	<?php else : ?>
		<div class="entry-content">
			<?php the_content('Continúa leyendo <span class="meta-nav">&rarr;</span>'); ?>
			<?php wp_link_pages(array('before' => '<div class="page-links">' . 'Páginas:', 'after' => '</div>')); ?>
		</div>
	<?php endif; ?>

    <footer class="entry-meta">
        <a href="<?php the_permalink(); ?>" title="<?php echo esc_attr(sprintf('Enlace a %s', the_title_attribute('echo=0'))); ?>" rel="bookmark"><?php echo get_the_date(); ?></a>
		<?php if (!post_password_required() && ( comments_open() || '0' != get_comments_number() )) : ?>
			<span class="sep"> | </span>
			<span class="comments-link"><?php comments_popup_link('Deja un comentario', '1 Comentario', '% Comentarios'); ?></span>
		<?php endif; ?>

		<?php edit_post_link('Editar', '<span class="sep"> | </span><span class="edit-link">', '</span>'); ?>
    </footer>
</article>
