<?php
include 'koneksi.php';

date_default_timezone_set('Asia/Jakarta');

// FUNCTION UBAH FORMAT TANGGAL
function formatTanggal($tanggal)
{
    if (empty($tanggal)) {
        return null;
    }
    $pecah = explode('-', $tanggal);

    // dd-mm-yyyy → yyyy-mm-dd
    return $pecah[2] . '-' . $pecah[1] . '-' . $pecah[0];
}

// AMBIL DATA POST
$nip             = mysqli_real_escape_string($koneksi, $_POST['nip']);
$nama            = mysqli_real_escape_string($koneksi, $_POST['nama']);
$jk              = mysqli_real_escape_string($koneksi, $_POST['jk']);
$pangkat         = mysqli_real_escape_string($koneksi, $_POST['pangkat']);
$tmt_sk          = formatTanggal($_POST['tmt_sk']);
$jabatan_id      = mysqli_real_escape_string($koneksi, $_POST['jabatan_id']);
$tgl_pelantikan  = formatTanggal($_POST['tgl_pelantikan']);
$tmt_jabatan     = formatTanggal($_POST['tmt_jabatan']);
$jns_jabatan     = mysqli_real_escape_string($koneksi, $_POST['jns_jabatan']);
$agama           = mysqli_real_escape_string($koneksi, $_POST['agama']);
$no_hp           = mysqli_real_escape_string($koneksi, $_POST['no_hp']);
$alamat          = mysqli_real_escape_string($koneksi, $_POST['alamat']);
$pelatihan       = mysqli_real_escape_string($koneksi, $_POST['pelatihan']);
$thn_pelatihan   = mysqli_real_escape_string($koneksi, $_POST['thn_pelatihan']);
$pendidikan      = mysqli_real_escape_string($koneksi, $_POST['pendidikan']);

// INSERT DATA
$query = mysqli_query($koneksi, "
    INSERT INTO pegawai (
        nip,
        nama,
        jk,
        pangkat,
        tmt_sk,
        jabatan_id,
        tgl_pelantikan,
        tmt_jabatan,
        jns_jabatan,
        agama,
        no_hp,
        alamat,
        pelatihan,
        thn_pelatihan,
        pendidikan
    ) VALUES (
        '$nip',
        '$nama',
        '$jk',
        '$pangkat',
        '$tmt_sk',
        '$jabatan_id',
        '$tgl_pelantikan',
        '$tmt_jabatan',
        '$jns_jabatan',
        '$agama',
        '$no_hp',
        '$alamat',
        '$pelatihan',
        '$thn_pelatihan',
        '$pendidikan'
    )
");


if ($query) {
    $_SESSION['success_message'] = "Data berhasil ditambahkan";
    header("Location: index.php?page=kepegawaian");
    exit;
} else {
    $_SESSION['error_message'] = "Data gagal ditambahkan";
    header("Location: index.php?page=tambah");
    exit;
}
