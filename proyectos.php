<?php
/*
  Template Name: Proyectos
 */

get_header();

the_post();
?>
<div id="primary" class="content-area col-md-9 col-xs-12">
	<div id="content" class="site-content col-xs-12">
		<article id="post-<?php the_ID() ?>" <?php post_class() ?>>
			<header class="entry-header">
				<h1 class="entry-title"><?php the_title() ?></h1>
			</header>

			<div class="entry-content">
				<?php the_content() ?>

				<?php edit_post_link('Editar', '<span class="edit-link">', '</span>') ?>

				<?php $team_posts = get_posts(array( 'post_type' => 'project', 'posts_per_page' => -1, 'orderby' => 'title', 'order' => 'ASC')) ?>

				<div class="row projects">
					<?php foreach ($team_posts as $post): ?>
						<?php setup_postdata($post); ?>

						<div class="col-sm-6 project">
							<?php if (has_post_thumbnail()) : ?>
								<?php the_post_thumbnail('full') ?>
							<?php endif ?>

							<h3 class="project-title"><?php the_title() ?></h3>

							<p>
								<a rel="follow" href="http://<?php the_field('sitio_web') ?>.eticagnu.org/">http://<?php the_field('sitio_web') ?>.eticagnu.org/</a>
							</p>

							<div class="project-content">
								<?php the_content(); ?>
							</div>
						</div>

					<?php endforeach ?>
				</div>
			</div>
		</article>
	</div>
</div>
<?php
get_sidebar();

get_footer();
