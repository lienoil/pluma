'use strict';

const ExtractTextPlugin = require('extract-text-webpack-plugin');
const globImporter = require('node-sass-glob-importer');
const MiniCssExtractPlugin = require('mini-css-extract-plugin');
const NodeSassJsonImporter = require('node-sass-json-importer');
const theme = require('../theme.json');

module.exports = [
  /**
   *--------------------------------------------------------------------------
   * Babel Loader
   *--------------------------------------------------------------------------
   *
   */
  {
    test: /\.js$/,
    exclude: /node_modules/,
    use: {
      loader: 'babel-loader',
    },
  },

  /**
   *--------------------------------------------------------------------------
   * Css/Sass Loader
   *--------------------------------------------------------------------------
   *
   * Extract and Minify css/scss/sass files.
   *
   */
  {
    test: /\.(sa|sc|c)ss$/,
    use: [{
      loader: 'style-loader',
    },{
      loader: MiniCssExtractPlugin.loader,
    }, {
      loader: 'css-loader', // translates CSS into CommonJS modules
    }, {
      loader: 'import-glob-loader',
    }, {
      loader: 'postcss-loader', // Run post css actions
      options: {
        plugins: function () { // post css plugins, can be exported to postcss.config.js
          return [
            require('precss'),
            require('autoprefixer')
          ];
        }
      }
    }, {
      loader: 'sass-loader', // compiles Sass to CSS
      options: {
        importer: [globImporter(), NodeSassJsonImporter()],
      }
    }, {
      // Reads Sass vars from files or inlined in the options property
      loader: "@epegzz/sass-vars-loader",
      options: {
        syntax: 'scss',
        vars: {
          colors: theme.colors,
          primary: theme.colors.primary,
          secondary: theme.colors.secondary,
          accent: theme.colors.accent,
          success: theme.colors.success,
          info: theme.colors.info,
          warning: theme.colors.warning,
          danger: theme.colors.danger,
          light: theme.colors.light,
          dark: theme.colors.dark,
          text: theme.colors.text,
          card: theme.colors.card,
          sidebar: theme.colors.sidebar,
          workspace: theme.colors.workspace,
        }
      },
    }]
  },

  /**
   *--------------------------------------------------------------------------
   * HTML Loader
   *--------------------------------------------------------------------------
   *
   * Perform html optimizations.
   *
   */
  {
    test: /\.html$/,
    use: [
      {
        loader: 'html-loader',
        options: { minimize: true },
      }
    ],
  },

  /**
   *--------------------------------------------------------------------------
   * Fonts Loader
   *--------------------------------------------------------------------------
   *
   */
  {
    test: /\.(woff2?|eot|ttf|otf)(\?.*)?$/,
    loader: 'url-loader',
    options: {
      limit: 10000,
      name: 'fonts/[name].[hash:7].[ext]',
    }
  },

  /**
   *--------------------------------------------------------------------------
   * File Loader
   *--------------------------------------------------------------------------
   *
   */
  {
    test: /\.(png|jpe?g|gif|svg)(\?.*)?$/,
    loader: 'url-loader',
    options: {
      limit: 10000,
      name: 'assets/img/[name].[hash:7].[ext]',
    }
  },
];
