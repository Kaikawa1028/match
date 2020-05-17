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
                    <span class="badge badge-primary">必須</span>
                    <input type="text" id="user_name" name="user_name" class="form-control @error('user_name') is-invalid @enderror" value="{{ old('user_name') ?? $user_profile->user_name ?? '' }}">
                    @error('user_name')
                        <span class="invalid-feedback">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                    
                </div>

                <div class="form-group">
                    <label for="age">年齢</label>
                    <span class="badge badge-primary">必須</span>
                    <div class="w-25">
                        <select id="age" name="age" class="form-control @error('age') is-invalid @enderror">
                            <option value="25" @if(old("age")) @if(old("age") == 25) selected @else @endif @else @if(!is_null($user_profile) && $user_profile->age == "25") selected @else   @endif @endif>25歳</option>
                            <option value="26" @if(old("age")) @if(old("age") == 26) selected @else @endif @else @if(!is_null($user_profile) && $user_profile->age == "26") selected @else   @endif @endif>26歳</option>
                        </select> 
                    </div>
                </div>

                <div class="form-group">
                    <label for="residence">居住地</label>
                    <span class="badge badge-primary">必須</span>
                    <div class="w-25">
                        <select id="residence" name="residence" class="form-control">
                            <option value="東京都" >東京都</option>
                            <option value="静岡県" >静岡県</option>
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <label for="job">職業</label>
                    <span class="badge badge-primary">必須</span>
                    <input type="text" id="job" name="job" class="form-control @error('job') is-invalid @enderror" value="{{ old('job') ?? $user_profile->job ?? '' }}">
                    @error('job')
                        <span class="invalid-feedback">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="img_url">写真</label>
                    <vue-cropper-component></vue-cropper-component>
                </div>

                <div class="form-group">
                    <label for="text">自己紹介文</label>
                    <span class="badge badge-primary">必須</span>
                    <textarea id="text" name="text" class="form-control @error('text') is-invalid @enderror" placeholder="最低5文字以上、最高1000文字まで">{{ old('text') ?? $user_profile->text ?? '' }}</textarea>
                    @error('text')
                        <span class="invalid-feedback">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>  

                <button class="btn btn-default my-4 btn-block" type="submit">ユーザ情報変更確認画面へ</button>

            </form>
        </div>
    </div>
</div>
@endsection