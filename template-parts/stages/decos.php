    <div class="block__inner" id="deco">
      <?php $categories = get_posts(array(
        'posts_per_page' => -1,
        'post_status' => 'publish',
        'tag' => "deco-en-2025, deco-cs-2025",
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
        
        $festival_text = ufobufo_get_festival_text('(UFO BUFO Festival 2025)');
        if ( ! empty( $festival_text ) ) {
            echo '<h3 class="ta--center">' . esc_html( $festival_text ) . '</h3>';
        }
        echo '<div class="list-view">';
        echo '<p class="stage-style"><span>';
        if(pll_current_language() == 'en') {
            echo 'Deco artists &amp; VJs';
        } else if(pll_current_language() == 'cs') {
            echo 'Dekorace | VJs ';
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
      <?php } ?>
    </div>
