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
$id_akun = (int)$_GET['id_akun'];
if(delete_akun($id_akun) > 0 ){
    echo "
        <script>
            document.location = 'crud_modal.php';
        </script>
    ";
} else {
    echo "
        <script>
            alert('Gagal menghapus akun');
            document.location = 'crud_modal.php';
        </script>
    ";
}
?>
