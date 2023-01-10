<?php
function post_load_more(){
	// Default value options
	$post_type = 'post';
	$post_per_page = '6';
	$pageNumber = "1";
	$orderby  = 'date';
	$meta_key = '';
	$order    = 'DESC';

	if ($_POST['post_type']) {
		$post_type    = $_POST['post_type'];
	}

	if ($_POST['post_per_page']) {
		$post_per_page    = $_POST['post_per_page'];
	}

	if ($_POST['pageNumber']) {
		$pageNumber = $_POST['pageNumber'];
	}


	$args = array(
		'post_type'      => $post_type, 
	 	'stock'          => 1, 
	 	'posts_per_page' => $post_per_page, 
	 	'paged'          => $pageNumber,
		'post_status'    => 'publish',
	 	'orderby'  		 => $orderby,
	    'order'    		 => $order,
	);

	if ($_POST['term_name'] && $_POST['cat_id']) {
		$term_name    = $_POST['term_name'];
		$cat_id    = $_POST['cat_id'];

		$args["tax_query"] = array (
								array (
					            	'taxonomy' => $term_name,
					            	'field' => 'term_id',
						            'terms' => $cat_id
						        )

							);
	};

	

	$the_query = new WP_Query($args);

	global $wp_query;

	$results = array();
	$query_results = array();

	if(	$the_query->have_posts() ):
		$i = 0;
		while( $the_query->have_posts() ):
			$the_query->the_post();

			if (get_field('services_card_icon')['white_image']) {
				$query_results[$i]['icon_white'] = get_field('services_card_icon')['white_image']['url'];
			}else{
				$query_results[$i]['icon_white'] = get_template_directory_uri(). '/assets/img/problem-solving.png';
			}

			if (get_field('services_card_icon')['image_coloriez']['url']) {
				$query_results[$i]['icon_color'] = get_field('services_card_icon')['image_coloriez']['url'];
			}else{
				$query_results[$i]['icon_color'] = get_template_directory_uri() . '/assets/img/problem-solving_color.png';

			}

			$query_results[$i]['title'] = get_the_title();
			$query_results[$i]['permalink'] = get_the_permalink();
			$i++;
		endwhile;
		wp_reset_postdata();
	endif;
	$results['query_results'] = $query_results;
	$results['total_results'] = $the_query->found_posts;
	$results['current_term_id'] = $cat_id;
	$results['current_page_number'] = $pageNumber;

	
	echo json_encode( array('status' => 200, 'data' => $results ) );

	die();
}
 
 
add_action('wp_ajax_post_load_more', 'post_load_more'); 
add_action('wp_ajax_nopriv_post_load_more', 'post_load_more');