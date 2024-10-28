<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\TravelRequest;
use App\Http\Resources\TravelResource;
use App\Models\Travel;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;



class TravelController extends Controller
{
    public function store(TravelRequest $request) {
        Log::info(Auth::check());
        if(!Auth::check()){
            return response()->json(['error' => 'Forbidden'], 403);
        }
        $travel = Travel::create($request->validated());
        return new TravelResource($travel); 
    }
    
    
}