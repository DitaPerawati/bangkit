<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class LaptopSeeder extends Seeder
{
    public function run()
    {
        // Truncate dulu tabel 'laptops' agar data lama hilang
        $this->db->table('laptops')->truncate();

        $data = [
            ['nama' => 'Asus E203M', 'spesifikasi' => 'Intel N3350 RAM 2 GB SSD 128 GBLayar 11.6” Intel HD 500', 'harga' => 1500000, 'gambar' => 'e203m.jpg', 'stok' => 5],
            ['nama' => 'Asus E210M', 'spesifikasi' => 'Intel N4020RAM 4 GBSSD 256 GBLayar 11.6”Intel UHD 600', 'harga' => 1900000, 'gambar' => 'e210m.jpg', 'stok' => 3],
            ['nama' => 'Dell 5450', 'spesifikasi' => 'Intel Core i7 5600uRAM 8 GBSSD 256 GBLayar 14”Intel HD 5500', 'harga' => 3100000, 'gambar' => '5450I7.jpg', 'stok' => 3],
            ['nama' => 'Dell 7490', 'spesifikasi' => 'Intel Core i5 8350uRAM 8 GBSSD 256 GBLayar 14” FHDIntel UHD 620Keyboard Backlit', 'harga' => 3800000, 'gambar' => 'DELL7490.jpg', 'stok' => 2],
            ['nama' => 'Dell 7490 Touchscreen', 'spesifikasi' => 'Intel Core i5 8350uRAM 16 GBSSD 256 GBLayar 14” FHD TouchscreenIntel UHD 620Keyboard Backlit', 'harga' => 4300000, 'gambar' => 'DELL7490TouchScreen.jpg', 'stok' => 4],
            ['nama' => 'Lenovo 14ibr', 'spesifikasi' => 'Intel N3060RAM 4 GBSSD 256 GBLayar 14”Intel HD Graphic', 'harga' => 2300000, 'gambar' => '14ibr.jpg', 'stok' => 2],
            ['nama' => 'Lenovo T460', 'spesifikasi' => 'Intel Core i5 6300uRAM 16 GBSSD 256 GBLayar 14”Intel HD 520', 'harga' => 3600000, 'gambar' => 't460.jpg', 'stok' => 3],
            ['nama' => 'Lenovo X260', 'spesifikasi' => 'Intel Core i7 6600uRAM 8 GBSSD 256 GBLayar 12.5”Intel HD 520', 'harga' => 3300000, 'gambar' => 'X260I7.jpg', 'stok' => 4],
            ['nama' => 'Lenovo X280', 'spesifikasi' => 'Intel Core i5 8350uRAM 8 GBSSD 256 GBLayar 12.5”Intel UHD 620Keyboard Backlit', 'harga' => 3600000, 'gambar' => 'x280.jpg', 'stok' => 4],
        ];

        $this->db->table('laptops')->insertBatch($data);
    }
}
