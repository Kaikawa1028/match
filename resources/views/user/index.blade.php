@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-3 mb-4">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('user') }}" method="get">
                        <div class="form-group">
                            <label for="age">年齢</label>
                            <select id="age" name="age" class="form-control">
                                <option value="">選択しない</option>
                                <option value="25">25歳</option>
                                <option value="26">26歳</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="residence">居住地</label>
                            <select id="residence" name="residence" class="form-control">
                                <option value="">選択しない</option>
                                <option value="東京都">東京都</option>
                                <option value="静岡県">静岡県</option>
                            </select>
                        </div>

                        <button class="btn btn-default my-4 btn-block rounded" type="submit">検索</button>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-8">
            <div class="row">
            @foreach($result['users'] as $user)
                <div class="col-6 col-md-4 col-lg-3  mb-4">
                    <div class="card">
                        <img class="card-img-top" src="{{ $user->user_profile->img_url }}"  alt="写真なし"></img>
                        <div class="card-body">
                            <h6 class="card-title">{{$user->user_profile->user_name}}</h4>
                            <a href="{{ route('user.show', ['user_id' => $user->id ]) }}" class="stretched-link"><p class="card-text">{{ $user->user_profile->age }}  {{ $user->user_profile->residence }}</p></a>
                        </div>
                    </div>
                </div>
            @endforeach
            </div>
            <div class="row justify-content">
                {{ $result['users']->appends(['age' => Request::get('age'), 'residence' => Request::get('residence')])->links() }}
            </div>
        </div>
    </div>
</div>
@endsection
