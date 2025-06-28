<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Daftar Laptop</title>
    <link rel="stylesheet" href="<?= base_url('css/sidebar.css') ?>">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f5f5f5;
            margin: 0;
            padding: 0;
            display: flex;
            min-height: 100vh;
        }
        .main-content {
            flex-grow: 1;
            padding: 20px;
        }
        header {
            background-color: rgb(19, 92, 250);
            color: white;
            text-align: center;
            padding: 20px;
            position: relative;
        }
        .container {
            background: white;
            border-radius: 8px;
            padding: 20px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <!-- Load Sidebar (hanya sekali) -->
    <?= view('sidebar') ?>

    <!-- Main Content -->
    <div class="main-content" id="main">
        <header>
            <button class="menu-toggle" onclick="toggleSidebar()">☰</button>
            <h1>Daftar Laptop</h1>
        </header>
        
        <div class="container">
            <?php if (session()->getFlashdata('success')): ?>
                <div class="alert alert-success"><?= session()->getFlashdata('success') ?></div>
            <?php endif ?>

            <?php if (session()->getFlashdata('error')): ?>
                <div class="alert alert-danger"><?= session()->getFlashdata('error') ?></div>
            <?php endif ?>

            <table class="table table-bordered table-striped">
                <thead class="table-dark">
                    <tr>
                        <th>Nama</th>
                        <th>Spesifikasi</th>
                        <th>Harga</th>
                        <th>Stok</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($products as $product): ?>
                        <tr>
                            <td><?= esc($product['nama']) ?></td>
                            <td><?= esc($product['spesifikasi']) ?></td>
                            <td>Rp <?= number_format($product['harga'], 0, ',', '.') ?></td>
                            <td><?= esc($product['stok']) ?></td>
                            <td>
                                <a class="btn btn-sm btn-primary" 
                                   href="<?= site_url('products/addStock/' . $product['id']) ?>">
                                    Kelola Stok
                                </a>
                            </td>
                        </tr>
                    <?php endforeach ?>
                </tbody>
            </table>

            <a class="btn btn-secondary mt-3" href="<?= site_url('dashboard') ?>">Kembali</a>
        </div>
    </div>

    <!-- JavaScript untuk Sidebar -->
    <script>
        function toggleSidebar() {
            const sidebar = document.getElementById('sidebar');
            const main = document.getElementById('main');
            sidebar.classList.toggle('active');
            main.classList.toggle('shifted');
        }
    </script>
</body>
</html>