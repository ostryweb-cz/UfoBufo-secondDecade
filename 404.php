<?php get_header(); ?>
<?php ufobufo_body_header(); ?>

    <div class="block">
        <div class="block__inner">
            <div class="detail__Inner">

                <div class="h1 ta--center"><?php if(pll_current_language() == 'en'): ?>
                        404 Not Found
                    <?php elseif(pll_current_language() == 'cs'): ?>
                        404 Nenalezeno
                    <?php endif; ?></div>

                <p class="lead ta--center"><?php if(pll_current_language() == 'en'): ?>
                        Nothing found for the requested page. Try a search instead. <br><br>or
                    <?php elseif(pll_current_language() == 'cs'): ?>
                        Pro požadovanou stránku nebylo nalezeno nic. Vyzkoušejte místo toho hledání.<br><br>nebo
                    <?php endif; ?>
                </p>

                <p class="ta--center">
                    <?php if(pll_current_language() == 'en'): ?>
                        <a class="button" href="/en/">Go to homepage</a>
                    <?php elseif(pll_current_language() == 'cs'): ?>
                        <a class="button" href="/">Přejít na hlavní stránku</a>
                    <?php endif; ?>
                </p>

            </div>
        </div>
    </div>

<?php get_footer(); ?>