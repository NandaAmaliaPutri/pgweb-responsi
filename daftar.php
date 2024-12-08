<?php
// Sesuaikan dengan setting MySQL
$servername = "localhost";
$username = "root";
$password = ""; // Sesuaikan jika ada password
$dbname = "responsi"; // Nama database

// Buat koneksi
$conn = new mysqli($servername, $username, $password, $dbname);

// Cek koneksi
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Query untuk mengambil data dari tabel objekwisata
$sql = "SELECT ID, nama_objek, alamat, latitude, longitude FROM objekwisata";
$result = $conn->query($sql);

// Tambahkan style CSS
echo '<style>
    /* Import font Poppins dari Google Fonts */
    @import url("https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap");

    body {
        font-family: "Arial, sans-serif;
        background-color: #000000;
        margin: 0;
        display: flex;
        justify-content: center;
        min-height: 100vh;
        flex-direction: column;
    }

    h1 {
        font-family: "Poppins", sans-serif;
        font-size: 32px;
        margin-bottom: 20px;
        text-align: center;
        font-weight: 600;
        color: transparent;
        background: linear-gradient(45deg, #ff00cc, #00ffff);
        background-clip: text;
    }

    table {
        width: 100%;
        max-width: 1200px;
        border-collapse: collapse;
        margin: 20px 0;
        background-color: #fff;
        box-shadow: 0 8px 16px rgba(0, 0, 0, 0.1);
        border-radius: 8px;
        text-align: center;
        overflow: hidden;
    }

    th, td {
        padding: 15px;
        text-align: left;
        border: 1px solid #ddd;
        color: #333;
        font-size: 16px;
    }

    th {
        background-color: #1e3a8a;
        color: white;
        text-transform: uppercase;
        letter-spacing: 1px;
    }

    tr:nth-child(even) {
        background-color: #f9f9f9;
    }

    tr:hover {
        background-color: #e0f2f1;
        transform: scale(1.02);
        transition: background-color 0.3s ease, transform 0.3s ease;
    }

    a {
        color: #4CAF50;
        text-decoration: none;
        font-weight: bold;
        font-size: 14px;
    }

    a:hover {
        color: #388E3C;
        text-decoration: underline;
    }

    .btn-edit, .btn-delete {
        padding: 8px 15px;
        border-radius: 5px;
        font-size: 14px;
        font-weight: 500;
        cursor: pointer;
        text-decoration: none;
        margin: 0 5px;
        transition: background-color 0.3s ease;
        display: inline-block;
    }

    .btn-edit {
        background-color: #4CAF50;
        color: white;
    }

    .btn-edit:hover {
        background-color: #45a049;
    }

    .btn-delete {
        background-color: #e63946;
        color: white;
    }

    .btn-delete:hover {
        background-color: #c03434;
    }

    /* Style untuk tombol tambah data */
    .btn-tambah {
        background-color: #1e3a8a;
        color: white;
        padding: 10px 15px;
        border-radius: 5px;
        text-align: center;
        font-size: 16px;
        text-decoration: none;
        font-weight: 600;
        margin-top: 10px;
        transition: background-color 0.3s ease;
        display: inline-block;
    }

    .btn-tambah:hover {
        background-color: #0c1d6f;
    }

    /* Responsif untuk perangkat mobile */
    @media (max-width: 768px) {
        table {
            width: 100%;
        }

        h1 {
            font-size: 24px;
        }

        .btn-tambah {
            width: 100%;
            font-size: 18px;
        }

        .btn-edit, .btn-delete {
            font-size: 12px;
            padding: 6px 12px;
        }
    }

    /* Untuk kolom angka (ID, longitude, latitude), teks di-align kanan */
    td:nth-child(1), td:nth-child(4), td:nth-child(5) {
        text-align: right;
    }

    .action-buttons {
        display: flex;
        justify-content: flex-start;
        gap: 10px;
    }

    /* Extra style */
    .container {
        width: 95%;
        margin: 0 auto;
    }

    .alert {
        padding: 10px;
        background-color: #f44336;
        color: white;
        margin: 10px 0;
        border-radius: 5px;
    }

    .success {
        background-color: #4CAF50;
    }

    .warning {
        background-color: #ff9800;
    }

</style>';

// Cek hasil query
if ($result->num_rows > 0) {
    echo "<div class='container'>";
    echo "<h1>Daftar Objek Wisata Kota Surakarta</h1>";
    echo "<table>
            <tr>
                <th>ID</th>
                <th>Nama objek</th>
                <th>Alamat</th>
                <th>Longitude</th>
                <th>Latitude</th>
                <th>Aksi</th>
            </tr>";

    // Output data dari setiap baris
    while ($row = $result->fetch_assoc()) {
        echo "<tr>
                <td>" . $row["ID"] . "</td>
                <td>" . $row["nama_objek"] . "</td>
                <td>" . $row["alamat"] . "</td>
                <td>" . $row["longitude"] . "</td>
                <td>" . $row["latitude"] . "</td>
                <td class='action-buttons'>
                    <a href='edit.php?id=" . $row["ID"] . "' class='btn-edit'>Edit</a>
                    <a href='delete.php?id=" . $row["ID"] . "' class='btn-delete' onclick='return confirm(\"Apakah Anda yakin ingin menghapus data ini?\")'>Hapus</a>
                </td>
              </tr>";
    }
    echo "</table>";

    // Tambahkan tombol tambah di bawah tabel
    echo '<a href="tambah.php" class="btn-tambah">Tambah Data</a>';
    echo "</div>";
} else {
    echo "<div class='container'>";
    echo "<div class='alert warning'>Tidak ada data yang ditemukan.</div>";
    echo "</div>";
}

// Tutup koneksi
$conn->close();
?>
