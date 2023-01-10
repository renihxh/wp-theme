<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package ProCoders_Test
 */

$footer_field = get_field('footer_widget_1', 'options');
?>
	<footer id="colophon" class="site-footer">
		<div class="container">
			<div class="row">	
				<div class="col-12 widget-wrapper">
					<?php if ($footer_field['footer_logo']):
					 ?>
						<div class="footer-logo">
							<a href="<?php echo get_home_url(); ?>"><img src="<?php echo $footer_field['footer_logo']['url']; ?>" alt="<?php echo $footer_field['footer_logo']['alt']; ?>"></a>
						</div>
					<?php endif ?>
					<?php if ($footer_field['copyright_text']): ?>
						<div class="copyright-text">
							<?php echo $footer_field['copyright_text']; ?>
						</div>
					<?php endif ?>
					<?php if ($footer_field['bottom_content']): ?>
						<div class="bottom-text">
							<?php echo $footer_field['bottom_content']; ?>
						</div>
					<?php endif ?>
				</div>
			</div>
		</div>
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
