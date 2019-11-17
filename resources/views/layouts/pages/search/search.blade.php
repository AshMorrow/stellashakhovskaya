@extends('layouts.main')
@section('title','Поиск')
@section('content')
    <div class="container">
        <div id="search_input_container">
            <input onfocus="searchEvents.startEvent()" onblur="searchEvents.stopE" id="search_dress_input" />
            <button onclick="startSearch()">Найти</button>
        </div>
    </div>

    <div id='search_results'class="container collections_container">
    </div>
@endsection