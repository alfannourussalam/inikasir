    <?php
    $activePage = $_SERVER['REQUEST_URI'];
    $role = $_SESSION['role'];
    // $role = 'kasir';

    if ($role == 'admin') {
      $role_id = 1;
      $nama_toko = $_SESSION['nama_toko'];
    }
    if ($role == 'kasir') {
      $role_id = 2;
      $nama_toko = '';
    }

    if ($role_id == 1) { ?>
      <!-- Internet Connection Status-->
      <div class="internet-connection-status" id="internetStatus"></div>
      <!-- Footer Nav-->
      <div class="footer-nav-area" id="footerNav">
        <div class="container h-100 px-0">
          <div class="suha-footer-nav h-100">
            <ul class="h-100 d-flex align-items-center justify-content-between ps-0">
              <li class="<?= ($activePage == '/' . $basename . '/') ? 'active' : ''; ?>"><a href="/<?= $basename ?>/"><i class="lni lni-home"></i>Beranda</a></li>
              <li class="<?= ($activePage == '/' . $basename . '/views/barangmasuk/') ? 'active' : ''; ?>"><a href="/<?= $basename ?>/views/barangmasuk/"><i class="lni lni-package"></i>Barang Masuk</a></li>
              <li class="<?= ($activePage == '/' . $basename . '/views/riwayat-transaksi/') ? 'active' : ''; ?>"><a href="/<?= $basename ?>/views/riwayat-transaksi/"><i class="lni lni-ticket-alt"></i>Riwayat Transaksi</a></li>
              <li class="<?= ($activePage == '/' . $basename . '/views/settings/') ? 'active' : ''; ?>"><a href="/<?= $basename ?>/views/settings/"><i class="lni lni-cog"></i>Pengaturan</a></li>
            </ul>
          </div>
        </div>
      </div>
    <?php
    } else { ?>

      <!-- Internet Connection Status-->
      <div class="internet-connection-status" id="internetStatus"></div>
      <!-- Footer Nav-->
      <div class="footer-nav-area" id="footerNav">
        <div class="container h-100 px-0">
          <div class="suha-footer-nav h-100">
            <ul class="h-100 d-flex align-items-center justify-content-between ps-0">
              <li class="<?= ($activePage == '/' . $basename . '/views/transaksi/') ? 'active' : ''; ?>"><a href="/<?= $basename ?>/views/transaksi/"><i class="lni lni-cart"></i></a></li>
              <li class="<?= ($activePage == '/' . $basename . '/views/riwayat-transaksi/') ? 'active' : ''; ?>"><a href="/<?= $basename ?>/views/riwayat-transaksi/"><i class="lni lni-ticket-alt"></i></a></li>
              <li class="<?= ($activePage == '/' . $basename . '/views/printer-setup.php') ? 'active' : ''; ?>"><a href="/<?= $basename ?>/views/printer-setup.php"><i class="lni lni-printer"></i></a></li>
            </ul>
          </div>
        </div>
      </div>

    <?php
    }
    ?>