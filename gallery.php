<?php /* Template Name: Gallery */ ?>

<?php get_header(); ?>
<?php ufobufo_body_header(); ?>

<div class="block">
    <?php include(locate_template('template-parts/page-title.php')); ?>
  <div class="block__inner">
      <div class="row">
          <?php display_boxes(pll_get_term(237), 20, true); // 20 posts + pagination ?>
      </div>
  </div>

</div>

<?php get_footer(); ?>
