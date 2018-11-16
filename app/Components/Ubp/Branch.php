<?php

namespace App\Components\Ubp;

use DB;

class Branch
{
    public static function findNear($latitude, $longitude)
    {
        return DB::select('SELECT *, ( 6371 * acos( cos( radians(?) ) * cos( radians( latitude ) ) * cos( radians( longitude ) - radians(?) ) + sin( radians(?) ) * sin( radians( latitude ) ) ) ) AS distance FROM branches HAVING distance < 25 ORDER BY distance LIMIT 0 , 5;', [

            $latitude,
            $longitude,
            $latitude
        ]);
    }
}
