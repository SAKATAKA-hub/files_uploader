@extends('layouts.admin_base')


<!----- title ----->
@section('title', '企業フォルダ一覧' )

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
<section class="">
    <div class="container-1200 mb-5">


        <!-- フォルダの追加ボタン -->
        <div class="mb-3">
            <button class="btn bg-gradient-red text-white btn-sm" type="button"
            data-bs-toggle="offcanvas" data-bs-target="#createOffcanvasTop" aria-controls="createOffcanvasTop"
            >
                <i class="bi bi-plus-lg"></i>
                追加
            </button>
        </div>

        <!-- 追加ボタンOffcanvas -->
        <form action="{{route('admin.dir_company.post')}}" method="post" class="mb-3" >
            @csrf
            <div class="offcanvas offcanvas-top" tabindex="-1" id="createOffcanvasTop"
            aria-labelledby="createOffcanvasTopLabel" style="min-height:300px">
                <div class="offcanvas-header">
                    <h5 class="offcanvas-title" id="createOffcanvasTopLabel">企業フォルダの追加</h5>
                    <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                </div>
                <div class="offcanvas-body small">

                    <div class="mb-3">
                        <label for="name" class="form-label">フォルダ名</label>
                        <input type="text" class="form-control" name="name" id="name" placeholder="株式会社山田商事" required>
                    </div>

                    {{-- <submit-button-component
                        style_class="btn btn-primary btn-sm"
                        text="企業フォルダの追加"
                    /> --}}

                    <button class="btn btn-primary btn-sm border-light border-0" type="submit">企業フォルダの追加</button>
                    {{-- <button class="btn btn-primary btn-sm border-light border-0" type="submit" disabled>送信中</button> --}}

                </div>
            </div>
        </form>



        <!-- テーブル -->
        <div class="card border-bottom-0 overflow-auto">
            <table class="table mb-0" style="font-size:11px;  min-width:1000px;">
                <thead>
                    <tr>
                        @php $colspan = 2; @endphp
                        <th scope="col">企業フォルダ名</th>
                        <th >お客様用URL</th>
                        <th scope="col"></th>
                    </tr>
                </thead>
                <tbody class="border-top ">

                    @forelse ($dir_companys as $dir_company)
                    @php
                        /* ルートパラメーター */
                        $route_params =  ['dir_company'=>$dir_company,'auth_key'=>$dir_company->auth_key];
                    @endphp

                    <tr>
                        <td>
                            <a href="{{ route('admin.dir_company.file.list',$route_params) }}"
                            class="btn  text-truncate text-primary p-0" style="font-size:11px;"
                            data-bs-toggle="tooltip" data-bs-placement="bottom" title="フォルダ内のファイルを表示"
                            >
                                <i class="bi bi-folder-fill text-warning"></i>
                                {{$dir_company->name}}
                                {{'（'.$dir_company->files->count().'）'}}
                            </a>

                        </td>
                        <td>
                            <!-- コピーボタン -->
                            <url-copy-component copy_url="{{ route('admin.dir_company.file.list',$route_params) }}"/>
                        </td>
                        <td class="" style="width:20rem;">
                            <div class="w-100 d-flex">

                                <!-- お客様用ボタン -->
                                <a href="{{ route('dir_company.file.list',$route_params) }}"
                                class="btn btn-sm border ms-3"
                                >お客様用ページ確認</a>


                                <!-- 追加ボタンOffcanvas -->
                                <a href="" class="btn btn-sm border ms-3"
                                data-bs-toggle="offcanvas" data-bs-target="#updateOffcanvasTop{{$dir_company->id}}" aria-controls="updateOffcanvasTop{{$dir_company->id}}"
                                >更新</a>

                                <form action="{{route('admin.dir_company.update')}}" method="post" class="mb-3" >
                                    @csrf
                                    @method('PATCH')
                                    <input type="hidden" name="dir_company_id" value="{{$dir_company->id}}">
                                    <div class="offcanvas offcanvas-top" tabindex="-1" id="updateOffcanvasTop{{$dir_company->id}}"
                                    aria-labelledby="updateOffcanvasTop{{$dir_company->id}}Label" style="min-height:300px">
                                        <div class="offcanvas-header">
                                            <h5 class="offcanvas-title" id="updateOffcanvasTop{{$dir_company->id}}Label">企業フォルダ情報の更新</h5>
                                            <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                                        </div>
                                        <div class="offcanvas-body small">

                                            <div class="mb-3">
                                                <label for="name" class="form-label">フォルダ名</label>
                                                <input type="text" class="form-control" name="name" id="name" value="{{$dir_company->name}}"
                                                placeholder="株式会社山田商事">
                                            </div>


                                            <button class="btn btn-primary btn-sm border-light border-0" type="submit">更新</button>
                                            {{-- <button class="btn btn-primary btn-sm border-light border-0" type="submit" disabled>送信中</button> --}}

                                        </div>
                                    </div>
                                </form>



                                <!-- 削除ボタンModal -->
                                <a href="" class="btn btn-sm border ms-3 text-danger"
                                data-bs-toggle="modal" data-bs-target="#{{'deleteModal'.$dir_company->id}}"
                                >削除</a>

                                <div class="modal fade" id="{{'deleteModal'.$dir_company->id}}" tabindex="-1" aria-labelledby="{{'deleteModal'.$dir_company->id}}Label" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title text-danger" id="{{'deleteModal'.$dir_company->id}}Label">フォルダの削除</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body" style="font-size:1rem;">
                                                <strong>”{{$dir_company->name}}”</strong>を削除します。<br>本当によろしいですか？
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">戻る</button>
                                                <form action="{{route('admin.dir_company.destory')}}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <input type="hidden" name="dir_company_id" value="{{$dir_company->id}}">
                                                    <button type="submit" class="btn btn-danger">削除</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>


                            </div>



                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="{{$colspan}}">
                            <div class="py-3">※フォルダはありません。</div>
                        </td>
                    </tr>
                    @endforelse


                </tbody>
            </table>
        </div>


    </div>
</section>
@endsection



