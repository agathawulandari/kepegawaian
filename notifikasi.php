<?php
include 'koneksi.php';
date_default_timezone_set('Asia/Jakarta');

function getPeriode($tmt)
{
    $periode = [];
    $tanggal = $tmt;

    for ($i = 0; $i < 25; $i++) {
        $tanggal = date('Y-m-d', strtotime($tanggal . ' +2 years'));
        $periode[] = $tanggal;
    }

    return $periode;
}

$data = mysqli_query($koneksi, "SELECT * FROM pegawai");

$notif = [];
$hari_ini = date('Y-m-d');

while ($d = mysqli_fetch_assoc($data)) {

    // 🔥 CEK PENGAJUAN TERAKHIR
    $last = mysqli_query($koneksi, "
        SELECT jatuh_tempo
        FROM pengajuan_pangkat
        WHERE pegawai_id = '{$d['id']}'
        ORDER BY jatuh_tempo DESC
        LIMIT 1
    ");

    // 🔥 JIKA ADA PENGAJUAN → PAKAI TMT TERAKHIR
    // 🔥 JIKA TIDAK ADA → PAKAI tmt_sk DARI TABEL pegawai
    if (mysqli_num_rows($last) > 0) {

        $lp = mysqli_fetch_assoc($last);

        $dasar_tmt = $lp['jatuh_tempo'];
    } else {

        $dasar_tmt = $d['tmt_sk'];
    }

    // 🔥 GENERATE PERIODE BERIKUTNYA
    $periodes = getPeriode($dasar_tmt);

    foreach ($periodes as $jatuh_tempo) {

        $tahun = date('Y', strtotime($jatuh_tempo));

        // 🔥 CEK APAKAH SUDAH ADA PENGAJUAN DI TAHUN INI
        $cek = mysqli_query($koneksi, "
            SELECT 1 
            FROM pengajuan_pangkat 
            WHERE pegawai_id = '{$d['id']}'
            AND YEAR(jatuh_tempo) = '$tahun'
            LIMIT 1
        ");

        // 🔥 JIKA SUDAH ADA → LEWATI
        if (mysqli_num_rows($cek) > 0) {
            continue;
        }

        // 🔥 HITUNG H-3 BULAN
        $tanggal_pengingat = date(
            'Y-m-d',
            strtotime($jatuh_tempo . ' -3 months')
        );

        // 🔥 TAMPILKAN NOTIFIKASI
        if ($hari_ini >= $tanggal_pengingat && $hari_ini <= $jatuh_tempo) {

            $d['status'] = 'warning';

            $d['jatuh_tempo'] = $jatuh_tempo;

            $notif[] = $d;

            break;
        }

        // 🔥 OPSIONAL:
        // TAMPILKAN JIKA SUDAH LEWAT JATUH TEMPO
        elseif ($hari_ini > $jatuh_tempo) {

            $d['status'] = 'danger';

            $d['jatuh_tempo'] = $jatuh_tempo;

            $notif[] = $d;

            break;
        }
    }
}

// function getPeriode($tmt, $last)
// {
//     $dasar = $last ? $last : $tmt;

//     $periode = [];
//     $tanggal = $dasar;

//     for ($i = 0; $i < 25; $i++) { // 25 x 2 tahun = 50 tahun
//         $tanggal = date('Y-m-d', strtotime($tanggal . ' +2 years'));
//         $periode[] = $tanggal;
//     }

//     return $periode;
// }

// $data = mysqli_query($koneksi, "SELECT * FROM pegawai");
// $notif = [];
// $hari_ini = date('Y-m-d');
// // $batas = date('Y-m-d', strtotime('+3 months'));

// while ($d = mysqli_fetch_assoc($data)) {

//     $periodes = getPeriode($d['tmt_sk'], $d['last_pengajuan']);

//     foreach ($periodes as $jatuh_tempo) {

//         // 🔥 HITUNG H-3 BULAN
//         $tanggal_pengingat = date('Y-m-d', strtotime($jatuh_tempo . ' -3 months'));

//         if ($hari_ini >= $tanggal_pengingat && $hari_ini <= $jatuh_tempo) {
//             $d['status'] = 'warning'; // H-3 bulan
//             $d['jatuh_tempo'] = $jatuh_tempo;
//             $notif[] = $d;
//             break; // keluar dari loop periode jika sudah masuk notifikasi
//         } elseif ($hari_ini > $jatuh_tempo) {
//             $d['status'] = 'danger'; // sudah lewat
//             $d['jatuh_tempo'] = $jatuh_tempo;
//             $notif[] = $d;
//             break; // keluar dari loop periode jika sudah masuk notifikasi
//         }
//     }
// }
