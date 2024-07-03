<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Why Fight?｜タイトル</title>
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
            flex-direction: column;
            cursor: pointer;
            font-family: 'Press Start 2P', cursive;
        }

        @keyframes blink {
            0% {
                opacity: 1;
            }

            50% {
                opacity: 0;
            }

            100% {
                opacity: 1;
            }
        }

        @keyframes zoomIn {
            0% {
                transform: scale(0);
            }

            100% {
                transform: scale(1);
            }
        }

        @keyframes cursorBlink {
            0% {
                opacity: 1;
            }

            50% {
                opacity: 0;
            }

            100% {
                opacity: 1;
            }
        }

        .start-message {
            color: white;
            font-size: 24px;
            animation: blink 1s infinite;
        }

        .start-message span {
            display: inline-block;
        }

        .start-message .narrow-space {
            margin-left: -0.5em;
        }

        .hidden {
            display: none;
        }

        .zoom-in {
            animation: zoomIn 2s ease-in-out forwards;
        }

        img {
            width: 80px;
            height: auto;
        }

        .logo {
            display: none;
            width: 720px;
            margin-bottom: 60px;
        }

        .copyright {
            display: none;
            width: 240px;
            margin-top: 20px;
        }

        .menu {
            display: none;
            margin-top: 20px;
            text-align: left;
            border: 2px solid white;
            border-radius: 15px;
            padding: 20px;
            width: 200px;
        }

        .title-cursor {
            display: flex;
            align-items: center;
            margin: 10px 0;
            cursor: pointer;
            width: 40px;
        }

        .title-cursor img {
            height: 36px;
            width: auto;
        }

        .cursor {
            visibility: hidden;
            height: 36px;
            width: auto;
            margin-right: 10px;
        }

        .title-cursor:hover .cursor {
            visibility: visible;
            animation: cursorBlink 1s infinite;
        }
    </style>
</head>

<body>

    <div id="start-message" class="start-message" data-sound-hover="{{ asset('sounds/hover.mp3') }}"
        data-sound-click="{{ asset('sounds/click.mp3') }}">
        <span>PRESS</span>
        <span class="narrow-space">START.</span>
    </div>
    <img id="image" src="{{ asset('images/g.png') }}" alt="" class="hidden">
    <img id="logo" src="{{ asset('images/logo.png') }}" alt="ロゴ" class="logo hidden">

    <div id="menu" class="menu">
        <a href="{{ route('login') }}" class="title-cursor" data-sound-hover="{{ asset('sounds/hover.mp3') }}"
            data-sound-click="{{ asset('sounds/click.mp3') }}">
            <img src="{{ asset('images/text-cursor.png') }}" alt="カーソル" class="cursor">
            <img src="{{ asset('images/text-login.png') }}" alt="ログインする">
        </a>
        <a href="{{ route('register') }}" class="title-cursor" data-sound-hover="{{ asset('sounds/hover.mp3') }}"
            data-sound-click="{{ asset('sounds/click.mp3') }}">
            <img src="{{ asset('images/text-cursor.png') }}" alt="カーソル" class="cursor">
            <img src="{{ asset('images/text-signup.png') }}" alt="とうろくする">
        </a>
    </div>

    <img id="copyright" src="{{ asset('images/copyright.png') }}" alt="著作権" class="copyright hidden">

    <audio id="splash-audio" src="{{ asset('sounds/splash.mp3') }}" preload="auto"></audio>
    <audio id="title-bgm" src="{{ asset('sounds/title-bgm.mp3') }}" preload="auto" loop></audio>

    <script>
        let hasClicked = false;

        function playAudio(src, volume = 0.6) {
            return new Promise((resolve) => {
                const audio = new Audio(src);
                audio.volume = volume;
                audio.play();
                audio.onended = resolve;
            });
        }

        document.getElementById('start-message').addEventListener('mouseover', function () {
            playAudio(this.getAttribute('data-sound-hover'), 0.4);
        });

        document.getElementById('start-message').addEventListener('click', async function () {
            await playAudio(this.getAttribute('data-sound-click'), 0.6);

            if (!hasClicked) {
                const splashAudio = document.getElementById('splash-audio');
                const titleBgmAudio = document.getElementById('title-bgm');
                const image = document.getElementById('image');
                const startMessage = document.getElementById('start-message');
                const logo = document.getElementById('logo');
                const menu = document.getElementById('menu');
                const copyright = document.getElementById('copyright');

                splashAudio.currentTime = 0;
                splashAudio.volume = 0.2;
                splashAudio.play();

                splashAudio.addEventListener('ended', function () {
                    titleBgmAudio.volume = 0.8;
                    titleBgmAudio.play();
                });

                image.classList.remove('hidden');
                image.classList.add('zoom-in');
                startMessage.classList.add('hidden');

                image.addEventListener('animationend', function () {
                    setTimeout(function () {
                        image.style.display = 'none';
                        logo.style.display = 'block';
                        menu.style.display = 'block';
                        copyright.style.display = 'block';
                    }, 1500);
                });

                hasClicked = true;
            }
        });

        document.querySelectorAll('.title-cursor').forEach(item => {
            item.addEventListener('mouseover', function () {
                playAudio(this.getAttribute('data-sound-hover'), 0.4);
            });

            item.addEventListener('click', async function (event) {
                event.preventDefault();
                await playAudio(this.getAttribute('data-sound-click'), 0.6);

                window.location.href = this.getAttribute('href');
            });
        });
    </script>

</body>

</html>