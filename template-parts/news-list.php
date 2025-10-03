<div class="block">
    <?php include(locate_template('template-parts/page-title.php')); ?>

    <div class="block__inner">
        <div class="row">
            <?php
            // Display posts in category 90 (News/Novinky)
            display_boxes(pll_get_term(90), 18, true);
            ?>
        </div>
    </div>
</div>
