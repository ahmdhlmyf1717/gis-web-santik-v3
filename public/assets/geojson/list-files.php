<?php
$subfolder = isset($_GET['folder']) ? $_GET['folder'] : '.';
$path = __DIR__ . '/' . $subfolder;

if (!is_dir($path)) {
    http_response_code(404);
    echo json_encode(["error" => "Folder not found"]);
    exit;
}

$files = scandir($path);
$result = [];

foreach ($files as $file) {
    if ($file === '.' || $file === '..') continue;

    $filePath = $path . '/' . $file;
    $result[] = [
        "name" => $file,
        "type" => is_dir($filePath) ? "directory" : "file"
    ];
}

header('Content-Type: application/json');
echo json_encode($result);
