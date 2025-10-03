<div class="block__inner" id="other">
    <h2 class="ta--center">
        <?php
        if (pll_current_language() == 'en') {
            echo '... and others';
        } elseif (pll_current_language() == 'cs') {
            echo '... a další';
        }
        ?>
    </h2>

    <div class="row row--4">
        <?php
        // Display all posts in category 250, ordered by title ascending
        display_boxes(pll_get_term(250), -1); 
        ?>
    </div>
</div>
