<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title')</title>
    <link rel="stylesheet" href="/css/main.css">
    <link rel="stylesheet" href="/css/main_page.css">
    <link rel="stylesheet" href="/css/about.css">
    <link rel="stylesheet" href="/css/contacts.css">
    <link rel="stylesheet" href="/css/collections.css">
    <link rel="stylesheet" href="/css/dress.css">
    <link rel="stylesheet" href="/css/animation.css">
    <link rel="stylesheet" href="/css/popup.css">
    <link rel="stylesheet" href="/css/error.css">
    <link rel="stylesheet" href="/css/responsive.css">
    <link rel="stylesheet" href="/css/m_menu.css">

    <!-- FAVICON -->

    <link rel="apple-touch-icon" sizes="76x76" href="/favicons/apple-touch-icon.png">
    <link rel="icon" type="image/png" href="/favicons/favicon-32x32.png" sizes="32x32">
    <link rel="icon" type="image/png" href="/favicons/favicon-16x16.png" sizes="16x16">
    <link rel="manifest" href="/favicons/manifest.json">
    <link rel="mask-icon" href="/favicons/safari-pinned-tab.svg" color="#5bbad5">
    <meta name="theme-color" content="#ffffff">

    <!-- FONTS -->
    <link rel="stylesheet" href="/css/fonts.css">

</head>
<body>
<div id="preloader">
    <div>
        <img src="/img/logo/logo.png" alt="preload img">
        <span class="animate-spin"></span>
    </div>
</div>
<div class="main_wrapper">
    @include('nav.nav')
    <main>
        @yield('content')
    </main>
</div>
<footer>
    <div class="container">
        <div class="ft_contacts">
            <div>Киев, ул. Ивана Мазепы, 18/29, +38 044 280 2280</div>
            <div>Львов, ул. Ивана Франко, 55, +38 050 621 8623</div>
            <div>Черновцы, ул. Гете, 3, +38 066 444 4560</div>
        </div>
        <div class="ft_logo"><a href="/">
                <img src="/img/logo/logo_footer.png" alt="footer logo">
            </a></div>
        <div id="ft_social">
            <div class="mm_social_buttons">
                <a href="http://www.facebook.com/pages/Stella-Shakhovskaya/140164439343672?sk=timeline&ref=page_internal"
                   target="_blank"><span class="mm_facebook"></span></a>
                <a href="http://instagram.com/stella_shakhovskaya/" target="_blank"><span class="mm_instagram"></span></a>
                <a href="http://vk.com/club27353479" target="_blank"><span class="mm_vk"></span></a>
            </div>
            <div class="ft_copyright">
                <div>© 2017 Stella Shakhovskaya.</div>
                <div>Created by <a href ="http://cv.bohdan.pro/" style="text-decoration: none;color: #666">Bohdan Yaremchuk</a></div>
            </div>
        </div>
    </div>

    <!-- JS -->
    <script src="/js/jquery_min.js"></script>
    @if(Request::path() == '/')
        <script type="application/javascript" async src="/js/main_page.js"></script>
    @endif
    <script type="application/javascript"  src="/js/all.js"></script>
    <script type="application/javascript"  src="/js/popup.js"></script>
    <script type="application/javascript"  src="/js/m_menu.js"></script>
    <script type="application/javascript"  src="/js/search.js"></script>
    <!-- Google Analytics Start -->
    <script>
        (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
                (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
            m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
        })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

        ga('create', 'UA-62939249-1', 'auto');
        ga('send', 'pageview');

    </script>
    <!-- Google Analytics End -->
</footer>
<div id="notifications_holder">
</div>
</body>
</html>