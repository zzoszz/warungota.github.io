<?php
session_start();

// membatasi halaman sebelum login
if (!isset($_SESSION['login'])) {
    echo "
        <script>
            alert('Silahkan login dahulu!');
            document.location.href = 'login.php';
        </script>
    ";
    exit;
}

$title = 'Data akun';
include 'layout/header.php';

// tampil seluruh data akun
$data_akun = select("SELECT * FROM akun");

// tampil data berdasarkan user login
$id_akun = $_SESSION['id_akun'];
$data_bylogin = select("SELECT * FROM akun WHERE id_akun = $id_akun");

if (isset($_POST['tambah'])) {
    if (create_akun($_POST) > 0) {
        echo "
            <script>
                alert('Berhasil menambah data akun');
                document.location = 'crud_modal.php';
            </script>
        ";
    } else {
        echo "
            <script>
                alert('Gagal menambah data akun ');
                document.location = 'crud_modal.php';
            </script>
        ";
    }
}

if (isset($_POST['ubah'])) {
    if (update_akun($_POST) > 0) {
        echo "
            <script>
                alert('Berhasil mengubah data akun');
                document.location = 'crud_modal.php';
            </script>
        ";
    } else {
        echo "
            <script>
                alert('Gagal mengubah data akun ');
                document.location = 'crud_modal.php';
            </script>
        ";
    }
}
?>

<div class="container mt-5">
    <h1>Data Akun</h1>
    <hr>

    <?php if ($_SESSION['level'] == 1) : ?>
        <button type="button" href="" class="btn btn-primary mb-2" data-bs-toggle="modal" data-bs-target="#modal_tambah_akun">Tambah Akun</button>
    <?php endif; ?>

    <table class=" table table-striped table-bordered" id="table">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Username</th>
                <th>Email</th>
                <th>Password</th>
                <th class="text-center">Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php $no = 1; ?>
            <!-- tampil seluruh data -->
            <?php if ($_SESSION['level'] == 1) : ?>
                <?php foreach ($data_akun as $akun) : ?>
                    <tr>
                        <td><?= $no++; ?></td>
                        <td><?= $akun['nama']; ?></td>
                        <td><?= $akun['username']; ?></td>
                        <td><?= $akun['email']; ?></td>
                        <td>Password terkenkripsi</td>
                        <td class="text-center">
                            <button class="btn btn-success btn-sm mb-1" type="button" data-bs-toggle="modal" data-bs-target="#modal_ubah_akun<?= $akun['id_akun']; ?>">Ubah</button>
                            <button class="btn btn-danger btn-sm mb-1" type="button" data-bs-toggle="modal" data-bs-target="#modal_hapus_akun<?= $akun['id_akun']; ?>">Hapus</button>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else : ?>
                <!-- tampil data berdasarkan user login -->
                <?php foreach ($data_bylogin as $akun) : ?>
                    <tr>
                        <td><?= $no++; ?></td>
                        <td><?= $akun['nama']; ?></td>
                        <td><?= $akun['username']; ?></td>
                        <td><?= $akun['email']; ?></td>
                        <td>Password terkenkripsi</td>
                        <td class="text-center">
                            <button class="btn btn-success btn-sm mb-1" type="button" data-bs-toggle="modal" data-bs-target="#modal_ubah_akun<?= $akun['id_akun']; ?>">Ubah</button>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php endif; ?>
        </tbody>
    </table>
</div>

<!-- Modal Tambah -->
<div class="modal fade" id="modal_tambah_akun" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Akun</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="" method="post">
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="nama">Nama</label>
                        <input type="text" id="nama" name="nama" class="form-control" required></input>
                    </div>
                    <div class="mb-3">
                        <label for="username">Username</label>
                        <input type="text" id="username" name="username" class="form-control" required></input>
                    </div>
                    <div class="mb-3">
                        <label for="email">Email</label>
                        <input type="email" id="email" name="email" class="form-control" required></input>
                    </div>
                    <div class="mb-3">
                        <label for="password">Password</label>
                        <input type="password" id="password" name="password" class="form-control" required minlength="6"></input>
                    </div>
                    <div class="mb-3">
                        <label for="level">Level</label>
                        <select name="level" id="level" class="form-control" required>
                            <option value="">-- pilih level --</option>
                            <option value="1">Admin</option>
                            <option value="2">Operator Barang</option>
                            <option value="3">Operator Mahasiswa</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Kembali</button>
                    <button type="submit" class="btn btn-primary" name="tambah">Tambah</button>
                </div>
            </form>

        </div>
    </div>
</div>

<!-- Modal Ubah -->
<?php foreach ($data_akun as $akun) : ?>
    <div class="modal fade" id="modal_ubah_akun<?= $akun['id_akun']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-success text-white">
                    <h5 class="modal-title" id="exampleModalLabel">Ubah Akun</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="" method="post">
                    <div class="modal-body">
                        <input type="hidden" name="id_akun" value="<?= $akun['id_akun']; ?>">
                        <div class="mb-3">
                            <label for="nama">Nama</label>
                            <input type="text" id="nama" name="nama" class="form-control" value="<?= $akun['nama']; ?>" required></input>
                        </div>
                        <div class="mb-3">
                            <label for="username">Username</label>
                            <input type="text" id="username" name="username" class="form-control" value="<?= $akun['username']; ?>" required></input>
                        </div>
                        <div class="mb-3">
                            <label for="email">Email</label>
                            <input type="email" id="email" name="email" class="form-control" value="<?= $akun['email']; ?>" required></input>
                        </div>
                        <div class="mb-3">
                            <label for="password">Password <small>(masukkan password baru/lama)</small></label>
                            <input type="password" id="password" name="password" class="form-control" required minlength="6"></input>
                        </div>
                        <?php if ($_SESSION['level'] == 1) : ?>
                            <div class="mb-3">
                                <label for="level">Level</label>
                                <select name="level" id="level" class="form-control" required>
                                    <?php $level = $akun['level']; ?>
                                    <option value="1" <?= $level == '1' ? 'selected' : null ?>>Admin</option>
                                    <option value="2" <?= $level == '2' ? 'selected' : null ?>>Operator Barang</option>
                                    <option value="3" <?= $level == '3' ? 'selected' : null ?>>Operator Mahasiswa</option>
                                </select>
                            </div>
                        <?php else : ?>
                            <input type="hidden" name="level" value="<?= $akun['level']; ?>">
                        <?php endif; ?>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Kembali</button>
                        <button type="submit" class="btn btn-success" name="ubah">Ubah</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
<?php endforeach; ?>

<!-- Modal hapus -->
<div class="modal fade" id="modal_hapus_akun<?= $akun['id_akun']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-danger text-white">
                <h5 class="modal-title" id="exampleModalLabel">Hapus Akun</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="" method="post">
                <div class="modal-body">
                    <p>Apakah anda yakin menghapus akun : <?= $akun['nama'] ?>?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Kembali</button>
                    <a href="hapus_akun.php?id_akun=<?= $akun['id_akun']; ?>" class="btn btn-danger">Hapus</a>
                </div>
            </form>
        </div>
    </div>
</div>

<?php include 'layout/footer.php'; ?>