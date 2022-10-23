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

$title = "Ubah Mahasiswa";
include 'layout/header.php';

// cek apakah tombol ubah ditekan
if (isset($_POST['ubah'])) {
    if (update_mahasiswa($_POST) > 0) {
        echo "
            <script>
                alert('Berhasil mengubah data mahasiswa ');
                document.location = 'mahasiswa.php';
            </script>
        ";
    } else {
        echo "
            <script>
                alert('Gagal mengubah data mahasiswa');
                document.location = 'mahasiswa.php';
            </script>
        ";
    }
}

// ambil id mahasiswa dari url
$id_mhs = (int)$_GET['id_mhs'];

// query ambil data mahasiswa
$mhs = select("SELECT * FROM mahasiswa WHERE id_mhs = $id_mhs")[0];
?>

<div class="container mt-4">
    <h1>Ubah Mahasiswa</h1>
    <hr>

    <form action="" method="post" enctype="multipart/form-data">
        <input type="hidden" name="id_mhs" value="<?= $mhs['id_mhs']; ?>">
        <input type="hidden" name="foto_lama" value="<?= $mhs['foto']; ?>">
        <div class="mb-3">
            <label for="nama" class="form-label">Nama Mahasiswa</label>
            <input class="form-control" type="text" id="nama" name="nama" value="<?= $mhs['nama']; ?>" required autofocus></input>
        </div>
        <div class="row">
            <div class="mb-3 col-6">
                <label for="prodi">Program Studi</label>
                <select name="prodi" id="prodi" class="form-control">
                    <?= $prodi = $mhs['prodi']; ?>
                    <option value="Teknik Informatika" <?= $prodi == 'Teknik Informatika' ? 'selected' : null ?>>Teknik Informatika</option>
                    <option value="Teknik Mesin" <?= $prodi == 'Teknik Mesin' ? 'selected' : null ?>>Teknik Mesin</option>
                    <option value="Teknik Listrik" <?= $prodi == 'Teknik Listrik' ? 'selected' : null ?>>Teknik Listrik</option>
                </select>
            </div>
            <div class="mb-3 col-6">
                <label for="jk">Jenis Kelamin</label>
                <select name="jk" id="jk" class="form-control">
                    <?= $jk = $mhs['jk']; ?>
                    <option value="Laki-laki" <?= $jk == 'Laki-laki' ? 'selected' : null ?>>Laki-laki</option>
                    <option value="Perempuan" <?= $jk == 'Perempuan' ? 'selected' : null ?>>Perempuan</option>
                </select>
            </div>
        </div>
        <div class="mb-3">
            <label for="telepon" class="form-label">Telepon</label>
            <input class="form-control" type="number" id="telepon" name="telepon" value="<?= $mhs['telepon']; ?>" required></input>
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input class="form-control" type="email" id="email" name="email" value="<?= $mhs['email']; ?>" required></input>
        </div>
        <div class="mb-3">
            <label for="foto" class="form-label">Foto</label>
            <input class="form-control" type="file" id="foto" name="foto" required></input>
            <p><small>Gambar sebelumnya</small></p>
            <img src="assets/img/<?= $mhs['foto']; ?>" alt="foto">
        </div>
        <div class="mb-3">
            <a href="mahasiswa.php" class="btn btn-success mx-2" style="float: right">Kembali</a>
            <button class="btn btn-primary" type="submit" name="ubah" style="float: right">Ubah</button>
        </div>

    </form>
</div>

<?php include 'layout/footer.php'; ?>