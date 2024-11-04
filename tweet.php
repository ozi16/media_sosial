<?php
if (isset($_POST['posting'])) {

    $content = $_POST['content'];

    // jika gambar mau diubah 
    if (!empty($_FILES['foto']['name'])) {
        $nameFile = $_FILES['foto']['name'];
        $image_size = $_FILES['foto']['size'];

        // extention file
        $ext = array('png', 'jpg', 'jpeg', 'jfif', 'WebP');
        $extImg = pathinfo($nameFile, PATHINFO_EXTENSION);

        // jika ext tidak ada yg terdaftar
        if (!in_array($extImg, $ext)) {
            echo 'ext tidak ditemukan';
            die;
        } else {
            $upload = "upload/";
            // unlick () : mendelete file
            unlink('upload/' . $rowTweet['foto']);
            // pindahkan gambar dari tmp folder ke folder yg kita buat
            move_uploaded_file($_FILES['foto']['tmp_name'], $upload . $nameFile);

            $insert = mysqli_query($koneksi, "INSERT INTO tweet (content,id_user,foto) VALUES ('$content','id_user','$nameFile')");
        }
    } else {
        // gambar tidak mau diubah
        $insert = mysqli_query($koneksi, "INSERT INTO tweet(content,id_user) VALUES ('$content','$id_user')");
    }

    header('location:?pg=profile&tweet=berhasil');
}

$queryPosting = mysqli_query($koneksi, "SELECT * FROM tweet WHERE id_user='$id_user'");




?>


<div class="row">
    <div class="col-sm-12" align='right'>
        <button class="btn btn-outline-success" data-bs-toggle="modal" data-bs-target="#exampleModal1">Tweets</button>
    </div>
    <!-- <div class="col-sm-12 mt-3 ">
        <?php while ($rowPosting = mysqli_fetch_assoc($queryPosting)) : ?>
            <div class="d-flex">
                <div class="flex-shrink-0">
                    <img src="upload/<?php echo !empty($rowUser['foto']) ? $rowUser['foto'] : "https://placehold.co/100"  ?>" class="border border-dark" width="250" alt="...">
                </div>
                <div class="flex-grow-1 ms-3">
                    This is some content from a media component. You can replace this with any content and adjust it as needed.
                </div>
                <hr>
            </div>
        <?php endwhile; ?>
    </div> -->
    <div class="col-sm-12 mt-3 ">
        <?php while ($rowPosting = mysqli_fetch_assoc($queryPosting)) : ?>
            <div class="d-flex">
                <div class="flex-shrink-0">
                    <img src="upload/<?php echo !empty($rowUser['foto']) ? $rowUser['foto'] : "https://placehold.co/100"  ?>" class="border border-dark" width="250" alt="...">
                </div>
                <div class="flex-grow-1 ms-3">
                    <?php if (!empty($rowPosting['foto'])) : ?>
                        <img src="upload/<?php echo $rowPosting['foto'] ?>" alt="">
                    <?php endif; ?>
                    <?php echo $rowPosting['content'] ?>
                </div>
                <hr>
            </div>
        <?php endwhile; ?>
    </div>
</div>
<div class="modal fade" id="exampleModal1" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Tweets</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="" method="post" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="mb-3">
                        <textarea name="content" class="form-control" placeholder="Apa yang sedang hangat today" id="summernote"></textarea>
                    </div>

                    <div class="mb-3">
                        <input type="file" name="foto">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                    <button type="sumbit" class="btn btn-primary" name="posting">Tweet</button>
                </div>
            </form>
        </div>
    </div>
</div>