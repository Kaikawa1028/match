@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <form class="border border-light p-5" action="{{ route('mypage.confirm') }}" method="POST"  enctype="multipart/form-data">

                @csrf
                <p class="h4 text-center  mb-4">ユーザー情報編集</p>

                <div class="form-group">
                    <label for="user_name">ユーザー名</label>
                    <input type="text" id="user_name" name="user_name" class="form-control">
                </div>

                <div class="form-group">
                    <label for="age">年齢</label>
                    <div class="w-25">
                        <select id="age" name="age" class="form-control">
                            <option value="25">25歳</option>
                            <option value="26">26歳</option>
                        </select> 
                    </div>
                </div>

                <div class="form-group">
                    <label for="residence">居住地</label>
                    <div class="w-25">
                        <select id="residence" name="residence" class="form-control">
                            <option value="東京都">東京都</option>
                            <option value="静岡県">静岡県</option>
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <label for="job">職業</label>
                    <input type="text" id="job" name="job" class="form-control">
                </div>

                <div class="form-group">
                    <label for="img_url">写真</label>
                    <input type="file" id="img_url" name="img_url" class="form-control-file">
                </div>

                <div class="form-group">
                    <label for="text">自己紹介文</label>
                    <textarea id="text" name="text" class="form-control"></textarea>
                </div>  

                <button class="btn btn-default my-4 btn-block" type="submit">ユーザ情報変更確認画面へ</button>

            </form>
        </div>
    </div>
</div>
@endsection