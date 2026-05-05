<?php
include 'koneksi.php';
session_start();


$id = $_POST['id'];
$foto_lama = $_POST['foto_lama'];
$nama = $_POST['nama'];
$nip = $_POST['nip'];
$jk = $_POST['jk'];
$pendidikan = $_POST['pendidikan'];
$pangkat = $_POST['pangkat'];
$jabatan_id = $_POST['jabatan_id'];
$no_sk = $_POST['no_sk'];
$tmt_sk = $_POST['tmt_sk'];
$kelas_jabatan = $_POST['kelas_jabatan'];
// ================= UPLOAD FOTO =================
$nama_file = $foto_lama;

if (isset($_FILES['foto']) && $_FILES['foto']['name'] != "") {

    $foto = $_FILES['foto']['name'];
    $tmp  = $_FILES['foto']['tmp_name'];
    $size = $_FILES['foto']['size'];

    $ext = strtolower(pathinfo($foto, PATHINFO_EXTENSION));
    $allowed = ['jpg', 'jpeg', 'png'];

    // validasi format
    if (!in_array($ext, $allowed)) {
        $_SESSION['error_message'] = "Format foto harus JPG/PNG!";
        header("Location: index.php?page=edit&id=" . $id);
        exit;
    }

    // validasi ukuran
    if ($size > 2 * 1024 * 1024) {
        $_SESSION['error_message'] = "Ukuran foto maksimal 2MB!";
        header("Location: index.php?page=edit&id=" . $id);
        exit;
    }

    // nama baru
    $nama_file = time() . "_" . $foto;

    // upload
    if (move_uploaded_file($tmp, "uploads/" . $nama_file)) {

        // hapus foto lama (jika ada)
        if (!empty($foto_lama) && file_exists("uploads/" . $foto_lama)) {
            unlink("uploads/" . $foto_lama);
        }
    } else {
        $_SESSION['error_message'] = "Gagal upload foto!";
        header("Location: index.php?page=edit&id=" . $id);
        exit;
    }
}

// ================= FILE SK =================
$file_sk_lama = $_POST['file_sk_lama'] ?? "";
$nama_file_sk = $file_sk_lama;

// cek apakah user upload file baru
if (isset($_FILES['file_sk']) && $_FILES['file_sk']['name'] != "") {

    $file = $_FILES['file_sk']['name'];
    $tmp  = $_FILES['file_sk']['tmp_name'];
    $size = $_FILES['file_sk']['size'];

    $ext = strtolower(pathinfo($file, PATHINFO_EXTENSION));
    $allowed = ['pdf', 'jpg', 'jpeg', 'png'];

    // validasi ekstensi
    if (!in_array($ext, $allowed)) {
        $_SESSION['error_message'] = "File SK harus PDF/JPG/PNG!";
        header("Location: index.php?page=edit&id=" . $id);
        exit;
    }

    // validasi ukuran
    if ($size > 5 * 1024 * 1024) {
        $_SESSION['error_message'] = "Ukuran file maksimal 5MB!";
        header("Location: index.php?page=edit&id=" . $id);
        exit;
    }

    // buat nama aman
    $nama_tanpa_ext = pathinfo($file, PATHINFO_FILENAME);
    $nama_bersih = preg_replace("/[^a-zA-Z0-9]/", "_", $nama_tanpa_ext);
    $nama_file_sk = time() . "_" . $nama_bersih . "." . $ext;

    // upload file baru
    if (move_uploaded_file($tmp, "files/" . $nama_file_sk)) {

        // jika sebelumnya ada file → hapus
        if (!empty($file_sk_lama) && file_exists("files/" . $file_sk_lama)) {
            unlink("files/" . $file_sk_lama);
        }
    } else {
        $_SESSION['error_message'] = "Gagal upload file!";
        header("Location: index.php?page=edit&id=" . $id);
        exit;
    }
} else {
    // ❗ tidak upload file baru

    if (empty($file_sk_lama)) {
        // ➕ CREATE tapi tidak upload → ERROR
        $_SESSION['error_message'] = "File SK wajib diupload!";
        header("Location: index.php?page=edit&id=" . $id);
        exit;
    }

    // 🔁 UPDATE tanpa upload → pakai file lama
    $nama_file_sk = $file_sk_lama;
}

// 🔒 VALIDASI TAMBAHAN (anti hilang ekstensi)
if (!empty($nama_file_sk) && !str_contains($nama_file_sk, '.')) {
    $_SESSION['error_message'] = "Nama file tidak valid (tanpa ekstensi)!";
    header("Location: index.php?page=edit&id=" . $id);
    exit;
}



$stmt = mysqli_prepare($koneksi, "UPDATE pegawai SET nama=?, nip=?, jabatan_id=?, jk=?, pendidikan=?, pangkat=?, no_sk_terakhir=?, tmt_sk=?, kelas_jabatan=?, foto=?, file_sk=? WHERE id=?");
mysqli_stmt_bind_param($stmt, "ssissssssssi", $nama, $nip, $jabatan_id, $jk, $pendidikan, $pangkat, $no_sk, $tmt_sk, $kelas_jabatan, $nama_file, $nama_file_sk, $id);
// mysqli_stmt_execute($stmt);

$execute = mysqli_stmt_execute($stmt);

if ($execute) {
    $_SESSION['success_message'] = "Data berhasil diupdate!";
} else {
    $_SESSION['error_message'] = "Terjadi kesalahan saat mengupdate data.";
}

header("Location: index.php?page=kepegawaian");
