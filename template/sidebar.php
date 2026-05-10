<?php
$page = $_GET['page'] ?? '';
?>

<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.php?page=dashboard">
        <div class="sidebar-brand-text mx-3">DATA PEGAWAI</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0" />

    <!-- Nav Item - Dashboard -->
    <li class="nav-item <?= ($page == 'dashboard') ? 'active' : '' ?>">
        <a class="nav-link" href="index.php?page=dashboard">
            <i class=" fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider" />

    <!-- Heading -->
    <div class="sidebar-heading">DATA</div>

    <!-- Nav Item - Tables -->
    <li class="nav-item <?= ($page == 'kepegawaian' || $page == 'tambah' || $page == 'edit') ? 'active' : '' ?>">
        <a class="nav-link" href="index.php?page=kepegawaian">
            <i class="fas fa-fw fa-table"></i>
            <span>Data Kepegawaian</span></a>
    </li>

    <!-- Nav Item - Charts -->
    <li class="nav-item <?= ($page == 'riwayat-pengajuan') ? 'active' : '' ?>">
        <a class="nav-link" href="index.php?page=riwayat-pengajuan">
            <i class="fas fa-fw fa-chart-area"></i>
            <span>Riwayat Pengajuan</span></a>
    </li>
</ul>