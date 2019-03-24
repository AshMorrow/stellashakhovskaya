@extends('layouts.main')
@section('title','Избранные платья')
@section('content')
    <div class="section_label">
        <div></div>
        <h2>Избранные платья</h2>
        <div></div>
    </div>
    @if(isset($collections))
    <div class="container collections_container">
        @foreach($collections as $collection)
            <div class="collection_tile">
                <div onclick="removeFromFavorite(this,true)" class="delete_from_favorite noselect" dress-id="{{$collection->dress_id}}">
                    <span>Удалить из избранного</span>
                    <span class="icon_close"></span>
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
    @endif
@stop