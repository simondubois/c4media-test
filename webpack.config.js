
var path = require("path");
var webpack = require("webpack");

module.exports = {

    entry: [
        'vue',
        path.join(__dirname, 'webpack', 'cart-widget.js'),
    ],

    output: {
        path: path.join(__dirname, 'public', 'assets', 'js'),
        filename: 'cart-widget.js',
    },

    module: {
        loaders: [
            {
                test: /\.vue$/,
                loader: 'vue'
            },
        ],
    },

    plugins: [
        new webpack.ProvidePlugin({
            Vue: "vue"
        }),
    ],

}
