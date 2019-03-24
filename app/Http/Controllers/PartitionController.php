<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

class PartitionController extends Controller
{
    public function list()
    {        
        $collections['collections'] = \App\Partition::get()->toArray();
        return view('layouts/pages/partition_list', $collections);
    }
    
    public function show($partition_name)
    {                       
        $partition = \App\Partition::with([
                'collections' => function ($query) {
                    $query->where('is_archived', '=', 0);
                }
            ])
            ->where('url', '=', $partition_name)                                   
            ->get()
            ->toArray();        

        return view('layouts/pages/partition_show', ['partition' => $partition[0]]);
    }    

    public function showDress($name, $coll_name, $dress_code)
    {

        // get main dress
        $collections['collections'] = DB::table('collections AS c')
            ->leftJoin('dress AS d', 'c.id', '=', 'd.c_id')
            ->leftJoin('collections_main AS cm', 'c.cm_id', '=', 'cm.id')
            ->select('d.*', 'd.id AS d_id', 'c.cm_id', 'c.id', 'cm.url AS cm_url', 'c.url AS   url', 'c.name AS coll_name')->where([
                ['c.url', '=', $coll_name],
                ['d.dress_code', '=', $dress_code]
            ])->first();

        // get same dress in collections
        $collections['others_dress'] = DB::table('collections AS c')
            ->leftJoin('dress AS d', 'c.id', '=', 'd.c_id')
            ->leftJoin('collections_main AS cm', 'c.cm_id', '=', 'cm.id')
            ->select('d.*', 'c.cm_id', 'c.id', 'cm.url AS cm_url', 'c.url AS   url', 'c.name AS coll_name')->where([
                ['c.url', '=', $coll_name],
                ['d.dress_code', '<>', $dress_code]
            ])->inRandomOrder()->limit(3)->get();

        // get images name for main dress
        $images_folder = public_path('storage/collections_img/' . $collections['collections']->cm_id . '/' . $collections['collections']->c_id . '/' . $collections['collections']->dress_code);
        $images = scandir($images_folder);
        if (count($images) > 2) {
            unset($images[0], $images[1]);
            $collections['images'] = array_values($images);
        }

        $fav_dress = isset($_COOKIE['favorite_dress']) ? $_COOKIE['favorite_dress'] : 0;
        if ($fav_dress) {
            $fav_dress = json_decode($fav_dress)->dress;
            if (in_array($collections['collections']->d_id, $fav_dress)) {
                $collections['in_favorite'] = 1;
            } else {
                $collections['in_favorite'] = 0;
            }
        } else {
            $collections['in_favorite'] = 0;
        }

        return view('layouts/pages/dress', $collections);
    }    
}