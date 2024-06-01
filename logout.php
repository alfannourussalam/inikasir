<?php
require 'config/config.php';

session_start();
unset($_SESSION['account']);
unset($_SESSION['name']);
unset($_SESSION['id']);
unset($_SESSION['myid']);
unset($_SESSION['role']);
unset($_SESSION['nama_toko']);
header('Location:/'. $basename .'/login.php');