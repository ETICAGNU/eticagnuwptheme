<?php
if (!isset($content_width))
	$content_width = 654;

if (!function_exists('eticagnu_main_setup')):

	function eticagnu_main_setup() {
		add_theme_support('automatic-feed-links');

		add_theme_support('post-formats', array('aside'));

		register_nav_menus(array(
			'general-menu' => 'Menú general',
			'main-menu' => 'Menú principal'
		));


		add_theme_support('custom-header', array(
			'width' => 70,
			'height' => 70,
			'default-text-color' => '000',
			'flex-width' => true,
			'header-text' => true,
			'default-image' => get_template_directory_uri() . '/images/header.jpg',
			'uploads' => true,
		));

		add_theme_support('post-thumbnails');
	}

endif;

add_action('after_setup_theme', 'eticagnu_main_setup');

function eticagnu_main_scripts() {
	wp_enqueue_style('style', get_stylesheet_uri());

	if (is_singular() && comments_open() && get_option('thread_comments')) {
		wp_enqueue_script('comment-reply');
	}

	wp_enqueue_script('navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20140512', true);

	if (is_singular() && wp_attachment_is_image())
		wp_enqueue_script('keyboard-image-navigation', get_template_directory_uri() . '/js/keyboard-image-navigation.js', array('jquery'), '20140512');
}

add_action('wp_enqueue_scripts', 'eticagnu_main_scripts');

if (!function_exists('eticagnu_main_posted_on')) :

	function eticagnu_main_posted_on() {
		printf(
				'Publicado el '
				. '<a href="%1$s" title="%2$s" rel="bookmark"><time class="entry-date" datetime="%3$s" pubdate>%4$s</time></a>'
				. '<span class="byline"> por <span class="author vcard">'
				. '<a class="url fn n" href="%5$s" title="%6$s" rel="author">%7$s</a>'
				. '</span></span>', esc_url(get_permalink()), esc_attr(get_the_time()), esc_attr(get_the_date('c')), esc_html(get_the_date()), esc_url(get_author_posts_url(get_the_author_meta('ID'))), esc_attr(sprintf('Ver todas las entradas de %s', get_the_author())), esc_html(get_the_author())
		);
	}

endif;

function eticagnu_main_categorized_blog() {
	if (false === ( $allTheCoolCats = get_transient('all_the_cool_cats') )) {
		$allTheCoolCats = get_categories(array(
			'hide_empty' => 1,
		));

		$allTheCoolCats = count($allTheCoolCats);

		set_transient('allTheCoolCats', $allTheCoolCats);
	}

	if ('1' != $allTheCoolCats)
		return true;
	else
		return false;
}

function eticagnu_main_category_transient_flusher() {
	// Like, beat it. Dig?
	delete_transient('allTheCoolCats');
}

add_action('edit_category', 'eticagnu_main_category_transient_flusher');
add_action('save_post', 'eticagnu_main_category_transient_flusher');

if (!function_exists('eticagnu_main_content_nav')) {

	function eticagnu_main_content_nav($nav_id) {
		global $wp_query, $post;

		if (is_single()) {
			$previous = ( is_attachment() ) ? get_post($post->post_parent) : get_adjacent_post(false, '', true);
			$next = get_adjacent_post(false, '', false);

			if (!$next && !$previous)
				return;
		}

		if ($wp_query->max_num_pages < 2 && ( is_home() || is_archive() || is_search() ))
			return;

		$navClass = 'site-navigation paging-navigation';

		if (is_single())
			$navClass = 'site-navigation post-navigation';
		?>
		<nav id="<?php echo $nav_id; ?>" class="<?php echo $navClass; ?>" role="navigation">
			<?php if (is_single()) : ?>

				<?php previous_post_link('<div class="nav-previous"><span class="meta-nav-msg">Entrada anterior</span> %link</div>', '%title'); ?>
				<?php next_post_link('<div class="nav-next"><span class="meta-nav-msg">Entrada siguiente</span> %link</div>', '%title'); ?>

			<?php elseif ($wp_query->max_num_pages > 1 && ( is_home() || is_archive() || is_search() )) : ?>

				<?php if (get_next_posts_link()) : ?>
					<div class="nav-previous">
						<?php next_posts_link('<span class="meta-nav">&larr;</span> Entradas anteriores'); ?>
					</div>
				<?php endif; ?>

				<?php if (get_previous_posts_link()) : ?>
					<div class="nav-next"><?php previous_posts_link('Entradas recientes <span class="meta-nav">&rarr;</span>'); ?></div>
				<?php endif; ?>

			<?php endif; ?>
		</nav>
		<?php
	}

}

if (!function_exists('eticagnu_main_comment')) :

	function eticagnu_main_comment($comment, $args, $depth) {
		$GLOBALS['comment'] = $comment;

		switch ($comment->comment_type) :
			case 'pingback' :
			case 'trackback' :
				?>
				<li class="post pingback">
					<p>Pingback <?php comment_author_link(); ?><?php edit_comment_link('(Editar)', ' ') ?></p>
					<?php
					break;
				default :
					?>
				<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
					<article id="comment-<?php comment_ID(); ?>" class="comment">
						<footer>
							<div class="comment-author vcard">
								<?php echo get_avatar($comment, 60); ?>
								<?php printf('<cite class="fn">%s</cite>', get_comment_author_link()); ?>
							</div>
							<?php if ($comment->comment_approved == '0') : ?>
								<p><em>Tu comentario está esperando moderación.</em></p>
							<?php endif; ?>

							<div class="comment-meta commentmetadata">
								<a href="<?php echo esc_url(get_comment_link($comment->comment_ID)); ?>">
									<time pubdate datetime="<?php comment_time('c'); ?>">
										<?php printf('%1$s a las %2$s', get_comment_date(), get_comment_time()) ?>
									</time>
								</a>
								<?php edit_comment_link('(Editar)', ' ') ?>
							</div>

							<div class="reply">
								<?php
								comment_reply_link(array_merge($args, array(
									'depth' => $depth,
									'max_depth' => $args['max_depth']
								)));
								?>
							</div>
						</footer>

						<div class="comment-content"><?php comment_text(); ?></div>
					</article>
					<?php
					break;
			endswitch;
		}

	endif;

	function eticagnu_main_widgets_init() {
		register_sidebar(array(
			'name' => 'Primera área de sidebar',
			'id' => 'sidebar-1',
			'before_widget' => '<aside id="%1$s" class="widget col-xs-12 %2$s">',
			'after_widget' => '</aside>',
			'before_title' => '<h1 class="widget-title">',
			'after_title' => '</h1>',
		));

		register_sidebar(array(
			'name' => 'Segunda área de sidebar',
			'id' => 'sidebar-2',
			'before_widget' => '<aside id="%1$s" class="widget col-xs-12 %2$s">',
			'after_widget' => '</aside>',
			'before_title' => '<h1 class="widget-title">',
			'after_title' => '</h1>',
		));

		register_sidebar(array(
			'name' => 'Primera área de footer',
			'id' => 'footer-1',
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget' => '</aside>',
			'before_title' => '<h1 class="widget-title">',
			'after_title' => '</h1>',
		));

		register_sidebar(array(
			'name' => 'Segunda área de footer',
			'id' => 'footer-2',
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget' => '</aside>',
			'before_title' => '<h1 class="widget-title">',
			'after_title' => '</h1>',
		));

		register_sidebar(array(
			'name' => 'Tercera área de footer',
			'id' => 'footer-3',
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget' => '</aside>',
			'before_title' => '<h1 class="widget-title">',
			'after_title' => '</h1>',
		));

		register_sidebar(array(
			'name' => 'Cuarta área de footer',
			'id' => 'footer-4',
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget' => '</aside>',
			'before_title' => '<h1 class="widget-title">',
			'after_title' => '</h1>',
		));
	}

	add_action('widgets_init', 'eticagnu_main_widgets_init');

	function projects_post_type() {
		$labels = array(
			'name' => _x("Proyectos", "Proyectos"),
			'singular_name' => _x("Proyecto", "Proyecto"),
			'menu_name' => 'Proyectos',
			'add_new' => _x("Agregar nuevo", "proyecto"),
			'add_new_item' => __("Agregar nuevo proyecto"),
			'edit_item' => __("Editar proyecto"),
			'new_item' => __("Nuevo proyecto"),
			'view_item' => __("Ver proyecto"),
			'search_items' => __("Buscar proyecto"),
			'not_found' => __("Proyecto no encontrado"),
			'not_found_in_trash' => __("Proyectos en la papelera"),
			'parent_item_colon' => ''
		);

		// Register post type
		register_post_type('project', array(
			'labels' => $labels,
			'public' => true,
			'has_archive' => false,
			'menu_icon' => 'dashicons-welcome-widgets-menus',
			'rewrite' => false,
			'supports' => array('title', 'editor', 'thumbnail')
		));
	}

	add_action('init', 'projects_post_type', 0);
	