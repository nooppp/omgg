<?php
// Konfigurasi koneksi ke database
$host = "localhost"; // Server database
$username = "root";  // Username database
$password = "";      // Password database
$database = "coba";  // Nama database

// Buat koneksi
$conn = new mysqli($host, $username, $password, $database);

// Periksa koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Ambil data dari form
$nama = $_POST['nama'];
$email = $_POST['email'];
$subjek = $_POST['subjek'];
$pesan = $_POST['pesan'];

// Query untuk memasukkan data ke tabel
$sql = "INSERT INTO simpan (nama, email, subjek, pesan) VALUES (?, ?, ?, ?)";

// Siapkan statement
$stmt = $conn->prepare($sql);

if ($stmt) {
    // Bind parameter ke statement
    $stmt->bind_param("ssss", $nama, $email, $subjek, $pesan);

    // Eksekusi statement
    if ($stmt->execute()) {
        echo "Pesan berhasil disimpan!";
    } else {
        echo "Gagal menyimpan pesan: " . $stmt->error;
    }

    // Tutup statement
    $stmt->close();
} else {
    echo "Kesalahan persiapan statement: " . $conn->error;
}

// Tutup koneksi
$conn->close();
?>
