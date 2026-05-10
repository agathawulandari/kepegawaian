<?php
require 'vendor/autoload.php';
include "koneksi.php";

use Dompdf\Dompdf;

// ================= AMBIL FILTER =================
$cari = isset($_GET['cari']) ? trim($_GET['cari']) : '';

$params = [];
$types = "";

$sql = "
    SELECT p.*, j.nama_jabatan, parent.nama_jabatan AS parent_nama
    FROM pegawai p
    LEFT JOIN jabatan j ON p.jabatan_id = j.id
    LEFT JOIN jabatan parent ON j.parent_id = parent.id
    WHERE 1=1
";

// FILTER SEARCH
if ($cari != '') {
    $cari = strtolower($cari);
    $kata_kunci = array_filter(explode(' ', $cari));

    foreach ($kata_kunci as $key) {
        $sql .= " AND (LOWER(p.nama) LIKE ? OR LOWER(p.nip) LIKE ?)";
        $param = "%$key%";
        $params[] = $param;
        $params[] = $param;
        $types .= "ss";
    }
}

// ================= EKSEKUSI QUERY =================
$stmt = mysqli_prepare($koneksi, $sql);

if (!empty($params)) {
    mysqli_stmt_bind_param($stmt, $types, ...$params);
}

mysqli_stmt_execute($stmt);
$query = mysqli_stmt_get_result($stmt);

// ================= LOGO =================
$path = 'Logo imipas.png';

if (file_exists($path)) {
    $type = pathinfo($path, PATHINFO_EXTENSION);
    $data_logo = file_get_contents($path);
    $base64 = 'data:image/' . $type . ';base64,' . base64_encode($data_logo);
} else {
    $base64 = '';
}

// ================= HTML =================
$html = '
<style>
    body { font-family: Arial; font-size: 11px; }
    .kop { text-align: center; }
    .kop img {
        position: absolute;
        left: 40px;
        top: 5px;
        width: 80px;
    }
    .garis {
        border-top: 3px solid black;
        border-bottom: 1px solid black;
        margin: 10px 0 20px 0;
    }
    table { width: 100%; border-collapse: collapse; }
    th, td {
        border: 1px solid black;
        padding: 5px;
        font-size: 10px;
    }
    th {
        background-color: #4F81BD;
        color: white;
    }
    .judul {
        text-align: center;
        font-weight: bold;
        font-size: 14px;
        margin-bottom: 10px;
    }
</style>

<div class="kop">
    ' . ($base64 ? '<img src="' . $base64 . '">' : '') . '
    <b>KEMENTERIAN IMIGRASI DAN PEMASYARAKATAN REPUBLIK INDONESIA</b><br>
    DIREKTORAT JENDERAL PEMASYARAKATAN<br>
    KANTOR WILAYAH RIAU<br>
    <b>LEMBAGA PEMASYARAKATAN KELAS IIA PEKANBARU</b><br>
    Jalan Pemasyarakatan Nomor 19, Pekanbaru 28222<br>
    Telp/Fax: 0761-22262<br> Email: lp2apekanbaru@gmail.com
</div>

<div class="garis"></div>

<div class="judul">LAPORAN DATA PEGAWAI</div>

<table>
<tr>
<th>No</th>
<th>NIP</th>
<th>Nama</th>
<th>JK</th>
<th>Pendidikan</th>
<th>Pangkat</th>
<th>Jabatan</th>
<th>Kelas</th>
<th>No SK</th>
<th>TMT Gol</th>
</tr>
';

// ================= DATA =================
$no = 1;

while ($data = mysqli_fetch_assoc($query)) {

    $jabatan = ($data['nama_jabatan'] == 'Staff' && $data['parent_nama'])
        ? "Staff " . $data['parent_nama']
        : $data['nama_jabatan'];

    $tmt = !empty($data['tmt_sk']) ? date('d-m-Y', strtotime($data['tmt_sk'])) : '-';

    $html .= "
    <tr>
        <td>{$no}</td>
        <td>{$data['nip']}</td>
        <td>{$data['nama']}</td>
        <td>{$data['jk']}</td>
        <td>{$data['pendidikan']}</td>
        <td>{$data['pangkat']}</td>
        <td>{$jabatan}</td>
        <td>{$data['kelas_jabatan']}</td>
        <td>{$data['no_sk_terakhir']}</td>
        <td>{$tmt}</td>
    </tr>
    ";

    $no++;
}

$html .= '</table>';

// ================= GENERATE PDF =================
$dompdf = new Dompdf();
$dompdf->loadHtml($html);
$dompdf->setPaper('A4', 'landscape');
$dompdf->render();

// tampil di browser
// $dompdf->stream("Laporan_Pegawai.pdf", ["Attachment" => false]);
$cari = isset($_GET['cari']) ? trim($_GET['cari']) : '';

$namaFile = "Laporan_Pegawai";

if (!empty($cari)) {
    $namaFile .= "_" . preg_replace('/[^a-z0-9]/i', '_', $cari);
}

$namaFile .= ".pdf";

$dompdf->stream($namaFile, ["Attachment" => false]);
