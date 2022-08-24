@extends('layouts.admin_base')


<!----- title ----->
@section('title','ログイン履歴')


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

        <h2>ログイン履歴</h2>

    </div>
</section>


<!-- [ 顧客リスト ] -->
<section>
    <div class="container-1200">





        <div class="card w-100 ">
            <ul class="list-group">
                @foreach ($login_records as $record)
                    <li class="list-group-item">
                        {{ \Carbon\Carbon::parse($record->created_at )->format("Y年m月d日　H時i分s秒") }}に
                        <strong class="ms-3">{{$record->user->name }}</strong>さんがログインしました。
                    </li>
                @endforeach
            </ul>
        </div>


    </div>
</section>
<!--end 顧客リスト-->



@endsection
