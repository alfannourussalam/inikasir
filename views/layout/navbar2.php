<?php

$thisPage = basename($_SERVER['PHP_SELF']);
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

function permission_show()
{
  global $pdo;
  global $role_id;
  $a = "SELECT role_permission.id, role_permission.permission,
        menu_parents.nama as nama_parent, menu_parents.icon, menu_parents.link as link_parent,
        menu_child.nama as nama_child, menu_child.link as link_child
        FROM role_permission
        JOIN menu_parents ON role_permission.parent_id = menu_parents.id
        LEFT JOIN menu_child ON role_permission.child_id = menu_child.id
        WHERE role_permission.role_id = :role_id AND role_permission.permission = :permission";

  $q = "SELECT role_permission.id, role_permission.permission,
        menu_parents.id as id_parent, menu_parents.nama as nama_parent, menu_parents.icon, menu_parents.link as link_parent
        FROM role_permission
        JOIN menu_parents ON role_permission.parent_id = menu_parents.id
        WHERE role_permission.role_id = :role_id AND role_permission.permission = :permission
        GROUP BY menu_parents.id";

  $show = $pdo->prepare($q);
  $show->bindValue(':role_id', $role_id);
  $show->bindValue(':permission', 1);
  $show->execute();
  $result = $show->fetchAll();

  return $result;
}

function get_child($id_parent)
{
  global $pdo;  

  $q = "SELECT nama, link FROM menu_child WHERE id_parents=:id_parent";
  $get_child = $pdo->prepare($q);
  $get_child->bindValue(':id_parent', $id_parent);
  $get_child->execute();
  $result = $get_child->fetchAll();

  return $result;
}

$permission = permission_show();

?>


<!-- Preloader-->
<div class="preloader" id="preloader">
  <div class="spinner-grow text-secondary" role="status">
    <div class="sr-only">Loading...</div>
  </div>
</div>
<!-- Header Area-->
<div class="header-area" id="headerArea">
  <div class="container h-100 d-flex align-items-center justify-content-between">
    <!-- Back Button-->
    <div class="back-button"><a type="submit" onclick="window.history.go(-1)">
        <svg class="bi bi-arrow-left" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 16 16">
          <path fill-rule="evenodd" d="M15 8a.5.5 0 0 0-.5-.5H2.707l3.147-3.146a.5.5 0 1 0-.708-.708l-4 4a.5.5 0 0 0 0 .708l4 4a.5.5 0 0 0 .708-.708L2.707 8.5H14.5A.5.5 0 0 0 15 8z"></path>
        </svg></a>
    </div>
    <!-- Page Title-->
    <div class="page-heading">
      <h6 class="mb-0"><?= $page[$thisPage] ?></h6>
    </div>
    <!-- Navbar Toggler-->
    <div class="suha-navbar-toggler" data-bs-toggle="offcanvas" data-bs-target="#suhaOffcanvas" aria-controls="suhaOffcanvas"><span></span><span></span><span></span></div>
  </div>
</div>
<div class="offcanvas offcanvas-start suha-offcanvas-wrap" tabindex="-1" id="suhaOffcanvas" aria-labelledby="suhaOffcanvasLabel">
  <!-- Close button-->
  <button class="btn-close btn-close-white text-reset" type="button" data-bs-dismiss="offcanvas" aria-label="Close"></button>
  <!-- Offcanvas body-->
  <div class="offcanvas-body">
    <!-- Sidenav Profile-->
    <div class="sidenav-profile">
      <div class="user-profile"><img src="/<?php echo $basename ?>/assets/img/male.png" alt=""></div>
      <div class="user-info">
        <h6 class="user-name mb-1"><?php echo $_SESSION['name'] ?></h6>
        <p class="available-balance"><?php echo $_SESSION['nama_toko'] ?></span></p>
      </div>
    </div>
    <!-- Sidenav Nav-->
    <ul class="sidenav-nav ps-0">
      <?php
      
      foreach ($permission as $p) {
        $child = get_child($p['id_parent']);
        if (count($child) > 0){ ?>
          <li class="suha-dropdown-menu"><a href="#"><i class="lni lni-database"></i>Master Data</a>
            <ul>
            <?php
            foreach ($child as $c){ ?>
              <li><a href="/<?= $basename ?>/<?php echo $c['link'] ?>">- <?php echo $c['nama'] ?></a></li>
            <?php
            }
            ?>
            </ul>
        <?php
        }

        else{ ?>
          <li><a href="/<?= $basename ?>/<?php echo $p['link_parent'] ?>"><i class="<?php echo $p['icon'] ?>"></i><?php echo $p['nama_parent'] ?></a></li>
        <?php
        }
      }
      ?>
      <li><a href="/<?= $basename ?>/logout.php"><i class="lni lni-power-switch"></i>Sign Out</a></li>
    </ul>
  </div>
</div>