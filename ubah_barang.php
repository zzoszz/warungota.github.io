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

$title = "Ubah Barang";
include 'layout/header.php';

$id_barang = (int)$_GET['id_barang'];
$barang = select("SELECT * FROM barang WHERE id_barang = $id_barang")[0];
// cek apakah tombol tambah ditekan
if (isset($_POST['ubah'])) {
    if (update_barang($_POST) > 0) {
        echo "
            <script>
                alert('Berhasil mengubah data barang ');
                document.location = 'index.php';
            </script>
        ";
    } else {
        echo "
            <script>
                alert('Gagal mengubah data barang');
                document.location = 'index.php';
            </script>
        ";
    }
}
?>

<div class="container mt-5">
    <h1>Ubah Barang</h1>
    <hr>

    <form action="" method="post">
        <input type="hidden" name="id_barang" value="<?= $barang['id_barang']; ?>">
        <div class="mb-3">
            <label for="nama" class="form-label">Nama Barang</label>
            <input class="form-control" type="text" id="nama" name="nama" value="<?= $barang['nama']; ?>" required></input>
        </div>
        <div class="mb-3">
            <label for="jumlah" class="form-label">Jumlah</label>
            <input class="form-control" type="number" id="jumlah" name="jumlah" value="<?= $barang['jumlah']; ?>" required></input>
        </div>
        <div class="mb-3">
            <label for="harga" class="form-label">Harga</label>
            <input class="form-control" type="number" id="harga" name="harga" value="<?= $barang['harga']; ?>" required></input>
        </div>
        <div class="mb-3">
            <a href="index.php" class="btn btn-success mx-2" style="float: right">Kembali</a>
            <button class="btn btn-primary" type="submit" name="ubah" style="float: right">Ubah</button>
        </div>
    </form>
</div>

<?php include 'layout/footer.php'; ?>