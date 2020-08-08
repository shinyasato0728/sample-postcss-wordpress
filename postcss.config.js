module.exports = (ctx) => ({
  map: ctx.options.map,
  plugins: [
    require('autoprefixer'),
    require('postcss-import'),
    require('postcss-apply'),
    require('postcss-nesting'),
    require('postcss-css-reset'),
    require('postcss-color-function'),
    require('postcss-flexbugs-fixes'),
    require('postcss-custom-media'),
    require('postcss-media-minmax'),
    require('postcss-pixels-to-rem')
  ]
});
