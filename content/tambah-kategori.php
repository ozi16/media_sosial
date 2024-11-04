<?php
if (isset($_POST['tambah'])) {
    $nama_kategori = $_POST['nama_kategori'];

    // SQL = Structure Query Languages (bahasa query) / DML = Data Manipulation Languages
    // select, insert, update, delete

    $insert = mysqli_query($koneksi, "INSERT INTO kategori (nama_kategori) VALUES ('$nama_kategori')");
    header('location:?pg=kategori&tambah=berhasil');
}

$id = isset($_GET['edit']) ? $_GET['edit'] : '';
$editUser = mysqli_query($koneksi, "SELECT * FROM kategori WHERE id='$id'");
$rowEdit = mysqli_fetch_assoc($editUser);

if (isset($_POST['edit'])) {
    $nama_kategori = $_POST['nama_kategori'];

    // ubah user, kolom apa yang mau di ubah (SET). yang mau di ubah id ke berapa
    $update = mysqli_query($koneksi, "UPDATE kategori SET nama_kategori='$nama_kategori' WHERE id='$id'");
    header('location:?pg=kategori&edit=berhasil');
}

if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $delete = mysqli_query($koneksi, "DELETE FROM kategori WHERE id='$id'");
    header("location:?pg=kategori&hapus=berhasil");
}

?>

<div class="container table-anggota">
    <div class="warna">
        <fieldset class='border border-black border-2 p-3'>
            <legend class='float-none w-auto px-2'><?php echo isset($_GET['edit']) ? 'Edit' : 'Tambah' ?> Kategori</legend>
            <form action="" method="post">
                <div class="mb-3">
                    <label for="" class="form-label">Nama Kategori : </label>
                    <input type="text" name="nama_kategori" class="form-control" placeholder="Masukkan Kategori" value="<?php echo isset($_GET['edit']) ? $rowEdit['nama_kategori'] : '' ?>">
                </div>
                <br>
                <button type="submit" name="<?php echo isset($_GET['edit']) ? 'edit' : 'tambah' ?>">Simpan</button>
            </form>
        </fieldset>
    </div>
</div>