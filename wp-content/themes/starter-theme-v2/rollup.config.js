import babel from 'rollup-plugin-babel';
import copy from 'rollup-plugin-copy';
import postcss from 'rollup-plugin-postcss'
import postcssNested from 'postcss-nested';
import { plugin as globImport } from 'rollup-plugin-glob-import';

export default [
	{
		input: 'src/js/css.js',
		output: {
			file: 'assets/css/main.css',
			format: 'es'
		},
		plugins: [
			globImport(),
			copy({
				targets: [
					{ src: 'src/images/**/*', dest: 'assets/images' }
				]
			}),
			postcss({
				extract: true,
				minimize: true,
				plugins: [
					// require('./src/tasks/import-css')
					postcssNested()
				],
				sourceMap: true
			})
		]
	},
	{
		input: 'src/js/main.js',
		output: {
			dir: 'assets/js',
			format: 'esm'
		},
		plugins: [
			globImport(),
			babel({
				exclude: 'node_modules/**'
			})
		]
	}
];
