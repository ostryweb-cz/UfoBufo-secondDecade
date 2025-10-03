
        </div>
        </div>
            <div class="block footer">
                <div class="block__inner">
                    <div class="grid grid--spaceBetween">
                        <?php if (pll_current_language() == 'en'): ?>
                            <div class="span span--25 links">
                                <h4>Follow us</h4>
                                <ul>
                                    <li><a href="https://www.facebook.com/events/3441146912696182/" target="_blank"><i class="icon-facebook"></i>Event on Facebook</a></li>
                                    <li><a href="https://www.facebook.com/ufobufo.eu" target="_blank"><i class="icon-facebook"></i>Page on Facebook</a></li>
                                    <li><a href="https://www.instagram.com/ufobufo/" target="_blank"><i class="icon-instagram"></i>Instagram</a></li>
                                    <li><a href="https://soundcloud.com/ufo-bufo" target="_blank"><i class="icon-play"></i>Soundcloud</a></li>
                                    <li><a href="https://www.mixcloud.com/UFO_BUFO/" target="_blank"><i class="icon-play"></i>Mixcloud</a></li>
                                </ul>
                            </div>
                            <div class="span span--25 download">
                                <h4>Location</h4>
                                  <a href="https://maps.app.goo.gl/fyeL3U2Ts712tfrNA" target="_blank"><i class="icon-info"></i>Google maps</a><br><br>
                                  <p>GPS: 49°44’41.7″N 17°41’33.0″E</p>
                            </div>
                            <div class="span span--25 contact">
                                <h4>Address</h4>
                                <address>
                                    <strong>Hadinka</strong><br>
                                    Vítkov-Klokočov<br>
                                    747 47 <br>
                                    Czech Republic
                                </address>
                            </div>
                            <div class="span span--25 download">
                                <h4>Contact</h4>
                                <p>If you have any questions contact us.</p>
                                <a href="mailto:info@ufobufo.cz"><i class="icon-email"></i> info@ufobufo.cz</a>
                            </div>
                        <?php elseif (pll_current_language() == 'cs'): ?>
                            <div class="span span--25 links">
                                   <h4>Sledujte nás</h4>
                                <ul>
                                    <li><a href="https://www.facebook.com/events/3441146912696182/" target="_blank"><i class="icon-facebook"></i>Událost na Facebooku</a></li>
                                    <li><a href="https://www.facebook.com/ufobufo.eu" target="_blank"><i class="icon-facebook"></i>Stránka na Facebooku</a></li>
                                    <li><a href="https://www.instagram.com/ufobufo/" target="_blank"><i class="icon-instagram"></i>Instagram</a></li>
                                    <li><a href="https://soundcloud.com/ufo-bufo" target="_blank"><i class="icon-play"></i>Soundcloud</a></li>
                                    <li><a href="https://www.mixcloud.com/UFO_BUFO/" target="_blank"><i class="icon-play"></i>Mixcloud</a></li>
                                </ul>                   
                            </div>
                            <div class="span span--25 download">
                                <h4>Místo konání</h4>
                                  <a href="https://maps.app.goo.gl/fyeL3U2Ts712tfrNA" target="_blank"><i class="icon-info"></i>Google maps</a><br><br>
                                  <p>GPS: 49°44’41.7″N 17°41’33.0″E</p>
                            </div>
                            <div class="span span--25 contact">
                                <h4>Adresa areálu</h4>
                                <address>
                                    <strong>Hadinka</strong><br>
                                    Vítkov-Klokočov<br>
                                    747 47 <br>
                                    Česká republika
                                </address>
                            </div>
                            <div class="span span--25 download">
                                <h4>Kontakt</h4>
                                <p>Pokud máte jakékoli dotazy napište nám.</p>
                                <a href="mailto: info@ufobufo.cz"><i class="icon-email"></i> info@ufobufo.cz</a>
                            </div>
                        <?php endif; ?>





                    </div>
                    <hr>
                    <div class="grid ">
                        <div class="span span--100">
                            <p class="tuneIn">TURN ON, TUNE IN, AND DROP OUT</p>
                        </div>
                        <div class="span span--100 copyright">
                            <p id="copyright">
                                <?php echo sprintf(__('%1$s %2$s %3$s. All Rights Reserved. ', 'ufobufo'), '&copy;', date('Y'), 'Spolek ŽabArt' ); ?>

                            </p>
                        </div>
                    </div>
                </div>
            </div>


        <div id="modal-gallery" class="iziModal">
            <div class="modalContent">
                <a class="modal-close" data-izimodal-close=""><i class="icon-close"></i></a>
                <div>
                    <?php if (have_posts()) : while (have_posts()) : the_post(); ?>

                        <?php if (have_rows('images')): ?>
                            <!-- Swiper -->
                            <div class="swiper-container gallery-top" style="visibility: hidden; ">
                                <div class="swiper-wrapper">
                                    <?php while (have_rows('images')): the_row(); ?>
                                        <?php
                                        // first, get the image object returned by ACF
                                        $image_object = get_sub_field('img');
                                        $image_url = $image_object['url'];
                                        $image_alt = $image_object['alt'];
                                        $image_id = $image_object['ID'];

                                        ?>
                                        <div class="swiper-slide" style="background-image: url('<?php echo $image_url ?>');">

                                            <?php  $image_caption = $image_object['caption']; ;  if (!empty($image_caption)): ?>
                                                <p><?php echo $image_caption ?></p>
                                            <?php endif; ?>


                                        </div>
                                        <?php ?>
                                    <?php endwhile; ?>
                                </div>
                                <div class="swiper-pagination"></div>
                                <!-- Add Arrows -->
                                <div class="swiper-button-next"></div>
                                <div class="swiper-button-prev"></div>
                            </div>


                        <?php endif; ?>
                    <?php endwhile; endif; ?>
                </div>
            </div>
        </div>
        <?php wp_footer(); ?>
        <script src="<?php bloginfo('template_url'); ?>/js/ostryweb.js"></script>
    </body>
</html>