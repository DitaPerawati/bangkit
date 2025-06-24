<?php
namespace App\Controllers;

use App\Models\LaptopModel;

class ProductController extends BaseController
{
    public function index()
    {
        $model = new LaptopModel();
        $data['products'] = $model->findAll();

        return view('dashboard', $data);
    }

    public function addStock($id)
{
    if (session()->get('role') !== 'admin') {
        return redirect()->to('/login')->with('error', 'Akses ditolak');
    }

    $model = new LaptopModel();
    $product = $model->find($id);

    if (!$product) {
        return redirect()->back()->with('error', 'Produk tidak ditemukan');
    }

    return view('tambah', ['product' => $product]);
}

public function processAddStock($id)
{
    if (session()->get('role') !== 'admin') {
        return redirect()->to('/login')->with('error', 'Akses ditolak');
    }

    $model = new LaptopModel();
    $product = $model->find($id);

    if (!$product) {
        return redirect()->back()->with('error', 'Produk tidak ditemukan');
    }

    $amount = (int) $this->request->getPost('amount');
    if ($amount <= 0) {
        return redirect()->back()->with('error', 'Jumlah harus lebih besar dari 0');
    }

    $newStock = $product['stok'] + $amount;
    $model->update($id, ['stok' => $newStock]);

    return redirect()->to(site_url('products'))->with('success', 'Stok berhasil ditambah');
}


    public function list()
    {
        // Cek apakah yang akses adalah admin
        if (session()->get('role') !== 'admin') {
            return redirect()->to('/login')->with('error', 'Akses ditolak');
        }

        $model = new LaptopModel();
        $data['products'] = $model->findAll();

        return view('products/product', $data);
    }
    
    // app/Controllers/ProductController.php    

public function delete($id)
{
    // Cek akses admin
    if (session()->get('role') !== 'admin') {
        return redirect()->to('/login')->with('error', 'Akses ditolak');
    }

    $model = new LaptopModel();
    $product = $model->find($id);

    if (!$product) {
        return redirect()->back()->with('error', 'Produk tidak ditemukan');
    }

    // Hapus produk
    $model->delete($id);

    return redirect()->to(site_url('products'))->with('success', 'Produk berhasil dihapus');
}

public function processReduceStock($id)
{

    if (session()->get('role') !== 'admin') {
        return redirect()->to('/login')->with('error', 'Akses ditolak');
    }

    $model = new LaptopModel();
    $product = $model->find($id);

    if (!$product) {
        return redirect()->back()->with('error', 'Produk tidak ditemukan');
    }

    
    $amount = (int) $this->request->getPost('amount');
    if ($amount <= 0) {
        return redirect()->back()->with('error', 'Jumlah harus lebih besar dari 0');
    }

    
    if ($amount > $product['stok']) {
        return redirect()->back()->with('error', 'Jumlah pengurangan melebihi stok tersedia (Stok: '.$product['stok'].')');
    }

    
    $newStock = $product['stok'] - $amount;
    $model->update($id, ['stok' => $newStock]);

    
    return redirect()->to(site_url('products'))->with('success', 'Stok berhasil dikurangi (Stok baru: '.$newStock.')');
}

public function detail($id)
{
    $productModel = new \App\Models\ProductModel();
    $komentarModel = new \App\Models\KomentarModel();

    $data['laptop'] = $productModel->find($id);
    $data['komentar'] = $komentarModel
        ->where('laptop_id', $id)
        ->orderBy('created_at', 'DESC')
        ->findAll();

    return view('bangkit/detail', $data);
}

public function komen()
{
    $komentarModel = new \App\Models\KomentarModel();
    $komentarModel->insert([
        'laptop_id' => $this->request->getPost('laptop_id'),
        'nama'      => $this->request->getPost('nama'),
        'isi'       => $this->request->getPost('isi'),
    ]);

    return redirect()->to('/bangkit/detail/' . $this->request->getPost('laptop_id'));
}

}