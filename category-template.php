<?php /* Template Name: Program */

get_header(); ?>
<?php ufobufo_body_header(); ?>
<div class="block">
    <?php include( locate_template( 'template-parts/page-title-nocontent.php' ) );?>

    <?php 
    if ( function_exists( 'ufobufo_get_lineup_years' ) && function_exists( 'ufobufo_get_requested_lineup_year' ) ) :
        $lineup_years  = ufobufo_get_lineup_years();
        $current_year  = ufobufo_get_requested_lineup_year();

        if ( ! empty( $lineup_years ) && count( $lineup_years ) > 1 ) :
    ?>
        <div class="lineup-year-switcher">
            <p class="ta--center">
                <?php if ( function_exists( 'pll_current_language' ) && pll_current_language() === 'en' ) : ?>
                    Select edition:
                <?php else : ?>
                    Předchozí ročníky:
                <?php endif; ?>
                <?php foreach ( $lineup_years as $year ) : 
                    $url   = add_query_arg( 'lineup_year', $year, get_permalink() );
                    $class = 'lineup-year-switcher__link';
                    if ( (int) $year === (int) $current_year ) {
                        $class .= ' lineup-year-switcher__link--active';
                    }
                ?>
                    <a class="<?php echo esc_attr( $class ); ?>" href="<?php echo esc_url( $url ); ?>"><?php echo esc_html( $year ); ?></a>
                <?php endforeach; ?>
            </p>
        </div>
    <?php 
        endif;
    endif;

    include( locate_template( 'template-parts/stages/mainstage.php' ) );
    include( locate_template( 'template-parts/stages/chilloutstage.php' ) );
  
    if ( ( isset($_GET['lineup_year']) && $_GET['lineup_year'] > 2023 ) || !isset($_GET['lineup_year']) )
      include( locate_template( 'template-parts/stages/groovystage.php' ) ); 
    if ( ( isset($_GET['lineup_year']) && $_GET['lineup_year'] > 2017 ) || !isset($_GET['lineup_year']) )
      include( locate_template( 'template-parts/stages/tribalstage.php' ) );
  
    include( locate_template( 'template-parts/stages/decos.php' ) );
    include( locate_template( 'template-parts/stages/other.php' ) );
    ?>
</div>

<?php get_footer(); ?>