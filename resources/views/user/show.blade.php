@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-7 col-md-3">
            <div class="card mb-4">
                <img class="card-img-top" src="{{ $result['user_profile']->img_url ?? config('view.default_img') }}"  alt="写真なし"></img>
                <div class="card-body">
                    <h3 class="card-title">
                        @if ($result['user_profile'] === null) @else {{ $result['user_profile']->user_name }} @endif
                    </h3>
                    @if($user->role == 5)
                        <span class="badge badge-pill badge-warning">有料会員</span>
                    @elseif($user->role == 10)
                        <span class="badge badge-pill badge-info">無料会員</span>
                    @endif
                </div>
            </div>
            <like-component endpoint=@if($result['like']->status == "") {{ route('like.send', ['user' => $user->id]) }} @else {{ route('room.message', ['room' => $result['like']->room_id]) }} @endif 
                            initial-like-status={{ Auth::user()->getLikeStatus($user) }} >
            </like-component>
        </div>
        <div class="col-md-7">
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">基本情報</th>
                        <th scope="col"></th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <th scope="row">性別</th>
                        <td>@if ($result['user_profile'] === null) @else @if ($user->sex == 1) 男 @else 女 @endif @endif</td>
                    </tr>
                    <tr>
                        <th scope="row">年齢</th>
                        <td>@if ($result['user_profile'] === null) @else {{ $result['user_profile']->age }} @endif</td>
                    </tr>
                    <tr>
                        <th scope="row">身長</th>
                        <td>@if ($result['user_profile'] === null) @else {{ $result['user_profile']->height }} @endif</td>
                    </tr>
                    <tr>
                        <th scope="row">居住地</th>
                        <td>@if ($result['user_profile'] === null) @else {{ $result['user_profile']->residence }}@endif</td>
                    </tr>
                    <tr>
                        <th scope="row">職業</th>
                        <td>@if ($result['user_profile'] === null) @else {{ $result['user_profile']->job }}@endif</td>
                    </tr>
                    <tr>
                        <th scope="row">自己紹介</th>
                        <td>@if ($result['user_profile'] === null) @else {!! nl2br(e($result['user_profile']->text )) !!}@endif</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection