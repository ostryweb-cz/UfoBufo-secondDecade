    <div class="block__inner" id="tribal">
      <?php 
        $lineup_year = ufobufo_get_requested_lineup_year();

        $tribal_live_tags = 'tribal-stage-live-cs-' . $lineup_year . ', tribal-stage-live-en-' . $lineup_year;

        $categories = get_posts(array(
            'posts_per_page' => -1,
            'orderby' => 'asc',
            'post_status' => 'publish',
            'tag' => $tribal_live_tags,
            //'meta_key' => 'artist-tribal-stage-number',
            'orderby'			=> 'title',
            'order' => 'asc',

        ));
        
        echo '<h2 class="ta--center">🪘 Tribal stage</h2>';
        echo '<div class="list-view">';
      
        echo '<p class="stage-style"><span>';
        if(pll_current_language() == 'en') {
          echo 'live performances &amp; concerts';
        } else if(pll_current_language() == 'cs') {
          echo 'živá vystoupení a koncerty';
        }
        $stage_list_subtext = ufobufo_get_stage_list_subtext();
        if ( $stage_list_subtext !== '' ) {
          echo '<br>' . esc_html( $stage_list_subtext );
        }
        echo '</span></p>';
        
        if(!empty($categories1)){
          echo '<div class="list-view--section">';

          foreach ($categories as $post) {
              $postID = $post->ID;
              $title = get_the_title($postID);
              $link = get_permalink($postID);
              $name = get_field( 'artist-name', $postID );
              $label = get_field( 'artist-label', $postID );
              $country = get_field( 'artist-coutry', $postID );
              $playAt = get_field( 'artist-tribal-stage-time', $postID );
              $number = get_field( 'artist-tribal-stage-number', $postID );

              include( locate_template( 'template-parts/stages/stages-parts/listItem.php' ) );
          }

          echo '</div></div>';
        }

      // Show stage image only for the newest lineup year (no archived view).
      $years       = ufobufo_get_lineup_years();
      $newest_year = reset( $years );
      $is_archive_view = isset( $_GET['lineup_year'] ) && (int) $lineup_year !== (int) $newest_year;

      if ($is_archive_view){
        echo ufobufo_get_stage_image_html( 'tribal', $lineup_year);
      } else {
        echo '<figure class="wp-block-gallery has-nested-images columns-default is-cropped wp-block-gallery-3 is-layout-flex wp-block-gallery-is-layout-flex aligncenter">
            <figure class="wp-block-image size-large">
              <a href="https://ufobufo.eu/wp-content/uploads/2024/05/ddbd8ff7-c897-4018-9f17-60a47df06445.jpeg"><img loading="lazy" decoding="async" width="1600" height="1066" src="https://ufobufo.eu/wp-content/uploads/2024/05/ddbd8ff7-c897-4018-9f17-60a47df06445.jpeg" alt="" class="wp-image-7304" srcset="https://ufobufo.eu/wp-content/uploads/2024/05/ddbd8ff7-c897-4018-9f17-60a47df06445.jpeg 1600w, https://ufobufo.eu/wp-content/uploads/2024/05/ddbd8ff7-c897-4018-9f17-60a47df06445-300x200.jpeg 300w, https://ufobufo.eu/wp-content/uploads/2024/05/ddbd8ff7-c897-4018-9f17-60a47df06445-1024x682.jpeg 1024w, https://ufobufo.eu/wp-content/uploads/2024/05/ddbd8ff7-c897-4018-9f17-60a47df06445-768x512.jpeg 768w, https://ufobufo.eu/wp-content/uploads/2024/05/ddbd8ff7-c897-4018-9f17-60a47df06445-1536x1023.jpeg 1536w, https://ufobufo.eu/wp-content/uploads/2024/05/ddbd8ff7-c897-4018-9f17-60a47df06445-600x400.jpeg 600w" sizes="auto, (max-width: 1600px) 100vw, 1600px"></a>
            </figure>
          </figure>';
      }
/*
    ?>
        <div class="lineUp-view tribal-stage lineUp-view--hidden ">
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
                $playTribalStage = get_field( 'artist-tribal-stage-time', $pageID );

                ?>


                <?php if ( get_field('artist-tribal-stage-time' ) ): ?>
                    <div class="lineupItem" data-date="<?php echo  $playTribalStage ?>">
                        <?php if ( 'yes' == get_field('artist-page') ): ?>
                            <a href="<?php echo $link ?>" >
                                <h3><?php echo $title ?><span>Live</span></h3>
                                <p><?php echo  $playTribalStage ?></p>
                            </a>
                        <?php else: ?>
                            <div>
                                <h3><?php echo $title ?><span>Live</span></h3>
                                <p><?php echo  $playTribalStage ?></p>
                            </div>
                        <?php endif; ?>

                    </div>
                <?php endif; ?>






            <?php }
            ?>

            <?php include( locate_template( 'template-parts/stages/stages-parts/lineupdays.php' ) );?>
        </div>

        <?php //include( locate_template( 'template-parts/stages/stages-parts/lineupswitch.php' ) );?>
       */ 
      ?>
    </div>
