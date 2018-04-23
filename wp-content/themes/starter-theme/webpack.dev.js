const BrowserSyncPlugin = require('browser-sync-webpack-plugin');
const merge = require('webpack-merge');
const common = require('./webpack.common.js');

module.exports = merge(common, {
  entry: {
    dev: './js/main.js',
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
