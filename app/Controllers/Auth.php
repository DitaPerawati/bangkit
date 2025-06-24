<?php

namespace App\Controllers;

use App\Models\UserModel;

class Auth extends BaseController
{
    public function login()
    {
        return view('login_view'); // tampilan form login
    }

    public function loginPost()
{
    $session = session();
    $userModel = new UserModel();

    $username = $this->request->getPost('username');
    $password = $this->request->getPost('password');

    $user = $userModel->where('username', $username)->first();

    if ($user) {
        if (password_verify($password, $user['password'])) {
            // Set sesi
            $session->set([
                'user_id' => $user['id'],
                'username' => $user['username'],
                'isLoggedIn' => true,
                'role' => ($username == 'admin') ? 'admin' : 'customer'
            ]);

            // Redirect sesuai peran
            if ($username == 'admin') {
                return redirect()->to('/admin/dashboard'); // Halaman Dashboard Admin
            } else {
                return redirect()->to('/customer/dashboard'); // Halaman Dashboard Customer
            }
        } else {
            return redirect()->back()->with('error', 'Password salah');
        }
    } else {
        return redirect()->back()->with('error', 'Username tidak ditemukan');
    }
}


    public function logout()
    {
        session()->destroy();
        return redirect()->to('/login');
    }
}