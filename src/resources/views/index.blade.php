@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/index.css') }}">
@endsection
@section('content')
    <div class="contact-form__content">
        <div class="contact-form__heading">
            <h2 class="title-family">Contact</h2>
        </div>
        <form class="form" action="/confirm" method="post">
            @csrf
            <div class="form__group">
                <div class="form__group-title">
                    <span class="form__label--item">お名前</span>
                    <span class="form__label--required">※</span>
                </div>
                <div class="form__group-content">
                    <div class="form__input--name_text">
                        <input class="form__input--name_text-first_name" type="text" name="first_name" value="{{ old('first_name') }}" placeholder="例：山田" />
                        <input class="form__input--name_text-last_name" type="text" name="last_name" value="{{ old('last_name') }}" placeholder="例：太郎" />
                    </div>
                    <div class="form__error">
                        @error('first_name')
                            {{ $message }}
                        @enderror
                        @error('last_name')
                            {{ $message }}
                        @enderror
                    </div>
                </div>
            </div>
            <div class="form__group">
                <div class="form__group-title">
                    <span class="form__label--item">性別</span>
                    <span class="form__label--required">※</span>
                </div>
                <div class="form__group-content">
                    <div class="form__input--gender">
                        <label class="form__input--gender-label" for="male">
                            <input type="radio" name="gender" value="1" {{ old('gender') == 1 ? 'checked' : '' }}/>男性
                        </label>
                        <label class="form__input--gender-label" for="female">
                            <input type="radio" name="gender" value="2" {{ old('gender') == 2 ? 'checked' : '' }} />女性
                        </label>
                        <label class="form__input--gender-label" for="other">
                            <input type="radio" name="gender" value="3" {{ old('gender') == 3 ? 'checked' : '' }}/>その他
                        </label>
                    </div>
                    <div class="form__error">
                        @error('gender')
                            {{ $message }}
                        @enderror
                    </div>
                </div>
            </div>
            <div class="form__group">
                <div class="form__group-title">
                    <span class="form__label--item">メールアドレス</span>
                    <span class="form__label--required">※</span>
                </div>
                <div class="form__group-content">
                    <div class="form__input--text">
                        <input type="email" name="email" value="{{ old('email') }}" placeholder="test@example.com" />
                    </div>
                    <div class="form__error">
                        @error('email')
                            {{ $message }}
                        @enderror
                    </div>
                </div>
            </div>
            <div class="form__group">
                <div class="form__group-title">
                    <span class="form__label--item">電話番号</span>
                    <span class="form__label--required">※</span>
                </div>
                <div class="form__group-content">
                    <div class="form__input--tel">
                        <label for="tel">
                            <input type="tel" name="tel1" value="{{ old('tel1') }}" placeholder="080" /> －
                        </label>
                        <label for="tel">
                            <input type="tel" name="tel2" value="{{ old('tel2') }}" placeholder="1234" /> －
                        </label>
                        <label for="tel">
                            <input type="tel" name="tel3" value="{{ old('tel3') }}" placeholder="5678" />
                        </label>
                    </div>
                    <div class="form__error">
                        @error('tel1')
                            {{ $message }}
                        @enderror
                        @error('tel2')
                            {{ $message }}
                        @enderror
                        @error('tel3')
                            {{ $message }}
                        @enderror
                    </div>
                </div>
            </div>
            <div class="form__group">
                <div class="form__group-title">
                    <span class="form__label--item">住所</span>
                    <span class="form__label--required">※</span>
                </div>
                <div class="form__group-content">
                    <div class="form__input--text">
                        <input type="address" name="address" value="{{ old('address') }}" placeholder="例）沖縄県那覇市123" />
                    </div>
                    <div class="form__error">
                        @error('address')
                            {{ $message }}
                        @enderror
                    </div>
                </div>
            </div>
            <div class="form__group">
                <div class="form__group-title">
                    <span class="form__label--item">建物名</span>
                </div>
                <div class="form__group-content">
                    <div class="form__input--text form__inputt--sub_address">
                        <input type="address" name="building" value="{{ old('building') }}" placeholder="例）沖縄マンション" />
                    </div>
                </div>
            </div>
            <div class="form__group">
                <div class="form__group-title">
                    <span class="form__label--item">お問い合わせの種類</span>
                    <span class="form__label--required">※</span>
                </div>
                <div class="form__group-content">
                    <div class="form__input--select">
                        <select name="category_id">
                            <option value="">'選択してください'</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}"{{ old('category_id') == $category->id ? 'selected' : '' }}>{{ $category->content }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form__error">
                        @error('category_id')
                            {{ $message }}
                        @enderror
                    </div>
                </div>
            </div>
            <div class="form__group">
                <div class="form__group-title">
                    <span class="form__label--item">お問い合わせ内容</span>
                    <span class="form__label--required">※</span>
                </div>
                <div class="form__group-content">
                    <div class="form__input--textarea">
                        <textarea name="detail" placeholder="お問い合わせ内容をご記入下さい。">{{ old('detail') }}</textarea>
                    </div>
                    <div class="form__error">
                        @error('detail')
                            {{ $message }}
                        @enderror
                    </div>
                </div>
            </div>
            <div class="form__button">
                <button class="form__button-submit" type="submit">確認画面</button>
            </div>
        </form>
    </div>




@endsection