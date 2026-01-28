    <div class="block__inner" id="deco">
      <?php 
        $lineup_year = ufobufo_get_requested_lineup_year();
        $deco_tags   = 'deco-en-' . $lineup_year . ', deco-cs-' . $lineup_year;

        $categories = get_posts(array(
        'posts_per_page' => -1,
        'post_status' => 'publish',
        'tag' => $deco_tags,
        'orderby'			=> 'title',
        'order' => 'asc',
      ));
      
      if(!empty($categories)){
        echo '<h2 class="ta--center">';
        if(pll_current_language() == 'en') {
            echo 'Deco | Visuals';
        } else if(pll_current_language() == 'cs') {
            echo 'Dekorace | Vizuály ';
        }
        echo '</h2>';
        
        $stage_subtext = ufobufo_get_stage_heading_subtext();
        if ( ! empty( $stage_subtext ) ) {
            echo '<h3 class="ta--center">' . esc_html( $stage_subtext ) . '</h3>';
        }
        echo '<div class="list-view">';
        echo '<p class="stage-style"><span>';
        if(pll_current_language() == 'en') {
            echo 'Deco artists &amp; VJs';
        } else if(pll_current_language() == 'cs') {
            echo 'Dekorace | VJs ';
        }
        $stage_list_subtext = ufobufo_get_stage_list_subtext();
        if ( $stage_list_subtext !== '' ) {
            echo '<br>' . esc_html( $stage_list_subtext );
        }
        echo '</span></p>';

        echo '<div class="list-view--section">';
        
        foreach ($categories as $post) {
            $postID = $post->ID;
            $title = get_the_title($postID);
            $link = get_permalink($postID);
            $name = get_field( 'artist-name', $postID );
            $country = get_field( 'artist-coutry', $postID );
            $label = '';

            include( locate_template( 'template-parts/stages/stages-parts/listItem-nolabel.php' ) );
        } ?>
            </div>
        </div>
      <?php 

          $years       = ufobufo_get_lineup_years();
          $newest_year = reset( $years );
          $is_archive_view = isset( $_GET['lineup_year'] ) && (int) $lineup_year !== (int) $newest_year;
          echo ufobufo_get_stage_image_html( 'deco', $lineup_year);
      } ?>
    </div>