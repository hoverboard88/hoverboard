const BrowserSyncPlugin = require('browser-sync-webpack-plugin');
const merge = require('webpack-merge');
const common = require('./webpack.common.js');
const ExtractTextPlugin = require('extract-text-webpack-plugin');

module.exports = merge(common, {
  entry: {
    bundle: ['babel-polyfill', './js/main.js'],
    editor: ['./css/editor.css'],
  },
  output: {
    path: `${__dirname}/dist`,
    filename: './js/[name].dev.js',
    publicPath:
      'https://hoverboardcustomupstream.lndo.site/wp-content/themes/starter-theme/',
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
    }),
  ],
});
