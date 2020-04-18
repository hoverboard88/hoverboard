const babel = require('gulp-babel');
const browserSync = require('browser-sync').create();
// TODO: gulp-uglify doesn't play well with postcss; recommends using cssnano
// cssnano() minified the code but broke parts of the design.
// .pipe(postcss([cssnano()]))
const cssnano = require('cssnano');
const concat = require('gulp-concat');
const { dest, parallel, src, watch } = require('gulp');
const postcss = require('gulp-postcss');
const svgo = require('gulp-svgo');
const uglify = require('gulp-uglify');

function js() {
	return src(['src/js/**/*.js', 'modules/**/*.js'])
		.pipe(babel({ presets: ['@babel/preset-env'] }))
		.pipe(concat('main.js'))
		.pipe(uglify())
		.pipe(dest('./assets/js', { sourcemaps: true }));
}

function css() {
	return src(['./src/css/global/*.css', './modules/**/*.css'])
		.pipe(concat('main.css'))
		.pipe(postcss())
		.pipe(dest('./assets/css', { sourcemaps: true }));
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

	watch(
		['./src/css/global/*.css', './modules/**/*.css'],
		parallel([css, browserSyncReload])
	);
	watch(
		['modules/**/*.js', 'src/js/modules.js', 'src/js/animate.js'],
		parallel([js, browserSyncReload])
	);
	watch(['**/*.php'], parallel([browserSyncReload]));
	watch(['src/images/*'], parallel([images]));
}

function browserSyncReload(done) {
	browserSync.reload();
	done();
}

function images() {
	return src(['src/images/*']).pipe(svgo()).pipe(dest('./assets/images'));
}

exports.default = parallel([css, js, images]);
exports.watch = parallel([css, js, images, watchFiles]);
