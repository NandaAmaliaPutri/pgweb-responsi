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

    // Ambil data yang akan diedit
    $sql = "SELECT * FROM objekwisata WHERE ID = $id";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
    } else {
        echo "Data tidak ditemukan";
        exit;
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];
    $nama_objek = $_POST['nama_objek'];
    $alamat = $_POST['alamat'];
    $latitude = $_POST['latitude'];
    $longitude = $_POST['longitude'];

    // Update data
    $sql = "UPDATE objekwisata SET nama_objek='$nama_objek', alamat='$alamat', latitude='$latitude', longitude='$longitude' WHERE ID=$id";

    if ($conn->query($sql) === TRUE) {
        echo "<p style='color: green; text-align: center;'>Data berhasil diupdate!</p>";
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
    <title>Edit Data Objek Wisata</title>
    <!-- Link untuk menambahkan font Poppins dari Google Fonts -->
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
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 450px;
            box-sizing: border-box;
        }
        .form-container h1 {
            margin-bottom: 20px;
            text-align: center;
            color: #4CAF50;
            font-size: 24px;
        }
        .form-group {
            margin-bottom: 15px;
            margin-right: 15px;
        }
        .form-group label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
            color: #555555;
        }
        .form-group input {
            width: 100%;
            padding: 10px;
            border: 1px solid #cccccc;
            border-radius: 5px;
            font-size: 14px;
            margin-top: 5px;
        }
        .form-group input:focus {
            border-color: #4CAF50;
            outline: none;
        }
        button {
            width: 100%;
            padding: 12px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            margin-top: 20px;
        }
        button:hover {
            background-color: #45a049;
        }
        p {
            text-align: center;
            font-size: 16px;
        }
    </style>
</head>
<body>
    <div class="form-container">
        <h1>✏️ Edit Data Objek Wisata</h1>
        <form method="POST">
            <div class="form-group">
                <input type="hidden" name="id" value="<?= $row['ID'] ?>">
            </div>
            <div class="form-group">
                <label for="nama_objek">Nama Objek:</label>
                <input type="text" name="nama_objek" value="<?= $row['nama_objek'] ?>" required>
            </div>
            <div class="form-group">
                <label for="alamat">Alamat:</label>
                <input type="text" name="alamat" value="<?= $row['alamat'] ?>" required>
            </div>
            <div class="form-group">
                <label for="latitude">Latitude:</label>
                <input type="text" name="latitude" value="<?= $row['latitude'] ?>" required>
            </div>
            <div class="form-group">
                <label for="longitude">Longitude:</label>
                <input type="text" name="longitude" value="<?= $row['longitude'] ?>" required>
            </div>
            <button type="submit">Update</button>
        </form>
    </div>
</body>
</html>
