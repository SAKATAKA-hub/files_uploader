@extends('layouts.admin_base')


<!----- title ----->
@section('title','ホーム')


<!----- breadcrumb ----->
@section('breadcrumb')
<nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{route('home')}}">
            <i class="bi bi-house-door-fill"></i> Home
        </a></li>
    </ol>
</nav>
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

@endsection
