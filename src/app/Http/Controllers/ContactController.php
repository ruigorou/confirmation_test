<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContactRequest;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Contact;
class ContactController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        return view('index', compact('categories'));
    }

    public function confirm(ContactRequest $request)
    {
        $contact = $request->only([
            'first_name',
            'last_name',
            'gender',
            'email',
            'tel1',
            'tel2',
            'tel3',
            'address',
            'building',
            'category_id',
            'detail'
        ]);
        $genderMap = [
            1 => '男性',
            2 => '女性',
            3 => 'その他',
        ];
        $gender_label = $genderMap[$contact['gender']] ?? '未設定';
        $category = Category::find($contact['category_id']);
        return view('confirm', compact('contact', 'category', 'gender_label'));
    }

    public function edit(Request $request)
    {
        return redirect('/')->withInput();
    }

    public function thanks(Request $request)
    {
        $tel = $request->input('tel1') . '-' . $request->input('tel2') . '-' . $request->input('tel3');
        $contact = $request->only([
            'first_name',
            'last_name',
            'gender',
            'email',
            'address',
            'building',
            'category_id',
            'detail'
        ]);
        $contact['tel'] = $tel;
        Contact::create($contact);
        return view('thanks');
    }

    public function register ()
    {
       return view('register');
    }

    public function login()
    {
        return view('login');
    }


}
