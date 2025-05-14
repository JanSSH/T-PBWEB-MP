<?php
include 'koneksi.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $id_produk = $_POST['id_produk'];
  $nama_produk = $_POST['nama_produk'];
  $deskripsi = $_POST['deskripsi'];
  $harga = $_POST['harga_produk'];

  $nama_file = $_FILES['gambar']['name'];
  $tmp_file = $_FILES['gambar']['tmp_name'];
  $folder = 'uploads/';

  if (move_uploaded_file($tmp_file, $folder . $nama_file)) {
    $query = "INSERT INTO produk (id_produk, nama_produk, deskripsi, harga_produk, gambar)
              VALUES ('$id_produk', '$nama_produk', '$deskripsi', $harga, '$nama_file')";
    $result = mysqli_query($conn, $query);

    if ($result) {
      echo "<script>alert('Produk berhasil ditambahkan!'); window.location='etalase.php';</script>";
    } else {
      echo "Gagal menyimpan ke database: " . mysqli_error($conn);
    }
  } else {
    echo "Gagal upload gambar.";
  }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Tambah Produk</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-5">
  <h2 class="mb-4">Tambah Produk Baru</h2>
  <form action="" method="POST" enctype="multipart/form-data">
    <div class="mb-3">
      <label for="id_produk" class="form-label">ID Produk</label>
      <input type="text" class="form-control" name="id_produk" required>
    </div>
    <div class="mb-3">
      <label for="nama_produk" class="form-label">Nama Produk</label>
      <input type="text" class="form-control" name="nama_produk" required>
    </div>
    <div class="mb-3">
      <label for="deskripsi" class="form-label">Deskripsi</label>
      <textarea class="form-control" name="deskripsi" rows="3" required></textarea>
    </div>
    <div class="mb-3">
      <label for="harga_produk" class="form-label">Harga</label>
      <input type="number" class="form-control" name="harga_produk" required>
    </div>
    <div class="mb-3">
      <label for="gambar" class="form-label">Upload Gambar</label>
      <input type="file" class="form-control" name="gambar" accept="image/*" required>
    </div>
    <button type="submit" class="btn btn-primary">Simpan Produk</button>
    <a href="etalase.php" class="btn btn-secondary">Kembali</a>
  </form>
</div>

</body>
</html>
