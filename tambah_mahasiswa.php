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

$title = "Tambah Mahasiswa";
include 'layout/header.php';

// cek apakah tombol tambah ditekan
if (isset($_POST['tambah'])) {
    if (create_mahasiswa($_POST) > 0) {
        echo "
            <script>
                alert('Berhasil menambah data mahasiswa ');
                document.location = 'mahasiswa.php';
            </script>
        ";
    } else {
        echo "
            <script>
                alert('Gagal menambah data mahasiswa');
                document.location = 'mahasiswa.php';
            </script>
        ";
    }
}
?>

<div class="container mt-4">
    <h1>Tambah Mahasiswa</h1>
    <hr>

    <form action="" method="post" enctype="multipart/form-data">
        <div class="mb-3">
            <label for="nama" class="form-label">Nama Mahasiswa</label>
            <input class="form-control" type="text" id="nama" name="nama" required autofocus></input>
        </div>
        <div class="row">
            <div class="mb-3 col-6">
                <label for="prodi">Program Studi</label>
                <select name="prodi" id="prodi" class="form-control">
                    <option value="">-- pilih prodi --</option>
                    <option value="Teknik Informatika">Teknik Informatika</option>
                    <option value="Teknik Mesin">Teknik Mesin</option>
                    <option value="Teknik Listrik">Teknik Listrik</option>
                </select>
            </div>
            <div class="mb-3 col-6">
                <label for="jk">Jenis Kelamin</label>
                <select name="jk" id="jk" class="form-control">
                    <option value="">-- pilih jenis kelamin --</option>
                    <option value="Laki-laki">Laki-laki</option>
                    <option value="Perempuan">Perempuan</option>
                </select>
            </div>
        </div>
        <div class="mb-3">
            <label for="telepon" class="form-label">Telepon</label>
            <input class="form-control" type="number" id="telepon" name="telepon" required></input>
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input class="form-control" type="email" id="email" name="email" required></input>
        </div>
        <div class="mb-3">
            <label for="foto" class="form-label">Foto</label>
            <input class="form-control" type="file" id="foto" name="foto" required onchange="previewImg()"></input>
            <img src="" alt="" class="img-thumbnail img-preview mt-2" width="100px">
        </div>
        <div class="mb-3">
            <a href="mahasiswa.php" class="btn btn-success mx-2" style="float: right">Kembali</a>
            <button class="btn btn-primary" type="submit" name="tambah" style="float: right">Tambah</button>
        </div>

    </form>
</div>

<!-- preview image -->
<script>
    function previewImg(){
        const foto = document.querySelector('#foto');
        const imgPreview = document.querySelector('.img-preview');

        const fileFoto = new FileReader();
        fileFoto.readAsDataURL(foto.files[0]);
        fileFoto.onload = function(e){
            imgPreview.src = e.target.result;
        }
    }
</script>

<?php include 'layout/footer.php'; ?>