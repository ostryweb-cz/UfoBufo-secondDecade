<?php
/**
 * WooCommerce Template
 *
 * This file is used by WooCommerce as the main wrapper template when present.
 */

defined( 'ABSPATH' ) || exit;

get_header();
ufobufo_body_header();
?>

<div class="block">
    <div class="block__inner">
        <div class="detail__Inner woocommerce">
            <?php woocommerce_content(); ?>
        </div>
    </div>
</div>

<?php get_footer();
