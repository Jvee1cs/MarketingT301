<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MapController extends Controller
{
    /**
     * Show the locator map.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function showMap()
    {
        // You can fetch data from the database or any other source here if needed

        // Pass any necessary data to the view
        $mapData = [
            'latitude' => 40.7128,
            'longitude' => -74.0060,
            'zoom' => 12,
        ];

        // Return the view with the data
        return view('map', compact('mapData'));
    }
}