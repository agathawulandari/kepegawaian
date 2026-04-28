<?php
include 'koneksi.php';
$id = $_GET['id'];

$stmt = mysqli_prepare($koneksi, "SELECT * FROM pegawai WHERE id=?");
mysqli_stmt_bind_param($stmt, "i", $id);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$data = mysqli_fetch_assoc($result);
?>

<link rel="stylesheet" href="style.css">
    <div class="container">

    <h2>Edit Pegawai</h2>

    <form method="POST" action="update.php">
        <input type="hidden" name="id" value="<?= $data['id'] ?>">

        Nama:<br>
        <input type="text" name="nama" value="<?= $data['nama'] ?>"><br>

        NIP:<br>
        <input type="text" name="nip" value="<?= $data['nip'] ?>"><br>

        Jabatan:<br>
        <input type="text" name="jabatan" value="<?= $data['jabatan'] ?>"><br>

        Alamat:<br>
        <textarea name="alamat"><?= $data['alamat'] ?></textarea><br>

        No HP:<br>
        <input type="text" name="no_hp" value="<?= $data['no_hp'] ?>"><br><br>

        <button type="submit">Update</button>
    </form>

</div>