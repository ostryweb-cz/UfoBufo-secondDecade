<?php get_header(); ?>
<?php ufobufo_body_header(); ?>

<div class="block">
    <div class="block__inner">
        <div class="detail__Inner news-detail">
            <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
                <span class="date"><?php echo get_the_date(); ?></span>
                <h1><?php the_title(); ?></h1>
                <?php the_content(); ?>
            <?php endwhile; endif; ?>
        </div>
    </div>
</div>

<?php /*
<section id="content" role="main">
<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
<header class="header">
<h1 class="entry-title"><?php the_title(); ?></h1> <?php edit_post_link(); ?>
</header>
<section class="entry-content">
<?php if ( has_post_thumbnail() ) { the_post_thumbnail(); } ?>
<?php the_content(); ?>
<div class="entry-links"><?php wp_link_pages(); ?></div>
</section>
</article>
<?php if ( ! post_password_required() ) comments_template( '', true ); ?>
<?php endwhile; endif; ?>
</section>
<?php get_sidebar(); ?>

<?php */ get_footer();