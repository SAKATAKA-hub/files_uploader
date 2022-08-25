@extends('layouts.base')


<!----- title ----->
@section('title', '株式会社○×商事' )

<!----- breadcrumb ----->
@section('breadcrumb')
{{-- <li class="breadcrumb-item"><a href="{{route('mypage')}}" class="text-primary">
    マイページ
</a></li>
<li class="breadcrumb-item" aria-current="page">
    {{ 'HOME' }}
</li> --}}
@endsection


<!----- meta ----->
@section('meta')
@endsection


<!----- style ----->
@section('style')
@endsection


<!----- script ----->
@section('script')
@endsection


<!----- contents ----->
@section('contents')
    {{-- <section class="">
        <div class="container-1200 my-5">


            <div class="row">

                @for ($i = 0; $i < 12; $i++)
                <a href="" class="col-6 col-sm-4 col-md-2 mb-3 text-center btn"  style="font-size:11px;">

                    <div class="d-flex justify-content-center align-items-center ">
                        <div class="fs-1 card card-body">
                            <i class="bi bi-file-earmark"></i>
                        </div>
                    </div>
                    <div class="">ファイル名</div>
                    <div class="">ファイルサイズ</div>
                </a>
                @endfor

            </div>



        </div>
    </section> --}}
    <section class="">
        <div class="container-1200 mb-5">


            <div class="card border-bottom-0 overflow-auto">

                <table class="table mb-0" style="font-size:11px; min-width:1000px;">
                    <thead>
                        <tr>
                            <th scope="col" >ファイル名</th>
                            <th >プレビューURL</th>
                            <th >ダウンロードURL</th>
                            <th scope="col" style="width:8rem;">更新日時</th>
                            <th scope="col" style="width:8rem;">ファイルサイズ</th>
                        </tr>
                    </thead>
                    <tbody class="border-top ">
                        @for ($i = 0; $i < 10; $i++)
                        <tr>
                            <td>
                                <a href="" class="btn p-0" style="font-size:11px;"
                                data-bs-toggle="tooltip" data-bs-placement="bottom" title="ファイルをブラウザで表示"
                                >
                                    <i class="bi bi-file-earmark"></i>
                                    ファイル名
                                </a>
                            </td>
                            <td>
                                <!-- コピーボタン -->
                                <div class="input-group border" style=" border-radius:5px;">
                                    <input type="text" class="form-control border-0" value="https://admin.heteml.jp/top/"  disabled style="font-size:11px;">
                                    <button class="btn btn-sm border-0" type="button" style="font-size:11px;"
                                    data-bs-toggle="tooltip" data-bs-placement="bottom" title="URLのコピー"
                                    ><i class="bi bi-files"></i></button>
                                </div>
                            </td>
                            <td>
                                <!-- コピーボタン -->
                                <div class="input-group border" style=" border-radius:5px;">
                                    <input type="text" class="form-control border-0" value="https://admin.heteml.jp/top/"  disabled style="font-size:11px;">
                                    <button class="btn btn-sm border-0" type="button" style="font-size:11px;"
                                    data-bs-toggle="tooltip" data-bs-placement="bottom" title="URLのコピー"
                                    ><i class="bi bi-files"></i></button>
                                </div>
                            </td>

                            <td>2022.00.00</td>
                            <td>50Mb</td>
                        </tr>
                        @endfor
                    </tbody>
                </table>
            </div>



        </div>
    </section>
@endsection


