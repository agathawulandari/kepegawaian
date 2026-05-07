<?php
include 'koneksi.php';

$id = $_POST['id'];
$jatuh = $_POST['jatuh_tempo'];

mysqli_query($koneksi, "
    INSERT INTO pengajuan_pangkat (pegawai_id, tanggal_pengajuan, jatuh_tempo)
    VALUES ('$id', NOW(), '$jatuh')
");

header("Location: index.php?page=riwayat-pengajuan");
exit;
