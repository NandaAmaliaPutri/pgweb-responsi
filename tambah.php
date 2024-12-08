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

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama_objek = $_POST['nama_objek'];
    $alamat = $_POST['alamat'];
    $latitude = $_POST['latitude'];
    $longitude = $_POST['longitude'];

    // Tambah data tanpa mengisi ID (karena auto-increment)
    $sql = "INSERT INTO objekwisata (nama_objek, alamat, latitude, longitude) VALUES ('$nama_objek', '$alamat', '$latitude', '$longitude')";

    if ($conn->query($sql) === TRUE) {
        echo "<p style='color: green; text-align: center;'>Data berhasil ditambahkan!</p>";
        header("Location: daftar.html"); // Redirect ke halaman utama
        exit;
    } else {
        echo "<p style='color: red; text-align: center;'>Error: " . $conn->error . "</p>";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Data Objek Wisata</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f4f4f9;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .form-container {
            background: #ffffff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            width: 100%;
            max-width: 400px;
        }
        .form-container h1 {
            margin-bottom: 20px;
            text-align: center;
            color: #4CAF50;
            font-size: 24px;
        }
        .form-container label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
            color: #555555;
        }
        .form-group {
            margin-bottom: 15px;
        }
        .form-container input {
            width: 100%;
            padding: 10px;
            border: 1px solid #cccccc;
            border-radius: 4px;
        }
        .form-container button {
            width: 100%;
            padding: 12px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
        }
        .form-container button:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <div class="form-container">
        <h1>🗺️ Tambah Data Objek Wisata</h1>
        <form method="POST">
            <div class="form-group">
                <label for="nama_objek">Nama Objek:</label>
                <input type="text" name="nama_objek" id="nama_objek" required>
            </div>
            <div class="form-group">
                <label for="alamat">Alamat:</label>
                <input type="text" name="alamat" id="alamat" required>
            </div>
            <div class="form-group">
                <label for="latitude">Latitude:</label>
                <input type="text" name="latitude" id="latitude" required>
            </div>
            <div class="form-group">
                <label for="longitude">Longitude:</label>
                <input type="text" name="longitude" id="longitude" required>
            </div>
            <button type="submit">Submit</button>
        </form>
    </div>
</body>
</html>
