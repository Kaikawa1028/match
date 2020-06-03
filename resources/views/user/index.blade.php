@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-3 mb-4">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('user') }}" method="get">
                        <div class="form-group">
                            <label for="age">年齢</label>

                            <div class="d-flex flex-row">
                                <div class="w-25 mr-1">
                                    <select id="age_higher" name="age_higher" class="form-control">
                                        <option value="">選択しない</option>
                                        @for($i=18; $i<=40; $i++)
                                        <option value="{{$i}}" @if(!is_null($request->age_higher) && $request->age_higher == $i) selected  @endif>{{$i}}歳</option>
                                        @endfor
                                    </select>
                                </div>
                                <div class="align-self-end">以上</div>
                                <div class="w-25 ml-4 mr-1">
                                    <select id="age_lower" name="age_lower" class="form-control">
                                        <option value="">選択しない</option>
                                        @for($i=18; $i<=40; $i++)
                                        <option value="{{$i}}" @if(!is_null($request->age_lower) && $request->age_lower == $i) selected  @endif>{{$i}}歳</option>
                                        @endfor
                                    </select>
                                </div>
                                <div class="align-self-end">以下</div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="height">身長</label>

                            <div class="d-flex flex-row">
                                <div class="mr-1" style="width:30%;">
                                    <select id="height_higher" name="height_higher" class="form-control">
                                        <option value="">選択しない</option>
                                        @for($i=140;$i <= 190; $i++)
                                        <option value="{{$i}}" @if(!is_null($request->height_higher) && $request->height_higher == $i) selected  @endif>{{$i}}cm</option>
                                        @endfor
                                    </select>
                                </div>
                                <div class="align-self-end">以上</div>
                                <div class="ml-3 mr-1" style="width:30%;">
                                    <select id="height_lower" name="height_lower" class="form-control">
                                        <option value="">選択しない</option>
                                        @for($i=140;$i <= 190; $i++)
                                        <option value="{{$i}}" @if(!is_null($request->height_lower) && $request->height_lower == $i) selected  @endif>{{$i}}cm</option>
                                        @endfor
                                    </select>
                                </div>
                                <div class="align-self-end">以下</div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="residence">居住地</label>
                            <select id="residence" name="residence" class="form-control">
                                <option value="">選択しない</option>
                                <option value="東京都" @if(!is_null($request->residence) && $request->residence == "東京都") selected  @endif>東京都</option>
                                <option value="大阪府" @if(!is_null($request->residence) && $request->residence == "大阪府") selected  @endif>大阪府</option>
                                <option value="静岡県" @if(!is_null($request->residence) && $request->residence == "静岡県") selected  @endif>静岡県</option>
                                <option value="福岡県" @if(!is_null($request->residence) && $request->residence == "福岡県") selected  @endif>福岡県</option>
                                <option value="神奈川県" @if(!is_null($request->residence) && $request->residence == "神奈川県") selected  @endif>神奈川県</option>
                                <option value="沖縄県" @if(!is_null($request->residence) && $request->residence == "沖縄県") selected  @endif>沖縄県</option>
                                <option value="北海道" @if(!is_null($request->residence) && $request->residence == "北海道") selected  @endif>北海道</option>
                                <option value="香川県" @if(!is_null($request->residence) && $request->residence == "香川県") selected  @endif>香川県</option>
                            </select>
                        </div>

                        @can('paid-member')
                        <div class="form-group">
                            <label for="text">フリーワード</label>
                            <input type="text" id="text" name="text" class="form-control" placeholder="犬・料理好き　など" value="{{ $data['text'] ?? '' }}">
                        </div>
                        @endcan

                        <button class="btn btn-default my-4 btn-block rounded" type="submit">検索</button>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-lg-9">
            <div class="row">
            @foreach($result['users'] as $user)
                <div class="col-6 col-md-4 col-lg-3  mb-4">
                    <div class="card">
                        <img class="card-img-top" src="{{ $user->user_profile->img_url ?? config('view.default_img') }}"  alt="写真なし"></img>
                        <div class="card-body">
                            <h6 class="card-title">{{$user->user_profile->user_name ?? '未設定'}}</h4>
                            <a href="{{ route('user.show', ['user' => $user->id ]) }}" class="stretched-link"><p class="card-text">{{ $user->user_profile->age ?? '未設定' }}  {{ $user->user_profile->residence ?? '' }}</p></a>
                        </div>
                    </div>
                </div>
            @endforeach
            </div>
            <div class="row justify-content">
                {{ $result['users']->appends([
                                            'age_higher' => Request::get('age_higher'),
                                            'age_lower' => Request::get('age_lower'),
                                            'height_higher' => Request::get('height_higher'),
                                            'height_lower' => Request::get('height_lower'),
                                             'residence' => Request::get('residence')]
                                             )->links() }}
            </div>
        </div>
    </div>
</div>
@endsection
