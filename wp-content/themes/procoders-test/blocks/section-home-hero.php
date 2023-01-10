<?php
$content = get_field('content');
$image_right = get_field('image_right');
?>
<section class="section-home-hero gradient-bg <?= ($block['className'] == 1 ? '' : $block['className']); ?>" id="<?= $block['id']; ?>">
  <div class="container d-flex">
    <div class="section-content">
      <div class="section-content-header">
        <?php if ($content['main_title']) {
          echo '<h2 class="title title-lg color-white">'.$content['main_title'].'</h2>';
        } ?>
        <?php if ($content['subtitle']) {
          echo '<p class="sub-title color-white">'.$content['subtitle'].'</p>';
          // code...
        } ?>
      </div>
      <?php if ($content['add_shortcode']): ?>
        <div class="cf7-form-wrapper">
          <?php echo do_shortcode($content['add_shortcode']); ?>
        </div>
      <?php endif ?>
    </div>
  </div>
  <div class="section-media">
    <img src="<?php  echo $image_right['url']; ?>" alt="<?php  echo $image_right['alt']; ?>">
  </div>
</section>