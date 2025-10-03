<div class="listItem <?php echo $size ?>" id="id-<?php echo $postID; ?>">
  <div>
    <h3><?php echo $title ?></h3>
    <p><?php echo $label ?>
    <span><?php if (get_field('artist-coutry')): ?> (<?php echo $country ?>) <?php endif; ?></span></p>
  </div>
  <?php edit_post_link('E'); ?>
</div>