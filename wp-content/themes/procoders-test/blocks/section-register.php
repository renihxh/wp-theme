<?php
$left_side  = get_field('left_content');
$right_side = get_field('right_content');
?>
<section class="section-space section-register <?= ($block['className'] == 1 ? '' : $block['className']); ?>" id="<?= $block['id']; ?>">
	<div class="container">
		<div class="row">	
			<div class="col-md-6 d-flex align-middle">
				<div class="left-content-wrapper">
					<?php 
					if ($left_side['copy_content']){
						echo $left_side['copy_content'];
					}
					?>
				</div>
			</div>
			<div class="col-md-6">
				<div class="right-content-wrapper">
					<?php 
					if ($right_side['contact_form']){
						echo '<div class="cf7-form-wrapper">' . do_shortcode('[contact-form-7 id="'.$right_side['contact_form']->ID.'" title="'.$right_side['contact_form']->post_name.'"]') . '</div>';
					}
					?>
				</div>
			</div>
		</div>
	</div>
</section>