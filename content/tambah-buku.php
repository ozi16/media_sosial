<?php
if (isset($_POST['tambah'])) {
    $nama_buku = $_POST['nama_buku'];
    $penerbit = $_POST['penerbit'];
    $tahun_terbit = $_POST['tahun_terbit'];
    $pengarang = $_POST['pengarang'];
    $id_kategori = $_POST['id_kategori'];
    
    // SQL = Structure Query Languages (bahasa query) / DML = Data Manipulation Languages
    // select, insert, update, delete

    $insert = mysqli_query($koneksi, "INSERT INTO buku (nama_buku, penerbit, tahun_terbit, pengarang, id_kategori) VALUES ('$nama_buku', '$penerbit', '$tahun_terbit', '$pengarang', '$id_kategori')");
    header('location:?pg=buku&tambah=berhasil');
}

$id = isset($_GET['edit']) ? $_GET['edit'] : '';
$editUser = mysqli_query($koneksi, "SELECT * FROM buku WHERE id='$id'");
$rowEdit = mysqli_fetch_assoc($editUser);

if (isset($_POST['edit'])) {
    $nama_buku = $_POST['nama_buku'];
    $penerbit = $_POST['penerbit'];
    $tahun_terbit = $_POST['tahun_terbit'];
    $pengarang = $_POST['pengarang'];
    $id_kategori = $_POST['id_kategori'];

    // ubah user, kolom apa yang mau di ubah (SET). yang mau di ubah id ke berapa
    $update = mysqli_query($koneksi, "UPDATE buku SET nama_buku='$nama_buku', penerbit='$penerbit', tahun_terbit='$tahun_terbit', pengarang='$pengarang', id_kategori='$id_kategori' WHERE id='$id'");
    header('location:?pg=buku&edit=berhasil');
}

if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $delete = mysqli_query($koneksi, "DELETE FROM buku WHERE id='$id'");
    header("location:?pg=buku&hapus=berhasil");
}

$queryKategori = mysqli_query($koneksi, "SELECT * FROM kategori");

?>

<div class="container table-anggota">
    <div class="warna">
        <fieldset class='border border-black border-2 p-3'>
            <legend class='float-none w-auto px-2'><?php echo isset($_GET['edit']) ? 'Edit' : 'Tambah' ?> Buku</legend>
            <form action="" method="post">
                <div class="mb-3">
                    <label for="" class="form-label">Nama Kategori : </label>
                    <select name="id_kategori" id="" class="form-control">
                    <option value="">Pilih Kategori</option>
                    <!-- option yang datanya di ambil dari tabel kategori -->
                    <?php while ($rowKategori = mysqli_fetch_assoc($queryKategori)): ?>
                    <option <?php echo isset($_GET['edit']) ? ($rowKategori['id'] == $rowEdit['id_kategori'] ? 'selected' : '') : '' ?> value="<?php echo $rowKategori['id']?>"><?php echo $rowKategori['nama_kategori']?></option>
                    <?php endwhile?>
                    </select>
                </div>
                <br>
                <div class="mb-3">
                    <label for="" class="form-label">Nama Buku : </label>
                    <input type="text" name="nama_buku" class="form-control" placeholder="Masukkan Kategori" value="<?php echo isset($_GET['edit']) ? $rowEdit['nama_buku'] : '' ?>">
                </div>
                <br>
                <div class="mb-3">
                    <label for="" class="form-label">Penerbit : </label>
                    <input type="text" name="penerbit" class="form-control" placeholder="Masukkan penerbit" value="<?php echo isset($_GET['edit']) ? $rowEdit['penerbit'] : '' ?>">
                </div>
                <br>
                <div class="mb-3">
                    <label for="" class="form-label">Tahun Terbit : </label>
                    <input type="text" name="tahun_terbit" class="form-control" placeholder="Masukkan tahun terbit" value="<?php echo isset($_GET['edit']) ? $rowEdit['tahun_terbit'] : '' ?>">
                </div>
                <br>
                <div class="mb-3">
                    <label for="" class="form-label">Pengarang : </label>
                    <input type="text" name="pengarang" class="form-control" placeholder="Masukkan pengarang" value="<?php echo isset($_GET['edit']) ? $rowEdit['pengarang'] : '' ?>">
                </div>
                <br>

                <button type="submit" name="<?php echo isset($_GET['edit']) ? 'edit' : 'tambah' ?>">Simpan</button>
            </form>
        </fieldset>
    </div>
</div>