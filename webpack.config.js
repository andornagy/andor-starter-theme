const LOCAL_DOMAIN = 'http://sqe-starter-website.local';

const outputPath = 'assets';

const path = require('path');
const MiniCssExtractPlugin = require('mini-css-extract-plugin');
const BrowserSyncPlugin = require('browser-sync-webpack-plugin');
module.exports = {
    entry: [
        path.join(__dirname, 'src', 'js', 'index.js'),
        path.join(__dirname, 'src', 'scss', 'app.scss'),
    ],
    output: {
        path: path.resolve(__dirname, outputPath),
        filename: 'bundle.js',
    },
    module: {
        rules: [
            {
                test: /\.(js|jsx)$/,
                exclude: /node_modules/,
                use: ['babel-loader'],
            },
            {
                test: /\.(c|sa|sc)ss$/,
                use: [
                    MiniCssExtractPlugin.loader,
                    // 'css-loader',
                    {
                        loader: 'css-loader',
                        options: { url: false },
                    },
                    'postcss-loader',
                    'sass-loader',
                ],
            },
        ],
    },
    resolve: {
        extensions: ['.wasm', '.ts', '.tsx', '.mjs', '.cjs', '.js', '.json'],
    },
    plugins: [
        new MiniCssExtractPlugin({
            filename: '[name].css',
        }),
        new BrowserSyncPlugin(
            {
                proxy: LOCAL_DOMAIN,
                files: [outputPath + '/*.css'],
                injectCss: true,
            },
            { reload: false }
        ),
    ],
};
