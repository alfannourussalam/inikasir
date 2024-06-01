<?php
$basename = 'inikasir';

session_start();
if (!isset($_SESSION['name'])) {
	header('Location:/'.$basename.'/login.php');
}

$icon = 'mainlogo.png';