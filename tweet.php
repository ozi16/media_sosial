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
            // $upload = "upload/";
            // unlick () : mendelete file
            // unlink('upload/' . $rowTweet['foto']);
            // pindahkan gambar dari tmp folder ke folder yg kita buat
            move_uploaded_file($_FILES['foto']['tmp_name'], 'upload/' . $nameFile);

            $insert = mysqli_query($koneksi, "INSERT INTO tweet (content,id_user,foto) VALUES ('$content','$id_user','$nameFile')");
        }
    } else {
        // gambar tidak mau diubah
        $insert = mysqli_query($koneksi, "INSERT INTO tweet(content,id_user) VALUES ('$content','$id_user')");
    }

    header('location:?pg=profile&tweet=berhasil');
}

// $queryPosting = mysqli_query($koneksi, "SELECT tweet.*, comments.id AS id_komennih, comments.* FROM tweet LEFT JOIN comments ON tweet.id = comments.status_id  WHERE id_user='$id_user'");
$queryPosting = mysqli_query($koneksi, "SELECT tweet.* FROM tweet WHERE id_user='$id_user'");




?>


<div class="row">
    <div class="col-sm-12" align='right'>
        <button class="btn btn-outline-success" data-bs-toggle="modal" data-bs-target="#exampleModal1">Tweets</button>
    </div>

    <div class="col-sm-12 mt-3 ">
        <?php while ($rowPosting = mysqli_fetch_assoc($queryPosting)) : ?>
            <div class="d-flex my-3">
                <div class="flex-shrink-0">
                    <img src="upload/<?php echo !empty($rowUser['foto']) ? $rowUser['foto'] : "https://placehold.co/100"  ?>" class="border border-dark rounded-circle " width="100px" alt="...">
                </div>
                <div class="flex-grow-1 ms-3 d-flex gap-4 align-items-center">
                    <?php if (!empty($rowPosting['foto'])) : ?>
                        <img style="width:300px;height:300px " src="upload/<?php echo $rowPosting['foto'] ?>" alt="">
                    <?php endif; ?>
                    <?php echo $rowPosting['content'] ?>
                </div>

                <!-- LIKE -->
                <div class="status">
                    <input type="text" id="user_id_like" value="<?php echo $rowPosting['id_user'] ?>">
                    <button class="btn btn-success btn-sm" onclick="toggleLike(<?php echo $rowPosting['id']; ?>)">Like (0)</button>
                </div>

                <div class="flex-grow-1 ms-3">
                    <form action="add_comment.php" method="post">
                        <input type="text" name="status_id" value="<?php echo $rowPosting['id'] ?>">
                        <input type="text" name="user_id" value="<?php echo $rowPosting['id_user'] ?>">

                        <textarea name="comment_text" class="form-control" id="comment_text" cols="5" rows="5" placeholder="Tulis Balasan Anda ... "></textarea>
                        <button class="btn btn-primary btn-sm mt-2" type="submit">Kirim Balasan</button>
                    </form>

                    <div class="alert mt-2" id="comment-alert" style="display: none;"></div>
                    <div class="mt-1">
                        <?php
                        if (isset($rowPosting['id']) && isset($rowPosting['id_user'])) {
                            $idStatus = $rowPosting['id'];
                            $userId = $rowPosting['id_user'];
                            $queryComment = mysqli_query($koneksi, "SELECT * FROM comments WHERE status_id = '$idStatus' AND user_id = '$userId'");
                            $rowCounts = mysqli_fetch_all($queryComment, MYSQLI_ASSOC);

                            foreach ($rowCounts as $rowCount) {
                        ?>
                                <span>
                                    <pre>Komentar : <?php echo $rowCount['comment_text'] ?></pre>
                                </span>
                                <!-- <div class="d-flex gap-3">
                                    <p><?php echo $rowComment['comment_text'] ?></p>
                                    <p><i></i>(<?php echo $rowComment['nama_lengkap'] ?>)</p>
                                    <p><i></i>(<?php echo $rowComment['nama_pengguna'] ?>)</p>
                                    <p><small><?php echo $rowComment['tanggal'] ?></small></p>
                                </div> -->
                        <?php
                            }
                        }
                        ?>
                    </div>
                </div>
            </div>
            <hr>
        <?php endwhile; ?>
    </div>
</div>

<!-- Modal TWEET -->
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

<!-- <script>
    document.getElementById('comment-form').addEventListener('submit', function(e) {
        e.preventDefault();
        const formData = new FormData(this);

        fetch("add_comment.php", {
                method: "POST",
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                const alertBox = document.getElementById("comment-alert");
                if (data.status === "success") {
                    alertBox.className = "alert alert-success";
                    alertBox.innerHTML = data.message;
                    // BERSIHKAN TEXTAREA 
                    document.getElementById('comment_text').value = "";
                    location.reload();
                } else {
                    alertBox.className = "alert alert-danger";
                    alertBox.innerHTMl = data.message;
                }
                alertBox.style.display = "block";
            })
            .catch(error => console.error("Error:", error));
    });
</script> -->
<script>
    function toggleLike(statusId){
        const userId = document.getElementById("user_id_like").value;
        fetch("like_status.php",{
            method: "POST",
            headers: {
                "content-type": "application/x-www-form-urlencoded"
            },
            body: `status_id=${statusId}&user_id=${userId}`
        })
        .then(response => response.json())
        .then(data => {})
    }
</script>