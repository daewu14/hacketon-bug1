<?php
session_start();

function getUserInfo($id) {
    $users = file('users.txt', FILE_IGNORE_NEW_LINES);
    foreach ($users as $user) {
        list($userID, $username, $password, $nama, $nomor_hp, $alamat) = explode(':', $user);
        if ($id == $userID) {
            return [
                'nama' => $nama,
                'nomor_hp' => $nomor_hp,
                'alamat' => $alamat,
            ];
        }
    }
    return false;
}

if (!isset($_SESSION['id']) && !isset($_COOKIE['userID'])) {
    header("Location: index.php");
    exit;
}

$id = isset($_COOKIE['userID']) ? $_COOKIE['userID'] : $_SESSION['id'];

$userInfo = getUserInfo($id);

if ($userInfo) {
    echo "<h1>Akun Kamu</h1>";
    echo "<b>Nama         :</b> " . $userInfo['nama'] . "<br>";
    echo "<b>Nomor        :</b> " . $userInfo['nomor_hp'] . "<br>";
    echo "<b>Alamat       :</b> " . $userInfo['alamat'] . "<br>";
} else {
    echo "Pengguna tidak ditemukan.";
}
?>