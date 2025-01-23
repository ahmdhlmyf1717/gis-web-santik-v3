<?php
$folderPath = isset($_GET['folder']) ? $_GET['folder'] : '.';

function listFilesAndDirectories($dir) {
    $result = [];
    $items = scandir($dir);

    foreach ($items as $item) {
        if ($item === '.' || $item === '..') {
            continue;
        }

        $path = $dir . DIRECTORY_SEPARATOR . $item;
        if (is_dir($path)) {
            $result[] = ['name' => $item, 'type' => 'directory'];
        } elseif (is_file($path)) {
            $result[] = ['name' => $item, 'type' => 'file'];
        }
    }
    return $result;
}

header('Content-Type: application/json');
echo json_encode(listFilesAndDirectories($folderPath));
?>
