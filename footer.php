
        </div>
        </div>
            <div class="block footer">
                <div class="block__inner">
                    <div class="grid grid--spaceBetween">
                        <?php if (pll_current_language() == 'en'): ?>
                            <div class="span span--25 links">
                                <h4>Follow us</h4>
                                <ul>
                                    <?php $fb_event_url = ufobufo_get_facebook_event_url(); ?>
                                    <?php if ( ! empty( $fb_event_url ) ) : ?>
                                        <li>
                                            <a href="<?php echo esc_url( $fb_event_url ); ?>" target="_blank">
                                                <i class="icon-facebook"></i><?php esc_html_e( 'Event on Facebook', 'ufobufo' ); ?>
                                            </a>
                                        </li>
                                    <?php endif; ?>

                                    <?php
                                    $locations = get_nav_menu_locations();
                                    if ( ! empty( $locations['footer-social-menu'] ) ) {
                                        $menu      = wp_get_nav_menu_object( $locations['footer-social-menu'] );
                                        $menu_items = $menu ? wp_get_nav_menu_items( $menu->term_id ) : array();

                                        if ( ! empty( $menu_items ) ) {
                                            foreach ( $menu_items as $item ) {
                                                $icon_class = '';
                                                $url        = isset( $item->url ) ? $item->url : '';

                                                if ( strpos( $url, 'facebook.com' ) !== false ) {
                                                    $icon_class = 'icon-facebook';
                                                } elseif ( strpos( $url, 'instagram.com' ) !== false ) {
                                                    $icon_class = 'icon-instagram';
                                                } elseif (
                                                    strpos( $url, 'soundcloud.com' ) !== false
                                                    || strpos( $url, 'mixcloud.com' ) !== false
                                                ) {
                                                    $icon_class = 'icon-play';
                                                }

                                                $target = ! empty( $item->target ) ? ' target="' . esc_attr( $item->target ) . '"' : '';
                                                ?>
                                                <li>
                                                    <a href="<?php echo esc_url( $url ); ?>"<?php echo $target; ?>>
                                                        <?php if ( $icon_class ) : ?>
                                                            <i class="<?php echo esc_attr( $icon_class ); ?>"></i><?php endif; 
                                                            echo esc_html( $item->title ); ?>
                                                    </a>
                                                </li>
                                                <?php
                                            }
                                        }
                                    }
                                    ?>
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
                                    <?php $fb_event_url = ufobufo_get_facebook_event_url(); ?>
                                    <?php if ( ! empty( $fb_event_url ) ) : ?>
                                        <li>
                                            <a href="<?php echo esc_url( $fb_event_url ); ?>" target="_blank">
                                                <i class="icon-facebook"></i><?php esc_html_e( 'Událost na Facebooku', 'ufobufo' ); ?>
                                            </a>
                                        </li>
                                    <?php endif; ?>

                                    <?php
                                    $locations = get_nav_menu_locations();
                                    if ( ! empty( $locations['footer-social-menu'] ) ) {
                                        $menu      = wp_get_nav_menu_object( $locations['footer-social-menu'] );
                                        $menu_items = $menu ? wp_get_nav_menu_items( $menu->term_id ) : array();

                                        if ( ! empty( $menu_items ) ) {
                                            foreach ( $menu_items as $item ) {
                                                $icon_class = '';
                                                $url        = isset( $item->url ) ? $item->url : '';

                                                if ( strpos( $url, 'facebook.com' ) !== false ) {
                                                    $icon_class = 'icon-facebook';
                                                } elseif ( strpos( $url, 'instagram.com' ) !== false ) {
                                                    $icon_class = 'icon-instagram';
                                                } elseif (
                                                    strpos( $url, 'soundcloud.com' ) !== false
                                                    || strpos( $url, 'mixcloud.com' ) !== false
                                                ) {
                                                    $icon_class = 'icon-play';
                                                }

                                                $target = ! empty( $item->target ) ? ' target="' . esc_attr( $item->target ) . '"' : '';
                                                ?>
                                                <li>
                                                    <a href="<?php echo esc_url( $url ); ?>"<?php echo $target; ?>>
                                                        <?php if ( $icon_class ) : ?>
                                                            <i class="<?php echo esc_attr( $icon_class ); ?>"></i><?php endif; ?><?php 
                                                            echo esc_html( $item->title ); ?>
                                                    </a>
                                                </li>
                                                <?php
                                            }
                                        }
                                    }
                                    ?>
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
                                        <div class="swiper-slide">
                                            <img
                                                class="modal-gallery-image"
                                                data-src="<?php echo esc_url($image_url) ?>"
                                                alt="<?php echo esc_attr($image_alt) ?>"
                                                decoding="async"
                                            />
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
        <script src="<?php bloginfo('template_url'); ?>/js/ostryweb.js?v=29126"></script>
    </body>
</html>
