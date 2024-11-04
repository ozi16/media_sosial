<?php
$buku = mysqli_query($koneksi, 'SELECT kategori.nama_kategori, buku.* FROM buku LEFT JOIN kategori ON kategori.id=buku.id_kategori ORDER BY id DESC');
?>

<div class="container table-anggota">
    <div class="warna">
        <fieldset class='border border-black border-2 p-3'>
            <legend class='float-none w-auto px-2'>Data Buku</legend>
            <div class="d-flex ms-5">
                <a href="?pg=tambah-buku" class='btn btn-primary me-3'>ADD</a>
                <a href="" class='ms-3'>RECYCLE</a>
            </div>
            <div class="container mt-3 d-flex justify-content-center initable">
                <table class='text-center table table-bordered table-success table-striped'>
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Nama Kategori</th>
                            <th>Nama Buku</th>
                            <th>Penerbit</th>
                            <th>Tahun Terbit</th>
                            <th>pengarang</th>
                            <th>Settings</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 1;
                        while ($rowBuku = mysqli_fetch_assoc($buku)):
                        ?>
                            <tr>
                                <td><?php echo $no++ ?></td>
                                <td><?php echo $rowBuku['nama_kategori'] ?></td>
                                <td><?php echo $rowBuku['nama_buku'] ?></td>
                                <td><?php echo $rowBuku['penerbit'] ?></td>
                                <td><?php echo $rowBuku['tahun_terbit'] ?></td>
                                <td><?php echo $rowBuku['pengarang'] ?></td>
                                <td>
                                    <a href="?pg=tambah-buku&delete=<?php echo $rowBuku['id'] ?>" onclick="return confirm('Apakah anda yakin akan menghapus data ini??')" class="btn btn-danger btn-sm"><i data-feather="trash-2"></i></a>
                                    <a href="?pg=tambah-buku&edit=<?php echo $rowBuku['id'] ?>" class="btn btn-success btn-sm"><i data-feather="edit"></i></a>
                                </td>
                            </tr>
                        <?php endwhile ?>
                    </tbody>
                </table>
            </div>
        </fieldset>
    </div>
</div>