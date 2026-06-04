<?php
session_start();
require 'save.php';
$tulisan_salah = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $kabeh_pengguno = woco_json(FILE_PENGGUNO);
    $jeneng = trim($_POST['jeneng'] ?? '');
    $sandhi = $_POST['sandhi'] ?? '';
    if (!$jeneng || !$sandhi)          { $tulisan_salah = 'Jeneng karo sandhi ojok dikosongno!'; }
    elseif (isset($kabeh_pengguno[$jeneng])) { $tulisan_salah = 'Jeneng iku wes dienggo wong liyo!'; }
    else {
        $kabeh_pengguno[$jeneng] = $sandhi;
        simpen_json(FILE_PENGGUNO, $kabeh_pengguno);
        $_SESSION['pengguno'] = $jeneng;
        header('Location: see.php'); exit;
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head><meta charset="UTF-8"><title>Daftar</title><link rel="stylesheet" href="static/style.css"></head>
<body>
  <div class="card center">
    <h2>📝 Gawe Akun Anyar</h2>
    <?php if ($tulisan_salah): ?><p class="error"><?= htmlspecialchars($tulisan_salah) ?></p><?php endif; ?>
    <form method="POST">
      <input type="text" name="jeneng" placeholder="Jenengmu sopo?" required>
      <input type="password" name="sandhi" placeholder="Gawe sandhi" required>
      <button class="btn" type="submit">Daftar</button>
    </form>
    <p>Wes duwe akun? <a href="login.php">Mlebu ae</a></p>
  </div>
</body>
</html>
