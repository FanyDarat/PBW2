<?php
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/products', function (Request $request) {
    $latitude = $request->input('latitude');
    $longtitude = $request->input('longtitude');
    $radius = $request->input('radius', 10); // default radius 10 km
    
    $products = Product::select('*')
        ->selectRaw(
            "(6371 * acos(cos(radians(?)) * cos(radians(latitude)) * cos(radians(longtitude) - radians(?)) + sin(radians(?)) * sin(radians(latitude)))) AS distance",
            [$latitude, $longtitude, $latitude]
        )
        ->having('distance', '<=', $radius)
        ->orderBy('distance', 'asc')
        ->get();

    return response()->json($products);
});
