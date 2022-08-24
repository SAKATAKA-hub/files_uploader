<!DOCTYPE html>
<html lang="ja">
<head>


    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @yield('meta')


    <title>管理者ログイン</title>


    <!-- ファビコン画像の読み込み -->
    <link rel="shortcut icon" href="{{asset('storage/site/image/favicon.png')}}">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/index.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.0/font/bootstrap-icons.css">


    <style>
    </style>


</head>
<body>
    <header class="container-600">
        <nav class=" container-1200 navbar navbar-expand-lg">
            <div class="container-fluid">


                <!--- サイトロゴ -->
                <div class="navbar-brand">

                    <h1 class="m-0 d-flex align-items-center">
                        <a href="{{route('admin.home')}}" class="navbar-brand text-dark">
                            <span class=" fs-2 fw-bold">{{ env('APP_NAME') }}</span>
                            <span class="fw-bold" style="font-size:1rem;">管理者ページ</span>
                        </a>
                    </h1>

                </div>

            </div>
        </nav>
    </header>
    <main class="container-600">

        <div class="card">
            <h5 class="card-header bg-primary text-white">{{ __('ログイン') }}</h5>

            <div class="card-body">
                <form method="POST" action="{{ route('admin_auth.login') }}">
                    @csrf

                    @if (session('login_error'))
                    <div class="text-danger mb-3 text-center">※{{ session('login_error') }}</div>
                    @endif

                    <div class="row mb-3">
                        <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('メールアドレス') }}</label>

                        <div class="col-md-6">
                            <input id="email" type="email" class="form-control " name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('パスワード') }}</label>

                        <div class="col-md-6">
                            <input id="password" type="password" class="form-control " name="password" required autocomplete="current-password">
                        </div>
                    </div>

                    <div class="row mb-0">
                        <div class="col-md-8 offset-md-4">
                            <button type="submit" class="btn btn-primary text-white">
                                {{ __('ログイン') }}
                            </button>

                        </div>
                    </div>

                </form>
            </div>
        </div>


    </main>
    <footer class="container-600">
        <p class="m-0 ">&copy; Next Arrow Inc. All Rights Reserved.</p>
    </footer>


    <!-- JavaScript -->
    <script src="{{ asset('js/app.js') }}" defer></script>


</body>
</html>
