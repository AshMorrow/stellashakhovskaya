<div class="noselect" {{Request::path() != '/'? 'style=height:45px': ''}}>
    <div id="mm_top_container" {{Request::path() == '/' ? 'on-main=1' : ''}}>
        <div class="logo"><img src="/img/logo/logo.png" alt="logo"></div>
        <nav class="main_menu">
            <a href="/" class="{{Request::path() == '/' ? 'active' : ''}}">Главная</a>
            <a href="/about" class="{{Request::path() == 'about' ? 'active' : ''}}">О компании</a>
            <a href="/collections" class="{{strstr(Request::path(),'collections')? 'active' : ''}}">Коллекции</a>
            <a href="/contacts" class="{{Request::path() == 'contacts' ? 'active' : ''}}">Контакты</a>
            {{--<a href="#">Архив</a>--}}
        </nav>
        <div id="mm_mobile_menu_container" >
            <div onclick="mobile_menu.show()">
                <span></span>
                <span></span>
                <span></span>
            </div>
        </div>
        <div class="mm_social_buttons">
            <a href="http://www.facebook.com/pages/Stella-Shakhovskaya/140164439343672?sk=timeline&ref=page_internal"
               target="_blank"><span class="mm_facebook"></span></a>
            <a href="http://instagram.com/stella_shakhovskaya/" target="_blank"><span class="mm_instagram"></span></a>
            <a href="http://vk.com/club27353479" target="_blank"><span class="mm_vk"></span></a>
        </div>
        <div class="mm_favorite">
            <div>
                <a {{isset($_COOKIE['favorite_dress'])? 'class=active': ''}} href="/favorite-dress"></a>
                @if(isset($_COOKIE['favorite_dress']))
                    <span>{{count(json_decode($_COOKIE['favorite_dress'])->dress)}}</span>
                @endif
            </div>
        </div>
    </div>
</div>