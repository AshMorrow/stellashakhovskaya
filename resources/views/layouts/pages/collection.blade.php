@extends('layouts.main')

@section('content')
    <div class="section_label">
        <div></div>
        <h2>{{$collections[0]->coll_name}}</h2>
        <div></div>
    </div>
    <div class="container collections_container">
        @foreach($collections as $collection)
            <div class="collection_tile">
                <a href="/collections/{{$collection->cm_url}}/{{$collection->url}}/{{strtolower($collection->name)}}_{{$collection->dress_code}}">
                    <img src="/storage/collections_img/{{$collection->cm_id}}/{{$collection->id}}/thumb/front.jpg">
                    <div class="collection_tile_label">
                        {{$collection->name}}
                    </div>
                </a>
            </div>
        @endforeach
    </div>
    <div class="line"></div>
@stop