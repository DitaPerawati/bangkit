<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Riwayat Pesanan</title>
    <link rel="stylesheet" href="<?= base_url('css/sidebar.css') ?>">
    <style>
        * {
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            background: #f4f4f4;
            margin: 0;
            padding: 0;
            display: flex;
            min-height: 100vh;
        }

        .main-content {
            flex-grow: 1;
            margin-left: 0;
            transition: margin-left 0.3s ease;
        }

        .main-content.shifted {
            margin-left: 220px;
        }

        header {
            background-color: rgb(10, 0, 209);
            color: white;
            padding: 20px;
            position: relative;
            text-align: center;
        }

        .menu-toggle {
            position: absolute;
            top: 15px;
            left: 15px;
            font-size: 24px;
            background: none;
            border: none;
            color: white;
            cursor: pointer;
        }

        h2 {
            text-align: center;
            margin: 20px 0;
        }

        .container {
            padding: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            background: white;
            border-radius: 8px;
            overflow: hidden;
        }

        th, td {
            padding: 12px;
            border: 1px solid #ddd;
            text-align: center;
        }

        th {
            background: #0a4dff;
            color: white;
        }

        .btn {
            padding: 6px 12px;
            background: green;
            color: white;
            text-decoration: none;
            border-radius: 4px;
            font-size: 14px;
        }

        .btn.disabled {
            background: gray;
            pointer-events: none;
        }

        .alert-success {
            background-color: #d4edda;
            border: 1px solid #c3e6cb;
            padding: 10px;
            color: #155724;
            margin-bottom: 20px;
            border-radius: 5px;
            text-align: center;
        }

        @media (max-width: 768px) {
            .main-content.shifted {
                margin-left: 0;
            }

            #sidebar {
                width: 180px;
            }
        }
    </style>
</head>
<body>

    <!-- Sidebar -->
    <?= view('sidebar') ?>

    <!-- Main Content -->
    <div class="main-content" id="main">
        <header>
            <button class="menu-toggle" onclick="toggleSidebar()">☰</button>
            <h1>Riwayat Pesanan Anda</h1>
        </header>

        <div class="container">
            <?php if (session()->getFlashdata('success')): ?>
                <div class="alert-success">
                    <?= session()->getFlashdata('success') ?>
                </div>
            <?php endif; ?>

            <table>
                <thead>
                    <tr>
                        <th>Nama Laptop</th>
                        <th>Jumlah</th>
                        <th>Total Harga</th>
                        <th>Tanggal</th>
                        <th>Status</th>
                        <th>Pembayaran</th>
                        <th>Konfirmasi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($pesanan)): ?>
                        <?php foreach ($pesanan as $p): ?>
                            <tr>
                                <td><?= esc($p['nama_laptop']) ?></td>
                                <td><?= esc($p['jumlah']) ?></td>
                                <td>Rp <?= number_format($p['total_harga'], 0, ',', '.') ?></td>
                                <td><?= $p['tanggal'] ?></td>
                                <td><?= ucfirst($p['status']) ?></td>
                                <td><?= ucfirst($p['metode_pembayaran']) ?></td>
                                <td>
                                    <?php if ($p['status'] === 'dikirim'): ?>
                                        <a href="<?= site_url('riwayat/selesai/' . $p['id']) ?>" class="btn">Sudah Diterima</a>
                                    <?php else: ?>
                                        <span class="btn disabled">-</span>
                                    <?php endif; ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="7">Belum ada pesanan.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>

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
