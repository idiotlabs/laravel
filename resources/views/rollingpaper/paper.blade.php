<!doctype html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title></title>

    <style>
        @import url('https://fonts.googleapis.com/css?family=Nanum+Gothic+Coding&display=swap&subset=korean');

        * {
            font-family: 'Nanum Gothic Coding', monospace;
            -webkit-box-sizing: border-box;
            -moz-box-sizing: border-box;
            box-sizing: border-box;
        }

        ::-moz-selection {
            background: #C6FF91;
            text-shadow: none;
        }

        ::selection {
            background: #C6FF91;
            text-shadow: none;

        }

        body {
            margin: 0px;
            padding: 30px 10px;
            background: url(https://i.imgur.com/2BdQt0g.jpg);
            font-size: 1.1em;
            text-rendering: optimizeLegibility;
            -webkit-font-smoothing: antialiased;
        }

        .grid {
            display: grid;
            grid-gap: 10px;
            grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
            grid-auto-rows: 20px;
        }
        .item{
            position: relative;
        }

        /*.item {*/
        /*    background-color: #ffffff;*/
        /*    font-weight: 600;*/
        /*    line-height: 30px;*/
        /*    box-shadow: 0 4px 5px rgba(0, 0, 0, 0.2);*/
        /*}*/

        .masonry {
            column-count: 4;
            column-gap: 1em;
        }

        .item {
            background-color: #eee;
            display: inline-block;
            margin: 0 0 2.5em;
            width: 100%;
            line-height: 26px;
            position: relative;
        }

        @media only screen and (min-width: 1024px) {
            .masonry {
                column-count: 4;
            }
        }

        @media only screen and (max-width: 1023px) and (min-width: 768px) {
            .masonry {
                column-count: 3;
            }
        }

        @media only screen and (max-width: 767px) and (min-width: 320px) {
            .masonry {
                column-count: 1;
            }
        }

        .item::before {
            display: block;
            content: "";
            position: relative;
            top: -13px;
            width: 130px;
            height: 28px;
            margin: 0 auto;
            margin-bottom: -13px;
            background: rgba(227, 200, 114, 0.40);
            box-shadow: 0 1px 1px rgba(0, 0, 0, 0.2);
            border-radius: 6px/18px 0;
            -webkit-transform: rotate(-2deg);
            -moz-transform: rotate(-2deg);
            -o-transform: rotate(-2deg);
            -ms-transform: rotate(-2deg);
            transform: rotate(-2deg);
            z-index: 2;
        }

        .item-yellow {
            background: #F7E999;
            -webkit-transform: rotate(2deg);
            -moz-transform: rotate(2deg);
            -o-transform: rotate(2deg);
            -ms-transform: rotate(2deg);
            transform: rotate(2deg);
        }

        .item-blue {
            background: #b9dcf4;
            -webkit-transform: rotate(-2deg);
            -moz-transform: rotate(-2deg);
            -o-transform: rotate(-2deg);
            -ms-transform: rotate(-2deg);
            transform: rotate(-2deg);
        }

        .item-pink {
            background: #FFBDA3;
            -webkit-transform: rotate(1deg);
            -moz-transform: rotate(1deg);
            -o-transform: rotate(1deg);
            -ms-transform: rotate(1deg);
            transform: rotate(1deg);
        }

        .item-green {
            background: #CAF4B9;
            -webkit-transform: rotate(-1deg);
            -moz-transform: rotate(-1deg);
            -o-transform: rotate(-1deg);
            -ms-transform: rotate(-1deg);
            transform: rotate(-1deg);
        }

        .desc {
            padding: 10px 18px;
        }

        .writer {
            float: right;
        }

        .writer::after {
            dispaly: block;
            content: '';
            clear: both;
        }

        .date {
            text-align: right;
        }

        img {
            width: 100%;
        }
    </style>

    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-148720967-3"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());

        gtag('config', 'UA-148720967-3');
    </script>
</head>
<body>
{{--<div class="grid">--}}
<div class="masonry">
    @foreach($note_list as $note)
        <div class="item item-{{ $note->color }}">
            <div class="content">
                <div class="desc">
                    <p>{!! nl2br($note->note) !!}</p>
                    <p class="date">{!! substr($note->date, 0, 10) !!}</p>
                </div>
            </div>
        </div>
    @endforeach

</div>
<script>
    function resizeAllGridItems() {
        let allItems = document.getElementsByClassName("item");
        for (let x = 0; x < allItems.length; x++) {
            resizeGridItem(allItems[x]);
        }
    }

    function resizeGridItem(item) {
        let grid = document.getElementsByClassName("grid")[0];
        let rowHeight = parseInt(window.getComputedStyle(grid).getPropertyValue('grid-auto-rows'));
        let rowGap = parseInt(window.getComputedStyle(grid).getPropertyValue('grid-row-gap'));
        let rowSpan = Math.ceil((item.querySelector('.content').getBoundingClientRect().height + rowGap) / (rowHeight + rowGap));
        item.style.gridRowEnd = "span " + rowSpan;
    }

    function resizeInstance(instance) {
        let item = instance.elements[0];
        resizeGridItem(item);
    }

    // window.onload = resizeAllGridItems();
    // window.addEventListener("resize", resizeAllGridItems);
</script>
</body>
</html>