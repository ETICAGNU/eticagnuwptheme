<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <header class="entry-header">
        <h1 class="entry-title"><?php the_title(); ?></h1>

        <div class="entry-meta">
			<?php eticagnu_main_posted_on(); ?>
        </div>
    </header>

    <div class="entry-content">
		<?php the_content(); ?>
		<?php wp_link_pages(array('before' => '<div class="page-links">' . 'Páginas:', 'after' => '</div>')); ?>
    </div>

    <footer class="entry-meta">
		<?php
		$categoryList = get_the_category_list(', ');

		$tagList = get_the_tag_list('', ', ');

		if (!eticagnu_main_categorized_blog()) :
			if ('' != $tagList)
				$metaText = 'Temas: %2$s. <a href="%3$s" title="Enlace a %4$s" rel="bookmark">Enlace</a>. ';
			else
				$metaText = '<a href="%3$s" title="Enlace a %4$s" rel="bookmark">Enlace</a>.';
		else :
			if ('' != $tagList)
				$metaText = '%1$s | Temas: %2$s. <a href="%3$s" title="Enlace a %4$s" rel="bookmark">Enlace</a>. ';
			else
				$metaText = '%1$s. <a href="%3$s" title="Enlace a %4$s" rel="bookmark">Enlace</a>. ';
		endif;

		printf(
				$metaText, $categoryList, $tagList, get_permalink(), the_title_attribute('echo=0')
		);

		edit_post_link('Editar', '<span class="edit-link">', '</span>');
		?>
    </footer>
</article>
