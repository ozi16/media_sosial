<?php

require_once "koneksi.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $status_id = $_POST['status_id'];
    $user_id = $_POST['user_id'];

    // cek status
    $selectCheck = mysqli_query($koneksi, "SELECT * FROM likes WHERE status_id = '$status_id' AND user_id = '$user_id'");

    if (mysqli_num_rows($selectCheck) > 0) {
        // jika sudah like, lakukan unlike
        $qunlike = mysqli_query($koneksi, "DELETE FROM likes WHERE status_id = '$status_id' AND user_id = '$user_id'");
        if ($qunlike) {
            // sukses
            $response = [
                'status' => 'unliked'
            ];
        } else {
            // gagal unlike
            $response = [
                'status' => 'error',
                'message' => 'Gagal mengunlike'
            ];
        }
    } else {
        // jika belum like, lakukan like
        $qlike = mysqli_query($koneksi, "INSERT INTO likes (status_id, user_id) VALUES ('$status_id', '$user_id')");
        if ($qlike) {
            // sukses
            $response = [
                'status' => 'liked'
            ];
        } else {
            // gagal like
            $response = [
                'status' => 'error',
                'message' => 'Gagal menyukai'
            ];
        }
    }
    // kirim response
    header('Content-Type: application/json');
    echo json_encode($response);
    exit;
} else {
    // method request bukan POST
    header('Content-Type: application/json');
    echo json_encode([
        'status' => 'error',
        'message' => 'Method request harus POST'
    ]);
    exit;
}
