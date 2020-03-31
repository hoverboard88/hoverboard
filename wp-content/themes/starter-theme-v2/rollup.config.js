import babel from 'rollup-plugin-babel';
import browsersync from 'rollup-plugin-browsersync';
import copy from 'rollup-plugin-copy';
import postcss from 'rollup-plugin-postcss';
import postcssNested from 'postcss-nested';
import postcssCustomMedia from 'postcss-custom-media';
import { plugin as globImport } from 'rollup-plugin-glob-import';
import resolve from 'rollup-plugin-node-resolve';
import { uglify } from 'rollup-plugin-uglify';

export default [
	{
		input: 'src/js/css.js',
		output: {
			file: 'assets/css/main.css',
			format: 'es',
		},
		plugins: [
			globImport(),
			copy({
				targets: [{ src: 'src/images/**/*', dest: 'assets/images' }],
			}),
			postcss({
				extract: true,
				minimize: true,
				plugins: [
					require('./src/js/import-css'),
					postcssCustomMedia(),
					postcssNested(),
				],
				sourceMap: true,
			}),
			browsersync({
				host: 'https://hoverboard-custom-upstream.lndo.site',
				port: 3000,
				proxy: 'https://hoverboard-custom-upstream.lndo.site',
				files: ['**/*.php', '**/*.css'],
				open: false,
			}),
		],
	},
	{
		input: 'src/js/modules.js',
		output: {
			file: 'assets/js/modules.js',
			format: 'es',
		},
		plugins: [
			globImport(),
			babel({ exclude: 'node_modules/**' }),
			resolve(),
			uglify(),
		],
	},
	{
		input: 'src/js/animate.js',
		output: {
			file: 'assets/js/animate.js',
			format: 'es',
		},
		plugins: [
			globImport(),
			babel({ exclude: 'node_modules/**' }),
			resolve(),
			uglify(),
		],
	},
];
