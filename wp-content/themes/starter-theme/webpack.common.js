const config = {
  context: `${__dirname}/src`,
  output: {
    path: `${__dirname}/dist`,
    filename: './js/[name].js',
    publicPath:
      'https://hoverboardcustomupstream.lndo.site/wp-content/themes/starter-theme/',
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
          'url-loader?limit=65000&mimetype=image/svg+xml&name=static/fonts/[name].[ext]',
      },
      {
        test: /\.woff$/,
        loader:
          'url-loader?limit=65000&mimetype=application/font-woff&name=static/fonts/[name].[ext]',
      },
      {
        test: /\.woff2$/,
        loader:
          'url-loader?limit=65000&mimetype=application/font-woff2&name=static/fonts/[name].[ext]',
      },
    ],
  },
};

module.exports = config;
