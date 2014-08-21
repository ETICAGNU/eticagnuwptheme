<?php get_header() ?>

<div id="primary" class="content-area col-md-9 col-xs-12">
	<div id="content" class="site-content col-xs-12">
		<?php if (have_posts()) : ?>

			<?php while (have_posts()) : the_post() ?>

				<?php get_template_part('content', get_post_format()) ?>

			<?php endwhile; ?>

			<?php eticagnu_main_content_nav('nav-below'); ?>

		<?php else: ?>

			<?php get_template_part('no-results', 'index'); ?>

		<?php endif ?>
	</div>
</div>

<?php get_sidebar(); ?>

<?php get_footer(); ?>