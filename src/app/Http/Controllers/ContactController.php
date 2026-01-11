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
        $categories = Category::all();
        return view('admin', compact('contacts', 'categories'));
    }

    public function search (Request $request)
    {
        if ($request->has('reset')) {
            return redirect('/admin')->withInput();
        }

        $action = $request->input('action');
        $query = Contact::query();
        $query = $this->setSearchQuery($request, $query);

        
        if ($action === 'export') { 
            return new \Symfony\Component\HttpFoundation\StreamedResponse(function () use ($query) { $handle = fopen('php://output', 'w'); fputcsv($handle, 
                ['ID', '姓', '名', 'メール', '性別', 'カテゴリ', '登録日']
            ); 
            foreach ($query->get() as $contact) { 
                fputcsv($handle, [ $contact->id, $contact->last_name, $contact->first_name, $contact->email, $contact->gender, $contact->category_id, $contact->created_at->format('Y-m-d H:i:s'), ]); 
            }
                fclose($handle);
            }, 200, [ 'Content-Type' => 'text/csv', 'Content-Disposition' => 'attachment; filename="contacts.csv"', ]); 
        }
        $categories = Category::all();
        $contacts = $query->paginate(10)->appends($request->all());

        return view('admin', compact('contacts', 'categories'));
    }

    private function setSearchQuery($request, $query) {
        
        if (!empty($request->keyword)) {
            $query->where(function ($q) use ($request) {
                $q->where('email', 'like', '%' . $request->keyword . '%')
                ->orWhere('first_name', 'like', '%' . $request->keyword . '%')
                ->orWhere('last_name', 'like', '%' . $request->keyword . '%');
            });
        }
         
        if (!empty($request->gender)) {
            $query->where('gender', '=', $request->gender);
        }

        if (!empty($request->category_id)) {
            $query->where('category_id', '=', $request->category_id);
        }

        if (!empty($request->datePicker)) {
            $query->wheredate('created_at', '=',   $request->datePicker);
        }

        return $query;

    }

    public function destroy(Request $request) {
        $id = $request->input('modal-id');
        Contact::find($id)->delete();
        return redirect('admin');
    }
}
