<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SearchController extends Controller
{

    public function showSearchTemplate(){

        return view('layouts/pages/search/search');

    }

    public function getSearchData(Request $request){


        $sql_query = '';

        if(!$request->get('searchType') || !$request->get('data')[0]){
            return;
        }

        if($request->get('searchType') == 1){

            if(intval($request->get('data')[0])){
                $sql_query = "d.dress_code LIKE ('{$request->get('data')[0]}%')";
            }else{
                $sql_query = "d.name LIKE ('{$request->get('data')[0]}%')";
            }

        }else if($request->get('searchType') == 2){

            $sql_query = "d.name LIKE ('{$request->get('data')[0]}%') AND d.dress_code LIKE ('{$request->get('data')[1]}%')";

        }else{

            return 0;

        }

        $search_results = DB::table('dress AS d')
            ->leftJoin('collections AS c', 'c.id', '=', 'd.c_id')
            ->leftJoin('collections_main AS cm', 'cm.id', '=', 'c.cm_id')
            ->select('d.*', 'c.cm_id', 'c.id', 'cm.url AS cm_url', 'c.url AS   c_url',
                'c.name AS coll_name', 'd.id AS dress_id')->whereRaw($sql_query)->get()->toArray();

        return json_encode($search_results);
//        var_dump($search_results);

    }

}
