'use strict';

const CopyWebpackPlugin = require('copy-webpack-plugin');
const ExtractTextPlugin = require('extract-text-webpack-plugin');
const HtmlWebpackPlugin = require('html-webpack-plugin');
const MiniCssExtractPlugin = require('mini-css-extract-plugin');
const path = require('path');
const Visualizer = require('webpack-visualizer-plugin');
const WebappWebpackPlugin = require('webapp-webpack-plugin');
const webpack = require('webpack');

module.exports = [
  /**
   *--------------------------------------------------------------------------
   * jQuery
   *--------------------------------------------------------------------------
   *
   */
  new webpack.ProvidePlugin({
    $: 'jquery',
    jQuery: 'jquery',
  }),

  /**
   *--------------------------------------------------------------------------
   * CSS Plugin
   *--------------------------------------------------------------------------
   *
   */
  new MiniCssExtractPlugin({
    filename: '[name].min.css',
    chunkFilename: '[id].min.css',
  }),

  new ExtractTextPlugin({filename: '[id].min.css'}),

  /**
   *--------------------------------------------------------------------------
   * Html Plugin
   *--------------------------------------------------------------------------
   *
   */
  new HtmlWebpackPlugin({
    template: './views/index.blade.php',
    filename: '../index.html',
  }),

  // new webpack.optimize.UglifyJsPlugin({ sourcemap: true }),

  /**
   *--------------------------------------------------------------------------
   * Favicon Generator
   *--------------------------------------------------------------------------
   *
   */
  new WebappWebpackPlugin({
    logo: path.resolve(__dirname, '../src/assets/img/logo.png'),
    prefix: '../favicons/',
  }),

  /**
   *--------------------------------------------------------------------------
   * Copy Images
   *--------------------------------------------------------------------------
   *
   */
  new CopyWebpackPlugin([{
    from: 'src/assets/img/',
    to: '../dist/img/[name].[ext]',
    toType: 'template',
  }]),

  /**
   *--------------------------------------------------------------------------
   * Copy Logos
   *--------------------------------------------------------------------------
   *
   */
  new CopyWebpackPlugin([{
    from: 'src/assets/logos/',
    to: '../dist/logos/[name].[ext]',
    toType: 'template',
  }]),

  /**
   *--------------------------------------------------------------------------
   * Visualizer Plugin
   *--------------------------------------------------------------------------
   *
   * It "visualizes" your files.
   * @see  dist/stats.html
   *
   */
  new Visualizer(),
];
