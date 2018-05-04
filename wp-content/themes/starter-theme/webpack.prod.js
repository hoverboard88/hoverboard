const merge = require('webpack-merge');
const common = require('./webpack.common.js');
const UglifyJSPlugin = require('uglifyjs-webpack-plugin');
const ExtractTextPlugin = require('extract-text-webpack-plugin');

module.exports = merge(common, {
  entry: {
    bundle: ['babel-polyfill', './js/main.js'],
    blocks: ['./blocks/blocks.js'],
    editor: ['./blocks/editor.js'],
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
                sourceMap: false,
              },
            },
          ],
        }),
      },
    ],
  },
  plugins: [
    new UglifyJSPlugin()
    new ExtractTextPlugin('/css/[name].css')
  ],
});
