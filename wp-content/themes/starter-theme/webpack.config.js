const BrowserSyncPlugin = require('browser-sync-webpack-plugin');
const ExtractTextPlugin = require('extract-text-webpack-plugin');

const config = {
  context: `${__dirname}/src`,
  entry: {
    bundle: './js/main.js',
  },
  output: {
    path: `${__dirname}/dist`,
    filename: './js/[name].js',
    publicPath:
      'http://hoverboardtheme.lndo.site/wp-content/themes/starter-theme/',
  },
  module: {
    rules: [
      {
        test: /\.css$/,
        use: [
          // TODO: Still loads on production as well as localhost
          {loader: 'style-loader'},
          {loader: 'postcss-loader'},
        ],
      },
      {
        test: /\.js$/,
        exclude: /(node_modules|bower_components)/,
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
  plugins: [
    new ExtractTextPlugin('/css/[name].css'),
    new BrowserSyncPlugin({
      host: 'hoverboardtheme.lndo.site',
      port: 3000,
      proxy: 'https://hoverboardtheme.lndo.site',
      files: ['**/*.php', '**/*.twig'],
    }),
  ],
};

module.exports = config;
