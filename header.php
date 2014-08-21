<!DOCTYPE html>
<html lang="<?php echo get_bloginfo('language') ?>">
    <head>
		<link rel="shortcut icon" href="<?php bloginfo('template_directory') ?>/favicon.ico" />
        <meta charset="<?php bloginfo('charset') ?>">
        <meta name="viewport" content="width=device-width; user-scalable=no">
        <title><?php
			global $page, $paged;

			wp_title('|', true, 'right');

			bloginfo('name');

			$site_description = get_bloginfo('description', 'display');

			if ($site_description && ( is_home() || is_front_page() ))
				echo " | $site_description";

			if ($paged >= 2 || $page >= 2)
				echo ' | ' . sprintf('Página %s', max($paged, $page));
			?></title>
        <link rel="profile" href="http://gmpg.org/xfn/11" />
        <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
		<link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,700,400italic,700italic,300italic" rel="stylesheet" type="text/css">
        <link href="<?php bloginfo('template_directory') ?>/bootstrap/css/bootstrap.css" rel="stylesheet">
        <link href="<?php bloginfo('template_directory') ?>/font-awesome/css/font-awesome.min.css" rel="stylesheet">
		<script src="//code.jquery.com/jquery-1.11.0.min.js"></script>
		<?php wp_head(); ?>
    </head>
    <body <?php body_class(); ?>>
		<div id="network-navigation">
			<div class="container">
				<a href="<?php echo home_url('/'); ?>"><img src="<?php bloginfo('template_directory') ?>/ETICAGNU.png"></a>
				<?php
				wp_nav_menu(array(
					'depth' => 1,
					'theme_location' => 'general-menu',
					'container' => 'nav',
					'container_class' => '',
				))
				?>
			</div>
		</div>
        <div id="page" class="hfeed site">
            <header id="masthead" class="site-header" role="banner">
                <hgroup class="container">
					<a href="<?php echo home_url('/'); ?>" title="<?php echo esc_attr(get_bloginfo('name', 'display')); ?>" rel="home">
						<img src="<?php header_image(); ?>" height="<?php echo get_custom_header()->height; ?>" width="<?php echo get_custom_header()->width; ?>" alt="" />
					</a>
					<?php
					if ('blank' == get_header_textcolor() || '' == get_header_textcolor()) {
						$style = ' style="display:none;"';
					} else {
						$style = ' style="color:#' . get_header_textcolor() . ';"';
					}
					?>
					<h1 class="site-title" <?php echo $style ?>><?php bloginfo('name'); ?></h1>
					<h2 class="site-description"><?php bloginfo('description'); ?></h2>
                </hgroup>
                <nav class="site-navigation main-navigation" id="site-navigation" role="navigation">
					<div class="container">
						<button class="menu-toggle">Menú</button>
					</div>
					<?php
					wp_nav_menu(array(
						'theme_location' => 'main-menu',
						'container_class' => 'container',
					))
					?>
                </nav>
            </header>

            <main id="main" class="site-main">
				<div class="container">
					<div class="row">
