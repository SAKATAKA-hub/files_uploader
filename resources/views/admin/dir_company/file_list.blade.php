@extends('layouts.admin_base')


<!----- title ----->
@section('title', '企業フォルダ一覧 ＞ '.$dir_company->name )

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


        <!-- アップロードボタン -->
        <div class="mb-3">
            <button class="btn bg-gradient-red text-white btn-sm" type="button" data-bs-toggle="offcanvas"
            data-bs-target="#offcanvasTop" aria-controls="offcanvasTop">
                <i class="bi bi-arrow-bar-up"></i>
                アップロード
            </button>

            <a href="{{route('admin.dir_company.list')}}" class="btn btn-sm btn-link">フォルダ一覧</a>
        </div>

        <form action="{{route('admin.dir_company.file.upload')}}" method="post" class="mb-3" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="dir_company_id" value="{{$dir_company->id}}">

            <div class="offcanvas offcanvas-top" tabindex="-1" id="offcanvasTop"
            aria-labelledby="offcanvasTopLabel">
                <div class="offcanvas-header">
                    <h5 class="offcanvas-title" id="offcanvasBottomLabel">ファイルのアップロード</h5>
                    <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                </div>

                <div class="offcanvas-body small">
                    <div class="mb-3">
                        <input class="form-control" type="file" name="upload_file" id="formFile" required>
                    </div>
                    <button class="btn btn-primary btn-sm border-light border-0" type="submit">アップロード</button>
                    {{-- <button class="btn btn-primary btn-sm border-light border-0" type="submit" disabled>送信中</button> --}}
                </div>
            </div>
        </form>


        <!-- テーブル -->
        <div class="card border-bottom-0 overflow-auto">
            <table class="table mb-0" style="font-size:11px; min-width:1000px;">
                <thead>
                    <tr>
                        @php $colspan = 6; @endphp
                        <th scope="col" >ファイル名</th>
                        <th >URL</th>
                        {{-- <th >ダウンロードURL</th> --}}
                        <th scope="col" style="width:8rem;">更新日時</th>
                        <th scope="col" style="width:8rem;">ファイルサイズ</th>
                        <th></th><!-- 削除ボタン -->
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
                                <a href="{{route('admin.dir_company.file.show', $route_params )}}" class="btn text-truncate text-primary p-0" style="font-size:11px;"
                                data-bs-toggle="tooltip" data-bs-placement="bottom" title="ファイルをブラウザで表示"
                                >
                                    <i class="bi bi-file-earmark"></i>
                                    {{$file->name}}
                                </a>
                            </td>
                            <td>
                                <!-- コピーボタン -->
                                <url-copy-component copy_url="{{route('admin.dir_company.file.show', $route_params )}}"/>
                            </td>
                            {{-- <td>
                                <!-- コピーボタン -->
                                <url-copy-component copy_url="{{route('admin.dir_company.file.download',$route_params)}}"/>
                            </td> --}}

                            <!-- 更新日 -->
                            <td>{{ \Carbon\Carbon::parse($file->updated_at)->format('Y.m.d') }}</td>

                            <!-- ファイルサイズ -->
                            <td>{{$file->size_text}}</td>

                            <td><!-- 削除ボタン -->
                                <!-- Button trigger modal -->
                                <button type="button" class="btn btn-sm border text-danger"
                                data-bs-toggle="modal" data-bs-target="#{{'deleteModal'.$file->id}}">
                                    削除
                                </button>
                                <!-- Modal -->
                                <div class="modal fade" id="{{'deleteModal'.$file->id}}" tabindex="-1" aria-labelledby="{{'deleteModal'.$file->id}}Label" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title text-danger" id="{{'deleteModal'.$file->id}}Label">ファイルの削除</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body" style="font-size:1rem;">
                                                <strong>”{{$file->name}}”</strong>を削除します。<br>本当によろしいですか？
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">戻る</button>
                                                <form action="{{route('admin.dir_company.file.destory')}}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <input type="hidden" name="file_id" value="{{$file->id}}">
                                                    <button type="submit" class="btn btn-danger">削除</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </td>
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
</section>
@endsection



