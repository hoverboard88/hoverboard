module.exports = {
  entry: './src/js/blocks.jsx',
  output: {
    path: `${__dirname}/dist`,
    filename: './js/blocks.js',
  },
  module: {
    loaders: [
      {
        test: /.jsx$/,
        loader: 'babel-loader',
        exclude: /node_modules/,
      },
    ],
  },
};
