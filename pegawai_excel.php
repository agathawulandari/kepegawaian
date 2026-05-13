<?php
require 'vendor/autoload.php';
include "koneksi.php";

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Worksheet\Drawing;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Fill;

// ================= QUERY (SUPPORT SEARCH) =================
$cari = isset($_GET['cari']) ? trim($_GET['cari']) : '';

$params = [];
$types = "";

$sql = "
    SELECT 
        p.nip,
        p.nama,
        p.jk,
        p.pangkat,
        p.tmt_sk,
        p.jabatan_id,
        p.tgl_pelantikan,
        p.tmt_jabatan,
        p.jns_jabatan,
        p.agama,
        p.no_hp,
        p.alamat,
        p.pelatihan,
        p.thn_pelatihan,
        p.pendidikan,
        pp.jatuh_tempo,
        j.nama_jabatan
    FROM pegawai p
    LEFT JOIN jabatan j ON p.jabatan_id = j.id
    LEFT JOIN (
            SELECT pengajuan_pangkat.*
            FROM pengajuan_pangkat
            INNER JOIN (
                SELECT pegawai_id, MAX(id) AS max_id
                FROM pengajuan_pangkat
                GROUP BY pegawai_id
            ) terbaru
            ON pengajuan_pangkat.id = terbaru.max_id
        ) pp
        ON p.id = pp.pegawai_id
    WHERE 1=1
";

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

$stmt = mysqli_prepare($koneksi, $sql);

if (!empty($params)) {
    mysqli_stmt_bind_param($stmt, $types, ...$params);
}

mysqli_stmt_execute($stmt);
$query = mysqli_stmt_get_result($stmt);

// ================= INIT =================
$spreadsheet = new Spreadsheet();
$sheet = $spreadsheet->getActiveSheet();

// ================= LOGO =================
$drawing = new Drawing();
$drawing->setPath(__DIR__ . '/Logo imipas.png');
$drawing->setHeight(100);

// posisi dasar (kiri, agak tengah)
$drawing->setCoordinates('A2');

// geser horizontal (dari kiri)
$drawing->setOffsetX(10);

// geser vertikal (biar ke tengah kop)
$drawing->setOffsetY(10);

$drawing->setWorksheet($sheet);

// ================= HEADER =================
$sheet->mergeCells('A1:P1');
$sheet->setCellValue('A1', 'KEMENTERIAN IMIGRASI DAN PEMASYARAKATAN REPUBLIK INDONESIA');

$sheet->mergeCells('A2:P2');
$sheet->setCellValue('A2', 'DIREKTORAT JENDERAL PEMASYARAKATAN');

$sheet->mergeCells('A3:P3');
$sheet->setCellValue('A3', 'KANTOR WILAYAH RIAU');

$sheet->mergeCells('A4:P4');
$sheet->setCellValue('A4', 'LEMBAGA PEMASYARAKATAN KELAS IIA PEKANBARU');

$sheet->mergeCells('A5:P5');
$sheet->setCellValue('A5', 'Jalan Pemasyarakatan Nomor 19, Pekanbaru 28222 Telp/Fax: 0761-22262');

$sheet->mergeCells('A6:P6');
$sheet->setCellValue('A6', 'Laman: www.lapaspekanbaru.id, Surel: lp2apekanbaru@gmail.com');

// style header
$sheet->getStyle('A1:P6')->applyFromArray([
    'font' => ['bold' => true, 'size' => 12]
]);

$sheet->getStyle('A1:P6')->getAlignment()
    ->setHorizontal(Alignment::HORIZONTAL_CENTER);

// tinggi baris
for ($i = 1; $i <= 6; $i++) {
    $sheet->getRowDimension($i)->setRowHeight(20);
}

// ================= GARIS KOP =================
$sheet->getStyle('A7:P7')->applyFromArray([
    'borders' => [
        'bottom' => ['borderStyle' => Border::BORDER_THICK]
    ]
]);

// ================= JUDUL =================
$sheet->mergeCells('A10:P10');
$sheet->setCellValue('A10', 'LAPORAN DATA PEGAWAI');

$sheet->getStyle('A10')->applyFromArray([
    'font' => ['bold' => true, 'size' => 14],
    'alignment' => ['horizontal' => Alignment::HORIZONTAL_CENTER]
]);

// ================= HEADER TABEL =================
$headers = [
    'A12' => 'No',
    'B12' => 'NIP',
    'C12' => 'Nama Lengkap',
    'D12' => 'L/P',
    'E12' => 'Golongan',
    'F12' => 'TMT Golongan',
    'G12' => 'Jabatan',
    'H12' => 'Tanggal Pelantikan',
    'I12' => 'TMT Jabatan',
    'J12' => 'Jenis Jabatan',
    'K12' => 'Agama',
    'L12' => 'Telepon',
    'M12' => 'Alamat',
    'N12' => 'Pelatihan Yang Sudah Diikuti',
    'O12' => 'Tahun Pelatihan',
    'P12' => 'Pendidikan Terakhir'
];

foreach ($headers as $cell => $text) {
    $sheet->setCellValue($cell, $text);
}

// style header tabel
$sheet->getStyle('A12:P12')->applyFromArray([
    'font' => ['bold' => true, 'color' => ['rgb' => 'FFFFFF']],
    'fill' => [
        'fillType' => Fill::FILL_SOLID,
        'startColor' => ['rgb' => '4F81BD']
    ],
    'alignment' => ['horizontal' => Alignment::HORIZONTAL_CENTER]
]);

// ================= ISI DATA =================
$row = 13;
$no = 1;

while ($data = mysqli_fetch_assoc($query)) {

    $jabatan = $data['nama_jabatan'];

    $sheet->setCellValue('A' . $row, $no++);
    $sheet->setCellValue('B' . $row, $data['nip']);
    $sheet->setCellValue('C' . $row, $data['nama']);
    $sheet->setCellValue('D' . $row, $data['jk']);
    $sheet->setCellValue('E' . $row, $data['pangkat']);

    $tmt = (!empty($data['jatuh_tempo']) && $data['jatuh_tempo'] != '0000-00-00')
        ? $data['jatuh_tempo']
        : $data['tmt_sk'];

    $sheet->setCellValue('F' . $row, $tmt);

    $sheet->setCellValue('G' . $row, $jabatan);
    $sheet->setCellValue('H' . $row, $data['tgl_pelantikan']);
    $sheet->setCellValue('I' . $row, $data['tmt_jabatan']);
    $sheet->setCellValue('J' . $row, $data['jns_jabatan']);
    $sheet->setCellValue('K' . $row, $data['agama']);
    $sheet->setCellValue('L' . $row, $data['no_hp']);
    $sheet->setCellValue('M' . $row, $data['alamat']);
    $sheet->setCellValue('N' . $row, $data['pelatihan']);
    $sheet->setCellValue('O' . $row,
    (!empty($data['thn_pelatihan']) && $data['thn_pelatihan'] != '0000')
        ? $data['thn_pelatihan']
        : '-');
    $sheet->setCellValue('P' . $row, $data['pendidikan']);

    $row++;
}

// ================= FORMAT TANGGAL =================
// ================= FORMAT TANGGAL =================
for ($i = 13; $i < $row; $i++) {

    // TMT Golongan
    if (!empty($sheet->getCell('F' . $i)->getValue())) {
        $sheet->setCellValue(
            'F' . $i,
            date('d-m-Y', strtotime($sheet->getCell('F' . $i)->getValue()))
        );
    }

    // Tanggal Pelantikan
    if (!empty($sheet->getCell('H' . $i)->getValue())) {
        $sheet->setCellValue(
            'H' . $i,
            date('d-m-Y', strtotime($sheet->getCell('H' . $i)->getValue()))
        );
    }

    // TMT Jabatan
    if (!empty($sheet->getCell('I' . $i)->getValue())) {
        $sheet->setCellValue(
            'I' . $i,
            date('d-m-Y', strtotime($sheet->getCell('I' . $i)->getValue()))
        );
    }
}

// ================= WRAP TEXT =================
$sheet->getStyle('A12:P' . ($row - 1))
    ->getAlignment()
    ->setWrapText(true);

// ================= AUTO WIDTH =================
foreach (range('A', 'P') as $col) {
    $sheet->getColumnDimension($col)->setAutoSize(true);
}

// ================= BORDER =================
$sheet->getStyle('A12:P' . ($row - 1))->applyFromArray([
    'borders' => [
        'allBorders' => ['borderStyle' => Border::BORDER_THIN]
    ]
]);

// ================= OUTPUT =================
$filename = "Laporan_Pegawai.xlsx";

// bersihkan output sebelumnya
if (ob_get_length()) {
    ob_end_clean();
}

header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="' . $filename . '"');
header('Cache-Control: max-age=0');

$writer = new Xlsx($spreadsheet);
$writer->save('php://output');
exit;
