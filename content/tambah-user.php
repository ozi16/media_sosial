<?php
if (isset($_POST['tambah'])) {
    $nama = $_POST['nama'];
    $email = $_POST['email'];
    $password = sha1($_POST['password']);
    $jenis_kelamin = $_POST['jenis_kelamin'];
    $telepon = $_POST['telepon'];

    // SQL = Structure Query Languages (bahasa query) / DML = Data Manipulation Languages
    // select, insert, update, delete

    $insert = mysqli_query($koneksi, "INSERT INTO user (nama, email, password, jenis_kelamin, telepon) VALUES ('$nama', '$email', '$password','$jenis_kelamin', '$telepon')");
    header('location:?pg=table-anggota&tambah=berhasil');
}

$id = isset($_GET['edit']) ? $_GET['edit'] : '';
$editUser = mysqli_query($koneksi, "SELECT * FROM user WHERE id='$id'");
$rowEdit = mysqli_fetch_assoc($editUser);

if (isset($_POST['edit'])) {
    $nama = $_POST['nama'];
    $email = $_POST['email'];
    // if($_POST['password']){
    //     $password = sha1($_POST['password']);
    // } else {
    //     $password = $rowEdit['password'];
    // }
    $password = ($_POST['password']) ? sha1($_POST['password']) : $rowEdit['password'];
    $jenis_kelamin = $_POST['jenis_kelamin'];
    $telepon = $_POST['telepon'];

    // ubah user, kolom apa yang mau di ubah (SET). yang mau di ubah id ke berapa
    $update = mysqli_query($koneksi, "UPDATE user SET nama='$nama', email='$email', password='$password', jenis_kelamin='$jenis_kelamin', telepon='$telepon' WHERE id='$id'");
    header('location:?pg=table-anggota&edit=berhasil');
}

if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $delete = mysqli_query($koneksi, "DELETE FROM user WHERE id='$id'");
    header("location:?pg=table-anggota&hapus=berhasil");
}

?>

<div class="container table-anggota">
    <div class="warna">
        <fieldset class='border border-black border-2 p-3'>
            <legend class='float-none w-auto px-2'><?php echo isset($_GET['edit']) ? 'Edit' : 'Tambah' ?> Anggota</legend>
            <form action="" method="post">
                <div class="mb-3">
                    <label for="" class="form-label">Nama : </label>
                    <input type="text" name="nama" class="form-control" placeholder="Masukkan Nama Anda" value="<?php echo isset($_GET['edit']) ? $rowEdit['nama'] : '' ?>">
                </div>
                <div class="mb-3">
                    <label for="" class="form-label">Email : </label>
                    <input type="email" name="email" class="form-control" placeholder="Masukkan Email Anda" value="<?php echo isset($_GET['edit']) ? $rowEdit['email'] : '' ?>">
                </div>
                <div class="mb-3">
                    <label for="" class="form-label">Password : </label>
                    <input type="password" name="password" class="form-control" placeholder="Masukkan Password Anda">
                </div>
                <div class="mb-3">
                    <label for="" class="form-label">Jenis Kelamin</label></br>
                    <input type="radio" name="jenis_kelamin" value="Laki-laki" <?php echo isset($_GET['edit']) ? ($rowEdit['jenis_kelamin'] == 'Laki-laki' ? 'checked' : '') : '' ?>>Laki-laki<br>
                    <input type="radio" name="jenis_kelamin" value="Perempuan" <?php echo isset($_GET['edit']) ? ($rowEdit['jenis_kelamin'] == 'Perempuan' ? 'checked' : '') : '' ?>>Perempuan <br>
                </div>
                <div class="mb-3">
                    <label for="" class="form-label">Telepon : </label>
                    <input type="number" name="telepon" class="form-control" placeholder="Masukkan Telepon Anda" value="<?php echo isset($_GET['edit']) ? $rowEdit['telepon'] : '' ?>">
                </div>
                <br>
                <button type="submit" name="<?php echo isset($_GET['edit']) ? 'edit' : 'tambah' ?>">Simpan</button>
            </form>
        </fieldset>
    </div>
</div>