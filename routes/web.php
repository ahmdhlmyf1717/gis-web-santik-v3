<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GeoDataController;

Route::get('/', function () {
    return view('map');
});

Route::get('/geo-data', [GeoDataController::class, 'index']);

Route::post('/geo-data', [GeoDataController::class, 'store']);

Route::get('/geojson/{filename}', function ($filename) {
    $path = public_path('geojson/' . $filename . '.geojson');
    if (!file_exists($path)) {
        abort(404, 'File not found');
    }
    return response()->file($path);
});

Route::get('/list-files', function () {
    $folderPath = public_path();
    $files = array_diff(scandir($folderPath), ['.', '..']);
    $geojsonFiles = array_filter($files, function ($file) {
        return pathinfo($file, PATHINFO_EXTENSION) === 'geojson';
    });
    return response()->json(array_values($geojsonFiles));
});

Route::get('/geojson/list-folder', function () {
    $folderPath = public_path('assets/geojson');
    $folders = [];

    // Scan folder dan hanya ambil nama file/folder
    foreach (scandir($folderPath) as $item) {
        if ($item !== '.' && $item !== '..') {
            $folders[] = $item;
        }
    }

    return response()->json($folders);
});
