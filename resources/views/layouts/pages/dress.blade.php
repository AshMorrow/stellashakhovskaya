@extends('layouts.main')
@section('title',$collections->seo_title)
@section('content')
    <div class="section_label">
        <div></div>
        <h2>{{$collections->dress_code}}</h2>
        <div></div>
    </div>
    <div class="container collections_container">
        <div class="dress_left">
            <a href="/collections/{{$collections->cm_url}}/{{$collections->url}}">
                <div class="icon_back"></div>
                <div class="icon_back_text">Назад к коллекции <br>{{$collections->coll_name}}</div>
            </a>
        </div>
        <div id="dress_show_container" class="noselect">
            <div id="main_dress_photo">
                <img onclick="popUp.portfolioFull(this)"
                     src="/storage/collections_img/{{$collections->cm_id}}/{{$collections->c_id}}/{{$collections->dress_code}}/{{$images[0]}}"
                     data-id="0">
            </div>
            <div id="dress_photo_list" class="noselect">
                <div>
                    <?php $img_active_cnt = 0; ?>
                    @foreach($images as $img_id => $image)
                        <div <?= $img_active_cnt == 0 ? 'class="active"' : '';?> onclick="select_dress(this)">
                            <img src="/storage/collections_img/{{$collections->cm_id}}/{{$collections->c_id}}/{{$collections->dress_code}}/{{$image}}"
                                 data-src='/storage/collections_img/{{$collections->cm_id}}/{{$collections->c_id}}/{{$collections->dress_code}}/{{$image}}'
                                 data-id='{{$img_id}}' data-type="gallery">
                        </div>
                        <?php $img_active_cnt += 1; ?>
                    @endforeach
                </div>
            </div>
        </div>
        <div class="dress_right noselect">
            <div id="add_to_favorite"
                 {{$in_favorite == 1? 'class=dress_in_favorite': ''}} dress-id="{{$collections->d_id}}"
                 in-favorite="{{$in_favorite}}" onclick="toFavorite()">
                <div class="icon_heart"></div>
                <div class="icon_heart_text">{{$in_favorite  == 1? 'Удалить из избранного': 'Добавить в избранное'}}</div>
            </div>
        </div>
    </div>
    <div class="section_label">
        <div></div>
        <h2>Другие платья этой коллекции</h2>
        <div></div>
    </div>
    <div class="other_dress">
        @foreach($others_dress as $collection)
            <div class="collection_tile">
                <a href="/collections/{{$collection->cm_url}}/{{$collection->url}}/{{$collection->dress_code}}">
                    <img src="/storage/collections_img/{{$collection->cm_id}}/{{$collection->id}}/thumb/{{$collection->dress_code}}/front.jpg">
                    <div class="collection_tile_label">
                        {{$collection->name}} {{$collection->dress_code}}
                    </div>
                </a>
            </div>
        @endforeach
        <div class="collection_tile"></div>
        <div class="collection_tile"></div>
        <div class="collection_tile"></div>
    </div>
@stop