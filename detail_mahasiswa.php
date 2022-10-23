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

$title = 'Detail Mahasiswa';

include 'layout/header.php';

// mengambil id mahasiswa dari url
$id_mhs = (int)$_GET['id_mhs'];
// menampilkan data mahasiswa yang dipilih
$mhs = select("SELECT * FROM mahasiswa WHERE id_mhs = $id_mhs")[0];
?>

<div class="container mt-4">
    <h1>Data <?= $mhs['nama']; ?></h1>
    <hr>

    <table class="table table-striped table-bordered mt-3">
        <tr>
            <td>Nama</td>
            <td>: <?= $mhs['nama']; ?></td>
        </tr>
        <tr>
            <td>Program Studi</td>
            <td>: <?= $mhs['prodi']; ?></td>
        </tr>
        <tr>
            <td>Jenis Kelamin</td>
            <td>: <?= $mhs['jk']; ?></td>
        </tr>
        <tr>
            <td>Telepon</td>
            <td>: <?= $mhs['telepon']; ?></td>
        </tr>
        <tr>
            <td>Email</td>
            <td>: <?= $mhs['email']; ?></td>
        </tr>
        <tr>
            <td width="40%">Foto</td>
            <td>
                <a href="assets/img/<?= $mhs['foto']; ?>">
                    <img src="assets/img/<?= $mhs['foto']; ?>" alt="foto" width="20%">
                </a>
            </td>
        </tr>
    </table>
    <a href="mahasiswa.php" class="btn btn-success" style="float: right">Kembali</a>

</div>


<?php
include 'layout/footer.php';
?>