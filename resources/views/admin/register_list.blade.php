@extends('layouts.admin_base')


<!----- title ----->
@section('title','管理者一覧')


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


<section class="bg-light">
    <div class="container-1200">

        <h2>管理者一覧</h2>

    </div>
</section>


<!-- [ 管理者リスト ] -->
<section>
    <div class="container-1200">


        <!-- 管理者登録(管理者編集権限者のみ) -->
        @if ( $admin->master )
        <div>
            <a href="{{ route('admin.register_input') }}" class="btn btn-primary text-white mb-3">
                <i class="bi bi-person-plus me-2"></i>管理者登録
            </a>
        </div>
        @endif

        <div class="card w-100 border-bottom-0 overflow-auto">
            <table class="table table-striped mb-0" style="min-width: 900px">
                <thead>
                    <tr>
                    <th scope="col">名前</th>
                    <th scope="col">メールアドレス</th>
                    <th scope="col">メール受取設定</th>
                    <th scope="col">管理者修正権限</th>
                    @if ($admin->master)<th scope="col"></th>@endif<!-- 修正 -->
                    @if ($admin->master)<th scope="col"></th>@endif<!-- 削除 -->
                    </tr>
                </thead>
                <tbody>
                    @foreach ($admin_menbers as $admin_menber)
                    <tr>
                        <th scope="row">{{ $admin_menber->name }}</th>
                        <td>{{ $admin_menber->email }}</td>
                        <td>{{ $admin_menber->get_mail ? '受取り' : '---' }}</td>
                        <td>{{ $admin_menber->master ? 'あり' : '---' }}</td>

                        <td><!-- 修正 -->
                            @if ($admin->master)
                                <a href="{{ route('admin.register_edit', $admin_menber->id) }}">編集</a>
                            @endif
                        </td>
                        <td><!-- 削除 -->
                            @if ($admin->master)
                                @if ( $admin->id !== $admin_menber->id )

                                    <a href="#" data-bs-toggle="modal" data-bs-target="#deleteModal{{$admin_menber->id}}">
                                        削除
                                    </a>

                                    <!-- Modal -->
                                    <div class="modal fade" id="deleteModal{{$admin_menber->id}}" tabindex="-1" aria-labelledby="deleteModal{{$admin_menber->id}}Label" aria-hidden="true">
                                        <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                            <h5 class="modal-title" id="deleteModal{{$admin_menber->id}}Label">
                                                {{ $admin_menber->name }}さんを削除します。<br>よろしいですか？
                                            </h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                                    閉じる
                                                </button>

                                                <form action="{{ route( 'admin.register_destroy' ) }}" method="POST">
                                                    @method('DELETE')
                                                    @csrf
                                                    <input type="hidden" name="user_id" value="{{$admin_menber->user->id}}">
                                                    <button type="submit" class="btn btn-danger">削除</button>
                                                </form>
                                            </div>
                                        </div>
                                        </div>
                                    </div>
                                    <!-- end Modal -->

                                @endif
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>


    </div>
</section>
<!--end 管理者リスト-->



@endsection
