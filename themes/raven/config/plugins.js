'use strict';

const MiniCssExtractPlugin = require('mini-css-extract-plugin');
const HtmlWebpackPlugin = require('html-webpack-plugin');
const ExtractTextPlugin = require('extract-text-webpack-plugin');
const webpack = require('webpack');

module.exports = [
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
];
