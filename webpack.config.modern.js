const path = require('path');
const webpack = require('webpack');
const packageJson = require('./package.json');

const isDevelopment = process.env.NODE_ENV === 'development';
const version = packageJson.version.replace(/\./g, '_'); // v0_0_2

// Library versions from package.json dependencies
const libraryVersions = {
    swiper: packageJson.dependencies.swiper.replace(/[^\d.]/g, '').replace(/\./g, '_'),
    gsap: packageJson.dependencies.gsap.replace(/[^\d.]/g, '').replace(/\./g, '_'),
    basicscroll: packageJson.dependencies.basicscroll.replace(/[^\d.]/g, '').replace(/\./g, '_')
};

module.exports = {
    mode: isDevelopment ? 'development' : 'production',
    
    entry: {
        app: './assets/js/main.js'
    },
    
    // Use external jQuery from WordPress instead of bundling it
    externals: {
        'jquery': 'jQuery'
    },
    
    // Output configuration
    output: {
        path: path.resolve(__dirname, 'js'),
        filename: isDevelopment ? 'app.js' : `app.v${version}.[contenthash:8].js`,
        publicPath: '/wp-content/themes/UfoBufo-secondDecade/js/',
        clean: true // Clean the output directory before build
    },
    
    module: {
        rules: [
            {
                test: /\.jsx?$/,
                exclude: /node_modules/,
                use: {
                    loader: 'babel-loader',
                    options: {
                        presets: [
                            ['@babel/preset-env', {
                                targets: {
                                    browsers: ['> 1%', 'last 2 versions', 'not ie <= 11']
                                },
                                modules: false, // Let webpack handle modules
                                useBuiltIns: 'usage',
                                corejs: 3
                            }]
                        ],
                        plugins: [
                            '@babel/plugin-syntax-dynamic-import'
                        ],
                        cacheDirectory: true
                    }
                }
            }
        ]
    },
    
    
    plugins: [
        // Define environment variables
        new webpack.DefinePlugin({
            'process.env.NODE_ENV': JSON.stringify(process.env.NODE_ENV || 'development')
        }),
        
        // jQuery is now provided by WordPress - no need to bundle it
    ],
    
    // Performance budgets
    performance: {
        hints: isDevelopment ? false : 'warning',
        maxEntrypointSize: 250000, // 250kb
        maxAssetSize: 250000,
        assetFilter: (assetFilename) => {
            return assetFilename.endsWith('.js');
        }
    },
    
    devtool: isDevelopment ? 'eval-source-map' : 'source-map',
    
    stats: {
        colors: true,
        modules: false,
        children: false,
        chunks: false,
        chunkModules: false
    }
};