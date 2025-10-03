<?php

// Load customizer functionality
require get_template_directory() . '/inc/customizer.php';

add_action('after_setup_theme', 'ufobufo_setup');
function ufobufo_setup()
{
    load_theme_textdomain('ufobufo', get_template_directory() . '/languages');
    add_theme_support('title-tag');
    add_theme_support('automatic-feed-links');
    add_theme_support('post-thumbnails');
    
    // Add HTML5 support for modern semantic markup
    add_theme_support('html5', array(
        'search-form',
        'comment-form',
        'comment-list',
        'gallery',
        'caption',
        'style',
        'script'
    ));
    
    // Register custom image sizes
    add_image_size('gallery-big', 1400, 939, true);
    add_image_size('gallery-thumb', 280, 190, true);
    add_image_size('card-thumb', 330, 250, true);
    add_image_size('card-thumb-2x', 660, 500, true);

    remove_action( 'wp_head', 'wp_generator' );
    remove_action( 'wp_head', 'wlwmanifest_link' );
    remove_action( 'wp_head', 'rsd_link' );
    remove_action( 'wp_head', 'wp_resource_hints', 2 );
    remove_action( 'wp_head', 'wp_shortlink_wp_head' ); // removes shortlink.
    remove_action( 'wp_head', 'rest_output_link_wp_head' );
    remove_action( 'wp_head', 'wp_oembed_add_discovery_links' );

    global $content_width;
    if (!isset($content_width)) $content_width = 640;
    register_nav_menus(
        array('main-menu' => __('Main Menu', 'ufobufo'))
    );
}

add_action('wp_enqueue_scripts', 'ufobufo_load_scripts');
function ufobufo_load_scripts()
{
    $version = wp_get_theme()->version;
    
    // jQuery from WordPress
    wp_enqueue_script('jquery');
    
    // Vendor libraries in order
    wp_enqueue_script(
        'swiper',
        get_template_directory_uri() . '/js/vendor/swiper.min.js',
        array(),
        '12.0.2',
        false
    );
    
    wp_enqueue_script(
        'gsap',
        get_template_directory_uri() . '/js/vendor/gsap.min.js',
        array(),
        '3.13.0',
        false
    );
    
    wp_enqueue_script(
        'izimodal',
        get_template_directory_uri() . '/js/vendor/iziModal.min.js',
        array('jquery'),
        '1.6.1',
        false
    );
    
    wp_enqueue_script(
        'basicscroll',
        get_template_directory_uri() . '/js/vendor/basicscroll.min.js',
        array(),
        '3.0.4',
        false
    );
    
    // Theme JavaScript - depends on all vendor libraries
    wp_enqueue_script(
        'ufobufo-front',
        get_template_directory_uri() . '/js/front.js',
        array('jquery', 'swiper', 'gsap', 'izimodal', 'basicscroll'),
        $version,
        false
    );
}

add_action('comment_form_before', 'ufobufo_enqueue_comment_reply_script');
function ufobufo_enqueue_comment_reply_script()
{
    if (get_option('thread_comments')) {
        wp_enqueue_script('comment-reply');
    }
}

add_filter('the_title', 'ufobufo_title');
function ufobufo_title($title)
{
    if ($title === '') {
        return '&rarr;';
    }
    return $title;
}

// Custom title generation using the modern WordPress title system
add_filter('pre_get_document_title', 'ufobufo_custom_document_title');
function ufobufo_custom_document_title($title) {
    $name = get_bloginfo('name');
    $parents = '';
    
    if (is_front_page()) {
        return $name . ' – ' . get_bloginfo('description');
    } elseif (is_category()) {
        return single_cat_title('', false) . ' – ' . $name;
    } elseif (is_single() || is_page()) {
        $custom_title = single_post_title('', false);
        if (is_single()) {
            $post_id = get_queried_object_id();
            if ($post_id) {
                $cats = get_the_category($post_id);
                foreach ($cats as $cat) {
                    $parents = get_category_parents($cat, false, ' – ');
                }
            }
        }
        return $custom_title . ' – ' . $parents . $name;
    } elseif (is_search()) {
        return esc_html(get_search_query()) . ' – Search Results – ' . $name;
    } elseif (is_tag()) {
        $post_id = get_queried_object_id();
        if ($post_id) {
            $cats = get_the_category($post_id);
            $categ = '';
            foreach ($cats as $cat) {
                $categ .= ' – ' . esc_html($cat->cat_name);
            }
            return $categ . ' – ' . ucfirst(single_tag_title('', false)) . ' – ' . $name;
        }
    }
    
    // Return null to let WordPress handle it normally
    return null;
}

add_action('widgets_init', 'ufobufo_widgets_init');
function ufobufo_widgets_init()
{
    register_sidebar(array(
        'name' => __('Sidebar Widget Area', 'ufobufo'),
        'id' => 'primary-widget-area',
        'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
        'after_widget' => "</li>",
        'before_title' => '<h3 class="widget-title">',
        'after_title' => '</h3>',
    ));
}

function ufobufo_custom_pings($comment)
{
    $GLOBALS['comment'] = $comment;
    ?>
    <li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>"><?php echo comment_author_link(); ?></li>
    <?php
}

add_filter('get_comments_number', 'ufobufo_comments_number');
function ufobufo_comments_number($count)
{
    if (!is_admin()) {
        $post_id = get_the_ID();
        if ($post_id) {
            $comments = get_comments(array(
                'post_id' => $post_id,
                'status' => 'approve',
                'type' => 'comment',
                'count' => true
            ));
            return $comments;
        }
    }
    return $count;
}










// pridava funkci aktivni polozka menu
add_filter('nav_menu_css_class' , 'special_nav_class' , 10 , 2);

function special_nav_class ($classes, $item) {
    if (in_array('current-menu-item', $classes) ){
        $classes[] = 'active ';
    }
    return $classes;
}



// pridava - highlight textu v  search results

function search_excerpt_highlight() {
    $excerpt = wp_trim_words(get_the_content(), 40, '...');
    $search_query = get_search_query();
    
    if (!empty($search_query)) {
        // Escape search query for use in regex
        $keys = array_map('preg_quote', explode(' ', $search_query));
        $keys = implode('|', array_filter($keys));
        
        if (!empty($keys)) {
            $excerpt = preg_replace('/(' . $keys .')/iu', '<strong class="search-highlight">$1</strong>', esc_html($excerpt));
        }
    }

    echo '<p>' . wp_kses_post($excerpt) . '</p>';
}

function search_title_highlight() {
    $title = get_the_title();
    $search_query = get_search_query();
    
    if (!empty($search_query)) {
        // Escape search query for use in regex
        $keys = array_map('preg_quote', explode(' ', $search_query));
        $keys = implode('|', array_filter($keys));
        
        if (!empty($keys)) {
            $title = preg_replace('/(' . $keys .')/iu', '<strong class="search-highlight">$1</strong>', esc_html($title));
        }
    }

    echo wp_kses_post($title);
}


/* Register template redirect action callback */
add_action( 'template_redirect', 'ufobufo_remove_pages' );
/**
 *  Remove archives, categories, date, autor pages  */
function ufobufo_remove_pages() {
    //If we are on category or tag or date or author archive
    if ( is_category() || is_tag() || is_date() || is_author() ) {
        global $wp_query;
        $wp_query->set_404(); //set to 404 not found page
    }
}




// Vypina globalne komentare
// Disable support for comments and trackbacks in post types
function df_disable_comments_post_types_support() {
    $post_types = get_post_types();
    foreach ($post_types as $post_type) {
        if(post_type_supports($post_type, 'comments')) {
            remove_post_type_support($post_type, 'comments');
            remove_post_type_support($post_type, 'trackbacks');
        }
    }
}
add_action('admin_init', 'df_disable_comments_post_types_support');
// Close comments on the front-end
function df_disable_comments_status() {
    return false;
}
add_filter('comments_open', 'df_disable_comments_status', 20, 2);
add_filter('pings_open', 'df_disable_comments_status', 20, 2);
// Hide existing comments
function df_disable_comments_hide_existing_comments($comments) {
    $comments = array();
    return $comments;
}
add_filter('comments_array', 'df_disable_comments_hide_existing_comments', 10, 2);
// Remove comments page in menu
function df_disable_comments_admin_menu() {
    remove_menu_page('edit-comments.php');
}
add_action('admin_menu', 'df_disable_comments_admin_menu');
// Redirect any user trying to access comments page
function df_disable_comments_admin_menu_redirect() {
    global $pagenow;
    if ($pagenow === 'edit-comments.php') {
        wp_redirect(admin_url()); exit;
    }
}
add_action('admin_init', 'df_disable_comments_admin_menu_redirect');
// Remove comments metabox from dashboard
function df_disable_comments_dashboard() {
    remove_meta_box('dashboard_recent_comments', 'dashboard', 'normal');
}
add_action('admin_init', 'df_disable_comments_dashboard');
// Remove comments links from admin bar
function df_disable_comments_admin_bar() {
    if (is_admin_bar_showing()) {
        remove_action('admin_bar_menu', 'wp_admin_bar_comments_menu', 60);
    }
}
add_action('init', 'df_disable_comments_admin_bar');




// page loading
// Add specific CSS class by filter
add_filter( 'body_class', 'my_class_names' );
function my_class_names( $classes ) {
    // add 'class-name' to the $classes array
    $classes[] = 'preloader-visible';
    // return the $classes array
    return $classes;
}






// add function get caption, description from attachment
add_filter( 'image_send_to_editor', 'ap_add_caption_to_img', 10 );
function ap_add_caption_to_img( $html, $id, $caption, $title )
{

// create the html to add after the image
    $additional_html = '';
    if ($title) {
        $additional_html .= '<h4 class="img-title">' . $title . '</h4>';
    }
    if ($caption) {
        $additional_html .= '<p class="wp-caption-text">' . $caption . '</p>';
    }
// get the custom field value and add it if any
    $file_number = get_post_meta($id, 'file_number', true);
    if ($file_number) {
        $additional_html .= '<p class="img-file-number">' . $file_number . '</p>';
    }


// add it to the html and return it
    $html .= $additional_html;

    return $html;




// fix the polylang slugs !!!   -   this need https://github.com/grappler/polylang-slug
    /**
     * The plugin bootstrap file
     *
     * This file is read by WordPress to generate the plugin information in the plugin
     * Dashboard. This file also includes all of the dependencies used by the plugin,
     * registers the activation and deactivation functions, and defines a function
     * that starts the plugin.
     *
     * @link              http://example.com
     * @since             0.1.0
     * @package           Polylang_Slug
     *
     * @wordpress-plugin
     * Plugin Name:       Polylang Slug
     * Plugin URI:        https://github.com/grappler/polylang-slug
     * GitHub Plugin URI: https://github.com/grappler/polylang-slug
     * Description:       Allows same slug for multiple languages in Polylang
     * Version:           0.2.1
     * Author:            Ulrich Pogson
     * Author URI:        http://ulrich.pogson.ch/
     * License:           GPL-2.0+
     * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
     * Text Domain:       polylang-slug
     * Domain Path:       /languages
     */
// Built using code from: https://wordpress.org/support/topic/plugin-polylang-identical-page-names-in-different-languages?replies=8#post-2669927
// Check if PLL exists & the minimum version is correct.
    if (!defined('POLYLANG_VERSION') || version_compare(POLYLANG_VERSION, '1.7', '<=') || version_compare($GLOBALS['wp_version'], '4.0', '<=')) {
        add_action('admin_notices', 'polylang_slug_admin_notices');
        return;
    }
    /**
     * Minimum version admin notice.
     *
     * @since 0.2.0
     */
    function polylang_slug_admin_notices()
    {
        echo '<div class="error"><p>' . __('Polylang Slug requires Polylang v1.7 and WordPress 4.0', 'polylang-slug') . '</p></div>';
    }

    /**
     * Checks if the slug is unique within language.
     *
     * @since 0.1.0
     *
     * @global  wpdb $wpdb WordPress database abstraction object.
     *
     * @param  string $slug The desired slug (post_name).
     * @param  int $post_ID Post ID.
     * @param  string $post_status No uniqueness checks are made if the post is still draft or pending.
     * @param  string $post_type Post type.
     * @param  int $post_parent Post parent ID.
     *
     * @return string              Unique slug for the post within language, based on $post_name (with a -1, -2, etc. suffix).
     */
    function polylang_slug_unique_slug_in_language($slug, $post_ID, $post_status, $post_type, $post_parent, $original_slug)
    {
        // Return slug if it was not changed.
        if ($original_slug === $slug) {
            return $slug;
        }
        global $wpdb;
        // Get language of a post
        $lang = pll_get_post_language($post_ID);
        $options = get_option('polylang');
        // return the slug if Polylang does not return post language or has incompatable redirect setting or is not translated post type.
        if (empty($lang) || 0 === $options['force_lang'] || !pll_is_translated_post_type($post_type)) {
            return $slug;
        }
        // " INNER JOIN $wpdb->term_relationships AS pll_tr ON pll_tr.object_id = ID".
        $join_clause = polylang_slug_model_post_join_clause();
        // " AND pll_tr.term_taxonomy_id IN (" . implode(',', $languages) . ")".
        $where_clause = polylang_slug_model_post_where_clause($lang);
        // Polylang does not translate attachements - skip if it is one.
        // @TODO Recheck this with the Polylang settings
        if ('attachment' === $post_type) {
            // Attachment slugs must be unique across all types.
            $check_sql = "SELECT post_name FROM $wpdb->posts $join_clause WHERE post_name = %s AND ID != %d $where_clause LIMIT 1";
            $post_name_check = $wpdb->get_var($wpdb->prepare($check_sql, $original_slug, $post_ID));
        } elseif (is_post_type_hierarchical($post_type)) {
            // Page slugs must be unique within their own trees. Pages are in a separate
            // namespace than posts so page slugs are allowed to overlap post slugs.
            $check_sql = "SELECT ID FROM $wpdb->posts $join_clause WHERE post_name = %s AND post_type IN ( %s, 'attachment' ) AND ID != %d AND post_parent = %d $where_clause LIMIT 1";
            $post_name_check = $wpdb->get_var($wpdb->prepare($check_sql, $original_slug, $post_type, $post_ID, $post_parent));
        } else {
            // Post slugs must be unique across all posts.
            $check_sql = "SELECT post_name FROM $wpdb->posts $join_clause WHERE post_name = %s AND post_type = %s AND ID != %d $where_clause LIMIT 1";
            $post_name_check = $wpdb->get_var($wpdb->prepare($check_sql, $original_slug, $post_type, $post_ID));
        }
        if (!$post_name_check) {
            return $original_slug;
        } else {
            return $slug;
        }
    }

    add_filter('wp_unique_post_slug', 'polylang_slug_unique_slug_in_language', 10, 6);
    /**
     * Modify the sql query to include checks for the current language.
     *
     * @since 0.1.0
     *
     * @global wpdb $wpdb WordPress database abstraction object.
     *
     * @param  string $query Database query.
     *
     * @return string        The modified query.
     */
    function polylang_slug_filter_queries($query)
    {
        global $wpdb;
        // Query for posts page, pages, attachments and hierarchical CPT. This is the only possible place to make the change. The SQL query is set in get_page_by_path()
        $is_pages_sql = preg_match(
            "#SELECT ID, post_name, post_parent, post_type FROM {$wpdb->posts} .*#",
            polylang_slug_standardize_query($query),
            $matches
        );
        if (!$is_pages_sql) {
            return $query;
        }
        // Check if should contine. Don't add $query polylang_slug_should_run() as $query is a SQL query.
        if (!polylang_slug_should_run()) {
            return $query;
        }
        $lang = pll_current_language();
        // " INNER JOIN $wpdb->term_relationships AS pll_tr ON pll_tr.object_id = ID".
        $join_clause = polylang_slug_model_post_join_clause();
        // " AND pll_tr.term_taxonomy_id IN (" . implode(',', $languages) . ")".
        $where_clause = polylang_slug_model_post_where_clause($lang);
        $query = preg_match(
            "#(SELECT .* (?=FROM))(FROM .* (?=WHERE))(?:(WHERE .*(?=ORDER))|(WHERE .*$))(.*)#",
            polylang_slug_standardize_query($query),
            $matches
        );
        // Reindex array numerically $matches[3] and $matches[4] are not added together thus leaving a gap. With this $matches[5] moves up to $matches[4]
        $matches = array_values($matches);
        // SELECT, FROM, INNER JOIN, WHERE, WHERE CLAUSE (additional), ORBER BY (if included)
        $sql_query = $matches[1] . $matches[2] . $join_clause . $matches[3] . $where_clause . $matches[4];
        /**
         * Disable front end query modification.
         *
         * Allows disabling front end query modification if not needed.
         *
         * @since 0.2.0
         *
         * @param string $sql_query Database query.
         * @param array $matches {
         * @type string $matches [1] SELECT SQL Query.
         * @type string $matches [2] FROM SQL Query.
         * @type string $matches [3] WHERE SQL Query.
         * @type string $matches [4] End of SQL Query (Possibly ORDER BY).
         * }
         * @param string $join_clause INNER JOIN Polylang clause.
         * @param string $where_clause Additional Polylang WHERE clause.
         */
        $query = apply_filters('polylang_slug_sql_query', $sql_query, $matches, $join_clause, $where_clause);
        return $query;
    }

    add_filter('query', 'polylang_slug_filter_queries');
    /**
     * Extend the WHERE clause of the query.
     *
     * This allows the query to return only the posts of the current language
     *
     * @since 0.1.0
     *
     * @param  string $where The WHERE clause of the query.
     * @param  WP_Query $query The WP_Query instance (passed by reference).
     *
     * @return string          The WHERE clause of the query.
     */
    function polylang_slug_posts_where_filter($where, $query)
    {
        // Check if should contine.
        if (!polylang_slug_should_run($query)) {
            return $where;
        }
        $lang = empty($query->query['lang']) ? pll_current_language() : $query->query['lang'];
        // " AND pll_tr.term_taxonomy_id IN (" . implode(',', $languages) . ")"
        $where .= polylang_slug_model_post_where_clause($lang);
        return $where;
    }

// add_filter( 'posts_where', 'polylang_slug_posts_where_filter', 10, 2 );
    /**
     * Extend the JOIN clause of the query.
     *
     * This allows the query to return only the posts of the current language
     *
     * @since 0.1.0
     *
     * @param  string $join The JOIN clause of the query.
     * @param  WP_Query $query The WP_Query instance (passed by reference).
     *
     * @return string          The JOIN clause of the query.
     */
    function polylang_slug_posts_join_filter($join, $query)
    {
        // Check if should contine.
        if (!polylang_slug_should_run($query)) {
            return $join;
        }
        // " INNER JOIN $wpdb->term_relationships AS pll_tr ON pll_tr.object_id = ID".
        $join .= polylang_slug_model_post_join_clause();
        return $join;
    }

// add_filter( 'posts_join', 'polylang_slug_posts_join_filter', 10, 2 );
    /**
     * Check if the query needs to be adapted.
     *
     * @since 0.2.0
     *
     * @param  WP_Query $query The WP_Query instance (passed by reference).
     *
     * @return bool
     */
    function polylang_slug_should_run($query = '')
    {
        /**
         * Disable front end query modification.
         *
         * Allows disabling front end query modification if not needed.
         *
         * @since 0.2.0
         *
         * @param bool     false  Not disabling run.
         * @param WP_Query $query The WP_Query instance (passed by reference).
         */

        // Do not run in admin or if Polylang is disabled
        $disable = apply_filters('polylang_slug_disable', false, $query);
        if (is_admin() || !function_exists('pll_current_language') || $disable) {
            return false;
        }
        // The lang query should be defined if the URL contains the language
        $lang = empty($query->query['lang']) ? pll_current_language() : $query->query['lang'];
        // Checks if the post type is translated when doing a custom query with the post type defined
        $is_translated = !empty($query->query['post_type']) && !pll_is_translated_post_type($query->query['post_type']);
        if (empty($lang) || $is_translated) {
            return false;
        } else {
            return true;
        }
    }

    /**
     * Standardize the query.
     *
     * This makes the standardized and simpler to run regex on
     *
     * @since 0.2.0
     *
     * @param  string $query Database query.
     *
     * @return string        The standardized query.
     */
    function polylang_slug_standardize_query($query)
    {
        // Strip tabs, newlines and multiple spaces.
        $query = str_replace(
            array("\t", " \n", "\n", " \r", "\r", "   ", "  "),
            array('', ' ', ' ', ' ', ' ', ' ', ' '),
            $query
        );
        return trim($query);
    }

    /**
     * Fetch the polylang join clause.
     *
     * @since 0.2.0
     *
     * @return string
     */
    function polylang_slug_model_post_join_clause()
    {
        if (function_exists('PLL')) {
            return PLL()->model->post->join_clause();
        } elseif (array_key_exists('polylang', $GLOBALS)) {
            global $polylang;
            return $polylang->model->join_clause('post');
        } else {
            return;
        }
    }

    /**
     * Fetch the polylang where clause.
     *
     * @since 0.2.0
     *
     * @param  string $lang The current language slug.
     *
     * @return string
     */
    function polylang_slug_model_post_where_clause($lang = '')
    {
        if (function_exists('PLL')) {
            return PLL()->model->post->where_clause($lang);
        } elseif (array_key_exists('polylang', $GLOBALS)) {
            global $polylang;
            return $polylang->model->where_clause($lang, 'post');
        } else {
            return;
        }
    }



    // filter to exclude specified post_meta from Polylang Sync ##
    add_filter( 'pll_copy_post_metas', 'q_pll_copy_post_metas' );
    /**
     * Remove defined custom fields from Polylang Sync
     *
     * @since       0.1
     * @param       Array       $metas
     * @return      Array       Array of meta fields
     */
    function q_pll_copy_post_metas( $metas )
    {
        // this needs to be added to the PolyLang Settings page as an option ##
        $unsync = array (
            ['caption']
        );
        #var_dump( $unsync );
        #var_dump( $metas );
        if ( is_array( $metas ) && is_array( $unsync ) ) {
            // loop over all passed metas ##
            foreach ( $metas as $key => $value ) {
                // loop over each unsynch item ##
                foreach ( $unsync as $find ) {
                    if ( strpos( $value, $find ) !== false ) {
                        unset( $metas[$key] );
                    }
                }
            }
        }
        #wp_die( var_dump( $metas ) );
        // kick back the array ##
        return $metas;
    }




}

function custom_search_sort_order($query) {
    if ($query->is_search && !is_admin()) {
        // Set the 'post_type' parameter to include both pages and posts
        $query->set('post_type', array('page', 'post'));

        // Set the 'orderby' parameter to sort by post type first and then by relevance
        $query->set('orderby', array('post_type' => 'ASC', 'post_date' => 'DESC'));

        // Optionally, you can modify other parameters like 'order' if needed
        // $query->set('order', 'DESC');
    }
}

add_action('pre_get_posts', 'custom_search_sort_order');

add_filter( 'pll_rel_hreflang_attributes', function( $hreflangs ) {
	$hreflangs['x-default'] = $hreflangs['en'];
	return $hreflangs;
} );

add_filter('big_image_size_threshold', '__return_false');

/**
 * Helper function to include body opening and header
 * This should be called after get_header() in template files
 */
function ufobufo_body_header() {
    get_template_part('template-parts/body-header');
}

/**
 * Check if the festival text should be displayed based on date range settings.
 *
 * @since UFO BUFO 1.0
 *
 * @return bool True if festival text should be displayed, false otherwise.
 */
function ufobufo_should_show_festival_text() {
    // Get the date range settings from theme customizer
    $start_date = get_theme_mod( 'festival_visibility_start', date('Y') . '-07-01' );
    $end_date = get_theme_mod( 'festival_visibility_end', (date('Y') + 1) . '-03-31' );
    
    // Get current date
    $current_date = date('Y-m-d');
    
    // If no dates are set, don't show
    if ( empty( $start_date ) || empty( $end_date ) ) {
        return false;
    }
    
    // Handle year wrap-around (e.g., July 2025 to March 2026)
    if ( $start_date <= $end_date ) {
        // Same year range (start and end in same year)
        return ( $current_date >= $start_date && $current_date <= $end_date );
    } else {
        // Year wrap-around (start in one year, end in next year)
        return ( $current_date >= $start_date || $current_date <= $end_date );
    }
}

/**
 * Get the festival text with proper conditional display.
 *
 * @since UFO BUFO 1.0
 *
 * @param string $text The festival text to display (default: '(UFO BUFO Festival 2025)')
 * @return string The festival text if it should be displayed, empty string otherwise.
 */
function ufobufo_get_festival_text( $text = '(UFO BUFO Festival 2025)' ) {
    if ( ufobufo_should_show_festival_text() ) {
        return $text;
    }
    return '';
}


/**
 * Display post boxes for a given category.
 *
 * @param int $cat_id Polylang category ID.
 * @param int $posts_per_page Number of posts to show (-1 for all).
 * @param bool $paginate Whether to use pagination (default false).
 */
function display_boxes($cat_id, $posts_per_page = 6, $paginate = false) {
    $paged = get_query_var('paged') ? get_query_var('paged') : 1;

    $args = [
        'posts_per_page' => $posts_per_page,
        'cat'            => $cat_id,
        'orderby'        => 'date',
        'order'          => 'DESC',
    ];

    if ($paginate) {
        $args['paged'] = $paged;
    }

    $query = new WP_Query($args);

    if ($query->have_posts()) :
        // Pass query to box.php
        $GLOBALS['box_query'] = $query;
        include(locate_template('template-parts/boxes/box.php'));
        unset($GLOBALS['box_query']);

        // Pagination
        if ($paginate) {
            echo '<div class="pagination">';
            echo paginate_links([
                'base'      => str_replace(999999999, '%#%', esc_url(get_pagenum_link(999999999))),
                'format'    => '?paged=%#%',
                'current'   => max(1, $paged),
                'total'     => $query->max_num_pages,
                'prev_text' => '&laquo;',
                'next_text' => '&raquo;',
            ]);
            echo '</div>';
        }
    endif;

    wp_reset_postdata();
}
