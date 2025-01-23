<?php
$folderPath = './geojson'; // Lokasi folder GeoJSON

function getFolderContents($dir)
{
    $result = [];
    $files = scandir($dir);
    foreach ($files as $file) {
        if ($file === '.' || $file === '..') continue;

        $path = $dir . '/' . $file;
        if (is_dir($path)) {
            $result[$file] = getFolderContents($path);
        } elseif (pathinfo($file, PATHINFO_EXTENSION) === 'geojson') {
            $result[] = $file;
        }
    }
    return $result;
}

header('Content-Type: application/json');
echo json_encode(getFolderContents($folderPath));
