<?php
include 'koneksi.php';
$edit = false;
$produk = [];

if (isset($_GET['hapus'])) {
  $id = $_GET['hapus'];
  $hapus = mysqli_query($conn, "DELETE FROM produk WHERE id_produk = '$id'");
  if ($hapus) {
    echo "<script>alert('Produk berhasil dihapus!'); window.location='produk_admin.php';</script>";
    exit;
  } else {
    echo "Gagal menghapus produk: " . mysqli_error($conn);
    exit;
  }
}

if (isset($_GET['id'])) {
  $edit = true;
  $id_produk = $_GET['id'];
  $result = mysqli_query($conn, "SELECT * FROM produk WHERE id_produk = '$id_produk'");
  $produk = mysqli_fetch_assoc($result);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $id_produk = $_POST['id_produk'];
  $nama_produk = $_POST['nama_produk'];
  $deskripsi = $_POST['deskripsi'];
  $harga = $_POST['harga_produk'];

  $gambar = '';
  if (!empty($_FILES['gambar']['name'])) {
    $nama_file = $_FILES['gambar']['name'];
    $tmp_file = $_FILES['gambar']['tmp_name'];
    $folder = 'uploads/';
    if (move_uploaded_file($tmp_file, $folder . $nama_file)) {
      $gambar = $nama_file;
    } else {
      echo "Gagal upload gambar.";
      exit;
    }
  }

  if (isset($_POST['edit'])) {
    $update_query = "UPDATE produk SET 
                      nama_produk = '$nama_produk',
                      deskripsi = '$deskripsi',
                      harga_produk = $harga";
    if ($gambar != '') {
      $update_query .= ", gambar = '$gambar'";
    }
    $update_query .= " WHERE id_produk = '$id_produk'";
    $result = mysqli_query($conn, $update_query);
    $msg = "Produk berhasil diperbarui!";
  } else {
    $query = "INSERT INTO produk (id_produk, nama_produk, deskripsi, harga_produk, gambar)
              VALUES ('$id_produk', '$nama_produk', '$deskripsi', $harga, '$gambar')";
    $result = mysqli_query($conn, $query);
    $msg = "Produk berhasil ditambahkan!";
  }

  if ($result) {
    echo "<script>alert('$msg'); window.location='produk_admin.php';</script>";
  } else {
    echo "Gagal menyimpan ke database: " . mysqli_error($conn);
  }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Manajemen Produk</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<nav class="navbar navbar-dark bg-dark">
  <div class="container-fluid">
    <a class="navbar-brand" href="etalase.php">SyafiEcell</a>
    <a class="btn btn-outline-light" href="etalase.php">Etalase</a>
  </div>
</nav>

<div class="container mt-5">
  <h2 class="mb-4">Manajemen Produk</h2>
  <a href="tambah_produk.php" class="btn btn-success mb-3">+ Tambah Produk</a>

  <table class="table table-bordered">
    <thead>
      <tr>
        <th>ID</th>
        <th>Nama</th>
        <th>Harga</th>
        <th>Gambar</th>
        <th>Aksi</th>
      </tr>
    </thead>
    <tbody>
      <?php
      $result = mysqli_query($conn, "SELECT * FROM produk ORDER BY id_produk ASC");
      while ($row = mysqli_fetch_assoc($result)) {
        echo "<tr>
                <td>{$row['id_produk']}</td>
                <td>{$row['nama_produk']}</td>
                <td>Rp " . number_format($row['harga_produk'], 0, ',', '.') . "</td>
                <td><img src='uploads/{$row['gambar']}' width='60'></td>
                <td>
                  <a href='tambah_produk.php?id={$row['id_produk']}' class='btn btn-sm btn-warning'>Edit</a>
                  <a href='produk_admin.php?hapus={$row['id_produk']}' class='btn btn-sm btn-danger' onclick=\"return confirm('Yakin ingin menghapus?')\">Hapus</a>
                </td>
              </tr>";
      }
      ?>
    </tbody>
  </table>
</div>
</body>
</html>
