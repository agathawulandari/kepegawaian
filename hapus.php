<?php
include "koneksi.php";
session_start();

// validasi
if (!isset($_GET['id'])) {
    header("Location: index.php?page=kepegawaian");
    exit;
}

$id = (int) $_GET['id'];

// ================= AMBIL FOTO =================
$query = mysqli_query($koneksi, "SELECT foto, file_sk FROM pegawai WHERE id = $id");
$data = mysqli_fetch_assoc($query);

if ($data) {

    // ================= HAPUS FOTO =================
    if (!empty($data['foto']) && file_exists("uploads/" . $data['foto'])) {
        unlink("uploads/" . $data['foto']);
    }

    // ================= HAPUS FILE SK =================
    if (!empty($data['file_sk']) && file_exists("files/" . $data['file_sk'])) {
        unlink("files/" . $data['file_sk']);
    }

    // ================= HAPUS DATA =================
    $stmt = mysqli_prepare($koneksi, "DELETE FROM pegawai WHERE id = ?");
    mysqli_stmt_bind_param($stmt, "i", $id);
    $execute = mysqli_stmt_execute($stmt);

    if ($execute) {
        $_SESSION['success_message'] = "Data berhasil dihapus!";
    } else {
        $_SESSION['error_message'] = "Gagal menghapus data!";
    }
} else {
    $_SESSION['error_message'] = "Data tidak ditemukan!";
}

// redirect
header("Location: index.php?page=kepegawaian");
exit;
