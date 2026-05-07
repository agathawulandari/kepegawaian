<!-- Topbar -->
<?php
include 'koneksi.php';
$query = "SELECT COUNT(*) as total FROM pegawai";
$result = mysqli_query($koneksi, $query);

if (!$result) {
    die("Query error: " . mysqli_error($koneksi));
}

$data = mysqli_fetch_assoc($result);
$jumlahPegawai = $data['total'];
?>

<!-- Topbar -->
<nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
    <?php
    $data = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT * FROM pegawai WHERE id = '$_SESSION[id]'"));
    $username = $_SESSION['username'];
    ?>
    <!-- Topbar Navbar -->
    <ul class="navbar-nav ml-auto">
        <div class="topbar-divider d-none d-sm-block"></div>
        <!-- Nav Item - User Information -->
        <li class="nav-item dropdown no-arrow">
            <a class="nav-link dropdown-toggle"
                href="#"
                id="userDropdown"
                role="button"
                data-bs-toggle="dropdown"
                aria-expanded="false">
                <span class="mr-2 d-none d-lg-inline text-gray-600 small">
                    <?= ucwords(strtolower($username)) ?>
                </span>
                <img class="img-profile rounded-circle"
                    src="Logo imipas.png" />
            </a>
            <!-- Dropdown -->
            <div class="dropdown-menu dropdown-menu-end shadow animated--grow-in"
                aria-labelledby="userDropdown">
                <a class="dropdown-item"
                    href="#"
                    data-bs-toggle="modal"
                    data-bs-target="#logoutModal">
                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                    Logout
                </a>
            </div>
        </li>
    </ul>
</nav>
<!-- End of Topbar -->

<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- Content Row -->
    <div class="row">
        <div class="col-xl-12 col-md-12 mb-4">
            <?php
            include 'notifikasi.php';
            foreach ($notif as $d) { ?>
                <div class="alert alert-danger d-flex justify-content-between align-items-center">
                    <div>
                        <!-- 🔔 <strong><?= $d['nama'] ?></strong><br>
                        Harus mengajukan kenaikan pangkat<br>
                        <input type="hidden" name="jatuh_tempo" value="<?= $d['jatuh_tempo'] ?>">
                        Jatuh tempo: <?= date('d-m-Y', strtotime($d['jatuh_tempo'])) ?> -->
                        🔔 <strong><?= $d['nama'] ?></strong><br>

                        <?php if ($d['status'] == 'warning') { ?>
                            Segera ajukan kenaikan pangkat!
                        <?php } else { ?>
                            Monitoring
                        <?php } ?>

                        <br>
                        Jatuh tempo: <?= date('d-m-Y', strtotime($d['jatuh_tempo'])) ?>
                    </div>

                    <button
                        type="button"
                        class="btn btn-success btn-sm"
                        data-bs-toggle="modal"
                        data-bs-target="#modalPengajuan"
                        data-id="<?= $d['id'] ?>"
                        data-nama="<?= $d['nama'] ?>">
                        ✔ Sudah Diajukan
                    </button>

                </div>
            <?php } ?>

            <div class="modal fade" id="modalPengajuan" tabindex="-1">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">

                        <form method="POST" action="proses_pengajuan.php">
                            <input type="hidden" name="id" value="<?= $d['id'] ?>">
                            <input type="hidden" name="jatuh_tempo" value="<?= $d['jatuh_tempo'] ?>">
                            <div class="modal-header">
                                <h5 class="modal-title">Konfirmasi Pengajuan</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                            </div>

                            <div class="modal-body">
                                <p>Yakin sudah mengajukan kenaikan pangkat untuk:</p>
                                <strong id="namaPegawai"></strong>
                            </div>

                            <div class="modal-footer">
                                <input type="hidden" name="id" id="idPegawai">

                                <button type="submit" class="btn btn-success">
                                    ✔ Ya, Sudah
                                </button>
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                    Batal
                                </button>

                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <script>
                const modal = document.getElementById('modalPengajuan');

                modal.addEventListener('show.bs.modal', function(event) {
                    const button = event.relatedTarget;

                    const id = button.getAttribute('data-id');
                    const nama = button.getAttribute('data-nama');

                    document.getElementById('idPegawai').value = id;
                    document.getElementById('namaPegawai').textContent = nama;
                });
            </script>
        </div>

        <div class="col-xl-12 col-md-12 mb-4">
            <div class="card shadow h-100 py-2 mb-4">
                <div class="card-body">
                    <div class="text-center">
                        <img src="Logo imipas.png" alt="" class="img-fluid mb-2" width="200">
                        <h1 class="judul-custom">
                            KEMENTERIAN IMIGRASI DAN PEMASYARAKATAN REPUBLIK INDONESIA
                        </h1>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Content Row -->
    <div class="row">
        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Jumlah Pegawai</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                <?php echo $jumlahPegawai; ?></div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-calendar fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /.container-fluid -->