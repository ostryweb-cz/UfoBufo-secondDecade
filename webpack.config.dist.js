/**
 * Webpack Configuration for WordPress Theme Distribution
 * Builds production-ready theme in /dist/ directory
 */

const path = require('path');
const CopyWebpackPlugin = require('copy-webpack-plugin');
const { CleanWebpackPlugin } = require('clean-webpack-plugin');

const isDevelopment = process.env.NODE_ENV === 'development';
const themeName = 'UfoBufo-secondDecade';
const distPath = path.resolve(__dirname, 'dist', themeName);

module.exports = {

    mode: isDevelopment ? 'development' : 'production',
    
    entry: {},
    
    output: {
        path: distPath
    },

    plugins: [
        new CleanWebpackPlugin({
            cleanOnceBeforeBuildPatterns: [distPath]
        }),

        new CopyWebpackPlugin({
            patterns: [
                // PHP files
                {
                    from: '*.php',
                    to: distPath,
                    globOptions: {
                        ignore: ['**/node_modules/**', '**/dist/**']
                    }
                },
                {
                    from: 'template-parts/**/*.php',
                    to: distPath
                },
                {
                    from: 'inc/**/*.php',
                    to: distPath
                },

                // CSS
                {
                    from: 'css/front.min.css',
                    to: path.join(distPath, 'css')
                },
                {
                    from: 'css/2026.css',
                    to: path.join(distPath, 'css')
                },
                
                // JavaScript
                {
                    from: 'js/front.js',
                    to: path.join(distPath, 'js')
                },
                {
                    from: 'js/ostryweb.js',
                    to: path.join(distPath, 'js')
                },
                
                // Vendor libraries
                {
                    from: 'node_modules/swiper/swiper-bundle.min.js',
                    to: path.join(distPath, 'js/vendor/swiper.min.js')
                },
                {
                    from: 'node_modules/gsap/dist/gsap.min.js',
                    to: path.join(distPath, 'js/vendor/gsap.min.js')
                },
                {
                    from: 'node_modules/izimodal/js/iziModal.min.js',
                    to: path.join(distPath, 'js/vendor/iziModal.min.js')
                },
                {
                    from: 'node_modules/basicscroll/dist/basicScroll.min.js',
                    to: path.join(distPath, 'js/vendor/basicscroll.min.js')
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
    
    devtool: isDevelopment ? 'eval-source-map' : 'source-map',
    
    performance: {
        hints: isDevelopment ? false : 'warning',
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
