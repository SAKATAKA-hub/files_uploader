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

        <div class="card border-bottom-0 overflow-auto">

            <table class="table mb-0" style="font-size:11px; min-width:1000px;">
                <thead>
                    <tr>
                        <th scope="col">企業フォルダ名</th>
                        <th scope="col"></th>
                    </tr>
                </thead>
                <tbody class="border-top ">

                    @forelse ($dir_companys as $dir_company)
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
                    @empty
                    <tr></tr>
                    @endforelse


                </tbody>
            </table>
        </div>

    </div>
</section>
@endsection



