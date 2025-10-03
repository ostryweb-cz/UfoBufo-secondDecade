    <div class="block__inner" id="chill">
    <?php $categories1 = get_posts(array(
            'posts_per_page' => -1,
            'post_status' => 'publish',
            'tag' => "chill-stage-live-en-2025, chill-stage-live-cs-2025",
            //'meta_key'			=> 'artist-chill-stage-live-number',
            'orderby'			=> 'title',
            'order' => 'asc',
          ));
          $categories2 = get_posts(array(
            'posts_per_page' => -1,
            'post_status' => 'publish',
            'tag' => "chill-stage-dj-en-2025, chill-stage-dj-cs-2025",
            //'meta_key' => 'artist-chill-stage-dj-number',
            'orderby'			=> 'title',
            'order' => 'asc',
          ));
    
          echo '<h2 class="ta--center">🦉 Chill stage</h2>';
          $festival_text = ufobufo_get_festival_text('(UFO BUFO Festival 2025)');
          if ( ! empty( $festival_text ) ) {
              echo '<h3 class="ta--center">' . esc_html( $festival_text ) . '</h3>';
          }
          echo '<div class="list-view">';
      
          echo '<p class="stage-style"><span>';
          echo 'psychill, chillout';
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
                $playAt = get_field( 'artist-chill-stage-live-time', $postID );
                $number = get_field( 'artist-chill-stage-live-number', $postID );

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
                $playAt = get_field( 'artist-chill-stage-dj-time', $postID );
                $number = get_field( 'artist-chill-stage-dj-number', $postID );

              include( locate_template( 'template-parts/stages/stages-parts/listItem.php' ) );
            }
            echo '</div>';
          }
      
          if( !(empty($categories1) || empty($categories2)) ) {
            echo '</div>';
          }
          echo '<figure class="wp-block-gallery has-nested-images columns-default is-cropped wp-block-gallery-3 is-layout-flex wp-block-gallery-is-layout-flex">
          <figure class="wp-block-image size-large">
            <a href="https://ufobufo.eu/wp-content/uploads/2025/04/1744183874857.jpg"><img loading="lazy" decoding="async" width="2000" height="1498" src="https://ufobufo.eu/wp-content/uploads/2025/04/1744183874857.jpg" alt="" class="wp-image-6874" srcset="https://ufobufo.eu/wp-content/uploads/2025/04/1744183874857.jpg 2000w, https://ufobufo.eu/wp-content/uploads/2025/04/1744183874857-300x225.jpg 300w, https://ufobufo.eu/wp-content/uploads/2025/04/1744183874857-1024x767.jpg 1024w, https://ufobufo.eu/wp-content/uploads/2025/04/1744183874857-768x575.jpg 768w, https://ufobufo.eu/wp-content/uploads/2025/04/1744183874857-1536x1150.jpg 1536w, https://ufobufo.eu/wp-content/uploads/2025/04/1744183874857-600x449.jpg 600w" sizes="auto, (max-width: 2000px) 100vw, 2000px" /></a>
          </figure>
        </figure>';
 /*
    ?>
        <div class="lineUp-view chillout-stage lineUp-view--hidden ">
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
                $playChillStageLive = get_field( 'artist-chill-stage-live-time', $pageID );
                $playChillStageDj = get_field( 'artist-chill-stage-dj-time', $pageID );
                ?>


                <?php if ( get_field('artist-chill-stage-live-time' ) ): ?>
                    <div class="lineupItem" data-date="<?php echo $playChillStageLive ?>">
                        <?php if ( 'yes' == get_field('artist-page') ): ?>
                            <a href="<?php echo $link ?>" >
                                <h3><?php echo $title ?><span>Live</span></h3>
                                <p><?php echo $playChillStageLive ?></p>
                            </a>
                        <?php else: ?>
                            <div>
                                <h3><?php echo $title ?><span>Live</span></h3>
                                <p><?php echo $playChillStageLive ?></p>
                            </div>
                        <?php endif; ?>

                    </div>
                <?php endif; ?>

                <?php if ( get_field('artist-chill-stage-dj-time' ) ): ?>
                    <div class="lineupItem" data-date="<?php echo $playChillStageDj ?>">
                        <?php if ( 'yes' == get_field('artist-page') ): ?>
                            <a href="<?php echo $link ?>" >
                                <h3><?php echo $title ?></h3>
                                <p><?php echo $playChillStageDj ?></p>
                            </a>
                        <?php else: ?>
                            <div>
                                <h3><?php echo $title ?></h3>
                                <p><?php echo $playChillStageDj ?></p>
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
      wp_reset_postdata(); ?>
    </div>
