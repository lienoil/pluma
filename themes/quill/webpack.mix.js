const mix = require('laravel-mix');
// const webpack = require('webpack');

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
      '@': __dirname + '/src',
      // jquery: 'jquery/src/jquery',
    },
  },
  // plugins: [
  //   new webpack.ProvidePlugin({
  //     '$': 'jquery',
  //     'jQuery': 'jquery',
  //     'window.jQuery': 'jquery',
  //   })
  // ]
})

// mix.autoload({
//   jquery: ['$','jQuery', 'window.jQuery'],
// })

mix.js('./src/app.js', './dist/js')
   .stylus('./src/stylus/main.styl', './dist/css/app.css')
   .browserSync({
      proxy: 'http://localhost:8000/',
      files: [
          'dist/css/{*,**/*}.css',
          'dist/js/{*,**/*}.js',
          'templates/{*,**/*}.html.twig'
      ]
   })
   // .js('src/vendor.js', 'dist/js')
   // .sass('src/sass/app.scss', 'dist/css');
