<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="A sample pwa">
    <meta name="theme-color" content="#ededed" />
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>김창섭 ❤ 정정은의 청첩장</title>

    <meta property="og:title" content="김창섭 ❤ 정정은의 청첩장" />
    <meta property="og:description" content="4월의 아름다운 날 저희 두사람, 결혼합니다." />
    <meta property="og:image" content="/images/wedding/photo1.jpg" />
    <meta property="og:url" content="/wedding" />

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Nanum+Pen+Script&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Nanum+Myeongjo&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Noto+Serif+KR&display=swap" rel="stylesheet">

    <!-- Web Application Manifest -->
    <link rel="manifest" href="{{ url('/wedding/manifest.json') }}">

    <!-- Add to homescreen for Safari on iOS -->
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <meta name="apple-mobile-web-app-title" content="sample pwa">
    <link rel="apple-touch-icon" href="/images/wedding/icons/icon152.png">

    <!-- Add to homescreen for Chrome on Android -->
    <meta name="mobile-web-app-capable" content="yes">
    <meta name="application-name" content="sample pwa">
    <link rel="icon" sizes="152x152" href="/images/wedding/icons/icon152.png">

    <script>
        // Register service worker.
        // if ('serviceWorker' in navigator) {
        //     window.addEventListener('load', () => {
        //         navigator.serviceWorker.register('/wedding-service-worker.js')
        //             .then((reg) => {
        //                 console.log('Service worker registered.', reg);
        //             });
        //     });
        // }
    </script>

    <link rel="stylesheet" href="{{ mix('css/main.css') }}">
    <link rel="stylesheet" href="{{ mix('css/photoswipe.css') }}">
    <link rel="stylesheet" href="{{ mix('css/default-skin.css') }}">

    <style>
        body {
            position:relative;
        }
        body::after {
            content: "";
            background: url('/images/wedding/bg_yellow_01.jpeg');
            opacity: 0.5;
            top: 0;
            left: 0;
            bottom: 0;
            right: 0;
            position: absolute;
            z-index: -1;
        }
        .font-nanum-pen {
            font-family: 'Nanum Pen Script', cursive;
        }
        .font-nanum-myeongjo {
            font-family: 'Nanum Myeongjo', serif;
        }
        .font-noti-serif-kr
        {
            font-family: 'Noto Serif KR', serif;
        }
        .grid {
            display: grid;
            grid-template-columns: 1fr;
            grid-gap: 0.5rem;
            grid-template-columns: repeat(2, 1fr);
        }
        .grid img {
            border-radius: 10px;
        }
        .pswp--animate_opacity,
        .pswp__bg,
        .pswp__caption,
        .pswp__top-bar,
        .pswp--has_mouse .pswp__button--arrow--left,
        .pswp--has_mouse .pswp__button--arrow--right{
            -webkit-transition: opacity 333ms cubic-bezier(.4,0,.22,1);
            transition: opacity 333ms cubic-bezier(.4,0,.22,1);
        }
    </style>

</head>
<body>

<div id="app">
@yield('content')
</div>

<script src="{{ mix('js/app.js') }}"></script>
<script type="text/javascript" src="//dapi.kakao.com/v2/maps/sdk.js?appkey=aaa33390afe619d50797fbb1439b6b7e"></script>
<script>

</script>
@yield('script')
</body>
</html>
