'use strict';

// https://www.valentinog.com/blog/webpack-tutorial/

const path = require('path');
const rules = require('./config/rules');
const plugins = require('./config/plugins');

module.exports = {
  resolve: {
    extensions: ['.js', '.json'],
    alias: {
      '@': path.join(__dirname, '..', 'src'),
    },
  },
  module: {
    rules,
  },
  plugins,
}
