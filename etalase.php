<?php
session_start();
include 'koneksi.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Etalase Accessoris HP</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<nav class="navbar navbar-dark bg-dark">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">SyafiEcell</a>
    <a class="btn btn-outline-light" href="cart.php">Lihat Keranjang</a>
    <a href="tambah_produk.php" class="btn btn-success">+ Tambah Produk</a>
  </div>
</nav>

<div class="container mt-5">
  <h2 class="mb-4">Etalase Produk Accessoris HP</h2>
  <div class="row">
    <?php
    $query = mysqli_query($conn, "SELECT * FROM produk");
    while ($p = mysqli_fetch_assoc($query)) {
      echo "
      <div class='col-md-4'>
        <div class='card mb-4'>
          <img src='uploads/{$p['gambar']}' class='card-img-top' alt='{$p['nama_produk']}' height='200'>
          <div class='card-body'>
            <h5 class='card-title'>{$p['nama_produk']}</h5>
            <p class='card-text'>{$p['deskripsi']}</p>
            <p class='card-text'><strong>Rp " . number_format($p['harga_produk'], 0, ',', '.') . "</strong></p>
            <form action='proses_cart.php' method='POST'>
              <input type='hidden' name='id' value='{$p['id_produk']}'>
              <input type='hidden' name='action' value='add'>
              <button type='submit' class='btn btn-primary'>Tambah ke Keranjang</button>
            </form>
          </div>
        </div>
      </div>";
    }
    ?>
  </div>
</div>
</body>
</html>
