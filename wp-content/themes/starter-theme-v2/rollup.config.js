import babel from 'rollup-plugin-babel';
import copy from 'rollup-plugin-copy';
import postcss from 'rollup-plugin-postcss';
import postcssNested from 'postcss-nested';
import postcssCustomMedia from 'postcss-custom-media';
import browsersync from 'rollup-plugin-browsersync';
import {plugin as globImport} from 'rollup-plugin-glob-import';

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
				targets: [{src: 'src/images/**/*', dest: 'assets/images'}],
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
		input: 'src/js/main.js',
		output: {
			dir: 'assets/js',
			format: 'esm',
		},
		plugins: [
			globImport(),
			babel({
				exclude: 'node_modules/**',
			}),
		],
	},
];
