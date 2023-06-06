<?php

namespace App\Services;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Collection;

class AirportService
{
    /**
     * Airport search by part of the name.
     */
    public function search(array $request): Collection
    {
        $query = '%' . $request['query'] . '%';

        $airports = DB::table('airports')
            ->select(['code', 'name_ru', 'name_en'])
            ->where('name_ru', 'like', $query)
            ->orWhere('name_en', 'like', $query);

        if (array_key_exists('limit', $request)) {
            $airports->limit($request['limit']);
        }

        return $airports->get();
    }
}
