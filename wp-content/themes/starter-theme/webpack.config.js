const BrowserSyncPlugin = require('browser-sync-webpack-plugin');
const CleanWebpackPlugin = require('clean-webpack-plugin');
const ExtractTextPlugin = require('extract-text-webpack-plugin');
const UglifyJSPlugin = require('uglifyjs-webpack-plugin');
const webpack = require('webpack');

const url = 'https://hoverboard-custom-upstream.lndo.site';
const theme = 'starter-theme';

const fonts = [
  {
    test: /\.(woff)$/,
    loader:
      'url-loader?limit=65000&mimetype=application/font-woff&name=fonts/[name].[ext]',
  },
  {
    test: /\.(woff2)$/,
    loader:
      'url-loader?limit=65000&mimetype=application/font-woff2&name=fonts/[name].[ext]',
  },
];

const scripts = {
  test: /\.(js)$/,
  exclude: /(node_modules|bower_components|_blocks)/,
  use: [
    {
      loader: 'babel-loader',
      options: {presets: ['@babel/preset-env']},
    },
  ],
};

const images = [
  {
    test: /\.(png|jpg)$/,
    loader: 'image-webpack-loader',
    options: {
      name: '[path][name].[ext]',
    },
  },
  {
    test: /\.(svg)$/,
    loader: 'file-loader',
    options: {
      name: '[path][name].[ext]',
    },
  },
];

const plugins = [
  new webpack.ProvidePlugin({
    $: 'jquery',
    jQuery: 'jquery',
  }),
];

const postcss = {
  loader: 'postcss-loader',
  options: {
    sourceMap: 'inline',
  },
};

const styles = {
  test: /\.(css)$/,
  use: ExtractTextPlugin.extract(['css-loader?sourceMap', postcss]),
};

const config = {
  context: `${__dirname}/src`,
  output: {
    path: `${__dirname}/dist`,
    filename: './js/[name].js',
    publicPath: `${url}/wp-content/themes/${theme}/`,
  },
  entry: {
    bundle: ['babel-polyfill', './js/main.js'],
    editor: ['./css/editor.css'],
  },
  module: {
    rules: [...fonts, scripts, ...images, styles],
  },
  plugins,
};

module.exports = (env, argv) => {
  if (argv.mode === 'development') {
    config.devtool = 'source-map';
    config.output.filename = './js/[name].dev.js';
    config.plugins.push(
      new BrowserSyncPlugin({
        host: url,
        port: 3000,
        proxy: url,
        files: ['**/*.php', '**/*.twig', '**/*.css'],
        open: false,
      })
    );
    config.plugins.push(new ExtractTextPlugin('/css/[name].dev.css'));
  }

  if (argv.mode === 'production') {
    config.plugins.push(
      new ExtractTextPlugin('/css/[name].css'),
      new CleanWebpackPlugin(),
      new UglifyJSPlugin()
    );
  }

  return config;
};
