
let mix = require('laravel-mix');
let ImageminPlugin = require( 'imagemin-webpack-plugin' ).default;
const MiniCssExtractPlugin = require('mini-css-extract-plugin');

mix.sass('./resources/scss/main.scss', './public/css')
    .options({
        postCss: [
            require('postcss-custom-properties')
        ]
    }).webpackConfig( {
    module: {
        rules: [
            {
                test: /\.(woff(2)?|eot|ttf|otf|svg|)$/,
                type: 'asset',   // <-- Assets module - asset
                parser: {
                    dataUrlCondition: {
                        maxSize: 8 * 1024 // 8kb
                    }
                },
                generator: {  //If emitting file, the file path is
                    filename: './fonts/[name][ext]'
                }
            }

        ]
    },
    plugins: [
        new ImageminPlugin( {
            pngquant: {
                quality: '95-100',
            },
            test: /\.(jpe?g|png|gif|svg)$/i,
        } ),
        new MiniCssExtractPlugin({filename:'[name].min.css'})
    ],
} )
mix.copy('./resources/images/*.*','./public/images');
