<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@200;600&display=swap" rel="stylesheet">

        <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Nunito', sans-serif;
                font-weight: 200;
                height: 100vh;
                margin: 0;
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .content {
                text-align: center;
            }

            .title {
                font-size: 84px;
            }

            .links > a {
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase
            }

            .m-b-md {
                margin-bottom: 30px;
            }
        </style>
        <link rel="stylesheet" href="{{ asset('css/welcome.css') }}">
    </head>
    <body>
        


            <div class="content">
                <div class="main-container">
                    <h1>世界とつながろう</h1>
                    <h2>あなたの想いを<br>まだ会ったことのない<br>だれかに。</h2>
                </div>
                @if (Route::has('login'))
                <div class="top-right links">
                    @auth
                        <a href="{{ url('/timeline') }}" class="left-btn">timeline</a>
                        <a class="dropdown-item right-btn" href="{{ route('logout') }}"
                            onclick="event.preventDefault();
                                document.getElementById('logout-form').submit();">
                            {{ __('Logout') }}
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    @else
                        <a href="{{ route('login') }}" class="left-btn">Login</a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="right-btn">Register</a>
                        @endif
                    @endauth
                </div>
                @endif
            </div>
    </body>
</html>
