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

    // WooCommerce
    add_theme_support('woocommerce');
    add_theme_support('wc-product-gallery-zoom');
    add_theme_support('wc-product-gallery-lightbox');
    add_theme_support('wc-product-gallery-slider');

    add_filter( 'wc_product_sku_enabled', '__return_false' );
    
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
    
    // Custom image sizes have been removed - WordPress default sizes are used instead

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
        array(
            'main-menu'         => __('Main Menu', 'ufobufo'),
            'footer-social-menu'=> __('Footer social menu', 'ufobufo'),
        )
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

/**
 * WooCommerce shop loop UI cleanup
 * - Remove "Showing the single result" (result count)
 * - Remove "Default sorting" dropdown (catalog ordering)
 */
add_action( 'wp', 'ufobufo_woocommerce_shop_loop_cleanup' );
function ufobufo_woocommerce_shop_loop_cleanup() {
    if ( ! function_exists( 'is_shop' ) ) {
        return;
    }

    $is_shop_context = is_shop() || is_post_type_archive( 'product' ) || is_tax( array( 'product_cat', 'product_tag' ) );
    if ( ! $is_shop_context ) {
        return;
    }

    remove_action( 'woocommerce_before_shop_loop', 'woocommerce_result_count', 20 );
    remove_action( 'woocommerce_before_shop_loop', 'woocommerce_catalog_ordering', 30 );
}

add_action('comment_form_before', 'ufobufo_enqueue_comment_reply_script');
function ufobufo_enqueue_comment_reply_script()
{
    if (get_option('thread_comments')) {
        wp_enqueue_script('comment-reply');
    }
}

/**
 * Add thumbnail column to posts list in admin
 */
add_filter('manage_posts_columns', 'ufobufo_add_thumbnail_column');
function ufobufo_add_thumbnail_column($columns) {
    $new_columns = array();
    
    foreach ($columns as $key => $value) {
        if ($key === 'title') {
            $new_columns['thumbnail'] = __('Thumbnail', 'ufobufo');
        }
        $new_columns[$key] = $value;
    }
    
    return $new_columns;
}

add_action('manage_posts_custom_column', 'ufobufo_display_thumbnail_column', 10, 2);
function ufobufo_display_thumbnail_column($column, $post_id) {
    if ($column === 'thumbnail') {
        if (has_post_thumbnail($post_id)) {
            echo wp_get_attachment_image(
                get_post_thumbnail_id($post_id),
                array(80, 80),
                false,
                array(
                    'style' => 'max-width: 80px; height: auto; display: block;',
                    'loading' => 'lazy'
                )
            );
        } else {
            echo '<span style="color: #999;">—</span>';
        }
    }
}

add_filter('manage_posts_columns_css', 'ufobufo_thumbnail_column_width');
function ufobufo_thumbnail_column_width() {
    echo '<style>
        .column-thumbnail {
            width: 100px;
            text-align: center;
        }
    </style>';
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
 * Check if the festival text should be displayed based on the current festival phase.
 *
 * Phase logic:
 * - Phase 1: show festival text
 * - Phase 2: show festival text
 * - Phase 3: hide festival text (show "More artists" message instead)
 * - Phase 4: hide festival text
 *
 * @since UFO BUFO 1.0
 *
 * @return bool True if festival text should be displayed, false otherwise.
 */
function ufobufo_should_show_festival_text() {
    $phase = ufobufo_get_festival_phase();

    return in_array( $phase, array( 'phase_1', 'phase_2' ), true );
}

/**
 * Get the current festival phase.
 *
 * @since UFO BUFO 1.0
 *
 * @return string One of 'phase_1', 'phase_2', 'phase_3', 'phase_4'.
 */
function ufobufo_get_festival_phase() {
    return get_theme_mod( 'festival_phase', 'phase_4' );
}

/**
 * Get the configured festival edition label.
 *
 * @since UFO BUFO 1.0
 *
 * @return string Festival edition label.
 */
function ufobufo_get_festival_edition_label() {
    $default_label = 'UFO BUFO Festival 2025';

    /**
     * Stored in the Customizer under "Festival Settings".
     */
    $label = get_theme_mod( 'festival_edition_label', $default_label );

    return $label;
}

/**
 * Get current Facebook event URL configured in the Customizer.
 *
 * @since UFO BUFO 1.0.3
 *
 * @return string Facebook event URL or empty string when not configured.
 */
function ufobufo_get_facebook_event_url() {
    $url = get_theme_mod( 'festival_facebook_event_url', '' );

    if ( empty( $url ) ) {
        return '';
    }

    return $url;
}

/**
 * Get the festival text with proper conditional display.
 *
 * @since UFO BUFO 1.0
 *
 * @param string $text Optional custom festival text to display.
 * @return string The festival text if it should be displayed, empty string otherwise.
 */
function ufobufo_get_festival_text( $text = '' ) {
    $label = $text !== '' ? $text : ufobufo_get_festival_edition_label();

    if ( ufobufo_should_show_festival_text() && ! empty( $label ) ) {
        return $label;
    }

    return '';
}

/**
 * Get the stage heading subtext.
 *
 * Currently unused (stage subtext is handled in the stage list area),
 * but kept for potential future use.
 *
 * @since UFO BUFO 1.0
 *
 * @return string Empty string (no heading subtext).
 */
function ufobufo_get_stage_heading_subtext() {
    return '';
}

/**
 * Get the stage list subtext based on current festival phase.
 *
 * This text is rendered under the stage style line (where
 * the legacy "(lineup coming very soon)" placeholder lived).
 *
 * Phase logic:
 * - Phase 1: show "[festival name] [year]" (newest lineup year)
 * - Phase 2: show "[festival name] [year]" (newest lineup year)
 * - Phase 3: show localized "Další vystupující později" / "More artists TBA"
 * - Phase 4: no subtext
 *
 * @since UFO BUFO 1.0
 *
 * @return string
 */
function ufobufo_get_stage_list_subtext() {
    $phase = ufobufo_get_festival_phase();
    $lang  = function_exists( 'pll_current_language' ) ? pll_current_language() : 'cs';

    // Determine lineup context
    $years          = ufobufo_get_lineup_years();
    $newest_year    = reset( $years ); // newest year from sorted array
    $requested_year = ufobufo_get_requested_lineup_year();

    // If an explicit lineup_year is requested in the URL and it points to
    // an older edition than the newest one, always behave like Phase 1/2
    // and show "[festival name] [year]" for that archived lineup.
    $is_archive_view = isset( $_GET['lineup_year'] ) && (int) $requested_year !== (int) $newest_year;

    if ( $is_archive_view ) {
        // Prefer configured homepage festival name, fall back to blog name.
        $festival_name = '';
        if ( function_exists( 'ufobufo_get_home_event_name' ) ) {
            $festival_name = ufobufo_get_home_event_name();
        }
        if ( $festival_name === '' ) {
            $festival_name = get_bloginfo( 'name' );
        }

        $festival_name = trim( $festival_name );

        if ( $festival_name === '' || ! $requested_year ) {
            return '';
        }

        return sprintf( '%s %d', $festival_name, (int) $requested_year );
    }

    switch ( $phase ) {
        case 'phase_1':
        case 'phase_2':
            // Prefer configured homepage festival name, fall back to blog name.
            $festival_name = '';
            if ( function_exists( 'ufobufo_get_home_event_name' ) ) {
                $festival_name = ufobufo_get_home_event_name();
            }
            if ( $festival_name === '' ) {
                $festival_name = get_bloginfo( 'name' );
            }

            $festival_name = trim( $festival_name );

            if ( $festival_name === '' || ! $newest_year ) {
                return '';
            }

            return sprintf( '%s %d', $festival_name, (int) $newest_year );

        case 'phase_3':
            if ( $lang === 'en' ) {
                return 'More artists TBA';
            }
            return 'Další vystupující později';

        case 'phase_4':
        default:
            return '';
    }
}

/**
 * Check if the old lineup (previous edition) should be visible.
 *
 * - Phase 1: yes (show last year)
 * - Phase 2: yes (dates updated, but lineup still old)
 * - Phase 3: no (hide old lineup, new artists are being added)
 * - Phase 4: no (current edition lineup is complete)
 *
 * @since UFO BUFO 1.0
 *
 * @return bool
 */
function ufobufo_should_show_old_lineup() {
    $phase = ufobufo_get_festival_phase();

    return in_array( $phase, array( 'phase_1', 'phase_2' ), true );
}

/**
 * Get the festival event date range as a formatted string.
 *
 * Uses two Customizer date fields and outputs text like
 * "24. 6. - 28. 6. 2026".
 *
 * Falls back to the legacy ACF "eventdate" field on the
 * homepage if the Customizer dates are not configured.
 *
 * @since UFO BUFO 1.0
 *
 * @return string
 */
function ufobufo_get_event_date_range_text() {
    $start_raw = get_theme_mod( 'festival_event_start_date', '' );
    $end_raw   = get_theme_mod( 'festival_event_end_date', '' );

    if ( empty( $start_raw ) || empty( $end_raw ) ) {
        // Backwards compatibility: use ACF field if available.
        if ( function_exists( 'get_field' ) ) {
            $eventdate = get_field( 'eventdate' );
            if ( ! empty( $eventdate ) ) {
                return $eventdate;
            }
        }

        return '';
    }

    try {
        $start = new DateTime( $start_raw );
        $end   = new DateTime( $end_raw );
    } catch ( Exception $e ) {
        if ( function_exists( 'get_field' ) ) {
            $eventdate = get_field( 'eventdate' );
            if ( ! empty( $eventdate ) ) {
                return $eventdate;
            }
        }

        return '';
    }

    $start_ts = $start->getTimestamp();
    $end_ts   = $end->getTimestamp();

    $start_day_month = date_i18n( 'j. n.', $start_ts );
    $end_day_month   = date_i18n( 'j. n.', $end_ts );

    // Same calendar year.
    if ( $start->format( 'Y' ) === $end->format( 'Y' ) ) {
        $year = $end->format( 'Y' );

        // Same month: "24. 6. - 28. 6. 2026".
        if ( $start->format( 'm' ) === $end->format( 'm' ) ) {
            return sprintf( '%1$s - %2$s %3$s', $start_day_month, $end_day_month, $year );
        }

        // Different month, same year: show full dates.
        $start_full = date_i18n( 'j. n. Y', $start_ts );
        $end_full   = date_i18n( 'j. n. Y', $end_ts );

        return sprintf( '%1$s - %2$s', $start_full, $end_full );
    }

    // Different years: always show full dates.
    $start_full = date_i18n( 'j. n. Y', $start_ts );
    $end_full   = date_i18n( 'j. n. Y', $end_ts );

    return sprintf( '%1$s - %2$s', $start_full, $end_full );
}

/**
 * Get all lineup years for the Program page.
 *
 * This is no longer driven by the "Available Lineup Years" Customizer
 * setting. Instead, it always exposes all festival editions since 2013,
 * skipping the years without a proper lineup (2020, 2021, 2023).
 *
 * @since UFO BUFO 1.0
 *
 * @return int[] Sorted array of years (newest first).
 */
function ufobufo_get_lineup_years() {
    $start_year    = 2013;
    $current_year  = (int) date_i18n( 'Y' );
    $configured_raw = get_theme_mod( 'festival_lineup_years', date_i18n( 'Y' ) );
    $configured_year = (int) $configured_raw;
    $skip_years    = array( 2020, 2021, 2023 );

    // Allow the lineup list to extend to the Customizer "Programme shows year"
    // so that you can point the Program page at a future edition (e.g. 2026).
    if ( $configured_year >= $start_year && $configured_year > $current_year ) {
        $current_year = $configured_year;
    }

    $years = array();

    for ( $year = $current_year; $year >= $start_year; $year-- ) {
        if ( in_array( $year, $skip_years, true ) ) {
            continue;
        }

        $years[] = $year;
    }

    return $years;
}

/**
 * Get the currently selected lineup year.
 *
 * Priority:
 * 1) "lineup_year" query parameter (if present and one of ufobufo_get_lineup_years())
 * 2) Customizer setting "Programme shows year" (festival_lineup_years),
 *    if it is a valid year from ufobufo_get_lineup_years()
 * 3) Newest year from ufobufo_get_lineup_years().
 *
 * @since UFO BUFO 1.0
 *
 * @return int
 */
function ufobufo_get_requested_lineup_year() {
    $years = ufobufo_get_lineup_years();

    // 1) Explicit query parameter
    if ( isset( $_GET['lineup_year'] ) ) {
        $requested = (int) $_GET['lineup_year'];

        if ( in_array( $requested, $years, true ) ) {
            return $requested;
        }
    }

    // 2) Customizer-controlled default year
    $configured_year = (int) get_theme_mod( 'festival_lineup_years', date_i18n( 'Y' ) );
    if ( in_array( $configured_year, $years, true ) ) {
        return $configured_year;
    }

    // 3) Fallback: newest allowed year
    $default_year = reset( $years );

    return (int) $default_year;
}

/**
 * Internal helper to pick language-aware theme_mod or ACF field.
 *
 * @param string $lang_mod_base  Base key for theme_mod (without language suffix).
 * @param string $acf_cs         ACF field key for Czech.
 * @param string $acf_en         ACF field key for English.
 * @param bool   $is_textarea    Whether this is a multiline field.
 *
 * @return string
 */
function ufobufo_get_homepage_text_value( $lang_mod_base, $acf_cs, $acf_en, $is_textarea = false ) {
    $lang = function_exists( 'pll_current_language' ) ? pll_current_language() : 'cs';

    $suffix = ( $lang === 'en' ) ? '_en' : '_cs';
    $mod    = $lang_mod_base . $suffix;

    $value = get_theme_mod( $mod, '' );

    if ( $value !== '' ) {
        return $value;
    }

    // Fallback to legacy ACF fields.
    if ( ! function_exists( 'get_field' ) ) {
        return '';
    }

    if ( $lang === 'en' ) {
        $acf_key = $acf_en;
    } else {
        $acf_key = $acf_cs;
    }

    $acf_value = get_field( $acf_key );

    if ( empty( $acf_value ) ) {
        return '';
    }

    return (string) $acf_value;
}

/**
 * Homepage: welcome text above the main festival text.
 *
 * @return string
 */
function ufobufo_get_home_event_welcome_text() {
    return ufobufo_get_homepage_text_value(
        'festival_home_welcome_text',
        'eventwelcometext',
        'eventwelcometext_en',
        true
    );
}

/**
 * Homepage: main festival text (tagline) under the welcome line.
 *
 * @return string
 */
function ufobufo_get_home_event_text() {
    return ufobufo_get_homepage_text_value(
        'festival_home_text',
        'eventtext',
        'eventtext_en',
        true
    );
}

/**
 * Homepage: festival name in the main H1.
 *
 * @return string
 */
function ufobufo_get_home_event_name() {
    return ufobufo_get_homepage_text_value(
        'festival_home_name',
        'eventname',
        'eventname_en',
        false
    );
}

/**
 * Homepage: festival location line under the date.
 *
 * @return string
 */
function ufobufo_get_home_event_location() {
    return ufobufo_get_homepage_text_value(
        'festival_home_location',
        'eventlocation',
        'eventlocation_en',
        false
    );
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


/**
 * Get stage image gallery HTML for given stage and edition year.
 *
 * @param string $stage_key main | groovy | chill | tribal
 * @param int    $year      Edition year (e.g. 2026)
 * @return string           Gallery <figure> HTML or empty string
 */
function ufobufo_get_stage_image_html( string $stage_key, int $year ): string
{
    if ( empty($stage_key) || empty($year) ) {
        return '';
    }

    $year = (int) $year;

    for ( $y = $year; $y >= 2000; $y-- ) {

        $tag_slug = 'img-' . sanitize_title($stage_key) . '-cs-' . $y . ', img-' . sanitize_title($stage_key) . '-en-' . $y;

        $posts = get_posts([
            'posts_per_page' => 1,
            'post_status'    => 'publish',
            'tag'            => $tag_slug,
            'meta_query'     => [
                [
                    'key'     => '_thumbnail_id',
                    'compare' => 'EXISTS',
                ]
            ],
            'no_found_rows'  => true,
        ]);

        if ( empty($posts) ) {
            continue;
        }

        $post_id = $posts[0]->ID;

        if ( ! has_post_thumbnail($post_id) ) {
            continue;
        }

        $thumb_id  = get_post_thumbnail_id($post_id);
        $full_url  = wp_get_attachment_image_url($thumb_id, 'full');
        $image_html = wp_get_attachment_image(
            $thumb_id,
            'medium',
            false,
            [
                'loading'  => 'lazy',
                'decoding' => 'async',
                'sizes'    => 'auto, (max-width: 2000px) 100vw, 2000px',
            ]
        );

        if ( ! $full_url || ! $image_html ) {
            continue;
        }

        return '
<figure class="wp-block-gallery has-nested-images columns-default is-cropped wp-block-gallery-3 is-layout-flex wp-block-gallery-is-layout-flex">
    <figure class="wp-block-image size-large">
        <a href="' . esc_url($full_url) . '" class="fancybox image" rel="gallery-0" aria-haspopup="dialog">
            ' . $image_html . '
        </a>
    </figure>
</figure>';
    }

    return '';
}
