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

// Frontend JS Files
const frontendWowJs = GetFilesArray('resources/assets/frontend/js/wow/*.js');
const frontendJsFiles = GetFilesArray('resources/assets/frontend/js/*.js');

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

// Frontend CSS Files
const frontendCssFiles = GetFilesArray('resources/assets/frontend/css/*.css');

export default defineConfig({
  plugins: [
    laravel({
      input: [
        'resources/css/app.css',
        'resources/js/app.js',
        ...pageJsFiles,
        ...frontendWowJs,
        ...frontendJsFiles,
        ...vendorJsFiles,
        ...LibsJsFiles,
        ...CoreScssFiles,
        ...LibsScssFiles,
        ...LibsCssFiles,
        ...FontsScssFiles,
        ...frontendCssFiles
      ],
      refresh: true
    }),
    html()
  ],
  build: {
    // Increase the chunk size limit to avoid warnings
    chunkSizeWarningLimit: 2500,
  }
});
