import { defineConfig } from "vite";
import laravel from "laravel-vite-plugin";

export default defineConfig({
    plugins: [
        laravel({
            input: [
                "resources/css/app.css",
                "resources/js/app.js",
                "resources/favicon_package/apple-touch-icon.png",
                "resources/favicon_package/favicon-32x32.png",
                "resources/favicon_package/favicon-16x16.png",
                "resources/favicon_package/favicon.ico",
                "resources/favicon_package/site.webmanifest",
                "resources/favicon_package/safari-pinned-tab.svg",
                "resources/favicon_package/android-chrome-192x192.png",
                "resources/favicon_package/android-chrome-384x384.png",
                "resources/favicon_package/mstile-150x150.png",
                "resources/favicon_package/browserconfig.xml",
            ],
            refresh: true,
        }),
    ],
});
