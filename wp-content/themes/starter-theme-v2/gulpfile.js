const { dest, parallel, src, watch } = require('gulp');
const babel = require('gulp-babel');
const browserSync = require('browser-sync').create();
const cssnano = require('gulp-cssnano');
const concat = require('gulp-concat');
const postcss = require('gulp-postcss');
const rename = require('gulp-rename');
const sourcemaps = require('gulp-sourcemaps');
const uglify = require('gulp-uglify-es').default;

const globs = {
	js: ['parts/**/*.js'],
	blocks: ['blocks/**/*.js'],
	css: ['./assets/css/global/*.css', './parts/**/*.css'],
	editorcss: ['./assets/css/global/variable.css', './parts/**/*.css'],
	php: ['**/*.php'],
};

function processCss(source, filename) {
	return src(source)
		.pipe(sourcemaps.init())
		.pipe(concat(filename))
		.pipe(postcss())
		.pipe(cssnano())
		.pipe(dest('./assets/css', { sourcemaps: true }));
}

function js() {
	return src(globs.js)
		.pipe(sourcemaps.init())
		.pipe(babel({ presets: ['@babel/preset-env'] }))
		.pipe(concat('main.min.js'))
		.pipe(uglify())
		.pipe(dest('./assets/js', { sourcemaps: true }));
}

function blocks() {
	return src(globs.blocks)
		.pipe(sourcemaps.init())
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
	return processCss(globs.css, 'main.min.css');
}

function editorcss() {
	return processCss(globs.editorcss, 'editor.min.css');
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
	watch(globs.js, parallel(js, browserSyncReload));
	watch(globs.blocks, browserSyncReload);
	watch(globs.php, browserSyncReload);
}

function browserSyncReload(done) {
	browserSync.reload();
	done();
}

exports.default = parallel([css, editorcss, blocks, js]);
exports.watch = parallel([css, editorcss, js, watchFiles]);
