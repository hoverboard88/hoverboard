const postcssNested = require('postcss-nested');
const postcssCustomMedia = require('postcss-custom-media');
const autoprefixer = require('autoprefixer');
const atImport = require('postcss-import');

module.exports = {
	extract: true,
	minimize: true,
	plugins: [atImport(), postcssCustomMedia(), postcssNested(), autoprefixer()],
	sourceMap: true,
};
