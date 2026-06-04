<?php
session_start();
if (!empty($_SESSION['pengguno'])) { header('Location: see.php'); exit; }
?>
<!DOCTYPE html>
<html lang="id">
<head><meta charset="UTF-8"><title>SMITS App</title><link rel="stylesheet" href="static/style.css"></head>
<body>
  <div class="card center">
    <h1>🎓 SMITS App</h1>
    <p>Sistem Manajemen Informasi Mahasiswa</p>
    <div class="btn-group">
      <a href="login.php" class="btn">Mlebu</a>
      <a href="register.php" class="btn btn-outline">Daftar</a>
    </div>
  </div>
</body>
</html>
