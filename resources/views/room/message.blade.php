@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-11">
            @foreach($result['messages'] as $message)
                @if($user->id != $message->from_user_id)
                <div class="row mb-4">
                    <div class="col-4 col-md-2">
                        <a href="#" class="text-dark">
                            <img class="rounded-circle w-75" src="{{ $message->from_user->user_profile->img_url ?? 'https://matching-kou.s3.ap-northeast-1.amazonaws.com/3/TW2fauu9FNUFIYorYS8zqcSee1w2V6HPR36uJKOj.png' }}"  alt="写真なし"></img>
                        </a>
                    </div>
                    <div class="col-8">
                        <div class="row">
                            <div class="col-7 balloon-left">
                                <p class="font-weight-lighter">{!! nl2br(e($message->text)) !!}</p>
                            </div>
                            <div class="col-5 align-self-end">
                                <div class="font-weight-lighter">{{ $message->created_at }}</div>
                            </div>
                        </div>
                    </div>
                </div>
                @else
                <div class="row justify-content-end mb-4">
                    <div class="col-4 text-right align-self-end">
                        <div class="font-weight-lighter">{{ $message->created_at }}</div>
                    </div>
                    <div class="col-6 balloon-right">
                        <p class="font-weight-lighter">{!! nl2br(e($message->text)) !!}</p>
                    </div>
                </div>
                @endif
            @endforeach
            <div style="height: 200px;"></div>
        </div>
    </div>
    <div class="fixed-bottom">
        <div class="row justify-content-center bg-light">
            <div class="col-7 mt-4">
                @can('paid-member')
                <form action="{{ route('room.message.send', ['room' => $result['room_id']]) }}" method="post">
                    @csrf
                    <div class="form-group">
                        <textarea name="text" required class="form-control" rows="4" placeholder="本文"></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">メッセージを送る</button>
                </form>
                @elsecan('free-member')
                <div class="mb-5">
                    <p>有料会員のみメッセージを送ることができます。※サンプルアプリなので無料で有料会員になれます＾＾</p>
                    <a href="{{ route('user.paid') }}"><button type="button" class="btn btn-default">有料会員になる</button></a>
                </div>
                @endcan
            </div>
        </div>
    </div>
</div>
@endsection
