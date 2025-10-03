<?php
/**
 * WordPress helper functions for loading optimized JavaScript chunks
 * 
 * PRODUCTION VERSION - This file handles loading of webpack-optimized 
 * JavaScript bundles from /js/ directory in the correct order with proper dependencies.
 * Development paths (/js/dist/) are not supported - theme is only used from distribution.
 */

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

class UfoBufo_Webpack_Assets {
    
    private static $instance = null;
    private $assets_manifest = null;
    private $theme_version = '1.0.1';
    
    public static function getInstance() {
        if (self::$instance === null) {
            self::$instance = new self();
        }
        return self::$instance;
    }
    
    private function __construct() {
        add_action('wp_enqueue_scripts', array($this, 'enqueue_optimized_scripts'), 1); // High priority
        add_action('wp_head', array($this, 'add_preload_hints'), 1);
    }
    
    /**
     * Get the theme URL
     */
    private function get_theme_url() {
        return get_template_directory_uri();
    }
    
    /**
     * Check if we're in development mode
     */
    private function is_development() {
        return defined('WP_DEBUG') && WP_DEBUG;
    }
    
    /**
     * Get the JavaScript file path (with or without hash)
     */
    private function get_js_file($filename) {
        $js_dir = get_template_directory() . '/js/';
        $js_url = $this->get_theme_url() . '/js/';
        
        // Check for versioned files first (e.g., swiper.v12_0_2.*.js)
        $versioned_pattern = $js_dir . $filename . '.v*.*.js';
        $versioned_files = glob($versioned_pattern);
        
        // Check for regular hashed files (e.g., swiper.*.js)
        $hashed_pattern = $js_dir . $filename . '.*.js';
        $hashed_files = glob($hashed_pattern);
        
        // Combine and sort by modification time (newest first)
        $all_files = array_merge($versioned_files, $hashed_files);
        if (!empty($all_files)) {
            // Sort by modification time, newest first
            usort($all_files, function($a, $b) {
                return filemtime($b) - filemtime($a);
            });
            
            $file = basename($all_files[0]);
            $mtime = filemtime($all_files[0]);
            return $js_url . $file . '?v=' . $mtime;
        }
        
        // Fallback to simple filename
        $fallback_file = $js_dir . $filename . '.js';
        if (file_exists($fallback_file)) {
            $mtime = filemtime($fallback_file);
            return $js_url . $filename . '.js?v=' . $mtime;
        }
        
        return $js_url . $filename . '.js';
    }
    
    /**
     * Check if a JavaScript file exists
     */
    private function js_file_exists($filename) {
        $js_dir = get_template_directory() . '/js/';
        
        // Check for versioned files first
        $versioned_pattern = $js_dir . $filename . '.v*.*.js';
        $versioned_files = glob($versioned_pattern);
        if (!empty($versioned_files)) {
            return true;
        }
        
        // Check for hashed version (webpack production builds)
        $hashed_pattern = $js_dir . $filename . '.*.js';
        $hashed_files = glob($hashed_pattern);
        if (!empty($hashed_files)) {
            return true;
        }
        
        // Check for simple filename
        return file_exists($js_dir . $filename . '.js');
    }
    
    /**
     * Enqueue optimized JavaScript bundles
     */
    public function enqueue_optimized_scripts() {
        // Dequeue any legacy scripts
        wp_dequeue_script('front-js');
        wp_deregister_script('front-js');
        
        // Load critical path scripts (webpack chunks)
        $this->enqueue_critical_scripts();
        
        // Add inline script for performance monitoring
        $this->add_performance_monitoring();
    }
    
    
    
    /**
     * Enqueue separate library bundles
     */
    private function enqueue_critical_scripts() {
        // Add debug info to HTML comments if WP_DEBUG is on
        if (defined('WP_DEBUG') && WP_DEBUG) {
            add_action('wp_head', function() {
                $js_dir = get_template_directory() . '/js/';
                
                $available_files = array_map('basename', glob($js_dir . '*.js'));
                $libraries = array('app', 'swiper', 'modal', 'gsap', 'basicscroll');
                
                echo "\n<!-- UfoBufo Debug: Using separate library bundles -->\n";
                echo "<!-- UfoBufo Debug: JS Directory: " . $js_dir . " -->\n";
                echo "<!-- UfoBufo Debug: Available files: " . implode(', ', $available_files) . " -->\n";
                
                foreach ($libraries as $lib) {
                    $exists = !empty(glob($js_dir . $lib . '.*.js'));
                    echo "<!-- UfoBufo Debug: " . ucfirst($lib) . " found: " . ($exists ? 'yes' : 'no') . " -->\n";
                }
            });
        }
        
        // 1. Use WordPress standard jQuery
        wp_enqueue_script('jquery');
        
        // 2. Core app (always loaded first - in head to use preload)
        if ($this->js_file_exists('app')) {
            wp_enqueue_script(
                'ufobufo-app',
                $this->get_js_file('app'),
                array('jquery'),
                $this->theme_version,
                false // Load in head to use preload immediately
            );
        }
        
        // 3. Library bundles (loaded conditionally or as needed)
        $this->enqueue_library_bundles();
    }
    
    /**
     * Enqueue library files (original minified versions)
     */
    private function enqueue_library_bundles() {
        $libs_url = $this->get_theme_url() . '/js/libs/';
        
        // Load GSAP only on homepage for lens/fractal animations
        if (is_front_page() || is_page_template('homepage.php')) {
            wp_enqueue_script(
                'gsap',
                $libs_url . 'gsap.min.js',
                array(),
                '3.13.0',
                true
            );
        }
        
        // Load BasicScroll for parallax
        wp_enqueue_script(
            'basicscroll',
            $libs_url . 'basicscroll.min.js',
            array(),
            '3.0.4',
            true
        );
        
        // Load Swiper for galleries
        wp_enqueue_script(
            'swiper',
            $libs_url . 'swiper.min.js',
            array(),
            '12.0.2',
            true
        );
        
        // Load iziModal for lightbox
        wp_enqueue_script(
            'izimodal',
            $libs_url . 'izimodal.min.js',
            array('jquery'),
            '1.6.0',
            true
        );
        
        // Load iziModal CSS
        wp_enqueue_style(
            'izimodal',
            $this->get_theme_url() . '/css/izimodal.min.css',
            array(),
            '1.6.0'
        );
    }
    
    /**
     * Add preload hints for critical resources
     */
    public function add_preload_hints() {
        // Preload core app (always needed)
        if ($this->js_file_exists('app')) {
            echo '<link rel="preload" href="' . esc_url($this->get_js_file('app')) . '" as="script">' . "\n";
        }
        
        // Prefetch GSAP only on homepage (animations - loaded conditionally)
        if ($this->js_file_exists('gsap') && (is_front_page() || is_page_template('homepage.php'))) {
            echo '<link rel="prefetch" href="' . esc_url($this->get_js_file('gsap')) . '">' . "\n";
        }
        
        // Prefetch other libraries (loaded when needed)
        $prefetch_libs = array('basicscroll', 'swiper', 'modal');
        foreach ($prefetch_libs as $lib) {
            if ($this->js_file_exists($lib)) {
                echo '<link rel="prefetch" href="' . esc_url($this->get_js_file($lib)) . '">' . "\n";
            }
        }
    }
    
    /**
     * Add performance monitoring script
     */
    private function add_performance_monitoring() {
        if (!$this->is_development()) {
            return; // Only add monitoring in production
        }
        
        $monitoring_script = "
        (function() {
            if ('performance' in window && 'getEntriesByType' in performance) {
                window.addEventListener('load', function() {
                    setTimeout(function() {
                        var resources = performance.getEntriesByType('resource');
                        var jsChunks = resources.filter(function(r) {
                            return r.name.includes('/js/') && r.name.endsWith('.js');
                        });
                        
                        if (jsChunks.length > 0) {
                            console.group('🚀 UfoBufo JS Performance');
                            console.log('Loaded JS chunks:', jsChunks.length);
                            jsChunks.forEach(function(chunk) {
                                console.log(
                                    '📦 ' + chunk.name.split('/').pop(),
                                    'Size: ' + Math.round(chunk.transferSize / 1024) + 'KB',
                                    'Load time: ' + Math.round(chunk.duration) + 'ms'
                                );
                            });
                            console.groupEnd();
                        }
                    }, 1000);
                });
            }
        })();
        ";
        
        wp_add_inline_script('ufobufo-app', $monitoring_script);
    }
    
    /**
     * Helper method to get all available chunks (for debugging)
     */
    public function get_available_chunks() {
        $js_dir = get_template_directory() . '/js/';
        $chunks = array();
        
        $files = glob($js_dir . '*.js');
        foreach ($files as $file) {
            $basename = basename($file, '.js');
            // Remove hash from filename
            $basename = preg_replace('/\.[a-f0-9]{8}$/', '', $basename);
            $chunks[] = $basename;
        }
        
        return array_unique($chunks);
    }
}

// Initialize the webpack assets loader
UfoBufo_Webpack_Assets::getInstance();

/**
 * Helper function to check if optimized assets are available
 */
function ufobufo_has_optimized_assets() {
    $js_dir = get_template_directory() . '/js/';
    
    // Check for runtime and app files (the minimum required)
    $has_runtime = file_exists($js_dir . 'runtime.js') || !empty(glob($js_dir . 'runtime.*.js'));
    $has_app = file_exists($js_dir . 'app.js') || !empty(glob($js_dir . 'app.*.js'));
    
    return $has_runtime && $has_app;
}

