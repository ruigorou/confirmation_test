@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/index.css') }}">
@endsection
@section('content')
    <div class="contents__title title-family">
        <h2>Contact</h2>
    </div>
    <form class="contact-form" action="">
        @csrf
        <table class="contact-form__table">
            <tr class="contact-form__row">
                <td colspan="2" class="contact-form__label">名前 <span class="contact-form__required">※</span></td>
                <td class="contact-form__name"><input class="contact-form__name-input-first_name" type="text" value="例：山田"></td>
                <td class="contact-form__name"><input class="contact-form__name-input-last_name" type="text" value="例：太郎"></td>
            </tr>
            <tr class="contact-form__row">
                <td colspan="2">性別　<span class="contact-form__required">※</span></td>
                <td colspan="4" class="contact-form__gender">
                    <label>
                        <input class="contact-form__gender-input-male" type="radio" name="gender" value="male">男性
                    </label>
                    <label>
                        <input class="contact-form__gender-input-female" type="radio" name="gender" value="female">女性
                    </label>
                    <label>
                        <input class="contact-form__gender-input-other" type="radio" name="gender" value="other">その他
                    </label>
                </td>
            </tr>
            <tr class="contact-form__row">
                <td colspan="2">メールアドレス　<span class="contact-form__required">※</span></td>
                <td colspan="5"><input class="contact-form__email" type="text" value="例:test@example.com"></td>
            </tr>
            <tr class="contact-form__row">
                <td colspan="2">電話番号　<span class="contact-form__required">※</span></td>
                <td class="contact-form__tel">
                    <input class="contact-form__tel-input--area" type="text">
                </td>
                <td class="contact-form__tel-separator">-</td>
                <td class="contact-form__tel">
                    <input class="contact-form__tel-input--local" type="text">
                </td>
                <td class="contact-form__tel-separator">-</td>
                <td class="contact-form__tel">
                    <input class="contact-form__tel-input--subscriber" type="text">
                </td>
            </tr>
            <tr class="contact-form__row">
                <td colspan="2">住所　<span class="contact-form__required">※</span></td>
                <td><input type="text"></td>
            </tr>
            <tr class="contact-form__row">
                <td colspan="2">建物名</td>
                <td><input type="text"></td>
            </tr>
            <tr class="contact-form__row">
                <td colspan="2">お問い合わせの種類　<span class="contact-form__required">※</span></td>
                <td>
                    <select name="" id="">
                        <option value="">選択して下さい</option>
                    </select>
                </td>
            </tr>
            <tr class="contact-form__row">
                <td colspan="2">お問い合わせ内容　<span class="contact-form__required">※</span></td>
                <td>
                    <textarea class="contact-form" name="" id=""></textarea>
                </td>
            </tr>
        </table>
    </form>

@endsection