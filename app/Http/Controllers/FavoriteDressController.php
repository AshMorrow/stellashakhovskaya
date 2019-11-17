<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

class FavoriteDressController extends Controller
{
    public function show()
    {

        $favorite_dress = isset($_COOKIE['favorite_dress']) ? json_decode($_COOKIE['favorite_dress'])->dress : false;
        if ($favorite_dress) {

            $collections['collections'] = DB::table('dress AS d')
                ->leftJoin('collections AS c', 'c.id', '=', 'd.c_id')
                ->leftJoin('collections_main AS cm', 'cm.id', '=', 'c.cm_id')
                ->select('d.*', 'd.id AS d_id', 'c.cm_id', 'c.id',
                    'cm.url AS cm_url', 'c.url AS   url', 'c.name AS coll_name',
                    'd.id AS dress_id')
                ->whereIn('d.id', $favorite_dress)->orderBy('cm.id')->paginate(16);

            return view('layouts/pages/favorite_dress', $collections);

        }
        return view('layouts/pages/favorite_dress');

    }
}
