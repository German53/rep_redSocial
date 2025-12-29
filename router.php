<?php
// Simple router for the PHP built-in dev server
// Serves static files from public directory, routes everything else to index.php

$public_dir = __DIR__ . '/public';
$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

// If the requested file/directory exists in public, serve it
$file = $public_dir . $uri;
if ($uri !== '/' && file_exists($file)) {
    return false; // Let PHP server serve the file
}

// Otherwise, route to index.php
require_once $public_dir . '/index.php';
