@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <form class="border border-light p-5" action="{{ route('mypage.store') }}" method="POST">

                @csrf
                <p class="h4 text-center  mb-4">ユーザー情報確認</p>

                <table class="table mb-5">
                    <thead>
                        <tr>
                            <th scope="col">プロフィール情報</th>
                            <th scope="col"></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <th scope="row">ユーザ名</th>
                            <td>{{ $result['user_name'] }}</td>
                        </tr>
                        <tr>
                            <th scope="row">年齢</th>
                            <td>{{ $result['age'] }}</td>
                        </tr>
                        <tr>
                            <th scope="row">居住地</th>
                            <td>{{ $result['residence'] }}</td>
                        </tr>
                        <tr>
                            <th scope="row">職業</th>
                            <td>{{ $result['job'] }}</td>
                        </tr>
                        <tr>
                            <th scope="row">写真</th>
                            <td><img src="{{ $result['img_data'] }}"/ style="width:200px"></td>
                        </tr>
                        <tr>
                            <th scope="row">自己紹介文</th>
                            <td>{{ $result['text'] }}</td>
                        </tr>
                    </tbody>
                </table>

                <input type="hidden" id="user_name" name="user_name" value="{{ $result['user_name'] }}" class="form-control">
                <input type="hidden" id="age" name="age" value="{{ $result['age'] }}" class="form-control">
                <input type="hidden" id="residence" name="residence" value="{{ $result['residence'] }}" class="form-control">
                <input type="hidden" id="job" name="job" value="{{ $result['job'] }}" class="form-control">
                <input type="hidden" id="img_data" name="img_data" value="{{ $result['img_data'] }}" class="form-control">
                <input type="hidden" id="text" name="text" value="{{ $result['text'] }}" class="form-control">

                <button class="btn btn-info my-4 btn-block" type="submit">ユーザ情報変更確認画面へ</button>

            </form>
        </div>
    </div>
</div>
@endsection