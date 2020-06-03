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
                    <input type="text" id="user_name" name="user_name" class="form-control @error('user_name') is-invalid @enderror" value="{{ old('user_name') ?? $result['user_profile']->user_name ?? '' }}">
                    @error('user_name')
                        <span class="invalid-feedback">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                    
                </div>

                <div class="form-group">
                    <label for="age">年齢</label>
                    <span class="badge badge-primary">必須</span>
                    <div class="w-50">
                        <select id="age" name="age" class="form-control @error('age') is-invalid @enderror">
                            @for($i=18; $i<=40; $i++)
                            <option value="{{$i}}" @if(old("age")) @if(old("age") == $i) selected @else @endif @else @if(!is_null($result['user_profile']) && $result['user_profile']->age == $i) selected @else   @endif @endif>{{$i}}歳</option>
                            @endfor
                        </select> 
                    </div>
                </div>

                <div class="form-group">
                    <label for="height">身長</label>
                    <span class="badge badge-primary">必須</span>
                    <div class="w-50">
                        <select id="height" name="height" class="form-control @error('height') is-invalid @enderror">
                            @for($i=140; $i <= 190; $i++)
                            <option value="{{$i}}" @if(old("height")) @if(old("height") == $i) selected @else @endif @else @if(!is_null($result['user_profile']) && $result['user_profile']->height == $i) selected @else   @endif @endif>{{$i}}cm</option>
                            @endfor
                        </select> 
                    </div>
                </div>

                <div class="form-group">
                    <label for="residence">居住地</label>
                    <span class="badge badge-primary">必須</span>
                    <div class="w-50">
                        <select id="residence" name="residence" class="form-control">
                        ['東京都', '大阪府', '静岡県', '福岡県', '神奈川県', '沖縄県', '北海道', '香川県'];
                            <option value="東京都" @if(old("residence")) @if(old("residence") == "東京都") selected @else @endif @else @if(!is_null($result['user_profile']) && $result['user_profile']->residence == "東京都") selected @else   @endif @endif>東京都</option>
                            <option value="静岡県" @if(old("residence")) @if(old("residence") == "静岡県") selected @else @endif @else @if(!is_null($result['user_profile']) && $result['user_profile']->residence == "静岡県") selected @else   @endif @endif>静岡県</option>
                            <option value="大阪府" @if(old("residence")) @if(old("residence") == "大阪府") selected @else @endif @else @if(!is_null($result['user_profile']) && $result['user_profile']->residence == "大阪府") selected @else   @endif @endif>大阪府</option>
                            <option value="福岡県" @if(old("residence")) @if(old("residence") == "福岡県") selected @else @endif @else @if(!is_null($result['user_profile']) && $result['user_profile']->residence == "福岡県") selected @else   @endif @endif>福岡県</option>
                            <option value="神奈川県" @if(old("residence")) @if(old("residence") == "神奈川県") selected @else @endif @else @if(!is_null($result['user_profile']) && $result['user_profile']->residence == "神奈川県") selected @else   @endif @endif>神奈川県</option>
                            <option value="沖縄県" @if(old("residence")) @if(old("residence") == "沖縄県") selected @else @endif @else @if(!is_null($result['user_profile']) && $result['user_profile']->residence == "沖縄県") selected @else   @endif @endif>沖縄県</option>
                            <option value="北海道" @if(old("residence")) @if(old("residence") == "北海道") selected @else @endif @else @if(!is_null($result['user_profile']) && $result['user_profile']->residence == "北海道") selected @else   @endif @endif>北海道</option>
                            <option value="香川県" @if(old("residence")) @if(old("residence") == "香川県") selected @else @endif @else @if(!is_null($result['user_profile']) && $result['user_profile']->residence == "香川県") selected @else   @endif @endif>香川県</option>
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <label for="job">職業</label>
                    <span class="badge badge-primary">必須</span>
                    <input type="text" id="job" name="job" class="form-control @error('job') is-invalid @enderror" value="{{ old('job') ?? $result['user_profile']->job ?? '' }}">
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
                    <textarea id="text" name="text" class="form-control @error('text') is-invalid @enderror" placeholder="最低5文字以上、最高1000文字まで">{{ old('text') ?? $result['user_profile']->text ?? '' }}</textarea>
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