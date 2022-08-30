<!DOCTYPE html>
<html lang="ja">
<head>


    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @yield('meta')


    <title>@yield('title')</title>



    <!-- ファビコン画像の読み込み -->
    <link rel="shortcut icon" href="{{asset('storage/site/image/favicon.png')}}">
    <!-- bootstrap アイコン -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.0/font/bootstrap-icons.css">
    <!-- bootstrap CSS -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <!-- avant-ui CSS -->
    <link href="{{ asset('avant-ui/css/avantui.css') }}" rel="stylesheet">
    <!-- 基本 CSS -->
    <link href="{{ asset('css/index.css') }}" rel="stylesheet">

    <style>
        main{
            margin-top: 0px;
            min-height: 100vh;
        }

    </style>
    @yield('style')
</head>
<body>
    <header class="bg-gradient-red border-bottom">
        <nav class="navbar navbar-expand navbar-light mx-auto" style="max-width:1200px;">

            <div class="container-fluid">


                <!--- サイトロゴ -->
                <div class="navbar-brand">
                    <h1 class="m-0 h-100 fs-6">
                        <a href="{{route('admin.home')}}" class="d-flex flex-column" style="text-decoration:none;">
                            <div class="text-center">
                                <img src="{{asset('storage/site/image/header_rogo.png')}}" alt="サイトロゴ" class="" style="max-height:1rem; ">
                            </div>
                            <div class="text-white ms-2">{{ env('APP_NAME') }}　管理者画面</div>
                        </a>
                    </h1>

                </div>


                <!--- ハンバーガーメニュー -->
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    {{-- <span class="navbar-toggler-icon"></span> --}}
                    <i class="bi bi-list fw-bold fs-2"></i>
                </button>

            </div>
            <div class="" id="navbarNav">
                <ul class="navbar-nav justify-content-center p-0 m-0">
                    <li class="nav-item d-flex ms-md-5">
                        <!-- user menu -->
                        <div class="dropdown">
                            <a class="nav-link dropdown-toggle text-white" href="#" id="navbarDropdown" style="font-size:11px;"
                             role="button" data-bs-toggle="dropdown" aria-expanded="false">

                                <strong>{{$admin->name}}</strong>さんがログイン中

                            </a>

                            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                @if (Auth::check())
                                    <li>
                                        <a href="{{ route('admin.register_edit',$admin->id) }}" class="dropdown-item">管理者情報編集</a>
                                    </li>
                                    <li>
                                        <form method="POST" action="{{route('admin_auth.logout')}}" lass="dropdown-item">
                                            @csrf
                                            <button class="dropdown-item"><i class="bi bi-box-arrow-right"></i> ログアウト</button>
                                        </form>
                                    </li>
                                @endif

                            </ul>
                        </div><!--end user menu -->


                    </li>
                </ul>
            </div>

        </nav>
    </header>
    <main>
        <!-- 見出しタイトル -->
        <section class="pt-3">
            <div class="container-1200 pb-0">

                <h2 class="fs-5 text-secondary fw-bold">@yield('title')</h2>

            </div>
        </section>




        <!-- 登録完了アラート -->
        @php $alerts = ['alert-success','alert-danger',] @endphp
        @foreach ($alerts as $alert)
            @if ( session($alert) )
                <div class="alert {{$alert}} alert-dismissible fade show mb-5" role="alert">
                    <div class="container-1200">
                        {{session($alert)}}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                </div>
            @endif
        @endforeach




        <!-- contents -->
        <div id="app">
            @yield('contents')
        </div>




    </main>
    <footer>
        <section class="bg-dark">
            <div class="section_container text-white text-center" style="font-size:.8rem;">
                <p class="d-inline-block m-0">Copyright &copy; Next Arrow Inc.</p>
                <p class="d-inline-block m-0">All Rights Reserved.</p>
            </div>
        </section>
    </footer>


    <!-- JavaScript -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    @yield('script')

</body>
</html>
