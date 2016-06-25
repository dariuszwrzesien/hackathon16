var path = require('path');
var webpack = require('webpack');

module.exports = {
    entry: {
        app: ['./components/app.jsx'],
        vendor: ['react', 'bootstrap-webpack!./bootstrap.config.js']
    },

    output: {
        path: path.resolve(__dirname, '../web/app-front/'),
        filename: '[name].js',
        publicPath: '/web/app-front/'
    },

    module: {
        loaders: [
            {
                loader: 'babel-loader',

                include: [
                    path.resolve(__dirname, 'components')
                ],

                test: [/\.jsx$/]
            },
            {
                test: /\.(woff|woff2)(\?v=\d+\.\d+\.\d+)?$/,
                loader: 'url?limit=10000&mimetype=application/font-woff&name=[name].[ext]'
            },
            {
                test: /\.ttf(\?v=\d+\.\d+\.\d+)?$/,
                loader: 'url?limit=10000&mimetype=application/octet-stream&name=[name].[ext]'
            },
            {
                test: /\.eot(\?v=\d+\.\d+\.\d+)?$/,
                loader: 'file?name=[name].[ext]'
            },
            {
                test: /\.svg(\?v=\d+\.\d+\.\d+)?$/,
                loader: 'url?limit=10000&mimetype=image/svg+xml&name=[name].[ext]'
            }
        ]
    },

    resolve: {
        extensions: ['', '.js', '.jsx']
    },

    plugins: [
        new webpack.optimize.CommonsChunkPlugin({
            name: 'vendor',
            filename: 'vendor.js'
        }),
        new webpack.ProvidePlugin({
            $: 'jquery',
            jQuery: 'jquery',
            'window.jQuery': 'jquery',
            'root.jQuery': 'jquery'
        })
    ],

    devtool: 'source-map'
};
