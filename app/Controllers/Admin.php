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

    // Menampilkan daftar pesanan yang masuk
    public function pesanan()
{
    if (session()->get('role') !== 'admin') {
        return redirect()->to('/login')->with('error', 'Akses ditolak');
    }

    $db = \Config\Database::connect();
    $builder = $db->table('penjualan');
    $builder->select('penjualan.*, users.username');
    $builder->join('users', 'users.id = penjualan.user_id');
    $builder->orderBy('penjualan.tanggal', 'DESC');
    $query = $builder->get();
    $data['pesanan'] = $query->getResultArray();

    return view('admin/pesanan', $data);
}


    // Konfirmasi pesanan menjadi "dikirim"
    public function konfirmasi($id)
    {
        if (session()->get('role') !== 'admin') {
            return redirect()->to('/login')->with('error', 'Akses ditolak');
        }
    
        $penjualanModel = new \App\Models\PenjualanModel();
        $laptopModel = new \App\Models\LaptopModel();
    
        $pesanan = $penjualanModel->find($id);
        if (!$pesanan) {
            return redirect()->back()->with('error', 'Pesanan tidak ditemukan');
        }
    
        // Ambil data laptop
        $laptop = $laptopModel->find($pesanan['laptop_id']);
        if (!$laptop) {
            return redirect()->back()->with('error', 'Laptop tidak ditemukan');
        }
    
        // Cek apakah stok cukup
        if ($laptop['stok'] < $pesanan['jumlah']) {
            return redirect()->back()->with('error', 'Stok tidak mencukupi');
        }
    
        // Kurangi stok
        $laptopModel->update($pesanan['laptop_id'], [
            'stok' => $laptop['stok'] - $pesanan['jumlah']
        ]);
    
        // Ubah status menjadi "dikirim"
        $penjualanModel->update($id, ['status' => 'dikirim']);
    
        return redirect()->to('/admin/pesanan')->with('success', 'Pesanan dikonfirmasi dan stok dikurangi');
    }

}
