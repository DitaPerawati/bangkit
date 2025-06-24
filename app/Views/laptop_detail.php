<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Detail Produk - Bangkit Computer</title>
    <link rel="stylesheet" href="<?= base_url('css/sidebar.css') ?>">
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
            display: flex;
            flex-direction: column;
        }

        header {
            background-color: rgb(10, 0, 209);
            color: white;
            text-align: center;
            padding: 20px;
        }

        .sub-header {
            background-color: rgb(10, 77, 255);
            padding: 10px;
            color: white;
            font-weight: bold;
            text-align: center;
        }

        .container {
            max-width: 800px;
            margin: 30px auto;
            background: white;
            border-radius: 10px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
            padding: 20px;
        }

        img {
            width: 100%;
            max-width: 300px;
            border-radius: 5px;
            display: block;
            margin: 0 auto 20px;
        }

        h2, h3 {
            text-align: center;
            margin-bottom: 10px;
        }

        p {
            font-size: 16px;
            line-height: 1.5;
        }

        hr {
            margin: 30px 0;
            border: 0;
            border-top: 1px solid #ddd;
        }

        .komentar {
            border-bottom: 1px solid #ccc;
            padding-bottom: 10px;
            margin-bottom: 10px;
        }

        form {
            display: flex;
            flex-direction: column;
        }

        label {
            font-weight: bold;
            margin-top: 10px;
        }

        input[type="text"],
        textarea {
            padding: 8px;
            margin-top: 5px;
            border-radius: 5px;
            border: 1px solid #ccc;
        }

        button {
            margin-top: 15px;
            padding: 10px;
            background-color: rgb(10, 77, 255);
            color: white;
            border: none;
            cursor: pointer;
            border-radius: 5px;
        }

        .footer {
            text-align: center;
            margin-top: auto;
            padding: 20px;
            background-color: #eee;
            font-size: 14px;
        }
    </style>
</head>
<body>

<?= view('sidebar')?>

<div class="main-content">
    <header>
        <button class="menu-toggle" onclick="toggleSidebar()">☰</button>
        <h1>BANGKIT COMPUTER</h1>
    </header>
    <div class="sub-header">DETAIL PRODUK</div>

    <div class="container">
    <a href="javascript:history.back()" class="btn btn-secondary mb-3">Kembali</a>
        <h2><?= $laptop['nama']; ?></h2>
        <img src="<?= base_url('img/laptop/' . $laptop['gambar']) ?>" alt="<?= $laptop['nama'] ?>">

        <p><strong>Spesifikasi:</strong> <?= $laptop['spesifikasi']; ?></p>
        <p><strong>Harga:</strong> Rp <?= number_format($laptop['harga'], 0, ',', '.') ?></p>
        <p><strong>Stok:</strong> <?= $laptop['stok']; ?></p>

        <hr>
        <h3>Komentar Customer</h3>
        <?php foreach ($komentar as $k): ?>
            <div class="komentar">
                <strong><?= esc($k['nama']) ?>:</strong>
                <p><?= esc($k['isi']) ?></p>
            </div>
        <?php endforeach; ?>

        <?php if (session()->get('role')==='customer'): ?>
        <hr>
        <h3>Tambah Komentar</h3>
        <form action="<?= base_url('customer/komen') ?>" method="post">
            <input type="hidden" name="laptop_id" value="<?= $laptop['id'] ?>">
            <label>Nama:</label>
            <input type="text" name="nama" required>
            <label>Komentar:</label>
            <textarea name="isi" rows="3" required></textarea>
            <button type="submit">Kirim</button>
        </form>
            <?php else: ?>
            <p><em>Hanya customer yang dapat menulis komentar.</em></p>
            <?php endif;?>
    </div>

    <div class="footer">
        &copy; <?= date('M Y') ?> Toko Komputer Bangkit. Semua Hak Dilindungi.
    </div>
</div>
<script>
    function toggleSidebar() {
        const sidebar = document.getElementById('sidebar');
        sidebar.classList.toggle('sidebar-closed');
    }
</script>
</body>
</html>