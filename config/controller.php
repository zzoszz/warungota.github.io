<?php
// fungsi menampilkan data
function select($query)
{
    // panggil koneksi database
    global $conn;
    $result         = mysqli_query($conn, $query);
    $rows           = [];
    while ($row     = mysqli_fetch_assoc($result)) {
        $rows[]     = $row;
    }
    return $rows;
}

function create_barang($post)
{
    global $conn;
    $nama   = strip_tags($post['nama']);
    $jumlah = strip_tags($post['jumlah']);
    $harga  = strip_tags($post['harga']);
    //query tambah data
    mysqli_query($conn, "INSERT INTO barang (nama, jumlah, harga) VALUES ('$nama', '$jumlah', '$harga')");
    return mysqli_affected_rows($conn);
}

function update_barang($post)
{
    global $conn;

    $id_barang  = $post['id_barang'];
    $nama       = strip_tags($post['nama']);
    $jumlah     = strip_tags($post['jumlah']);
    $harga      = strip_tags($post['harga']);
    //query tambah data
    mysqli_query($conn, "UPDATE barang SET nama = '$nama', jumlah = '$jumlah', harga = '$harga' WHERE id_barang = $id_barang");
    return mysqli_affected_rows($conn);
}

function delete_barang($id_barang){
    global $conn;
    mysqli_query($conn, "DELETE FROM barang WHERE id_barang = $id_barang");
    return mysqli_affected_rows($conn);
}

function update_mahasiswa($post)
{
    global $conn;
    $id_mhs = strip_tags($post['id_mhs']);

    $nama   = strip_tags($post['nama']);
    $prodi  = strip_tags($post['prodi']);
    $jk     = strip_tags($post['jk']);
    $telepon= strip_tags($post['telepon']);
    $email  = strip_tags($post['email']);
    $foto_lama   = strip_tags($post['foto_lama']);
    // cek upload file baru atau tidak
    if($_FILES['foto']['error'] = 4){
        $foto = $foto_lama;
    } else {
        $foto = upload_file();
    }
    mysqli_query($conn, "UPDATE mahasiswa SET nama = '$nama', prodi = '$prodi', jk = '$jk', telepon = '$telepon', email = '$email', foto = '$foto' WHERE id_mhs = $id_mhs");
    return mysqli_affected_rows($conn);
}

function create_mahasiswa($post)
{
    global $conn;
    $nama   = strip_tags($post['nama']);
    $prodi  = strip_tags($post['prodi']);
    $jk     = strip_tags($post['jk']);
    $telepon= strip_tags($post['telepon']);
    $email  = strip_tags($post['email']);
    $foto   = upload_file();
    // cek upload file
    if(!$foto){
        return false;
    }
    mysqli_query($conn, "INSERT INTO mahasiswa (nama, prodi, jk, telepon, email, foto) VALUES ('$nama', '$prodi', '$jk', '$telepon', '$email', '$foto')");
    return mysqli_affected_rows($conn);
}

// fungsi mengupload file
function upload_file()
{
    $namafile   = $_FILES['foto']['name'];
    $size       = $_FILES['foto']['size'];
    $error      = $_FILES['foto']['error'];
    $tmpName    = $_FILES['foto']['tmp_name'];
    // cek file yang diupload
    $ekstensifilevalid    = ['jpg', 'jpeg', 'png'];
    $ekstensifile          = explode('.', $namafile);
    $ekstensifile          = strtolower(end($ekstensifile));
    // cek format ekstensi file
    if(!in_array($ekstensifile, $ekstensifilevalid)){
        // pesan gagal
        echo "
            <script>
                alert('Format file tidak valid!');
                document.location.href = 'tambah_mahasiswa.php';
            </script>
        ";
        die();
    }
    // cek ukuran file 2 mb
    if($size > 2048000){
        // pesan gagal;
        echo "
            <script>
                alert('Ukuran file max 2 MB');
                document.location.href = 'tambah_mahasiswa.php';
            </script>
        ";
        die();
    }
    // generate nama file baru
    $namafilebaru = uniqid();
    $namafilebaru = $namafilebaru . '.';
    $namafilebaru = $namafilebaru . $ekstensifile;
    // pindahkan ke folder lokal
    move_uploaded_file($tmpName, 'assets/img/'. $namafilebaru);
    
    return $namafilebaru;
}

function delete_mahasiswa($id_mhs){
    global $conn;
    // ambil foto sesuai data yang dipilih
    $foto = select("SELECT * FROM mahasiswa WHERE id_mhs = $id_mhs")[0];
    unlink("assets/img/" . $foto['foto']);
    mysqli_query($conn, "DELETE FROM mahasiswa WHERE id_mhs = $id_mhs");
    return mysqli_affected_rows($conn);
}

function create_akun($post)
{
    global $conn;
    $nama       = strip_tags($post['nama']);
    $username   = strip_tags($post['username']);
    $email      = strip_tags($post['email']);
    $password   = strip_tags($post['password']);
    $level      = strip_tags($post['level']);

    // enkripsi password
    $password   = password_hash($password, PASSWORD_DEFAULT);
    mysqli_query($conn, "INSERT INTO akun VALUES (null, '$nama', '$username', '$email', '$password', '$level')");
    return mysqli_affected_rows($conn);
}

function update_akun($post)
{
    global $conn;
    $id_akun    = strip_tags($post['id_akun']);
    $nama       = strip_tags($post['nama']);
    $username   = strip_tags($post['username']);
    $email      = strip_tags($post['email']);
    $password   = strip_tags($post['password']);
    $level      = strip_tags($post['level']);

    // enkripsi password
    $password   = password_hash($password, PASSWORD_DEFAULT);
    mysqli_query($conn, "UPDATE akun SET nama = '$nama', username = '$username', email = '$email', password = '$password', level = '$level' WHERE id_akun = $id_akun");
    return mysqli_affected_rows($conn);
}

function delete_akun($id_akun){
    global $conn;
    mysqli_query($conn, "DELETE FROM akun WHERE id_akun = $id_akun");
    return mysqli_affected_rows($conn);
}
