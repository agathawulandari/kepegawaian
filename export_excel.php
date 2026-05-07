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
    SELECT p.*, j.nama_jabatan, parent.nama_jabatan AS parent_nama
    FROM pegawai p
    LEFT JOIN jabatan j ON p.jabatan_id = j.id
    LEFT JOIN jabatan parent ON j.parent_id = parent.id
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
$sheet->mergeCells('A1:J1');
$sheet->setCellValue('A1', 'KEMENTERIAN IMIGRASI DAN PEMASYARAKATAN REPUBLIK INDONESIA');

$sheet->mergeCells('A2:J2');
$sheet->setCellValue('A2', 'DIREKTORAT JENDERAL PEMASYARAKATAN');

$sheet->mergeCells('A3:J3');
$sheet->setCellValue('A3', 'KANTOR WILAYAH RIAU');

$sheet->mergeCells('A4:J4');
$sheet->setCellValue('A4', 'LEMBAGA PEMASYARAKATAN KELAS IIA PEKANBARU');

$sheet->mergeCells('A5:J5');
$sheet->setCellValue('A5', 'Jalan Pemasyarakatan Nomor 19, Pekanbaru 28222 Telp/Fax: 0761-22262');

$sheet->mergeCells('A6:J6');
$sheet->setCellValue('A6', 'Laman: www.lapaspekanbaru.id, Surel: lp2apekanbaru@gmail.com');

// style header
$sheet->getStyle('A1:A6')->applyFromArray([
    'font' => ['bold' => true, 'size' => 12]
]);

$sheet->getStyle('A1:J6')->getAlignment()
    ->setHorizontal(Alignment::HORIZONTAL_CENTER);

// tinggi baris
for ($i = 1; $i <= 6; $i++) {
    $sheet->getRowDimension($i)->setRowHeight(20);
}

// ================= GARIS KOP =================
$sheet->getStyle('A7:J7')->applyFromArray([
    'borders' => [
        'bottom' => ['borderStyle' => Border::BORDER_THICK]
    ]
]);

// ================= JUDUL =================
$sheet->mergeCells('A10:J10');
$sheet->setCellValue('A10', 'LAPORAN DATA PEGAWAI');

$sheet->getStyle('A10')->applyFromArray([
    'font' => ['bold' => true, 'size' => 14],
    'alignment' => ['horizontal' => Alignment::HORIZONTAL_CENTER]
]);

// ================= HEADER TABEL =================
$sheet->setCellValue('A12', 'No');
$sheet->setCellValue('B12', 'NIP');
$sheet->setCellValue('C12', 'Nama');
$sheet->setCellValue('D12', 'JK');
$sheet->setCellValue('E12', 'Pendidikan');
$sheet->setCellValue('F12', 'Pangkat');
$sheet->setCellValue('G12', 'Jabatan');
$sheet->setCellValue('H12', 'Kelas');
$sheet->setCellValue('I12', 'No SK');
$sheet->setCellValue('J12', 'TMT SK');

// style header tabel
$sheet->getStyle('A12:J12')->applyFromArray([
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
    if ($jabatan == 'Staff' && $data['parent_nama']) {
        $jabatan = "Staff " . $data['parent_nama'];
    }

    $sheet->setCellValue('A' . $row, $no++);
    $sheet->setCellValue('B' . $row, $data['nip']);
    $sheet->setCellValue('C' . $row, $data['nama']);
    $sheet->setCellValue('D' . $row, $data['jk']);
    $sheet->setCellValue('E' . $row, $data['pendidikan']);
    $sheet->setCellValue('F' . $row, $data['pangkat']);
    $sheet->setCellValue('G' . $row, $jabatan);
    $sheet->setCellValue('H' . $row, $data['kelas_jabatan']);
    $sheet->setCellValue('I' . $row, $data['no_sk_terakhir']);
    $sheet->setCellValue('J' . $row, $data['tmt_sk']);

    $row++;
}

// ================= AUTO WIDTH =================
foreach (range('A', 'J') as $col) {
    $sheet->getColumnDimension($col)->setAutoSize(true);
}

// ================= BORDER =================
$sheet->getStyle('A12:J' . ($row - 1))->applyFromArray([
    'borders' => [
        'allBorders' => ['borderStyle' => Border::BORDER_THIN]
    ]
]);

// ================= OUTPUT =================
$filename = "Laporan_Pegawai.xlsx";

header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header("Content-Disposition: attachment; filename=\"$filename\"");

$writer = new Xlsx($spreadsheet);
$writer->save("php://output");
exit;
