<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package ProCoders_Test
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">
	<script> 
		var base_url = '<?php echo home_url(); ?>',
		ajax_url = '<?php echo admin_url( 'admin-ajax.php' ); ?>';
	</script>
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<div class="preloader-page"></div>
<div id="page" class="site">
	<a class="skip-link screen-reader-text" href="#primary"><?php esc_html_e( 'Skip to content', 'procoders-test' ); ?></a>

	<header id="masthead" class="site-header">
		<div class="container">
			<div class="container-item-wrapper">
				<div class="site-branding">
					<?php
					if (get_field('header_logo', 'options')):?>
						
						<a href="<?php echo esc_url( home_url( '/' ) ); ?>">
							<img src="<?php echo get_field('header_logo', 'options'); ?>" alt="logo">
						</a>
						
					<?php endif; ?>
				</div><!-- .site-branding -->
				<?php
				if (have_rows('navigation' , 'options')): ?>
				<nav id="site-navigation" class="main-navigation">
					<button class="menu-toggle hamburger-menu" aria-controls="primary-menu" aria-expanded="false">
						<span class="menu-bar1"></span>
						<span class="menu-bar2"></span>
						<span class="menu-bar3"></span>
					</button>
					<ul class="navbar-main" id="primary-menu">
						
					<?php 
					while (have_rows('navigation', 'options')): the_row(); 
						$menu_item = get_sub_field('menu_item');
						$class_name = get_sub_field('class_name');
						$has_submenu = get_sub_field('has_submenu');
					?>
						<li class="nav-item <?php echo($has_submenu ? ' has-submenu ': ' '); echo $class_name; ?>">
							<div class="nav-link-wrapper">
								<a class="nav-link"
					        	target="<?= $menu_item['target'] === '_blank' ? '_blank' : '_self'; ?>" 
					        	href="<?= $menu_item['url'] ?>"><?= $menu_item['title'] ?></a>
					        </div>
					        <?php if ($has_submenu): ?>
					        	<?php 
				        		//open group item
				        		if (have_rows('sub_menu')): ?>
				        			<div class="submenu-container">
				        				<div class="submenu-grid">
						        			<?php while(have_rows('sub_menu')): the_row(); 
						        				$sub_menu_label = get_sub_field('sub_menu_label');
						        				$submenu_icon = get_sub_field('submenu_icon');
						        				$class_name = get_sub_field('class_name');
						        			?>
						        			<div class="submenu-item <?php echo $class_name; ?>">
						        				<div class="submenu-item-header">
						        					<?php if ($submenu_icon): ?>
						        						<img src="<?php echo $submenu_icon; ?>" alt="">
						        					<?php endif ?>
						        					<?php if ($sub_menu_label): ?>
						        					<h4 class="title"><?php echo $sub_menu_label; ?></h4>
						        					<?php endif ?>
						        				</div>

						        				<?php if (have_rows('sub_menu_items')): ?>
						        					<ul class="navbar-submenu">
						        						<?php while(have_rows('sub_menu_items')): the_row();
						        						 	$submenu_item = get_sub_field('item');
						        						 	$description = get_sub_field('description');
						        						?>
						        						<li>
						        							<a class="nav-link"
												        	target="<?= $submenu_item['target'] === '_blank' ? '_blank' : '_self'; ?>" 
												        	href="<?= $submenu_item['url'] ?>"><?= $submenu_item['title'] ?></a>
												        	<?php if ($description): ?>
												        		<p><?php echo $description; ?></p>
												        	<?php endif ?>
						        						</li>
						        						<?php endwhile; ?>
						        					</ul>
						        				<?php endif ?>
						        			</div>
						        			<?php endwhile; ?>
						        		</div>
						        		<div class="submenu-bottom-content">
						        			<div class="left-side">
						        				<h4 class="title">Ready to get started?</h4>
						        				<p class="description">See how our application works, how easy it is</p>
						        			</div>
						        			<div class="right-side">
						        				<a href="#/" class="cta-subemnu">Watch demo</a>
						        			</div>
						        		</div>
				        			</div>
					        	<?php endif; ?>
					        <?php endif; ?>
						</li>
					<?php endwhile; ?>
					</ul>
					<div class="triangle triangle-position-js"></div>
				</nav><!-- #site-navigation -->
				<?php endif; ?>
			</div>
		</div>
	</header><!-- #masthead -->
