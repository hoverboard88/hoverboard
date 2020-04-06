const { parallel, src, dest, watch, series } = require('gulp');
const postcss = require('gulp-postcss');
const concat = require('gulp-concat');
const sourcemaps = require('gulp-sourcemaps');
const browserSync = require('browser-sync').create();
const uglify = require('gulp-uglify');
// TODO: If you don't use, remove from package.json and any other unused modules
const babel = require('gulp-babel');
// const webpack = require('webpack-stream');

const cssGlob = ['./src/css/global/*.css', './modules/**/*.css'];
const jsGlob = ['modules/**/*.js', 'src/js/modules.js', 'src/js/animate.js'];
const phpGlob = ['**/*.php'];

// TODO: Can this concatenate all the modules/**.*.js files?
function mainJS() {
	return (
		src(jsGlob)
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
		src(cssGlob)
			.pipe(sourcemaps.init())
			.pipe(concat('main.css'))
			.pipe(postcss()) // Config in postcss.config.js
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
		files: ['**/*.php', '**/*.css'],
		open: false,
	});
}

function watchFiles() {
	connectSync();

	watch(cssGlob, parallel([mainCSS, browserSyncReload]));
	watch(jsGlob, parallel([mainJS, browserSyncReload]));
	watch(phpGlob, parallel([browserSyncReload]));
}

function browserSyncReload(done) {
	browserSync.reload();
	done();
}

// TODO: Images
exports.build = parallel([mainCSS, mainJS]);
exports.default = parallel([mainCSS, mainJS, watchFiles]);
