@extends('layouts.main')
@section('title', $seo_title)
@section('content')
    <div class="section_label">
        <div></div>
        <h2>{{$title}}</h2>
        <div></div>
    </div>
    <div class="container collections_container">
        @foreach($dresses as $dress)          
            @if($favorite_dress && in_array($dress->id, $favorite_dress))
                <?php
                $favorite_button = [
                    'text' => 'Удалить из избранного',
                    'icon' => '',
                    'script' => 'removeFromFavorite(this,false)',
                    'class' => 'delete_from_favorite',
                    'attr' => '1'
                ];
                ?>
            @else
                <?php
                $favorite_button = [
                    'text' => 'Добавить в избранное',
                    'icon' => '',
                    'script' => 'addToFavorite(this)',
                    'class' => 'add_favorite',
                    'attr' => '0'
                ]
                ?>
            @endif
            <div class="collection_tile">
                <div onclick="{{$favorite_button['script']}}" class="{{$favorite_button['class']}} noselect to_favorite"
                     dress-id="{{$dress->id}}" in-favorite="{{$favorite_button['attr']}}">
                    <span>{{$favorite_button['text']}}</span>
                    <span class="icon">{{$favorite_button['icon']}}</span>
                </div>
                <a href="{{url()->current()}}/{{$dress->dress_code}}">
                    <img src="/storage/collections_img/{{$dress->collection_id}}/thumb/{{$dress->dress_code}}/front.jpg">
                    <div class="collection_tile_label">
                        {{$dress->name}} {{$dress->dress_code}}
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

    @if($dresses->lastPage() > 1)
        <div class="pagination">
            <div class="pg_line"></div>
            <nav>
                @if($dresses->currentPage() == 1)
                    <span class="pg_arrow disabled"></span>
                    <span class="pg_arrow disabled"></span>
                @else
                    <a href="{{Request::url()}}" class="pg_arrow"></a>
                    <a href="{{$dresses->previousPageUrl() == Request::url().'?page=1'? Request::url(): $dresses->previousPageUrl()}}"
                       class="pg_arrow"></a>
                @endif
                @for($i = 1; $i <= $dresses->lastPage();$i++)
                    @if($i == 1 && $dresses->currentPage() != 1)
                        <a href="{{Request::url()}}">{{$i}}</a>
                    @elseif($dresses->currentPage() == $i)
                        <span>{{$i}}</span>
                    @else
                        <a href="{{Request::url().'?page='.$i}}">{{$i}}</a>
                    @endif
                @endfor

                @if($dresses->currentPage() == $dresses->lastPage())
                    <span class="pg_arrow disabled"></span>
                    <span class="pg_arrow disabled"></span>
                @else
                    <a href="{{$dresses->nextPageUrl()}}"
                       class="pg_arrow"></a>
                    <a href="{{Request::url().'?page='.$dresses->lastPage()}}" class="pg_arrow"></a>
                @endif
            </nav>
            <div class="pg_line"></div>
        </div>
    @endif
    {{--
    <div class="line"></div>--}}
@stop