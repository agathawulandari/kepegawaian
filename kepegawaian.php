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

    </div>

    <!-- Content Row -->
    <div class="row">
        <div class="col-xl-12 col-md-12 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="d-flex d-md-flex justify-content-between">
                        <h1 class="h3 mb-0 text-gray-800">Data Pegawai</h1>
                        <a href="index.php?page=tambah" class="btn btn-primary btn-sm">Tambah</i></a>
                    </div>
                    <!-- Search Form -->
                    <div class="d-flex justify-content-end mb-2 mt-3 p-2">
                        <form class="col-md-4 col-sm-3 d-flex flex-row " role="search" method="get">
                            <input class="form-control me-2" type="search" name="tcari-data" placeholder="Cari nama atau NIP" aria-label="Search" value="<?= isset($_GET['tcari-data']) ? htmlspecialchars($_GET['tcari-data']) : '' ?>">
                            <input type="hidden" name="page" value="kepegawaian">
                            <button class="btn btn-outline-success me-2" type="submit" name="cari-data">Cari</button>
                            <a href="?page=kepegawaian" class="btn btn-outline-danger">Batal</a>

                        </form>
                    </div>
                    <br>
                    <div class="table-responsive-md">
                        <table class="table w-100">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>NIP</th>
                                    <th>Nama</th>
                                    <th>Jabatan</th>
                                    <th>Golongan</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                include("koneksi.php");

                                $cari = isset($_GET['tcari-data']) ? trim($_GET['tcari-data']) : '';

                                if ($cari != '') {

                                    // Huruf kecil
                                    $cari = strtolower($cari);

                                    // pecah jadi beberapa kata
                                    $kata_kunci = explode(' ', $cari);

                                    $sql = "
                                                SELECT p.*, j.nama_jabatan, parent.nama_jabatan AS parent_nama
                                                FROM pegawai p
                                                LEFT JOIN jabatan j ON p.jabatan_id = j.id
                                                LEFT JOIN jabatan parent ON j.parent_id = parent.id
                                                WHERE 1=1
                                            ";

                                    $params = [];
                                    $types = "";

                                    foreach ($kata_kunci as $key) {
                                        $sql .= " AND (LOWER(p.nama) LIKE ? OR LOWER(p.nip) LIKE ?)";
                                        $param = "%$key%";
                                        $params[] = $param;
                                        $params[] = $param;
                                        $types .= "ss";
                                    }

                                    $stmt = mysqli_prepare($koneksi, $sql);
                                    mysqli_stmt_bind_param($stmt, $types, ...$params);
                                    mysqli_stmt_execute($stmt);
                                    $query = mysqli_stmt_get_result($stmt);
                                } else {
                                    $query = mysqli_query($koneksi, "
                                                SELECT p.*, j.nama_jabatan, parent.nama_jabatan AS parent_nama
                                                FROM pegawai p
                                                LEFT JOIN jabatan j ON p.jabatan_id = j.id
                                                LEFT JOIN jabatan parent ON j.parent_id = parent.id
                                            ");
                                }
                                $no = 1;
                                while ($data = mysqli_fetch_assoc($query)) {
                                ?>
                                    <tr>
                                        <td><?= $no++ ?></td>
                                        <td><?= htmlspecialchars($data['nama']) ?></td>
                                        <td><?= htmlspecialchars($data['nip']) ?></td>
                                        <td>
                                            <?php
                                            if ($data['nama_jabatan'] == 'Staff' && $data['parent_nama']) {
                                                echo htmlspecialchars("Staff " . $data['parent_nama']);
                                            } else {
                                                echo htmlspecialchars($data['nama_jabatan']);
                                            }
                                            ?>

                                        <td><?= htmlspecialchars($data['pangkat']) ?></td>
                                        </td>
                                        <td>
                                            <div class="d-flex flex-column flex-md-row gap-1">
                                                <a href="edit.php?id=<?= $data['id'] ?>" class="btn btn-success btn-sm mb-1 mb-md-0 mr-md-1">
                                                    <i class="fas fa-eye fa-md"></i>
                                                </a>
                                                <a href="index.php?page=edit&id=<?= $data['id'] ?>" class="btn btn-warning btn-sm mb-1 mb-md-0 mr-md-1">
                                                    <i class="fas fa-edit fa-md"></i>
                                                </a>
                                                <a href="hapus.php?id=<?= $data['id'] ?>" class="btn btn-danger btn-sm mb-1 mb-md-0 mr-md-1" onclick="return confirm('Hapus data?')">
                                                    <i class="fas fa-trash-alt fa-md"></i>
                                                </a>
                                                <!-- <a href="#"
                                                    class="btn btn-danger btn-sm"
                                                    data-toggle="modal" 
                                                    data-target="#hapusModal"
                                                    data-id="<?= $data['id'] ?>"
                                                    data-nama="<?= htmlspecialchars($data[' nama']) ?>">

                                                    <i class="fas fa-trash-alt"></i>
                                                </a> -->
                                            </div>
                                        </td>
                                    </tr>
                            </tbody>
                        <?php } ?>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal Konfirmasi Hapus -->
        <div class="modal fade" id="hapusModal" tabindex="-1" role="dialog">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Konfirmasi Hapus</h5>
                        <button type="button" class="close" data-dismiss="modal">
                            <span>&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        Yakin ingin menghapus data
                        <strong id="namaPegawai"></strong>?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">
                            Batal
                        </button>
                        <a href="#" id="btnHapus" class="btn btn-danger">
                            Hapus
                        </a>
                    </div>

                </div>
            </div>
        </div>

        <script>
            $(document).ready(function() {

                $('#hapusModal').on('show.bs.modal', function(event) {

                    var button = $(event.relatedTarget).closest('a');

                    var id = button.data('id');
                    var nama = button.data('nama');

                    console.log("ID:", id);
                    console.log("Nama:", nama);

                    $('#namaPegawai').text(nama);
                    $('#btnHapus').attr('href', 'hapus.php?id=' + id);
                });

            });
        </script>




    </div>
</div>