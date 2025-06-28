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
                    'role' => ($user['is_admin'] == 1) ? 'admin' : 'customer'
                ]);

                // Redirect sesuai peran
                if ($user['is_admin'] == 1) {
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


    public function register()
    {
        return view('register_view');
    }

    public function registerPost()
    {
        $userModel = new \App\Models\UserModel();

        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');

        // Validasi sederhana
        if ($userModel->where('username', $username)->first()) {
            return redirect()->back()->with('error', 'Username sudah terdaftar');
        }

        // Simpan ke database dengan password hash
        $userModel->insert([
            'username' => $username,
            'password' => password_hash($password, PASSWORD_DEFAULT),
            'is_admin'     => 0 // default: customer
        ]);

        return redirect()->to('/login')->with('success', 'Berhasil daftar, silakan login');
    }
}