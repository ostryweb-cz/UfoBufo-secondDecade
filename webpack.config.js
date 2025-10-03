const path = require('path');

const isDevelopment = process.env.NODE_ENV === 'development';

module.exports = {
    mode: isDevelopment ? 'development' : 'production',
    
    entry: {
        front: './js/src/app.js'
    },
    
    // Use external libraries - don't bundle them
    externals: {
        'jquery': 'jQuery'
    },
    
    output: {
        path: path.resolve(__dirname, 'js'),
        filename: '[name].js',
        clean: false
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
                                targets: '> 0.25%, not dead',
                                modules: false,
                                useBuiltIns: 'usage',
                                corejs: 3
                            }]
                        ],
                        cacheDirectory: true
                    }
                }
            }
        ]
    },
    plugins: [],
    
    performance: {
        hints: isDevelopment ? false : 'warning',
        maxEntrypointSize: 250000,
        maxAssetSize: 250000
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