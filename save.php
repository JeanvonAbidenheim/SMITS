<?php
define('FILE_PENGGUNO', __DIR__ . '/users.json');
define('FILE_SMITS',    __DIR__ . '/smits.json');
define('DIR_FOTO',      __DIR__ . '/photos/');

function woco_json($file) {
    if (!file_exists($file)) return [];
    return json_decode(file_get_contents($file), true) ?? [];
}

function simpen_json($file, $isine) {
    file_put_contents($file, json_encode($isine, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
}

function cek_login() {
    if (empty($_SESSION['pengguno'])) {
        header('Location: index.php'); exit;
    }
}
