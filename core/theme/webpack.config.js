'use strict';

const path = require('path');
const rules = require('./build/rules');
const plugins = require('./build/plugins');

module.exports = (env, arg) => {
  return {
    cache: true,
    devtool: 'inline-source-map',
    watchOptions: {
      poll: true
    },
    entry: {
      app: './src/app.js',
      vendor: './src/vendor.js',
      fonts: './src/sass/fonts.scss',

      /**
       *--------------------------------------------------------------------------
       * Modules List
       *--------------------------------------------------------------------------
       *
       */
      editor: './src/modules/editor/editor.js',
      form: './src/modules/form/form.js',
    },
    output: {
      path: path.resolve(__dirname, 'dist'),
      filename: arg.mode === 'production' ? '[name].min.js' : '[name].js',
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
  };
}
