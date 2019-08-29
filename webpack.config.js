var path = require('path')
const MiniCssExtractPlugin = require("mini-css-extract-plugin")
const VueLoaderPlugin = require('vue-loader/lib/plugin'); 

module.exports = {
 mode: 'development',
 output: {
    filename: 'app.js',
    path: path.resolve(__dirname, 'public_html/js/'),
    publicPath: 'js/',
    chunkFilename: "chunks/[name].js"
 },
 module: {
   rules: [
     {
       test: /\.vue$/,
       loader: 'vue-loader'
     }, {
      test: /\.css$/,
      use: [
        'vue-style-loader',
        'css-loader'
      ]
    }, {
       test: /\.scss$/,
       use:  [
           'style-loader',
           MiniCssExtractPlugin.loader,
           {
               loader: 'css-loader',
               options: { sourceMap: true }
           }, {
               loader: 'sass-loader',
               options: { sourceMap: true }
           }
       ]
    },
   ]
 },
 plugins: [
    new VueLoaderPlugin(),
    new MiniCssExtractPlugin({
     filename: "../css/[name].css",

    })
   ]
}