<body <?php body_class(); ?>>
<!-- Facebook Pixel Code -->
<noscript><img height="1" width="1" style="display:none"
  src="https://www.facebook.com/tr?id=461289669690713&ev=PageView&noscript=1"
></noscript>
<!-- End Facebook Pixel Code -->
<div class="loader">
   <img src="<?php echo esc_url(get_template_directory_uri()); ?>/img/preloader.gif"  alt="Loading...">
</div>

<header id="header" role="banner" class="topHeader">
    <div class="topHeader__inner">
        <section class="topHeaderBrand">
          <a class="topHeaderBrandTitle"  href="<?php echo esc_url( home_url( '/' ) ); ?>"  rel="home">
            <div>
              <?php if ( is_front_page() || is_home() || is_front_page() && is_home() )
              { echo '<h1>'; } ?>
                  <span><?php echo esc_html( get_bloginfo( 'name' ) ); ?></span>
                  <strong><?php echo esc_html(get_bloginfo('description')); ?></strong>
              <?php if ( is_front_page() || is_home() || is_front_page() && is_home() )
               { echo '</h1>'; } ?>
            </div>
          </a>
        </section>
        <nav id="menu" role="navigation" class="topHeaderMenu">

            <?php wp_nav_menu( array( 'theme_location' => 'main-menu' ) ); ?>
            <div id="search" class="topHeaderSearch ">
                <?php get_search_form(); ?>
            </div>
            <ul class="topHeaderLanguages">
                <?php pll_the_languages( array( 'show_flags' => 0,'show_names' => 1, 'hide_current'  => 1,  ) ); ?>
            </ul>

        </nav>
        <div id="search" class="topHeaderSearch topHeaderSearch--hidden">
            <?php get_search_form(); ?>
        </div>

        <a class="header-search" href="#"><i class="icon-search"></i></a>
        <ul class="topHeaderLanguages">
            <?php pll_the_languages( array( 'show_flags' => 0,'show_names' => 1, 'hide_current'  => 1,  ) ); ?>
        </ul>
        <button class="topHeaderMenuToggle">
            <span></span>
            <span></span>
            <span></span>
        </button>
    </div>
</header>

<div class="site">
    <div class="te">