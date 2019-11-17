@extends('layouts.main')
@section('title',$collections[0]->title? $collections[0]->title:$collections[0]->coll_name)
@section('content')
    <div class="section_label">
        <div></div>
        <h2>{{$collections[0]->coll_name}}</h2>
        <div></div>
    </div>
    <div class="container collections_container">
        @foreach($collections as $collection)
            @if($favorite_dress && in_array($collection->dress_id, $favorite_dress))
                <?php
                $dress = [
                    'text' => 'Удалить из избранного',
                    'icon' => '',
                    'script' => 'removeFromFavorite(this,false)',
                    'class' => 'delete_from_favorite',
                    'attr' => '1'
                ];
                ?>
            @else
                <?php
                $dress = [
                    'text' => 'Добавить в избранное',
                    'icon' => '',
                    'script' => 'addToFavorite(this)',
                    'class' => 'add_favorite',
                    'attr' => '0'
                ]
                ?>
            @endif
            <div class="collection_tile">
                <div onclick="{{$dress['script']}}" class="{{$dress['class']}} noselect to_favorite"
                     dress-id="{{$collection->dress_id}}" in-favorite="{{$dress['attr']}}">
                    <span>{{$dress['text']}}</span>
                    <span class="icon">{{$dress['icon']}}</span>
                </div>
                <a href="/collections/{{$collection->cm_url}}/{{$collection->url}}/{{$collection->dress_code}}">
                    <img src="/storage/collections_img/{{$collection->cm_id}}/{{$collection->id}}/thumb/{{$collection->dress_code}}/front.jpg">
                    <div class="collection_tile_label">
                        {{$collection->name}} {{$collection->dress_code}}
                    </div>
                </a>
            </div>
        @endforeach
        @for($i = 0; $i < 3; $i++)
            <div class="empty_collection_tile">
            </div>
        @endfor
    </div>


    <!-- pagination -->

    @if($collections->lastPage() > 1)
        <div class="pagination">
            <div class="pg_line"></div>
            <nav>
                @if($collections->currentPage() == 1)
                    <span class="pg_arrow disabled"></span>
                    <span class="pg_arrow disabled"></span>
                @else
                    <a href="{{Request::url()}}" class="pg_arrow"></a>
                    <a href="{{$collections->previousPageUrl() == Request::url().'?page=1'? Request::url(): $collections->previousPageUrl()}}"
                       class="pg_arrow"></a>
                @endif
                @for($i = 1; $i <= $collections->lastPage();$i++)
                    @if($i == 1 && $collections->currentPage() != 1)
                        <a href="{{Request::url()}}">{{$i}}</a>
                    @elseif($collections->currentPage() == $i)
                        <span>{{$i}}</span>
                    @else
                        <a href="{{Request::url().'?page='.$i}}">{{$i}}</a>
                    @endif
                @endfor

                @if($collections->currentPage() == $collections->lastPage())
                    <span class="pg_arrow disabled"></span>
                    <span class="pg_arrow disabled"></span>
                @else
                    <a href="{{$collections->nextPageUrl()}}"
                       class="pg_arrow"></a>
                    <a href="{{Request::url().'?page='.$collections->lastPage()}}" class="pg_arrow"></a>
                @endif
            </nav>
            <div class="pg_line"></div>
        </div>
    @endif
    {{--
    <div class="line"></div>--}}
@stop