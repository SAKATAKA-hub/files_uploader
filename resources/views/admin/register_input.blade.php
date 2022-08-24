@extends('layouts.admin_base')


<!----- title ----->
@section('title','管理者登録')


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

        <h2>管理者登録</h2>

    </div>
</section>


<section>
    <div class="container-1200">
        <div class="container-900">
            <div class="card">


                <h5 class="card-header">
                    登録項目を入力してください
                </h5>

                <form method="post" action="{{ route('admin.register_post') }}" class="needs-validation" novalidate>
                    @csrf
                    <div class="card-body row g-3">

                        <div class="col-12">
                            <label for="username" class="form-label fw-bold">
                                名前
                                <small class="text-danger ms-3">※必須</small>
                            </label>
                            <input type="text" name="name" class="form-control" id="username"
                                value="{{old('name')}}" placeholder="名前" required>
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
                                value="{{old('email')}}" placeholder="メールアドレス">
                            <p style="height:1em;color:red;">
                                {{$errors->has('email')? $errors->first('email'): ''}}
                            </p>
                        </div>

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
                            <button class="w-100 btn btn-primary text-white btn-lg" type="submit">新規登録</button>
                        </div>


                    </div>
                </form>


            </div>
        </div>
    </div>
</section>


@endsection
