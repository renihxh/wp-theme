<?php
$post_source = get_field('select_post_type');
if ($post_source == 'post') {
	$term_name = "category";
}else if($post_source == 'services_post'){
	$term_name = "service-category";
}else{
	$term_name = '';
}
?>
<section class="section-space section-grid-posts <?= ($block['className'] == 1 ? '' : $block['className']); ?>" id="<?= $block['id']; ?>">
	<div class="container">
		<?php if (get_field('section_title')): ?>
		<div class="header text-center color-dark">
			<h3 class="title-lg"><?php the_field('section_title'); ?></h3>
		</div>
		<?php endif ?>
		<div class="posts-cards">
			<?php if ($term_name != ''): 
				$i = 0;
				$terms = get_terms([
				    'taxonomy' => $term_name,
				    'hide_empty' => true,
				]);

				echo '<ul class="filter-tabs filter-tabs-js">';
				foreach ($terms as $term){
					echo '<li class="filter-tabs--switch ' . ($i == 0 ? 'active' : '') .'" data-target="'.$term->term_id.'" data-total_posts="'. $term->count .'">'.$term->name.'</li>';
					$i++;
				}
				echo '</ul>'
				?>
			<?php endif ?>

			<div class="cards-wrapper">
					<?php 

					foreach ($terms as $term){
						echo '<div class="cards-grid cat-handler-js grid-sm-2 grid-md-3" id="posts_results_'.$term->term_id.'" data-name="'.$term->name.'" data-page_number="1"></div>';
					}
					
					?>

			</div>
			<div class="button-wrapper text-center">
				<div class="ajax-data" 
				data-post_name="<?= $post_source; ?>" 
				data-term_name="<?= $term_name ?>"
				data-post_page="6" 
				></div>
				<button class="btn btn-red btn-load-more btn-load-more-js">Load more...</button>
			</div>
		</div>
		
	</div>
</section>


<?php

if (wp_script_is('ajax_load_more2-js', 'registered')) {
	return;
}else{
	wp_enqueue_script( 'ajax_load_more2-js', get_template_directory_uri() . '/js/ajax_load_more.js', array(), _S_VERSION, true );
}