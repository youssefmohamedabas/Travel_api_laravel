<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\TourResource;
use App\Models\Travel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class TourController extends Controller
{
    public function index(Travel $travel, Request $request)
    {
        // Use Validator::make to create a validator instance
        $validator = Validator::make($request->all(), [
            'priceFrom' => 'nullable|numeric', // Nullable so it doesn't require the field
            'priceTo' => 'nullable|numeric',
            'dateFrom' => 'nullable|date',
            'dateTo' => 'nullable|date',
            'sortBy' => ['nullable', Rule::in(['price'])], // Ensure it's nullable to allow absence
            'sortOrder' => ['nullable', Rule::in(['asc', 'desc'])],
        ], [
            'sortBy.in' => "You must select 'price' as a valid sort field",
            'priceFrom.numeric' => "The 'priceFrom' field must be numeric", // Custom error message for priceFrom
            'priceTo.numeric' => "The 'priceTo' field must be numeric", // Custom error message for priceTo
        ]);

        // Check if validation fails
        if ($validator->fails() || $request->priceFrom>$request->priceTo) {
            return response()->json([
                'status' => 'error',
                'errors' => $validator->errors(),
            ], 422); // Return validation errors as JSON
        }

        // Filter the tours based on the validated request data
        $tours = $travel->tours()
            ->when($request->dateFrom, function ($query) use ($request) {
                $query->where('start_date', '>=', $request->dateFrom);
            })
            ->when($request->dateTo, function ($query) use ($request) {
                $query->where('end_date', '<=', $request->dateTo);
            })
            ->when($request->priceFrom, function ($query) use ($request) {
                $query->where('price', '>=', $request->priceFrom * 100);
            })
            ->when($request->priceTo, function ($query) use ($request) {
                $query->where('price', '<=', $request->priceTo * 100);
            })
            ->when($request->sortBy && $request->sortOrder, function ($query) use ($request) {
                $query->orderBy($request->sortBy, $request->sortOrder);
            });

        // Paginate the results
        $tours = $tours->paginate();

        // Return the paginated tour resources
        return TourResource::collection($tours);
    }
}