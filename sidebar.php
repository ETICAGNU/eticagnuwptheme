<div id="secondary" class="widget-area col-md-3 col-xs-12" role="complementary">
	<?php do_action('before_sidebar') ?>

	<?php if (!dynamic_sidebar('sidebar-1')) : ?>

		<aside id="search" class="widget widget_search">
			<?php get_search_form(); ?>
		</aside>

		<aside id="archives" class="widget">
			<h1 class="widget-title">Archivos</h1>
			<ul>
				<?php wp_get_archives(array('type' => 'monthly')); ?>
			</ul>
		</aside>

		<aside id="meta" class="widget">
			<h1 class="widget-title">Meta</h1>
			<ul>
				<?php wp_register() ?>
				<li><?php wp_loginout() ?></li>
				<?php wp_meta() ?>
			</ul>
		</aside>

	<?php endif ?>
	
	<?php dynamic_sidebar('sidebar-2') ?>
</div>
