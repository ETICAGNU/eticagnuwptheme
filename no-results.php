<article id="post-0" class="post no-results not-found">
    <header class="entry-header">
        <h1 class="entry-title">Sin resultados</h1>
    </header>

    <div class="entry-content">
		<?php if (is_home() && current_user_can('publish_posts')) : ?>

			<p><?php printf('¿Listo para publicar tu primera entrada? <a href="%1$s">Empieza aquí</a>.', admin_url('post-new.php')); ?></p>

		<?php elseif (is_search()) : ?>

			<p>Lo sentimos, pero no hemos encontrado resultados con los términos buscados. Por favor, intenta nuevamente con diferentes palabras.</p>

			<?php get_search_form(); ?>

		<?php else : ?>

			<p>Parece que no se puede encontrar lo que estás buscando. Quizás te pueda servir realizar un búsqueda.</p>

			<?php get_search_form(); ?>

		<?php endif; ?>
    </div>
</article>
