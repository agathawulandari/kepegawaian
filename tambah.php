<?php
include 'template/topbar.php';
?>

<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Tambah Data</h1>
    </div>

    <!-- Content Row -->
    <div class="row">
        <div class="col-xl-12 col-md-12 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <form method="POST" action="tambah_aksi.php" enctype="multipart/form-data">

                        <!-- Baris 1 -->
                        <div class="row">
                            <!-- NIP -->
                            <div class="col-md-6 mb-3">
                                <label for="nip" class="form-label"><b>NIP</b></label>
                                <input type="text" class="form-control" id="nip" name="nip" value="<?= $_SESSION['old']['nip'] ?? '' ?>" required>
                            </div>

                            <!-- Nama Lengkap -->
                            <div class="col-md-6 mb-3">
                                <label for="nama" class="form-label"><b>Nama Lengkap</b></label>
                                <input type="text" class="form-control" id="nama" name="nama" value="<?= $_SESSION['old']['nama'] ?? '' ?>" required>
                            </div>
                        </div>

                        <!-- Baris 2 -->
                        <div class="row">
                            <!-- Jenis Kelamin -->
                            <div class="col-md-6 mb-3">
                                <label class="form-label d-block"><b>Jenis Kelamin</b></label>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio"
                                        name="jk" id="lk"
                                        value="Laki-laki"
                                        <?= (($_SESSION['old']['jk'] ?? '') == 'Laki-laki')
                                            ? 'checked'
                                            : '' ?>>
                                    <label class="form-check-label" for="lk">
                                        Laki-laki
                                    </label>
                                </div>

                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio"
                                        name="jk" id="pr"
                                        value="Perempuan"
                                        <?= (($_SESSION['old']['jk'] ?? '') == 'Perempuan')
                                            ? 'checked'
                                            : '' ?>>
                                    <label class="form-check-label" for="pr">
                                        Perempuan
                                    </label>
                                </div>
                            </div>

                            <!-- Pangkat -->
                            <div class="col-md-6 mb-3">
                                <label for="pangkat" class="form-label"><b>Pangkat/Golongan</b></label>
                                <select class="form-select" name="pangkat" id="pangkat" required>
                                    <option value="" disabled selected>Pilih Pangkat</option>
                                    <!-- Golongan I -->
                                    <!-- Golongan I -->
                                    <optgroup label="Golongan I – Juru">
                                        <option value="Juru Muda/I/A"
                                            <?= (($_SESSION['old']['pangkat'] ?? '') == 'Juru Muda/I/A')
                                                ? 'selected'
                                                : '' ?>>
                                            Juru Muda / I/A
                                        </option>
                                        <option value="Juru Muda Tk. I/I/B"
                                            <?= (($_SESSION['old']['pangkat'] ?? '') == 'Juru Muda Tk. I/I/B')
                                                ? 'selected'
                                                : '' ?>>
                                            Juru Muda Tk. I / I/B
                                        </option>
                                        <option value="Juru/I/C"
                                            <?= (($_SESSION['old']['pangkat'] ?? '') == 'Juru/I/C')
                                                ? 'selected'
                                                : '' ?>>
                                            Juru / I/C
                                        </option>
                                        <option value="Juru Tk. I/I/D"
                                            <?= (($_SESSION['old']['pangkat'] ?? '') == 'Juru Tk. I/I/D')
                                                ? 'selected'
                                                : '' ?>>
                                            Juru Tk. I / I/D
                                        </option>
                                    </optgroup>

                                    <!-- Golongan II -->
                                    <optgroup label="Golongan II – Pengatur">
                                        <option value="Pengatur Muda/II/A"
                                            <?= (($_SESSION['old']['pangkat'] ?? '') == 'Pengatur Muda/II/A')
                                                ? 'selected'
                                                : '' ?>>
                                            Pengatur Muda / II/A
                                        </option>
                                        <option value="Pengatur Muda Tk. I/II/B"
                                            <?= (($_SESSION['old']['pangkat'] ?? '') == 'Pengatur Muda Tk. I/II/B')
                                                ? 'selected'
                                                : '' ?>>
                                            Pengatur Muda Tk. I / II/B
                                        </option>
                                        <option value="Pengatur/II/C"
                                            <?= (($_SESSION['old']['pangkat'] ?? '') == 'Pengatur/II/C')
                                                ? 'selected'
                                                : '' ?>>
                                            Pengatur / II/C
                                        </option>
                                        <option value="Pengatur Tk. I/II/D"
                                            <?= (($_SESSION['old']['pangkat'] ?? '') == 'Pengatur Tk. I/II/D')
                                                ? 'selected'
                                                : '' ?>>
                                            Pengatur Tk. I / II/D
                                        </option>
                                    </optgroup>

                                    <!-- Golongan III -->
                                    <optgroup label="Golongan III – Penata">
                                        <option value="Penata Muda/III/A"
                                            <?= (($_SESSION['old']['pangkat'] ?? '') == 'Penata Muda/III/A')
                                                ? 'selected'
                                                : '' ?>>
                                            Penata Muda / III/A
                                        </option>
                                        <option value="Penata Muda Tk. I/III/B"
                                            <?= (($_SESSION['old']['pangkat'] ?? '') == 'Penata Muda Tk. I/III/B')
                                                ? 'selected'
                                                : '' ?>>
                                            Penata Muda Tk. I / III/B
                                        </option>
                                        <option value="Penata/III/C"
                                            <?= (($_SESSION['old']['pangkat'] ?? '') == 'Penata/III/C')
                                                ? 'selected'
                                                : '' ?>>
                                            Penata / III/C
                                        </option>
                                        <option value="Penata Tk. I/III/D"
                                            <?= (($_SESSION['old']['pangkat'] ?? '') == 'Penata Tk. I/III/D')
                                                ? 'selected'
                                                : '' ?>>
                                            Penata Tk. I / III/D
                                        </option>
                                    </optgroup>

                                    <!-- Golongan IV -->
                                    <optgroup label="Golongan IV – Pembina">
                                        <option value="Pembina/IV/A"
                                            <?= (($_SESSION['old']['pangkat'] ?? '') == 'Pembina/IV/A')
                                                ? 'selected'
                                                : '' ?>>
                                            Pembina / IV/A
                                        </option>
                                        <option value="Pembina Tk. I/IV/B"
                                            <?= (($_SESSION['old']['pangkat'] ?? '') == 'Pembina Tk. I/IV/B')
                                                ? 'selected'
                                                : '' ?>>
                                            Pembina Tk. I / IV/B
                                        </option>
                                        <option value="Pembina Utama Muda/IV/C"
                                            <?= (($_SESSION['old']['pangkat'] ?? '') == 'Pembina Utama Muda/IV/C')
                                                ? 'selected'
                                                : '' ?>>
                                            Pembina Utama Muda / IV/C
                                        </option>
                                        <option value="Pembina Utama Madya/IV/D"
                                            <?= (($_SESSION['old']['pangkat'] ?? '') == 'Pembina Utama Madya/IV/D')
                                                ? 'selected'
                                                : '' ?>>
                                            Pembina Utama Madya / IV/D
                                        </option>
                                        <option value="Pembina Utama/IV/E"
                                            <?= (($_SESSION['old']['pangkat'] ?? '') == 'Pembina Utama/IV/E')
                                                ? 'selected'
                                                : '' ?>>
                                            Pembina Utama / IV/E
                                        </option>
                                    </optgroup>
                                </select>
                            </div>
                        </div>

                        <!-- Baris 3 -->
                        <div class="row">
                            <!-- TMT SK -->
                            <div class="col-md-6 mb-3">
                                <label for="tmt_sk" class="form-label">
                                    <b>TMT SK Golongan Terakhir</b>
                                </label>
                                <input type="text"
                                    class="form-control tanggal"
                                    id="tmt_sk"
                                    name="tmt_sk"
                                    placeholder="dd-mm-yyyy"
                                    value="<?= $_SESSION['old']['tmt_sk'] ?? '' ?>"
                                    required>
                                <small class="text-muted">
                                    Format tanggal: hari-bulan-tahun (contoh: 01-04-2021)
                                </small>
                            </div>

                            <!-- Jabatan -->
                            <div class="col-md-6 mb-3">
                                <label for="jabatan" class="form-label">
                                    <b>Jabatan</b>
                                </label>
                                <select class="form-control" name="jabatan_id" required>
                                    <option value="" disabled selected>
                                        Pilih Jabatan
                                    </option>
                                    <?php
                                    include 'koneksi.php';
                                    $jabatan = mysqli_query($koneksi, "
                                                SELECT 
                                                    j.id,
                                                    j.nama_jabatan
                                                FROM jabatan j
                                                WHERE

                                                    j.nama_jabatan NOT IN (
                                                        'KEPALA LAPAS KELAS IIA PEKANBARU',
                                                        'KASUBAG TATA USAHA',
                                                        'KASI KEGIATAN KERJA',
                                                        'KEPALA SEKSI ADM. KEAMANAN DAN KETERTIBAN',
                                                        'KEPALA SEKSI BIMBINGAN NARAPIDANA DAN ANAK',
                                                        'KEPALA KESATUAN PENGAMANAN LAPAS',
                                                        'KEPALA URUSAN KEPEGAWAIAN DAN KEUANGAN',
                                                        'KEPALA URUSAN UMUM',
                                                        'KEPALA SUB SEKSI REGISTRASI',
                                                        'KASUBSI BIMASWAT',
                                                        'KASUBSI BIMKER DAN PENGELOLAAN HASIL KERJA',
                                                        'KEPALA SUB SEKSI SARANA KERJA',
                                                        'KEPALA SUB SEKSI KEAMANAN',
                                                        'KASUBSI PELAPORAN DAN TATA TERTIB'
                                                    )
                                                    OR (
                                                        j.nama_jabatan IN (
                                                            'KEPALA LAPAS KELAS IIA PEKANBARU',
                                                            'KASUBAG TATA USAHA',
                                                            'KASI KEGIATAN KERJA',
                                                            'KEPALA SEKSI ADM. KEAMANAN DAN KETERTIBAN',
                                                            'KEPALA SEKSI BIMBINGAN NARAPIDANA DAN ANAK',
                                                            'KEPALA KESATUAN PENGAMANAN LAPAS',
                                                            'KEPALA URUSAN KEPEGAWAIAN DAN KEUANGAN',
                                                            'KEPALA URUSAN UMUM',
                                                            'KEPALA SUB SEKSI REGISTRASI',
                                                            'KASUBSI BIMASWAT',
                                                            'KASUBSI BIMKER DAN PENGELOLAAN HASIL KERJA',
                                                            'KEPALA SUB SEKSI SARANA KERJA',
                                                            'KEPALA SUB SEKSI KEAMANAN',
                                                            'KASUBSI PELAPORAN DAN TATA TERTIB'
                                                        )
                                                        AND (
                                                            SELECT COUNT(*)
                                                            FROM pegawai p
                                                            WHERE p.jabatan_id = j.id
                                                        ) < 1
                                                    )
    ");
                                    while ($d = mysqli_fetch_assoc($jabatan)) {
                                    ?>
                                        <option value="<?= $d['id']; ?>"
                                            <?= (($_SESSION['old']['jabatan_id'] ?? '') == $d['id'])
                                                ? 'selected'
                                                : '' ?>>
                                            <?= htmlspecialchars($d['nama_jabatan']); ?>
                                        </option>
                                    <?php
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>

                        <!-- Baris 4 -->
                        <div class="row">
                            <!-- Tanggal Pelantikan -->
                            <div class="col-md-6 mb-3">
                                <label for="tgl_pelantikan" class="form-label">
                                    <b>Tanggal Pelantikan</b>
                                </label>
                                <input type="text"
                                    class="form-control tanggal"
                                    id="tgl_pelantikan"
                                    name="tgl_pelantikan"
                                    placeholder="dd-mm-yyyy"
                                    value="<?= $_SESSION['old']['tgl_pelantikan'] ?? '' ?>">
                                <small class="text-muted">
                                    Format tanggal: hari-bulan-tahun (contoh: 01-04-2021)
                                </small>
                            </div>

                            <!-- TMT Jabatan -->
                            <div class="col-md-6 mb-3">
                                <label for="tmt_jabatan" class="form-label">
                                    <b>TMT Jabatan Terakhir</b>
                                </label>
                                <input type="text"
                                    class="form-control tanggal"
                                    id="tmt_jabatan"
                                    name="tmt_jabatan"
                                    placeholder="dd-mm-yyyy"
                                    value="<?= $_SESSION['old']['tmt_jabatan'] ?? '' ?>"
                                    required>
                                <small class="text-muted">
                                    Format tanggal: hari-bulan-tahun (contoh: 01-04-2021)
                                </small>
                            </div>
                        </div>

                        <!-- Baris 5 -->
                        <div class="row">
                            <!-- Jenis Jabatan -->
                            <div class="col-md-6 mb-3">
                                <label class="form-label d-block">
                                    <b>Jenis Jabatan</b>
                                </label>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input"
                                        type="radio"
                                        name="jns_jabatan"
                                        id="str"
                                        value="Struktural"
                                        <?= (($_SESSION['old']['jns_jabatan'] ?? '') == 'Struktural')
                                            ? 'checked'
                                            : '' ?>>
                                    <label class="form-check-label" for="str">
                                        Struktural
                                    </label>
                                </div>

                                <div class="form-check form-check-inline">
                                    <input class="form-check-input"
                                        type="radio"
                                        name="jns_jabatan"
                                        id="fg"
                                        value="Fungsional"
                                        <?= (($_SESSION['old']['jns_jabatan'] ?? '') == 'Fungsional')
                                            ? 'checked'
                                            : '' ?>>
                                    <label class="form-check-label" for="fg">
                                        Fungsional
                                    </label>
                                </div>

                                <div class="form-check form-check-inline">
                                    <input class="form-check-input"
                                        type="radio"
                                        name="jns_jabatan"
                                        id="plsn"
                                        value="Pelaksana"
                                        <?= (($_SESSION['old']['jns_jabatan'] ?? '') == 'Pelaksana')
                                            ? 'checked'
                                            : '' ?>>
                                    <label class="form-check-label" for="plsn">
                                        Pelaksana
                                    </label>
                                </div>

                            </div>

                            <!-- Agama -->
                            <div class="col-md-6 mb-3">
                                <label for="agama" class="form-label">
                                    <b>Agama</b>
                                </label>
                                <select name="agama"
                                    id="agama"
                                    class="form-control"
                                    required>
                                    <option value="" disabled selected>
                                        Pilih Agama
                                    </option>
                                    <option value="Islam" <?= (($_SESSION['old']['agama'] ?? '') == 'Islam') ? 'selected' : '' ?>>Islam</option>
                                    <option value="Kristen" <?= (($_SESSION['old']['agama'] ?? '') == 'Kristen') ? 'selected' : '' ?>>Kristen</option>
                                    <option value="Katolik" <?= (($_SESSION['old']['agama'] ?? '') == 'Katolik') ? 'selected' : '' ?>>Katolik</option>
                                    <option value="Hindu" <?= (($_SESSION['old']['agama'] ?? '') == 'Hindu') ? 'selected' : '' ?>>Hindu</option>
                                    <option value="Budha" <?= (($_SESSION['old']['agama'] ?? '') == 'Budha') ? 'selected' : '' ?>>Budha</option>
                                    <option value="Khonghucu" <?= (($_SESSION['old']['agama'] ?? '') == 'Khonghucu') ? 'selected' : '' ?>>Khonghucu</option>
                                </select>
                            </div>

                        </div>

                        <!-- Baris 6 -->
                        <div class="row">
                            <!-- No HP -->
                            <div class="col-md-6 mb-3">
                                <label for="no_hp" class="form-label">
                                    <b>No HP</b>
                                </label>
                                <input type="text"
                                    class="form-control"
                                    id="no_hp"
                                    name="no_hp"
                                    value="<?= $_SESSION['old']['no_hp'] ?? '' ?>"
                                    required>
                            </div>

                            <!-- Alamat -->
                            <div class="col-md-6 mb-3">
                                <label for="alamat" class="form-label">
                                    <b>Alamat</b>
                                </label>
                                <textarea class="form-control"
                                    id="alamat"
                                    name="alamat"
                                    rows="3"
                                    required><?= $_SESSION['old']['alamat'] ?? '' ?></textarea>
                            </div>
                        </div>

                        <!-- Baris 7 -->
                        <div class="row">
                            <!-- Pelatihan -->
                            <div class="col-md-6 mb-3">
                                <label for="pelatihan" class="form-label">
                                    <b>Pelatihan Yang Sudah Diikuti</b>
                                </label>
                                <input type="text"
                                    class="form-control"
                                    id="pelatihan"
                                    name="pelatihan"
                                    value="<?= $_SESSION['old']['pelatihan'] ?? '' ?>">
                            </div>

                            <!-- Tahun Pelatihan -->
                            <div class="col-md-6 mb-3">
                                <label for="thn_pelatihan" class="form-label">
                                    <b>Tahun Pelatihan</b>
                                </label>
                                <input type="number"
                                    class="form-control"
                                    id="thn_pelatihan"
                                    name="thn_pelatihan"
                                    value="<?= $_SESSION['old']['thn_pelatihan'] ?? '' ?>">
                            </div>
                        </div>

                        <!-- Baris 8 -->
                        <div class="row">
                            <!-- Pendidikan -->
                            <div class="col-md-6 mb-3">
                                <label for="pendidikan" class="form-label">
                                    <b>Pendidikan Terakhir</b>
                                </label>
                                <select name="pendidikan"
                                    id="pendidikan"
                                    class="form-control"
                                    required>
                                    <option value="" disabled selected>
                                        Pilih Pendidikan
                                    </option>
                                    <option value="SMA/SMK" <?= (($_SESSION['old']['pendidikan'] ?? '') == 'SMA/SMK') ? 'selected' : '' ?>>SMA/SMK</option>
                                    <option value="D3" <?= (($_SESSION['old']['pendidikan'] ?? '') == 'D3') ? 'selected' : '' ?>>D3</option>
                                    <option value="D4" <?= (($_SESSION['old']['pendidikan'] ?? '') == 'D4') ? 'selected' : '' ?>>D4</option>
                                    <option value="S1" <?= (($_SESSION['old']['pendidikan'] ?? '') == 'S1') ? 'selected' : '' ?>>S1</option>
                                    <option value="S2" <?= (($_SESSION['old']['pendidikan'] ?? '') == 'S2') ? 'selected' : '' ?>>S2</option>
                                    <option value="S3" <?= (($_SESSION['old']['pendidikan'] ?? '') == 'S3') ? 'selected' : '' ?>>S3</option>

                                </select>
                            </div>
                        </div>

                        <div class="d-flex justify-content-end gap-2">
                            <button type="submit" class="btn btn-primary">
                                Simpan
                            </button>

                            <button type="button" class="btn btn-secondary" onclick="window.location.href='index.php?page=kepegawaian'">
                                Kembali
                            </button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>