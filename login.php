<?php 
session_start();
include '../koneksi/koneksi.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Mengambil input dari user
    $username = $_POST['username'];
    $password = $_POST['pass'];

    // Menggunakan Prepared Statements untuk mencegah SQL Injection
    $stmt = $conn->prepare("SELECT * FROM customer WHERE username = ? AND password = ?");
    $stmt->bind_param("ss", $username, $password);

    // Eksekusi query
    $stmt->execute();
    $result = $stmt->get_result();

    // Mengecek hasil query
    if ($result->num_rows === 1) {
        $row = $result->fetch_assoc();

        // Simpan informasi ke dalam session
        $_SESSION['user'] = $row['nama'];
        $_SESSION['kd_cs'] = $row['kode_customer'];

        // Redirect ke halaman utama
        header('Location: ../index.php');
        exit;
    } else {
        // Jika login gagal
        echo "
        <script>
        alert('USERNAME/PASSWORD SALAH');
        window.location = '../user_login.php';
        </script>
        ";
        exit;
    }

    // Tutup statement
    $stmt->close();
}
?>
