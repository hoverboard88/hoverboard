const babel = require('gulp-babel');
const browserSync = require('browser-sync').create();
const cssnano = require('gulp-cssnano');
const concat = require('gulp-concat');
const { dest, parallel, src, watch } = require('gulp');
const postcss = require('gulp-postcss');
const svgo = require('gulp-svgo');
const uglify = require('gulp-uglify');

function js() {
	return src(['src/js/*.js', 'modules/!(vendor)/*.js'])
		.pipe(babel({ presets: ['@babel/preset-env'] }))
		.pipe(concat('main.js'))
		.pipe(uglify())
		.pipe(dest('./assets/js', { sourcemaps: true }));
}

function vendorjs() {
	return src(['src/js/vendor/**/*.js'])
		.pipe(concat('vendor.js'))
		.pipe(uglify())
		.pipe(dest('./assets/js', { sourcemaps: true }));
}

function css() {
	return src(['./src/css/global/*.css', './modules/**/*.css'])
		.pipe(concat('main.css'))
		.pipe(postcss())
		.pipe(cssnano())
		.pipe(dest('./assets/css', { sourcemaps: true }));
}

function blocks() {
	return src(['./src/css/global/variable.css', './src/css/blocks/**/*.css'])
		.pipe(concat('blocks.css'))
		.pipe(postcss())
		.pipe(cssnano())
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
		['./src/css/global/variable.css', './src/css/blocks/**/*.css'],
		parallel([blocks, browserSyncReload])
	);
	watch(
		['modules/**/*.js', 'src/js/**/*.js'],
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

exports.default = parallel([css, blocks, js, vendorjs, images]);
exports.watch = parallel([css, blocks, js, vendorjs, images, watchFiles]);
