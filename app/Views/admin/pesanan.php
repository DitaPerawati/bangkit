<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Daftar Pesanan - Admin</title>
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

        .container {
            max-width: 1000px;
            margin: 0 auto;
            padding: 20px;
        }

        header {
            background-color: rgb(19, 92, 250); /* Sesuai style product */
            color: white;
            padding: 20px;
            position: relative;
            border-radius: 8px;
            text-align: center;
            margin-bottom: 20px;
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

        .table-wrapper {
            background: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0,0,0,0.05);
        }

        h2 {
            text-align: center;
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            padding: 10px;
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
            display: inline-block;
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
    <div class="container">
        <!-- Header dalam container agar tidak full -->
        <header>
            <button class="menu-toggle" onclick="toggleSidebar()">☰</button>
            <h1>Daftar Pesanan Masuk</h1>
        </header>

        <div class="table-wrapper">

            <?php if (session()->getFlashdata('success')): ?>
                <div class="alert-success">
                    <?= session()->getFlashdata('success') ?>
                </div>
            <?php endif; ?>

            <table>
                <thead>
                    <tr>
                        <th>Nama Customer</th>
                        <th>Nama Laptop</th>
                        <th>Jumlah</th>
                        <th>Total Harga</th>
                        <th>Metode Pembayaran</th>
                        <th>Tanggal</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($pesanan as $p): ?>
                    <tr>
                        <td><?= esc($p['username']) ?></td>
                        <td><?= esc($p['nama_laptop']) ?></td>
                        <td><?= esc($p['jumlah']) ?></td>
                        <td>Rp <?= number_format($p['total_harga'], 0, ',', '.') ?></td>
                        <td><?= ucfirst($p['metode_pembayaran']) ?></td>
                        <td><?= $p['tanggal'] ?></td>
                        <td><?= ucfirst($p['status']) ?></td>
                        <td>
                            <?php if ($p['status'] === 'menunggu'): ?>
                                <a href="<?= site_url('admin/pesanan/konfirmasi/' . $p['id']) ?>" class="btn">Konfirmasi</a>
                            <?php elseif ($p['status'] === 'dikirim'): ?>
                                <span class="btn disabled">Dikirim</span>
                            <?php elseif ($p['status'] === 'selesai'): ?>
                                <span class="btn disabled">Selesai</span>
                            <?php endif; ?>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>

        </div>
    </div>
</div>

<!-- JS Toggle Sidebar -->
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
