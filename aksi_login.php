<?php
session_start();
include 'koneksi.php'; // Pastikan koneksi ke database sudah benar

$username = $_POST['username'];
$password = md5($_POST['password']); // Menggunakan MD5 untuk mengenkripsi password

// Menjalankan query untuk mencocokkan username dan password
$sql = mysqli_query($koneksi, "SELECT * FROM user WHERE username='$username' AND password='$password'");

// Mengecek apakah query berhasil
if ($sql === false) {
    die("Query gagal: " . mysqli_error($koneksi)); // Menampilkan pesan error jika query gagal
}

// Menghitung jumlah baris hasil query
$cek = mysqli_num_rows($sql);

if ($cek > 0) {
    // Jika username dan password cocok
    $_SESSION['username'] = $username;
    $_SESSION['status'] = 'login';
    echo "<script>
    alert('Login berhasil');
    location.href='../admin/index.php';
    </script>";
} else {
    // Jika login gagal, username atau password salah
    echo "<script>
    alert('Username atau Password salah!');
    location.href='../login.php';
    </script>";
}

mysqli_close($koneksi); // Menutup koneksi setelah selesai
?>
