const babel = require('gulp-babel');
const browserSync = require('browser-sync').create();
const cssnano = require('gulp-cssnano');
const concat = require('gulp-concat');
const { dest, parallel, src, watch } = require('gulp');
const postcss = require('gulp-postcss');
const svgo = require('gulp-svgo');
const uglify = require('gulp-uglify');

const globs = {
	js: ['src/js/*.js', 'modules/!(vendor)/*.js'],
	vendorjs: ['src/js/vendor/**/*.js'],
	css: ['./src/css/global/*.css', './modules/**/*.css'],
	blocks: ['./src/css/global/variable.css', './src/css/blocks/**/*.css'],
	php: ['**/*.php'],
	images: ['src/images/*'],
};

function js() {
	return src(globs.js)
		.pipe(babel({ presets: ['@babel/preset-env'] }))
		.pipe(concat('main.js'))
		.pipe(uglify())
		.pipe(dest('./assets/js', { sourcemaps: true }));
}

function vendorjs() {
	return src(globs.vendorjs)
		.pipe(concat('vendor.js'))
		.pipe(uglify())
		.pipe(dest('./assets/js', { sourcemaps: true }));
}

function css() {
	return src(globs.css)
		.pipe(concat('main.css'))
		.pipe(postcss())
		.pipe(cssnano())
		.pipe(dest('./assets/css', { sourcemaps: true }));
}

function blocks() {
	return src(globs.blocks)
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

	watch(globs.css, parallel([css, browserSyncReload]));
	watch(globs.blocks, parallel([blocks, browserSyncReload]));
	watch(globs.vendorjs, parallel([vendorjs, browserSyncReload]));
	watch(globs.js, parallel([js, browserSyncReload]));
	watch(globs.php, parallel([browserSyncReload]));
	watch(globs.images, parallel([images]));
}

function browserSyncReload(done) {
	browserSync.reload();
	done();
}

function images() {
	return src(globs.images).pipe(svgo()).pipe(dest('./assets/images'));
}

exports.default = parallel([css, blocks, js, vendorjs, images]);
exports.watch = parallel([css, blocks, js, vendorjs, images, watchFiles]);
