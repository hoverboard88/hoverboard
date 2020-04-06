const postcssNested = require('postcss-nested');
const postcssCustomMedia = require('postcss-custom-media');
const autoprefixer = require('autoprefixer');

module.exports = {
	extract: true,
	minimize: true,
	plugins: [postcssCustomMedia(), postcssNested(), autoprefixer()],
	sourceMap: true,
};
