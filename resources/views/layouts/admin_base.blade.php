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

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.0/font/bootstrap-icons.css">
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
    <header>
        {{-- <nav class=" container-1200 navbar navbar-expand-lg"> --}}
        <nav class="navbar navbar-expand navbar-light mx-auto" style="max-width:1200px;">

            <div class="container-fluid">


                <!--- サイトロゴ -->
                <div class="navbar-brand">
                    <h1 class="m-0 d-flex align-items-center">
                        {{-- <img src="{{asset('storage/site/image/header_rogo.png')}}" alt="サイトロゴ" class="" style="max-height:2rem;"> --}}
                        <a href="{{route('admin.home')}}" class="navbar-brand text-dark">
                            <span class=" fs-2 fw-bold">{{ env('APP_NAME') }}</span>
                            <span class="fw-bold" style="font-size:1rem;">管理者ページ</span>
                        </a>

                    </h1>
                </div>


                <!--- ハンバーガーメニュー -->
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    {{-- <span class="navbar-toggler-icon"></span> --}}
                    <i class="bi bi-list fw-bold fs-2"></i>
                </button>

            </div>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav justify-content-center">
                    {{-- <li class="nav-item">
                        <a class="nav-link text-secondary" href="{{ route('admin.survey_form_list') }}">アンケート</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-secondary" href="{{ route('admin.schedule_request.format_list') }}">日程予約</a>
                    </li> --}}
                    {{-- <li class="nav-item">
                        <a class="nav-link text-secondary" href="{{route('admin.register_list')}}">管理者一覧</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-secondary" href="{{route('admin.login_record_list')}}">ログイン履歴</a>
                    </li> --}}


                    <li class="nav-item d-flex ms-md-5">


                        <!-- user menu -->
                        <div class="dropdown">
                            <a class="nav-link dropdown-toggle text-secondary" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">

                                <strong>{{$admin->name}}</strong>さんがログイン中

                            </a>

                            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">

                                @if (Auth::check())


                                    <li>
                                        <a class="dropdown-item" href="{{ route('admin.register_edit', $admin->id) }}">アカウント情報変更</a>
                                    </li>

                                    <li>
                                        <a class="dropdown-item" href="{{ route('admin.register_edit', $admin->id) }}">パスワード変更</a>
                                    </li>


                                    <li><hr class="dropdown-divider"></li>


                                    <li>
                                        <a class="dropdown-item" href="{{route('admin.register_list')}}">管理者一覧</a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item" href="{{route('admin.login_record_list')}}">ログイン履歴</a>
                                    </li>

                                    <li><hr class="dropdown-divider"></li>

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

        @yield('contents')

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
