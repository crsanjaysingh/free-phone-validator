import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import html from '@rollup/plugin-html';
import { glob } from 'glob';

/**
 * Get Files from a directory
 * @param {string} query
 * @returns array
 */
function GetFilesArray(query) {
  return glob.sync(query);
}

/**
 * Js Files
 */
// Page JS Files
const pageJsFiles = GetFilesArray('resources/assets/js/*.js');

// Processing Vendor JS Files
const vendorJsFiles = GetFilesArray('resources/assets/vendor/js/*.js');

// Processing Libs JS Files
const LibsJsFiles = GetFilesArray('resources/assets/vendor/libs/**/*.js');

/**
 * Scss Files
 */
// Processing Core, Themes & Pages Scss Files
const CoreScssFiles = GetFilesArray('resources/assets/vendor/scss/**/!(_)*.scss');

// Processing Libs Scss & Css Files
const LibsScssFiles = GetFilesArray('resources/assets/vendor/libs/**/!(_)*.scss');
const LibsCssFiles = GetFilesArray('resources/assets/vendor/libs/**/*.css');

// Processing Fonts Scss Files
const FontsScssFiles = GetFilesArray('resources/assets/vendor/fonts/**/!(_)*.scss');

export default defineConfig({
  plugins: [
    laravel({
      input: [
        'resources/css/app.css',
        'resources/assets/css/demo.css',
        'resources/js/app.js',
        'resources/assets/frontend/css/frontend-main.css',
        'resources/assets/frontend/css/animate.css',
        'resources/assets/frontend/css/lineicons.css',
        'resources/assets/frontend/css/home-page.css',
        'resources/assets/frontend/js/frontend-main.js',
        'resources/assets/frontend/js/home-page.js',
        ...pageJsFiles,
        ...vendorJsFiles,
        ...LibsJsFiles,
        ...CoreScssFiles,
        ...LibsScssFiles,
        ...LibsCssFiles,
        ...FontsScssFiles
      ],
      refresh: true
    }),
    html()
  ],
  build: {
    // Increase the chunk size limit to avoid warnings
    chunkSizeWarningLimit: 2500,

    // Enable manual chunking for better splitting
    rollupOptions: {
      output: {
        manualChunks(id) {
          if (id.includes('node_modules')) {
            if (id.includes('apexcharts')) {
              return 'apexcharts';
            }
            if (id.includes('jquery')) {
              return 'jquery';
            }
            if (id.includes('bootstrap')) {
              return 'bootstrap';
            }
            if (id.includes('lodash')) {
              return 'lodash';
            }
            // Create vendor chunk for all node_modules
            return 'vendor';
          }

          // Splitting specific libraries for better control
          if (id.includes('resources/assets/vendor/libs')) {
            return 'libs';
          }

          if (id.includes('resources/assets/js')) {
            return 'page-js';
          }
        }
      }
    }
  }
});
