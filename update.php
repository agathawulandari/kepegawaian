<?php
include 'koneksi.php';

$id = $_POST['id'];
$nama = $_POST['nama'];
$nip = $_POST['nip'];
$jabatan = $_POST['jabatan'];
$alamat = $_POST['alamat'];
$no_hp = $_POST['no_hp'];

$stmt = mysqli_prepare($koneksi, "UPDATE pegawai SET nama=?, nip=?, jabatan=?, alamat=?, no_hp=? WHERE id=?");
mysqli_stmt_bind_param($stmt, "sssssi", $nama, $nip, $jabatan, $alamat, $no_hp, $id);
mysqli_stmt_execute($stmt);

header("Location: index.php");
?>