<?php
add_action( 'init', 'services_post' );
/**
 * Register a book post type.
 *
 * @link http://codex.wordpress.org/Function_Reference/register_post_type
 */
if( ! function_exists( 'services_post' ) ) :
	function services_post() {
		$labels = array(
			'name' => 'Services',
			'singular_name' => 'Service',
			'add_new' => 'Add Service',
			'all_items' => 'All Services',
			'add_new_item' => 'Add Service',
			'edit_item' => 'Edit Service',
			'new_item' => 'New Service',
			'view_item' => 'View Service',
			'search_items' => 'Search Services',
			'not_found' => 'No Services found',
			'not_found_in_trash' => 'No Services found in trash',
			'parent_item_colon' => 'Parent Services'
			//'menu_name' => default to 'name'
		);
		$args = array(
			'labels' => $labels,
			'public' => true,
			'has_archive' => false,
			'publicly_queryable' => true,
			'query_var' => true,
			'rewrite' => array(
                'slug' => 'servizi'
            ),
			'capability_type' => 'post',
			'hierarchical' => false,
			'show_in_rest' => true,
			'supports' => array(
				'title',
				'editor',
				'excerpt',
				'thumbnail',
				// 'comments',
				'revisions',
			),
			'taxonomies' => array( 'service-category'), // add default post categories and tags
			'menu_position' => 5,
			'menu_icon'          => 'dashicons-analytics',
			'exclude_from_search' => false,
		);
		register_post_type( 'services_post', $args );
		// flush_rewrite_rules();


		register_taxonomy( 'service-category', // register custom taxonomy - category
			'services_post',
			array(
				'hierarchical' => true,
				'show_admin_column' => true,
				'show_in_rest' => true,
				'labels' => array(
					'name' => 'Services Categories',
					'singular_name' => 'Services Category',
					'show_admin_column' => true,
				)
			)
		);
	}
endif;