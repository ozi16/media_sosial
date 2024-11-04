<?php
$kategori = mysqli_query($koneksi, 'SELECT * FROM kategori ORDER BY id DESC');
?>

<div class="container table-anggota">
    <div class="warna">
        <fieldset class='border border-black border-2 p-3'>
            <legend class='float-none w-auto px-2'>Data Kategori</legend>
            <div class="d-flex ms-5">
                <a href="?pg=tambah-kategori" class='btn btn-primary me-3'>ADD</a>
                <a href="" class='ms-3'>RECYCLE</a>
            </div>
            <div class="container mt-3 d-flex justify-content-center initable">
                <table class='text-center table table-bordered table-success table-striped'>
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Nama Kategori</th>
                            <th>Settings</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 1;
                        while ($rowKategori = mysqli_fetch_assoc($kategori)):
                        ?>
                            <tr>
                                <td><?php echo $no++ ?></td>
                                <td><?php echo $rowKategori['nama_kategori'] ?></td>
                                <td>
                                    <a href="?pg=tambah-kategori&delete=<?php echo $rowKategori['id'] ?>" onclick="return confirm('Apakah anda yakin akan menghapus data ini??')" class="btn btn-danger btn-sm"><i data-feather="trash-2"></i></a>
                                    <a href="?pg=tambah-kategori&edit=<?php echo $rowKategori['id'] ?>" class="btn btn-success btn-sm"><i data-feather="edit"></i></a>
                                </td>
                            </tr>
                        <?php endwhile ?>
                    </tbody>
                </table>
            </div>
        </fieldset>
    </div>
</div>