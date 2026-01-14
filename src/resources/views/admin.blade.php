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
                <input type="text" name="keyword" value="{{ $contacts['email'] }}" placeholder="名前やメールアドレスを入力して下さい">
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
                <select class="search_form__select" name="category_id">
                    <option disabled selected>お問い合わせの種類</option>
                   @foreach($categories as $category)
                        <option value="{{ $category->id }}" @if( request('category_id')==$category->id ) selected @endif
                            >{{$category->content }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div>
                <input type="date" id="datePicker" name="datePicker">
            </div>
            <div class="search__btn">
                <button class="search__btn--submit" type="submit">
                    検索
                </button>
            </div>
            <div class="search__btn">
                <input class="search__btn--reset" type="submit" name="reset" value="リセット">
            </div>
        </form>
    </div>
    <div class="contents">
        <form action="{{ route('export', request()->query()) }}" method="post">
            @csrf
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
        @csrf
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
                    <td id="contact-name">{{ $contact->first_name }}　{{ $contact->last_name }}</td>
                    <td id="contact-gender">
                        @if($contact->gender == 1)
                            男性
                        @elseif($contact->gender == 2)
                            女性
                        @else
                            その他
                        @endif
                    </td>
                    <td id="contact-email">{{ $contact->email }}</td>
                    <td id="contact-category">{{$contact->category->content}}</td>
                    <td>
                        <div class="open">
                            <input id="contact-id" type="hidden" value="{{ $contact->id }}">
                            <span id="contact-detail" style="display: none;">{{ $contact->detail }}</span>
                            <button class="open-button" type="button">詳細</button>
                        </div>
                    </td>
                </tr>
            @endforeach
        </table>
    </form>
    <dialog class="dialog">
        <div class="modal-form__group">
             <label class="modal-form__label">名前</label>
             <p id="modal-name"></p>
        </div>
        <div class="modal-form__group">
             <label class="modal-form__label">性別</label>
             <p id="modal-gender"></p>
        </div>
        <div class="modal-form__group">
            <label class="modal-form__label">メールアドレス</label>
             <p id="modal-email"></p>
         </div>
         <div class="modal-form__group">
            <label class="modal-form__label">カテゴリー</label>
            <p id="modal-category"></p>
         </div>
         <div class="modal-form__group">
            <label class="modal-form__label">お問い合わせ内容</label>
            <p id="modal-detail"></p>
         </div>
         <form class="modal-form" action="/delete" method="post">
            @csrf
            <input type="hidden" id="modal-id" name="modal-id" value="">
            <button class="modal-form__destroy" type="submit">削除</button>
         </form>
         
         <a href="#" class="modal__close-btn">×</a>
     </dialog>
    <script src="{{ asset('js/modal.js') }}"></script>
@endsection