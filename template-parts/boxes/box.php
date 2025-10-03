<?php
$query_to_use = $GLOBALS['box_query'] ?? $wp_query;

if ($query_to_use->have_posts()) :
    while ($query_to_use->have_posts()) : $query_to_use->the_post(); ?>
        <div class="box">
            <a class="Img" href="<?php the_permalink(); ?>">
                <?php the_post_thumbnail('medium', ['loading' => 'lazy']); ?>
            </a>
            <div class="Content">
                <?php if (in_category(pll_get_term(90))) : ///novinky?>
                    <span class="date"><?php echo get_the_date(); ?></span>
                <?php endif; ?>
                <h3>
                    <a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php the_title_attribute(); ?>">
                        <?php the_title(); ?>
                    </a>
                </h3>
                <?php
                if (has_excerpt()) {
                    the_excerpt();
                } else {
                    echo '<p>' . wp_trim_words(get_the_content(), 15, '...') . '</p>';
                }
                include(locate_template('template-parts/boxes/more-button.php'));
                ?>
            </div>
        </div>
    <?php endwhile;
    wp_reset_postdata();
endif;
