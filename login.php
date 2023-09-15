<?php
function checkCredentials($username, $password) {
    $users = file('users.txt', FILE_IGNORE_NEW_LINES);
    foreach ($users as $user) {
        list($id, $storedUsername, $storedPassword, $nama, $nomor_hp, $alamat) = explode(':', $user);
        if ($username == $storedUsername && $password == $storedPassword) {
            return $id;
        }
    }
    return false;
}

$username = $_POST['username'];
$password = $_POST['password'];

// Periksa kredensial
$id = checkCredentials($username, $password);

if ($id !== false) {
    session_start();
    $_SESSION['id'] = $id;
    
    setcookie('userID', $id, time() + (3600 * 24), '/');
    
    header("Location: profile.php");
    exit;
} else {
    echo "Login gagal. Cek kembali username dan password Anda.";
}
?>