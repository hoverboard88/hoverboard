const ExtractTextPlugin = require('extract-text-webpack-plugin');

const config = {
  context: `${__dirname}/src`,
  output: {
    path: `${__dirname}/dist`,
    filename: './js/[name].js',
    publicPath:
      'https://hoverboardtheme.lndo.site/wp-content/themes/starter-theme/',
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
  plugins: [new ExtractTextPlugin('/css/[name].css')],
};

module.exports = config;
