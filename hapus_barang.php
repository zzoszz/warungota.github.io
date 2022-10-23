<?php
session_start();

// membatasi halaman sebelum login
if(!isset($_SESSION['login'])){
    echo "
        <script>
            alert('Silahkan login dahulu!');
            document.location.href = 'login.php';
        </script>
    ";
    exit;
}

include 'config/app.php';
// menerima id barang yang dipilih
$id_barang = (int)$_GET['id_barang'];
if(delete_barang($id_barang) > 0 ){
    echo "
        <script>
            document.location = 'index.php';
        </script>
    ";
} else {
    echo "
        <script>
            alert('Gagal menghapus barang');
            document.location = 'index.php';
        </script>
    ";
}
?>