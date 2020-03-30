import babel from 'rollup-plugin-babel';
import browsersync from 'rollup-plugin-browsersync';
import copy from 'rollup-plugin-copy';
import postcss from 'rollup-plugin-postcss';
import postcssNested from 'postcss-nested';
import postcssCustomMedia from 'postcss-custom-media';
import resolve from '@rollup/plugin-node-resolve';
import { plugin as globImport } from 'rollup-plugin-glob-import';

const plugins = [
	babel({ exclude: 'node_modules/**' }),
	globImport(),
	resolve(),
];

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
		input: 'src/js/main.js',
		output: {
			file: 'assets/js/main.js',
			format: 'es',
		},
		plugins: plugins,
	},
];
