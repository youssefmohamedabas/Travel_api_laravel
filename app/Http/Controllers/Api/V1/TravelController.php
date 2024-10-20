<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\TravelResource;
use App\Models\Travel;
use Illuminate\Http\Request;


class TravelController extends Controller
{
    public function index()
    {

        $travels=Travel::where('is_public',true)->paginate();
        return TravelResource::collection($travels); // Retrieve all travels
    }

    public function show($id)
    {
        return Travel::findOrFail($id); // Retrieve a single travel by ID
    }

    public function store(Request $request)
    {
        // Handle storing a new travel
    }

    public function update(Request $request, $id)
    {
        // Handle updating a travel
    }

    public function destroy($id)
    {
        // Handle deleting a travel
    }
}