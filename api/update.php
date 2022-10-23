<?php

// reader halaman menjadi json
header("Content-Type: application/json");

require '../config/app.php';

parse_str(file_get_contents('php://input'), $put);
// menerima input
$id_barang  = $put['id_barang'];
$nama       = $put['nama'];
$jumlah     = $put['jumlah'];
$harga      = $put['harga'];
// validasi data
if($nama == null){
    echo json_encode(['pesan' => 'Nama barang tidak boleh kosong!']);
    exit;
}
// $query = select("SELECT * FROM barang");
$query = "UPDATE barang SET nama = '$nama', jumlah = '$jumlah', harga = '$harga' WHERE id_barang = $id_barang";
mysqli_query($conn, $query);
// echo json_encode($query);
// echo json_encode(['data_barang' => $query]);

if($query){
    echo json_encode(['pesan' => 'Berhasil mengubah data barang']);
} else {
    echo json_encode(['pesan' => 'Gagal mengubah data barang']);
}

?>