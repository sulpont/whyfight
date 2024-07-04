<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Why Fight?｜プロローグ</title>
    <link href="https://fonts.googleapis.com/css2?family=Press+Start+2P&display=swap" rel="stylesheet">
    <style>
        body {
            background-color: black;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            overflow: hidden;
            font-family: 'Press Start 2P', cursive;
        }

        .prologue-image {
            height: 48px; /* 高さを48pxに揃える */
            opacity: 0;
            position: absolute;
            transition: opacity 1s ease-in-out; /* フェードインのためのトランジション */
        }

        .prologue-image.show {
            opacity: 1;
        }
    </style>
</head>

<body>
    <img src="{{ asset('images/prologue-1.png') }}" alt="プロローグ1" class="prologue-image" id="prologue-1">
    <img src="{{ asset('images/prologue-2.png') }}" alt="プロローグ2" class="prologue-image" id="prologue-2">
    <img src="{{ asset('images/prologue-3.png') }}" alt="プロローグ3" class="prologue-image" id="prologue-3">
    <img src="{{ asset('images/prologue-4.png') }}" alt="プロローグ4" class="prologue-image" id="prologue-4">
    <img src="{{ asset('images/prologue-5.png') }}" alt="プロローグ5" class="prologue-image" id="prologue-5">

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const images = document.querySelectorAll('.prologue-image');
            let currentImageIndex = 0;

            function showNextImage() {
                if (currentImageIndex < images.length) {
                    if (currentImageIndex > 0) {
                        images[currentImageIndex - 1].classList.remove('show');
                    }
                    images[currentImageIndex].classList.add('show');

                    currentImageIndex++;
                } else {
                    // 最後の画像が表示されてから3秒後にリダイレクト
                    setTimeout(function () {
                        window.location.href = 'https://jitsunarii.github.io/whyfight/';
                    }, 3000);
                }
            }

            setTimeout(showNextImage, 100); // 最初の画像のフェードインを少し遅延させる
            setInterval(showNextImage, 5000); // 5秒ごとに画像を切り替え
        });
    </script>
</body>

</html>

