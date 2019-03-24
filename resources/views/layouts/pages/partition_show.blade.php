@extends('layouts.main')
@section('title', $partition['name'])
@section('content')
    <div class="section_label">
        <div></div>
        <h2>{{$partition['name']}}</h2>
        <div></div>
    </div>
    <div class="container collections_container">    
        @foreach($partition['collections'] as $collection)
            <div class="collection_tile">
                <a href="{{url()->current()}}/collection/{{$collection['url']}}">
                    <img src="/storage/collections_img/{{$collection['partition_id']}}/{{$collection['id']}}/thumb/front.jpg">
                    <div class="collection_tile_label">
                        {{$collection['name']}}
                    </div>
                </a>
            </div>
        @endforeach
    </div>
    <div class="line"></div>
@stop