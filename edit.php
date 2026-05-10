<?php
include 'template/topbar.php';
?>

<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Edit Data</h1>
    </div>
    <!-- Content Row -->
    <div class="row g-3">
        <div class="col-xl-12 col-md-12 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <form method="POST" action="update.php" enctype="multipart/form-data">

                        <?php
                        include 'koneksi.php';
                        $id = $_GET['id'];

                        $stmt = mysqli_prepare($koneksi, "SELECT * FROM pegawai WHERE id=?");
                        mysqli_stmt_bind_param($stmt, "i", $id);
                        mysqli_stmt_execute($stmt);
                        $result = mysqli_stmt_get_result($stmt);
                        $data = mysqli_fetch_assoc($result);

                        function formatTanggalEdit($tanggal)
                        {
                            if (empty($tanggal)) {
                                return '';
                            }
                            return date(
                                'd-m-Y',
                                strtotime($tanggal)
                            );
                        }
                        ?>
                        <input type="hidden" name="id" value="<?= $data['id'] ?>">

                        <!-- Baris 1 -->
                        <div class="row">

                            <!-- NIP -->
                            <div class="col-md-6 mb-3">
                                <label for="nip" class="form-label">
                                    <b>NIP</b>
                                </label>

                                <input type="text"
                                    class="form-control"
                                    id="nip"
                                    name="nip"
                                    value="<?= $data['nip'] ?>"
                                    required>
                            </div>

                            <!-- Nama -->
                            <div class="col-md-6 mb-3">
                                <label for="nama" class="form-label">
                                    <b>Nama Lengkap</b>
                                </label>

                                <input type="text"
                                    class="form-control"
                                    id="nama"
                                    name="nama"
                                    value="<?= $data['nama'] ?>"
                                    required>
                            </div>

                        </div>

                        <!-- Baris 2 -->
                        <div class="row">

                            <!-- Jenis Kelamin -->
                            <div class="col-md-6 mb-3">

                                <label class="form-label d-block">
                                    <b>Jenis Kelamin</b>
                                </label>

                                <div class="form-check form-check-inline">
                                    <input class="form-check-input"
                                        type="radio"
                                        name="jk"
                                        id="lk"
                                        value="Laki-laki"
                                        <?= ($data['jk'] == 'Laki-laki') ? 'checked' : '' ?>>

                                    <label class="form-check-label" for="lk">
                                        Laki-laki
                                    </label>
                                </div>

                                <div class="form-check form-check-inline">
                                    <input class="form-check-input"
                                        type="radio"
                                        name="jk"
                                        id="pr"
                                        value="Perempuan"
                                        <?= ($data['jk'] == 'Perempuan') ? 'checked' : '' ?>>

                                    <label class="form-check-label" for="pr">
                                        Perempuan
                                    </label>
                                </div>

                            </div>

                            <!-- Pangkat -->
                            <div class="col-md-6 mb-3">

                                <label for="pangkat" class="form-label">
                                    <b>Pangkat/Golongan</b>
                                </label>

                                <select class="form-select"
                                    name="pangkat"
                                    id="pangkat"
                                    required>

                                    <option value="" disabled>
                                        Pilih Pangkat
                                    </option>

                                    <!-- Golongan I -->
                                    <optgroup label="Golongan I – Juru">
                                        <option value="Juru Muda/I/A" <?= $data['pangkat'] == 'Juru Muda/I/A' ? 'selected' : '' ?>>Juru Muda / I/A</option>
                                        <option value="Juru Muda Tk. I/I/B" <?= $data['pangkat'] == 'Juru Muda Tk. I/I/B' ? 'selected' : '' ?>>Juru Muda Tk. I / I/B</option>
                                        <option value="Juru/I/C" <?= $data['pangkat'] == 'Juru/I/C' ? 'selected' : '' ?>>Juru / I/C</option>
                                        <option value="Juru Tk. I/I/D" <?= $data['pangkat'] == 'Juru Tk. I/I/D' ? 'selected' : '' ?>>Juru Tk. I / I/D</option>
                                    </optgroup>

                                    <!-- Golongan II -->
                                    <optgroup label="Golongan II – Pengatur">
                                        <option value="Pengatur Muda/II/A" <?= $data['pangkat'] == 'Pengatur Muda/II/A' ? 'selected' : '' ?>>Pengatur Muda / II/A</option>
                                        <option value="Pengatur Muda Tk. I/II/B" <?= $data['pangkat'] == 'Pengatur Muda Tk. I/II/B' ? 'selected' : '' ?>>Pengatur Muda Tk. I / II/B</option>
                                        <option value="Pengatur/II/C" <?= $data['pangkat'] == 'Pengatur/II/C' ? 'selected' : '' ?>>Pengatur / II/C</option>
                                        <option value="Pengatur Tk. I/II/D" <?= $data['pangkat'] == 'Pengatur Tk. I/II/D' ? 'selected' : '' ?>>Pengatur Tk. I / II/D</option>
                                    </optgroup>

                                    <!-- Golongan III -->
                                    <optgroup label="Golongan III – Penata">
                                        <option value="Penata Muda/III/A" <?= $data['pangkat'] == 'Penata Muda/III/A' ? 'selected' : '' ?>>Penata Muda / III/A</option>
                                        <option value="Penata Muda Tk. I/III/B" <?= $data['pangkat'] == 'Penata Muda Tk. I/III/B' ? 'selected' : '' ?>>Penata Muda Tk. I / III/B</option>
                                        <option value="Penata/III/C" <?= $data['pangkat'] == 'Penata/III/C' ? 'selected' : '' ?>>Penata / III/C</option>
                                        <option value="Penata Tk. I/III/D" <?= $data['pangkat'] == 'Penata Tk. I/III/D' ? 'selected' : '' ?>>Penata Tk. I / III/D</option>
                                    </optgroup>

                                    <!-- Golongan IV -->
                                    <optgroup label="Golongan IV – Pembina">
                                        <option value="Pembina/IV/A" <?= $data['pangkat'] == 'Pembina/IV/A' ? 'selected' : '' ?>>Pembina / IV/A</option>
                                        <option value="Pembina Tk. I/IV/B" <?= $data['pangkat'] == 'Pembina Tk. I/IV/B' ? 'selected' : '' ?>>Pembina Tk. I / IV/B</option>
                                        <option value="Pembina Utama Muda/IV/C" <?= $data['pangkat'] == 'Pembina Utama Muda/IV/C' ? 'selected' : '' ?>>Pembina Utama Muda / IV/C</option>
                                        <option value="Pembina Utama Madya/IV/D" <?= $data['pangkat'] == 'Pembina Utama Madya/IV/D' ? 'selected' : '' ?>>Pembina Utama Madya / IV/D</option>
                                        <option value="Pembina Utama/IV/E" <?= $data['pangkat'] == 'Pembina Utama/IV/E' ? 'selected' : '' ?>>Pembina Utama / IV/E</option>
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
                                    value="<?= formatTanggalEdit($data['tmt_sk']) ?>"
                                    placeholder="dd-mm-yyyy"
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
                                <select class="form-control"
                                    name="jabatan_id"
                                    required>
                                    <option value="" disabled>
                                        Pilih Jabatan
                                    </option>
                                    <?php
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
                                                    OR j.id = '" . intval($data['jabatan_id']) . "'
                                            ");
                                    while ($j = mysqli_fetch_assoc($jabatan)) {

                                        $selected = (
                                            $data['jabatan_id'] == $j['id']
                                        ) ? 'selected' : '';

                                        echo "
                                            <option value='{$j['id']}' $selected>
                                                {$j['nama_jabatan']}
                                            </option>
                                        ";
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
                                    value="<?= isset($data['tgl_pelantikan']) && $data['tgl_pelantikan'] != '0000-00-00'
                                                ? date('d-m-Y', strtotime($data['tgl_pelantikan']))
                                                : '' ?>">
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
                                    value="<?= isset($data['tmt_jabatan']) && $data['tmt_jabatan'] != '0000-00-00'
                                                ? date('d-m-Y', strtotime($data['tmt_jabatan']))
                                                : '' ?>"
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
                                        <?= ($data['jns_jabatan'] == 'Struktural')
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
                                        <?= ($data['jns_jabatan'] == 'Fungsional')
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
                                        <?= ($data['jns_jabatan'] == 'Pelaksana')
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

                                    <option value="" disabled>
                                        Pilih Agama
                                    </option>

                                    <option value="Islam"
                                        <?= ($data['agama'] == 'Islam') ? 'selected' : '' ?>>
                                        Islam
                                    </option>

                                    <option value="Kristen"
                                        <?= ($data['agama'] == 'Kristen') ? 'selected' : '' ?>>
                                        Kristen
                                    </option>

                                    <option value="Katolik"
                                        <?= ($data['agama'] == 'Katolik') ? 'selected' : '' ?>>
                                        Katolik
                                    </option>

                                    <option value="Hindu"
                                        <?= ($data['agama'] == 'Hindu') ? 'selected' : '' ?>>
                                        Hindu
                                    </option>

                                    <option value="Budha"
                                        <?= ($data['agama'] == 'Budha') ? 'selected' : '' ?>>
                                        Budha
                                    </option>

                                    <option value="Khonghucu"
                                        <?= ($data['agama'] == 'Khonghucu') ? 'selected' : '' ?>>
                                        Khonghucu
                                    </option>

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
                                    value="<?= $data['no_hp'] ?>"
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
                                    required><?= $data['alamat'] ?></textarea>
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
                                    value="<?= $data['pelatihan'] ?>">
                            </div>

                            <!-- Tahun Pelatihan -->
                            <div class="col-md-6 mb-3">
                                <label for="thn_pelatihan" class="form-label">
                                    <b>Tahun Pelatihan</b>
                                </label>
                                <input type="number" class="form-control" id="thn_pelatihan" name="thn_pelatihan" value="<?= $data['thn_pelatihan'] ?>">
                            </div>

                        </div>

                        <!-- Baris 8 -->
                        <div class="row">

                            <!-- Pendidikan -->
                            <div class="col-md-6 mb-3">
                                <label for="pendidikan" class="form-label">
                                    <b>Pendidikan Terakhir</b>
                                </label>
                                <select name="pendidikan" id="pendidikan" class="form-control" required>
                                    <option value="" disabled>
                                        Pilih Pendidikan
                                    </option>
                                    <option value="SMA/SMK"
                                        <?= ($data['pendidikan'] == 'SMA/SMK') ? 'selected' : '' ?>>
                                        SMA/SMK
                                    </option>
                                    <option value="D3"
                                        <?= ($data['pendidikan'] == 'D3') ? 'selected' : '' ?>>
                                        D3
                                    </option>
                                    <option value="D4"
                                        <?= ($data['pendidikan'] == 'D4') ? 'selected' : '' ?>>
                                        D4
                                    </option>
                                    <option value="S1"
                                        <?= ($data['pendidikan'] == 'S1') ? 'selected' : '' ?>>
                                        S1
                                    </option>
                                    <option value="S2"
                                        <?= ($data['pendidikan'] == 'S2') ? 'selected' : '' ?>>
                                        S2
                                    </option>
                                    <option value="S3"
                                        <?= ($data['pendidikan'] == 'S3') ? 'selected' : '' ?>>
                                        S3
                                    </option>
                                </select>
                            </div>
                        </div>
                        <br>
                        <div class="d-flex justify-content-end gap-2">
                            <button type="submit" class="btn btn-primary">Simpan</button>
                            <button type="button" class="btn btn-secondary" onclick="window.location.href='index.php?page=kepegawaian'  ">Batal</button>
                        </div>
                    </form>
                    <br>
                </div>
            </div>
        </div>
    </div>
</div>