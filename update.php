<?php
session_start();
include 'koneksi.php';

date_default_timezone_set('Asia/Jakarta');

function formatTanggal($tanggal)
{
    if (empty($tanggal)) {
        return null;
    }

    $pecah = explode('-', $tanggal);

    // dd-mm-yyyy → yyyy-mm-dd
    return $pecah[2] . '-' . $pecah[1] . '-' . $pecah[0];
}

$id             = $_POST['id'];
$nip            = mysqli_real_escape_string($koneksi, $_POST['nip']);
$nama           = mysqli_real_escape_string($koneksi, $_POST['nama']);
$jk             = mysqli_real_escape_string($koneksi, $_POST['jk']);
$pangkat        = mysqli_real_escape_string($koneksi, $_POST['pangkat']);
$tmt_sk         = formatTanggal($_POST['tmt_sk']);
$jabatan_id     = mysqli_real_escape_string($koneksi, $_POST['jabatan_id']);
$tgl_pelantikan = formatTanggal($_POST['tgl_pelantikan']);
$tmt_jabatan    = formatTanggal($_POST['tmt_jabatan']);
$jns_jabatan    = mysqli_real_escape_string($koneksi, $_POST['jns_jabatan']);
$agama          = mysqli_real_escape_string($koneksi, $_POST['agama']);
$no_hp          = mysqli_real_escape_string($koneksi, $_POST['no_hp']);
$alamat         = mysqli_real_escape_string($koneksi, $_POST['alamat']);
$pelatihan      = mysqli_real_escape_string($koneksi, $_POST['pelatihan']);
$thn_pelatihan  = mysqli_real_escape_string($koneksi, $_POST['thn_pelatihan']);
$pendidikan     = mysqli_real_escape_string($koneksi, $_POST['pendidikan']);


// CEK NIP DUPLIKAT
$cek = mysqli_query($koneksi, "
    SELECT * FROM pegawai 
    WHERE nip = '$nip'
    AND id != '$id'
");

if (mysqli_num_rows($cek) > 0) {

    $_SESSION['error_message'] = "NIP sudah terdaftar!";

    header("Location: index.php?page=edit_pegawai&id=$id");
    exit;
}

// UPDATE DATA
$query = mysqli_query($koneksi, "
    UPDATE pegawai SET
        nip = '$nip',
        nama = '$nama',
        jk = '$jk',
        pangkat = '$pangkat',
        tmt_sk = '$tmt_sk',
        jabatan_id = '$jabatan_id',
        tgl_pelantikan = '$tgl_pelantikan',
        tmt_jabatan = '$tmt_jabatan',
        jns_jabatan = '$jns_jabatan',
        agama = '$agama',
        no_hp = '$no_hp',
        alamat = '$alamat',
        pelatihan = '$pelatihan',
        thn_pelatihan = '$thn_pelatihan',
        pendidikan = '$pendidikan'
    WHERE id = '$id'
");

if ($query) {

    $_SESSION['success_message'] = "Data berhasil diupdate!";

    header("Location: index.php?page=kepegawaian");
    exit;
} else {

    $_SESSION['error_message'] = "Data gagal diupdate!";

    header("Location: index.php?page=edit_pegawai&id=$id");
    exit;
}
