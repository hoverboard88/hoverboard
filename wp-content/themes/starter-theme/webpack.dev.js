const BrowserSyncPlugin = require('browser-sync-webpack-plugin');
const merge = require('webpack-merge');
const common = require('./webpack.common.js');
const ExtractTextPlugin = require('extract-text-webpack-plugin');
const globby = require('globby');

module.exports = merge(common, {
  devtool: 'inline-sourcemap',
  entry: {
    bundle: ['babel-polyfill', './js/main.js'],
    editor: ['./css/editor.css'],
    blocks: ['./js/blocks.js'],
    blockeditor: ['./css/blockeditor.css'],
  },
  output: {
    path: `${__dirname}/dist`,
    filename: './js/[name].dev.js',
    publicPath:
      'https://hoverboard-custom-upstream.lndo.site/wp-content/themes/starter-theme/',
  },
  module: {
    rules: [
      {
        test: /\.css$/,
        use: ExtractTextPlugin.extract({
          fallback: 'css-loader',
          use: [
            {
              loader: 'postcss-loader',
              options: {
                sourceMap: 'inline',
              },
            },
          ],
        }),
      },
    ],
  },
  plugins: [
    new ExtractTextPlugin('/css/[name].dev.css'),
    new BrowserSyncPlugin({
      host: 'https://hoverboardcustomupstream.lndo.site',
      port: 3000,
      proxy: 'https://hoverboardcustomupstream.lndo.site',
      files: ['**/*.php', '**/*.twig'],
      open: false,
    }),
  ],
});
