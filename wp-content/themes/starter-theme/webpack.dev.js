const BrowserSyncPlugin = require('browser-sync-webpack-plugin');
const merge = require('webpack-merge');
const common = require('./webpack.common.js');
const ExtractTextPlugin = require('extract-text-webpack-plugin');

module.exports = merge(common, {
  entry: {
    dev: ['babel-polyfill', './js/main.js'],
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
    new BrowserSyncPlugin({
      host: 'https://hoverboardtheme.lndo.site',
      port: 3000,
      proxy: 'https://hoverboardtheme.lndo.site',
      files: ['**/*.php', '**/*.twig'],
    }),
  ],
});
