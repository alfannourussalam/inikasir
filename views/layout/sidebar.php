<?php
// $basename = $_SERVER['DOCUMENT_ROOT'] . '/'.$basename.'';
$activePage = $_SERVER['REQUEST_URI'];
// echo $basename;
// echo "<br>";
// echo $activePage;
?>
<!-- Sidebar -->
<ul class="navbar-nav bg-white sidebar sidebar-light accordion" id="accordionSidebar">

<!-- Sidebar - Brand -->
<a class="sidebar-brand d-flex align-items-center justify-content-center" href="/'.$basename.'">
    <div class="sidebar-brand-icon">
        <!-- <i class="fas fa-laugh-wink"></i> -->
        <img src="<?= ($activePage == '/'.$basename.'/') ? 'assets/img/logo1.png':'../../assets/img/logo1.png'; ?>" alt="inikasir" style="height:28px" class="img-fluid">
    </div>
    <!-- <div class="sidebar-brand-text mx-3"><?= $basename ?><sup>v1</sup></div> -->
</a>

<!-- Divider -->
<hr class="sidebar-divider my-0">

<!-- Nav Item - Dashboard -->
<li class="nav-item <?= ($activePage == '/'.$basename.'/') ? 'active':''; ?>">
    <a class="nav-link" href="/<?= $basename ?>/">
        <i class="fas fa-fw fa-tachometer-alt"></i>
        <span>Dashboard</span></a>
</li>

<!-- Nav Item - Transaksi -->
<?php
if ($_SESSION['role']=='kasir') { ?>
    
    <li class="nav-item <?= ($activePage == '/'.$basename.'/views/transaksi/') ? 'active':''; ?>">
        <a class="nav-link" href="/<?= $basename ?>/views/transaksi/">
            <i class="fas fa-fw fa-store"></i>
            <span>Kasir</span></a>
    </li>

<?php
}
?>

<?php
if ($_SESSION['role']=='admin') { ?>
<!-- Nav Item - Barang Masuk -->
<li class="nav-item <?= ($activePage == '/'.$basename.'/views/barangmasuk/') ? 'active':''; ?>">
    <a class="nav-link" href="/<?= $basename ?>/views/barangmasuk/">
        <i class="fas fa-cart-arrow-down"></i>
        <span>Barang Masuk</span></a>
</li>
<?php
}
?>

<?php
if ($_SESSION['role']=='admin' || $_SESSION['role'] == 'kasir') { ?>
<!-- Nav Item - Riwayat Transaksi -->
<li class="nav-item <?= ($activePage == '/'.$basename.'/views/riwayat-transaksi/') ? 'active':''; ?>">
    <a class="nav-link" href="/<?= $basename ?>/views/riwayat-transaksi/">
        <i class="fas fa-swatchbook"></i>
        <span>Riwayat Transaksi</span></a>
</li>
<?php
}
?>

<?php
if ($_SESSION['role']=='admin') { ?>
<!-- Divider -->
<hr class="sidebar-divider">

<!-- Heading -->
<div class="sidebar-heading">
    Manage
</div>

<!-- Nav Item - Pages Collapse Menu -->
<li class="nav-item">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo"
        aria-expanded="true" aria-controls="collapseTwo">
        <i class="fas fa-fw fa-cog"></i>
        <span>Master Data</span>
    </a>
    <div id="collapseTwo" class="collapse <?= ($activePage == '/'.$basename.'/views/users/') || ($activePage == '/'.$basename.'/views/kasir/') || ($activePage == '/'.$basename.'/views/barang/') || ($activePage == '/'.$basename.'/views/supliers/')? 'show':''; ?>" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Manage data:</h6>
            <a class="collapse-item <?php echo ($activePage == '/'.$basename.'/views/users/') ? 'active':''; ?>" href="/<?= $basename ?>/views/users/">Daftar Pelanggan</a>
            <a class="collapse-item <?php echo ($activePage == '/'.$basename.'/views/kasir/') ? 'active':''; ?>" href="/<?= $basename ?>/views/kasir/">Daftar Kasir</a>
            <a class="collapse-item <?= ($activePage == '/'.$basename.'/views/barang/') ? 'active':''; ?>" href="/<?= $basename ?>/views/barang/">Master Barang</a>
            <a class="collapse-item <?= ($activePage == '/'.$basename.'/views/supliers/') ? 'active':''; ?>" href="/<?= $basename ?>/views/supliers/">Suplier</a>
        </div>
    </div>
</li>

<!-- Nav Item - Utilities Collapse Menu -->
<li class="nav-item">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities"
        aria-expanded="true" aria-controls="collapseUtilities">
        <i class="fas fa-fw fa-poll"></i>
        <span>Laporan</span>
    </a>
    <div id="collapseUtilities" class="collapse <?= ($activePage == '/'.$basename.'/views/laporan/pendapatan.php') || ($activePage == '/'.$basename.'/views/laporan/barangmasuk.php') ? 'show':''; ?>" aria-labelledby="headingUtilities"
        data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Custom Utilities:</h6>
            <a class="collapse-item <?= ($activePage == '/'.$basename.'/views/laporan/pendapatan.php') ? 'active':''; ?>" href="/<?= $basename ?>/views/laporan/pendapatan.php">Pendapatan</a>
            <a class="collapse-item <?= ($activePage == '/'.$basename.'/views/laporan/barangmasuk.php') ? 'active':''; ?>" href="/<?= $basename ?>/views/laporan/barangmasuk.php">Barang Masuk</a>
        </div>
    </div>
</li>

<!-- Divider -->
<hr class="sidebar-divider">

<!-- Heading -->
<div class="sidebar-heading">
    SETTINGS
</div>

<!-- Nav Item - Tables -->
<li class="nav-item <?= ($activePage == '/'.$basename.'/views/settings/') ? 'active':''; ?>">
    <a class="nav-link" href="/<?= $basename ?>/views/settings/">
        <i class="fas fa-fw fa-sliders-h"></i>
        <span>Pengaturan Toko</span></a>
</li>
<?php
}
?>

<!-- Nav Item - Tables -->
<li class="nav-item <?= ($activePage == '/'.$basename.'/views/settings/setup-printer.php') ? 'active':''; ?>">
    <a class="nav-link" href="/<?= $basename ?>/views/settings/setup-printer.php">
        <i class="fas fa-fw fa-cogs"></i>
        <span>Setup Printer</span></a>
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