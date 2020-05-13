<!doctype html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title></title>

    <link rel="stylesheet" href="{{ mix('css/main.css') }}">
    <style>
        @import url(https://fonts.googleapis.com/css?family=Noto+Serif+KR);

        * {
            -webkit-box-sizing: border-box;
            -moz-box-sizing: border-box;
            box-sizing: border-box;
        }
        body {
            padding: 10px;
        }
        textarea {
            font: 20px 'Noto Serif KR', serif;
            line-height: 1.5;
            border: 0;
            border-radius: 3px;
            background: linear-gradient(#F9EFAF, #F7E98D);
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            transition: box-shadow 0.5s ease;
            max-width: 520px;
            height: 500px;
            padding: 20px;
        }
        textarea:hover { box-shadow:0 5px 8px rgba(0,0,0,0.15); }
        textarea:focus { box-shadow:0 5px 12px rgba(0,0,0,0.2); outline:none; }
        button {
            font: 20px 'Noto Serif KR', serif;
        }

        input[type="radio"]:checked + label span {
            background-color: #3490DC; //bg-blue
            box-shadow: 0px 0px 0px 2px white inset;
        }
        input[type="radio"]:checked + label{
            color: #3490DC; //text-blue
        }
    </style>
</head>
<body>
<div>
    <div>
        <h2 class="m-4">남기고 싶은 글이 있다면 적어보세요.</h2>
        <div class="max-w-sm flex flex-wrap">
            <input id="radio1" type="radio" name="radio" class="hidden" value="park" checked />
            <label for="radio1" class="flex items-center cursor-pointer mr-2">
                <span class="w-4 h-4 inline-block mr-1 rounded-full border border-grey"></span>
                박철진 목사님
            </label>
            <input id="radio2" type="radio" name="radio" class="hidden" value="lee" />
            <label for="radio2" class="flex items-center cursor-pointer mr-2">
                <span class="w-4 h-4 inline-block mr-1 rounded-full border border-grey"></span>
                이경진 목사님
            </label>
            <input id="radio3" type="radio" name="radio" class="hidden" value="jo" />
            <label for="radio3" class="flex items-center cursor-pointer">
                <span class="w-4 h-4 inline-block mr-1 rounded-full border border-grey"></span>
                조승민 목사님
            </label>
        </div>
        <textarea class="w-full mt-4" name="text"></textarea><br /><br />
        <button id="write" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">남기기</button>
    </div>
</div>
<script>
    (function() {
        document.getElementById("write").addEventListener('click', write);

        function write(e) {
            let url = '/api/rollingpaper/wirte';
            let radio = document.querySelector('input[name=radio]:checked').value;
            let text = document.querySelector('textarea[name="text"]').value;

            if (text.trim() === '') {
                return false;
            }

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
                        "receiver": radio,
                        "text": text
                    })
                })
                .then(response => response.json())
                .then(data => {
                    console.log(data);

                    document.querySelector('textarea[name="text"]').value = '';

                    alert('감사합니다');
                })
                .catch(function (error) {
                    console.log(error);
                });
        }
    })();
</script>
</body>
</html>