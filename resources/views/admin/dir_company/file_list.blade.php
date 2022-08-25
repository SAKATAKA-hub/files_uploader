@extends('layouts.admin_base')


<!----- title ----->
@section('title', $dir_company->name.'　ファイル一覧' )

<!----- breadcrumb ----->
@section('breadcrumb')
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
    <div class="container-1200 mb-5">

        <div class="card border-bottom-0 overflow-auto">

            <table class="table mb-0" style="font-size:11px; min-width:1000px;">
                <thead>
                    <tr>
                        <th scope="col">企業フォルダ名</th>
                        <th scope="col"></th>
                    </tr>
                </thead>
                <tbody class="border-top ">

                    @foreach ($dir_companys as $dir_company)
                    <tr>
                        <td>
                            <a href="" class="btn p-0" style="font-size:11px;"
                            data-bs-toggle="tooltip" data-bs-placement="bottom" title="ファイルをブラウザで表示"
                            >
                                <i class="bi bi-folder-fill text-warning"></i>
                                {{$dir_company->name}}
                                {{'（'.$dir_company->files->count().'）'}}
                            </a>
                        </td>
                        <td class="text-end">
                            <a href="{{ route('admin.dir_company.file.list',$dir_company) }}" class="ms-3">保存ファイル一覧</a>
                            <a href="" class="ms-3">企業情報の修正</a>
                            <a href="" class="ms-3">削除</a>
                        </td>
                    </tr>
                    @endforeach


                </tbody>
            </table>
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

                    @forelse ($dir_company->files as $file)
                        <tr>
                            <td>
                                <a href="{{route('admin.dir_company.file.show',$file)}}" class="btn p-0" style="font-size:11px;"
                                data-bs-toggle="tooltip" data-bs-placement="bottom" title="ファイルをブラウザで表示"
                                >
                                    <i class="bi bi-file-earmark"></i>
                                    {{$file->name}}
                                </a>
                            </td>
                            <td>
                                <!-- コピーボタン -->
                                <div class="input-group border" style=" border-radius:5px;">
                                    <input type="text" class="form-control border-0" style="font-size:11px;"
                                    value="{{route('admin.dir_company.file.show',$file)}}"  disabled >

                                    <button class="btn btn-sm border-0" type="button" style="font-size:11px;"
                                    data-bs-toggle="tooltip" data-bs-placement="bottom" title="URLのコピー"
                                    ><i class="bi bi-files"></i></button>
                                </div>
                            </td>
                            <td>
                                <!-- コピーボタン -->
                                <div class="input-group border" style=" border-radius:5px;">
                                    <input type="text" class="form-control border-0" style="font-size:11px;"
                                    value="{{route('admin.dir_company.file.download',$file)}}"  disabled >

                                    <button class="btn btn-sm border-0" type="button" style="font-size:11px;"
                                    data-bs-toggle="tooltip" data-bs-placement="bottom" title="URLのコピー"
                                    ><i class="bi bi-files"></i></button>
                                </div>
                            </td>

                            <td>2022.00.00</td>
                            <td>50Mb</td>
                        </tr>
                    @empty
                        <tr></tr>
                    @endforelse
                </tbody>
            </table>
        </div>



    </div>
</section>
@endsection



