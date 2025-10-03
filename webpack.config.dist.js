/**
 * Webpack Configuration for WordPress Theme Distribution
 * 
 * This configuration builds a clean, production-ready WordPress theme
 * in the /dist/ directory ready for deployment.
 */

const path = require('path');
const CopyWebpackPlugin = require('copy-webpack-plugin');
const { CleanWebpackPlugin } = require('clean-webpack-plugin');

module.exports = (env, argv) => {
    const isProduction = argv.mode === 'production';
    const themeName = 'UfoBufo-secondDecade';
    const distPath = path.resolve(__dirname, 'dist', themeName);

    return {
        mode: isProduction ? 'production' : 'development',
        
        // No entry point - we're just copying files, not compiling
        entry: {},

        // Output is not used but required by webpack
        output: {
            path: distPath
        },

        plugins: [
            // Clean dist folder before build
            new CleanWebpackPlugin({
                cleanOnceBeforeBuildPatterns: [distPath]
            }),

            // Copy all necessary theme files to dist
            new CopyWebpackPlugin({
                patterns: [
                    // PHP template files (root level)
                    {
                        from: '*.php',
                        to: distPath,
                        globOptions: {
                            ignore: ['**/node_modules/**', '**/dist/**']
                        }
                    },
                    
                    // Template parts
                    {
                        from: 'template-parts/**/*.php',
                        to: distPath
                    },

                    // Include directory with PHP helpers
                    {
                        from: 'inc/**/*.php',
                        to: distPath
                    },

                    // Compiled CSS
                    {
                        from: 'css/front.min.css',
                        to: path.join(distPath, 'css')
                    },
                    {
                        from: 'css/2025.css',
                        to: path.join(distPath, 'css')
                    },

                    // Old JS files (already compiled)
                    {
                        from: 'js/front.js',
                        to: path.join(distPath, 'js'),
                        noErrorOnMissing: true
                    },
                    {
                        from: 'js/ostryweb.js',
                        to: path.join(distPath, 'js')
                    },

                    // Library files (minified versions from node_modules)
                    {
                        from: 'node_modules/swiper/swiper-bundle.min.js',
                        to: path.join(distPath, 'js/libs/swiper.min.js')
                    },
                    {
                        from: 'node_modules/swiper/swiper-bundle.min.js.map',
                        to: path.join(distPath, 'js/libs/swiper.min.js.map'),
                        noErrorOnMissing: true
                    },
                    {
                        from: 'node_modules/gsap/dist/gsap.min.js',
                        to: path.join(distPath, 'js/libs/gsap.min.js')
                    },
                    {
                        from: 'node_modules/basicscroll/dist/basicScroll.min.js',
                        to: path.join(distPath, 'js/libs/basicscroll.min.js')
                    },
                    {
                        from: 'node_modules/izimodal/js/iziModal.min.js',
                        to: path.join(distPath, 'js/libs/izimodal.min.js')
                    },
                    {
                        from: 'node_modules/izimodal/css/iziModal.min.css',
                        to: path.join(distPath, 'css/izimodal.min.css'),
                        noErrorOnMissing: true
                    },

                    // Fonts
                    {
                        from: 'fonts/**/*',
                        to: distPath
                    },

                    // Images
                    {
                        from: 'img/**/*',
                        to: distPath,
                        globOptions: {
                            ignore: ['**/.DS_Store']
                        }
                    },

                    // Theme metadata
                    {
                        from: 'style.css',
                        to: distPath
                    },
                    {
                        from: 'screenshot.png',
                        to: distPath
                    },

                    // Languages
                    {
                        from: 'languages/**/*',
                        to: distPath,
                        noErrorOnMissing: true
                    },

                    // Documentation
                    {
                        from: 'WARP.md',
                        to: path.join(distPath, 'THEME_DOCS.md'),
                        noErrorOnMissing: true
                    }
                ]
            })
        ],

        // Source maps for production debugging
        devtool: isProduction ? 'source-map' : 'eval-source-map',

        // Performance hints
        performance: {
            hints: isProduction ? 'warning' : false,
            maxEntrypointSize: 512000,
            maxAssetSize: 512000
        },

        stats: {
            colors: true,
            modules: false,
            children: false,
            chunks: false,
            chunkModules: false
        }
    };
};
