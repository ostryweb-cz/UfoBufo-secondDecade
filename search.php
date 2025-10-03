<?php get_header(); ?>
<?php ufobufo_body_header(); ?>

    <div class="block">
        <div class="block__inner">
            <div class="search-results">
                <div class="detail__Inner">
                    <?php if ( have_posts() ) : ?>
                    <header class="header">
                        <p class="lead">
                            <?php if(pll_current_language() == 'en'): ?>
                                <?php printf( __( 'Search Results for:  <strong>%s</strong>', 'ufobufo' ), get_search_query() ); ?>
                            <?php elseif(pll_current_language() == 'cs'): ?>
                                <?php printf( __( 'Výsledky hledání:  <strong>%s</strong>', 'ufobufo' ), get_search_query() ); ?>
                            <?php endif; ?>
                        </p>
                    </header>

                    <?php while ( have_posts() ) : the_post(); ?>
                        <?php if($post->post_content!==""): ?>
                            <div class="search-result__Item">
                                <h3><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><?php search_title_highlight(); ?></a></h3>
                                <?php search_excerpt_highlight(); ?>
                                <?php include(locate_template('template-parts/boxes/more-button.php')); ?>
                            </div>
                        <?php endif; ?>

                    <?php endwhile; ?>
                        <?php get_template_part( 'nav', 'below' ); ?>
                    <?php else : ?>
                    <article id="post-0" class="post no-results not-found">

                    <header class="header">
                        <p class="lead">
                            <?php if(pll_current_language() == 'en'): ?>
                                <?php _e( 'Nothing Found', 'ufobufo' ); ?>
                            <?php elseif(pll_current_language() == 'cs'): ?>
                                <?php _e( 'Nic nenalezeno', 'ufobufo' ); ?>
                            <?php endif; ?>
                        </p>
                    </header>

                    <section class="entry-content">
                        <p class="lead">
                            <?php if(pll_current_language() == 'en'): ?>
                                <p><?php _e( 'Sorry, nothing matched your search.<br>Please try again.', 'ufobufo' ); ?></p>
                            <?php elseif(pll_current_language() == 'cs'): ?>
                                <p><?php _e( 'Je nám líto, ale vašemu vyhledávání nic neodpovídá.<br> Prosím zkuste to znovu.', 'ufobufo' ); ?></p>
                            <?php endif; ?>
                        </p>

                    </section>
                    </article>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>

<?php get_footer(); ?>