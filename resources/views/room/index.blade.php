@extends('layouts.app')

@section('content')
<div class="container mt-3">
    @foreach($result['rooms'] as $room)
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="row border-bottom">
                @if($user->sex == "1")
                <div class="col-3 col-md-2">
                    <a href="{{ route('user.show', ['user' => $room->woman_user->id] ) }}">
                        <img class="rounded-circle w-100" src="{{ $room->woman_user->user_profile->img_url ?? 'https://matching-kou.s3.ap-northeast-1.amazonaws.com/3/TW2fauu9FNUFIYorYS8zqcSee1w2V6HPR36uJKOj.png' }}"  alt="写真なし"></img>
                    </a>
                </div>
                <div class="col-9 col-md-10">
                    <div class="d-flex flex-row">
                        <div>
                            <p class="h4">{{ $room->woman_user->user_profile->user_name ?? "未設定" }}</p>   
                        </div>
                        <div class="ml-auto">
                            <div class="rounded-pill bg-light">{{ $room->created_at }}</div>
                        </div>
                    </div>
                    <div>@if(is_null($room->messages->last())) まだメッセージを交換していません。  @else {{ $room->messages->last()->getLastText()}} @endif</div>
                </div>
                @else
                <div class="col-3 col-md-2">
                    <a href="{{ route('user.show', ['user' => $room->man_user->id] ) }}">
                        <img class="rounded-circle w-100" src="{{ $room->man_user->user_profile->img_url ?? 'https://matching-kou.s3.ap-northeast-1.amazonaws.com/3/TW2fauu9FNUFIYorYS8zqcSee1w2V6HPR36uJKOj.png' }}"  alt="写真なし"></img>
                    </a>
                </div>
                <div class="col-9 col-md-10">
                    <div class="d-flex flex-row">
                        <div>
                            <p class="h4">{{ $room->man_user->user_profile->user_name ?? "未設定" }}</p>   
                        </div>
                        <div class="ml-auto">
                            <div class="rounded-pill bg-light">{{ $room->created_at }}</div>
                        </div>
                    </div>
                    <div>@if(is_null($room->messages->last())) まだメッセージを交換していません。  @else {{ $room->messages->last()->getLastText()}} @endif</div>
                    <a href="{{ route('room.message', ['room' => $room->id]) }}" class="stretched-link"><p class="card-text"></a>
                </div>
                @endif
            </div>
        </div>
    </div>
    @endforeach
</div>
@endsection
