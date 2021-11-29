const babel = require('gulp-babel');
const browserSync = require('browser-sync').create();
const cssnano = require('gulp-cssnano');
const concat = require('gulp-concat');
const { dest, parallel, src, watch } = require('gulp');
const postcss = require('gulp-postcss');
const svgo = require('gulp-svgo');
const uglify = require('gulp-uglify');

const globs = {
	js: ['src/js/*.js', 'modules/**/*.js'],
	vendorjs: ['src/js/vendor/**/*.js'],
	css: ['./src/css/global/*.css', './modules/**/*.css'],
	editorcss: ['./src/css/global/variable.css', './modules/**/*.css'],
	vendorcss: ['src/css/vendor/**/*.css'],
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
		.pipe(dest('./assets/js'));
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

function vendorcss() {
	return src(globs.vendorcss)
		.pipe(concat('vendor.css'))
		.pipe(cssnano())
		.pipe(dest('./assets/css'));
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
		proxy: 'http://appserver_nginx', // Could be 'http://appserver' if you're running apache.
		socket: {
			domain: 'https://bs.hoverboard-custom-upstream.lndo.site', // The node proxy domain you defined in .lando.yaml. Must be https?
			port: 80, // NOT the 3000 you might expect.
		},
		open: false,
		logLevel: 'debug',
		logConnections: true,
	});
}

function watchFiles() {
	connectSync();

	watch(globs.css, parallel([css, browserSyncReload]));
	watch(globs.editorcss, parallel([editorcss, browserSyncReload]));
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
	return src(globs.images)
		.pipe(
			svgo({
				plugins: [
					{
						removeViewBox: false,
					},
				],
			})
		)
		.pipe(dest('./assets/images'));
}

exports.default = parallel([
	vendorcss,
	css,
	editorcss,
	blocks,
	js,
	vendorjs,
	images,
]);
exports.watch = parallel([
	vendorcss,
	css,
	editorcss,
	blocks,
	js,
	vendorjs,
	images,
	watchFiles,
]);
