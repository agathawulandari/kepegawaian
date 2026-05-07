<?php
include 'koneksi.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $cari = isset($_POST['cari']) ? trim($_POST['cari']) : '';
    $page = isset($_POST['page']) ? (int)$_POST['page'] : 1;

    $limit = 10;
    $offset = ($page - 1) * $limit;

    $params = [];
    $types = "";

    $sql = "
        FROM pegawai p
        LEFT JOIN jabatan j ON p.jabatan_id = j.id
        LEFT JOIN jabatan parent ON j.parent_id = parent.id
        WHERE 1=1
    ";

    $kata_kunci = [];

    if ($cari != '') {
        $cari = strtolower($cari);
        $kata_kunci = array_filter(explode(' ', $cari));

        foreach ($kata_kunci as $key) {
            $sql .= " AND (LOWER(p.nama) LIKE ? OR LOWER(p.nip) LIKE ?)";
            $param = "%$key%";
            $params[] = $param;
            $params[] = $param;
            $types .= "ss";
        }
    }

    // TOTAL
    $stmt = mysqli_prepare($koneksi, "SELECT COUNT(*) as total " . $sql);

    if (!empty($params)) {
        mysqli_stmt_bind_param($stmt, $types, ...$params);
    }

    mysqli_stmt_execute($stmt);
    $total_data = mysqli_fetch_assoc(mysqli_stmt_get_result($stmt))['total'];
    $total_halaman = ceil($total_data / $limit);

    // DATA
    $stmt = mysqli_prepare($koneksi, "SELECT p.*, j.nama_jabatan, parent.nama_jabatan AS parent_nama " . $sql . " LIMIT ?, ?");

    if (!empty($params)) {
        $types2 = $types . "ii";
        $params_data = $params;
        $params_data[] = $offset;
        $params_data[] = $limit;

        mysqli_stmt_bind_param($stmt, $types2, ...$params_data);
    } else {
        mysqli_stmt_bind_param($stmt, "ii", $offset, $limit);
    }

    mysqli_stmt_execute($stmt);
    $query = mysqli_stmt_get_result($stmt);

    function highlight($text, $keywords)
    {
        foreach ($keywords as $key) {
            $text = preg_replace("/($key)/i", "<span style='background:yellow'>$1</span>", $text);
        }
        return $text;
    }

    if ($total_data == 0) {
        echo "<p class='text-center'>Data tidak ditemukan</p>";
        exit;
    }
?>

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
            $no = $offset + 1;
            while ($data = mysqli_fetch_assoc($query)) {
            ?>
                <tr>
                    <td><?= $no++ ?></td>
                    <td><?= highlight(htmlspecialchars($data['nip']), $kata_kunci) ?></td>
                    <td><?= highlight(htmlspecialchars($data['nama']), $kata_kunci) ?></td>

                    <td>
                        <?php
                        if ($data['nama_jabatan'] == 'Staff' && $data['parent_nama']) {
                            echo "Staff " . htmlspecialchars($data['parent_nama']);
                        } else {
                            echo htmlspecialchars($data['nama_jabatan']);
                        }
                        ?>
                    </td>

                    <td><?= htmlspecialchars($data['pangkat']) ?></td>

                    <td>
                        <a href="index.php?page=detail&id=<?= $data['id'] ?>" class="btn btn-success btn-sm">
                            <i class="fas fa-eye"></i>
                        </a>
                        <a href="index.php?page=edit&id=<?= $data['id'] ?>" class="btn btn-warning btn-sm">
                            <i class="fas fa-edit"></i>
                        </a>
                        <a href="#"
                            class="btn btn-danger btn-sm btn-hapus"
                            data-id="<?= $data['id'] ?>"
                            data-nama="<?= $data['nama'] ?>"
                            data-bs-toggle="modal"
                            data-bs-target="#hapusModal">
                            <i class="fas fa-trash"></i>
                        </a>
                    </td>
                </tr>
            <?php } ?>

        </tbody>
    </table>

    <!-- PAGINATION -->
    <nav>
        <ul class="pagination">

            <?php if ($page > 1): ?>
                <li class="page-item">
                    <a href="#" class="page-link" data-page="<?= $page - 1 ?>">«</a>
                </li>
            <?php endif; ?>

            <?php for ($i = 1; $i <= $total_halaman; $i++): ?>
                <li class="page-item <?= ($i == $page) ? 'active' : '' ?>">
                    <a href="#" class="page-link" data-page="<?= $i ?>"><?= $i ?></a>
                </li>
            <?php endfor; ?>

            <?php if ($page < $total_halaman): ?>
                <li class="page-item">
                    <a href="#" class="page-link" data-page="<?= $page + 1 ?>">»</a>
                </li>
            <?php endif; ?>

        </ul>
    </nav>

<?php
    exit;
}
?>

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
            <div class="d-flex d-md-flex justify-content-between mb-3">
                <h1 class="h3 mb-0 text-gray-800">Data Pegawai</h1>
                <a href="index.php?page=tambah" class="btn btn-outline-primary">Tambah</i></a>
            </div>
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <!-- Search Form -->
                    <div class="d-flex justify-content-end mb-2">
                        <div class="p-2 col-12 col-sm-8 col-md-6 col-lg-9">

                        </div>
                        <input type="text" id="search" class="form-control" placeholder="Cari nama atau NIP">
                    </div>

                    <div class="d-flex justify-content-end p-2 mb-2">
                        <div class="dropdown">
                            <button class="btn btn-info dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                File
                            </button>
                            <ul class="dropdown-menu">
                                <a class="dropdown-item" id="exportExcel" href="#" target="_blank">Excel</a>
                                <a class="dropdown-item" id="exportPDF" href="#" target="_blank">PDF</a>
                            </ul>
                        </div>
                    </div>

                    <div class="table-responsive">


                        <br>

                        <div id="loading" style="display:none;">Loading...</div>
                        <div id="hasil"></div>
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
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
    $(document).on("click", ".btn-hapus", function() {

        let id = $(this).data("id");
        let nama = $(this).data("nama");

        $("#btn-konfirmasi-hapus").attr("href", "hapus.php?id=" + id);

        $("#nama-data").text(nama);

    });

    setTimeout(function() {
        const alert = document.querySelector('.alert');
        if (alert) {
            alert.classList.remove('show');
            alert.classList.add('hide');
        }
    }, 3000);
</script>

<script>
    let halaman = 1;
    let keyword = '';
    let delayTimer;

    // update link export
    function updateExportLink() {
        let urlExcel = "export_excel.php?cari=" + encodeURIComponent(keyword);
        let urlPDF = "export_pdf.php?cari=" + encodeURIComponent(keyword);

        document.getElementById("exportExcel").href = urlExcel;
        document.getElementById("exportPDF").href = urlPDF;
    }

    // load data
    function loadData(page = 1, cari = '') {

        $("#loading").show();

        $.ajax({
            url: "kepegawaian.php",
            method: "POST",
            data: {
                page: page,
                cari: cari
            },
            success: function(data) {
                $("#hasil").html(data);
                $("#loading").hide();
                updateExportLink(); // 🔥 penting
            }
        });
    }

    // pertama kali halaman dibuka
    $(document).ready(function() {
        loadData();
        updateExportLink();
    });

    // search
    $("#search").on("keyup", function() {

        clearTimeout(delayTimer);

        keyword = $(this).val();

        delayTimer = setTimeout(function() {
            halaman = 1;
            loadData(halaman, keyword);
        }, 300);

    });

    // pagination
    $(document).on("click", ".page-link", function(e) {
        e.preventDefault();

        halaman = $(this).data("page");
        loadData(halaman, keyword);
    });
</script>