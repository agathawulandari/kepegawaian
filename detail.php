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
                        <span class="col-md-8" style="font-size: 18px;"><?= $data['tmt_sk'] ?></span>
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
                        <span class="col-md-8" style="font-size: 18px;"><?= $data['tgl_pelantikan'] ?></span>
                    </div>

                    <div class="mb-2">
                        <label class="col-md-4" style="font-size: 19px; font-weight: bold;">TMT Jabatan</label>
                        <span class="col-md-8" style="font-size: 18px;"><?= $data['tmt_jabatan'] ?></span>
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
                        <span class="col-md-8" style="font-size: 18px;"><?= !empty($data['thn_pelatihan']) ? htmlspecialchars($data['thn_pelatihan']) : '-' ?></span>
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