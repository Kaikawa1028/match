@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-7 col-md-3">
            <div class="card mb-4">
                <img class="card-img-top" src="{{ $result['user_profile']->img_url ?? 'https://matching-kou.s3.ap-northeast-1.amazonaws.com/3/TW2fauu9FNUFIYorYS8zqcSee1w2V6HPR36uJKOj.png' }}"  alt="写真なし"></img>
                <div class="card-body">
                    <h4 class="card-title">
                        ユーザ名
                    </h4>
                    <p class="h5"><strong>@if ($result['user_profile'] === null) @else {{ $result['user_profile']->user_name }} @endif</strong></p>
                </div>
            </div>
            <div class="w-100 text-center mb-4">
                <a href="{{ route('mypage.edit') }}"><button type="button" class="btn btn-default">ユーザ情報編集</button></a>
            </div>
        </div>
        <div class="col-md-7">
            <table class="table mb-5">
                <thead>
                    <tr>
                        <th scope="col">登録情報</th>
                        <th scope="col"></th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <th scope="row">メールアドレス</th>
                        <td>{{ $user->email }}</td>
                    </tr>
                    <tr>
                        <th scope="row">氏名</th>
                        <td>{{ $user->name }}</td>
                    </tr>
                </tbody>
            </table>
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
                        <td>@if ($user->sex == 1) 男 @else 女 @endif</td>
                    </tr>
                    <tr>
                        <th scope="row">年齢</th>
                        <td>@if ($result['user_profile'] === null) @else {{ $result['user_profile']->age }} @endif</td>
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
                        <td>@if ($result['user_profile'] === null) @else {{ $result['user_profile']->text }}@endif</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection