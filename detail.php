<!-- Topbar -->
<nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
    <!-- Sidebar Toggle (Topbar) -->
    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
        <i class="fa fa-bars"></i>
    </button>

    <!-- Topbar Search -->
    <form class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
        <div class="input-group">
            <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2" />
            <div class="input-group-append">
                <button class="btn btn-primary" type="button">
                    <i class="fas fa-search fa-sm"></i>
                </button>
            </div>
        </div>
    </form>

    <!-- Topbar Navbar -->
    <ul class="navbar-nav ml-auto">
        <!-- Nav Item - Search Dropdown (Visible Only XS) -->
        <li class="nav-item dropdown no-arrow d-sm-none">
            <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-search fa-fw"></i>
            </a>
            <!-- Dropdown - Messages -->
            <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in" aria-labelledby="searchDropdown">
                <form class="form-inline mr-auto w-100 navbar-search">
                    <div class="input-group">
                        <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2" />
                        <div class="input-group-append">
                            <button class="btn btn-primary" type="button">
                                <i class="fas fa-search fa-sm"></i>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </li>

        <div class="topbar-divider d-none d-sm-block"></div>

        <!-- Nav Item - User Information -->
        <li class="nav-item dropdown no-arrow">
            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <span class="mr-2 d-none d-lg-inline text-gray-600 small">Douglas McGee</span>
                <img class="img-profile rounded-circle" src="img/undraw_profile.svg" />
            </a>
            <!-- Dropdown - User Information -->
            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                <a class="dropdown-item" href="#">
                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                    Profile
                </a>
                <a class="dropdown-item" href="#">
                    <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                    Settings
                </a>
                <a class="dropdown-item" href="#">
                    <i class="fas fa-list fa-sm fa-fw mr-2 text-gray-400"></i>
                    Activity Log
                </a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
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
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Detail Data Pegawai</h1>
    </div>
    <!-- Content Row -->
    <div class="row g-3">
        <div class="col-xl-12 col-md-12 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <form method="POST" action="kirim_email.php">

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

                        <?php
                        if ($data['foto'] && file_exists("uploads/" . $data['foto'])) {
                            $foto_url = "uploads/" . $data['foto'];
                        } else {
                            $foto_url = "uploads/profile.png"; // Gambar default jika foto tidak ada

                        }
                        ?>
                        <div class="justify-content-center d-flex mb-4">
                            <img src="<?= htmlspecialchars($foto_url) ?>" width="180" class="img-thumbnail" alt="Foto Pegawai">
                        </div>
                        <hr style="border-top: 5px solid #000000;">

                        <button type="submit" name="send_email" class="btn btn-primary mb-3">
                            Send Email
                        </button>

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

                        <div class="mb-3">
                            <label class="col-md-4" style="font-size: 19px; font-weight: bold;">Pendidikan Terakhir</label>
                            <span class="col-md-8" style="font-size: 18px;"><?= $data['pendidikan'] ?></span>
                        </div>

                        <div class="mb-3">
                            <label class="col-md-4" style="font-size: 19px; font-weight: bold;">Pangkat/Golongan</label>
                            <span class="col-md-8" style="font-size: 18px;"><?= $data['pangkat'] ?></span>
                        </div>

                        <div class="mb-3">
                            <?php
                            include 'koneksi.php';
                            $id_jabatan = $data['jabatan_id'];

                            $query = mysqli_query($koneksi, "
                                        SELECT 
                                            j.nama_jabatan, 
                                            parent.nama_jabatan AS parent_nama
                                        FROM jabatan j
                                        LEFT JOIN jabatan parent ON j.parent_id = parent.id
                                        WHERE j.id = '$id_jabatan'
                                    ");

                            $jabatan = mysqli_fetch_assoc($query);

                            // format nama
                            if ($jabatan['nama_jabatan'] == 'Staff' && $jabatan['parent_nama']) {
                                $nama_jabatan = "Staff " . $jabatan['parent_nama'];
                            } else {
                                $nama_jabatan = $jabatan['nama_jabatan'];
                            }
                            ?>
                            <label class="col-md-4" style="font-size: 19px; font-weight: bold;">Jabatan</label>
                            <span class="col-md-8" style="font-size: 18px;"><?= htmlspecialchars($nama_jabatan) ?></span>
                        </div>

                        <div class="mb-3">
                            <label class="col-md-4" style="font-size: 19px; font-weight: bold;">Nomor SK Terakhir</label>
                            <span class="col-md-8" style="font-size: 18px;"><?= $data['no_sk_terakhir'] ?></span>
                        </div>

                        <div class="mb-3">
                            <label class="col-md-4" style="font-size: 19px; font-weight: bold;">Dokumen SK Terakhir</label>
                            <?php
                            $file = $data['file_sk'];

                            if (!empty($file) && file_exists("files/" . $file)) {
                                $url = "files/" . $file;
                                $ext = strtolower(pathinfo($file, PATHINFO_EXTENSION));
                            ?>

                                <a href="<?= htmlspecialchars($url) ?>"
                                    target="_blank"
                                    rel="noopener noreferrer"
                                    class="btn btn-sm btn-primary ml-2">

                                    <?php if ($ext == 'pdf'): ?>
                                        📄 Lihat PDF
                                    <?php else: ?>
                                        🖼️ Lihat Gambar
                                    <?php endif; ?>

                                </a>

                            <?php
                            } else {
                                echo "<span class='text-muted'>Tidak ada file</span>";
                            }
                            ?>
                        </div>

                        <div class="mb-3">
                            <label class="col-md-4" style="font-size: 19px; font-weight: bold;">TMT SK Jabatan Terakhir</label>
                            <span class="col-md-8" style="font-size: 18px;"><?= $data['tmt_sk'] ?></span>
                        </div>

                        <div class="mb-3">
                            <label class="col-md-4" style="font-size: 19px; font-weight: bold;">Kelas Jabatan</label>
                            <span class="col-md-8" style="font-size: 18px;"><?= $data['kelas_jabatan'] ?></span>
                        </div>
                        <br>
                        <button type="button" class="btn btn-secondary" onclick="window.location.href='index.php?page=kepegawaian'  ">Kembali</button>
                    </form>
                    <br>
                </div>
            </div>
        </div>
    </div>
</div>