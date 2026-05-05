<?php
session_start();
include("template/header.php");
include("koneksi.php");
?>

<body id="page-top">
    <!-- Page Wrapper -->
    <div id="wrapper">
        <!-- Sidebar -->
        <?php
        include("template/sidebar.php");
        ?>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">
            <!-- Main Content -->
            <div class="main">

                <?php
                // menentukan halaman
                if (isset($_GET['page'])) {
                    $page = $_GET['page'];

                    switch ($page) {
                        case 'dashboard':
                            include 'dashboard.php';
                            break;
                        case 'kepegawaian':
                            include 'kepegawaian.php';
                            break;
                        case 'tambah':
                            include 'tambah.php';
                            break;
                        case 'edit':
                            include 'edit.php';
                            break;
                        case 'hapus':
                            include 'hapus.php';
                            break;
                        case 'detail':
                            include 'detail.php';
                            break;
                        default:
                            echo "<h3>Halaman tidak ditemukan</h3>";
                            break;
                    }
                } else {
                    include 'dashboard.php'; // default
                }
                ?>


            </div>
            <!-- End of Main Content -->

            <?php

            include 'template/footer.php';
            ?>