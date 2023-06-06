<?php

namespace App\Http\Controllers;

use App\Http\Requests\AirportRequest;
use App\Services\AirportService;
use Illuminate\Http\JsonResponse;

class AirportController extends Controller
{
    protected AirportService $airportService;

    public function __construct(AirportService $airportService)
    {
        $this->airportService = $airportService;
    }

    public function search(AirportRequest $request): JsonResponse
    {
        $airports = $this->airportService->search($request->validated());

        return response()->json([
            'status' => true,
            'count' => $airports->count(),
            'airports' => $airports
        ]);
    }

}
