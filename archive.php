<?php get_header() ?>

<div id="primary" class="content-area col-md-9 col-xs-12">
	<div id="content" class="site-content col-xs-12" role="main">

		<?php if (have_posts()) : ?>

			<header class="entry-header">
				<h1 class="entry-title">
					<?php
					if (is_category())
						printf('Categoría: %s', '<span>' . single_cat_title('', false) . '</span>');
					elseif (is_tag())
						printf('Tema: %s', '<span>' . single_tag_title('', false) . '</span>');
					elseif (is_author()) {
						the_post();

						printf('Autor: %s', '<span class="vcard"><a class="url fn n" href="' . get_author_posts_url(get_the_author_meta("ID")) . '" title="' . esc_attr(get_the_author()) . '" rel="me">' . get_the_author() . '</a></span>');

						rewind_posts();
					} elseif (is_day())
						printf('Archivo diario: %s', '<span>' . get_the_date() . '</span>');
					elseif (is_month())
						printf('Archivo mensual: %s', '<span>' . get_the_date('F Y') . '</span>');
					elseif (is_year())
						printf('Archivo anual: %s', '<span>' . get_the_date('Y') . '</span>');
					else
						print("Archivo");
					?>
				</h1>
				<?php
				if (is_category()) {
					$category_description = category_description();

					if (!empty($category_description))
						echo apply_filters('category_archive_meta', '<div class="taxonomy-description">' . $category_description . '</div>');
				} elseif (is_tag()) {
					$tag_description = tag_description();

					if (!empty($tag_description))
						echo apply_filters('tag_archive_meta', '<div class="taxonomy-description">' . $tag_description . '</div>');
				}
				?>
			</header>

			<?php while (have_posts()) : the_post() ?>

				<?php get_template_part('content', get_post_format()) ?>

			<?php endwhile ?>

			<?php eticagnu_main_content_nav('nav-below'); ?>

		<?php else : ?>
		
			<?php get_template_part('no-results', 'archive'); ?>

		<?php endif ?>

	</div>
</div>

<?php get_sidebar(); ?>

	<?php get_footer(); ?>