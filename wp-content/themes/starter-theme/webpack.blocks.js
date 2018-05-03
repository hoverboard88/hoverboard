module.exports = {
  entry: {
    blocks: ['./src/views/_blocks/blocks.js'],
  },
  output: {
    path: `${__dirname}/dist`,
    filename: './js/[name].js',
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
