const webpack = require('webpack');

const config = {
  context: `${__dirname}/src`,
  entry: {
    bundle: ['babel-polyfill', './js/main.js'],
    blocks: ['./js/blocks.js'],
    editor: ['./css/editor.css'],
  },
  module: {
    rules: [
      {
        test: /.jsx$/,
        loader: 'babel-loader',
        exclude: /node_modules/,
      },
      {
        test: /\.js$/,
        exclude: /(node_modules|bower_components|_blocks)/,
        use: {
          loader: 'babel-loader',
          options: {
            presets: ['@babel/preset-env'],
          },
        },
      },
      {
        test: /\.(svg)$/,
        loader: 'file-loader',
        options: {
          name: '[path][name].[ext]',
        },
      },
      {
        test: /\.(png|jpg)$/,
        loader: 'image-webpack-loader',
        options: {
          name: '[path][name].[ext]',
        },
      },
      {
        test: /\.woff$/,
        loader:
          'url-loader?limit=65000&mimetype=application/font-woff&name=fonts/[name].[ext]',
      },
      {
        test: /\.woff2$/,
        loader:
          'url-loader?limit=65000&mimetype=application/font-woff2&name=fonts/[name].[ext]',
      },
    ],
  },
  plugins: [
    new webpack.ProvidePlugin({
      $: 'jquery',
      jQuery: 'jquery',
    }),
  ],
};

module.exports = config;
