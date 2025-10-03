var webpack = require("webpack");
var path = require("path");
var nodeModulesPath = path.resolve(__dirname, "node_modules");
module.exports = {
	entry: {
		front: __dirname + "/js/src/app.js"
	},
	output: {
		path: __dirname + "/js",
		filename: "[name].js"
	},
	module: {
		loaders: [
			{
				test: /\.jsx?$/,
				//loader: "babel-loader",
                loader: 'babel?presets[]=es2015',
				exclude: [nodeModulesPath, "/vendor/", "/web/"]
			}
		]
	},


	resolve: {
		alias: {
			"masonry/masonry": "masonry-layout"
		}
	},
	// devtool: "eval-cheap-module-source-map",
	plugins: [
		new webpack.ProvidePlugin({
			$: "jquery",
			jQuery: "jquery",
			"window.jQuery": "jquery"
		})
	]
};