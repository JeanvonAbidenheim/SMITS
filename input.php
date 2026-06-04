<?php
session_start();
require 'save.php';
cek_login();
$tulisan_salah = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $pengguno   = $_SESSION['pengguno'];
    $kabeh_data = woco_json(FILE_SMITS);
    $gambar     = '';

    if (!empty($_FILES['foto']['name'])) {
        $ekstensi      = strtolower(pathinfo($_FILES['foto']['name'], PATHINFO_EXTENSION));
        $ekstensi_oleh = ['jpg', 'jpeg', 'png', 'webp'];
        if (!in_array($ekstensi, $ekstensi_oleh)) {
            $tulisan_salah = 'Format fotone kudu JPG, PNG, utowo WEBP cuk!';
        } else {
            $gambar = uniqid('foto_') . '.' . $ekstensi;
            move_uploaded_file($_FILES['foto']['tmp_name'], DIR_FOTO . $gambar);
        }
    }

    if (!$tulisan_salah) {
        $kabeh_data[$pengguno][] = [
            'id'            => substr(md5(uniqid()), 0, 8),
            'jeneng_lengkap'=> trim($_POST['jeneng_lengkap']),
            'nim'           => trim($_POST['nim']),
            'prodi'         => trim($_POST['prodi']),
            'foto'          => $gambar,
        ];
        simpen_json(FILE_SMITS, $kabeh_data);
        header('Location: see.php'); exit;
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head><meta charset="UTF-8"><title>Tambah Mahasiswa</title><link rel="stylesheet" href="static/style.css"></head>
<body>
<div class="card">
  <h2>➕ Tambahi Mahasiswa</h2>
  <?php if ($tulisan_salah): ?><p class="error"><?= htmlspecialchars($tulisan_salah) ?></p><?php endif; ?>
  <form method="POST" enctype="multipart/form-data">
    <label>Jeneng Lengkap</label>
    <input type="text" name="jeneng_lengkap" placeholder="Jenenge sopo?" required>
    <label>NIM</label>
    <input type="text" name="nim" placeholder="Nomor Induk Mahasiswane" required>
    <label>Program Studi</label>
    <input type="text" name="prodi" placeholder="Cth: Teknik Informatika" required>
    <label>Foto Awake Dewe</label>
    <input type="file" name="foto" accept="image/*">
    <div class="btn-group" style="justify-content:flex-start">
      <button class="btn" type="submit">Simpen</button>
      <a href="see.php" class="btn btn-outline">Gak Sido</a>
    </div>
  </form>
</div>
</body>
</html>
