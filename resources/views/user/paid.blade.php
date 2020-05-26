@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <table class="table mb-5">
                <thead class="thead-light">
                    <tr>
                        <th></th>
                        <th>有料会員になったらできること</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <th>1</th>
                        <td>メッセージを送ることができます。</td>
                    </tr>
                    <tr>
                        <th>2</th>
                        <td>フリーワードで検索することができます。</td>
                    </tr>
                </tbody>
            </table>

            <table class="table mb-5">
                <thead class="thead-light">
                    <tr>
                        <th>月額料金</th>
                        <th>※サンプルアプリなので<br>無料で有料会員になれます。</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <th>1ヶ月</th>
                        <td>3980円/月</td>
                    </tr>
                    <tr>
                        <th>3ヶ月</th>
                        <td>3380円/月</td>
                    </tr>
                    <tr>
                        <th>6ヶ月</th>
                        <td>2980円/月</td>
                    </tr>
                </tbody>
            </table>

            <a href="{{ route('user.paid.complete') }}"><button type="button" class="btn btn-default">有料会員になる</button></a>
        </div>
    </div>
</div>
@endsection
