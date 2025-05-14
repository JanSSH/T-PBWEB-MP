<?php
session_start();
include 'koneksi.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Keranjang Belanja</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<nav class="navbar navbar-dark bg-dark">
  <div class="container-fluid">
    <a class="navbar-brand" href="etalase.php">SyafiEcell</a>
    <a class="btn btn-outline-light" href="etalase.php">Kembali ke Etalase</a>
    <a href="riwayat_transaksi.php" class="btn btn-outline-info">Riwayat Transaksi</a>
  </div>
</nav>

<div class="container mt-5">
  <h2 class="mb-4">Keranjang Anda</h2>
  <?php if (!empty($_SESSION['cart'])): ?>
    <table class="table table-bordered">
      <thead>
        <tr>
          <th>Nama Produk</th>
          <th>Harga</th>
          <th>Jumlah</th>
          <th>Subtotal</th>
          <th>Aksi</th>
        </tr>
      </thead>
      <tbody>
        <?php
        $total = 0;
        foreach ($_SESSION['cart'] as $id => $qty):
          $query = mysqli_query($conn, "SELECT * FROM produk WHERE id_produk = '$id'");
          $row = mysqli_fetch_assoc($query);
          if (!$row) continue;

          $nama = $row['nama_produk'];
          $harga = $row['harga_produk'];
          $subtotal = $harga * $qty;
          $total += $subtotal;
        ?>
        <tr>
          <td><?= $nama ?></td>
          <td>Rp <?= number_format($harga, 0, ',', '.') ?></td>
          <td>
            <form action="proses_cart.php" method="POST" class="d-flex">
              <input type="hidden" name="id" value="<?= $id ?>">
              <input type="hidden" name="action" value="update">
              <input type="number" name="qty" value="<?= $qty ?>" min="1" class="form-control me-2" style="width:80px;">
              <button type="submit" class="btn btn-sm btn-success">Update</button>
            </form>
          </td>
          <td>Rp <?= number_format($subtotal, 0, ',', '.') ?></td>
          <td>
            <form action="proses_cart.php" method="POST">
              <input type="hidden" name="id" value="<?= $id ?>">
              <input type="hidden" name="action" value="delete">
              <button type="submit" class="btn btn-sm btn-danger">Hapus</button>
            </form>
          </td>
        </tr>
        <?php endforeach; ?>
        <tr>
          <th colspan="3">Total</th>
          <th colspan="2">Rp <?= number_format($total, 0, ',', '.') ?></th>
        </tr>
      </tbody>
    </table>
    <form action="checkout.php" method="POST">
  <button type="submit" class="btn btn-success">Checkout Sekarang</button>
</form>

  <?php else: ?>
    <div class="alert alert-info">Keranjang kosong.</div>
  <?php endif; ?>
  
</div>
</body>
</html>

