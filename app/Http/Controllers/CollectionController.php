<?php

namespace App\Http\Controllers;

class CollectionController extends Controller {

    public function show($partitial_name, $collection_name)
    {        
        $collection = \App\Collection::where('url', '=', $collection_name)->first();
        $title = $collection->name;
        $seo_title = $collection->seo_title;
        $dresses = $collection->dresses()->paginate(16);
            
        $data = [
            'favorite_dress' => isset($_COOKIE['favorite_dress']) ? json_decode($_COOKIE['favorite_dress'])->dress : false,
            'dresses' => $dresses,
            'title' => $title,
            'seo_title' => $seo_title
        ];

        return view('layouts/pages/collection_show', $data);
    }
}