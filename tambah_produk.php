<?php
include 'koneksi.php';
$edit = false;
$produk = [];

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
  <title><?= $edit ? 'Edit Produk' : 'Tambah Produk' ?></title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
  <h2 class="mb-4"><?= $edit ? 'Edit Produk' : 'Tambah Produk Baru' ?></h2>
  <form action="" method="POST" enctype="multipart/form-data">
    <div class="mb-3">
      <label for="id_produk" class="form-label">ID Produk</label>
      <input type="text" class="form-control" name="id_produk" required 
             value="<?= $edit ? $produk['id_produk'] : '' ?>" <?= $edit ? 'readonly' : '' ?>>
    </div>
    <div class="mb-3">
      <label for="nama_produk" class="form-label">Nama Produk</label>
      <input type="text" class="form-control" name="nama_produk" required 
             value="<?= $edit ? $produk['nama_produk'] : '' ?>">
    </div>
    <div class="mb-3">
      <label for="deskripsi" class="form-label">Deskripsi</label>
      <textarea class="form-control" name="deskripsi" rows="3" required><?= $edit ? $produk['deskripsi'] : '' ?></textarea>
    </div>
    <div class="mb-3">
      <label for="harga_produk" class="form-label">Harga</label>
      <input type="number" class="form-control" name="harga_produk" required 
             value="<?= $edit ? $produk['harga_produk'] : '' ?>">
    </div>
    <div class="mb-3">
      <label for="gambar" class="form-label">Upload Gambar</label>
      <input type="file" class="form-control" name="gambar" accept="image/*">
      <?php if ($edit && $produk['gambar']): ?>
        <p class="mt-2">Gambar saat ini:<br><img src="uploads/<?= $produk['gambar'] ?>" width="150"></p>
      <?php endif; ?>
    </div>
    <button type="submit" class="btn btn-primary"><?= $edit ? 'Update Produk' : 'Simpan Produk' ?></button>
    <a href="produk_admin.php" class="btn btn-secondary">Kembali</a>
    <?php if ($edit): ?>
      <input type="hidden" name="edit" value="1">
    <?php endif; ?>
  </form>
</div>
</body>
</html>
