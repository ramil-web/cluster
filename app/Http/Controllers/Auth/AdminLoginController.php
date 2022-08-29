<?php

namespace App\Http\Controllers\Auth;

use App\Models\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use Illuminate\Support\Facades\Input;
use Route;
use Validator;

class AdminLoginController extends Controller
{
    public function __construct() {
        parent::__construct();
        //    $this->middleware('auth:admin');    
    }

    public function showLoginForm() {
        if ( Auth::guard('admin')->check() ) {
            return redirect('/admin');
        } else {
            return view('auth.admin-login');
        }
    }

    public function login(Request $request) {

        $main_page = false;

        $validator = Validator::make(
            $request->all(),
            [
                'login' => 'required', 'password' => 'required|min:5',
            ],
            [
                'login.required'    => 'Поле login должно быть заполнено',
                'password.required' => 'Ошибка поля пароль',
                'password.min'      => 'Ошибка поля пароль',
            ]
        );

        if ( Auth::guard('admin')
            ->attempt(['login' => $request->login, 'password' => $request->password, 'is_active' => 1], $request->remember)
        ) {

            $main_page = Input::get('main_page');

            if ($main_page) {
                return redirect('/wb');
            }else{
                return redirect('/admin');
            }
        }

        return redirect()->back()->withInput($request->only('login', 'remember'))->withErrors($validator);
    }

    public function setAdmin(Request $request) {
        $id = $request->route('id');
        Auth::guard('admin')->login(Admin::find($id));

        return redirect('/admin/admins');
    }

    public function logout() {
        Auth::guard('admin')->logout();

        return redirect()->route('admin.login.form');
    }
}
