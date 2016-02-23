
var path = require("path");
var webpack = require("webpack");

module.exports = {

    entry: [
        'vue',
        path.join(__dirname, 'webpack', 'front.js'),
    ],

    output: {
        path: path.join(__dirname, 'public', 'assets', 'js'),
        filename: 'front.js',
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
