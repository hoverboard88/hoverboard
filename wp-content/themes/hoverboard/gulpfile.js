const { dest, parallel, src, watch } = require('gulp');
const autoprefixer = require('autoprefixer');
const babel = require('gulp-babel');
const browserSync = require('browser-sync').create();
const cssnano = require('gulp-cssnano');
const concat = require('gulp-concat');
const postcss = require('gulp-postcss');
const postcssNested = require('postcss-nested');
const rename = require('gulp-rename');
const sourcemaps = require('gulp-sourcemaps');
const uglify = require('gulp-uglify-es').default;

const globs = {
	js: ['./src/js/*.js', 'parts/**/*.js'],
	blocksjs: ['blocks/*/*.js'],
	css: ['./src/css/*.css', './parts/**/*.css'],
	blockscss: ['./blocks/*/*.css'],
	editorcss: [
		'./src/css/variable.css',
		'./src/css/helper.css',
		'./parts/**/*.css',
		'./blocks/*/*.css',
	],
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

function blocksjs() {
	return src(globs.blocksjs)
		.pipe(sourcemaps.init())
		.pipe(babel({ presets: ['@babel/preset-env'] }))
		.pipe(uglify())
		.pipe(
			rename((path) => {
				path.dirname += '/assets';
				path.basename += '.min';
				return path;
			})
		)
		.pipe(dest('./blocks', { sourcemaps: true }));
}

function css() {
	return processCss(globs.css, 'main.min.css');
}

function blockscss() {
	return src(globs.blockscss)
		.pipe(sourcemaps.init())
		.pipe(postcss([postcssNested(), autoprefixer()]))
		.pipe(cssnano())
		.pipe(
			rename((path) => {
				path.dirname += '/assets';
				path.basename += '.min';
				return path;
			})
		)
		.pipe(dest('./blocks/'));
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
	watch(globs.blockscss, parallel(blockscss, browserSyncReload));
	watch(globs.editorcss, parallel(editorcss, browserSyncReload));
	watch(globs.js, parallel(js, browserSyncReload));
	watch(globs.blocksjs, parallel(blocksjs, browserSyncReload));
	watch(globs.php, browserSyncReload);
}

function browserSyncReload(done) {
	browserSync.reload();
	done();
}

exports.default = parallel([css, blockscss, editorcss, js, blocksjs]);
exports.watch = parallel([css, blockscss, editorcss, js, blocksjs, watchFiles]);
