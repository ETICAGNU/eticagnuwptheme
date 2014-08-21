<?php get_header() ?>

<div id="primary" class="content-area image-attachment col-md-12 col-xs-12">
	<div id="content" class="site-content col-xs-12" role="main">

		<?php while (have_posts()) : the_post() ?>

			<article id="post-<?php the_ID() ?>" <?php post_class() ?>>
				<header class="entry-header">
					<h1 class="entry-title"><?php the_title() ?></h1>

					<div class="entry-meta">
						<?php
						$metadata = wp_get_attachment_metadata();
						printf('Publicado el <span class="entry-date"><time class="entry-date" datetime="%1$s" pubdate>%2$s</time></span> a <a href="%3$s" title="Enlace a la imagen en tamaño completo">%4$s &times; %5$s</a> en <a href="%6$s" title="Volver a %7$s" rel="gallery">%7$s</a>', esc_attr(get_the_date('c')), esc_html(get_the_date()), wp_get_attachment_url(), $metadata['width'], $metadata['height'], get_permalink($post->post_parent), get_the_title($post->post_parent));
						?>
						<?php edit_post_link('Editar', '<span class="sep"> | </span> <span class="edit-link">', '</span>'); ?>
					</div>

					<nav id="image-navigation" class="site-navigation">
						<span class="previous-image"><?php previous_image_link(false, '&larr; Anterior'); ?></span>
						<span class="next-image"><?php next_image_link(false, 'Siguiente &rarr;'); ?></span>
					</nav>
				</header>

				<div class="entry-content">

					<div class="entry-attachment">
						<div class="attachment">
							<?php
							$attachments = array_values(get_children(array(
								'post_parent' => $post->post_parent,
								'post_status' => 'inherit',
								'post_type' => 'attachment',
								'post_mime_type' => 'image',
								'order' => 'ASC',
								'orderby' => 'menu_order ID')));

							foreach ($attachments as $k => $attachment) {
								if ($attachment->ID == $post->ID)
									break;
							}

							$k++;

							if (count($attachments) > 1) {
								if (isset($attachments[$k]))
									$next_attachment_url = get_attachment_link($attachments[$k]->ID);
								else
									$next_attachment_url = get_attachment_link($attachments[0]->ID);
							} else
								$next_attachment_url = wp_get_attachment_url()
								?>

							<a href="<?php echo $next_attachment_url ?>" title="<?php echo esc_attr(get_the_title()) ?>" rel="attachment"><?php
								$attachment_size = apply_filters('eticagnu_main_attachment_size', array(1200, 1200));

								echo wp_get_attachment_image($post->ID, $attachment_size)
								?></a>
						</div>

						<?php if (!empty($post->post_excerpt)) : ?>
							<div class="entry-caption">
								<?php the_excerpt(); ?>
							</div>
						<?php endif ?>
					</div>

					<?php the_content(); ?>
					<?php
					wp_link_pages(array(
						'before' => '<div class="page-links">' . 'Páginas:',
						'after' => '</div>'))
					?>
				</div>

				<footer class="entry-meta">
					<?php if (comments_open() && pings_open()) : ?>
						<?php printf('<a class="comment-link" href="#respond" title="Enviar un comentario">Enviar un comentario</a> o dejar un trackback: <a class="trackback-link" href="%s" title="Trackback para tu entrada" rel="trackback">Trackback</a>.', get_trackback_url()); ?>
					<?php elseif (!comments_open() && pings_open()) : ?>
						<?php printf('Los comentarios están cerrados, pero puedes dejar un trackback: <a class="trackback-link" href="%s" title="Trackback para tu entrada" rel="trackback">Trackback URL</a>.', get_trackback_url()); ?>
					<?php elseif (comments_open() && !pings_open()) : ?>
						<?php echo 'Los trackbacks están cerrados, pero puedes <a class="comment-link" href="#respond" title="Enviar un comentario">enviar un comentario</a>.'; ?>
					<?php elseif (!comments_open() && !pings_open()) : ?>
						<?php echo 'Los comentarios y trackbacks están cerrados' ?>
					<?php endif; ?>

					<?php edit_post_link('Editar', ' <span class="edit-link">', '</span>'); ?>
				</footer>
			</article>

			<?php comments_template(); ?>

		<?php endwhile ?>

	</div>
</div>

<?php get_footer(); ?>