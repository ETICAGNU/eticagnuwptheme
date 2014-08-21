<?php get_header() ?>

<div id="primary" class="content-area col-xs-12">
	<div id="content" class="site-content col-xs-12" role="main">

		<article id="post-0" class="post error404 not-found">
			<header class="entry-header">
				<h1 class="entry-title">La página no fue encontrada</h1>
			</header>

			<div class="entry-content">
				<p>Parece que no se encontró nada en este lugar. Puedes probar uno de los enlaces de abajo o una búsqueda</p>

				<?php get_search_form(); ?>

				<?php the_widget('WP_Widget_Recent_Posts'); ?>

				<div class="widget">
					<h2 class="widgettitle">Categorías más usadas</h2>
					<ul>
						<?php
						wp_list_categories(array(
							'orderby' => 'count',
							'order' => 'DESC',
							'show_count' => 1,
							'title_li' => '',
							'number' => 10));
						?>
					</ul>
				</div>

				<?php
				$archive_content = '<p>' . sprintf('Trata de buscar en los archivos mensuales. %1$s', convert_smilies(':)')) . '</p>';

				the_widget('WP_Widget_Archives', 'dropdown=1', "after_title=</h2>$archive_content");
				?>
			</div>
		</article>

	</div>
</div>

<?php get_footer(); ?>