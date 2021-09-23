const devPort = 8081;
module.exports = {
  // filenameHashing: false,
  // publicPath: './',
  outputDir: "build",
  devServer: {
    hot: true,
    writeToDisk: true,
    liveReload: false,
    sockPort: devPort,
    // public: `0.0.0.0:${devPort}`,
    port: devPort,
    // headers: { "Access-Control-Allow-Origin": "*" },
    // https: true,
    disableHostCheck: true,
    headers: {
      "Access-Control-Allow-Origin": "*",
      "Access-Control-Allow-Credentials": "true",
      "Access-Control-Allow-Methods": "GET, POST, PUT, DELETE, OPTIONS",
    },
  },
  publicPath:
    process.env.NODE_ENV === "production"
      ? process.env.ASSET_PATH || "/wp-content/plugins/git-plugin/app/build"
      : `http://localhost:${devPort}/`,
  configureWebpack: {
    output: {
      filename: "app.js",
      hotUpdateChunkFilename: "hot/hot-update.js",
      hotUpdateMainFilename: "hot/hot-update.json",
    },
    optimization: {
      splitChunks: false,
    },
  },
  filenameHashing: true,
  css: {
    extract: {
      filename: "app.css",
    },
  },
};
