<?php

namespace App\Http\Controllers;

use App\Http\Requests\AirportRequest;
use App\Models\Airport;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class AirportController extends Controller
{
    /**
     * Airport search by part of the name.
     */
    public function __invoke(AirportRequest $request): JsonResponse
    {
        $query = '%' . $request->query('query') . '%';

        /*
         * Alternate:
         * $airports = Airport::where('name_ru', 'like', $query)
               ->orWhere('name_en', 'like', $query);
         * */

        $airports = DB::table('airports')
            ->select(['code', 'name_ru', 'name_en'])
            ->where('name_ru', 'like', $query)
            ->orWhere('name_en', 'like', $query);

        if ($request->has('limit')) {
            $airports->limit($request->query('limit'));
        }

        $airports = $airports->get();

        return response()->json(['status' => true, 'count' => $airports->count(), 'airports' => $airports]);
    }

}
