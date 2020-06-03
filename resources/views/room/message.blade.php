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
                            <img class="rounded-circle w-75" src="{{ $message->from_user->user_profile->img_url ?? config('view.default_img') }}"  alt="写真なし"></img>
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
            <div class="col-10 col-md-7 mt-4">
                @can('paid-member')
                <form action="{{ route('room.message.send', ['room' => $result['room_id']]) }}" method="post">
                    @csrf
                    <div class="d-flex flex-row">
                        <div class="w-75">
                            <div class="form-group">
                                <textarea name="text" required class="form-control" rows="4" placeholder="本文" style="height: 75px;"></textarea>
                            </div>    
                        </div>
                        <div class="w-25">
                            <button type="submit" class="btn btn-primary" style="padding: 0.84rem 1.14rem;">送信</button>
                        </div>    
                    </div>
                </form>
                @elsecan('free-member')
                <div class="mb-1">
                    <p class="h6">有料会員のみメッセージを送ることができます。※サンプルアプリなので無料で有料会員になれます＾＾</p>
                    <a href="{{ route('user.paid') }}"><button type="button" class="btn btn-default" style="padding:0rem 2.14rem; height:32px;">有料会員になる</button></a>
                </div>
                @endcan
            </div>
        </div>
    </div>
</div>
@endsection
