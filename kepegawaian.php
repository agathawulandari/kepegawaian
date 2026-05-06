<!-- Topbar -->
<nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
    <!-- Sidebar Toggle (Topbar) -->
    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
        <i class="fa fa-bars"></i>
    </button>
</nav>
<!-- End of Topbar -->

<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Content Row -->
    <div class="row">
        <div class="col-xl-12 col-md-12 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="d-flex d-md-flex justify-content-between">
                        <h1 class="h3 mb-0 text-gray-800">Data Pegawai</h1>
                        <a href="index.php?page=tambah" class="btn btn-outline-primary">Tambah</i></a>
                    </div>
                    <!-- Search Form -->
                    <div class="d-flex justify-content-end mb-2 mt-3 p-2">
                        <form class="col-12 col-sm-8 col-md-6 col-lg-4" role="search" method="get">
                            <div class="d-flex flex-column flex-md-row gap-2">
                                <input class="form-control me-2" type="search" name="tcari-data" placeholder="Cari nama atau NIP" aria-label="Search" value="<?= isset($_GET['tcari-data']) ? htmlspecialchars($_GET['tcari-data']) : '' ?>">
                                <input type="hidden" name="page" value="kepegawaian">
                                <button class="btn btn-outline-success" type="submit" name="cari-data">Cari</button>
                                <a href="?page=kepegawaian" class="btn btn-outline-danger">Batal</a>
                            </div>
                        </form>
                    </div>
                    <br>
                    <div class="table-responsive">
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
                                        <td><?= htmlspecialchars($data['nip']) ?></td>
                                        <td><?= htmlspecialchars($data['nama']) ?></td>
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
                                                <a href="index.php?page=detail&id=<?= $data['id'] ?>" class="btn btn-success btn-sm mb-1 mb-md-0 mr-md-1">
                                                    <i class="fas fa-eye fa-md"></i>
                                                </a>
                                                <a href="index.php?page=edit&id=<?= $data['id'] ?>" class="btn btn-warning btn-sm mb-1 mb-md-0 mr-md-1">
                                                    <i class="fas fa-edit fa-md"></i>
                                                </a>
                                                <a href="#"
                                                    class="btn btn-danger btn-sm btn-hapus"
                                                    data-id="<?= $data['id'] ?>"
                                                    data-nama="<?= $data['nama'] ?>"
                                                    data-bs-toggle="modal"
                                                    data-bs-target="#hapusModal">
                                                    <i class="fas fa-trash-alt"></i>
                                                </a>
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
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <p>Yakin ingin menghapus data:&nbsp;</p>
                        <strong id="nama-data"></strong>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                            Batal
                        </button>
                        <a href="" id="btn-konfirmasi-hapus" class="btn btn-danger">Hapus</a>
                    </div>

                </div>
            </div>
        </div>

        <script>
            document.addEventListener("DOMContentLoaded", function() {
                const tombolHapus = document.querySelectorAll(".btn-hapus");
                const btnKonfirmasi = document.getElementById("btn-konfirmasi-hapus");
                const namaData = document.getElementById("nama-data");

                tombolHapus.forEach(function(btn) {
                    btn.addEventListener("click", function() {
                        const id = this.getAttribute("data-id");
                        const nama = this.getAttribute("data-nama");

                        // set link hapus
                        btnKonfirmasi.href = "hapus.php?id=" + id;

                        // tampilkan nama di modal
                        namaData.textContent = nama;
                    });
                });
            });

            setTimeout(function() {
                const alert = document.querySelector('.alert');
                if (alert) {
                    alert.classList.remove('show');
                    alert.classList.add('hide');
                }
            }, 3000);
        </script>




    </div>
</div>