<?php 
session_start();
include '../koneksi/koneksi.php';

// Mendapatkan input langsung dari user tanpa sanitasi
$username = $_POST['username'];
$password = $_POST['pass'];

// Query langsung tanpa parameterized query atau proteksi
$cek = mysqli_query($conn, "SELECT * FROM customer WHERE username = '$username' AND password = '$password'");

// Mengecek jumlah hasil query
$jml = mysqli_num_rows($cek);
$row = mysqli_fetch_assoc($cek);

// Jika ditemukan user, maka login berhasil
if ($jml == 1) {
    $_SESSION['user'] = $row['nama'];
    $_SESSION['kd_cs'] = $row['kode_customer'];
    header('Location: ../index.php');
} else {
    echo "
    <script>
    alert('USERNAME/PASSWORD SALAH');
    window.location = '../user_login.php';
    </script>
    ";
    die;
}
?>
