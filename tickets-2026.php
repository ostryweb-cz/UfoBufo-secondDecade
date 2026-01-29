<?php /* Template Name: Tickets 2026 */ ?>

<?php 

$tickets_phase      = function_exists( 'get_theme_mod' ) ? get_theme_mod( 'tickets_phase', 'phase_2' ) : 'phase_2';
$zobrazTabulkuCen   = in_array( $tickets_phase, array( 'phase_2', 'phase_3' ), true );

function ufobufo_get_ticket_state_text( $state, $lang ) {
	if ( 'en' === $lang ) {
		switch ( $state ) {
			case 'sold_out':
				return 'Sold Out';
			case 'on_sale':
				return 'Available';
			case 'upcoming':
			default:
				return 'Not Available';
		}
	}

	switch ( $state ) {
		case 'sold_out':
			return 'Vyprodáno';
		case 'on_sale':
			return 'V prodeji';
		case 'upcoming':
	default:
		return 'Nejsou v prodeji.';
	}
}

get_header(); ?>
<?php ufobufo_body_header(); ?>

<div class="block">
    <?php include( locate_template( 'template-parts/page-title.php' ) );?>
    <div class="block__inner">
     <?php 
      $lang = function_exists( 'pll_current_language' ) ? pll_current_language() : 'cs';

      // Intro text based on tickets phase & language
      if ( 'en' === $lang ) {
        if ( 'phase_1' === $tickets_phase ) {
          $intro = get_theme_mod( 'tickets_intro_phase_1_en', '' );
        } elseif ( 'phase_3' === $tickets_phase ) {
          $intro = get_theme_mod( 'tickets_intro_phase_3_en', '' );
        } else {
          $intro = get_theme_mod( 'tickets_intro_phase_2_en', '' );
        }

        if ( $intro ) {
          echo '<p>' . wp_kses_post( $intro ) . '</p>';
        }

        if ( $zobrazTabulkuCen ) {
          echo '<p><b>🇨🇿 &gt;&gt; <a href="https://ufobufo.eu/cs/vstupenky/">Ceny vstupenek v Kč</a>.</p>';
          ?>
          <?php
          // Early Bird
          $wave_key   = 'early_bird';
          $enabled    = get_theme_mod( 'tickets_early_bird_enabled', true );
          $state      = get_theme_mod( 'tickets_early_bird_state', 'sold_out' );
          $eur_full   = get_theme_mod( 'tickets_early_bird_price_eur_full', '83' );
          if ( $enabled ) :
            $row_classes = 'ticketRow' . ( 'on_sale' === $state ? '' : ' ticketRow--inactive' );
            ?>
            <div class="<?php echo esc_attr( $row_classes ); ?>">
                <div class="ticketRow_Wave"><h3><span>Pre-sale</span>Early birds</h3></div>
                <div class="ticketRow_Days"><p>wed - sun</p></div>
                <div class="ticketRow_Price"><p><?php echo esc_html( $eur_full ); ?> &euro;<span>*</span></p></div>
                <div class="ticketRow_State"><?php echo esc_html( ufobufo_get_ticket_state_text( $state, 'en' ) ); ?></div>
            </div>
          <?php endif; ?>

          <?php
          // 1st wave
          $state      = get_theme_mod( 'tickets_wave1_state', 'sold_out' );
          $enabled    = get_theme_mod( 'tickets_wave1_enabled', true );
          $eur_full   = get_theme_mod( 'tickets_wave1_price_eur_full', '103' );
          $eur_short  = get_theme_mod( 'tickets_wave1_price_eur_short', '94' );
          if ( $enabled ) :
            $row_classes = 'ticketRow' . ( 'on_sale' === $state ? '' : ' ticketRow--inactive' );
            ?>
            <div class="<?php echo esc_attr( $row_classes ); ?>">
                <div class="ticketRow_Wave"><h3><span>Pre-sale</span>1st wave</h3></div>
                <div class="ticketRow_Days"><p>wed - sun <br>fri - sun**</p></div>
                <div class="ticketRow_Price"><p><?php echo esc_html( $eur_full ); ?> &euro;<span>*</span> <br><?php echo esc_html( $eur_short ); ?> &euro;<span>*</span></p></div>
                <div class="ticketRow_State"><?php echo esc_html( ufobufo_get_ticket_state_text( $state, 'en' ) ); ?></div>
            </div>
          <?php endif; ?>

          <?php
          // 2nd wave
          $state      = get_theme_mod( 'tickets_wave2_state', 'sold_out' );
          $enabled    = get_theme_mod( 'tickets_wave2_enabled', true );
          $eur_full   = get_theme_mod( 'tickets_wave2_price_eur_full', '120' );
          $eur_short  = get_theme_mod( 'tickets_wave2_price_eur_short', '111' );
          if ( $enabled ) :
            $row_classes = 'ticketRow' . ( 'on_sale' === $state ? '' : ' ticketRow--inactive' );
            ?>
            <div class="<?php echo esc_attr( $row_classes ); ?>">
                <div class="ticketRow_Wave"><h3><span>Pre-sale</span>2nd wave</h3></div>
                <div class="ticketRow_Days"><p>wed - sun <br>fri - sun**</p></div>
                <div class="ticketRow_Price"><p><?php echo esc_html( $eur_full ); ?> &euro;<span>*</span> <br><?php echo esc_html( $eur_short ); ?> &euro;<span>*</span></p></div>
                <div class="ticketRow_State"><?php echo esc_html( ufobufo_get_ticket_state_text( $state, 'en' ) ); ?></div>
            </div>
          <?php endif; ?>

          <?php
          // Christmas gift ticket
          $state        = get_theme_mod( 'tickets_christmas_state', 'on_sale' );
          $enabled      = get_theme_mod( 'tickets_christmas_enabled', true );
          $eur_full     = get_theme_mod( 'tickets_christmas_price_eur_full', '128' );
          $button_url   = get_theme_mod( 'tickets_christmas_button_url_en', 'https://www.book-tickets.cz/index.php?page=bookticket&event=159&lang=en&currency=EUR' );
          if ( $enabled ) :
            $row_classes = 'ticketRow' . ( 'on_sale' === $state ? '' : ' ticketRow--inactive' );
            ?>
            <div class="<?php echo esc_attr( $row_classes ); ?>">
                <div class="ticketRow_Wave"><h3><span>Pre-sale</span>Christmas gift ticket</h3></div>
                <div class="ticketRow_Days"><p>wed - sun</p></div>
                <div class="ticketRow_Price"><p><?php echo esc_html( $eur_full ); ?> &euro;<span>*</span></p></div>
                <div class="ticketRow_State">
                  <?php if ( 'on_sale' === $state && $button_url ) : ?>
                    <a class="button" href="<?php echo esc_url( $button_url ); ?>" target="_blank" title="<?php esc_attr_e( 'Buy ticket at book-tickets.cz', 'ufobufo' ); ?>"><?php esc_html_e( 'Buy the ticket', 'ufobufo' ); ?></a>
                  <?php else : ?>
                    <?php echo esc_html( ufobufo_get_ticket_state_text( $state, 'en' ) ); ?>
                  <?php endif; ?>
                </div>
            </div>
          <?php endif; ?>

          <?php
          // 3rd wave
          $state      = get_theme_mod( 'tickets_wave3_state', 'upcoming' );
          $enabled    = get_theme_mod( 'tickets_wave3_enabled', true );
          $eur_full   = get_theme_mod( 'tickets_wave3_price_eur_full', '141' );
          $eur_short  = get_theme_mod( 'tickets_wave3_price_eur_short', '133' );
          if ( $enabled ) :
            $row_classes = 'ticketRow' . ( 'on_sale' === $state ? '' : ' ticketRow--inactive' );
            ?>
            <div class="<?php echo esc_attr( $row_classes ); ?>">
                <div class="ticketRow_Wave"><h3><span>Pre-sale</span>3rd wave</h3></div>
                <div class="ticketRow_Days"><p>wed - sun <br>fri - sun**</p></div>
                <div class="ticketRow_Price"><p><?php echo esc_html( $eur_full ); ?> &euro;<span>*</span><br><?php echo esc_html( $eur_short ); ?> &euro;<span>*</span></p></div>
                <div class="ticketRow_State"><?php echo esc_html( ufobufo_get_ticket_state_text( $state, 'en' ) ); ?></div>
            </div>
          <?php endif; ?>

          <?php
          // Final wave
          $state      = get_theme_mod( 'tickets_final_state', 'upcoming' );
          $enabled    = get_theme_mod( 'tickets_final_enabled', true );
          $eur_full   = get_theme_mod( 'tickets_final_price_eur_full', '' );
          $eur_short  = get_theme_mod( 'tickets_final_price_eur_short', '' );
          if ( $enabled ) :
            $row_classes = 'ticketRow' . ( 'on_sale' === $state ? '' : ' ticketRow--inactive' );
            ?>
            <div class="<?php echo esc_attr( $row_classes ); ?>">
                <div class="ticketRow_Wave"><h3><span>Pre-sale</span>final wave</h3></div>
                <div class="ticketRow_Days"><p>wed - sun <br>fri - sun**</p></div>
                <div class="ticketRow_Price"><p>
                  <?php
                  if ( '' !== $eur_full ) {
                    echo esc_html( $eur_full ) . ' &euro;<span>*</span>';
                  } else {
                    echo '?? &euro;<span>*</span>';
                  }
                  echo '<br>';
                  if ( '' !== $eur_short ) {
                    echo esc_html( $eur_short ) . ' &euro;<span>*</span>';
                  } else {
                    echo '?? &euro;<span>*</span>';
                  }
                  ?>
                </p></div>
                <div class="ticketRow_State"><?php echo esc_html( ufobufo_get_ticket_state_text( $state, 'en' ) ); ?></div>
            </div>
          <?php endif; ?>

          <p class="legend">
              <br>* plus presale fee 0.4 &euro; per ticket
              <br>** the shorter tickets are valid from 10 am
              <?php 
                /* <br>*** the tickets for each day are valid from/to 10am. It is always necessary to buy the full ticket and in case you wish to leave the festival early, you shall announce such information. When leaving the festival return the wristband and get the price difference back. The days spent are added up - for example if you arrive on Wednesday and leave on Friday before 10 a.m., we count Wednesday + Thursday and you get the rest back upon leaving. */
              ?>
              <br><b>Kids up to 14 years of age: entry free</b>
              <br><b>🚫 Please leave your pets at home, you will NOT be allowed to enter with a pet.</b>
              <br id="parking">
              <br>**** 🅿️ PARKING:
              <?php 
                $parking_text_en = get_theme_mod( 'tickets_parking_text_en', '' );
                if ( $parking_text_en ) {
                  echo '<br>' . wp_kses_post( $parking_text_en );
                }
              ?>
              <br><b>TENT CAMPING:</b>
              <?php 
                $camping_text_en = get_theme_mod( 'tickets_camping_text_en', __( 'We will clarify the prices later, they will be similar to previous years.', 'ufobufo' ) );
                echo '<br>' . wp_kses_post( $camping_text_en );
              ?>
            </p>
  <?php
        }
      } elseif ( 'cs' === $lang ) {
        if ( 'phase_1' === $tickets_phase ) {
          $intro = get_theme_mod( 'tickets_intro_phase_1_cs', '' );
        } elseif ( 'phase_3' === $tickets_phase ) {
          $intro = get_theme_mod( 'tickets_intro_phase_3_cs', '' );
        } else {
          $intro = get_theme_mod( 'tickets_intro_phase_2_cs', '' );
        }

        if ( $intro ) {
          echo '<p>' . wp_kses_post( $intro ) . '</p>';
        }

        if ( $zobrazTabulkuCen ) {
          ?>
            <div class="ticketRow<?php echo get_theme_mod( 'tickets_early_bird_state', 'sold_out' ) === 'on_sale' ? '' : ' ticketRow--inactive'; ?>">
                <div class="ticketRow_Wave"><h3><span>Předprodej</span>Early Bird</h3></div>
                <div class="ticketRow_Days"><p>st - ne</p></div>
                <?php 
                  $czk_full = get_theme_mod( 'tickets_early_bird_price_czk_full', '2000' );
                  $eur_full = get_theme_mod( 'tickets_early_bird_price_eur_full', '83' );
                ?>
                <div class="ticketRow_Price"><p><?php echo esc_html( $czk_full ); ?> Kč<span>*</span></p></div>
                <div class="ticketRow_Price"><p><?php echo esc_html( $eur_full ); ?> &euro;<span>*</span></p></div>
                <div class="ticketRow_State"><?php echo esc_html( ufobufo_get_ticket_state_text( get_theme_mod( 'tickets_early_bird_state', 'sold_out' ), 'cs' ) ); ?></div>
            </div>
            <div class="ticketRow<?php echo get_theme_mod( 'tickets_wave1_state', 'sold_out' ) === 'on_sale' ? '' : ' ticketRow--inactive'; ?>">
                <div class="ticketRow_Wave"><h3><span>Předprodej</span>1. vlna</h3></div>
                <div class="ticketRow_Days"><p>st - ne <br>pá - ne**</p></div>
              <?php 
                $czk_full = get_theme_mod( 'tickets_wave1_price_czk_full', '2400' );
                $czk_short = get_theme_mod( 'tickets_wave1_price_czk_short', '2200' );
                $eur_full = get_theme_mod( 'tickets_wave1_price_eur_full', '103' );
                $eur_short = get_theme_mod( 'tickets_wave1_price_eur_short', '94' );
              ?>
              <div class="ticketRow_Price"><p><?php echo esc_html( $czk_full ); ?> Kč<span>*</span> <br><?php echo esc_html( $czk_short ); ?> Kč<span>*</span></p></div>
                <div class="ticketRow_Price"><p><?php echo esc_html( $eur_full ); ?> &euro;<span>*</span><br><?php echo esc_html( $eur_short ); ?> &euro;<span>*</span></p></div>
                <div class="ticketRow_State"><?php echo esc_html( ufobufo_get_ticket_state_text( get_theme_mod( 'tickets_wave1_state', 'sold_out' ), 'cs' ) ); ?></div>
            </div>
            <div class="ticketRow<?php echo get_theme_mod( 'tickets_wave2_state', 'sold_out' ) === 'on_sale' ? '' : ' ticketRow--inactive'; ?>">
                <div class="ticketRow_Wave"><h3><span>Předprodej</span>2. vlna</h3></div>
                <div class="ticketRow_Days"><p>st - ne <br>pá - ne**</p></div>
              <?php
                $czk_full  = get_theme_mod( 'tickets_wave2_price_czk_full', '2800' );
                $czk_short = get_theme_mod( 'tickets_wave2_price_czk_short', '2600' );
                $eur_full  = get_theme_mod( 'tickets_wave2_price_eur_full', '120' );
                $eur_short = get_theme_mod( 'tickets_wave2_price_eur_short', '111' );
              ?>
                <div class="ticketRow_Price"><p><?php echo esc_html( $czk_full ); ?> Kč<span>*</span> <br><?php echo esc_html( $czk_short ); ?> Kč<span>*</span></p></div>
                <div class="ticketRow_Price"><p><?php echo esc_html( $eur_full ); ?> &euro;<span>*</span><br><?php echo esc_html( $eur_short ); ?> &euro;<span>*</span></p></div>
                <div class="ticketRow_State"><?php echo esc_html( ufobufo_get_ticket_state_text( get_theme_mod( 'tickets_wave2_state', 'sold_out' ), 'cs' ) ); ?></div>
            </div>
            <div class="ticketRow<?php echo get_theme_mod( 'tickets_christmas_state', 'on_sale' ) === 'on_sale' ? '' : ' ticketRow--inactive'; ?>">
                <div class="ticketRow_Wave"><h3><span>Předprodej</span>Vánoční dárková vstupenka</h3></div>
                <div class="ticketRow_Days"><p>st - ne</p></div>
              <?php
                 $czk_full  = get_theme_mod( 'tickets_christmas_price_czk_full', '3000' );
                 $eur_full  = get_theme_mod( 'tickets_christmas_price_eur_full', '128' );
                 $button_url = get_theme_mod( 'tickets_christmas_button_url_cs', 'https://www.book-tickets.cz/ufobufo2026' );
              ?>
                <div class="ticketRow_Price"><p><?php echo esc_html( $czk_full ); ?> Kč<span>*</span></p></div>
                <div class="ticketRow_Price"><p><?php echo esc_html( $eur_full ); ?> &euro;<span>*</span></p></div>
                <div class="ticketRow_State">
                  <?php if ( 'on_sale' === get_theme_mod( 'tickets_christmas_state', 'on_sale' ) && $button_url ) : ?>
                    <a class="button" href="<?php echo esc_url( $button_url ); ?>" target="_blank" title="<?php esc_attr_e( 'Koupit vstupenku na book-tickets.cz', 'ufobufo' ); ?>"><?php esc_html_e( 'Koupit vstupenku', 'ufobufo' ); ?></a>
                  <?php else : ?>
                    <?php echo esc_html( ufobufo_get_ticket_state_text( get_theme_mod( 'tickets_christmas_state', 'on_sale' ), 'cs' ) ); ?>
                  <?php endif; ?>
                </div>
            </div>
            <div class="ticketRow<?php echo get_theme_mod( 'tickets_wave3_state', 'upcoming' ) === 'on_sale' ? '' : ' ticketRow--inactive'; ?>">
                <div class="ticketRow_Wave"><h3><span>Předprodej</span>3. vlna</h3></div>
                <div class="ticketRow_Days"><p>st - ne <br>pá - ne**</p></div>
              <?php
                 $czk_full  = get_theme_mod( 'tickets_wave3_price_czk_full', '3300' );
                 $czk_short = get_theme_mod( 'tickets_wave3_price_czk_short', '3100' );
                 $eur_full  = get_theme_mod( 'tickets_wave3_price_eur_full', '141' );
                 $eur_short = get_theme_mod( 'tickets_wave3_price_eur_short', '133' );
              ?>
                <div class="ticketRow_Price"><p><?php echo esc_html( $czk_full ); ?> Kč<span>*</span> <br><?php echo esc_html( $czk_short ); ?> Kč<span>*</span></p></div>
                <div class="ticketRow_Price"><p><?php echo esc_html( $eur_full ); ?> &euro;<span>*</span> <br><?php echo esc_html( $eur_short ); ?> &euro;<span>*</span></p></div>
                <div class="ticketRow_State"><?php echo esc_html( ufobufo_get_ticket_state_text( get_theme_mod( 'tickets_wave3_state', 'upcoming' ), 'cs' ) ); ?></div>
            </div>
            <div class="ticketRow<?php echo get_theme_mod( 'tickets_final_state', 'upcoming' ) === 'on_sale' ? '' : ' ticketRow--inactive'; ?>">
                <div class="ticketRow_Wave"><h3><span>Předprodej</span>poslední vlna</h3></div>
                <div class="ticketRow_Days"><p>st - ne <br>pá - ne**</p></div>
              <?php
                $czk_full  = get_theme_mod( 'tickets_final_price_czk_full', '' );
                $czk_short = get_theme_mod( 'tickets_final_price_czk_short', '' );
                $eur_full  = get_theme_mod( 'tickets_final_price_eur_full', '' );
                $eur_short = get_theme_mod( 'tickets_final_price_eur_short', '' );
              ?>
                <div class="ticketRow_Price"><p>
                  <?php
                  if ( '' !== $czk_full ) {
                    echo esc_html( $czk_full ) . ' Kč<span>*</span>';
                  } else {
                    echo '?? Kč<span>*</span>';
                  }
                  echo ' <br> ';
                  if ( '' !== $czk_short ) {
                    echo esc_html( $czk_short ) . ' Kč<span>*</span>';
                  } else {
                    echo '?? Kč<span>*</span>';
                  }
                  ?>
                </p></div>
                <div class="ticketRow_Price"><p>
                  <?php
                  if ( '' !== $eur_full ) {
                    echo esc_html( $eur_full ) . ' &euro;<span>*</span>';
                  } else {
                    echo '?? &euro;<span>*</span>';
                  }
                  echo '<br>';
                  if ( '' !== $eur_short ) {
                    echo esc_html( $eur_short ) . ' &euro;<span>*</span>';
                  } else {
                    echo '?? &euro;<span>*</span>';
                  }
                  ?>
                </p></div>
                <div class="ticketRow_State"><?php echo esc_html( ufobufo_get_ticket_state_text( get_theme_mod( 'tickets_final_state', 'upcoming' ), 'cs' ) ); ?></div>
            </div>
            <p class="legend">
                <br>* plus poplatek předprodeje 10 Kč / 0.4EUR za vstupenku
                <br>** platnost kratších vstupenek začíná v 10h dopoledne
                <?php 
                  /*
                  <br>*** platnost vstupenek na jednotlivé dny začíná a končí v 10h dopoledne. Zaplatíte celofestivalovou vstupenku a nahlásíte záměr festival opustit dříve. Poté při včasném odchodu odevzdáte pásku a rozdíl ceny dostanete zpět. Strávené dny se sčítají - pokud přijedete například ve středu a odjedete v pátek před 10h dopoledne, napočítáme vám středu + čtvrtek a zbytek dostáváte na odjezdu zpět.
                  */
                ?>
                <br><b>Děti do 14-ti let: vstup zdarma</b>
                <br><b>ZTP/P i ZTP</b>: vstupenka opravňuje ke vstupu držitele průkazu a jeho 1 doprovod. S touto výhodou nelze využít dřívější odjezd / "jednodenní" vstup, který je k dostání na bráně.
                <br><b>🚫 Domácí mazlíčky nechte doma, s ním NEBUDETE na festival vpuštěni.</b>
                <br id="parking">
                <br>**** 🅿️ PARKING:
                <?php 
                  $parking_text_cs = get_theme_mod( 'tickets_parking_text_cs', '' );
                  if ( $parking_text_cs ) {
                    echo '<br>' . wp_kses_post( $parking_text_cs );
                  }
                ?>
                <br><b>STANOVÁNÍ V KEMPU (bez parkování):</b>
                <?php 
                  $camping_text_cs = get_theme_mod( 'tickets_camping_text_cs', __( 'Ceny ujasníme později, nebudou zásadně odlišné od předchozích let.', 'ufobufo' ) );
                  echo '<br>' . wp_kses_post( $camping_text_cs );
                ?>
              <br><br>Pokud vám zaměstnavatel nabízí <b>benefity</b>, které lze čerpat pro zaplacení kulturní akce <b>fakturou</b>, napište nám na <a href="mailto:tickets@ufobufo.eu">tickets@ufobufo.eu</a> a pošleme vám instrukce.
            </p>
        <?php
          }
        }
        ?>
    </div>
</div>
<script>
document.addEventListener('click', function (e) {
  const btn = e.target.closest('.button');
  if (!btn) return;

  gtag('event', 'ticket_button_click', {
    event_category: 'ticket',
    event_label: btn.textContent.trim(),
    page_location: window.location.href
  });
});
</script>



<?php get_footer(); ?>


