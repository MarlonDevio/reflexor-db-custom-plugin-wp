import path from 'path';
import { defineConfig } from 'vite';
import copy from './.vite/copy';
import checker from 'vite-plugin-checker';

const ROOT = path.resolve('../../../');
const BASE = __dirname.replace(ROOT, '');

export default defineConfig({
  base: process.env.NODE_ENV === 'production' ? `${BASE}/dist/` : BASE,
  build: {
    manifest: 'manifest.json',
    assetsDir: '.',
    outDir: `dist`,
    emptyOutDir: true,
    rollupOptions: {
      input: ['resources/scripts/scripts.ts', 'resources/styles/style.css'],
      output: {
        entryFileNames: '[hash].js',
        assetFileNames: '[hash].[ext]',
        chunkFileNames: '[hash].js',
      },
    },
  },
  plugins: [
    copy({
      targets: [
        {
          src: `resources/images/**/*.{png,jpg,jpeg,svg,webp}`,
        },
      ],
    }),
    {
      name: 'php',
      handleHotUpdate({ file, server }) {
        if (file.endsWith('.php')) {
          server.ws.send({ type: 'full-reload' });
        }
      },
    },
    checker({ typescript: true }),
  ],
});
