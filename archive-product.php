<?php
/**
 * Product Archive (Shop)
 */

defined( 'ABSPATH' ) || exit;

get_header();
ufobufo_body_header();
?>

<div class="block">
    <div class="block__inner">
        <div class="detail__Inner woocommerce woocommerce-archive-product">
            <?php woocommerce_content(); ?>
        </div>
    </div>
</div>

<?php get_footer();
