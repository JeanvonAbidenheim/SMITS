<?php
session_start();
require 'save.php';
cek_login();
$pengguno   = $_SESSION['pengguno'];
$kabeh_data = woco_json(FILE_SMITS);
$id_dicari  = $_GET['id'] ?? '';
$posisi     = array_search($id_dicari, array_column($kabeh_data[$pengguno] ?? [], 'id'));
if ($posisi === false) { header('Location: see.php'); exit; }
$siji_mhs      = &$kabeh_data[$pengguno][$posisi];
$tulisan_salah = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!empty($_FILES['foto']['name'])) {
        $ekstensi      = strtolower(pathinfo($_FILES['foto']['name'], PATHINFO_EXTENSION));
        $ekstensi_oleh = ['jpg', 'jpeg', 'png', 'webp'];
        if (!in_array($ekstensi, $ekstensi_oleh)) {
            $tulisan_salah = 'Format fotone kudu JPG, PNG, utowo WEBP cuk!';
        } else {
            if ($siji_mhs['foto'] && file_exists(DIR_FOTO . $siji_mhs['foto'])) unlink(DIR_FOTO . $siji_mhs['foto']);
            $siji_mhs['foto'] = uniqid('foto_') . '.' . $ekstensi;
            move_uploaded_file($_FILES['foto']['tmp_name'], DIR_FOTO . $siji_mhs['foto']);
        }
    }
    if (!$tulisan_salah) {
        $siji_mhs['jeneng_lengkap'] = trim($_POST['jeneng_lengkap']);
        $siji_mhs['nim']            = trim($_POST['nim']);
        $siji_mhs['prodi']          = trim($_POST['prodi']);
        simpen_json(FILE_SMITS, $kabeh_data);
        header('Location: see.php'); exit;
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head><meta charset="UTF-8"><title>Besuki Mahasiswa</title><link rel="stylesheet" href="static/style.css"></head>
<body>
<div class="card">
  <h2>✏️ Besuki Mahasiswa</h2>
  <?php if ($tulisan_salah): ?><p class="error"><?= htmlspecialchars($tulisan_salah) ?></p><?php endif; ?>
  <?php if ($siji_mhs['foto'] && file_exists(DIR_FOTO . $siji_mhs['foto'])): ?>
    <img src="photos/<?= $siji_mhs['foto'] ?>" class="foto-preview">
  <?php endif; ?>
  <form method="POST" enctype="multipart/form-data">
    <label>Jeneng Lengkap</label>
    <input type="text" name="jeneng_lengkap" value="<?= htmlspecialchars($siji_mhs['jeneng_lengkap']) ?>" required>
    <label>NIM</label>
    <input type="text" name="nim" value="<?= htmlspecialchars($siji_mhs['nim']) ?>" required>
    <label>Program Studi</label>
    <input type="text" name="prodi" value="<?= htmlspecialchars($siji_mhs['prodi']) ?>" required>
    <label>Ganti Foto <small>(kosongno nek gak arep ganti)</small></label>
    <input type="file" name="foto" accept="image/*">
    <div class="btn-group" style="justify-content:flex-start">
      <button class="btn" type="submit">Simpen</button>
      <a href="see.php" class="btn btn-outline">Gak Sido</a>
    </div>
  </form>
</div>
</body>
</html>
