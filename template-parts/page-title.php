

<div class="block__inner page-header">
    <?php if(have_posts()) : ?>
        <?php while(have_posts())  : the_post(); ?>
            <h1 class="ta--center"><?php the_title(); ?></h1>
            <?php the_content(); ?>
        <?php endwhile; ?>
    <?php endif; ?>
</div>



