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

// const getAllModules = () => {
//   const base = process.cwd() + '/src/css/**/*.css';
//   const modules = process.cwd() + '/modules/**/**.css';

//   return globby(modules)
//   .then(files => {
//       const res = files.map(f => path.normalize(f))
//       return postcss(postcssImport({ path: res }));
//     })
// }

// const findFile = (id, base) => {
//   const parsed = path.parse(id)
//   const formats = [
//     '%', // full file path
//     '%.scss', // SCSS
//     '_%.scss', // SCSS partial
//     '%.css', // CSS
//     '%.json', // JSON data (Sass variables)
//     '%/style.scss' // Folder containing SCSS
//   ]

//   let out = []
//   let file = ''
//   formats.forEach(format => {
//     let unresolved = path.join(parsed.dir, format.replace('%', parsed.base))
//     out.push(path.join(base, unresolved))
//     file = out.reduce((a, b) => {
//       if (fs.existsSync(a)) {
//         return a
//       }
//       return b
//     })
//   })

//   return Promise.resolve(file)
// }

// const resolve = (id, base, options) => {
//   console.log('resolve...', id);

//   if (/<\D[^>]*>/.test(id)) {
//     return getAllModules();
//   } else {
//     return getAllModules();
//     // return findFile(id, base)
//   }
// }

// const init = (opts = {}) => {
//   opts.resolve = resolve
//   return postcss([postcssImport(opts)])
// }
