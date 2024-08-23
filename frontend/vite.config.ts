import { defineConfig } from "vite";

// https://vitejs.dev/config/
export default defineConfig({
  plugins: [
    {
      name: "php",
      handleHotUpdate({ file, server }) {
        // @ts-ignore
        if (file.endsWith(".php")) {
          server.ws.send({
            type: "full-reload",
          });
        }
      },
    },
  ],
  build: {
    manifest: true,
    emptyOutDir: true,
    sourcemap: true,
    rollupOptions: {
      input: ["./src/main.ts", "./src/style.css"],

      output: {
        entryFileNames: "assets/[name]-[hash].js",
        assetFileNames: "assets/[name]-[hash].[ext]",
      },
    },
  },
});
