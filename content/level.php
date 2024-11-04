<?php
$level = mysqli_query($koneksi, 'SELECT * FROM level ORDER BY id DESC');
?>

<div class="container table-anggota">
    <div class="warna">
        <fieldset class='border border-black border-2 p-3'>
            <legend class='float-none w-auto px-2'>Data level</legend>
            <div class="d-flex ms-5">
                <a href="?pg=tambah-level" class='btn btn-primary me-3'>ADD</a>
                <a href="" class='ms-3'>RECYCLE</a>
            </div>
            <div class="container mt-3 d-flex justify-content-center initable">
                <table class='text-center table table-bordered table-success table-striped'>
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Level</th>
                            <th>Settings</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 1;
                        while ($rowLevel = mysqli_fetch_assoc($level)):
                        ?>
                            <tr>
                                <td><?php echo $no++ ?></td>
                                <td><?php echo $rowLevel['nama_level'] ?></td>
                                <td>
                                    <a href="?pg=tambah-level&delete=<?php echo $rowLevel['id'] ?>" onclick="return confirm('Apakah anda yakin akan menghapus data ini??')" class="btn btn-danger btn-sm"><i data-feather="trash-2"></i></a>
                                    <a href="?pg=tambah-level&edit=<?php echo $rowLevel['id'] ?>" class="btn btn-success btn-sm"><i data-feather="edit"></i></a>
                                </td>
                            </tr>
                        <?php endwhile ?>
                    </tbody>
                </table>
            </div>
        </fieldset>
    </div>
</div>