<?php include 'koneksi.php'; ?>
<link rel="stylesheet" href="style.css">

<div class="container">
<h2>Data Pegawai Lapas Kelas IIA Pekanbaru</h2>

<a href="tambah.php">+ Tambah</a><br><br>

<table>
<tr>
    <th>No</th>
    <th>Nama</th>
    <th>NIP</th>
    <th>Jabatan</th>
    <th>Aksi</th>
</tr>

<?php
$no = 1;
$query = mysqli_query($koneksi, "SELECT * FROM pegawai");

while ($data = mysqli_fetch_assoc($query)) {
?>
<tr>
    <td><?= $no++ ?></td>
    <td><?= htmlspecialchars($data['nama']) ?></td>
    <td><?= htmlspecialchars($data['nip']) ?></td>
    <td><?= htmlspecialchars($data['jabatan']) ?></td>
    <td>
        <a href="edit.php?id=<?= $data['id'] ?>">Edit</a>
        <a href="hapus.php?id=<?= $data['id'] ?>" class="hapus" onclick="return confirm('Hapus data?')">Hapus</a>
    </td>
</tr>
<?php } ?>
</table>
</div>