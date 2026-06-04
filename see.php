<?php
session_start();
require 'save.php';
cek_login();
$pengguno    = $_SESSION['pengguno'];
$kabeh_data  = woco_json(FILE_SMITS);
$kabeh_mhs   = $kabeh_data[$pengguno] ?? [];
?>
<!DOCTYPE html>
<html lang="id">
<head><meta charset="UTF-8"><title>Daftar Mahasiswa</title><link rel="stylesheet" href="static/style.css"></head>
<body>
<div class="card wide">
  <div class="header-row">
    <h2>🎓 Daftar Mahasiswa — <?= htmlspecialchars($pengguno) ?></h2>
    <div class="btn-group">
      <a href="input.php" class="btn">+ Tambahi</a>
      <a href="logout.php" class="btn btn-outline">Metu</a>
    </div>
  </div>
  <?php if ($kabeh_mhs): ?>
  <div class="grid">
    <?php foreach ($kabeh_mhs as $siji_mhs): ?>
    <div class="mhs-card">
      <?php
        $gambar = !empty($siji_mhs['foto']) && file_exists(DIR_FOTO . $siji_mhs['foto'])
                  ? 'photos/' . $siji_mhs['foto'] : 'static/default.png';
      ?>
      <img src="<?= $gambar ?>" alt="Foto" class="foto">
      <div class="mhs-info">
        <strong><?= htmlspecialchars($siji_mhs['jeneng_lengkap']) ?></strong>
        <span>NIM: <?= htmlspecialchars($siji_mhs['nim']) ?></span>
        <span>Prodi: <?= htmlspecialchars($siji_mhs['prodi']) ?></span>
      </div>
      <div class="mhs-actions">
        <a href="edit.php?id=<?= $siji_mhs['id'] ?>" class="link-edit">Besuk</a>
        <a href="remove.php?id=<?= $siji_mhs['id'] ?>" class="link-del" onclick="return confirm('Pancen arep di-delete cuk?')">Busak</a>
      </div>
    </div>
    <?php endforeach; ?>
  </div>
  <?php else: ?>
    <p class="empty">Durung onok datane cuk. <a href="input.php">Tambahi saiki</a>!</p>
  <?php endif; ?>
</div>
</body>
</html>
