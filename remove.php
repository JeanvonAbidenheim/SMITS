<?php
session_start();
require 'save.php';
cek_login();
$pengguno   = $_SESSION['pengguno'];
$id_dibusak = $_GET['id'] ?? '';
$kabeh_data = woco_json(FILE_SMITS);

foreach ($kabeh_data[$pengguno] ?? [] as $siji_mhs) {
    if ($siji_mhs['id'] === $id_dibusak && $siji_mhs['foto'] && file_exists(DIR_FOTO . $siji_mhs['foto'])) {
        unlink(DIR_FOTO . $siji_mhs['foto']);
    }
}

$kabeh_data[$pengguno] = array_values(
    array_filter($kabeh_data[$pengguno] ?? [], fn($siji_mhs) => $siji_mhs['id'] !== $id_dibusak)
);
simpen_json(FILE_SMITS, $kabeh_data);
header('Location: see.php');
exit;
