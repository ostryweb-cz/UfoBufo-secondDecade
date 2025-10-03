<?php
/**
 * The main template file
 * 
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 */

get_header();
?>

<div class="container">
    <div class="row">
        <div class="col-md-12">
            
            <?php if (have_posts()) : ?>
                
                <div class="posts-list">
                    <?php while (have_posts()) : the_post(); ?>
                        
                        <article id="post-<?php the_ID(); ?>" <?php post_class('post-item'); ?>>
                            
                            <?php if (has_post_thumbnail()) : ?>
                                <div class="post-thumbnail">
                                    <a href="<?php the_permalink(); ?>">
                                        <?php the_post_thumbnail('card-thumb'); ?>
                                    </a>
                                </div>
                            <?php endif; ?>
                            
                            <div class="post-content">
                                <h2 class="post-title">
                                    <a href="<?php the_permalink(); ?>">
                                        <?php the_title(); ?>
                                    </a>
                                </h2>
                                
                                <div class="post-meta">
                                    <span class="post-date">
                                        <?php echo get_the_date(); ?>
                                    </span>
                                </div>
                                
                                <div class="post-excerpt">
                                    <?php the_excerpt(); ?>
                                </div>
                                
                                <a href="<?php the_permalink(); ?>" class="button">
                                    <?php _e('Read More', 'ufobufo'); ?>
                                </a>
                            </div>
                            
                        </article>
                        
                    <?php endwhile; ?>
                </div>
                
                <?php
                // Pagination
                the_posts_pagination(array(
                    'mid_size'  => 2,
                    'prev_text' => __('&laquo; Previous', 'ufobufo'),
                    'next_text' => __('Next &raquo;', 'ufobufo'),
                    'class'     => 'pagination',
                ));
                ?>
                
            <?php else : ?>
                
                <div class="no-posts">
                    <h2><?php _e('Nothing Found', 'ufobufo'); ?></h2>
                    <p><?php _e('Sorry, no posts matched your criteria.', 'ufobufo'); ?></p>
                </div>
                
            <?php endif; ?>
            
        </div>
    </div>
</div>

<?php
get_footer();
