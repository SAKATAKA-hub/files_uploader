@extends('layouts.admin_base')


<!----- title ----->
@section('title','管理者情報編集')


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

        <h2>管理者情報編集</h2>

    </div>
</section>




<section>
    <div class="section_container">
        <div class=" container-900">

            <div class="card">

                <h5 class="card-header">
                    管理者情報
                </h5>
                <form method="post" action="{{ route('admin.register_update') }}" class="needs-validation" novalidate>
                    @csrf
                    @method('PATCH')
                    <input type="hidden" name="user_id" value="{{$edit_admin->user->id}}">
                    <input type="hidden" name="admin_id" value="{{$edit_admin->id}}">
                    <div class="card-body row g-3">

                        <div class="col-12">
                            <label for="username" class="form-label fw-bold">
                                名前
                                <small class="text-danger ms-3">※必須</small>
                            </label>
                            <input type="text" name="name" class="form-control" id="username"
                                value="{{old('name', $edit_admin->name)}}" placeholder="名前" required>
                            <p style="height:1em;color:red;">
                                {{$errors->has('name')? $errors->first('name'): ''}}
                            </p>
                        </div>

                        <div class="col-12">
                            <label for="email" class="form-label fw-bold">
                                メールアドレス
                                <small class="text-danger ms-3">※必須</small>
                            </label>
                            <input type="email" name="email" class="form-control" id="email"
                                value="{{old('email', $edit_admin->email)}}" placeholder="メールアドレス" required>
                            <p style="height:1em;color:red;">
                                {{$errors->has('email')? $errors->first('email'): ''}}
                            </p>
                        </div>


                        <div class="col-12 mt-5">
                            <button class="btn btn-primary text-white btn-lg" type="submit">更新</button>
                        </div>


                    </div>
                </form>


            </div>

        </div>
    </div>
</section>


<section>
    <div class="section_container">
        <div class=" container-900 mb-5">

            <div class="card">
                <h5 class="card-header">
                    パスワード変更
                </h5>

                <form method="post" action="{{ route('admin.register_update') }}" class="needs-validation" novalidate>
                    @csrf
                    @method('PATCH')
                    <input type="hidden" name="user_id" value="{{$edit_admin->user->id}}">
                    <div class="card-body row g-3">


                        <div class="col-12">
                            <label for="address" class="form-label fw-bold">
                                パスワード
                                <small class="text-danger ms-3">※必須</small>
                            </label>
                            <input type="password" name="password" class="form-control" id="address"
                                value="{{old('password')}}" placeholder="8文字以上、半角英数字のみ" required>
                            <p style="height:1em;color:red;">
                                {{$errors->has('password')? $errors->first('password'): ''}}
                            </p>
                        </div>

                        <div class="col-12">
                            <label for="address" class="form-label fw-bold">
                                パスワード(確認用)
                                <small class="text-danger ms-3">※必須</small>
                            </label>
                            <input type="password" name="password_confirmation" class="form-control" id="address"
                                value="" placeholder="8文字以上、半角英数字のみ" required>
                            <p style="height:1em;color:red;">
                                {{$errors->has('conf_password')? $errors->first('conf_password'): ''}}
                            </p>
                        </div>



                        <div class="col-12 mt-5">
                            <button class="btn btn-primary text-white btn-lg" type="submit">更新</button>
                        </div>


                    </div>
                </form>


            </div>

        </div>
    </div>
</section>

<section>
    <div class="section_container">
        <div class=" container-900 mb-5">

            <div class="card">
                <h5 class="card-header">
                    その他設定変更
                </h5>

                <form method="post" action="{{ route('admin.register_update') }}" class="needs-validation" novalidate>
                    @csrf
                    @method('PATCH')
                    <input type="hidden" name="admin_id" value="{{$edit_admin->id}}">
                    <input type="hidden" name="form-switch" value="その他設定変更フォーム">
                    <div class="card-body row g-3">


                        <!-- メール連絡受取り設定 -->
                        <div class="col-12">
                            <label class="form-check-label fw-bold" for="get_mail">メール連絡受取り設定</label>

                            <div class="d-flex align-items-end mb-3">
                                <div style="width:7rem;">受け取らない</div>
                                <div class="form-check form-switch ms-3">
                                    <input class="form-check-input fs-3" type="checkbox" name="get_mail" id="get_mail"
                                    {{ $edit_admin->get_mail ? 'checked' : ''}}
                                    >
                                </div>
                                <div class="">受け取る</div>
                            </div>
                        </div>


                        <!-- 管理者修正権限(※自分以外の管理権限者のみ修正可) -->
                        <div class="col-12">
                            <label class="form-check-label" for="master">
                                <span class="fw-bold">管理者修正権限</span>
                                <span class="ms-2">※自分以外の管理権限者のみ修正可</span>
                            </label>

                            <div class="d-flex align-items-end mb-3">
                                <div style="width:7rem;">なし</div>
                                <div class="form-check form-switch ms-3">
                                    <input class="form-check-input fs-3" type="checkbox" name="master" id="master"
                                    {{ $edit_admin->master ? 'checked' : '' }}
                                    {{ ( !$admin->master or $admin->id===$edit_admin->id ) ? 'disabled' : '' }}
                                    >
                                </div>
                                <div class="">あり</div>
                            </div>

                            <!-- 管理者修正権限が修正可のとき、) -->
                            @if (!$admin->master or $admin->id===$edit_admin->id)
                                <input type="hidden" name="master" value="on">
                            @endif
                        </div>


                        <div class="col-12 mt-5">
                            <button class="btn btn-primary text-white btn-lg" type="submit">更新</button>
                        </div>


                    </div>
                </form>

            </div>

        </div>
    </div>
</section>


@endsection
