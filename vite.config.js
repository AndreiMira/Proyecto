import { defineConfig } from "vite";
import laravel from "laravel-vite-plugin";

export default defineConfig({
    plugins: [
        laravel({
            input: [
                "resources/css/app.css",
                "resources/js/app.js",
                "resources/js/calendar.js",
                "resources/css/calendar.css",
                "resources/js/sqword.js",
                "resources/css/sqword.css",
                "resources/css/navbar.css",
                "resources/js/bootstrap.js",
            ],
        }),
    ],
    refresh: true,
});
