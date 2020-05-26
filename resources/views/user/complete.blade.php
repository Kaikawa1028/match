@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="mb-5">
            有料会員への登録が完了しました！
        </div>
        
        <div class="w-100 text-center mb-4">
            <a href="{{ route('mypage') }}"><button type="button" class="btn btn-default">マイページへ戻る。</button></a>
        </div>
    </div>
</div>
@endsection