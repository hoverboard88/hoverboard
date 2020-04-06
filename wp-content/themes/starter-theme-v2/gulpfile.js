const { parallel, src, dest } = require('gulp');
const postcss = require('gulp-postcss');
const concat = require('gulp-concat');
const sourcemaps = require('gulp-sourcemaps');
const babel = require('gulp-babel');
const webpack = require('webpack-stream');

// TODO: Can this concatenate all the modules/**.*.js files?
function mainJS() {
	return (
		src(['modules/**/*.js', 'src/js/modules.js', 'src/js/animate.js'])
			.pipe(sourcemaps.init())
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
			// .pipe(
			// 	babel({
			// 		presets: ['@babel/preset-env'],
			// 	})
			// )
			.pipe(concat('main.js'))
			.pipe(sourcemaps.write('.'))
			// TODO: Uglify?
			.pipe(dest('./assets/js'))
	);
}

function mainCSS() {
	return (
		src(['./src/css/global/*.css', './modules/**/*.css'])
			.pipe(sourcemaps.init())
			.pipe(postcss()) // Config in postcss.config.js
			.pipe(concat('main.css'))
			.pipe(sourcemaps.write('.'))
			// TODO: Uglify?
			.pipe(dest('./assets/css'))
	);
}

// TODO: Images

// TODO: Browser Sync

exports.build = parallel(mainCSS, mainJS);
// exports.watch = parallel(browserSync, animateJS, mainCSS, mainJS);
