<?php require_once("../includes/session.php"); ?>
<?php require_once("../includes/db_connection.php"); ?>
<?php require_once("../includes/functions.php"); ?>
<?php include "../models/Notifications.php" ?>
<?php confirm_logged_in(); ?>
<?php require_once("../Controllers/" . explode('.', basename($_SERVER['PHP_SELF']))[0] . "Controller.php"); ?>
<?php date_default_timezone_set('America/New_York'); ?>
<?php 

$notif = new Notifications();
$notiCnt = $notif->allUnSeenNotiCount();
$notiCnt = mysqli_fetch_assoc($notiCnt);
$notiCnt = $notiCnt["cnt"];

$see3 = $notif->see3Notifications();

while( $notis = mysqli_fetch_assoc($see3)) {
  $noti3[] = $notis;
}
?>