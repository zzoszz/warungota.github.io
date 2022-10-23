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
// menerima id mahasiswa yang dipilih
$id_mhs = (int)$_GET['id_mhs'];
if(delete_mahasiswa($id_mhs) > 0 ){
    echo "
        <script>
            document.location = 'mahasiswa.php';
        </script>
    ";
} else {
    echo "
        <script>
            alert('Gagal menghapus data mahasiswa');
            document.location = 'mahasiswa.php';
        </script>
    ";
}
?>