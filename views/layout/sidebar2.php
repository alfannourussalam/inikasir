<?php
$basename = $_SERVER['DOCUMENT_ROOT'] . '/cashere';
$activePage = $_SERVER['REQUEST_URI'];
// echo $basename;
// echo "<br>";
// echo $activePage;
?>
<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-light sidebar sidebar-light accordion" id="accordionSidebar">

<!-- Sidebar - Brand -->
<a class="sidebar-brand d-flex align-items-center justify-content-center" href="/cashere">
    <div class="sidebar-brand-icon">
        <!-- <i class="fas fa-laugh-wink"></i> -->
        <img src="<?= ($activePage == '/cashere/') ? 'assets/img/alf-icon.png':'../../assets/img/alf-icon.png'; ?>" alt="" style="width:34px; height:28px">
    </div>
    <div class="sidebar-brand-text mx-3">Cashere <sup>v1</sup></div>
</a>

<!-- Divider -->
<hr class="sidebar-divider my-0">

<!-- Nav Item - Dashboard -->
<li class="nav-item <?= ($activePage == '/cashere/') ? 'active':''; ?>">
    <a class="nav-link" href="/cashere/">
        <i class="fas fa-fw fa-tachometer-alt"></i>
        <span>Dashboard</span></a>
</li>

<!-- Nav Item - Transaksi -->
<li class="nav-item <?= ($activePage == '/cashere/views/kasir/') ? 'active':''; ?>">
    <a class="nav-link" href="/cashere/views/kasir/">
        <i class="fas fa-fw fa-store"></i>
        <span>Kasir</span></a>
</li>

<!-- Divider -->
<hr class="sidebar-divider">

<!-- Heading -->
<div class="sidebar-heading">
    Manage
</div>

<!-- Nav Item - Barang -->
<li class="nav-item <?= ($activePage == '/cashere/views/barang/' || $activePage == '/cashere/views/barang/tambah-barang.php') ? 'active':''; ?>">
    <a class="nav-link" href="/cashere/views/barang/">
        <i class="fas fa-fw fa-box"></i>
        <span>Barang</span></a>
</li>

<!-- Nav Item - Pengguna -->
<li class="nav-item <?= ($activePage == '/cashere/views/users/') ? 'active':''; ?>">
    <a class="nav-link" href="/cashere/views/users/">
        <i class="fas fa-fw fa-user-cog"></i>
        <span>Pengguna</span></a>
</li>

<!-- Nav Item - Pages Collapse Menu -->
<li class="nav-item">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo"
        aria-expanded="true" aria-controls="collapseTwo">
        <i class="fas fa-fw fa-cog"></i>
        <span>Master Data</span>
    </a>
    <div id="collapseTwo" class="collapse <?= ($activePage == '/cashere/views/users/') || ($activePage == '/cashere/views/barang/') ? 'show':''; ?>" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Manage data:</h6>
            <a class="collapse-item <?= ($activePage == '/cashere/views/users/') ? 'active':''; ?>" href="/cashere/views/users/">Customer</a>
            <a class="collapse-item <?= ($activePage == '/cashere/views/barang/') ? 'active':''; ?>" href="/cashere/views/barang/">Barang</a>
            <a class="collapse-item <?= ($activePage == '/cashere/views/supliers/') ? 'active':''; ?>" href="/cashere/views/supliers/">Suplier</a>
        </div>
    </div>
</li>

<!-- Nav Item - Utilities Collapse Menu -->
<li class="nav-item">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities"
        aria-expanded="true" aria-controls="collapseUtilities">
        <i class="fas fa-fw fa-wrench"></i>
        <span>Utilities</span>
    </a>
    <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities"
        data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Custom Utilities:</h6>
            <a class="collapse-item" href="utilities-color.html">Colors</a>
            <a class="collapse-item" href="utilities-border.html">Borders</a>
            <a class="collapse-item" href="utilities-animation.html">Animations</a>
            <a class="collapse-item" href="utilities-other.html">Other</a>
        </div>
    </div>
</li>

<!-- Divider -->
<hr class="sidebar-divider">

<!-- Heading -->
<div class="sidebar-heading">
    Addons
</div>

<!-- Nav Item - Pages Collapse Menu -->
<li class="nav-item">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages"
        aria-expanded="true" aria-controls="collapsePages">
        <i class="fas fa-fw fa-folder"></i>
        <span>Pages</span>
    </a>
    <div id="collapsePages" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Login Screens:</h6>
            <a class="collapse-item" href="login.html">Login</a>
            <a class="collapse-item" href="register.html">Register</a>
            <a class="collapse-item" href="forgot-password.html">Forgot Password</a>
            <div class="collapse-divider"></div>
            <h6 class="collapse-header">Other Pages:</h6>
            <a class="collapse-item" href="404.html">404 Page</a>
            <a class="collapse-item" href="blank.html">Blank Page</a>
        </div>
    </div>
</li>

<!-- Nav Item - Tables -->
<li class="nav-item">
    <a class="nav-link" href="tables.html">
        <i class="fas fa-fw fa-table"></i>
        <span>Tables</span></a>
</li>

<!-- Divider -->
<hr class="sidebar-divider d-none d-md-block">

<!-- Sidebar Toggler (Sidebar) -->
<div class="text-center d-none d-md-inline">
    <button class="rounded-circle border-0" id="sidebarToggle"></button>
</div>

<!-- Sidebar Message -->
<!-- <div class="sidebar-card d-none d-lg-flex">
    <img class="sidebar-card-illustration mb-2" src="img/undraw_rocket.svg" alt="...">
    <p class="text-center mb-2"><strong>SB Admin Pro</strong> is packed with premium features, components, and more!</p>
    <a class="btn btn-success btn-sm" href="https://startbootstrap.com/theme/sb-admin-pro">Upgrade to Pro!</a>
</div> -->

</ul>
<!-- End of Sidebar -->