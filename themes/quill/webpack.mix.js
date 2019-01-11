const mix = require('laravel-mix');

/**
 *------------------------------------------------------------------------------
 * Mix Asset Management
 *------------------------------------------------------------------------------
 *
 * Mix provides a clean, fluent API for defining some Webpack build steps
 * for your Laravel application. By default, we are compiling the Sass
 * file for the application as well as bundling up all the JS files.
 *
 */

mix.webpackConfig({
  output: {
    chunkFilename: 'dist/js/[name].js',
  },
  resolve: {
    extensions: ['.js', '.vue', '.json'],
    alias: {
      'vue$': 'vue/dist/vue.esm.js',
      '@': __dirname + '/src'
    },
  }
})

mix.js('src/app.js', 'dist/js')
   // .js('src/vendor.js', 'dist/js')
   .sass('src/sass/app.scss', 'dist/css');
