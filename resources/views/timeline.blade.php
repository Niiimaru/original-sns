<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Twitter</title>

    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    {{-- Font Awesome 読み込み --}}
    <link href="https://use.fontawesome.com/releases/v5.6.1/css/all.css" rel="stylesheet">

    <!--asset 関数は public 配下のものを呼び出す-->
    <link rel="stylesheet" href="{{ asset('css/timeline.css') }}">
    <script src="{{ asset('js/app.js') }}" ></script>
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    <!--config('','') は .env の APP_NAME を指す-->
                    {{ config('app.name', 'Twitter') }}
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>
    </div>

    <div class="wrapper">
        <form action="/timeline" method="POST">
            @csrf
            <div class="post-box">
                <input type="text" name="tweet" placeholder="今何してる？">
                <button type="submit" class="submit">ツイート</button>
            </div>
        </form>

        <div class="tweet-wrapper">
            <!--多数のデータを一覧表示するためにforeach文を使う-->
            @foreach ($tweets as $tweet)
                <div class="tweet-box">

                    <!--<div>{{ $tweet->user->name }}</div>   user テーブル内のname カラムを引っ張り出した。画面には誰が投稿したのかユーザー名が表示された。-->
                    <!--{{ asset('') }} は public配下を示す。-->
                    <!--a タグで画像にリンクを持たしてあげることで、画像をクリックしたときにプロフィール欄へ移動できる。-->
                    <a href="{{ route('show', [$tweet->user->id]) }}"><img src="{{ asset('storage/images/'. $tweet->user->avatar) }}" alt=""></a>
                    
                    <div>{{ $tweet->tweet }}</div>
                    <div class="destroy-btn">
                        <!--tweet の user_id とログインしている user の id が一致した場合のみ削除ボタン表示-->
                        @if ($tweet->user_id === Auth::user()->id)
                            <!--どのツイートを消去するのかを指すのが[$tweet->id]-->
                            <form action="{{ route('destroy', [$tweet->id]) }}" method="POST">
                                @csrf
                                <input type="submit" value="削除">
                            </form>
                        @endif
                    </div>
                    
                    <div style="padding: 10px 40px">
                        <!--likeBy method に対して count で数を数えて０以上、すなわちユーザー
                            がすでに言い値をしていた場合はいいね取り消しボタンを表示.
                            そうでなければいいねボタンを表示する。-->
                        @if ($tweet->likedBy(Auth::user())->count() > 0)
                            {{-- <a data-remote="true" rel="nofollow" data-method="DELETE" href="/like/{{ $tweet->likedBy(Auth::user())->firstOrfail()->id }}"> --}}
                            <a href="/likes/{{ $tweet->likedBy(Auth::user())->firstOrfail()->id }}"><i class="fas fa-heart"></i></a>
                            @else
                            {{-- <a data-remote="true" rel="nofollow" data-method="POST" href="/tweets/{{ $tweet->id }}/likes"> --}}
                            <a href="/tweets/{{ $tweet->id }}/likes"><i class="far fa-heart"></i></a>
                        @endif
                        {{-- いいねの数を表示 --}}
                        {{ $tweet->likes->count() }}
                    </div>
                </div>
            @endforeach
            <!--ページネーションの記述 app.css app.js を読み込む必要がある。-->
            {{ $tweets->links() }}
        </div>
    </div>
</body>
</html>