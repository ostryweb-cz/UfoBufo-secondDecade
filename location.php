<?php /* Template Name: Location */ ?>

<?php get_header(); ?>
<?php ufobufo_body_header(); ?>


<div class="block">
    <?php include(locate_template('template-parts/page-title.php')); ?>


    <div class="block__inner">
        <div class="row">
        <?php display_boxes(pll_get_term(242), -1); // all posts in category 242 ?>
        </div>
</div>

<?php get_footer(); ?>
<?php /* ?>
        <?php if (pll_current_language() == 'en'): ?>
            <h2 class="ta--center">Area plan</h2>
        <?php elseif (pll_current_language() == 'cs'): ?>
            <h2 class="ta--center">Plán areálu</h2>
        <?php endif; ?>
        <div class="plan">
            <?php if (pll_current_language() == 'en'): ?>
                <img src="<?php bloginfo('template_url'); ?>/img/plan.svg" />
            <?php elseif (pll_current_language() == 'cs'): ?>
                <img src="<?php bloginfo('template_url'); ?>/img/plan-cs.svg" />
            <?php endif; ?>


            <div class="tooltip-container">
                <span class="tooltip_content">
                    <?php if (pll_current_language() == 'en'): ?>
                        <h4>Parking</h4>
                    <?php elseif (pll_current_language() == 'cs'): ?>
                        <h4>Parkoviště</h4>
                    <?php endif; ?>
                    <img src="<?php bloginfo('template_url'); ?>/img/parking.jpg" />
                    <?php if (pll_current_language() == 'en'): ?>
                        <p>No camping!!!</p>
                    <?php elseif (pll_current_language() == 'cs'): ?>
                        <p>Nekempovat!!!</p>
                    <?php endif; ?>
                 </span>

            </div>
            <div class="tooltip-container">
                <span class="tooltip_content">
                    <h4>Ufobufograf</h4>
                    <?php if (pll_current_language() == 'en'): ?>
                        <a href="/en/programme/other/bufograf-cinema/">More info here</a>
                    <?php elseif (pll_current_language() == 'cs'): ?>
                        <a href="/program/jine/bufograf-cinema/">Více informací zde</a>
                    <?php endif; ?>

                 </span>
            </div>

            <div class="tooltip-container">
                <span class="tooltip_content">
                     <?php if (pll_current_language() == 'en'): ?>
                         <h4>Camping area</h4>
                     <?php elseif (pll_current_language() == 'cs'): ?>
                         <h4>Kemp</h4>
                     <?php endif; ?>
                    <?php if (pll_current_language() == 'en'): ?>
                        <a href="/en/programme/other/bufograf-cinema/">More info here</a>
                    <?php elseif (pll_current_language() == 'cs'): ?>
                        <a href="/program/jine/bufograf-cinema/">Více informací zde</a>
                    <?php endif; ?>

                 </span>
            </div>

            <div class="tooltip-container">
                <span class="tooltip_content">
                     <?php if (pll_current_language() == 'en'): ?>
                         <h4>Family camp</h4>
                     <?php elseif (pll_current_language() == 'cs'): ?>
                         <h4>Rodinný kemp</h4>
                     <?php endif; ?>
                    <?php if (pll_current_language() == 'en'): ?>
                        <a href="/en/programme/other/bufograf-cinema/">More info here</a>
                    <?php elseif (pll_current_language() == 'cs'): ?>
                        <a href="/program/jine/bufograf-cinema/">Více informací zde</a>
                    <?php endif; ?>
                 </span>
            </div>

            <div class="tooltip-container">
                <span class="tooltip_content">
                     <?php if (pll_current_language() == 'en'): ?>
                         <h4>Caravan camp</h4>
                     <?php elseif (pll_current_language() == 'cs'): ?>
                         <h4>Karavan kemp</h4>
                     <?php endif; ?>
                    <?php if (pll_current_language() == 'en'): ?>
                        <a href="/en/programme/other/bufograf-cinema/">More info here</a>
                    <?php elseif (pll_current_language() == 'cs'): ?>
                        <a href="/program/jine/bufograf-cinema/">Více informací zde</a>
                    <?php endif; ?>
                 </span>
            </div>

            <div class="tooltip-container">
                <span class="tooltip_content">

                     <?php if (pll_current_language() == 'en'): ?>
                         <h4>Kids area</h4>
                     <?php elseif (pll_current_language() == 'cs'): ?>
                         <h4>Kids area</h4>
                     <?php endif; ?>
                    <?php if (pll_current_language() == 'en'): ?>
                        <a href="/en/programme/other/bufograf-cinema/">More info here</a>
                    <?php elseif (pll_current_language() == 'cs'): ?>
                        <a href="/program/jine/bufograf-cinema/">Více informací zde</a>
                    <?php endif; ?>
                 </span>
            </div>

            <div class="tooltip-container">
                <span class="tooltip_content">

                     <?php if (pll_current_language() == 'en'): ?>
                         <h4>Healing area</h4>
                     <?php elseif (pll_current_language() == 'cs'): ?>
                         <h4>Healing area</h4>
                     <?php endif; ?>
                    <?php if (pll_current_language() == 'en'): ?>
                        <a href="/en/programme/other/bufograf-cinema/">More info here</a>
                    <?php elseif (pll_current_language() == 'cs'): ?>
                        <a href="/program/jine/bufograf-cinema/">Více informací zde</a>
                    <?php endif; ?>
                 </span>
            </div>

            <div class="tooltip-container">
                <span class="tooltip_content">
                     <?php if (pll_current_language() == 'en'): ?>
                         <h4>Gate</h4>
                     <?php elseif (pll_current_language() == 'cs'): ?>
                         <h4>Vstup</h4>
                     <?php endif; ?>
                    <?php if (pll_current_language() == 'en'): ?>
                        <a href="/en/programme/other/bufograf-cinema/">More info here</a>
                    <?php elseif (pll_current_language() == 'cs'): ?>
                        <a href="/program/jine/bufograf-cinema/">Více informací zde</a>
                    <?php endif; ?>
                 </span>
            </div>

            <div class="tooltip-container">
                <span class="tooltip_content">

                     <?php if (pll_current_language() == 'en'): ?>
                         <h4>Psycare</h4>
                     <?php elseif (pll_current_language() == 'cs'): ?>
                         <h4>Psycare</h4>
                     <?php endif; ?>
                    <?php if (pll_current_language() == 'en'): ?>
                        <a href="/en/programme/other/bufograf-cinema/">More info here</a>
                    <?php elseif (pll_current_language() == 'cs'): ?>
                        <a href="/program/jine/bufograf-cinema/">Více informací zde</a>
                    <?php endif; ?>
                 </span>
            </div>
            <div class="tooltip-container">
                <span class="tooltip_content">

                     <?php if (pll_current_language() == 'en'): ?>
                         <h4>Public showers</h4>
                     <?php elseif (pll_current_language() == 'cs'): ?>
                         <h4>Veřejné sprchy</h4>
                     <?php endif; ?>
                    <?php if (pll_current_language() == 'en'): ?>
                        <a href="/en/programme/other/bufograf-cinema/">More info here</a>
                    <?php elseif (pll_current_language() == 'cs'): ?>
                        <a href="/program/jine/bufograf-cinema/">Více informací zde</a>
                    <?php endif; ?>
                 </span>
            </div>
            <div class="tooltip-container">
                <span class="tooltip_content">

                     <?php if (pll_current_language() == 'en'): ?>
                         <h4>Restaurant</h4>
                     <?php elseif (pll_current_language() == 'cs'): ?>
                         <h4>Restaurace</h4>
                     <?php endif; ?>

                 </span>
            </div>
            <div class="tooltip-container">
                <span class="tooltip_content">

                     <?php if (pll_current_language() == 'en'): ?>
                         <h4>First aid</h4>
                     <?php elseif (pll_current_language() == 'cs'): ?>
                         <h4>První pomoc</h4>
                     <?php endif; ?>

                 </span>
            </div>

            <div class="tooltip-container">
                <span class="tooltip_content">

                     <?php if (pll_current_language() == 'en'): ?>
                         <h4>Shops</h4>
                     <?php elseif (pll_current_language() == 'cs'): ?>
                         <h4>Obchody</h4>
                     <?php endif; ?>

                 </span>
            </div>
            <div class="tooltip-container">
                <span class="tooltip_content">

                     <?php if (pll_current_language() == 'en'): ?>
                         <h4>Restaurants</h4>
                     <?php elseif (pll_current_language() == 'cs'): ?>
                         <h4>Restarace</h4>
                     <?php endif; ?>

                 </span>
            </div>
            <div class="tooltip-container">
                <span class="tooltip_content">

                     <?php if (pll_current_language() == 'en'): ?>
                         <h4>Bar</h4>
                     <?php elseif (pll_current_language() == 'cs'): ?>
                         <h4>Bar</h4>
                     <?php endif; ?>

                 </span>
            </div>
            <div class="tooltip-container">
                <span class="tooltip_content">

                     <?php if (pll_current_language() == 'en'): ?>
                         <h4>Showers</h4>
                     <?php elseif (pll_current_language() == 'cs'): ?>
                         <h4>Sprchy</h4>
                     <?php endif; ?>

                 </span>
            </div>
            <div class="tooltip-container">
                <span class="tooltip_content">

                     <?php if (pll_current_language() == 'en'): ?>
                         <h4>Riverside walk</h4>
                     <?php elseif (pll_current_language() == 'cs'): ?>
                         <h4>Riverside walk</h4>
                     <?php endif; ?>

                 </span>
            </div>
            <div class="tooltip-container">
                <span class="tooltip_content">

                     <?php if (pll_current_language() == 'en'): ?>
                         <h4>Fluoro gallery</h4>
                     <?php elseif (pll_current_language() == 'cs'): ?>
                         <h4>Fluoro galerie</h4>
                     <?php endif; ?>

                 </span>
            </div>
            <div class="tooltip-container">
                <span class="tooltip_content">

                     <?php if (pll_current_language() == 'en'): ?>
                         <h4>Main stage</h4>
                     <?php elseif (pll_current_language() == 'cs'): ?>
                         <h4>Hlavní stage</h4>
                     <?php endif; ?>

                 </span>
            </div>

            <div class="tooltip-container">
                <span class="tooltip_content">

                     <?php if (pll_current_language() == 'en'): ?>
                         <h4>Tribal stage</h4>
                     <?php elseif (pll_current_language() == 'cs'): ?>
                         <h4>Tribal stage</h4>
                     <?php endif; ?>

                 </span>
            </div>
            <div class="tooltip-container">
                <span class="tooltip_content">

                     <?php if (pll_current_language() == 'en'): ?>
                         <h4>Chill-out stage</h4>
                     <?php elseif (pll_current_language() == 'cs'): ?>
                         <h4>Chill-out stage</h4>
                     <?php endif; ?>

                 </span>
            </div>


            <span class="tooltip" title="Parking Nedoporučujeme parkovat ve vesnici (navíc je to 3km daleko). Na příjezdové cestě je stání zakázáno. Parkování je zajištěno přímo ve festivalovém areálu - jak pro auta, tak karavan. Za parkování se na vstupu platí poplatek za auto - 200kč a za obytňák/karavan 400kč. Parkování je odděleno od kempu, tedy v parkingu nerozbíjejte stany a to ani v části pro karavany!"></span>
        </div>

    </div>
<?php */ ?>
</div>


<?php 
get_footer();