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
if($_SESSION['level'] != 1 AND $_SESSION['level'] != 2){
    echo "
        <script>
            alert('Maaf, anda tidak punya hak akses');
            document.location.href = 'crud_modal.php';
        </script>
    ";
    exit;
}

$title = 'Data Barang';
include 'layout/header.php';

$barang = select("SELECT * FROM barang ORDER BY id_barang DESC");

?>

<div class="container mt-5">
    <h1><i class="fas fa-list"></i> Data Barang</h1>
    <hr>
    <a href="tambah_barang.php" class="btn btn-primary mb-2"><i class="fas fa-plus-circle"></i> Tambah Barang</a>
    <table class=" table table-striped table-bordered" id="table">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Jumlah</th>
                <th>Harga</th>
                <th>Tanggal</th>
                <th class="text-center">Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php $no = 1; ?>
            <?php foreach ($barang as $b) : ?>
                <tr>
                    <td><?= $no++; ?></td>
                    <td><?= $b['nama']; ?></td>
                    <td><?= $b['jumlah']; ?></td>
                    <td>Rp<?= number_format($b['harga'], 0, ',', '.'); ?></td>
                    <td><?= date('d/m/y | H:i:s', strtotime($b['tanggal'])); ?></td>
                    <td width="min" class="text-center">
                        <a href="ubah_barang.php?id_barang=<?= $b['id_barang'];?>" class="btn btn-success btn-sm"><i class="fas fa-edit"></i> Ubah</a>
                        <a href="hapus_barang.php?id_barang=<?= $b['id_barang'];?>" class="btn btn-danger btn-sm" onclick="return confirm('Apakah anda yakin?')"><i class="fas fa-trash-alt"></i> Hapus</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

</div>

<?php include 'layout/footer.php'; ?>