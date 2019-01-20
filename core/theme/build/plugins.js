'use strict';

const BrowserSyncPlugin = require('browser-sync-webpack-plugin')
const CopyWebpackPlugin = require('copy-webpack-plugin');
const ExtractTextPlugin = require('extract-text-webpack-plugin');
const FixStyleOnlyEntriesPlugin = require("webpack-fix-style-only-entries");
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
  // new FixStyleOnlyEntriesPlugin(),

  new MiniCssExtractPlugin({
    filename: 'css/[name].css',
    chunkFilename: 'css/[id].css',
  }),

  new ExtractTextPlugin({filename: 'css/[id].css'}),

  /**
   *--------------------------------------------------------------------------
   * Favicon Generator
   *--------------------------------------------------------------------------
   *
   */
  new WebappWebpackPlugin({
    logo: path.resolve(__dirname, '../src/assets/img/logo.png'),
    prefix: 'favicons/',
  }),

  /**
   *--------------------------------------------------------------------------
   * Copy Images
   *--------------------------------------------------------------------------
   *
   */
  new CopyWebpackPlugin([{
    from: 'src/assets/img/',
    to: 'img/[name].[ext]',
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
    to: 'logos/[name].[ext]',
    toType: 'template',
  }]),

  /**
   *--------------------------------------------------------------------------
   * Browser Sync
   *--------------------------------------------------------------------------
   * browse to http://localhost:3000/ during development,
   * <root>/public directory is being served
   */
  new BrowserSyncPlugin({
    host: 'localhost',
    port: 3000,
    // server: {
    //   baseDir: 'app',
    //   index: 'index.php'
    // },
    proxy: 'http://localhost:8000/',
  }),

  /**
   *--------------------------------------------------------------------------
   * Visualizer Plugin
   *--------------------------------------------------------------------------
   *
   * Stats for nerds.
   * @see  dist/stats.html
   *
   */
  new Visualizer(),
];
