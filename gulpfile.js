//gulp
var gulp = require("gulp");
var sass = require("gulp-sass");
var gutil = require("gulp-util");
var uglify = require("gulp-uglify");
var rename = require("gulp-rename");
var concat = require("gulp-concat");
var notify = require("gulp-notify");
var cache = require("gulp-cache");
var sourcemaps = require("gulp-sourcemaps");
var livereload = require("gulp-livereload");
var size = require("gulp-size");
var gulpFilter = require("gulp-filter");
var autoprefixer = require('gulp-autoprefixer');
// webpack
var webpack = require("webpack");
var webpackStream = require("webpack-stream");
//prikazova radka
var yargs = require("yargs");
//utils
var del = require("del");
//Enviroment
var environments = require("gulp-environments");
var development = environments.development;
var production = environments.production;
var staging = environments.make("staging");
// Styles
gulp.task("styles", function () {
	gulp.src("css/sass/front.sass")
	// Make styles
		//.pipe(sourcemaps.init())
		.pipe(sass({
			outputStyle: "compressed",
			precision: 10
		}))
		.pipe(rename({suffix: ".min"}))
		.pipe(autoprefixer({
			browsers: ['last 2 versions'],
			cascade: false
		}))
		//.pipe(sourcemaps.write("/"))
		.pipe(gulp.dest("css"))
		.pipe(gulpFilter("**/*.css"))
		.pipe(livereload())
		.pipe(notify({message: "Styles task complete", onLast: true}));
});
gulp.task("autoprefixer", function () {
	gulp.src("css/front.min.css")
	// Make styles
		.pipe(autoprefixer({
			browsers: ['last 2 versions'],
			cascade: false
		}))
		.pipe(gulp.dest("css/"));
});
// Webpack
// modify some webpack config options
var webpackConfig = Object.create(require("./webpack.config.js"));
if (production()) {
	gutil.log("==============================");
	gutil.log("Production build");
	gutil.log("==============================");
	webpackConfig.devtool = "";
	webpackConfig.plugins.push(
		new webpack.optimize.UglifyJsPlugin({minimize: true})
	);
} else if (staging()) {
	gutil.log("==============================");
	gutil.log("Staging build");
	gutil.log("==============================");
	webpackConfig.devtool = "source-map";
	webpackConfig.plugins.push(
		new webpack.optimize.UglifyJsPlugin({minimize: true})
	);
} else {
	gutil.log("==============================");
	gutil.log("Development build");
	gutil.log("==============================");
	webpackConfig.devtool = "inline-source-map";
}
// create a single instance of the compiler to allow caching
var packCompiler = webpack(webpackConfig);
gulp.task("webpack", function(callback) {
	// run webpack
	packCompiler.run(function(err, stats) {
		if(err) throw new gutil.PluginError("webpack", err);
		gutil.log("[webpack]", stats.toString({
			colors: true
		}));
		callback();
	});
});
gulp.task("webpack-stream", function(callback) {
	return gulp.src("js/src/app.js")
		.pipe(webpackStream(webpackConfig))
		.pipe(gulp.dest("js/"));
});
// Watch
gulp.task("watch", function () {
	// Create LiveReload server
	livereload.listen();
	// Watch .sass files
	gulp.watch("css/sass/**/*.sass", ["styles"]);
	// Watch .js files
	gulp.watch("js/!(vendor|output)/**/*", {"events":["change","error"],"readDelay":300},["webpack"]);
	// Watch any files in dist/, reload on change
	//gulp.watch(["dist/**"]).on("change", livereload.changed);
});
// default
gulp.task("default", ["styles", "webpack"]);
gulp.task("install", ["styles", "webpack-stream"]);