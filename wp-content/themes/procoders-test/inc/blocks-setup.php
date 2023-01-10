<?php

// Update CSS within in Admin
function admin_style() {
  wp_enqueue_style('admin-styles', get_template_directory_uri() . '/assets/admin/admin.css');
}
add_action('admin_enqueue_scripts', 'admin_style');

function filter_block_categories_when_post_provided( $block_categories, $editor_context ) {
    if ( ! empty( $editor_context->post ) ) {
        array_push(
            $block_categories,
            array(
                'slug'  => 'section-category',
                'title' => __( 'Procoders Block', 'custom-plugin' ),
                'icon'  => null,
            )
        );
    }
    return $block_categories;
}
 
add_filter( 'block_categories_all', 'filter_block_categories_when_post_provided', 10, 2 );

function my_acf_init() {

    $blocksArray = array(
        'section' => array(
            'Section Home Hero',
            'Section Review Slider',
            'Section Grid Posts',
            'Section Register'
        )
    );
    // check function exists
    if( function_exists('acf_register_block') ) {
    
        foreach($blocksArray as $key => $value){
            $type = $key;
            foreach($value as $item){
              $str_title = sanitize_file_name(strtolower($item));

              acf_register_block(
                array(
                  'name' => sanitize_file_name(strtolower($item)),
                  'title' => $item,
                  'description' => $item,
                  'render_callback' => 'my_acf_block_render_callback',
                  'category' => $type.'-category',
                  'icon' => 'theme-icon',
                  'keywords' => array('builder', 'renato'),
                  'anchor' => true,
                  'reusable' => false,
                  'multiple' => false,
                  'inserter' => true,
                  'html' => false,
                  'className' => true,
                  'customClassName' => true,
                  'mode' => 'edit',
                  'supports' => array('mode' => false),
                  'example'         => array(
                        'attributes' => array(
                            'mode' => 'preview',
                            'data' => array(
                                'my_field' => 'Sample value',
                            ),
                        ),
                    ),
                )
              );
            }
        }
    }
}
add_action('acf/init', 'my_acf_init');

function my_acf_block_render_callback($block, $content = '', $is_preview = false) {
	
	// convert name ("acf/testimonial") into path friendly slug ("testimonial")
	$slug      = str_replace('acf/', '', $block['name']);
    $directory = str_replace('-category', '', $block['category']);
	// include a template part from within the "partials/block" folder
	if(file_exists(STYLESHEETPATH . "/blocks/{$slug}.php")) {
		include(STYLESHEETPATH . "/blocks/{$slug}.php");
  }

}