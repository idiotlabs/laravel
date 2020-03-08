@extends('wedding.partials.layout')

@section('content')
    <div class="container mx-auto pb-10">
        <div class="">
            <div class="block text-gray-700 text-center px-4 py-2">
                <p class="font-nanum-pen text-3xl p-5"></p>
                <div style="position: relative">
                    <img class="w-full" src="{{ asset('images/wedding/photo1.jpg') }}" style="border-radius:50%;" />
                    <img src="{{ asset('images/wedding/bg_white_flower.png') }}"
                         style="position:absolute;left:0;top:0;right:0;bottom:0;" />
                </div>
            </div>
            <div class="block text-gray-700 text-center px-4 py-2 mt-4">
                <div class="font-noti-serif-kr p-2">
                    4월의 아름다운 날<br />
                    저희 두 사람, 결혼합니다.
                </div>
                <div class="font-noti-serif-kr p-2 text-2xl"><b>김창섭 ♥ 정정은</b></div>
                <div class="font-noti-serif-kr p-2 text-sm">
                    2020년 4월 25일 토요일 오후 5시<br />
                    아벤티움
                </div>
            </div>
            <div class="block text-gray-700 text-center px-4 py-2 mt-4">
                <p class="font-nanum-pen text-3xl p-2">사진</p>

                <div id="demo-test-gallery" class="demo-gallery grid max-w-4xl mx-auto">
                    <a href="{{ asset('images/wedding/studio/1.jpg') }}" data-size="1200x800" data-med="{{ asset('images/wedding/studio/1.jpg') }}" data-med-size="1200x800" >
                        <img src="{{ asset('images/wedding/studio/1.jpg') }}" alt="image">
                    </a>
                    <a href="{{ asset('images/wedding/studio/2.jpg') }}" data-size="1200x800" data-med="{{ asset('images/wedding/studio/2.jpg') }}" data-med-size="1200x800" >
                        <img src="{{ asset('images/wedding/studio/2.jpg') }}" alt="image">
                    </a>
                    <a href="{{ asset('images/wedding/studio/3.jpg') }}" data-size="800x1200" data-med="{{ asset('images/wedding/studio/3.jpg') }}" data-med-size="800x1200" >
                        <img src="{{ asset('images/wedding/studio/3.jpg') }}" alt="image">
                    </a>
                    <a href="{{ asset('images/wedding/studio/4.jpg') }}" data-size="800x1200" data-med="{{ asset('images/wedding/studio/4.jpg') }}" data-med-size="800x1200" >
                        <img src="{{ asset('images/wedding/studio/4.jpg') }}" alt="image">
                    </a>
                    <a href="{{ asset('images/wedding/studio/5.jpg') }}" data-size="1200x800" data-med="{{ asset('images/wedding/studio/5.jpg') }}" data-med-size="1200x800" >
                        <img src="{{ asset('images/wedding/studio/5.jpg') }}" alt="image">
                    </a>
                    <a href="{{ asset('images/wedding/studio/6.jpg') }}" data-size="1200x800" data-med="{{ asset('images/wedding/studio/6.jpg') }}" data-med-size="1200x800" >
                        <img src="{{ asset('images/wedding/studio/6.jpg') }}" alt="image">
                    </a>
                    <a href="{{ asset('images/wedding/studio/7.jpg') }}" data-size="800x1200" data-med="{{ asset('images/wedding/studio/7.jpg') }}" data-med-size="800x1200" >
                        <img src="{{ asset('images/wedding/studio/7.jpg') }}" alt="image">
                    </a>
                    <a href="{{ asset('images/wedding/studio/8.jpg') }}" data-size="800x1200" data-med="{{ asset('images/wedding/studio/8.jpg') }}" data-med-size="800x1200" >
                        <img src="{{ asset('images/wedding/studio/8.jpg') }}" alt="image">
                    </a>
                    <a href="{{ asset('images/wedding/studio/9.jpg') }}" data-size="1200x800" data-med="{{ asset('images/wedding/studio/9.jpg') }}" data-med-size="1200x800" >
                        <img src="{{ asset('images/wedding/studio/9.jpg') }}" alt="image">
                    </a>
                    <a href="{{ asset('images/wedding/studio/10.jpg') }}" data-size="1200x800" data-med="{{ asset('images/wedding/studio/10.jpg') }}" data-med-size="1200x800" >
                        <img src="{{ asset('images/wedding/studio/10.jpg') }}" alt="image">
                    </a>
                </div>

            </div>
            <div class="block text-gray-700 text-center px-4 py-2 mt-4">
                <p class="font-nanum-pen text-3xl p-2">오시는길</p>
                <div id="map" class="h-64" style="width:100%;"></div>
            </div>
            <div class="block text-gray-700 px-4 py-2 mt-4">
                <p class="font-nanum-pen text-3xl text-center p-2">방명록</p>
                <div id="board-list" class="mb-8">
                    @foreach ($board_list as  $board)
                    <div class="w-full mb-2">
                        <div class="border border-gray-400 bg-white rounded-b p-4 flex flex-col justify-between leading-normal">
                            <div class="mb-8">
                                <p class="text-gray-700 text-base">{{ $board->text }}</p>
                            </div>
                            <div class="flex items-center">
                                <div class="text-sm">
                                    <span class="text-gray-900 leading-none">{{ $board->name }}</span>
                                    <span class="text-gray-600 text-xs"> ❤ {!! mb_substr($board->date, 0, 10) !!}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
                <p class="font-nanum-pen text-3xl text-center p-2">하나 남겨주시겠어요?</p>
                <form class="w-full">
                    <div class="flex flex-wrap">
                        <div class="w-full">
                            <input class="appearance-none block w-full bg-white text-gray-700 border border-gray-400 rounded py-3 px-4 mb-3 leading-tight" id="" type="text" name="name" placeholder="이름">
                        </div>
                        <div class="w-full">
                            <textarea class="resize-none border rounded w-full bg-white text-gray-700 border border-gray-400 rounded py-3 px-4 mb-3 leading-tight" id="" type="text" name="text" placeholder="메세지를 입력해주세요"></textarea>
                        </div>
                    </div>
                    <button type="button" id="writeButton" class="w-full bg-yellow-400 hover:bg-blue-700 text-black text-center py-2 px-4 rounded">
                        입력하기
                    </button>
                </form>
            </div>
        </div>
    </div>

    <div id="gallery" class="pswp" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="pswp__bg"></div>
        <div class="pswp__scroll-wrap">
            <div class="pswp__container">
                <div class="pswp__item"></div>
                <div class="pswp__item"></div>
                <div class="pswp__item"></div>
            </div>
            <div class="pswp__ui pswp__ui--hidden">
                <div class="pswp__top-bar">
                    <div class="pswp__counter"></div>
                    <button class="pswp__button pswp__button--close" title="Close (Esc)"></button>
                    <button class="pswp__button pswp__button--share" title="Share"></button>
                    <button class="pswp__button pswp__button--fs" title="Toggle fullscreen"></button>
                    <button class="pswp__button pswp__button--zoom" title="Zoom in/out"></button>
                    <div class="pswp__preloader">
                        <div class="pswp__preloader__icn">
                            <div class="pswp__preloader__cut">
                                <div class="pswp__preloader__donut"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- <div class="pswp__loading-indicator"><div class="pswp__loading-indicator__line"></div></div> -->
                <div class="pswp__share-modal pswp__share-modal--hidden pswp__single-tap">
                    <div class="pswp__share-tooltip">
                        <!-- <a href="#" class="pswp__share--facebook"></a>
                        <a href="#" class="pswp__share--twitter"></a>
                        <a href="#" class="pswp__share--pinterest"></a>
                        <a href="#" download class="pswp__share--download"></a> -->
                    </div>
                </div>
                <button class="pswp__button pswp__button--arrow--left" title="Previous (arrow left)"></button>
                <button class="pswp__button pswp__button--arrow--right" title="Next (arrow right)"></button>
                <div class="pswp__caption">
                    <div class="pswp__caption__center">
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop

@section('script')
    <script>
        (function() {
            var httpRequest;
            document.getElementById("writeButton").addEventListener('click', write);

            function write(e) {
                let url = '/api/wedding/wirte';
                let name = document.querySelector('input[name="name"]').value;
                let text = document.querySelector('textarea[name="text"]').value;

                fetch(
                    url, {
                        headers: {
                            "Content-Type": "application/json",
                            "Accept": "application/json, text-plain, */*",
                            "X-Requested-With": "XMLHttpRequest"
                        },
                        method: 'post',
                        body: JSON.stringify({
                            "_token": "{{ csrf_token() }}",
                            "name": name,
                            "text": text
                        })
                    })
                    .then(response => response.json())
                    .then(data => {
                        console.log(data);
                        console.log(data.name);

                        // let div = document.createElement("div").innerHTML = data.html;
                        // document.getElementById('board-list').appendChild(div);

                        if (data.result) {
                            document.getElementById('board-list').innerHTML += data.html;
                        }
                    })
                    .catch(function (error) {
                        console.log(error);
                    });
            }
        })();
    </script>
    <script>
        (function () {

            var initPhotoSwipeFromDOM = function (gallerySelector) {

                var parseThumbnailElements = function (el) {
                    var thumbElements = el.childNodes,
                        numNodes = thumbElements.length,
                        items = [],
                        el,
                        childElements,
                        thumbnailEl,
                        size,
                        item;

                    for (var i = 0; i < numNodes; i++) {
                        el = thumbElements[i];

                        // include only element nodes
                        if (el.nodeType !== 1) {
                            continue;
                        }

                        childElements = el.children;

                        size = el.getAttribute('data-size').split('x');

                        // create slide object
                        item = {
                            src: el.getAttribute('href'),
                            w: parseInt(size[0], 10),
                            h: parseInt(size[1], 10),
                            author: el.getAttribute('data-author')
                        };

                        item.el = el; // save link to element for getThumbBoundsFn

                        if (childElements.length > 0) {
                            item.msrc = childElements[0].getAttribute('src'); // thumbnail url
                            if (childElements.length > 1) {
                                item.title = childElements[1].innerHTML; // caption (contents of figure)
                            }
                        }


                        var mediumSrc = el.getAttribute('data-med');
                        if (mediumSrc) {
                            size = el.getAttribute('data-med-size').split('x');
                            // "medium-sized" image
                            item.m = {
                                src: mediumSrc,
                                w: parseInt(size[0], 10),
                                h: parseInt(size[1], 10)
                            };
                        }
                        // original image
                        item.o = {
                            src: item.src,
                            w: item.w,
                            h: item.h
                        };

                        items.push(item);
                    }

                    return items;
                };

                // find nearest parent element
                var closest = function closest(el, fn) {
                    return el && (fn(el) ? el : closest(el.parentNode, fn));
                };

                var onThumbnailsClick = function (e) {
                    e = e || window.event;
                    e.preventDefault ? e.preventDefault() : e.returnValue = false;

                    var eTarget = e.target || e.srcElement;

                    var clickedListItem = closest(eTarget, function (el) {
                        return el.tagName === 'A';
                    });

                    if (!clickedListItem) {
                        return;
                    }

                    var clickedGallery = clickedListItem.parentNode;

                    var childNodes = clickedListItem.parentNode.childNodes,
                        numChildNodes = childNodes.length,
                        nodeIndex = 0,
                        index;

                    for (var i = 0; i < numChildNodes; i++) {
                        if (childNodes[i].nodeType !== 1) {
                            continue;
                        }

                        if (childNodes[i] === clickedListItem) {
                            index = nodeIndex;
                            break;
                        }
                        nodeIndex++;
                    }

                    if (index >= 0) {
                        openPhotoSwipe(index, clickedGallery);
                    }
                    return false;
                };

                var photoswipeParseHash = function () {
                    var hash = window.location.hash.substring(1),
                        params = {};

                    if (hash.length < 5) { // pid=1
                        return params;
                    }

                    var vars = hash.split('&');
                    for (var i = 0; i < vars.length; i++) {
                        if (!vars[i]) {
                            continue;
                        }
                        var pair = vars[i].split('=');
                        if (pair.length < 2) {
                            continue;
                        }
                        params[pair[0]] = pair[1];
                    }

                    if (params.gid) {
                        params.gid = parseInt(params.gid, 10);
                    }

                    return params;
                };

                var openPhotoSwipe = function (index, galleryElement, disableAnimation, fromURL) {
                    var pswpElement = document.querySelectorAll('.pswp')[0],
                        gallery,
                        options,
                        items;

                    items = parseThumbnailElements(galleryElement);

                    // define options (if needed)
                    options = {

                        galleryUID: galleryElement.getAttribute('data-pswp-uid'),

                        getThumbBoundsFn: function (index) {
                            // See Options->getThumbBoundsFn section of docs for more info
                            var thumbnail = items[index].el.children[0],
                                pageYScroll = window.pageYOffset || document.documentElement.scrollTop,
                                rect = thumbnail.getBoundingClientRect();

                            return {x: rect.left, y: rect.top + pageYScroll, w: rect.width};
                        },

                        addCaptionHTMLFn: function (item, captionEl, isFake) {
                            if (!item.title) {
                                captionEl.children[0].innerText = '';
                                return false;
                            }
                            captionEl.children[0].innerHTML = item.title + '<br/><small>Photo: ' + item.author + '</small>';
                            return true;
                        },

                    };


                    if (fromURL) {
                        if (options.galleryPIDs) {
                            // parse real index when custom PIDs are used
                            // https://photoswipe.com/documentation/faq.html#custom-pid-in-url
                            for (var j = 0; j < items.length; j++) {
                                if (items[j].pid == index) {
                                    options.index = j;
                                    break;
                                }
                            }
                        } else {
                            options.index = parseInt(index, 10) - 1;
                        }
                    } else {
                        options.index = parseInt(index, 10);
                    }

                    // exit if index not found
                    if (isNaN(options.index)) {
                        return;
                    }


                    var radios = document.getElementsByName('gallery-style');
                    for (var i = 0, length = radios.length; i < length; i++) {
                        if (radios[i].checked) {
                            if (radios[i].id == 'radio-all-controls') {

                            } else if (radios[i].id == 'radio-minimal-black') {
                                options.mainClass = 'pswp--minimal--dark';
                                options.barsSize = {top: 0, bottom: 0};
                                options.captionEl = false;
                                options.fullscreenEl = false;
                                options.shareEl = false;
                                options.bgOpacity = 0.85;
                                options.tapToClose = true;
                                options.tapToToggleControls = false;
                            }
                            break;
                        }
                    }

                    if (disableAnimation) {
                        options.showAnimationDuration = 0;
                    }

                    // Pass data to PhotoSwipe and initialize it
                    gallery = new PhotoSwipe(pswpElement, PhotoSwipeUI_Default, items, options);

                    // see: http://photoswipe.com/documentation/responsive-images.html
                    var realViewportWidth,
                        useLargeImages = false,
                        firstResize = true,
                        imageSrcWillChange;

                    gallery.listen('beforeResize', function () {

                        var dpiRatio = window.devicePixelRatio ? window.devicePixelRatio : 1;
                        dpiRatio = Math.min(dpiRatio, 2.5);
                        realViewportWidth = gallery.viewportSize.x * dpiRatio;


                        if (realViewportWidth >= 1200 || (!gallery.likelyTouchDevice && realViewportWidth > 800) || screen.width > 1200) {
                            if (!useLargeImages) {
                                useLargeImages = true;
                                imageSrcWillChange = true;
                            }

                        } else {
                            if (useLargeImages) {
                                useLargeImages = false;
                                imageSrcWillChange = true;
                            }
                        }

                        if (imageSrcWillChange && !firstResize) {
                            gallery.invalidateCurrItems();
                        }

                        if (firstResize) {
                            firstResize = false;
                        }

                        imageSrcWillChange = false;

                    });

                    gallery.listen('gettingData', function (index, item) {
                        if (useLargeImages) {
                            item.src = item.o.src;
                            item.w = item.o.w;
                            item.h = item.o.h;
                        } else {
                            item.src = item.m.src;
                            item.w = item.m.w;
                            item.h = item.m.h;
                        }
                    });

                    gallery.init();
                };

                // select all gallery elements
                var galleryElements = document.querySelectorAll(gallerySelector);
                for (var i = 0, l = galleryElements.length; i < l; i++) {
                    galleryElements[i].setAttribute('data-pswp-uid', i + 1);
                    galleryElements[i].onclick = onThumbnailsClick;
                }

                // Parse URL and open gallery if it contains #&pid=3&gid=1
                var hashData = photoswipeParseHash();
                if (hashData.pid && hashData.gid) {
                    openPhotoSwipe(hashData.pid, galleryElements[hashData.gid - 1], true, true);
                }
            };

            initPhotoSwipeFromDOM('.demo-gallery');

        })();
    </script>
    <script>
        var container = document.getElementById('map'); //지도를 담을 영역의 DOM 레퍼런스
        var options = { //지도를 생성할 때 필요한 기본 옵션
            center: new kakao.maps.LatLng(37.56099, 126.96813), //지도의 중심좌표.
            level: 3 //지도의 레벨(확대, 축소 정도)
        };

        var map = new kakao.maps.Map(container, options); //지도 생성 및 객체 리턴

        // 마우스 휠과 모바일 터치를 이용한 지도 확대, 축소를 막는다
        map.setZoomable(false);
    </script>
@stop