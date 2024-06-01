<?php
// include_once '../../config/auth.inc';
// include_once '../../config/config.php';
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




<!-- HEADER AREA -->
<div class="header-area" id="headerArea">
  <div class="container h-100 d-flex align-items-center justify-content-between">
    <!-- Logo Wrapper-->
    <div class="logo-wrapper"><a href="/<?php echo $basename ?>/"><img src="/<?php echo $basename ?>/assets/img/logo1.png" alt="" style="width: 100px;"></a></div>
    <!-- Search Form-->
    <!-- <div class="top-search-form">
      <form action="" method="">
        <input class="form-control" type="search" placeholder="Enter your keyword">
        <button type="submit"><i class="fa fa-search"></i></button>
      </form>
    </div> -->
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
        <p class="available-balance"><?php echo $nama_toko ?></p>
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
      <li><a href="/<?= $basename ?>/logout.php"><i class="lni lni-power-switch"></i>Keluar</a></li>
    </ul>
  </div>
</div>