<?php
if (isset($_POST['tambah'])) {
    $nama_level = $_POST['nama_level'];

    // SQL = Structure Query Languages (bahasa query) / DML = Data Manipulation Languages
    // select, insert, update, delete

    $insert = mysqli_query($koneksi, "INSERT INTO level (nama_level) VALUES ('$nama_level')");
    header('location:?pg=level&tambah=berhasil');
}

$id = isset($_GET['edit']) ? $_GET['edit'] : '';
$editUser = mysqli_query($koneksi, "SELECT * FROM level WHERE id='$id'");
$rowEdit = mysqli_fetch_assoc($editUser);

if (isset($_POST['edit'])) {
    $nama_level = $_POST['nama_level'];

    // ubah user, kolom apa yang mau di ubah (SET). yang mau di ubah id ke berapa
    $update = mysqli_query($koneksi, "UPDATE level SET nama_level='$nama_level' WHERE id='$id'");
    header('location:?pg=level&edit=berhasil');
}

if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $delete = mysqli_query($koneksi, "DELETE FROM level WHERE id='$id'");
    header("location:?pg=level&hapus=berhasil");
}

?>

<div class="container table-anggota">
    <div class="warna">
        <fieldset class='border border-black border-2 p-3'>
            <legend class='float-none w-auto px-2'><?php echo isset($_GET['edit']) ? 'Edit' : 'Tambah' ?> Level</legend>
            <form action="" method="post">
                <div class="mb-3">
                    <label for="" class="form-label">Nama Buku : </label>
                    <input type="text" name="nama_level" class="form-control" placeholder="Masukkan Kategori" value="<?php echo isset($_GET['edit']) ? $rowEdit['nama_level'] : '' ?>">
                </div>
                <br>
                <button type="submit" name="<?php echo isset($_GET['edit']) ? 'edit' : 'tambah' ?>">Simpan</button>
            </form>
        </fieldset>
    </div>
</div>