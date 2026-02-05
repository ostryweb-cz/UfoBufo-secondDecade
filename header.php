<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width">


    <meta name="author" content="UFO BUFO Web Team & Jan Boruta">


    <link rel="apple-touch-icon" sizes="152x152" href="<?php echo esc_url(get_template_directory_uri()); ?>/img/favicon/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="<?php echo esc_url(get_template_directory_uri()); ?>/img/favicon/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="<?php echo esc_url(get_template_directory_uri()); ?>/img/favicon/favicon-16x16.png">
    <link rel="manifest" href="<?php echo esc_url(get_template_directory_uri()); ?>/img/favicon/site.webmanifest">
    <link rel="mask-icon" href="<?php echo esc_url(get_template_directory_uri()); ?>/img/favicon/safari-pinned-tab.svg" color="#ea120e">
    <meta name="msapplication-TileColor" content="#da532c">
    <meta name="theme-color" content="#ffffff">

<?php
if (is_page()) { 
	// Get current language for CS/EN mutation
	$current_lang = function_exists('pll_current_language') ? pll_current_language() : 'cs';
	$meta_desc_key = ('en' === $current_lang) ? 'festival_meta_description_en' : 'festival_meta_description_cs';
	$meta_description = get_theme_mod($meta_desc_key, '');
?>
		<meta name="description" content="<?php echo esc_attr($meta_description); ?>">
    <meta property="og:description" content="<?php echo esc_attr($meta_description); ?>"> 
    <meta property="og:title" content="<?php echo esc_attr(wp_get_document_title()); ?>">
    <meta property="og:site_name" content="UFO BUFO festival">
    <meta property="og:url" content="http://ufobufo.eu/">
    <meta property="og:type" content="website">
    <?php 
    	$og_image = get_theme_mod('festival_og_image', '');
    	if (empty($og_image)) {
    		$og_image = esc_url(get_template_directory_uri()) . '/img/og-img.jpg';
    	}
    ?>
    <meta property="og:image" content="<?php echo esc_url($og_image); ?>">
<?php } elseif (is_single()) {
    $post_title = get_the_title();
    $post_excerpt = get_the_excerpt();
    $post_url = get_permalink();
    $post_thumbnail = get_the_post_thumbnail_url(null, 'full'); 
    ?>
    <meta name="description" content="<?php echo esc_attr($post_excerpt); ?>">
    <meta property="og:description" content="<?php echo esc_attr($post_excerpt); ?>">
    <meta property="og:title" content="<?php echo esc_attr($post_title); ?>">
    <meta property="og:site_name" content="UFO BUFO festival">
    <meta property="og:url" content="<?php echo esc_url($post_url); ?>">
    <meta property="og:type" content="article">
    <meta property="og:image" content="<?php echo esc_url($post_thumbnail); ?>">
<?php } ?>

<?php
$v = wp_get_theme()->version;
?>

    <link rel="stylesheet" type="text/css" href="<?php echo esc_url(get_template_directory_uri()); ?>/css/front.min.css?v=<?php echo esc_attr($v); ?>">
<?php 
//if ( current_user_can( 'manage_options' ) ) {
echo '<link rel="stylesheet" type="text/css" href="'. esc_url(get_template_directory_uri()) .'/css/2026.css?v='. esc_attr($v) .'">';
//}
?>

	
<!-- Facebook Pixel Code -->
<script>
  !function(f,b,e,v,n,t,s)
  {if(f.fbq)return;n=f.fbq=function(){n.callMethod?
  n.callMethod.apply(n,arguments):n.queue.push(arguments)};
  if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';
  n.queue=[];t=b.createElement(e);t.async=!0;
  t.src=v;s=b.getElementsByTagName(e)[0];
  s.parentNode.insertBefore(t,s)}(window, document,'script',
  'https://connect.facebook.net/en_US/fbevents.js');
  fbq('init', '461289669690713');
  fbq('track', 'PageView');
</script>
<!-- End Facebook Pixel Code -->

<!-- Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=G-07RBRX44XV"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'G-07RBRX44XV');
</script>
<!-- End Google Analytics -->

<?php wp_head(); ?>
</head>
