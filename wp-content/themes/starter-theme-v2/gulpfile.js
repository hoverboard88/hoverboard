const { dest, parallel, src, watch } = require('gulp');
const babel = require('gulp-babel');
const browserSync = require('browser-sync').create();
const cssnano = require('gulp-cssnano');
const concat = require('gulp-concat');
const postcss = require('gulp-postcss');
const rename = require('gulp-rename');
const uglify = require('gulp-uglify-es').default;

const globs = {
	js: ['parts/**/*.js'],
	blocksjs: ['blocks/**/*.js'],
	css: ['./assets/css/global/*.css', './parts/**/*.css'],
	editorcss: ['./assets/css/global/variable.css', './parts/**/*.css'],
	blocks: ['./assets/css/global/variable.css', './blocks/**/*.css'],
	php: ['**/*.php'],
};

function processCss(source, filename) {
	return src(source)
		.pipe(concat(filename))
		.pipe(postcss())
		.pipe(cssnano())
		.pipe(dest('./assets/css', { sourcemaps: true }));
}

function js() {
	return src(globs.js)
		.pipe(babel({ presets: ['@babel/preset-env'] }))
		.pipe(concat('main.js'))
		.pipe(uglify())
		.pipe(dest('./assets/js', { sourcemaps: true }));
}

function blocksjs() {
	return src(globs.blocksjs)
		.pipe(babel({ presets: ['@babel/preset-env'] }))
		.pipe(uglify())
		.pipe(
			rename((path) => {
				path.basename += '.min';
				return path;
			})
		)
		.pipe(dest('./blocks/', { sourcemaps: true }));
}

function css() {
	return processCss(globs.css, 'main.css');
}

function editorcss() {
	return processCss(globs.editorcss, 'editor.css');
}

function blocks() {
	return processCss(globs.blocks, 'blocks.css');
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

	watch(globs.css, parallel(css, browserSyncReload));
	watch(globs.editorcss, parallel(editorcss, browserSyncReload));
	watch(globs.blocks, parallel(blocks, browserSyncReload));
	watch(globs.js, parallel(js, browserSyncReload));
	watch(globs.blocksjs, browserSyncReload);
	watch(globs.php, browserSyncReload);
}

function browserSyncReload(done) {
	browserSync.reload();
	done();
}

exports.default = parallel([css, editorcss, blocks, blocksjs, js]);
exports.watch = parallel([css, editorcss, blocks, js, watchFiles]);
