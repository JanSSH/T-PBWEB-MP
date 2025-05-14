<?php
session_start();
include 'koneksi.php';

if (empty($_SESSION['cart'])) {
  echo "Keranjang kosong.";
  exit();
}

$total = 0;
foreach ($_SESSION['cart'] as $id_produk => $qty) {
$result = mysqli_query($conn, "SELECT harga_produk FROM produk WHERE id_produk = '$id_produk'");
  $row = mysqli_fetch_assoc($result);
  if (!$row) continue;

  $total += $row['harga_produk'] * $qty;
}

$tanggal = date('Y-m-d H:i:s');
mysqli_query($conn, "INSERT INTO transaksi (tanggal, total) VALUES ('$tanggal', $total)");
$id_transaksi = mysqli_insert_id($conn);

foreach ($_SESSION['cart'] as $id_produk => $qty) {
  $query = mysqli_query($conn, "SELECT * FROM produk WHERE id_produk = '$id_produk'");
  $row = mysqli_fetch_assoc($query);
  if (!$row) continue;

  $nama = $row['nama_produk'];
  $harga = $row['harga_produk'];
  $subtotal = $harga * $qty;

  mysqli_query($conn, "INSERT INTO transaksi_detail (id_transaksi, id_produk, nama_produk, harga, qty, subtotal)
    VALUES ($id_transaksi, $id_produk, '$nama', $harga, $qty, $subtotal)");
}

unset($_SESSION['cart']);

echo "<script>alert('Checkout berhasil!');window.location='etalase.php';</script>";
?>
