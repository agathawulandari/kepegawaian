<?php
include 'koneksi.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

session_start();

// $all_success = true;

$nama = htmlspecialchars($_POST['nama']);
$nip = htmlspecialchars($_POST['nip']);
$jk = $_POST['jk'];
$pendidikan = $_POST['pendidikan'];
$pangkat = $_POST['pangkat'];
$jabatan_id = $_POST['jabatan_id'];
$no_sk = htmlspecialchars($_POST['no_sk']);
$tmt_sk = htmlspecialchars($_POST['tmt_sk']);
$kelas_jabatan = $_POST['kelas_jabatan'];

// ================== UPLOAD FOTO ==================
$nama_file = "";

if (isset($_FILES['foto']) && $_FILES['foto']['name'] != "") {

    $foto = $_FILES['foto']['name'];
    $tmp  = $_FILES['foto']['tmp_name'];
    $size = $_FILES['foto']['size'];

    $ext = strtolower(pathinfo($foto, PATHINFO_EXTENSION));
    $allowed = ['jpg', 'jpeg', 'png'];

    // validasi format
    if (!in_array($ext, $allowed)) {
        $_SESSION['error_message'] = "Format foto harus JPG/JPEG/PNG!";
        header("Location: index.php?page=kepegawaian");
        exit;
    }

    // validasi ukuran (max 2MB)
    if ($size > 2 * 1024 * 1024) {
        $_SESSION['error_message'] = "Ukuran foto maksimal 2MB!";
        header("Location: index.php?page=kepegawaian");
        exit;
    }

    // buat nama unik
    $nama_file = time() . "_" . $foto;

    // upload
    if (!move_uploaded_file($tmp, "uploads/" . $nama_file)) {
        $_SESSION['error_message'] = "Gagal upload foto!";
        header("Location: index.php?page=kepegawaian");
        exit;
    }
}

// ================== UPLOAD FILE ==================
$dokumen_sk = "";

if (isset($_FILES['file_sk']) && $_FILES['file_sk']['name'] != "") {

    $file = $_FILES['file_sk']['name'];
    $tmp  = $_FILES['file_sk']['tmp_name'];
    $size = $_FILES['file_sk']['size'];

    $ext = strtolower(pathinfo($file, PATHINFO_EXTENSION));

    // format yang diizinkan
    $allowed = ['pdf', 'jpg', 'jpeg', 'png'];

    if (!in_array($ext, $allowed)) {
        $_SESSION['error_message'] = "File harus PDF/JPG/PNG!";
        header("Location: index.php?page=kepegawaian");
        exit;
    }

    // max 5MB
    if ($size > 5 * 1024 * 1024) {
        $_SESSION['error_message'] = "Ukuran file maksimal 5MB!";
        header("Location: index.php?page=kepegawaian");
        exit;
    }

    // nama unik
    $dokumen_sk = time() . "_" . $file;

    if (!move_uploaded_file($tmp, "files/" . $dokumen_sk)) {
        $_SESSION['error_message'] = "Gagal upload file!";
        header("Location: index.php?page=kepegawaian");
        exit;
    }
}

$stmt = mysqli_prepare($koneksi, "INSERT INTO pegawai (nama, nip, jabatan_id, jk, pendidikan, pangkat, no_sk_terakhir, tmt_sk, kelas_jabatan, foto, file_sk) VALUES ( ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
mysqli_stmt_bind_param($stmt, "ssisssssiss", $nama, $nip, $jabatan_id, $jk, $pendidikan, $pangkat, $no_sk, $tmt_sk, $kelas_jabatan, $nama_file, $dokumen_sk);
// mysqli_stmt_execute($stmt);

$execute = mysqli_stmt_execute($stmt);

if ($execute) {

    // ================= AMBIL DATA LENGKAP =================
    $id_baru = mysqli_insert_id($koneksi);

    // panggil background email
    exec("php kirim_email.php $id_baru > NUL &");

    $_SESSION['success_message'] = "Data berhasil ditambahkan (email sedang dikirim di background)";
    // $_SESSION['success_message'] = "Data berhasil ditambahkan & email terkirim (dengan lampiran)!";


    header("Location: index.php?page=kepegawaian");
}
