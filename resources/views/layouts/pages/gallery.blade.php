@extends('layouts.main')
@section('title', $title )
@section('content')
    <div class="section_label">
        <div></div>
        <h2>{{$label}}</h2>
        <div></div>
    </div>
    <div class="container collections_container">
        @foreach($images as $id => $image)
            <div class="collection_tile">
                <img onclick="popUp.portfolioFull(this)"
                     src="/storage/gallery/{{$coll_id}}/thumbs/{{$image}}" data-id='{{$id}}' data-src='/storage/gallery/{{$coll_id}}/full/{{$image}}' data-type="gallery">
            </div>
        @endforeach
        @for($i = 0; $i < 3; $i++)
            <div class="empty_collection_tile">
            </div>
        @endfor
    </div>

    @if($pages > 1)
        <div class="pagination">
            <div class="pg_line"></div>
            <nav>
                @if($cur_page == null || $cur_page == 1)
                    <span class="pg_arrow disabled"></span>
                    <span class="pg_arrow disabled"></span>
                @else
                    <a href="{{Request::url()}}" class="pg_arrow"></a>
                    <a href="{{($cur_page - 1) == 1? Request::url(): Request::url().'?page='. ($cur_page - 1)}}"
                       class="pg_arrow"></a>
                @endif
                @for($i = 1; $i <= $pages;$i++)
                    @if($i == 1 && $cur_page != null)
                        <a href="{{Request::url()}}">{{$i}}</a>
                    @elseif($cur_page == $i || $cur_page == null && $i == 1)
                        <span>{{$i}}</span>
                    @else
                        <a href="{{Request::url().'?page='.$i}}">{{$i}}</a>
                    @endif
                @endfor

                @if($cur_page >= $pages)
                    <span class="pg_arrow disabled"></span>
                    <span class="pg_arrow disabled"></span>
                @else
                    <a href="{{Request::url().'?page='. ($cur_page + 1)}}"
                       class="pg_arrow"></a>
                    <a href="{{Request::url().'?page='.$pages}}" class="pg_arrow"></a>
                @endif


            </nav>
            <div class="pg_line"></div>
        </div>
    @endif
@stop