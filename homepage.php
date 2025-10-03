<?php /* Template Name: Homepage */ ?>

<?php get_header(); ?>
<?php ufobufo_body_header(); ?>




<div class="topparalax">
    <div class="topparalax__Inner" >
            <?php if(pll_current_language() == 'en'): ?>
               	<h2><span><?php the_field('eventwelcometext_en'); ?></span><br><?php the_field('eventtext_en'); ?></h2>
        		<h1><span><?php the_field('eventname_en'); ?></span></h1>
            <?php elseif(pll_current_language() == 'cs'): ?>
                <h2><span><?php the_field('eventwelcometext'); ?></span><br><?php the_field('eventtext'); ?></h2>
        		<h1><span><?php the_field('eventname'); ?></span></h1>
            <?php endif; ?>
         </p>
        
        <img src="<?php bloginfo('template_url'); ?>/img/ufobufo-logo-temp.png" alt="UFOBUFO"/>
        <p><span><?php the_field('eventdate'); ?></span><br>
        <?php if(pll_current_language() == 'en'): ?>
               	<?php the_field('eventlocation_en'); ?>
            <?php elseif(pll_current_language() == 'cs'): ?>
                <?php the_field('eventlocation'); ?>
            <?php endif; ?>
			</p>
    </div>

    <div id="lens1" class="planet layer-1"></div>
    <div id="lens2" class="planet layer-2" ></div>

    <div class="topparalax_layer topparalax_layer--0"  ></div>
    <div class="scene topparalax_layer topparalax_layer--1" data-modifier="50" ></div>
    <div class="scene topparalax_layer topparalax_layer--2" data-modifier="5" ></div>
    <div class="scene topparalax_layer topparalax_layer--3" data-modifier="3" ></div>
    <!--div class="scene topparalax_layer topparalax_layer--4" data-modifier="9" ></div>
    <div class="scene topparalax_layer topparalax_layer--5" data-modifier="4" ></div-->
    <div id="paralax-end" class="topparalax_layer topparalax_layer--6"  ></div>
</div>

<div class="block newsblock">
  <div class="block__inner">
    <p id="player" style="max-width: 1100px;width: 100%;position: relative;padding-bottom: 56.25%;height: 0;overflow: hidden;" class="ta--center">
        <iframe style="position: absolute;top: 0;left: 0;width: 100%;height: 100%;" src="https://www.youtube.com/embed/ZhUNfmGywvI?si=rtVbJ6GoHF-p144X?loop=1&playlist=ZhUNfmGywvI&modestbranding=1&iv_load_policy=3&rel=0" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" width="1100" height="630" frameborder="0" allowfullscreen></iframe>
      </p>
  </div>
</div>

<div class="block newsblock">
    <div class="block__inner">
        <div class="span span--100">
            <h2>
                <?php if(pll_current_language() == 'en'): ?>
                    News
                <?php elseif(pll_current_language() == 'cs'): ?>
                    Novinky
                <?php endif; ?>
            </h2>
        </div>

        <div class="row">
        <?php display_boxes(pll_get_term(90), 6); // 6 posts, no pagination ?>
        </div>


        <p class="ta--center">
            <?php if(pll_current_language() == 'en'): ?>
                <a class="button" href="/en/news/">Show more news</a>
            <?php elseif(pll_current_language() == 'cs'): ?>
                <a class="button" href="/novinky/">Zobrazit další novinky</a>
            <?php endif; ?>
         </p>
    </div>
</div>

<?php get_footer(); ?>


