<?php get_header(); ?>
<?php ufobufo_body_header(); ?>


<!--detail pro artistu-->
<?php if (in_category(84) || in_category(309)) : ?>
    <ul class="breadcrumbs">
        <li><a href="<?php echo pll_home_url(); ?>"><i class="icon-home"></i></a></li>
        <li><a href="<?php 
          $program_id = pll_get_post(46);
          echo get_permalink( $program_id ) ?>"><?php echo get_the_title( $program_id ); ?></a></li>
        <li><?php the_field('artist-name'); ?></li>
    </ul>

    <?php $image = get_field('post-background');  if (!empty($image)): ?>
        <div class="block" style="background-image: url('<?php echo $image['url']; ?>'); background-size: 100%; background-repeat: no-repeat; background-position: center top; min-height: 70vh; ">
    <?php else: ?>
        <div class="block">
    <?php endif; ?>
        <div class="block__inner">
            <div class="detail__Inner artist-detail">
                <?php if (have_posts()) : while (have_posts()) : the_post(); ?>

                    <div class="detail__Inner__Header">
                        <h1><?php the_title(); ?></h1>
                        <p class="label"><?php the_field('artist-label'); ?>

                            <?php if (get_field('artist-coutry')): ?>
                                <span>(<?php the_field('artist-coutry') ?>)</span>
                            <?php endif; ?>
                        </p>
                    </div>


                    <?php include(locate_template('template-parts/detail-play-at.php')); ?>


                    <?php if ($post->post_content !== ""): ?>
                        <div class="grid">
                            <div class="span span--50">
                                <?php the_content(); ?>
                            </div>
                            <div class="span span--50">
                                <?php the_field('artist-sound'); ?>
                            </div>
                        </div>
                    <?php else: ?>
                        <div class="grid">
                            <div class="span span--100">
                                <?php the_field('artist-sound'); ?>
                            </div>
                        </div>
                    <?php endif; ?>
                    <div class="grid">
                      <div class="span span--100">
                          <?php 
                            $tags = get_the_tags(); // Fetch tags of the current post
                            if ($tags) {
                              if (pll_current_language() == 'cs'){
                                echo "<h3>Vystoupení na festivalu:</h3>";
                              } else {
                                echo "<h3>Performances at the festival:</h3>";
                              }
                              // Extract tags with year from descriptions
                              $tag_data = [];
                              foreach ($tags as $tag) {
                                  // Match year using regex
                                  if (preg_match('/\b(19|20)\d{2}\b/', $tag->name, $matches)) {
                                      $year = (int) $matches[0];
                                      $tag_data[] = [
                                          'description' => $tag->description,
                                          'year' => $year
                                      ];
                                  }
                              }

                              // Sort the tags by year in descending order
                              usort($tag_data, function($a, $b) {
                                  return $b['year'] - $a['year'];
                              });

                              // Output sorted tag descriptions
                              echo '<p><small>';
                              echo '<ul>';
                              foreach ($tag_data as $tag) {
                                  echo '<li>' . esc_html($tag['description']) . '</li>';
                              }
                              echo '</ul>';
                              echo '</small></p>';
                            }
                          ?>
                      </div>
                  </div>
              
                  <div class="grid">
                    <div class="span span--100">
                      <p>&nbsp;</p>
                      <h3><a href="<?php 
                        $lang_post_id = pll_get_post(89); // 'en' is the language slug
                        $permalink = get_permalink($lang_post_id);
                        echo esc_url($permalink); ?>">FESTIVAL LINE-UP</a>
                      </h3>
                    </div>
                </div>
              <?php
              endwhile; endif; ?>
            </div>
        </div>
    </div>
<?php endif; ?>


    <!--detail novinky-->
<?php if (in_category(90) || in_category(307)) : ?>
    <ul class="breadcrumbs">
        <li><a href="<?php echo pll_home_url(); ?>"><i class="icon-home"></i></a></li>
        <li><a href="<?php 
          $novinky_id = pll_get_post(383);
          echo get_permalink( $novinky_id ) ?>"><?php echo get_the_title( $novinky_id ); ?></a></li>
        <li><?php the_title(); ?></li>
    </ul>

    <?php $image = get_field('post-background');  if (!empty($image)): ?>
        <div class="block" style="background-image: url('<?php echo $image['url']; ?>'); background-size: 100%; background-repeat: no-repeat; background-position: center top; min-height: 70vh; ">
    <?php else: ?>
        <div class="block">
    <?php endif; ?>
        <div class="block__inner">
            <div class="detail__Inner news-detail">
                <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
                    <span class="date"><?php echo get_the_date(); ?></span>
                    <h1><?php the_title(); ?></h1>
                    <?php the_content(); ?>

                    <?php include( locate_template( 'template-parts/gallery-small.php' ) );?>

                <?php endwhile; endif; ?>
            </div>
        </div>
    </div>
<?php endif; ?>


    <!--detail mista-->
<?php if (in_category(244) || in_category(242)) : ?>
    <ul class="breadcrumbs">
        <li><a href="<?php echo pll_home_url(); ?>"><i class="icon-home"></i></a></li>
        <li><a href="<?php 
          $pruvodce_id = pll_get_post(111);
          echo get_permalink( $pruvodce_id ) ?>"><?php echo get_the_title( $pruvodce_id ); ?></a></li>
        <li><?php the_title(); ?></li>
    </ul>

    <?php $image = get_field('post-background');  if (!empty($image)): ?>
        <div class="block" style="background-image: url('<?php echo $image['url']; ?>'); background-size: 100%; background-repeat: no-repeat; background-position: center top; min-height: 70vh; ">
    <?php else: ?>
        <div class="block">
    <?php endif; ?>
        <div class="block__inner">
            <div class="detail__Inner place-detail">
                <?php if (have_posts()) : while (have_posts()) : the_post(); ?>

                    <h1><?php the_title(); ?></h1>
                    <?php the_content(); ?>

                    <?php include( locate_template( 'template-parts/gallery-small.php' ) );?>

                <?php endwhile; endif; ?>
            </div>
        </div>
    </div>
<?php endif; ?>

 <!--detail other-->
<?php if (in_category(250) || in_category(305)) : ?>
    <ul class="breadcrumbs">
        <li><a href="<?php echo pll_home_url(); ?>"><i class="icon-home"></i></a></li>
        <li><a href="<?php 
          $program_id = pll_get_post(46);
          echo get_permalink( $program_id ) ?>"><?php echo get_the_title( $program_id ); ?></a></li>
        <li><?php the_title(); ?></li>
    </ul>

    <?php $image = get_field('post-background');  if (!empty($image)): ?>
        <div class="block" style="background-image: url('<?php echo $image['url']; ?>'); background-size: 100%; background-repeat: no-repeat; background-position: center top; min-height: 70vh; ">
        <?php else: ?>
        <div class="block">
    <?php endif; ?>
            <div class="block__inner">
                <div class="detail__Inner other-detail">
                    <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
                        <h1><?php the_title(); ?></h1>
                        <?php the_content(); ?>

                        <?php include( locate_template( 'template-parts/gallery-small.php' ) );?>

                    <?php endwhile; endif; ?>
                </div>
            </div>
        </div>

<?php endif; ?>
          
<!--detail nezarazene-->
<?php if (in_category(7) || in_category(373)) : ?>
    <ul class="breadcrumbs">
        <li><a href="<?php echo pll_home_url(); ?>"><i class="icon-home"></i></a></li>
        <li><?php the_title(); ?></li>
    </ul>

    <?php $image = get_field('post-background');  if (!empty($image)): ?>
        <div class="block" style="background-image: url('<?php echo $image['url']; ?>'); background-size: 100%; background-repeat: no-repeat; background-position: center top; min-height: 70vh; ">
        <?php else: ?>
        <div class="block">
    <?php endif; ?>
            <div class="block__inner">
                <div class="detail__Inner other-detail">
                    <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
                        <h1><?php the_title(); ?></h1>
                        <?php the_content(); ?>

                        <?php include( locate_template( 'template-parts/gallery-small.php' ) );?>

                    <?php endwhile; endif; ?>
                </div>
            </div>
        </div>

<?php endif; ?>


    <!--detail galerie-->
<?php if (in_category(237) || in_category(239)) : ?>
    <ul class="breadcrumbs">
        <li><a href="<?php echo pll_home_url(); ?>"><i class="icon-home"></i></a></li>
        <li><a href="<?php 
          $galerie_id = pll_get_post(107);
          echo get_permalink( $galerie_id ) ?>"><?php echo get_the_title( $galerie_id ); ?></a></li>
        <li><?php the_title(); ?></li>
    </ul>


    <div class="block">
        <div class="block__inner">
            <div class="detail__Inner--gallery gallery-detail">
                <?php if (have_posts()) : while (have_posts()) :
                the_post(); ?>

                <h1><?php the_title(); ?></h1>
                <?php the_content(); ?>
            </div>
        </div>


        <?php include( locate_template( 'template-parts/gallery-big.php' ) );?>
    </div>

<?php endwhile;
endif; ?>



<?php endif; ?>


<?php get_footer(); ?>