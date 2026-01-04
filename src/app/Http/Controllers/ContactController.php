<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContactRequest;
use App\Http\Requests\UserRequest;
use App\Http\Requests\LoginRequest;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Contact;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
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

    public function register (Request $request)
    {
       return view('register');
    }

    public function registerStore(UserRequest $request)
    {
        $data = $request->only(['name', 'email', 'password']);
        $data['password'] = bcrypt($data['password']);
        User::create($data);
        return redirect('/login');
    }

    public function showLoginForm ()
    {
      return view('login');
    }

    public function admin (Request $request)
    {
        $contacts = Contact::Paginate(10);
        return view('admin', compact('contacts'));
    }

    public function search (Request $request)
    {
        $keyword = $request->input('search');
        $gender = $request->input('gender');
        $categories = $request->input('category');
        $datePicker = $request->input('datePicker');
        $action = $request->input('action');
        $contacts = Contact::query();
        
        if (!empty($keyword)) {
            $contacts->where(function ($query) use ($keyword) {
                $query->where('email', 'like', "%{$keyword}%")
                    ->orWhere('first_name', 'like', "%{$keyword}%")
                    ->orWhere('last_name', 'like', "%{$keyword}%");
            });
        }
         
        if (!empty($gender)) {
            $contacts->where('gender', $gender);
        }

        if (!empty($categories)) {
            $contacts->where('category_id', $categories);
        }

        if (!empty($datePicker)) {
            $contacts->wheredate('created_at',  $datePicker);
        }

        if ($action === 'export') { 
            return new \Symfony\Component\HttpFoundation\StreamedResponse(function () use ($contacts) { $handle = fopen('php://output', 'w'); fputcsv($handle, 
                ['ID', '姓', '名', 'メール', '性別', 'カテゴリ', '登録日']
            ); 
            foreach ($contacts->get() as $contact) { 
                fputcsv($handle, [ $contact->id, $contact->last_name, $contact->first_name, $contact->email, $contact->gender, $contact->category_id, $contact->created_at->format('Y-m-d H:i:s'), ]); 
            }
                fclose($handle);
            }, 200, [ 'Content-Type' => 'text/csv', 'Content-Disposition' => 'attachment; filename="contacts.csv"', ]); 
        }
        $categories = Category::all();
        $contacts = $contacts->paginate(10)->appends($request->all());

        return view('admin', compact('contacts', 'categories'));
    }
}
