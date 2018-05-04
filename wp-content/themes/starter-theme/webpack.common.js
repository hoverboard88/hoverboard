const ExtractTextPlugin = require('extract-text-webpack-plugin');

const config = {
  context: `${__dirname}/src`,
  entry: {
    bundle: ['babel-polyfill', './js/main.js'],
    blocks: ['./blocks/blocks.js'],
    editor: ['./blocks/editor.js'],
  },
  output: {
    path: `${__dirname}/dist`,
    filename: './js/[name].js',
    publicPath:
      'https://hoverboardtheme.lndo.site/wp-content/themes/starter-theme/',
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
        test: /\.svg$/,
        loader:
          'url?limit=65000&mimetype=image/svg+xml&name=static/fonts/[name].[ext]',
      },
      {
        test: /\.woff$/,
        loader:
          'url?limit=65000&mimetype=application/font-woff&name=static/fonts/[name].[ext]',
      },
      {
        test: /\.woff2$/,
        loader:
          'url?limit=65000&mimetype=application/font-woff2&name=static/fonts/[name].[ext]',
      },
    ],
  },
  plugins: [new ExtractTextPlugin('/css/[name].css')],
};

module.exports = config;
