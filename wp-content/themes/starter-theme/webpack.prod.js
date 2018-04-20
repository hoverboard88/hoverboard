const merge = require('webpack-merge')
const common = require('./webpack.common.js')
const UglifyJSPlugin = require('uglifyjs-webpack-plugin')

module.exports = merge(common, {
  entry: {
    bundle: './js/main.js'
  },
  plugins: [
    new UglifyJSPlugin()
  ]
})
