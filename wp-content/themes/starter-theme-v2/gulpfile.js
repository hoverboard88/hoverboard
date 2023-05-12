const babel = require('gulp-babel');
const browserSync = require('browser-sync').create();
const cssnano = require('gulp-cssnano');
const concat = require('gulp-concat');
const { dest, parallel, src, watch } = require('gulp');
const postcss = require('gulp-postcss');
const svgo = require('gulp-svgo');
const uglify = require('gulp-uglify');

const globs = {
	js: ['parts/**/*.js'],
	blocksjs: ['blocks/**/*.js'],
	css: ['./assets/css/global/*.css', './parts/**/*.css'],
	editorcss: ['./assets/css/global/variable.css', './parts/**/*.css'],
	blocks: ['./assets/css/global/variable.css', './blocks/**/*.css'],
	php: ['**/*.php'],
	images: ['assets/images/*'],
};

function js() {
	return src(globs.js)
		.pipe(babel({ presets: ['@babel/preset-env'] }))
		.pipe(concat('main.js'))
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

function editorcss() {
	return src(globs.editorcss)
		.pipe(concat('editor.css'))
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
		host: 'custom.lndo.site',
		port: 3000,
		proxy: 'https://custom.lndo.site',
		open: false,
	});
}

function watchFiles() {
	connectSync();

	watch(globs.css, parallel([css, browserSyncReload]));
	watch(globs.editorcss, parallel([editorcss, browserSyncReload]));
	watch(globs.blocks, parallel([blocks, browserSyncReload]));
	watch(globs.js, parallel([js, browserSyncReload]));
	watch(globs.blocksjs, parallel([browserSyncReload]));
	watch(globs.php, parallel([browserSyncReload]));
}

function browserSyncReload(done) {
	browserSync.reload();
	done();
}

exports.default = parallel([css, editorcss, blocks, js]);
exports.watch = parallel([css, editorcss, blocks, js, watchFiles]);
