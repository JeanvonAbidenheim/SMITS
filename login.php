<?php
session_start();
require 'save.php';
$tulisan_salah = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $kabeh_pengguno = woco_json(FILE_PENGGUNO);
    $jeneng  = trim($_POST['jeneng'] ?? '');
    $sandhi  = $_POST['sandhi'] ?? '';
    if (isset($kabeh_pengguno[$jeneng]) && $kabeh_pengguno[$jeneng] === $sandhi) {
        $_SESSION['pengguno'] = $jeneng;
        header('Location: see.php'); exit;
    }
    $tulisan_salah = 'Jeneng utowo sandhi salah cuk!';
}
?>
<!DOCTYPE html>
<html lang="id">
<head><meta charset="UTF-8"><title>Mlebu</title><link rel="stylesheet" href="static/style.css"></head>
<body>
  <div class="card center">
    <h2>🔐 Mlebu</h2>
    <?php if ($tulisan_salah): ?><p class="error"><?= htmlspecialchars($tulisan_salah) ?></p><?php endif; ?>
    <form method="POST">
      <input type="text" name="jeneng" placeholder="Jenengmu sopo?" required>
      <input type="password" name="sandhi" placeholder="Sandhine opo?" required>
      <button class="btn" type="submit">Mlebu</button>
    </form>
    <p>Durung duwe akun? <a href="register.php">Daftar ndisik</a></p>
  </div>
</body>
</html>
