<?php
include 'koneksi.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $cari = isset($_POST['cari']) ? trim($_POST['cari']) : '';
    $page = isset($_POST['page']) ? (int)$_POST['page'] : 1;

    $limit = 5;
    $offset = ($page - 1) * $limit;

    $params = [];
    $types = "";

    // 🔥 JOIN ke tabel histori
    $sql = "
    FROM pengajuan_pangkat pg
    JOIN pegawai p ON p.id = pg.pegawai_id
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

    // TOTAL DATA
    $stmt = mysqli_prepare($koneksi, "SELECT COUNT(*) as total $sql");

    if (!empty($params)) {
        mysqli_stmt_bind_param($stmt, $types, ...$params);
    }

    mysqli_stmt_execute($stmt);
    $total_data = mysqli_fetch_assoc(mysqli_stmt_get_result($stmt))['total'];

    $total_halaman = ceil($total_data / $limit);

    // DATA
    $query_sql = "
    SELECT 
        p.nip,
        p.nama,
        p.tmt_sk,
        pg.jatuh_tempo,
        pg.tanggal_pengajuan,
        pg.created_at
    $sql
    ORDER BY pg.created_at DESC
    LIMIT ?, ?
    ";

    $stmt = mysqli_prepare($koneksi, $query_sql);

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
        echo "<p class='text-center mt-4'>Data tidak ditemukan</p>";
        exit;
    }
?>

    <table class="table">
        <thead>
            <tr>
                <th>No</th>
                <th>NIP</th>
                <th>Nama</th>
                <th>TMT SK</th>
                <th>Jatuh Tempo</th>
                <th>Tanggal Pengajuan</th>
            </tr>
        </thead>

        <tbody>
            <?php
            $no = $offset + 1;
            while ($d = mysqli_fetch_assoc($query)) {
            ?>
                <tr>
                    <td><?= $no++ ?></td>
                    <td><?= highlight(htmlspecialchars($d['nip']), $kata_kunci) ?></td>
                    <td><?= highlight(htmlspecialchars($d['nama']), $kata_kunci) ?></td>
                    <td><?= date('d-m-Y', strtotime($d['tmt_sk'])) ?></td>
                    <td><?= date('d-m-Y', strtotime($d['jatuh_tempo'])) ?></td>
                    <td><?= date('d-m-Y H:i', strtotime($d['created_at'])) ?></td>
                </tr>
            <?php } ?>
        </tbody>
    </table>

    <nav>
        <ul class="pagination">

            <?php if ($page > 1): ?>
                <li class="page-item ml-2">
                    <a href="#" class="page-link" data-page="<?= $page - 1 ?>">«</a>
                </li>
            <?php endif; ?>

            <?php for ($i = 1; $i <= $total_halaman; $i++): ?>
                <li class="page-item ml-2 <?= ($i == $page) ? 'active' : '' ?>">
                    <a href="#" class="page-link" data-page="<?= $i ?>"><?= $i ?></a>
                </li>
            <?php endfor; ?>

            <?php if ($page < $total_halaman): ?>
                <li class="page-item ml-2">
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
        <h1 class="h3 mb-0 text-gray-800">Riwayat Pengajuan</h1>
    </div>

    <!-- Search Form -->
    <div class="d-flex justify-content-end">
        <div class="p-2 col-12 col-sm-8 col-md-6 col-lg-4 ">
            <input type="text" id="search" class="form-control" placeholder="Cari nama atau NIP">
        </div>
    </div>
    <!-- Content Row -->
    <div class="row g-3">
        <div class="col-xl-12 col-md-12 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="table-responsive">
                    <div id="loading" style="display:none;">Loading...</div>
                    <div id="hasil"></div>
                    <br>
                </div>
            </div>
        </div>
    </div>
</div>


<!-- Untuk load search -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
    let halaman = 1;
    let keyword = '';
    let delayTimer;

    function loadData(page = 1, cari = '') {

        $("#loading").show();

        $.ajax({
            url: "riwayat.php",
            method: "POST",
            data: {
                page: page,
                cari: cari
            },
            success: function(data) {
                $("#hasil").html(data);
                $("#loading").hide();
            }
        });
    }

    // load awal
    loadData();

    // live search
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