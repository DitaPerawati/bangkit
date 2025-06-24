<?php
namespace App\Controllers;

use App\Models\LaptopModel;

class Admin extends BaseController
{
    public function dashboard()
    {
        if (session()->get('role') !== 'admin') {
            return redirect()->to('/login')->with('error', 'Akses ditolak');
        }
        
        $model = new LaptopModel();
        $data['laptops'] = $model->findAll();

        return view('admin/dashboard', $data);
    }
}
