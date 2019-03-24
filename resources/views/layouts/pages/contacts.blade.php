@extends('layouts.main')

@section('title','Контакты')

@section('content')
    <div class="section_label">
        <div></div>
        <h2>Будем рады видеть вас в наших салонах</h2>
        <div></div>
    </div>

    {{--<div class="cont_label container">--}}
        {{--Салоны "Stella Shakhovskaya":--}}
    {{--</div>--}}
    <section class="cont_main container" style="align-items: baseline;">
        <div>
            <span class="con_bold">Киев</span>, ул.Ивана Мазепы 18/29<br>
            тел. +38 044 2802280,<br>
            тел. +38 093 7447857<br>
            Режим работы: <address style="margin-left:15px;"><span class="con_bold">Вт-Сб: с 11:00 до 19:00</span><br><span class="con_bold">Вс: с 12:00 до 16:00</span><br><span class="con_bold">Пн: Выходной</span></address>
        </div>
        <div>
            <span class="con_bold">Львов</span>, ул. Ивана Франко 46,<br>
            тел. +38 050 6218623<br>
            Режим работы: <span class="con_bold">Пн-Вс с 10:00 до 19:00</span>
        </div>
        <div>
            <span class="con_bold">Черновцы</span>, ул.Гете 3<br>
            тел. +38 066 4444560<br>
            Режим работы: <span class="con_bold">Пн-Вс с 10:00 до 19:00</span>
        </div>

        <div></div>
        <div></div>
    </section>

    {{--<div class="cont_label container">--}}
        {{--Оптовые продажи:--}}
    {{--</div>--}}

    {{--<section class="cont_opt container">--}}

        {{--<div></div>--}}
        {{--<div></div>--}}
    {{--</section>--}}

    <section class="mp_reviews_block">
        <div class="section_label">
            <div></div>
            <h2>Мы с радостью ответим на все ваши вопросы</h2>
            <div></div>
        </div>

        <div id="massage_form" class="container mp_contact_form">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <div class="form_left">
                <div class="input_container">
                    <div class="input_label">Имя:</div>
                    <input name="name" type="text"/>
                </div>
                <div class="input_container">
                    <div class="input_label">Почта:</div>
                    <input name='email' type="text"/>
                </div>
                <div class="input_container">
                    <div class="input_label">Телефон:</div>
                    <input  name='phone' type="text"/>
                </div>
            </div>
            <div class="form_right">
                <div class="input_label">Сообщение:</div>
                <textarea name="msg"></textarea>
            </div>
        </div>
        <button class="mp_contact_form_submit" onclick="sendMassage()">
            Задать вопрос
        </button>
    </section>
@endsection