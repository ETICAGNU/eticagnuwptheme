<?php get_header() ?>

<section id="primary" class="content-area col-md-9 col-xs-12">
	<div id="content" class="site-content col-xs-12" role="main">
		<?php if (have_posts()) : ?>

			<header class="entry-header">
				<h1 class="entry-title"><?php printf('Resultados de la búsqueda para: %s', '<span>' . get_search_query() . '</span>'); ?></h1>
			</header>

			<?php eticagnu_main_content_nav('nav-above'); ?>

			<?php while (have_posts()) : the_post(); ?>

				<?php get_template_part('content', 'search'); ?>

			<?php endwhile; ?>

			<?php eticagnu_main_content_nav('nav-below'); ?>

		<?php else : ?>

			<?php get_template_part('no-results', 'search'); ?>

		<?php endif; ?>

	</div>
</section>

<?php get_sidebar(); ?>

<?php get_footer(); ?>