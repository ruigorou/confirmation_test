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
    <div class="search">
        <form class="search_form" action="/search" method="get">
        @csrf
            <div>
                <input type="text" name="search" value="{{ $contacts['email'] }}" placeholder="名前やメールアドレスを入力して下さい">
            </div>
            <div>
                <select class="search_form__select" name="gender">
                    <option disabled selected>性別</option>
                    <option value="1" @if( request('gender')==1 ) selected @endif>男性</option>
                    <option value="2" @if( request('gender')==2 ) selected @endif>女性</option>
                    <option value="3" @if( request('gender')==3 ) selected @endif>その他</option>
                </select>
            </div>
            <div>
                <select class="search_form__select" name="category">
                    <option disabled selected>お問い合わせの種類</option>
                   @foreach($categories as $category)
                        <option value="{{ $category->id }}" @if( request('category_id')==$category->id ) selected @endif
                            >{{$category->content }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div>
                <input type="date" id="datePicker" name="datePicker" placeholder="年/月/日">
            </div>
            <div class="search__btn">
                <button class="search__btn--submit" type="submit">
                    検索
                </button>
            </div>
            <div class="search__btn">
                <a href="{{ route('search') }}" class="search__btn--reset">リセット</a>
            </div>
        </form>
    </div>
    <div class="contents">
        <form action="/export">
            <div>
                <input type="hidden" name="search" value="{{ request('search') }}">
                <input type="hidden" name="gender" value="{{ request('gender') }}">
                <input type="hidden" name="category" value="{{ request('category') }}">
                <input type="hidden" name="datePicker" value="{{ request('datePicker') }}">
                <input type="hidden" name="action" value="export">
                <button type="submit">エクスポート</button>
            </div>
        </form>
        <div class="contacts_link">
            {{ $contacts->links('vendor.pagination.page')}}
        </div>
    </div>
    <form action="/admin" method="post">
        <table class="admin_table">
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
                    <td>
                        @if($contact->gender == 1)
                            男性
                        @elseif($contact->gender == 2)
                            女性
                        @else
                            その他
                        @endif
                    </td>
                    <td>{{ $contact->email }}</td>
                    <td>{{$contact->category->content}}</td>
                    <td>
                        <a class="admin__detail-btn" href="#{{$contact->id}}">詳細</a>
                    </td>
                </tr>
            @endforeach
        </table>
    </form>
@endsection