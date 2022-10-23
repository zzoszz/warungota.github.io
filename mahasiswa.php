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

// membatasi halaman sesuai user login
if($_SESSION['level'] != 1 AND $_SESSION['level'] != 3){
    echo "
        <script>
            alert('Maaf, anda tidak punya hak akses');
            document.location.href = 'crud_modal.php';
        </script>
    ";
    exit;
}


$title = 'Daftar Mahasiswa';

include 'layout/header.php';

// menampilkan data mahasiswa
$data_mahasiswa = select("SELECT * FROM mahasiswa ORDER BY id_mhs DESC");
?>

<div class="container mt-5">
    <h1><i class="fas fa-users"></i> Data Mahasiswa</h1>
    <hr>
    <a href="tambah_mahasiswa.php" class="btn btn-primary mb-2"><i class="fas fa-plus-circle"></i> Tambah Mahasiswa</a>
    <table class=" table table-striped table-bordered" id="table">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Prodi</th>
                <th>Jenis Kelamin</th>
                <th>Telepon</th>
                <th class="text-center">Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php $no = 1; ?>
            <?php foreach ($data_mahasiswa as $mhs) : ?>
                <tr>
                    <td><?= $no++; ?></td>
                    <td><?= $mhs['nama']; ?></td>
                    <td><?= $mhs['prodi']; ?></td>
                    <td><?= $mhs['jk']; ?></td>
                    <td><?= $mhs['telepon']; ?></td>
                    <td class="text-center" width="25%">
                        <a href="detail_mahasiswa.php?id_mhs=<?= $mhs['id_mhs']; ?>" class="btn btn-secondary btn-sm"><i class="fas fa-eye"></i> Detail</a>
                        <a href="ubah_mahasiswa.php?id_mhs=<?= $mhs['id_mhs']; ?>" class="btn btn-success btn-sm"><i class="fas fa-edit"></i> Ubah</a>
                        <a href="hapus_mahasiswa.php?id_mhs=<?= $mhs['id_mhs']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Apakah anda yakin?')"><i class="fas fa-trash-alt"></i> Hapus</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

</div>


<?php
include 'layout/footer.php';
?>