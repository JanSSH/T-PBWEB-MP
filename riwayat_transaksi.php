<?php
include 'koneksi.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Riwayat Transaksi</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<nav class="navbar navbar-dark bg-dark">
  <div class="container-fluid">
    <a class="navbar-brand" href="etalase.php">SyafiEcell</a>
    <a class="btn btn-outline-light" href="cart.php">Keranjang</a>
  </div>
</nav>

<div class="container mt-5">
  <h2 class="mb-4">Riwayat Transaksi</h2>

  <?php
  $query = mysqli_query($conn, "SELECT * FROM transaksi ORDER BY id_transaksi DESC");
  if (mysqli_num_rows($query) > 0):
    while ($transaksi = mysqli_fetch_assoc($query)):
      $id_transaksi = $transaksi['id_transaksi'];
      $tanggal = $transaksi['tanggal'];
      $total = $transaksi['total'];
  ?>
    <div class="card mb-4">
      <div class="card-header bg-primary text-white">
        <strong>Transaksi #<?= $id_transaksi ?></strong> | Tanggal: <?= $tanggal ?> | Total: Rp <?= number_format($total, 0, ',', '.') ?>
      </div>
      <div class="card-body p-0">
        <table class="table table-bordered mb-0">
          <thead>
            <tr>
              <th>Nama Produk</th>
              <th>Harga</th>
              <th>Jumlah</th>
              <th>Subtotal</th>
            </tr>
          </thead>
          <tbody>
            <?php
            $detail = mysqli_query($conn, "SELECT * FROM transaksi_detail WHERE id_transaksi = $id_transaksi");
            while ($item = mysqli_fetch_assoc($detail)):
            ?>
              <tr>
                <td><?= $item['nama_produk'] ?></td>
                <td>Rp <?= number_format($item['harga'], 0, ',', '.') ?></td>
                <td><?= $item['qty'] ?></td>
                <td>Rp <?= number_format($item['subtotal'], 0, ',', '.') ?></td>
              </tr>
            <?php endwhile; ?>
          </tbody>
        </table>
      </div>
    </div>
  <?php endwhile; else: ?>
    <div class="alert alert-info">Belum ada transaksi.</div>
  <?php endif; ?>
</div>

</body>
</html>
