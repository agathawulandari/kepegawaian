<?php
// include 'koneksi.php';

// $id = $_GET['id'];

// $stmt = mysqli_prepare($koneksi, "DELETE FROM pegawai WHERE id=?");
// mysqli_stmt_bind_param($stmt, "i", $id);
// mysqli_stmt_execute($stmt);

// header("Location: index.php");
?>

<?php
include "koneksi.php";

$id = (int) $_GET['id'];

$stmt = mysqli_prepare($koneksi, "DELETE FROM pegawai WHERE id = ?");
mysqli_stmt_bind_param($stmt, "i", $id);
mysqli_stmt_execute($stmt);

header("Location: index.php?page=kepegawaian");
exit;
