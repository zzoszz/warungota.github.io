<?php

// reader halaman menjadi json
header("Content-Type: application/json");

require '../config/app.php';

// menerima input
$nama = $_POST['nama'];
$jumlah = $_POST['jumlah'];
$harga = $_POST['harga'];
// validasi data
if($nama == null){
    echo json_encode(['pesan' => 'Nama barang tidak boleh kosong!']);
    exit;
}
// $query = select("SELECT * FROM barang");
$query = "INSERT INTO barang (nama, jumlah, harga) VALUES ('$nama', '$jumlah', '$harga')";
mysqli_query($conn, $query);
// echo json_encode($query);
// echo json_encode(['data_barang' => $query]);

if($query){
    echo json_encode(['pesan' => 'Berhasil menambahkan data barang']);
} else {
    echo json_encode(['pesan' => 'Gagal menambahkan data barang']);
}

?>