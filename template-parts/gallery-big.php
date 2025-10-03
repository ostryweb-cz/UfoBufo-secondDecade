<?php if (have_rows('images')): ?>
    <div class="columns">
        <?php while (have_rows('images')): the_row(); ?>
            <a class="galleryItem" href="#" data-imageidx="<?php echo get_row_index() ?>">

                <?php
                // first, get the image object returned by ACF
                $image_object = get_sub_field('img');
                // and the image size you want to return
                $image_size = 'medium_large';
                // now, we'll exctract the image URL from $image_object
                $image_url = $image_object['sizes'][$image_size];
                $image_alt = $image_object['alt'];
                $image_id = $image_object['ID'];

                $image_caption = $image_object['caption'];
                ?>
                <img class="open--gallery" src="<?php echo $image_url ?>" alt="<?php echo $image_alt ?>"/>
                <p><?php echo $image_caption ?></p>

            </a>
            <?php ?>
        <?php endwhile; ?>
    </div>
<?php endif; ?>