module.exports = {
  plugins: [
    require('./tasks/postcss-module-import'),
    require('precss'),
    require('postcss-mixins'),
    require('postcss-import'),
    require('postcss-sorting'),
    require('postcss-preset-env')({
      stage: 2,
    }),
    require('cssnano'),
  ],
};
