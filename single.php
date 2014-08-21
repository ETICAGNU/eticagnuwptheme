<?php get_header(); ?>

<div id="primary" class="content-area col-md-9 col-xs-12">
	<div id="content" class="site-content col-xs-12" role="main">

		<?php while (have_posts()) : the_post(); ?>

			<?php get_template_part('content', 'single') ?>

			<?php eticagnu_main_content_nav('nav-below') ?>

			<?php
			if (comments_open() || '0' != get_comments_number())
				comments_template('', true);
			?>

		<?php endwhile ?>

	</div>
</div>

<?php get_sidebar() ?>
<?php get_footer() ?>