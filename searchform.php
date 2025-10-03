<?php
/**
 * Template for displaying search forms in Twenty Sixteen
 *
 * @package WordPress
 * @subpackage Twenty_Sixteen
 * @since Twenty Sixteen 1.0
 */
?>


<form role="search" method="get"  class="search-form" action="<?php echo home_url('/'); ?>">

    <input required type="text" value="" name="s" class="s" placeholder="<?php
    if (pll_current_language() == 'en') {
        echo 'e.g. tickets';
    } else if (pll_current_language() == 'cs') {
        echo 'např. vstupenky';
    }
    ?>"/>
    <button type="submit"  value="
        <?php
    if (pll_current_language() == 'en') {
        echo 'Search';
    } else if (pll_current_language() == 'cs') {
        echo 'Hledat';
    }
    ?>" class="button"><i class="icon-search"></i></button>

</form>