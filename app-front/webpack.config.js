var path = require('path');
var webpack = require('webpack');

module.exports = {
    entry: {
        app: ['./components/app.jsx'],
        vendor: ['react']
    },

    output: {
        filename: '../web/app-front/[name].js'
    },

    module: {
        loaders: [
            {
                loader: 'babel-loader',

                include: [
                    path.resolve(__dirname, 'components')
                ],

                test: [/\.jsx$/]
            }
        ]
    },

    resolve: {
        extensions: ['', '.js', '.jsx']
    },

    plugins: [
        new webpack.optimize.CommonsChunkPlugin({
            name: 'vendor',
            filename: '../web/app-front/vendor.js'
        })
    ],

    devtool: 'source-map'
};
