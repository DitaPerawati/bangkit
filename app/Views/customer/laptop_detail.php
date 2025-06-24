<h2><?= $laptop['nama']; ?></h2>
<img src="<?= base_url('img/laptop/' . $laptop['gambar']) ?>" width="300">

<p><strong>Spesifikasi:</strong> <?= $laptop['spesifikasi']; ?></p>
<p><strong>Harga:</strong> Rp <?= number_format($laptop['harga'], 0, ',', '.') ?></p>
<p><strong>Stok:</strong> <?= $laptop['stok']; ?></p>

<hr>
<h3>Komentar Customer</h3>
<?php foreach ($komentar as $k): ?>
    <div style="border-bottom: 1px solid #ccc; margin-bottom: 10px;">
        <strong><?= esc($k['nama']) ?>:</strong>
        <p><?= esc($k['isi']) ?></p>
    </div>
<?php endforeach; ?>

<hr>
<h3>Tambah Komentar</h3>
<form action="<?= base_url('customer/komen') ?>" method="post">
    <input type="hidden" name="laptop_id" value="<?= $laptop['id'] ?>">
    <label>Nama:</label><br>
    <input type="text" name="nama" required><br>
    <label>Komentar:</label><br>
    <textarea name="isi" rows="3" required></textarea><br>
    <button type="submit">Kirim</button>
</form>
