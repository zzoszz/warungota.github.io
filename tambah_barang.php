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

$title = "Tambah Barang";
include 'layout/header.php';

// cek apakah tombol tambah ditekan
if (isset($_POST['tambah'])) {
    if (create_barang($_POST) > 0) {
        echo "
            <script>
                alert('Berhasil menambah data barang ');
                document.location = 'index.php';
            </script>
        ";
    } else {
        echo "
            <script>
                alert('Gagal menambah data barang');
                document.location = 'index.php';
            </script>
        ";
    }
}
?>

<div class="container mt-5">
    <h1>Tambah Barang</h1>
    <hr>

    <form action="" method="post">
        <div class="mb-3">
            <label for="nama" class="form-label">Nama Barang</label>
            <input class="form-control" type="text" id="nama" name="nama" required autofocus></input>
        </div>
        <div class="mb-3">
            <label for="jumlah" class="form-label">Jumlah</label>
            <input class="form-control" type="number" id="jumlah" name="jumlah" required></input>
        </div>
        <div class="mb-3">
            <label for="harga" class="form-label">Harga</label>
            <input class="form-control" type="number" id="harga" name="harga" required></input>
        </div>
        <div class="mb-3">
            <a href="index.php" class="btn btn-success mx-2" style="float: right">Kembali</a>
            <button class="btn btn-primary" type="submit" name="tambah" style="float: right">Tambah</button>
        </div>
    </form>
</div>

<?php include 'layout/footer.php'; ?>