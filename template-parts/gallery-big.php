<?php if (have_rows('images')): ?>
    <div class="columns">
        <?php while (have_rows('images')): the_row(); ?>
            <a class="galleryItem" href="#" data-imageidx="<?php echo get_row_index() ?>">

                <?php
                // first, get the image object returned by ACF
                $image_object = get_sub_field('img');
                $image_id = $image_object['ID'];
                $image_caption = $image_object['caption'];
                ?>

                <?php
                // Let WordPress render responsive thumbnail markup (srcset + loading=lazy)
                echo wp_get_attachment_image(
                    $image_id,
                    'medium',
                    false,
                    array(
                        'class' => 'open--gallery',
                        'loading' => 'lazy',
                        'decoding' => 'async',
                    )
                );
                ?>
                <p><?php echo $image_caption ?></p>

            </a>
            <?php ?>
        <?php endwhile; ?>
    </div>
<?php endif; ?>