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

        <!-- Nav Item - Alerts -->
        <li class="nav-item dropdown no-arrow mx-1">
            <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-bell fa-fw"></i>
                <!-- Counter - Alerts -->
                <span class="badge badge-danger badge-counter">3+</span>
            </a>
            <!-- Dropdown - Alerts -->
            <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="alertsDropdown">
                <h6 class="dropdown-header">Alerts Center</h6>
                <a class="dropdown-item d-flex align-items-center" href="#">
                    <div class="mr-3">
                        <div class="icon-circle bg-primary">
                            <i class="fas fa-file-alt text-white"></i>
                        </div>
                    </div>
                    <div>
                        <div class="small text-gray-500">December 12, 2019</div>
                        <span class="font-weight-bold">A new monthly report is ready to download!</span>
                    </div>
                </a>
                <a class="dropdown-item d-flex align-items-center" href="#">
                    <div class="mr-3">
                        <div class="icon-circle bg-success">
                            <i class="fas fa-donate text-white"></i>
                        </div>
                    </div>
                    <div>
                        <div class="small text-gray-500">December 7, 2019</div>
                        $290.29 has been deposited into your account!
                    </div>
                </a>
                <a class="dropdown-item d-flex align-items-center" href="#">
                    <div class="mr-3">
                        <div class="icon-circle bg-warning">
                            <i class="fas fa-exclamation-triangle text-white"></i>
                        </div>
                    </div>
                    <div>
                        <div class="small text-gray-500">December 2, 2019</div>
                        Spending Alert: We've noticed unusually high spending for your account.
                    </div>
                </a>
                <a class="dropdown-item text-center small text-gray-500" href="#">Show All Alerts</a>
            </div>
        </li>

        <!-- Nav Item - Messages -->
        <li class="nav-item dropdown no-arrow mx-1">
            <a class="nav-link dropdown-toggle" href="#" id="messagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-envelope fa-fw"></i>
                <!-- Counter - Messages -->
                <span class="badge badge-danger badge-counter">7</span>
            </a>
            <!-- Dropdown - Messages -->
            <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="messagesDropdown">
                <h6 class="dropdown-header">Message Center</h6>
                <a class="dropdown-item d-flex align-items-center" href="#">
                    <div class="dropdown-list-image mr-3">
                        <img class="rounded-circle" src="img/undraw_profile_1.svg" alt="..." />
                        <div class="status-indicator bg-success"></div>
                    </div>
                    <div class="font-weight-bold">
                        <div class="text-truncate">Hi there! I am wondering if you can help me with a problem I've been having.</div>
                        <div class="small text-gray-500">Emily Fowler · 58m</div>
                    </div>
                </a>
                <a class="dropdown-item d-flex align-items-center" href="#">
                    <div class="dropdown-list-image mr-3">
                        <img class="rounded-circle" src="img/undraw_profile_2.svg" alt="..." />
                        <div class="status-indicator"></div>
                    </div>
                    <div>
                        <div class="text-truncate">I have the photos that you ordered last month, how would you like them sent to you?</div>
                        <div class="small text-gray-500">Jae Chun · 1d</div>
                    </div>
                </a>
                <a class="dropdown-item d-flex align-items-center" href="#">
                    <div class="dropdown-list-image mr-3">
                        <img class="rounded-circle" src="img/undraw_profile_3.svg" alt="..." />
                        <div class="status-indicator bg-warning"></div>
                    </div>
                    <div>
                        <div class="text-truncate">Last month's report looks great, I am very happy with the progress so far, keep up the good work!</div>
                        <div class="small text-gray-500">Morgan Alvarez · 2d</div>
                    </div>
                </a>
                <a class="dropdown-item d-flex align-items-center" href="#">
                    <div class="dropdown-list-image mr-3">
                        <img class="rounded-circle" src="https://source.unsplash.com/Mv9hjnEUHR4/60x60" alt="..." />
                        <div class="status-indicator bg-success"></div>
                    </div>
                    <div>
                        <div class="text-truncate">Am I a good boy? The reason I ask is because someone told me that people say this to all dogs, even if they aren't good...</div>
                        <div class="small text-gray-500">Chicken the Dog · 2w</div>
                    </div>
                </a>
                <a class="dropdown-item text-center small text-gray-500" href="#">Read More Messages</a>
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
                        ?>
                        <input type="hidden" name="id" value="<?= $data['id'] ?>">
                        <input type="hidden" name="foto_lama" value="<?= $data['foto'] ?>">
                        <input type="hidden" name="file_sk_lama" value="<?= $data['file_sk'] ?>">

                        <div class="mb-3">
                            <label for="nip" class="form-label">NIP</label>
                            <input type="text" class="form-control mb-3" id="nip" name="nip" value="<?= $data['nip'] ?>" required>
                        </div>

                        <div class="mb-3">
                            <label for="nama" class="form-label">Nama Lengkap</label>
                            <input type="text" class="form-control mb-3" id="nama" name="nama" value="<?= $data['nama'] ?>" required>
                        </div>

                        <div class="mb-3">
                            <label>Foto</label><br>

                            <img src="<?= !empty($data['foto']) && file_exists('uploads/' . $data['foto'])
                                            ? 'uploads/' . $data['foto']
                                            : 'img/profile.png'; ?>"
                                width="80" class="img-thumbnail mb-2">

                            <input type="file" name="foto" class="form-control" accept="image/*">
                            <small class="text-muted">Kosongkan jika tidak ingin mengganti foto</small>
                        </div>

                        <div class="mb-3">
                            <label for="jk" class="form-label">Jenis Kelamin</label>
                            <div class="col-md-2 mr-5 col-sm-12">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="jk" id="lk" value="Laki-laki" <?= ($data['jk'] == 'Laki-laki') ? 'checked' : '' ?>>
                                    <label class="form-check-label" for="lk">
                                        Laki-laki
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-2 col-sm-12">
                                <div class="form-check mb-3">
                                    <input class="form-check-input" type="radio" name="jk" id="pr" value="Perempuan" <?= ($data['jk'] == 'Perempuan') ? 'checked' : '' ?>>
                                    <label class="form-check-label" for="pr">
                                        Perempuan
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="pendidikan" class="form-label">Pendidikan Terakhir</label>
                            <select name="pendidikan" id="pendidikan" class="form-control" required>
                                <option value="" disabled <?= empty($data['pendidikan']) ? 'selected' : '' ?>>Pilih Pendidikan</option>
                                <option value="SMA/SMK" <?= $data['pendidikan'] == 'SMA/SMK' ? 'selected' : '' ?>>SMA/SMK</option>
                                <option value="D3" <?= $data['pendidikan'] == 'D3' ? 'selected' : '' ?>>D3</option>
                                <option value="D4" <?= $data['pendidikan'] == 'D4' ? 'selected' : '' ?>>D4</option>
                                <option value="S1" <?= $data['pendidikan'] == 'S1' ? 'selected' : '' ?>>S1</option>
                                <option value="S2" <?= $data['pendidikan'] == 'S2' ? 'selected' : '' ?>>S2</option>
                                <option value="S3" <?= $data['pendidikan'] == 'S3' ? 'selected' : '' ?>>S3</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="pangkat" class="form-label">Pangkat/Golongan</label>
                            <select class="form-select" name="pangkat" id="pangkat" required>
                                <option value="" disabled <?= empty($data['pangkat']) ? 'selected' : '' ?>>Pilih Pangkat</option>

                                <!-- Golongan I -->
                                <optgroup label="Golongan I – Juru">
                                    <option value="Juru Muda/I/A" <?= ($data['pangkat'] == 'Juru Muda/I/A') ? 'selected' : '' ?>>Juru Muda / I/A</option>
                                    <option value="Juru Muda Tk. I/I/B" <?= ($data['pangkat'] == 'Juru Muda Tk. I/I/B') ? 'selected' : '' ?>>Juru Muda Tk. I / I/B</option>
                                    <option value="Juru/I/C" <?= ($data['pangkat'] == 'Juru/I/C') ? 'selected' : '' ?>>Juru / I/C</option>
                                    <option value="Juru Tk. I/I/D" <?= ($data['pangkat'] == 'Juru Tk. I/I/D') ? 'selected' : '' ?>>Juru Tk. I / I/D</option>
                                </optgroup>

                                <!-- Golongan II -->
                                <optgroup label="Golongan II – Pengatur">
                                    <option value="Pengatur Muda/II/A" <?= ($data['pangkat'] == 'Pengatur Muda/II/A') ? 'selected' : '' ?>>Pengatur Muda / II/A</option>
                                    <option value="Pengatur Muda Tk. I/II/B" <?= ($data['pangkat'] == 'Pengatur Muda Tk. I/II/B') ? 'selected' : '' ?>>Pengatur Muda Tk. I / II/B</option>
                                    <option value="Pengatur/II/C" <?= ($data['pangkat'] == 'Pengatur/II/C') ? 'selected' : '' ?>>Pengatur / II/C</option>
                                    <option value="Pengatur Tk. I/II/D" <?= ($data['pangkat'] == 'Pengatur Tk. I/II/D') ? 'selected' : '' ?>>Pengatur Tk. I / II/D</option>
                                </optgroup>

                                <!-- Golongan III -->
                                <optgroup label="Golongan III – Penata">
                                    <option value="Penata Muda/III/A" <?= ($data['pangkat'] == 'Penata Muda/III/A') ? 'selected' : '' ?>>Penata Muda / III/A</option>
                                    <option value="Penata Muda Tk. I/III/B" <?= ($data['pangkat'] == 'Penata Muda Tk. I/III/B') ? 'selected' : '' ?>>Penata Muda Tk. I / III/B</option>
                                    <option value="Penata/III/C" <?= ($data['pangkat'] == 'Penata/III/C') ? 'selected' : '' ?>>Penata / III/C</option>
                                    <option value="Penata Tk. I/III/D" <?= ($data['pangkat'] == 'Penata Tk. I/III/D') ? 'selected' : '' ?>>Penata Tk. I / III/D</option>
                                </optgroup>

                                <!-- Golongan IV -->
                                <optgroup label="Golongan IV – Pembina">
                                    <option value="Pembina/IV/A" <?= ($data['pangkat'] == 'Pembina/IV/A') ? 'selected' : '' ?>>Pembina / IV/A</option>
                                    <option value="Pembina Tk. I/IV/B" <?= ($data['pangkat'] == 'Pembina Tk. I/IV/B') ? 'selected' : '' ?>>Pembina Tk. I / IV/B</option>
                                    <option value="Pembina Utama Muda/IV/C" <?= ($data['pangkat'] == 'Pembina Utama Muda/IV/C') ? 'selected' : '' ?>>Pembina Utama Muda / IV/C</option>
                                    <option value="Pembina Utama Madya/IV/D" <?= ($data['pangkat'] == 'Pembina Utama Madya/IV/D') ? 'selected' : '' ?>>Pembina Utama Madya / IV/D</option>
                                    <option value="Pembina Utama/IV/E" <?= ($data['pangkat'] == 'Pembina Utama/IV/E') ? 'selected' : '' ?>>Pembina Utama / IV/E</option>
                                </optgroup>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="jabatan" class="form-label">Jabatan</label>
                            <select class="form-select" name="jabatan_id">
                                <option value="" disabled <?= empty($data['jabatan_id']) ? 'selected' : '' ?>>
                                    Pilih Jabatan
                                </option>
                                <!-- ambil dari database -->
                                <?php
                                include 'koneksi.php';
                                $data1 = mysqli_query($koneksi, "
                                            SELECT 
                                                j.id, 
                                                j.nama_jabatan, 
                                                parent.nama_jabatan AS parent_nama
                                            FROM jabatan j
                                                LEFT JOIN jabatan parent ON j.parent_id = parent.id
                                            WHERE 
                                                j.nama_jabatan NOT IN (
                                                    'Kepala Lapas', 'KPLP', 'Kepala TU', 
                                                    'Kasi Giatja', 'Kasi Binadik', 'Kasi Kamtib', 
                                                    'Kaur Umum', 'Kaur Kepegawaian', 'Kasubsi Bimker', 
                                                    'Kasubsi Sarana Kerja', 'Kasubsi Bimkemaswat', 
                                                    'Kasubsi Register', 'Kasubsi Keamanan', 
                                                    'Kasubsi Pelaporan & Tatib'
                                                )
                                                OR (
                                                    j.nama_jabatan IN (
                                                        'Kepala Lapas', 'KPLP', 'Kepala TU', 
                                                        'Kasi Giatja', 'Kasi Binadik', 'Kasi Kamtib', 
                                                        'Kaur Umum', 'Kaur Kepegawaian', 
                                                        'Kasubsi Bimker', 'Kasubsi Sarana Kerja', 
                                                        'Kasubsi Bimkemaswat', 'Kasubsi Register', 
                                                        'Kasubsi Keamanan', 'Kasubsi Pelaporan & Tatib'
                                                )
                                                    AND (
                                                        SELECT COUNT(*) 
                                                        FROM pegawai p
                                                        WHERE p.jabatan_id = j.id
                                                    ) < 1
                                                )
                                                    OR j.id = '" . intval($data['jabatan_id']) . "'
                                            ");

                                while ($d = mysqli_fetch_assoc($data1)) {

                                    // Kalau dia staff → tambahkan nama parent
                                    if ($d['nama_jabatan'] == 'Staff' && $d['parent_nama']) {
                                        $nama = "Staff " . $d['parent_nama'];
                                    } else {
                                        $nama = $d['nama_jabatan'];
                                    }

                                    // selected otomatis saat edit
                                    $selected = ($data['jabatan_id'] == $d['id']) ? 'selected' : '';
                                    echo "<option value='{$d['id']}' $selected >$nama</option>";
                                }
                                ?>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="no_sk" class="form-label">Nomor SK Terakhir</label>
                            <input type="text" class="form-control" id="no_sk" name="no_sk" value="<?= $data['no_sk_terakhir'] ?>">
                        </div>

                        <!-- tampilkan file lama -->
                        <div class="mb-3">
                            <label>File SK Saat Ini:</label><br>

                            <?php if (!empty($data['file_sk']) && file_exists("files/" . $data['file_sk'])): ?>
                                <a href="files/<?= $data['file_sk'] ?>" class="btn btn-primary" target="_blank">
                                    Lihat File
                                </a>
                            <?php else: ?>
                                <span class="text-muted">Tidak ada file</span>
                            <?php endif; ?>
                        </div>

                        <!-- upload baru -->
                        <div class="mb-3">
                            <label>Upload File SK (PDF/JPG)</label>
                            <input type="file" name="file_sk" class="form-control"
                                accept=".pdf,.jpg,.jpeg,.png">
                            <small class="text-muted">Kosongkan jika tidak ingin mengganti</small>
                        </div>


                        <div class="mb-3">
                            <label for="tmt_sk" class="form-label">TMT SK Jabatan Terakhir</label>
                            <input type="date" class="form-control" id="tmt_sk" name="tmt_sk" value="<?= $data['tmt_sk'] ?>">
                        </div>

                        <div class="mb-3">
                            <label for="kelas_jabatan" class="form-label">Kelas Jabatan</label>
                            <input type="text" class="form-control" id="kelas_jabatan" name="kelas_jabatan" value="<?= $data['kelas_jabatan'] ?>">
                        </div>
                        <br>
                        <button type="submit" class="btn btn-primary">Update</button>
                        <button type="button" class="btn btn-secondary" onclick="window.location.href='index.php?page=kepegawaian'  ">Batal</button>
                    </form>
                    <br>
                </div>
            </div>
        </div>
    </div>
</div>