<?php

// reader halaman menjadi json
header("Content-Type: application/json");

require '../config/app.php';

//menerima request put/delete
parse_str(file_get_contents('php://input'), $delete);
// menerima input id data yang akan dihapus
$id_barang  = $delete['id_barang'];

// $query = select("SELECT * FROM barang");
$query = "DELETE FROM barang WHERE id_barang = $id_barang";
mysqli_query($conn, $query);
// echo json_encode($query);
// echo json_encode(['data_barang' => $query]);

if($query){
    echo json_encode(['pesan' => 'Berhasil menghapus data barang']);
} else {
    echo json_encode(['pesan' => 'Gagal menghapus data barang']);
}

?>