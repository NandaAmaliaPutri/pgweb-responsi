<?php
// Koneksi ke database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "responsi";

$conn = new mysqli($servername, $username, $password, $dbname);

// Cek koneksi
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Hapus data
    $sql = "DELETE FROM objekwisata WHERE ID = $id";

    if ($conn->query($sql) === TRUE) {
        echo "Data berhasil dihapus!";
    } else {
        echo "Error: " . $conn->error;
    }
}

header("Location: daftar.html"); // Redirect ke halaman utama
exit;
?>
