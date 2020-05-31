@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center mb-4">
        <div class="col-12">
            <ul class="nav nav-tabs nav-justified mt-3">
                <li class="nav-item">
                    <a class="nav-link text-muted active"
                    href="{{ route('like.receive.list') }}">
                    お相手からもらったいいね
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-muted"
                    href="{{ route('like.send.list') }}">
                    自分からあげたいいね
                    </a>
                </li>
            </ul>
        </div>
    </div>
    <div class="row">
        @foreach($result['likes'] as $like)
        <div class="col-md-6 mb-4 border-bottom @if($loop->index % 2 == 0) border-right @endif">
            <div class="row">
                <div class="col-4">
                    <a href="{{ route('user.show', ['user' => $like->receive_user->id]) }}">
                        <img class="rounded-circle w-100" src="{{ $like->receive_user->user_profile->img_url ?? config('view.default_img') }}"  alt="写真なし"></img>
                    </a>
                </div>
                <div class="col-8">
                    <div class="d-flex flex-row">
                        <div>
                            <p class="h4">{{ $like->receive_user->user_profile->age ?? "未設定" }}  {{ $like->receive_user->user_profile->residence ?? "" }}</p>   
                        </div>
                        <div class="ml-auto">
                            <div class="rounded-pill bg-light">{{ $like->created_at }}</div>
                        </div>
                    </div>
                    <div class="mb-3">{{ $like->receive_user->user_profile->job ?? "未設定" }}</div>
                    <like-component 
                        endpoint=@if($like->status == "") {{ route('like.send', ['user' => $like->receive_user->id]) }} @else {{ route('room.message', ['room' => $like->room_id]) }} @endif
                        initial-like-status=@if($like->status == "")'received' @else {{ $like->status }} @endif>
                    </like-component>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection
