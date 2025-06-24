<?php

namespace App\Controllers;

use App\Models\LaptopModel;
use App\Models\PenjualanModel;

class Home extends BaseController
{
    public function index()
    {
        $laptopModel = new LaptopModel();
        $data['laptops'] = $laptopModel->findAll();

        return view('laptop_view', $data);
    }

    public function beli()
    {
        $idLaptop = $this->request->getPost('id');

        $laptopModel = new LaptopModel();
        $penjualanModel = new PenjualanModel();

        // Cari data laptop
        $laptop = $laptopModel->find($idLaptop);

        if (!$laptop) {
            return redirect()->to('/dashboard')->with('error', 'Laptop tidak ditemukan.');
        }

        // Cek stok
        if ($laptop['stok'] <= 0) {
            return redirect()->to('/dashboard')->with('error', 'Stok laptop habis.');
        }

        // Kurangi stok
        $laptopModel->update($idLaptop, ['stok' => $laptop['stok'] - 1]);

        // Simpan transaksi penjualan
        $penjualanModel->save([
            'laptop_id' => $idLaptop,
            'nama_laptop' => $laptop['nama'],
            'harga' => $laptop['harga'],
            'tanggal' => date('Y-m-d H:i:s'),
            'jumlah' => 1,
            'total_harga' => $laptop['harga']
        ]);


        return redirect()->to('/dashboard')->with('success', 'Pembelian berhasil!');
    }
    public function riwayat()
    {
        $penjualanModel = new PenjualanModel();
        $data['riwayat'] = $penjualanModel->orderBy('tanggal', 'DESC')->findAll();
        return view('riwayat_view', $data);
    }

    public function tambahStok()
{
    if (!session()->get('is_admin')) {
        return redirect()->to('/dashboard')->with('error', 'Akses ditolak.');
    }

    $id = $this->request->getPost('id');
    $jumlah = (int)$this->request->getPost('jumlah');

    $laptopModel = new \App\Models\LaptopModel();
    $laptop = $laptopModel->find($id);

    if ($laptop) {
        $laptopModel->update($id, [
            'stok' => $laptop['stok'] + $jumlah
        ]);
        return redirect()->to('/dashboard')->with('message', 'Stok berhasil ditambahkan.');
    }

    return redirect()->to('/dashboard')->with('error', 'Laptop tidak ditemukan.');
}

}
