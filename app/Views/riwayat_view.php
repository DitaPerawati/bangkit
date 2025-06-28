<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Riwayat Transaksi</title>
    <!-- Load CSS Sidebar -->
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
        .menu-toggle {
            background: none;
            border: none;
            color: white;
            font-size: 24px;
            cursor: pointer;
            position: absolute;
            left: 20px;
            top: 50%;
            transform: translateY(-50%);
        }
    </style>
</head>
<body>
    <!-- Load Sidebar -->
    <?= view('sidebar') ?>

    <!-- Main Content -->
    <div class="main-content" id="main">
        <header>
            <button class="menu-toggle" onclick="toggleSidebar()">☰</button>
            <h1>Riwayat Transaksi</h1>
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
                        <th>ID</th>
                        <th>Nama Laptop</th>
                        <th>Harga</th>
                        <th>Tanggal</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($riwayat as $r): ?>
                        <tr>
                            <td><?= esc($r['id']) ?></td>
                            <td><?= esc($r['nama_laptop']) ?></td>
                            <td>Rp <?= number_format($r['harga'], 0, ',', '.') ?></td>
                            <td><?= esc($r['tanggal']) ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>

            <a class="btn btn-secondary mt-3" href="<?= site_url('dashboard') ?>">Kembali ke Beranda</a>
        </div>
    </div>

    <!-- JavaScript untuk Sidebar -->
    <script>
        function toggleSidebar() {
            const sidebar = document.getElementById('sidebar');
            const main = document.getElementById('main');
            sidebar.classList.toggle('active');
            if (main) {
                main.classList.toggle('shifted');
            }
        }
    </script>



</body>
</html>