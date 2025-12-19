@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
@endsection
@section('content')
    <div class="admin__content">
        <div class="admin__heading">
            <h2 class="title-family">Admin</h2>
        </div>
    </div>
    <form action="/admin" method="post">
        <div class="contacts_link">
            {{ $contacts->links() }}
        </div>
        <table>
            <tr>
                <th>お名前</th>
                <th>性別</th>
                <th>メールアドレス</th>
                <th>お問い合わせの種類</th>
                <th></th>
            </tr>
            @foreach ($contacts as $contact)
                <tr>
                    <td>{{ $contact->first_name }}　{{ $contact->last_name }}</td>
                        @php
    $genderMap = [1 => '男性', 2 => '女性', 3 => 'その他'];
                        @endphp
                    <td>{{ $genderMap[$contact->gender] ?? '未設定' }}</td>
                    <td>{{ $contact->email }}</td>
                    @php
    $categoryMap = [1 => '商品のお届けについて', 2 => '商品の交換について', 3 => '商品トラブル', 4 => 'ショップ問い合わせ', 5 => 'その他'];
                    @endphp
                    <td>{{ $categoryMap[$contact->category_id] ?? '未設定'}}</td>
                    <td><button class="Details-button">詳細</button></td>
                </tr>
            @endforeach
        </table>
    </form>
@endsection