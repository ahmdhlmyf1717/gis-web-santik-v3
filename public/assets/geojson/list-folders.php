<?php
// list-folder.php
header('Content-Type: application/json');

function scanDirectory($dir)
{
    $result = [];
    $files = scandir($dir);

    foreach ($files as $file) {
        if ($file === '.' || $file === '..') continue;

        $path = $dir . DIRECTORY_SEPARATOR . $file;
        if (is_dir($path)) {
            $result[$file] = scanDirectory($path);
        } else if (pathinfo($file, PATHINFO_EXTENSION) === 'geojson') {
            $result[$file] = $file;
        }
    }

    return $result;
}

$baseDir = __DIR__; // Directory where this PHP file is located
$structure = scanDirectory($baseDir);
echo json_encode($structure);
