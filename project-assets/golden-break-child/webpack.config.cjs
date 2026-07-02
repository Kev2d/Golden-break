const path = require('path');
const CssMinimizerPlugin = require('css-minimizer-webpack-plugin');
const TerserPlugin = require('terser-webpack-plugin');
const MiniCssExtractPlugin = require('mini-css-extract-plugin');
const ForkTsCheckerWebpackPlugin = require('fork-ts-checker-webpack-plugin');
const PurgeCSS = require('purgecss').PurgeCSS;
const purgecssWordpress = require('purgecss-with-wordpress');
const fs = require('fs');

module.exports = {
  mode: 'production', // Optimized build for production
  entry: {
    main: './assets/js/main.ts',
  },
  output: {
    filename: 'main.min.js',
    path: path.resolve(__dirname, 'assets/dist/js'),
    clean: true, // Clean output directory before build
  },
  module: {
    rules: [
      {
        test: /\.scss$/, // Process SCSS files
        use: [
          MiniCssExtractPlugin.loader, // Extract CSS into a file
          'css-loader', // Resolve CSS imports
          'sass-loader', // Compile SCSS to CSS
        ],
      },
      {
        test: /\.ts$/, // Process TypeScript files
        use: {
          loader: 'ts-loader',
          options: {
            compilerOptions: {
              noEmit: false, // Ensure TypeScript emits output
            },
          },
        },
        exclude: /node_modules/, // Exclude libraries
      },
    ],
  },
  plugins: [
    new MiniCssExtractPlugin({
      filename: '../css/main.min.css', // The CSS file to purge
    }),
    new ForkTsCheckerWebpackPlugin(), // TypeScript type checking
    {
      apply: (compiler) => {
        compiler.hooks.afterEmit.tapPromise('PurgeCSS', async () => {
          const purgeCSSResult = await new PurgeCSS().purge({
            content: ['./**/*.php', './assets/js/**/*.ts', './assets/js/**/*.html'], // Files to scan for class usage
            css: ['./assets/dist/css/main.min.css'], // The generated CSS file
            safelist: [
              ...purgecssWordpress.safelist, // Include WordPress safelisted classes
              'menu-item', // Add additional custom classes if needed
            ],
          });

          // Overwrite main.min.css with the purged CSS
          fs.writeFileSync(
            path.resolve(__dirname, './assets/dist/css/main.min.css'),
            purgeCSSResult[0].css,
            'utf-8'
          );
        });
      },
    },
  ],
  optimization: {
    minimize: true, // Enable minification
    usedExports: true, // Enable tree shaking
    sideEffects: true, // Respect "sideEffects" in package.json
    minimizer: [
      new CssMinimizerPlugin(), // Minify CSS
      new TerserPlugin({
        test: /\.js(\?.*)?$/i, // Match JavaScript files
        extractComments: false, // Prevent generating LICENSE files for comments
        terserOptions: {
          compress: {
            drop_console: true,   // Remove console.logs
          },
          format: {
            comments: false, // Remove all comments
          },
          compress: true, // Enable code compression
        },
      }),
    ],
  },
  resolve: {
    extensions: ['.ts', '.js'], // Resolve these file types
  },
};
