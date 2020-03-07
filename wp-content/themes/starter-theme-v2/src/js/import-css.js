const postcss = require('postcss');
const postcssImport = require('postcss-import');
const globby = require('globby');

async function resolve() {
	try {
		const base = process.cwd() + '/src/css/global/**/*.css';
		const modules = process.cwd() + '/modules/**/**.css';
		return await globby([base, modules]);
	} catch (error) {
		console.error(error);
	}
}

function init(opts = {}) {
	opts.resolve = resolve;
	return postcss([postcssImport(opts)]);
}

module.exports = postcss.plugin('import-css', init);
