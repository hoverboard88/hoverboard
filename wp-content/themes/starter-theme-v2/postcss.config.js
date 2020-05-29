const postcssNested = require('postcss-nested');
const postcssCustomMedia = require('postcss-custom-media');
const autoprefixer = require('autoprefixer');
const extend = require('postcss-extend');

module.exports = {
	extract: true,
	minimize: true,
	plugins: [postcssCustomMedia(), extend(), postcssNested(), autoprefixer()],
	sourceMap: true,
};
