'use strict';

const ExtractTextPlugin = require('extract-text-webpack-plugin');
const HtmlWebpackPlugin = require('html-webpack-plugin');
const MiniCssExtractPlugin = require('mini-css-extract-plugin');
const Visualizer = require('webpack-visualizer-plugin');
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
   * Visualizer Plugin
   *--------------------------------------------------------------------------
   *
   * It "visualizes" your files.
   * @see  dist/stats.html
   *
   */
  new Visualizer(),
];
