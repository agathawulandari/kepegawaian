<?php
include 'koneksi.php';

$nama = htmlspecialchars($_POST['nama']);
$nip = htmlspecialchars($_POST['nip']);
$jk = $_POST['jk'];
$pendidikan = $_POST['pendidikan'];
$pangkat = $_POST['pangkat'];
$jabatan_id = $_POST['jabatan_id'];
$no_sk = htmlspecialchars($_POST['no_sk']);
$tmt_sk = htmlspecialchars($_POST['tmt_sk']);
$kelas_jabatan = $_POST['kelas_jabatan'];

$stmt = mysqli_prepare($koneksi, "INSERT INTO pegawai (nama, nip, jabatan_id, jk, pendidikan, pangkat, no_sk_terakhir, tmt_sk, kelas_jabatan) VALUES ( ?, ?, ?, ?, ?, ?, ?, ?, ?)");
mysqli_stmt_bind_param($stmt, "ssisssssi", $nama, $nip, $jabatan_id, $jk, $pendidikan, $pangkat, $no_sk, $tmt_sk, $kelas_jabatan);
mysqli_stmt_execute($stmt);

header("Location: index.php?page=kepegawaian");
