'use strict';

const path = require('path');
const rules = require('./build/rules');
const plugins = require('./build/plugins');

module.exports = {
  cache: true,
  devtool: 'inline-source-map',
  watchOptions: {
    poll: true
  },
  entry: {
    app: './src/app.js',
    vendor: './src/vendor.js',
  },
  output: {
    path: path.resolve(__dirname, 'dist'),
    filename: '[name].min.js',
  },
  resolve: {
    extensions: ['.js', '.json'],
    alias: {
      '@': path.join(__dirname, 'src'),
    },
  },
  module: {
    rules,
  },
  plugins,
}
