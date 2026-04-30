<?php
include 'koneksi.php';

$id = $_POST['id'];
$nama = $_POST['nama'];
$nip = $_POST['nip'];
$jk = $_POST['jk'];
$pendidikan = $_POST['pendidikan'];
$pangkat = $_POST['pangkat'];
$jabatan_id = $_POST['jabatan_id'];
$no_sk = $_POST['no_sk'];
$tmt_sk = $_POST['tmt_sk'];
$kelas_jabatan = $_POST['kelas_jabatan'];

$stmt = mysqli_prepare($koneksi, "UPDATE pegawai SET nama=?, nip=?, jabatan_id=?, jk=?, pendidikan=?, pangkat=?, no_sk_terakhir=?, tmt_sk=?, kelas_jabatan=? WHERE id=?");
mysqli_stmt_bind_param($stmt, "ssisssssii", $nama, $nip, $jabatan_id, $jk, $pendidikan, $pangkat, $no_sk, $tmt_sk, $kelas_jabatan, $id);
mysqli_stmt_execute($stmt);

header("Location: index.php?page=kepegawaian");
