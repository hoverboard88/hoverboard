const BrowserSyncPlugin = require('browser-sync-webpack-plugin');
const merge = require('webpack-merge');
const common = require('./webpack.common.js');
const ExtractTextPlugin = require('extract-text-webpack-plugin');

module.exports = merge(common, {
  devtool: 'inline-sourcemap',
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
      host: 'https://hoverboard-custom-upstream.lndo.site',
      port: 3000,
      proxy: 'https://hoverboard-custom-upstream.lndo.site',
      files: ['**/*.php', '**/*.twig', '**/*.css'],
      open: false,
    }),
  ],
});
