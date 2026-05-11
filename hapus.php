<?php
include "koneksi.php";
session_start();

// validasi
if (!isset($_GET['id'])) {
    header("Location: index.php?page=kepegawaian");
    exit;
}

$id = (int) $_GET['id'];

// query hapus data
$query = mysqli_query($koneksi, "DELETE FROM kepegawaian WHERE id = '$id'");

if ($query) {
    $_SESSION['success_message'] = "Data berhasil dihapus";
    header("Location: index.php?page=kepegawaian");
    exit;
} else {
    $_SESSION['error_message'] = "Data gagal dihapus";
    header("Location: index.php?page=tambah");
    exit;
}

// redirect
header("Location: index.php?page=kepegawaian");
exit;
