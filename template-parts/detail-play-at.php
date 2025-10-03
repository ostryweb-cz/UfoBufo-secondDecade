

    <?php if( get_field('artist-main-stage-live-time') ): ?>
    <p class="playAt"><?php if(pll_current_language() == 'en') {
            echo 'Main stage Live set at:';
        } else if(pll_current_language() == 'cs') {
            echo 'Live set na hlavní stage:';
        } ?>
        <?php the_field('artist-main-stage-live-time'); ?></p>
    <?php endif; ?>


    <?php if( get_field('artist-main-stage-dj-time') ): ?>
    <p class="playAt"><?php if(pll_current_language() == 'en') {
            echo 'Main stage Dj set at:';
        } else if(pll_current_language() == 'cs') {
            echo 'Dj set na hlavní stage:';
        } ?>
        <?php the_field('artist-main-stage-dj-time'); ?></p>
    <?php endif; ?>

    <?php if( get_field('artist-chill-stage-dj-time') ): ?>
        <p class="playAt"><?php if(pll_current_language() == 'en') {
                echo 'Chill-out stage Live set at:';
            } else if(pll_current_language() == 'cs') {
                echo 'Live set v chill-outu:';
            } ?>
            <?php the_field('artist-chill-stage-dj-time'); ?></p>
    <?php endif; ?>

    <?php if( get_field('artist-chill-stage-dj-time') ): ?>
        <p class="playAt"><?php if(pll_current_language() == 'en') {
                echo 'Chill-out stage Dj set at:';
            } else if(pll_current_language() == 'cs') {
                echo 'Dj set v chill-outu:';
            } ?>
            <?php the_field('artist-chill-stage-dj-time'); ?></p>
    <?php endif; ?>

    <?php if( get_field('artist-tribal-stage-time') ): ?>
        <p class="playAt"><?php if(pll_current_language() == 'en') {
                echo 'Tribal stage at:';
            } else if(pll_current_language() == 'cs') {
                echo 'Hraje na Tribal stage:';
            } ?>
            <?php the_field('artist-tribal-stage-time'); ?></p>
    <?php endif; ?>



