<?php
/**
 * Twenty Sixteen Customizer functionality
 *
 * @package WordPress
 * @subpackage Twenty_Sixteen
 * @since Twenty Sixteen 1.0
 */

/**
 * Sets up the WordPress core custom header and custom background features.
 *
 * @since Twenty Sixteen 1.0
 *
 * @see ufobufo_header_style()
 */
function ufobufo_custom_header_and_background() {
	$color_scheme             = ufobufo_get_color_scheme();
	$default_background_color = trim( $color_scheme[0], '#' );
	$default_text_color       = trim( $color_scheme[3], '#' );

	/**
	 * Filter the arguments used when adding 'custom-background' support in Twenty Sixteen.
	 *
	 * @since Twenty Sixteen 1.0
	 *
	 * @param array $args {
	 *     An array of custom-background support arguments.
	 *
	 *     @type string $default-color Default color of the background.
	 * }
	 */
	add_theme_support( 'custom-background', apply_filters( 'ufobufo_custom_background_args', array(
		'default-color' => $default_background_color,
	) ) );

	/**
	 * Filter the arguments used when adding 'custom-header' support in Twenty Sixteen.
	 *
	 * @since Twenty Sixteen 1.0
	 *
	 * @param array $args {
	 *     An array of custom-header support arguments.
	 *
	 *     @type string $default-text-color Default color of the header text.
	 *     @type int      $width            Width in pixels of the custom header image. Default 1200.
	 *     @type int      $height           Height in pixels of the custom header image. Default 280.
	 *     @type bool     $flex-height      Whether to allow flexible-height header images. Default true.
	 *     @type callable $wp-head-callback Callback function used to style the header image and text
	 *                                      displayed on the blog.
	 * }
	 */
	add_theme_support( 'custom-header', apply_filters( 'ufobufo_custom_header_args', array(
		'default-text-color'     => $default_text_color,
		'width'                  => 1200,
		'height'                 => 280,
		'flex-height'            => true,
		'wp-head-callback'       => 'ufobufo_header_style',
	) ) );
}
add_action( 'after_setup_theme', 'ufobufo_custom_header_and_background' );

if ( ! function_exists( 'ufobufo_header_style' ) ) :
/**
 * Styles the header text displayed on the site.
 *
 * Create your own ufobufo_header_style() function to override in a child theme.
 *
 * @since Twenty Sixteen 1.0
 *
 * @see ufobufo_custom_header_and_background().
 */
function ufobufo_header_style() {
	// If the header text option is untouched, let's bail.
	if ( display_header_text() ) {
		return;
	}

	// If the header text has been hidden.
	?>
	<style type="text/css" id="ufobufo-header-css">
		.site-branding {
			margin: 0 auto 0 0;
		}

		.site-branding .site-title,
		.site-description {
			clip: rect(1px, 1px, 1px, 1px);
			position: absolute;
		}
	</style>
	<?php
}
endif; // ufobufo_header_style

/**
 * Adds postMessage support for site title and description for the Customizer.
 *
 * @since Twenty Sixteen 1.0
 *
 * @param WP_Customize_Manager $wp_customize The Customizer object.
 */
function ufobufo_customize_register( $wp_customize ) {
	$color_scheme = ufobufo_get_color_scheme();

	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';

	if ( isset( $wp_customize->selective_refresh ) ) {
		$wp_customize->selective_refresh->add_partial( 'blogname', array(
			'selector' => '.site-title a',
			'container_inclusive' => false,
			'render_callback' => 'ufobufo_customize_partial_blogname',
		) );
		$wp_customize->selective_refresh->add_partial( 'blogdescription', array(
			'selector' => '.site-description',
			'container_inclusive' => false,
			'render_callback' => 'ufobufo_customize_partial_blogdescription',
		) );
	}

	// Add color scheme setting and control.
	$wp_customize->add_setting( 'color_scheme', array(
		'default'           => 'default',
		'sanitize_callback' => 'ufobufo_sanitize_color_scheme',
		'transport'         => 'postMessage',
	) );

	$wp_customize->add_control( 'color_scheme', array(
		'label'    => __( 'Základní barevné schéma', 'ufobufo' ),
		'section'  => 'colors',
		'type'     => 'select',
		'choices'  => ufobufo_get_color_scheme_choices(),
		'priority' => 1,
	) );

	// Add page background color setting and control.
	$wp_customize->add_setting( 'page_background_color', array(
		'default'           => $color_scheme[1],
		'sanitize_callback' => 'sanitize_hex_color',
		'transport'         => 'postMessage',
	) );

	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'page_background_color', array(
		'label'       => __( 'Barva pozadí stránky', 'ufobufo' ),
		'section'     => 'colors',
	) ) );

	// Remove the core header textcolor control, as it shares the main text color.
	$wp_customize->remove_control( 'header_textcolor' );

	// Add link color setting and control.
	$wp_customize->add_setting( 'link_color', array(
		'default'           => $color_scheme[2],
		'sanitize_callback' => 'sanitize_hex_color',
		'transport'         => 'postMessage',
	) );

	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'link_color', array(
		'label'       => __( 'Barva odkazů', 'ufobufo' ),
		'section'     => 'colors',
	) ) );

	// Add main text color setting and control.
	$wp_customize->add_setting( 'main_text_color', array(
		'default'           => $color_scheme[3],
		'sanitize_callback' => 'sanitize_hex_color',
		'transport'         => 'postMessage',
	) );

	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'main_text_color', array(
		'label'       => __( 'Barva hlavního textu', 'ufobufo' ),
		'section'     => 'colors',
	) ) );

	// Add secondary text color setting and control.
	$wp_customize->add_setting( 'secondary_text_color', array(
		'default'           => $color_scheme[4],
		'sanitize_callback' => 'sanitize_hex_color',
		'transport'         => 'postMessage',
	) );

	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'secondary_text_color', array(
		'label'       => __( 'Barva sekundárního textu', 'ufobufo' ),
		'section'     => 'colors',
	) ) );

	// Add Festival Settings section
	$wp_customize->add_section( 'festival_settings', array(
		'title'    => __( 'Nastavení festivalu', 'ufobufo' ),
		'priority' => 30,
	) );

	// Festival Phase Management
	$wp_customize->add_setting( 'festival_phase', array(
		'default'           => 'phase_4',
		'sanitize_callback' => 'ufobufo_sanitize_festival_phase',
	) );

	$wp_customize->add_control( 'festival_phase', array(
		'label'       => __( 'Fáze festivalu', 'ufobufo' ),
		'description' => __( 'Určuje, jaký obsah se na webu zobrazuje v různých fázích příprav festivalu.', 'ufobufo' ),
		'section'     => 'festival_settings',
		'type'        => 'select',
		'choices'     => array(
			'phase_1' => __( 'Fáze 1: Po festivalu (zobrazit předchozí ročník)', 'ufobufo' ),
			'phase_2' => __( 'Fáze 2: Oznámené nové datum (aktualizují se pouze data)', 'ufobufo' ),
			'phase_3' => __( 'Fáze 3: První potvrzení interpreti (skrýt starý lineup, zobrazit text „Další vystupující později“)', 'ufobufo' ),
			'phase_4' => __( 'Fáze 4: Kompletní lineup (skrýt text „Další vystupující později“)', 'ufobufo' ),
		),
	) );

	// Festival event start date (used for homepage date range)
	$wp_customize->add_setting( 'festival_event_start_date', array(
		'default'           => '',
		'sanitize_callback' => 'ufobufo_sanitize_date',
	) );

	$wp_customize->add_control( 'festival_event_start_date', array(
		'label'       => __( 'Datum začátku festivalu', 'ufobufo' ),
		'description' => __( 'První den festivalu (používá se pro text s rozsahem dat).', 'ufobufo' ),
		'section'     => 'festival_settings',
		'type'        => 'date',
	) );

	// Festival event end date (used for homepage date range)
	$wp_customize->add_setting( 'festival_event_end_date', array(
		'default'           => '',
		'sanitize_callback' => 'ufobufo_sanitize_date',
	) );

	$wp_customize->add_control( 'festival_event_end_date', array(
		'label'       => __( 'Datum konce festivalu', 'ufobufo' ),
		'description' => __( 'Poslední den festivalu (používá se pro text s rozsahem dat).', 'ufobufo' ),
		'section'     => 'festival_settings',
		'type'        => 'date',
	) );

	// Facebook event URL (per edition)
	$wp_customize->add_setting( 'festival_facebook_event_url', array(
		'default'           => '',
		'sanitize_callback' => 'esc_url_raw',
	) );

	$wp_customize->add_control( 'festival_facebook_event_url', array(
		'label'       => __( 'Odkaz na Facebook událost', 'ufobufo' ),
		'description' => __( 'URL aktuální Facebook události festivalu. Zobrazuje se v patičce webu.', 'ufobufo' ),
		'section'     => 'festival_settings',
		'type'        => 'url',
	) );

	// Default lineup year for the Program page
	$wp_customize->add_setting( 'festival_lineup_years', array(
		'default'           => date( 'Y' ),
		'sanitize_callback' => 'sanitize_text_field',
	) );

	$wp_customize->add_control( 'festival_lineup_years', array(
		'label'       => __( 'Program zobrazuje rok', 'ufobufo' ),
		'description' => __( 'Rok, jehož lineup se standardně zobrazuje na stránce Program, např. „2025“.', 'ufobufo' ),
		'section'     => 'festival_settings',
		'type'        => 'text',
	) );

	// Homepage headline texts (moved from ACF)

	// Welcome text
	$wp_customize->add_setting( 'festival_home_welcome_text_cs', array(
		'default'           => '',
		'sanitize_callback' => 'sanitize_textarea_field',
	) );
	$wp_customize->add_setting( 'festival_home_welcome_text_en', array(
		'default'           => '',
		'sanitize_callback' => 'sanitize_textarea_field',
	) );

	$wp_customize->add_control( 'festival_home_welcome_text_cs', array(
		'label'       => __( 'Homepage – uvítací text (CS)', 'ufobufo' ),
		'description' => __( 'Krátká uvítací věta nad hlavním festivalovým textem (česky).', 'ufobufo' ),
		'section'     => 'festival_settings',
		'type'        => 'textarea',
	) );
	$wp_customize->add_control( 'festival_home_welcome_text_en', array(
		'label'       => __( 'Homepage – uvítací text (EN)', 'ufobufo' ),
		'description' => __( 'Krátká uvítací věta nad hlavním festivalovým textem (anglicky).', 'ufobufo' ),
		'section'     => 'festival_settings',
		'type'        => 'textarea',
	) );

	// Main festival text
	$wp_customize->add_setting( 'festival_home_text_cs', array(
		'default'           => '',
		'sanitize_callback' => 'sanitize_textarea_field',
	) );
	$wp_customize->add_setting( 'festival_home_text_en', array(
		'default'           => '',
		'sanitize_callback' => 'sanitize_textarea_field',
	) );

	$wp_customize->add_control( 'festival_home_text_cs', array(
		'label'       => __( 'Homepage – hlavní festivalový text (CS)', 'ufobufo' ),
		'description' => __( 'Hlavní popisný text pod uvítacím řádkem (česky).', 'ufobufo' ),
		'section'     => 'festival_settings',
		'type'        => 'textarea',
	) );
	$wp_customize->add_control( 'festival_home_text_en', array(
		'label'       => __( 'Homepage – hlavní festivalový text (EN)', 'ufobufo' ),
		'description' => __( 'Hlavní popisný text pod uvítacím řádkem (anglicky).', 'ufobufo' ),
		'section'     => 'festival_settings',
		'type'        => 'textarea',
	) );

	// Festival name
	$wp_customize->add_setting( 'festival_home_name_cs', array(
		'default'           => '',
		'sanitize_callback' => 'sanitize_text_field',
	) );
	$wp_customize->add_setting( 'festival_home_name_en', array(
		'default'           => '',
		'sanitize_callback' => 'sanitize_text_field',
	) );

	$wp_customize->add_control( 'festival_home_name_cs', array(
		'label'       => __( 'Homepage – název festivalu (CS)', 'ufobufo' ),
		'description' => __( 'Název festivalu zobrazený v hlavním nadpisu H1 (česky).', 'ufobufo' ),
		'section'     => 'festival_settings',
		'type'        => 'text',
	) );
	$wp_customize->add_control( 'festival_home_name_en', array(
		'label'       => __( 'Homepage – název festivalu (EN)', 'ufobufo' ),
		'description' => __( 'Název festivalu zobrazený v hlavním nadpisu H1 (anglicky).', 'ufobufo' ),
		'section'     => 'festival_settings',
		'type'        => 'text',
	) );

	// Festival location
	$wp_customize->add_setting( 'festival_home_location_cs', array(
		'default'           => '',
		'sanitize_callback' => 'sanitize_text_field',
	) );
	$wp_customize->add_setting( 'festival_home_location_en', array(
		'default'           => '',
		'sanitize_callback' => 'sanitize_text_field',
	) );

	$wp_customize->add_control( 'festival_home_location_cs', array(
		'label'       => __( 'Homepage – lokalita (CS)', 'ufobufo' ),
		'description' => __( 'Text s místem konání festivalu pod datem (česky).', 'ufobufo' ),
		'section'     => 'festival_settings',
		'type'        => 'text',
	) );
	$wp_customize->add_control( 'festival_home_location_en', array(
		'label'       => __( 'Homepage – lokalita (EN)', 'ufobufo' ),
		'description' => __( 'Text s místem konání festivalu pod datem (anglicky).', 'ufobufo' ),
		'section'     => 'festival_settings',
		'type'        => 'text',
	) );

	// Tickets & Pricing section
	$wp_customize->add_section( 'tickets_settings', array(
		'title'    => __( 'Vstupenky a ceny', 'ufobufo' ),
		'priority' => 35,
	) );

	// Tickets phase (independent of festival_phase)
	$wp_customize->add_setting( 'tickets_phase', array(
		'default'           => 'phase_2',
		'sanitize_callback' => 'ufobufo_sanitize_tickets_phase',
	) );

	$wp_customize->add_control( 'tickets_phase', array(
		'label'       => __( 'Fáze prodeje vstupenek', 'ufobufo' ),
		'description' => __( 'Řídí viditelnost a texty na stránce Vstupenky.', 'ufobufo' ),
		'section'     => 'tickets_settings',
		'type'        => 'select',
		'choices'     => array(
			'phase_1' => __( 'Fáze 1: Vstupenky zatím nejsou v prodeji', 'ufobufo' ),
			'phase_2' => __( 'Fáze 2: Předprodej – tabulka vln', 'ufobufo' ),
			'phase_3' => __( 'Fáze 3: Předprodej vyprodán – prodej jen na místě', 'ufobufo' ),
		),
	) );

	// Intro messages per phase & language
	// Phase 1 – tickets not available yet
	$wp_customize->add_setting( 'tickets_intro_phase_1_cs', array(
		'default'           => __( 'Vstupenky na UFO BUFO budou k dispozici později. Sledujte náš web a sociální sítě pro více informací.', 'ufobufo' ),
		'sanitize_callback' => 'wp_kses_post',
	) );
	$wp_customize->add_setting( 'tickets_intro_phase_1_en', array(
		'default'           => __( 'Tickets for UFO BUFO will be available later. Follow our website and social media for more information.', 'ufobufo' ),
		'sanitize_callback' => 'wp_kses_post',
	) );

	$wp_customize->add_control( 'tickets_intro_phase_1_cs', array(
		'label'       => __( 'Fáze 1 – úvodní text (CS)', 'ufobufo' ),
		'description' => __( 'Zobrazuje se na stránce Vstupenky, když vstupenky ještě nejsou v prodeji (česky).', 'ufobufo' ),
		'section'     => 'tickets_settings',
		'type'        => 'textarea',
	) );
	$wp_customize->add_control( 'tickets_intro_phase_1_en', array(
		'label'       => __( 'Fáze 1 – úvodní text (EN)', 'ufobufo' ),
		'description' => __( 'Zobrazuje se na stránce Vstupenky, když vstupenky ještě nejsou v prodeji (anglicky).', 'ufobufo' ),
		'section'     => 'tickets_settings',
		'type'        => 'textarea',
	) );

	// Phase 2 – presale waves with BookTickets info
	$wp_customize->add_setting( 'tickets_intro_phase_2_cs', array(
		'default'           => __( 'Jediným oficiálním zdrojem vstupenek je služba <a href="https://www.book-tickets.cz/ufobufo2026" target="_blank">Book Tickets</a>. Prosíme to mít na vědomí, pokud narazíte na nabídku z jiného zdroje. <br><b>Na festivalu zaplatíte jen v hotovosti.</b> Žádný signál = žádná platba kartou. EUR přijímáme, ale vracíme v Kč. Nejbližší bankomat je ve Vítkově (8km).', 'ufobufo' ),
		'sanitize_callback' => 'wp_kses_post',
	) );
	$wp_customize->add_setting( 'tickets_intro_phase_2_en', array(
		'default'           => __( 'The only official seller of tickets is <a href="https://www.book-tickets.cz/ufobufo2026" target="_blank">Book Tickets</a> service. Please keep that in mind if you get offer from any other source. <br><b>Festival is cash only!</b> No signal = no card payment. We accept EUR but return in CZK. The nearest ATM is in Vítkov (8km).', 'ufobufo' ),
		'sanitize_callback' => 'wp_kses_post',
	) );

	$wp_customize->add_control( 'tickets_intro_phase_2_cs', array(
		'label'       => __( 'Fáze 2 – úvodní text (CS)', 'ufobufo' ),
		'description' => __( 'Zobrazuje se na stránce Vstupenky během předprodeje (česky).', 'ufobufo' ),
		'section'     => 'tickets_settings',
		'type'        => 'textarea',
	) );
	$wp_customize->add_control( 'tickets_intro_phase_2_en', array(
		'label'       => __( 'Fáze 2 – úvodní text (EN)', 'ufobufo' ),
		'description' => __( 'Zobrazuje se na stránce Vstupenky během předprodeje (anglicky).', 'ufobufo' ),
		'section'     => 'tickets_settings',
		'type'        => 'textarea',
	) );

	// Phase 3 – presale sold out, gate only
	$wp_customize->add_setting( 'tickets_intro_phase_3_cs', array(
		'default'           => __( 'Předprodej vstupenek je vyprodán. Omezený počet vstupenek bude k dispozici pouze na bráně (jen hotově).', 'ufobufo' ),
		'sanitize_callback' => 'wp_kses_post',
	) );
	$wp_customize->add_setting( 'tickets_intro_phase_3_en', array(
		'default'           => __( 'Presale tickets are sold out. A limited amount of tickets will be available only at the festival gate (cash only).', 'ufobufo' ),
		'sanitize_callback' => 'wp_kses_post',
	) );

	$wp_customize->add_control( 'tickets_intro_phase_3_cs', array(
		'label'       => __( 'Fáze 3 – úvodní text (CS)', 'ufobufo' ),
		'description' => __( 'Zobrazuje se na stránce Vstupenky, když je předprodej vyprodán a prodej je jen na místě (česky).', 'ufobufo' ),
		'section'     => 'tickets_settings',
		'type'        => 'textarea',
	) );
	$wp_customize->add_control( 'tickets_intro_phase_3_en', array(
		'label'       => __( 'Fáze 3 – úvodní text (EN)', 'ufobufo' ),
		'description' => __( 'Zobrazuje se na stránce Vstupenky, když je předprodej vyprodán a prodej je jen na místě (anglicky).', 'ufobufo' ),
		'section'     => 'tickets_settings',
		'type'        => 'textarea',
	) );

	// Fixed presale waves – Early Bird, 1st wave, 2nd wave, Christmas gift, 3rd wave, final wave
	$waves = array(
		'early_bird' => array(
			'label' => __( 'Early Bird', 'ufobufo' ),
			'default_state' => 'sold_out',
			'default_czk_full' => '2000',
			'default_eur_full' => '83',
		),
		'wave1' => array(
			'label' => __( '1st wave', 'ufobufo' ),
			'default_state' => 'sold_out',
			'default_czk_full' => '2400',
			'default_czk_short' => '2200',
			'default_eur_full' => '103',
			'default_eur_short' => '94',
		),
		'wave2' => array(
			'label' => __( '2nd wave', 'ufobufo' ),
			'default_state' => 'sold_out',
			'default_czk_full' => '2800',
			'default_czk_short' => '2600',
			'default_eur_full' => '120',
			'default_eur_short' => '111',
		),
		'christmas' => array(
			'label' => __( 'Christmas gift ticket', 'ufobufo' ),
			'default_state' => 'on_sale',
			'default_czk_full' => '3000',
			'default_eur_full' => '128',
		),
		'wave3' => array(
			'label' => __( '3rd wave', 'ufobufo' ),
			'default_state' => 'upcoming',
			'default_czk_full' => '3300',
			'default_czk_short' => '3100',
			'default_eur_full' => '141',
			'default_eur_short' => '133',
		),
		'final' => array(
			'label' => __( 'Final wave', 'ufobufo' ),
			'default_state' => 'upcoming',
		),
	);

	foreach ( $waves as $wave_key => $wave_config ) {
		$wave_setting_prefix = 'tickets_' . $wave_key;

		// Enable / disable whole row
		$wp_customize->add_setting( $wave_setting_prefix . '_enabled', array(
			'default'           => true,
			'sanitize_callback' => 'ufobufo_sanitize_checkbox',
		) );
		$wp_customize->add_control( $wave_setting_prefix . '_enabled', array(
			'label'   => sprintf( __( '%s: zobrazit řádek', 'ufobufo' ), $wave_config['label'] ),
			'section' => 'tickets_settings',
			'type'    => 'checkbox',
		) );

		// Wave state
		$wp_customize->add_setting( $wave_setting_prefix . '_state', array(
			'default'           => isset( $wave_config['default_state'] ) ? $wave_config['default_state'] : 'upcoming',
			'sanitize_callback' => 'ufobufo_sanitize_ticket_state',
		) );
		$wp_customize->add_control( $wave_setting_prefix . '_state', array(
			'label'       => sprintf( __( '%s: stav', 'ufobufo' ), $wave_config['label'] ),
			'description' => __( '„On sale“ zobrazí tlačítko Koupit, pokud je vyplněná URL; „Sold out“ řádek vysiví; „Upcoming“ ponechá řádek neaktivní.', 'ufobufo' ),
			'section'     => 'tickets_settings',
			'type'        => 'select',
			'choices'     => array(
				'upcoming' => __( 'Připravujeme / zatím nedostupné', 'ufobufo' ),
				'on_sale'  => __( 'V prodeji', 'ufobufo' ),
				'sold_out' => __( 'Vyprodáno', 'ufobufo' ),
			),
		) );

		// Prices – CZK full / short
		$wp_customize->add_setting( $wave_setting_prefix . '_price_czk_full', array(
			'default'           => isset( $wave_config['default_czk_full'] ) ? $wave_config['default_czk_full'] : '',
			'sanitize_callback' => 'sanitize_text_field',
		) );
		$wp_customize->add_setting( $wave_setting_prefix . '_price_czk_short', array(
			'default'           => isset( $wave_config['default_czk_short'] ) ? $wave_config['default_czk_short'] : '',
			'sanitize_callback' => 'sanitize_text_field',
		) );

		$wp_customize->add_control( $wave_setting_prefix . '_price_czk_full', array(
			'label'       => sprintf( __( '%s: cena CZK (celý festival)', 'ufobufo' ), $wave_config['label'] ),
			'section'     => 'tickets_settings',
			'type'        => 'text',
		) );
		$wp_customize->add_control( $wave_setting_prefix . '_price_czk_short', array(
			'label'       => sprintf( __( '%s: cena CZK (zkrácená vstupenka)', 'ufobufo' ), $wave_config['label'] ),
			'section'     => 'tickets_settings',
			'type'        => 'text',
		) );

		// Prices – EUR full / short (shared between CS and EN mutations)
		$wp_customize->add_setting( $wave_setting_prefix . '_price_eur_full', array(
			'default'           => isset( $wave_config['default_eur_full'] ) ? $wave_config['default_eur_full'] : '',
			'sanitize_callback' => 'sanitize_text_field',
		) );
		$wp_customize->add_setting( $wave_setting_prefix . '_price_eur_short', array(
			'default'           => isset( $wave_config['default_eur_short'] ) ? $wave_config['default_eur_short'] : '',
			'sanitize_callback' => 'sanitize_text_field',
		) );

		$wp_customize->add_control( $wave_setting_prefix . '_price_eur_full', array(
			'label'       => sprintf( __( '%s: cena EUR (celý festival)', 'ufobufo' ), $wave_config['label'] ),
			'section'     => 'tickets_settings',
			'type'        => 'text',
		) );
		$wp_customize->add_control( $wave_setting_prefix . '_price_eur_short', array(
			'label'       => sprintf( __( '%s: cena EUR (zkrácená vstupenka)', 'ufobufo' ), $wave_config['label'] ),
			'section'     => 'tickets_settings',
			'type'        => 'text',
		) );

		// Optional Buy button URLs per language
		$wp_customize->add_setting( $wave_setting_prefix . '_button_url_cs', array(
			'default'           => ( 'christmas' === $wave_key ) ? 'https://www.book-tickets.cz/ufobufo2026' : '',
			'sanitize_callback' => 'esc_url_raw',
		) );
		$wp_customize->add_setting( $wave_setting_prefix . '_button_url_en', array(
			'default'           => ( 'christmas' === $wave_key ) ? 'https://www.book-tickets.cz/index.php?page=bookticket&event=159&lang=en&currency=EUR' : '',
			'sanitize_callback' => 'esc_url_raw',
		) );

		$wp_customize->add_control( $wave_setting_prefix . '_button_url_cs', array(
			'label'       => sprintf( __( '%s: BookTickets URL (CS)', 'ufobufo' ), $wave_config['label'] ),
			'section'     => 'tickets_settings',
			'type'        => 'url',
		) );
		$wp_customize->add_control( $wave_setting_prefix . '_button_url_en', array(
			'label'       => sprintf( __( '%s: BookTickets URL (EN)', 'ufobufo' ), $wave_config['label'] ),
			'section'     => 'tickets_settings',
			'type'        => 'url',
		) );
	}

	// Camping & parking legend text (per language)
	$wp_customize->add_setting( 'tickets_parking_text_cs', array(
		'default'           => '',
		'sanitize_callback' => 'wp_kses_post',
	) );
	$wp_customize->add_setting( 'tickets_parking_text_en', array(
		'default'           => '',
		'sanitize_callback' => 'wp_kses_post',
	) );

	$wp_customize->add_control( 'tickets_parking_text_cs', array(
		'label'       => __( 'Text k parkování (CS)', 'ufobufo' ),
		'description' => __( 'Doplňkový text k legendě parkování, povolené je základní HTML (česky).', 'ufobufo' ),
		'section'     => 'tickets_settings',
		'type'        => 'textarea',
	) );
	$wp_customize->add_control( 'tickets_parking_text_en', array(
		'label'       => __( 'Text k parkování (EN)', 'ufobufo' ),
		'description' => __( 'Doplňkový text k legendě parkování, povolené je základní HTML (anglicky).', 'ufobufo' ),
		'section'     => 'tickets_settings',
		'type'        => 'textarea',
	) );

	$wp_customize->add_setting( 'tickets_camping_text_cs', array(
		'default'           => __( 'Ceny ujasníme později, nebudou zásadně odlišné od předchozích let.', 'ufobufo' ),
		'sanitize_callback' => 'wp_kses_post',
	) );
	$wp_customize->add_setting( 'tickets_camping_text_en', array(
		'default'           => __( 'We will clarify the prices later, they will be similar to previous years.', 'ufobufo' ),
		'sanitize_callback' => 'wp_kses_post',
	) );

	$wp_customize->add_control( 'tickets_camping_text_cs', array(
		'label'       => __( 'Text ke stanovánÍ (CS)', 'ufobufo' ),
		'description' => __( 'Text pod řádkem „STANOVÁNÍ V KEMPU“ / „TENT CAMPING“ (česky).', 'ufobufo' ),
		'section'     => 'tickets_settings',
		'type'        => 'textarea',
	) );
	$wp_customize->add_control( 'tickets_camping_text_en', array(
		'label'       => __( 'Text ke stanovánÍ (EN)', 'ufobufo' ),
		'description' => __( 'Text pod řádkem „STANOVÁNÍ V KEMPU“ / „TENT CAMPING“ (anglicky).', 'ufobufo' ),
		'section'     => 'tickets_settings',
		'type'        => 'textarea',
	) );
}
add_action( 'customize_register', 'ufobufo_customize_register', 11 );

/**
 * Render the site title for the selective refresh partial.
 *
 * @since Twenty Sixteen 1.2
 * @see ufobufo_customize_register()
 *
 * @return void
 */
function ufobufo_customize_partial_blogname() {
	bloginfo( 'name' );
}

/**
 * Render the site tagline for the selective refresh partial.
 *
 * @since Twenty Sixteen 1.2
 * @see ufobufo_customize_register()
 *
 * @return void
 */
function ufobufo_customize_partial_blogdescription() {
	bloginfo( 'description' );
}

/**
 * Registers color schemes for Twenty Sixteen.
 *
 * Can be filtered with {@see 'ufobufo_color_schemes'}.
 *
 * The order of colors in a colors array:
 * 1. Main Background Color.
 * 2. Page Background Color.
 * 3. Link Color.
 * 4. Main Text Color.
 * 5. Secondary Text Color.
 *
 * @since Twenty Sixteen 1.0
 *
 * @return array An associative array of color scheme options.
 */
function ufobufo_get_color_schemes() {
	/**
	 * Filter the color schemes registered for use with Twenty Sixteen.
	 *
	 * The default schemes include 'default', 'dark', 'gray', 'red', and 'yellow'.
	 *
	 * @since Twenty Sixteen 1.0
	 *
	 * @param array $schemes {
	 *     Associative array of color schemes data.
	 *
	 *     @type array $slug {
	 *         Associative array of information for setting up the color scheme.
	 *
	 *         @type string $label  Color scheme label.
	 *         @type array  $colors HEX codes for default colors prepended with a hash symbol ('#').
	 *                              Colors are defined in the following order: Main background, page
	 *                              background, link, main text, secondary text.
	 *     }
	 * }
	 */
	return apply_filters( 'ufobufo_color_schemes', array(
		'default' => array(
			'label'  => __( 'Default', 'ufobufo' ),
			'colors' => array(
				'#1a1a1a',
				'#ffffff',
				'#007acc',
				'#1a1a1a',
				'#686868',
			),
		),
		'dark' => array(
			'label'  => __( 'Dark', 'ufobufo' ),
			'colors' => array(
				'#262626',
				'#1a1a1a',
				'#9adffd',
				'#e5e5e5',
				'#c1c1c1',
			),
		),
		'gray' => array(
			'label'  => __( 'Gray', 'ufobufo' ),
			'colors' => array(
				'#616a73',
				'#4d545c',
				'#c7c7c7',
				'#f2f2f2',
				'#f2f2f2',
			),
		),
		'red' => array(
			'label'  => __( 'Red', 'ufobufo' ),
			'colors' => array(
				'#ffffff',
				'#ff675f',
				'#640c1f',
				'#402b30',
				'#402b30',
			),
		),
		'yellow' => array(
			'label'  => __( 'Yellow', 'ufobufo' ),
			'colors' => array(
				'#3b3721',
				'#ffef8e',
				'#774e24',
				'#3b3721',
				'#5b4d3e',
			),
		),
	) );
}

if ( ! function_exists( 'ufobufo_get_color_scheme' ) ) :
/**
 * Retrieves the current Twenty Sixteen color scheme.
 *
 * Create your own ufobufo_get_color_scheme() function to override in a child theme.
 *
 * @since Twenty Sixteen 1.0
 *
 * @return array An associative array of either the current or default color scheme HEX values.
 */
function ufobufo_get_color_scheme() {
	$color_scheme_option = get_theme_mod( 'color_scheme', 'default' );
	$color_schemes       = ufobufo_get_color_schemes();

	if ( array_key_exists( $color_scheme_option, $color_schemes ) ) {
		return $color_schemes[ $color_scheme_option ]['colors'];
	}

	return $color_schemes['default']['colors'];
}
endif; // ufobufo_get_color_scheme

if ( ! function_exists( 'ufobufo_get_color_scheme_choices' ) ) :
/**
 * Retrieves an array of color scheme choices registered for Twenty Sixteen.
 *
 * Create your own ufobufo_get_color_scheme_choices() function to override
 * in a child theme.
 *
 * @since Twenty Sixteen 1.0
 *
 * @return array Array of color schemes.
 */
function ufobufo_get_color_scheme_choices() {
	$color_schemes                = ufobufo_get_color_schemes();
	$color_scheme_control_options = array();

	foreach ( $color_schemes as $color_scheme => $value ) {
		$color_scheme_control_options[ $color_scheme ] = $value['label'];
	}

	return $color_scheme_control_options;
}
endif; // ufobufo_get_color_scheme_choices


if ( ! function_exists( 'ufobufo_sanitize_color_scheme' ) ) :
/**
 * Handles sanitization for Twenty Sixteen color schemes.
 *
 * Create your own ufobufo_sanitize_color_scheme() function to override
 * in a child theme.
 *
 * @since Twenty Sixteen 1.0
 *
 * @param string $value Color scheme name value.
 * @return string Color scheme name.
 */
function ufobufo_sanitize_color_scheme( $value ) {
	$color_schemes = ufobufo_get_color_scheme_choices();

	if ( ! array_key_exists( $value, $color_schemes ) ) {
		return 'default';
	}

	return $value;
}
endif; // ufobufo_sanitize_color_scheme

/**
 * Enqueues front-end CSS for color scheme.
 *
 * @since Twenty Sixteen 1.0
 *
 * @see wp_add_inline_style()
 */
function ufobufo_color_scheme_css() {
	$color_scheme_option = get_theme_mod( 'color_scheme', 'default' );

	// Don't do anything if the default color scheme is selected.
	if ( 'default' === $color_scheme_option ) {
		return;
	}

	$color_scheme = ufobufo_get_color_scheme();

	// Convert main text hex color to rgba.
	$color_textcolor_rgb = ufobufo_hex2rgb( $color_scheme[3] );

	// If the rgba values are empty return early.
	if ( empty( $color_textcolor_rgb ) ) {
		return;
	}

	// If we get this far, we have a custom color scheme.
	$colors = array(
		'background_color'      => $color_scheme[0],
		'page_background_color' => $color_scheme[1],
		'link_color'            => $color_scheme[2],
		'main_text_color'       => $color_scheme[3],
		'secondary_text_color'  => $color_scheme[4],
		'border_color'          => vsprintf( 'rgba( %1$s, %2$s, %3$s, 0.2)', $color_textcolor_rgb ),

	);

	$color_scheme_css = ufobufo_get_color_scheme_css( $colors );

	wp_add_inline_style( 'ufobufo-style', $color_scheme_css );
}
add_action( 'wp_enqueue_scripts', 'ufobufo_color_scheme_css' );

// Legacy Customizer JS (color scheme controls + preview) removed.
// We no longer load non-existent js/color-scheme-control.js or js/customize-preview.js
// to avoid 404s in the Customizer.

/**
 * Returns CSS for the color schemes.
 *
 * @since Twenty Sixteen 1.0
 *
 * @param array $colors Color scheme colors.
 * @return string Color scheme CSS.
 */
function ufobufo_get_color_scheme_css( $colors ) {
	$colors = wp_parse_args( $colors, array(
		'background_color'      => '',
		'page_background_color' => '',
		'link_color'            => '',
		'main_text_color'       => '',
		'secondary_text_color'  => '',
		'border_color'          => '',
	) );

	return <<<CSS
	/* Color Scheme */

	/* Background Color */
	body {
		background-color: {$colors['background_color']};
	}

	/* Page Background Color */
	.site {
		background-color: {$colors['page_background_color']};
	}

	mark,
	ins,
	button,
	button[disabled]:hover,
	button[disabled]:focus,
	input[type="button"],
	input[type="button"][disabled]:hover,
	input[type="button"][disabled]:focus,
	input[type="reset"],
	input[type="reset"][disabled]:hover,
	input[type="reset"][disabled]:focus,
	input[type="submit"],
	input[type="submit"][disabled]:hover,
	input[type="submit"][disabled]:focus,
	.menu-toggle.toggled-on,
	.menu-toggle.toggled-on:hover,
	.menu-toggle.toggled-on:focus,
	.pagination .prev,
	.pagination .next,
	.pagination .prev:hover,
	.pagination .prev:focus,
	.pagination .next:hover,
	.pagination .next:focus,
	.pagination .nav-links:before,
	.pagination .nav-links:after,
	.widget_calendar tbody a,
	.widget_calendar tbody a:hover,
	.widget_calendar tbody a:focus,
	.page-links a,
	.page-links a:hover,
	.page-links a:focus {
		color: {$colors['page_background_color']};
	}

	/* Link Color */
	.menu-toggle:hover,
	.menu-toggle:focus,
	a,
	.main-navigation a:hover,
	.main-navigation a:focus,
	.dropdown-toggle:hover,
	.dropdown-toggle:focus,
	.social-navigation a:hover:before,
	.social-navigation a:focus:before,
	.post-navigation a:hover .post-title,
	.post-navigation a:focus .post-title,
	.tagcloud a:hover,
	.tagcloud a:focus,
	.site-branding .site-title a:hover,
	.site-branding .site-title a:focus,
	.entry-title a:hover,
	.entry-title a:focus,
	.entry-footer a:hover,
	.entry-footer a:focus,
	.comment-metadata a:hover,
	.comment-metadata a:focus,
	.pingback .comment-edit-link:hover,
	.pingback .comment-edit-link:focus,
	.comment-reply-link,
	.comment-reply-link:hover,
	.comment-reply-link:focus,
	.required,
	.site-info a:hover,
	.site-info a:focus {
		color: {$colors['link_color']};
	}

	mark,
	ins,
	button:hover,
	button:focus,
	input[type="button"]:hover,
	input[type="button"]:focus,
	input[type="reset"]:hover,
	input[type="reset"]:focus,
	input[type="submit"]:hover,
	input[type="submit"]:focus,
	.pagination .prev:hover,
	.pagination .prev:focus,
	.pagination .next:hover,
	.pagination .next:focus,
	.widget_calendar tbody a,
	.page-links a:hover,
	.page-links a:focus {
		background-color: {$colors['link_color']};
	}

	input[type="date"]:focus,
	input[type="time"]:focus,
	input[type="datetime-local"]:focus,
	input[type="week"]:focus,
	input[type="month"]:focus,
	input[type="text"]:focus,
	input[type="email"]:focus,
	input[type="url"]:focus,
	input[type="password"]:focus,
	input[type="search"]:focus,
	input[type="tel"]:focus,
	input[type="number"]:focus,
	textarea:focus,
	.tagcloud a:hover,
	.tagcloud a:focus,
	.menu-toggle:hover,
	.menu-toggle:focus {
		border-color: {$colors['link_color']};
	}

	/* Main Text Color */
	body,
	blockquote cite,
	blockquote small,
	.main-navigation a,
	.menu-toggle,
	.dropdown-toggle,
	.social-navigation a,
	.post-navigation a,
	.pagination a:hover,
	.pagination a:focus,
	.widget-title a,
	.site-branding .site-title a,
	.entry-title a,
	.page-links > .page-links-title,
	.comment-author,
	.comment-reply-title small a:hover,
	.comment-reply-title small a:focus {
		color: {$colors['main_text_color']};
	}

	blockquote,
	.menu-toggle.toggled-on,
	.menu-toggle.toggled-on:hover,
	.menu-toggle.toggled-on:focus,
	.post-navigation,
	.post-navigation div + div,
	.pagination,
	.widget,
	.page-header,
	.page-links a,
	.comments-title,
	.comment-reply-title {
		border-color: {$colors['main_text_color']};
	}

	button,
	button[disabled]:hover,
	button[disabled]:focus,
	input[type="button"],
	input[type="button"][disabled]:hover,
	input[type="button"][disabled]:focus,
	input[type="reset"],
	input[type="reset"][disabled]:hover,
	input[type="reset"][disabled]:focus,
	input[type="submit"],
	input[type="submit"][disabled]:hover,
	input[type="submit"][disabled]:focus,
	.menu-toggle.toggled-on,
	.menu-toggle.toggled-on:hover,
	.menu-toggle.toggled-on:focus,
	.pagination:before,
	.pagination:after,
	.pagination .prev,
	.pagination .next,
	.page-links a {
		background-color: {$colors['main_text_color']};
	}

	/* Secondary Text Color */

	/**
	 * IE8 and earlier will drop any block with CSS3 selectors.
	 * Do not combine these styles with the next block.
	 */
	body:not(.search-results) .entry-summary {
		color: {$colors['secondary_text_color']};
	}

	blockquote,
	.post-password-form label,
	a:hover,
	a:focus,
	a:active,
	.post-navigation .meta-nav,
	.image-navigation,
	.comment-navigation,
	.widget_recent_entries .post-date,
	.widget_rss .rss-date,
	.widget_rss cite,
	.site-description,
	.author-bio,
	.entry-footer,
	.entry-footer a,
	.sticky-post,
	.taxonomy-description,
	.entry-caption,
	.comment-metadata,
	.pingback .edit-link,
	.comment-metadata a,
	.pingback .comment-edit-link,
	.comment-form label,
	.comment-notes,
	.comment-awaiting-moderation,
	.logged-in-as,
	.form-allowed-tags,
	.site-info,
	.site-info a,
	.wp-caption .wp-caption-text,
	.gallery-caption,
	.widecolumn label,
	.widecolumn .mu_register label {
		color: {$colors['secondary_text_color']};
	}

	.widget_calendar tbody a:hover,
	.widget_calendar tbody a:focus {
		background-color: {$colors['secondary_text_color']};
	}

	/* Border Color */
	fieldset,
	pre,
	abbr,
	acronym,
	table,
	th,
	td,
	input[type="date"],
	input[type="time"],
	input[type="datetime-local"],
	input[type="week"],
	input[type="month"],
	input[type="text"],
	input[type="email"],
	input[type="url"],
	input[type="password"],
	input[type="search"],
	input[type="tel"],
	input[type="number"],
	textarea,
	.main-navigation li,
	.main-navigation .primary-menu,
	.menu-toggle,
	.dropdown-toggle:after,
	.social-navigation a,
	.image-navigation,
	.comment-navigation,
	.tagcloud a,
	.entry-content,
	.entry-summary,
	.page-links a,
	.page-links > span,
	.comment-list article,
	.comment-list .pingback,
	.comment-list .trackback,
	.comment-reply-link,
	.no-comments,
	.widecolumn .mu_register .mu_alert {
		border-color: {$colors['main_text_color']}; /* Fallback for IE7 and IE8 */
		border-color: {$colors['border_color']};
	}

	hr,
	code {
		background-color: {$colors['main_text_color']}; /* Fallback for IE7 and IE8 */
		background-color: {$colors['border_color']};
	}

	@media screen and (min-width: 56.875em) {
		.main-navigation li:hover > a,
		.main-navigation li.focus > a {
			color: {$colors['link_color']};
		}

		.main-navigation ul ul,
		.main-navigation ul ul li {
			border-color: {$colors['border_color']};
		}

		.main-navigation ul ul:before {
			border-top-color: {$colors['border_color']};
			border-bottom-color: {$colors['border_color']};
		}

		.main-navigation ul ul li {
			background-color: {$colors['page_background_color']};
		}

		.main-navigation ul ul:after {
			border-top-color: {$colors['page_background_color']};
			border-bottom-color: {$colors['page_background_color']};
		}
	}

CSS;
}


/**
 * Outputs an Underscore template for generating CSS for the color scheme.
 *
 * The template generates the css dynamically for instant display in the
 * Customizer preview.
 *
 * @since Twenty Sixteen 1.0
 */
function ufobufo_color_scheme_css_template() {
	$colors = array(
		'background_color'      => '{{ data.background_color }}',
		'page_background_color' => '{{ data.page_background_color }}',
		'link_color'            => '{{ data.link_color }}',
		'main_text_color'       => '{{ data.main_text_color }}',
		'secondary_text_color'  => '{{ data.secondary_text_color }}',
		'border_color'          => '{{ data.border_color }}',
	);
	?>
	<script type="text/html" id="tmpl-ufobufo-color-scheme">
		<?php echo ufobufo_get_color_scheme_css( $colors ); ?>
	</script>
	<?php
}
add_action( 'customize_controls_print_footer_scripts', 'ufobufo_color_scheme_css_template' );

/**
 * Enqueues front-end CSS for the page background color.
 *
 * @since Twenty Sixteen 1.0
 *
 * @see wp_add_inline_style()
 */
function ufobufo_page_background_color_css() {
	$color_scheme          = ufobufo_get_color_scheme();
	$default_color         = $color_scheme[1];
	$page_background_color = get_theme_mod( 'page_background_color', $default_color );

	// Don't do anything if the current color is the default.
	if ( $page_background_color === $default_color ) {
		return;
	}

	$css = '
		/* Custom Page Background Color */
		.site {
			background-color: %1$s;
		}

		mark,
		ins,
		button,
		button[disabled]:hover,
		button[disabled]:focus,
		input[type="button"],
		input[type="button"][disabled]:hover,
		input[type="button"][disabled]:focus,
		input[type="reset"],
		input[type="reset"][disabled]:hover,
		input[type="reset"][disabled]:focus,
		input[type="submit"],
		input[type="submit"][disabled]:hover,
		input[type="submit"][disabled]:focus,
		.menu-toggle.toggled-on,
		.menu-toggle.toggled-on:hover,
		.menu-toggle.toggled-on:focus,
		.pagination .prev,
		.pagination .next,
		.pagination .prev:hover,
		.pagination .prev:focus,
		.pagination .next:hover,
		.pagination .next:focus,
		.pagination .nav-links:before,
		.pagination .nav-links:after,
		.widget_calendar tbody a,
		.widget_calendar tbody a:hover,
		.widget_calendar tbody a:focus,
		.page-links a,
		.page-links a:hover,
		.page-links a:focus {
			color: %1$s;
		}

		@media screen and (min-width: 56.875em) {
			.main-navigation ul ul li {
				background-color: %1$s;
			}

			.main-navigation ul ul:after {
				border-top-color: %1$s;
				border-bottom-color: %1$s;
			}
		}
	';

	wp_add_inline_style( 'ufobufo-style', sprintf( $css, $page_background_color ) );
}
add_action( 'wp_enqueue_scripts', 'ufobufo_page_background_color_css', 11 );

/**
 * Enqueues front-end CSS for the link color.
 *
 * @since Twenty Sixteen 1.0
 *
 * @see wp_add_inline_style()
 */
function ufobufo_link_color_css() {
	$color_scheme    = ufobufo_get_color_scheme();
	$default_color   = $color_scheme[2];
	$link_color = get_theme_mod( 'link_color', $default_color );

	// Don't do anything if the current color is the default.
	if ( $link_color === $default_color ) {
		return;
	}

	$css = '
		/* Custom Link Color */
		.menu-toggle:hover,
		.menu-toggle:focus,
		a,
		.main-navigation a:hover,
		.main-navigation a:focus,
		.dropdown-toggle:hover,
		.dropdown-toggle:focus,
		.social-navigation a:hover:before,
		.social-navigation a:focus:before,
		.post-navigation a:hover .post-title,
		.post-navigation a:focus .post-title,
		.tagcloud a:hover,
		.tagcloud a:focus,
		.site-branding .site-title a:hover,
		.site-branding .site-title a:focus,
		.entry-title a:hover,
		.entry-title a:focus,
		.entry-footer a:hover,
		.entry-footer a:focus,
		.comment-metadata a:hover,
		.comment-metadata a:focus,
		.pingback .comment-edit-link:hover,
		.pingback .comment-edit-link:focus,
		.comment-reply-link,
		.comment-reply-link:hover,
		.comment-reply-link:focus,
		.required,
		.site-info a:hover,
		.site-info a:focus {
			color: %1$s;
		}

		mark,
		ins,
		button:hover,
		button:focus,
		input[type="button"]:hover,
		input[type="button"]:focus,
		input[type="reset"]:hover,
		input[type="reset"]:focus,
		input[type="submit"]:hover,
		input[type="submit"]:focus,
		.pagination .prev:hover,
		.pagination .prev:focus,
		.pagination .next:hover,
		.pagination .next:focus,
		.widget_calendar tbody a,
		.page-links a:hover,
		.page-links a:focus {
			background-color: %1$s;
		}

		input[type="date"]:focus,
		input[type="time"]:focus,
		input[type="datetime-local"]:focus,
		input[type="week"]:focus,
		input[type="month"]:focus,
		input[type="text"]:focus,
		input[type="email"]:focus,
		input[type="url"]:focus,
		input[type="password"]:focus,
		input[type="search"]:focus,
		input[type="tel"]:focus,
		input[type="number"]:focus,
		textarea:focus,
		.tagcloud a:hover,
		.tagcloud a:focus,
		.menu-toggle:hover,
		.menu-toggle:focus {
			border-color: %1$s;
		}

		@media screen and (min-width: 56.875em) {
			.main-navigation li:hover > a,
			.main-navigation li.focus > a {
				color: %1$s;
			}
		}
	';

	wp_add_inline_style( 'ufobufo-style', sprintf( $css, $link_color ) );
}
add_action( 'wp_enqueue_scripts', 'ufobufo_link_color_css', 11 );

/**
 * Enqueues front-end CSS for the main text color.
 *
 * @since Twenty Sixteen 1.0
 *
 * @see wp_add_inline_style()
 */
function ufobufo_main_text_color_css() {
	$color_scheme    = ufobufo_get_color_scheme();
	$default_color   = $color_scheme[3];
	$main_text_color = get_theme_mod( 'main_text_color', $default_color );

	// Don't do anything if the current color is the default.
	if ( $main_text_color === $default_color ) {
		return;
	}

	// Convert main text hex color to rgba.
	$main_text_color_rgb = ufobufo_hex2rgb( $main_text_color );

	// If the rgba values are empty return early.
	if ( empty( $main_text_color_rgb ) ) {
		return;
	}

	// If we get this far, we have a custom color scheme.
	$border_color = vsprintf( 'rgba( %1$s, %2$s, %3$s, 0.2)', $main_text_color_rgb );

	$css = '
		/* Custom Main Text Color */
		body,
		blockquote cite,
		blockquote small,
		.main-navigation a,
		.menu-toggle,
		.dropdown-toggle,
		.social-navigation a,
		.post-navigation a,
		.pagination a:hover,
		.pagination a:focus,
		.widget-title a,
		.site-branding .site-title a,
		.entry-title a,
		.page-links > .page-links-title,
		.comment-author,
		.comment-reply-title small a:hover,
		.comment-reply-title small a:focus {
			color: %1$s
		}

		blockquote,
		.menu-toggle.toggled-on,
		.menu-toggle.toggled-on:hover,
		.menu-toggle.toggled-on:focus,
		.post-navigation,
		.post-navigation div + div,
		.pagination,
		.widget,
		.page-header,
		.page-links a,
		.comments-title,
		.comment-reply-title {
			border-color: %1$s;
		}

		button,
		button[disabled]:hover,
		button[disabled]:focus,
		input[type="button"],
		input[type="button"][disabled]:hover,
		input[type="button"][disabled]:focus,
		input[type="reset"],
		input[type="reset"][disabled]:hover,
		input[type="reset"][disabled]:focus,
		input[type="submit"],
		input[type="submit"][disabled]:hover,
		input[type="submit"][disabled]:focus,
		.menu-toggle.toggled-on,
		.menu-toggle.toggled-on:hover,
		.menu-toggle.toggled-on:focus,
		.pagination:before,
		.pagination:after,
		.pagination .prev,
		.pagination .next,
		.page-links a {
			background-color: %1$s;
		}

		/* Border Color */
		fieldset,
		pre,
		abbr,
		acronym,
		table,
		th,
		td,
		input[type="date"],
		input[type="time"],
		input[type="datetime-local"],
		input[type="week"],
		input[type="month"],
		input[type="text"],
		input[type="email"],
		input[type="url"],
		input[type="password"],
		input[type="search"],
		input[type="tel"],
		input[type="number"],
		textarea,
		.main-navigation li,
		.main-navigation .primary-menu,
		.menu-toggle,
		.dropdown-toggle:after,
		.social-navigation a,
		.image-navigation,
		.comment-navigation,
		.tagcloud a,
		.entry-content,
		.entry-summary,
		.page-links a,
		.page-links > span,
		.comment-list article,
		.comment-list .pingback,
		.comment-list .trackback,
		.comment-reply-link,
		.no-comments,
		.widecolumn .mu_register .mu_alert {
			border-color: %1$s; /* Fallback for IE7 and IE8 */
			border-color: %2$s;
		}

		hr,
		code {
			background-color: %1$s; /* Fallback for IE7 and IE8 */
			background-color: %2$s;
		}

		@media screen and (min-width: 56.875em) {
			.main-navigation ul ul,
			.main-navigation ul ul li {
				border-color: %2$s;
			}

			.main-navigation ul ul:before {
				border-top-color: %2$s;
				border-bottom-color: %2$s;
			}
		}
	';

	wp_add_inline_style( 'ufobufo-style', sprintf( $css, $main_text_color, $border_color ) );
}
add_action( 'wp_enqueue_scripts', 'ufobufo_main_text_color_css', 11 );

/**
 * Enqueues front-end CSS for the secondary text color.
 *
 * @since Twenty Sixteen 1.0
 *
 * @see wp_add_inline_style()
 */
function ufobufo_secondary_text_color_css() {
	$color_scheme    = ufobufo_get_color_scheme();
	$default_color   = $color_scheme[4];
	$secondary_text_color = get_theme_mod( 'secondary_text_color', $default_color );

	// Don't do anything if the current color is the default.
	if ( $secondary_text_color === $default_color ) {
		return;
	}

	$css = '
		/* Custom Secondary Text Color */

		/**
		 * IE8 and earlier will drop any block with CSS3 selectors.
		 * Do not combine these styles with the next block.
		 */
		body:not(.search-results) .entry-summary {
			color: %1$s;
		}

		blockquote,
		.post-password-form label,
		a:hover,
		a:focus,
		a:active,
		.post-navigation .meta-nav,
		.image-navigation,
		.comment-navigation,
		.widget_recent_entries .post-date,
		.widget_rss .rss-date,
		.widget_rss cite,
		.site-description,
		.author-bio,
		.entry-footer,
		.entry-footer a,
		.sticky-post,
		.taxonomy-description,
		.entry-caption,
		.comment-metadata,
		.pingback .edit-link,
		.comment-metadata a,
		.pingback .comment-edit-link,
		.comment-form label,
		.comment-notes,
		.comment-awaiting-moderation,
		.logged-in-as,
		.form-allowed-tags,
		.site-info,
		.site-info a,
		.wp-caption .wp-caption-text,
		.gallery-caption,
		.widecolumn label,
		.widecolumn .mu_register label {
			color: %1$s;
		}

		.widget_calendar tbody a:hover,
		.widget_calendar tbody a:focus {
			background-color: %1$s;
		}
	';

	wp_add_inline_style( 'ufobufo-style', sprintf( $css, $secondary_text_color ) );
}
add_action( 'wp_enqueue_scripts', 'ufobufo_secondary_text_color_css', 11 );

/**
 * Sanitizes date input for customizer settings.
 *
 * @since UFO BUFO 1.0
 *
 * @param string $date Date input value.
 * @return string Sanitized date in YYYY-MM-DD format or empty string if invalid.
 */
function ufobufo_sanitize_date( $date ) {
	// Check if date is in valid format
	if ( ! preg_match( '/^\d{4}-\d{2}-\d{2}$/', $date ) ) {
		return '';
	}

	// Validate the date
	$date_parts = explode( '-', $date );
	if ( ! checkdate( intval( $date_parts[1] ), intval( $date_parts[2] ), intval( $date_parts[0] ) ) ) {
		return '';
	}

	return $date;
}

/**
 * Sanitizes festival phase selection.
 *
 * @since UFO BUFO 1.0
 *
 * @param string $phase Phase input value.
 * @return string Valid phase key or default 'phase_4'.
 */
function ufobufo_sanitize_festival_phase( $phase ) {
	$valid_phases = array( 'phase_1', 'phase_2', 'phase_3', 'phase_4' );

	if ( ! in_array( $phase, $valid_phases, true ) ) {
		return 'phase_4';
	}

	return $phase;
}

/**
 * Sanitizes tickets phase selection for the Tickets page.
 *
 * @since UFO BUFO 1.0
 *
 * @param string $phase Phase input value.
 * @return string Valid tickets phase key or default 'phase_2'.
 */
function ufobufo_sanitize_tickets_phase( $phase ) {
	$valid_phases = array( 'phase_1', 'phase_2', 'phase_3' );

	if ( ! in_array( $phase, $valid_phases, true ) ) {
		return 'phase_2';
	}

	return $phase;
}

/**
 * Sanitizes ticket wave state.
 *
 * @since UFO BUFO 1.0
 *
 * @param string $state Ticket state.
 * @return string Valid state key or default 'upcoming'.
 */
function ufobufo_sanitize_ticket_state( $state ) {
	$valid_states = array( 'upcoming', 'on_sale', 'sold_out' );

	if ( ! in_array( $state, $valid_states, true ) ) {
		return 'upcoming';
	}

	return $state;
}

/**
 * Sanitizes checkbox values for Customizer settings.
 *
 * @since UFO BUFO 1.0
 *
 * @param mixed $checked Checkbox value.
 * @return bool
 */
function ufobufo_sanitize_checkbox( $checked ) {
	return ( isset( $checked ) && true == $checked );
}
