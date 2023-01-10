<section class="section-space section-review-slider <?= ($block['className'] == 1 ? '' : $block['className']); ?>" id="<?= $block['id']; ?>">
	<?php if (have_rows('review_slider')): ?>

		<!-- Slider main container -->
		<div class="container">
			
			<div class="swiper swiper-review-init">
			  <!-- Additional required wrapper -->
			  <div class="swiper-wrapper">
			    <?php while (have_rows('review_slider')): the_row(); 
			    	$image = get_sub_field('slide_image')
			    ?>
			    <div class="swiper-slide">
			    	<div class="swiper-slide-item">
				    	<img class="swiper-slide-img" src="<?php echo $image['url'] ?>" alt="<?php echo $image['alt'] ?>">
				    </div>
			    </div>
			    <?php endwhile; ?>
			  </div>


			</div>
		  <!-- If we need navigation buttons -->
		  <div class="swiper-button-prev"></div>
		  <div class="swiper-button-next"></div>
		</div>
	<?php endif ?>
</section>