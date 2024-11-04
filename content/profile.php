<?php

// menampilkan data user berdasarkan ID user
$id_user = $_SESSION['ID'];
$queryUser = mysqli_query($koneksi, "SELECT * FROM user WHERE id='$id_user'");
$rowUser = mysqli_fetch_assoc($queryUser);

$queryTweet = mysqli_query($koneksi, "SELECT * FROM tweet WHERE id_user='$id_user'");
$rowTweet = mysqli_fetch_assoc($queryTweet);

// utnuk edit foto profile user ,dan nama dll. 
if (isset($_POST['simpan'])) {
    $nama_lengkap = $_POST['nama_lengkap'];
    $nama_pengguna = $_POST['nama_pengguna'];
    $email = $_POST['email'];
    $password = sha1($_POST['password']);

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
            unlink('upload/' . $rowUser['foto']);
            // pindahkan gambar dari tmp folder ke folder yg kita buat
            move_uploaded_file($_FILES['foto']['tmp_name'], $upload . $nameFile);

            $queryUpdateSetting = mysqli_query($koneksi, "UPDATE user SET nama_lengkap='$nama_lengkap', nama_pengguna='$nama_pengguna', email='$email', foto='$nameFile' WHERE id = '$id_user'");
        }
    } else {
        // gambar tidak mau diubah
        $update = mysqli_query($koneksi, "UPDATE user SET nama_lengkap='$nama_lengkap', nama_pengguna='$nama_pengguna', email='$email' WHERE id='$id_user'");
    }

    header('location:?pg=profile&ubah=berhasil');
}

// untuk edit cover
if (isset($_POST['edit_cover'])) {
    $nama_lengkap = $_POST['nama_lengkap'];
    $nama_pengguna = $_POST['nama_pengguna'];
    $email = $_POST['email'];
    $password = sha1($_POST['password']);

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
            unlink('upload/' . $rowUser['cover']);
            // pindahkan gambar dari tmp folder ke folder yg kita buat
            move_uploaded_file($_FILES['foto']['tmp_name'], $upload . $nameFile);

            $queryUpdateSetting = mysqli_query($koneksi, "UPDATE user SET cover='$nameFile' WHERE id = '$id_user'");
        }
    } else {
        // gambar tidak mau diubah
        $update = mysqli_query($koneksi, "UPDATE user SET nama_lengkap='$nama_lengkap', nama_pengguna='$nama_pengguna', email='$email' WHERE id='$id_user'");
    }
    header('location:?pg=profile&ubah=berhasil');
}

?>


<div class="container">
    <div class="row">
        <div class="col-sm-12">
            <div class="cover">
                <img style="max-height: 300px ;" src=" <?php echo !empty($rowUser['cover']) ? 'upload/' . $rowUser['cover'] : "https://placehold.co/800x200" ?> " width="100%" alt="">
            </div>
        </div>
        <div class="col-sm-6">
            <div class="profile-header mt-3 ">
                <img width="20%" src=" <?php echo !empty($rowUser['foto']) ? 'upload/' . $rowUser['foto'] : "https://placehold.co/100" ?> " alt="" class=" rounded-circle border border-dark">
                <h2><?php echo $rowUser['nama_lengkap'] ?></h2>
                <p>@<?php echo $rowUser['nama_pengguna'] ?></p>
                <p>Deskripsi Singkat</p>
            </div>

        </div>
        <div class="col-sm-6 mt-5 position-relative " align="right">
            <a href="#" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">Edit Profile</a>
            <a href="#" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#editCover">Edit Cover</a>
        </div>
        <div class="col-sm-12 mt-5">
            <ul class="nav nav-tabs" id="myTab" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home-tab-pane" type="button" role="tab" aria-controls="home-tab-pane" aria-selected="true">Tweet</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile-tab-pane" type="button" role="tab" aria-controls="profile-tab-pane" aria-selected="false">Tweet & balasan</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="contact-tab" data-bs-toggle="tab" data-bs-target="#contact-tab-pane" type="button" role="tab" aria-controls="contact-tab-pane" aria-selected="false">Like</button>
                </li>

            </ul>
            <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade show active mt-3" id="home-tab-pane" role="tabpanel" aria-labelledby="home-tab" tabindex="0">
                    <?php include 'tweet.php';  ?>
                </div>
                <div class="tab-pane fade" id="profile-tab-pane" role="tabpanel" aria-labelledby="profile-tab" tabindex="0">...</div>
                <div class="tab-pane fade" id="contact-tab-pane" role="tabpanel" aria-labelledby="contact-tab" tabindex="0">...</div>
                <div class="tab-pane fade" id="disabled-tab-pane" role="tabpanel" aria-labelledby="disabled-tab" tabindex="0">...</div>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Profile</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="" method="post" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="mb-3">
                        <input type="text" class="form-control" value="<?php echo $rowUser['nama_lengkap'] ?>" placeholder="Nama" name="nama_lengkap">
                    </div>
                    <div class="mb-3">
                        <input type="text" class="form-control" value="<?php echo $rowUser['nama_pengguna'] ?>" placeholder="Username" name="nama_pengguna">
                    </div>
                    <div class="mb-3">
                        <input type="email" class="form-control" value="<?php echo $rowUser['email'] ?>" placeholder="Username" name="email">
                    </div>
                    <div class="mb-3">
                        <input type="password" class="form-control" placeholder="Password" name="password">
                    </div>
                    <div class="mb-3">
                        <input type="file" name="foto">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                    <button type="sumbit" class="btn btn-primary" name="simpan">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="editCover" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Cover</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="" method="post" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="mb-3">
                        <input type="file" name="foto">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                    <button type="sumbit" class="btn btn-primary" name="edit_cover">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>