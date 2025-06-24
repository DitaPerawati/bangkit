<?php
namespace App\Controllers;

use App\Models\LaptopModel;

class Customer extends BaseController
{
    public function dashboard()
    {
        if (session()->get('role') !== 'customer') {
            return redirect()->to('/login')->with('error', 'Akses ditolak');
        }
        
        $model = new LaptopModel();
        $data['laptops'] = $model->findAll();

        return view('customer/dashboard', $data);
    }
}
