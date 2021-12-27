const fs = require("fs-extra");
const { join, resolve } = require("path");
const webpack = require("webpack");
const TsconfigPathsPlugin = require("tsconfig-paths-webpack-plugin");

const packageConfig = fs.readJSONSync("./package.json", { encoding: "utf-8" });

const externals = [];
for (const packageName in packageConfig.dependencies) {
  externals[packageName] = packageName;
}

module.exports = {
  entry: {
    index: "./src/index.ts",
  },
  resolve: {
    extensions: [".ts", ".js", ".json"],
    modules: [resolve(__dirname, "node_modules")],
    plugins: [new TsconfigPathsPlugin()],
  },
  target: "node",
  output: {
    path: resolve(__dirname, "dist"),
    filename: "[name].js",
    sourceMapFilename: "[name].js.map",
  },
  module: {
    rules: [
      {
        test: /\.ts$/,
        loader: "ts-loader",
      },
    ],
  },
  optimization: {
    chunkIds: "natural",
    moduleIds: "natural",
    nodeEnv: "production",
  },
};
