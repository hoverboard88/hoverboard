const config = {
  context: `${__dirname}/src`,
  entry: './js/main.js',
  output: {
    path: `${__dirname}/dist`,
    filename: './js/bundle.js',
  },
  module: {
    rules: [{
      test: /\.css$/,
      use: [
        'style-loader',
        { loader: 'css-loader', options: { importLoaders: 1 } },
        'postcss-loader',
      ],
    }],
  },
};

module.exports = config;
