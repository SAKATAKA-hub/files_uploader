<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @yield('meta')


    <title>{{$dir_company->name}}</title>


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

    @yield('style')

</head>
<body class="bg-white">
    <header class="bg-light border-bottom">
        <nav class="navbar navbar-expand navbar-light mx-auto" style="max-width:1200px;">
            <div class="container-fluid">

                <!--- サイトロゴ -->
                <div class="navbar-brand">
                    <h1 class="m-0 h-100 fs-6">
                        <a href="https://next-arrow.co.jp/" class="d-flex align-items-center" style="text-decoration:none;">
                            <img src="{{asset('storage/site/image/header_rogo.png')}}" alt="サイトロゴ" style="max-height:1.6rem; ">
                            {{-- <strong class="text-dark ms-2"> {{ env('APP_NAME') }}</strong> --}}
                        </a>
                    </h1>
                </div>

            </div>
        </nav>
    </header>
    <main >

        <!-- 見出しタイトル -->
        <section class="pt-3">
            <div class="container-1200 pb-0">

                <h2 class="fs-5 text-secondary fw-bold">{{$dir_company->name}}</h2>

            </div>
        </section>


        <!-- contents -->
        <section class="pt-3">
            <div class="container-1200 pb-0">
                <div id="app">


                    <!-- テーブル -->
                    <div class="card border-bottom-0 overflow-auto">
                        <table class="table mb-0" style="font-size:11px;">
                            <thead>
                                <tr>
                                    @php $colspan = 6; @endphp
                                    <th scope="col" >ファイル名</th>
                                    <th scope="col" style="width:8rem;">更新日時</th>
                                    <th scope="col" style="width:8rem;">ファイルサイズ</th>
                                </tr>
                            </thead>
                            <tbody class="border-top ">

                                @forelse ($dir_company->files as $file)
                                    @php
                                        /* ルートパラメーター */
                                        $route_params =  ['file'=>$file,'auth_key'=>$file->auth_key];
                                    @endphp
                                    <tr>
                                        <td>
                                            <a href="{{route('dir_company.file.show', $route_params )}}" class="btn text-truncate text-primary  p-0" style="font-size:11px;"
                                            data-bs-toggle="tooltip" data-bs-placement="bottom" title="ファイルをブラウザで表示"
                                            >
                                                <i class="bi bi-file-earmark"></i>
                                                {{$file->name}}
                                            </a>
                                        </td>

                                        <!-- 更新日 -->
                                        <td>{{ \Carbon\Carbon::parse($file->updated_at)->format('Y.m.d') }}</td>

                                        <!-- ファイルサイズ -->
                                        <td>{{$file->size_text}}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="{{$colspan}}">
                                            <div class="py-3">※ファイルは保存されていません。</div>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>


                </div>
            </div>
        </section>



        <!-- フェードインアラート -->
        @php $session_alerts = [ 'alert-primary','alert-success','alert-info','alert-warning','alert-danger' ]; @endphp
        @foreach ($session_alerts as $alert_name)

            @if ( session( $alert_name ) )
                <div class="fadein-alert-box">
                    <div class="container-1200">
                        <p class="alert {{ $alert_name }} alert-dismissible fade show" role="alert">
                            {{ session( $alert_name ) }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </p>
                    </div>
                </div>
            @endif

        @endforeach



    </main>
    <footer class="bg-dark p-3 text-center text-white">

        <p class="m-0 ">&copy; Next Arrow Inc. All Rights Reserved.</p>

    </footer>


    <!-- bootstrap JavaScript -->
    @yield('script')
    <script src="{{ asset('js/app.js') }}" defer></script>

</body>
</html>
