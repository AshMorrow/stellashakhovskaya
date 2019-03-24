@extends('layouts.main')
@section('title','Наши коллекции')
@section('content')
    <div class="section_label">
        <div></div>
        <h2>Наши коллекции</h2>
        <div></div>
    </div>
    <div class="container collections_container">
        @foreach($collections as $collection)            
            <div class="collection_tile">
                <a href="{{route('partition.list')}}/{{$collection['url']}}">
                    <img src="/storage/collections_img/{{$collection['id']}}/front.jpg">
                    <div class="collection_tile_label">
                        {{$collection['name']}}
                    </div>
                </a>
            </div>
        @endforeach
    </div>
    <div class="line"></div>
    <div class="part_text">
        Современность и богатство модельного ряда, высокое качество материала и идеальный крой дополнят внимательное обслуживание
        и доброжелательная атмосфера. Мы умеем почувствовать и подчеркнуть индивидуальность и уникальность каждой клиентки.
        К вашим пожеланиям внимательно отнесутся наши консультанты и помогут определиться в широком разнообразии стилей,
        моделей, фактуры, цветов и аксессуаров и сделают все, чтобы выбор платья доставил вам истинное удовольствие и ощущение праздника.
    </div>
@stop