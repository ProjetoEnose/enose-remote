import { defineConfig } from "vite";
import laravel from "laravel-vite-plugin";
import fs from "fs";
import path from "path";

// Função para coletar todos os arquivos CSS na pasta resources/css
function getCssFiles() {
    const cssDir = path.resolve(__dirname, "resources/css");
    const files = [];

    const collectFiles = (dir) => {
        fs.readdirSync(dir, { withFileTypes: true }).forEach((file) => {
            const fullPath = path.join(dir, file.name);
            if (file.isDirectory()) {
                collectFiles(fullPath);
            } else if (file.name.endsWith(".css")) {
                files.push(fullPath.replace(__dirname, ""));
            }
        });
    };

    collectFiles(cssDir);
    return files.map((file) => file.replace(/\\/g, "/"));
}

// Função para coletar todos os arquivos JS na pasta resources/js
function getJsFiles() {
    const jsDir = path.resolve(__dirname, "resources/js");
    const files = [];

    const collectFiles = (dir) => {
        fs.readdirSync(dir, { withFileTypes: true }).forEach((file) => {
            const fullPath = path.join(dir, file.name);
            if (file.isDirectory()) {
                collectFiles(fullPath);
            } else if (file.name.endsWith(".js")) {
                files.push(fullPath.replace(__dirname, ""));
            }
        });
    };

    collectFiles(jsDir);
    return files.map((file) => file.replace(/\\/g, "/"));
}

export default defineConfig({
    plugins: [
        laravel({
            input: [
                ...getCssFiles(), // Inclui todos os arquivos CSS dinamicamente
                ...getJsFiles(), // Inclui todos os arquivos JS dinamicamente
                "resources/css/app.css", // Inclui o app.css se necessário
            ],
            refresh: true,
        }),
    ],
    resolve: {
        alias: {
            "@": "resources/js",
            "#": "resources/css",
        },
    },
    build: {
        minify: "esbuild", // Garante que os arquivos JS e CSS sejam minificados
    },
});
