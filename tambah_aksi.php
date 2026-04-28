<?php
include 'koneksi.php';

$nama = htmlspecialchars($_POST['nama']);
$nip = htmlspecialchars($_POST['nip']);
$jabatan = htmlspecialchars($_POST['jabatan']);
$alamat = htmlspecialchars($_POST['alamat']);
$no_hp = htmlspecialchars($_POST['no_hp']);

$stmt = mysqli_prepare($koneksi, "INSERT INTO pegawai (nama, nip, jabatan, alamat, no_hp) VALUES (?, ?, ?, ?, ?)");
mysqli_stmt_bind_param($stmt, "sssss", $nama, $nip, $jabatan, $alamat, $no_hp);
mysqli_stmt_execute($stmt);

header("Location: index.php?page=kepegawaian");
