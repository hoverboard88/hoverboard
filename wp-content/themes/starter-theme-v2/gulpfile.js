const { parallel, src, dest, watch, series } = require('gulp');
const postcss = require('gulp-postcss');
const concat = require('gulp-concat');
const sourcemaps = require('gulp-sourcemaps');
const browserSync = require('browser-sync').create();
const uglify = require('gulp-uglify');
// TODO: If you don't use, remove from package.json and any other unused modules
const babel = require('gulp-babel');
const svgo = require('gulp-svgo');

// const webpack = require('webpack-stream');

const glob = {
	css: ['./src/css/global/*.css', './modules/**/*.css'],
	js: ['modules/**/*.js', 'src/js/modules.js', 'src/js/animate.js'],
	php: ['**/*.php'],
	image: ['src/images/*'],
};

// TODO: Can this concatenate all the modules/**.*.js files?
function mainJS() {
	return (
		src(glob.js)
			.pipe(sourcemaps.init())
			.pipe(concat('main.js'))
			// TODO: import/exports not working like in Rollup.
			// .pipe(
			// 	webpack({
			// 		module: {
			// 			rules: [{ test: /\.js$/ }],
			// 		},
			// 		output: {
			// 			libraryTarget: 'umd',
			// 		},
			// 	})
			// )
			.pipe(
				babel({
					presets: ['@babel/preset-env'],
				})
			)
			.pipe(uglify())
			.pipe(sourcemaps.write('.'))
			.pipe(dest('./assets/js'))
	);
}

function mainCSS() {
	return (
		src(glob.css)
			.pipe(sourcemaps.init())
			.pipe(concat('main.css'))
			.pipe(postcss()) // Config in postcss.config.js
			// TODO: Error's on CSS
			// .pipe(uglify())
			.pipe(sourcemaps.write('.'))
			.pipe(dest('./assets/css'))
	);
}

function connectSync() {
	return browserSync.init({
		host: 'https://hoverboard-custom-upstream.lndo.site',
		port: 3000,
		proxy: 'https://hoverboard-custom-upstream.lndo.site',
		open: false,
	});
}

function watchFiles() {
	connectSync();

	watch(glob.css, parallel([mainCSS, browserSyncReload]));
	watch(glob.js, parallel([mainJS, browserSyncReload]));
	watch(glob.php, parallel([browserSyncReload]));
	watch(glob.image, parallel([images]));
}

function browserSyncReload(done) {
	browserSync.reload();
	done();
}

function images() {
	return src(glob.image).pipe(svgo()).pipe(dest('./assets/images'));
}

exports.default = parallel([mainCSS, mainJS, images]);
exports.watch = parallel([mainCSS, mainJS, images, watchFiles]);
