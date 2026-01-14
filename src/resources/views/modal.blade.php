@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/test_modal.css') }}">
@endsection
@section('content')

<div>
    {{ $contacts->links() }}
</div>
@foreach($contacts as $contact)
    <table class="contacts_table">
        <tr>
            <td>
                {{ $contact->last_name }}
                {{ $contact->first_name }}
            </td>
            <td>
                @if ($contact->gender == 1)
                    男性
                @elseif ($contact->gender == 2)
                    女性
                @else
                    その他
                @endif
            </td>
            <td>
                {{ $contact->email }}
            </td>
            <td>
                 <a class="admin__detail-btn" href="#{{$contact->id}}">詳細</a>
            </td>
        </tr>
        <div class="modal" id="{{$contact->id}}">
        <a href="#!" class="modal-overlay"></a>
        <div class="modal__inner">
          <div class="modal__content">
            <form class="modal__detail-form" action="/delete" method="post">
              @csrf
              <div class="modal-form__group">
                <label class="modal-form__label" for="">お名前</label>
                <p>{{$contact->first_name}}{{$contact->last_name}}</p>
              </div>

              <div class="modal-form__group">
                <label class="modal-form__label" for="">性別</label>
                <p>
                  @if($contact->gender == 1)
                  男性
                  @elseif($contact->gender == 2)
                  女性
                  @else
                  その他
                  @endif
                </p>
              </div>

         <div class="modal-form__group">
                <label class="modal-form__label" for="">メールアドレス</label>
                <p>{{$contact->email}}</p>
              </div>

              <div class="modal-form__group">
                <label class="modal-form__label" for="">電話番号</label>
                <p>{{$contact->tell}}</p>
              </div>

              <div class="modal-form__group">
                <label class="modal-form__label" for="">住所</label>
                <p>{{$contact->address}}</p>
              </div>

              <div class="modal-form__group">
                <label class="modal-form__label" for="">お問い合わせの種類</label>
                <p>{{$contact->category->content}}</p>
              </div>

              <div class="modal-form__group">
                <label class="modal-form__label" for="">お問い合わせ内容</label>
                <p>{{$contact->detail}}</p>
              </div>
              <input type="hidden" name="id" value="{{ $contact->id }}">
              <input class="modal-form__delete-btn btn" type="submit" value="削除">

            </form>
          </div>
          <a href="#" class="modal__close-btn">×</a>
        </div>
    </table>
@endforeach

@endsection