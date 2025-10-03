<?php /* Template Name: Program */

get_header(); ?>
<?php ufobufo_body_header(); ?>
<div class="block">
    <?php include( locate_template( 'template-parts/page-title-nocontent.php' ) );?>
    <?php include( locate_template( 'template-parts/stages/mainstage.php' ) ); ?>
    <?php include( locate_template( 'template-parts/stages/chilloutstage.php' ) ); ?>
    <?php include( locate_template( 'template-parts/stages/groovystage.php' ) ); ?>
    <?php include( locate_template( 'template-parts/stages/tribalstage.php' ) );?>
    <?php include( locate_template( 'template-parts/stages/decos.php' ) ); ?>
    <?php include( locate_template( 'template-parts/stages/other.php' ) ); ?>
    <?php include( locate_template( 'template-parts/page-justcontent.php' ) ); ?>
</div>

<?php get_footer(); ?>