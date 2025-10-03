    <div class="block__inner" id="bufo">
        <?php $categories1 = get_posts(array(
            'posts_per_page' => -1,
            'post_status' => 'publish',
            'tag' => "main-stage-live-en-2025, main-stage-live-cs-2025",
            //'meta_key'			=> 'artist-main-stage-live-number',
            'orderby'			=> 'title',
            //'orderby'			=> 'meta_value_num',
            //'orderby'			=> 'post__in',
            'order' => 'asc',

        ));

        $categories2 = get_posts(array(
            'posts_per_page' => -1,
            'post_status' => 'publish',
            'tag' => "main-stage-dj-en-2025, main-stage-dj-cs-2025",
            //'meta_key'			=> 'artist-main-stage-dj-number',
            'orderby'			=> 'title',
            'order' => 'asc',
        ));

        echo '<h2 class="ta--center">🐸 ';
        if(pll_current_language() == 'en') {
            echo 'Main BUFO stage';
        } else if(pll_current_language() == 'cs') {
            echo 'Hlavní BUFO stage';
        }
        echo '</h2>';
        $festival_text = ufobufo_get_festival_text('(UFO BUFO Festival 2025)');
        if ( ! empty( $festival_text ) ) {
            echo '<h3 class="ta--center">' . esc_html( $festival_text ) . '</h3>';
        }
        echo '<div class="list-view">';

        echo '<p class="stage-style"><span>';
        echo 'psytrance, hi-tech';
        if( empty($categories1) || empty($categories2)) {
          echo '<br>(lineup coming very soon)';
        }
        echo '</span></p>';

        if(!empty($categories1)){
          echo '<div class="list-view--section">
              <p class="stage-style"><span>LIVE</span></p>';
          foreach ($categories1 as $post) {
            $postID = $post->ID;
            $title = get_the_title($postID);
            $link = get_permalink($postID);
            $name = get_field( 'artist-name', $postID );
            $label = get_field( 'artist-label', $postID );
            $country = get_field( 'artist-coutry', $postID );
            $number = get_field( 'artist-main-stage-live-number', $postID );
            $size = get_field( 'artist-main-stage-live-size', $postID );

            include( locate_template( 'template-parts/stages/stages-parts/listItem.php' ) );
          }
          echo '</div>';
        }


        if(!empty($categories2)){

          echo '<div class="list-view--section">
            <p class="stage-style"><span>DJS</span></p>';

          foreach ($categories2 as $post) {
            $postID = $post->ID;
            $title = get_the_title($postID);
            $link = get_permalink($postID);
            $name = get_field( 'artist-name', $postID );
            $label = get_field( 'artist-label', $postID );
            $country = get_field( 'artist-coutry', $postID );
            $playAt = get_field( 'artist-main-stage-dj-time', $postID );
            $number = get_field( 'artist-main-stage-dj-number', $postID );


            include( locate_template( 'template-parts/stages/stages-parts/listItem.php' ) );
          }
          echo '</div>';
        }
        
        echo '</div>';
      

        echo '<figure class="wp-block-gallery has-nested-images columns-default is-cropped wp-block-gallery-3 is-layout-flex wp-block-gallery-is-layout-flex">
          <figure class="wp-block-image size-large">
            <a href="https://ufobufo.eu/wp-content/uploads/2024/08/2-kopie.jpg"><img loading="lazy" decoding="async" width="2000" height="1333" src="https://ufobufo.eu/wp-content/uploads/2024/08/2-kopie.jpg" alt="" class="wp-image-6421" srcset="https://ufobufo.eu/wp-content/uploads/2024/08/2-kopie.jpg 2000w, https://ufobufo.eu/wp-content/uploads/2024/08/2-kopie-300x200.jpg 300w, https://ufobufo.eu/wp-content/uploads/2024/08/2-kopie-1024x682.jpg 1024w, https://ufobufo.eu/wp-content/uploads/2024/08/2-kopie-768x512.jpg 768w, https://ufobufo.eu/wp-content/uploads/2024/08/2-kopie-1536x1024.jpg 1536w, https://ufobufo.eu/wp-content/uploads/2024/08/2-kopie-600x400.jpg 600w" sizes="auto, (max-width: 2000px) 100vw, 2000px" /></a>
          </figure>
        </figure>';
/*
      ?>

        <div class="lineUp-view main-stage lineUp-view--hidden ">
            <?php

            $categories = get_posts(array(
                'category_name'          => 'program',
                'post_status'            => 'publish',
            ));

            foreach ($categories as $post) {
                $postID = $post->ID;
                $title = get_the_title($postID);
                $link = get_permalink($postID);

                $label = get_field( 'artist-label', $pageID );
                $country = get_field( 'artist-coutry', $pageID );
                $playMainStageLive = get_field( 'artist-main-stage-live-time', $pageID );
                $playMainStageDj = get_field( 'artist-main-stage-dj-time', $pageID );
                ?>


                <?php if ( get_field('artist-main-stage-live-time' ) ): ?>
                    <div class="lineupItem" data-date="<?php echo $playMainStageLive ?>">
                        <?php if ( 'yes' == get_field('artist-page') ): ?>
                            <a href="<?php echo $link ?>" >
                                <h3><?php echo $title ?><span>Live</span></h3>
                                <p><?php echo $playMainStageLive ?></p>
                            </a>
                        <?php else: ?>
                            <div>
                                <h3><?php echo $title ?><span>Live</span></h3>
                                <p><?php echo $playMainStageLive ?></p>
                            </div>
                        <?php endif; ?>

                    </div>
                <?php endif; ?>

                <?php if ( get_field('artist-main-stage-dj-time' ) ): ?>
                    <div class="lineupItem" data-date="<?php echo $playMainStageDj ?>">
                        <?php if ( 'yes' == get_field('artist-page') ): ?>
                            <a href="<?php echo $link ?>" >
                                <h3><?php echo $title ?></h3>
                                <p><?php echo $playMainStageDj ?></p>
                            </a>
                        <?php else: ?>
                            <div>
                                <h3><?php echo $title ?></h3>
                                <p><?php echo $playMainStageDj ?></p>
                            </div>
                        <?php endif; ?>
                    </div>
                <?php endif; ?>

            <?php }
            ?>

            <?php include( locate_template( 'template-parts/stages/stages-parts/lineupdays.php' ) );?>
        </div>
        <!--        --><?php //include( locate_template( 'template-parts/stages/stages-parts/lineupswitch.php' ) );
      */
      ?>
    </div>