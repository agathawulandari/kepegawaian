<?php
include 'template/topbar.php';
?>

<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Detail Data Pegawai</h1>
    </div>
    <!-- Content Row -->
    <div class="row g-3">
        <div class="col-xl-12 col-md-12 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">

                    <?php
                    include 'koneksi.php';
                    $id = $_GET['id'];

                    $stmt = mysqli_prepare($koneksi, "SELECT * FROM pegawai WHERE id=?");
                    mysqli_stmt_bind_param($stmt, "i", $id);
                    mysqli_stmt_execute($stmt);
                    $result = mysqli_stmt_get_result($stmt);
                    $data = mysqli_fetch_assoc($result);
                    ?>
                    <input type="hidden" name="id" value="<?= $data['id'] ?>">

                    <div class="mb-2">
                        <label class="col-md-4" style="font-size: 19px; font-weight: bold;">NIP</label>
                        <span class="col-md-8" style="font-size: 18px;"><?= $data['nip'] ?></span>
                    </div>

                    <div class="mb-2">
                        <label class="col-md-4" style="font-size: 19px; font-weight: bold;">Nama Lengkap</label>
                        <span class="col-md-8" style="font-size: 18px;"><?= $data['nama'] ?></span>
                    </div>

                    <div class="mb-2">
                        <label class="col-md-4" style="font-size: 19px; font-weight: bold;">Jenis Kelamin</label>
                        <span class="col-md-8" style="font-size: 18px;"><?= $data['jk'] ?></span>
                    </div>

                    <div class="mb-2">
                        <label class="col-md-4" style="font-size: 19px; font-weight: bold;">Pangkat/Golongan</label>
                        <span class="col-md-8" style="font-size: 18px;"><?= $data['pangkat'] ?></span>
                    </div>

                    <div class="mb-2">
                        <label class="col-md-4" style="font-size: 19px; font-weight: bold;">TMT SK Golongan Terakhir</label>
                        <span class="col-md-8" style="font-size: 18px;"><?= date('d-m-Y', strtotime($data['tmt_sk'])) ?></span>
                    </div>

                    <div class="mb-2">
                        <?php
                        include 'koneksi.php';
                        $id_jabatan = $data['jabatan_id'];

                        $query = mysqli_query($koneksi, "
                                        SELECT 
                                            j.nama_jabatan, 
                                            parent.nama_jabatan AS parent_nama
                                        FROM jabatan j
                                        LEFT JOIN jabatan parent ON j.id = parent.id
                                        WHERE j.id = '$id_jabatan'
                                    ");

                        $jabatan = mysqli_fetch_assoc($query);
                        $nama_jabatan = $jabatan['nama_jabatan'];
                        ?>
                        <label class="col-md-4" style="font-size: 19px; font-weight: bold;">Jabatan</label>
                        <span class="col-md-8" style="font-size: 18px;"><?= htmlspecialchars($nama_jabatan) ?></span>
                    </div>

                    <div class="mb-2">
                        <label class="col-md-4" style="font-size: 19px; font-weight: bold;">Tanggal Pelantikan</label>
                        <span class="col-md-8" style="font-size: 18px;"><?= date('d-m-Y', strtotime($data['tgl_pelantikan'])) ?></span>
                    </div>

                    <div class="mb-2">
                        <label class="col-md-4" style="font-size: 19px; font-weight: bold;">TMT Jabatan</label>
                        <span class="col-md-8" style="font-size: 18px;"><?= date('d-m-Y', strtotime($data['tmt_jabatan'])) ?></span>
                    </div>

                    <div class="mb-2">
                        <label class="col-md-4" style="font-size: 19px; font-weight: bold;">Jenis Jabatan</label>
                        <span class="col-md-8" style="font-size: 18px;"><?= $data['jns_jabatan'] ?></span>
                    </div>

                    <div class="mb-2">
                        <label class="col-md-4" style="font-size: 19px; font-weight: bold;">Agama</label>
                        <span class="col-md-8" style="font-size: 18px;"><?= $data['agama'] ?></span>
                    </div>

                    <div class="mb-2">
                        <label class="col-md-4" style="font-size: 19px; font-weight: bold;">No HP</label>
                        <span class="col-md-8" style="font-size: 18px;"><?= $data['no_hp'] ?></span>
                    </div>

                    <div class="mb-2">
                        <label class="col-md-4" style="font-size: 19px; font-weight: bold;">Alamat</label>
                        <span class="col-md-8" style="font-size: 18px;"><?= $data['alamat'] ?></span>
                    </div>

                    <div class="mb-2">
                        <label class="col-md-4" style="font-size: 19px; font-weight: bold;">Pelatihan yang Pernah Diikuti</label>
                        <span class="col-md-8" style="font-size: 18px;"><?= !empty($data['pelatihan']) ? htmlspecialchars($data['pelatihan']) : '-' ?></span>
                    </div>

                    <div class="mb-2">
                        <label class="col-md-4" style="font-size: 19px; font-weight: bold;">Tahun Pelatihan</label>
                        <span class="col-md-8" style="font-size: 18px;"><?= (!empty($data['thn_pelatihan']) && $data['thn_pelatihan'] != '0000') ? htmlspecialchars($data['thn_pelatihan']) : '-' ?></span>
                    </div>

                    <div class="mb-2">
                        <label class="col-md-4" style="font-size: 19px; font-weight: bold;">Pendidikan Terakhir</label>
                        <span class="col-md-8" style="font-size: 18px;"><?= $data['pendidikan'] ?></span>
                    </div>
                    <br>
                    <button type="button" class="btn btn-secondary" onclick="window.location.href='index.php?page=kepegawaian'  ">Kembali</button>

                    <br>
                </div>
            </div>
        </div>
    </div>
</div>