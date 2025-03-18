<?php

namespace App\Http\Controllers;

use App\Models\GeoData;
use App\Models\GeoJSONData;
use Illuminate\Http\Request;

class GeoDataController extends Controller
{
    public function index()
    {
        $geojsonFiles = GeoData::all();
        return view('admin.geojson.index', compact('geojsonFiles'));
    }

    public function upload(Request $request)
    {
        $request->validate([
            'geojson_file' => 'required|file|mimes:json,geojson|max:5120'
        ]);

        $file = $request->file('geojson_file');
        $size = $file->getSize();
        $name = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
        $content = file_get_contents($file->getRealPath());

        // Kalau kecil (< 1MB), simpan langsung di database
        if ($size < 1048576) { // 1MB
            GeoData::create([
                'name' => $name,
                'type' => 'point',
                'geojson' => $content,
                'file_path' => null
            ]);
        }
        // Kalau besar, simpan ke storage dan hanya simpan path di DB
        else {
            $path = $file->storeAs('geojson', $file->getClientOriginalName(), 'public');
            GeoData::create([
                'name' => $name,
                'type' => 'polygon',
                'geojson' => null,
                'file_path' => '/storage/' . $path
            ]);
        }

        return response()->json(['success' => 'GeoJSON berhasil diunggah!']);
    }

    public function getGeoJSONList()
    {
        $geojsonFiles = GeoData::all();

        return response()->json($geojsonFiles);
    }
    public function getGeoJSONById($id)
    {
        $geoData = GeoData::find($id);

        if (!$geoData) {
            return response()->json(['error' => 'GeoJSON not found'], 404);
        }

        return response()->json(json_decode($geoData->geojson));
    }

    public function getGeoJSONFeatures($id)
    {
        $geojson = GeoJSONData::find($id);
        if (!$geojson) {
            return response()->json(['error' => 'GeoJSON not found'], 404);
        }

        $data = json_decode($geojson->data, true);
        return response()->json($data['features']);
    }

    public function updateGeoJSONFeature(Request $request, $id)
    {
        $geojson = GeoJSONData::find($id);
        if (!$geojson) {
            return response()->json(['error' => 'GeoJSON not found'], 404);
        }

        $data = json_decode($geojson->data, true);
        foreach ($data['features'] as &$feature) {
            if ($feature['properties']['id'] == $request->feature_id) {
                $feature['geometry']['coordinates'] = [(float)$request->x, (float)$request->y];
            }
        }

        $geojson->data = json_encode($data);
        $geojson->save();

        return response()->json(['success' => 'Coordinates updated']);
    }
}
