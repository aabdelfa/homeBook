<?php
require_once("../includes/session.php");
require_once("../includes/functions.php");
require_once("../includes/db_connection.php");
require_once("../models/Notifications.php");

if(isset($_POST["validate_seen"])){
  $admin_id = $_SESSION["admin_id"];
  $seen = $_POST["seen"];
  $query  = "UPDATE notifications SET ";
  $query .= "seen = '{$seen}' ";
  $query .= "WHERE assigned_to = {$admin_id}";
  $result = mysqli_query($connection, $query);
  echo $result;
}
if(isset($_POST["validate_hidden"])){
  $admin_id = $_SESSION["admin_id"];
  $hidden = $_POST["hidden"];
  $id = $_POST["id"];
  $query  = "UPDATE notifications SET ";
  $query .= "hidden = '{$hidden}' ";
  $query .= "WHERE id = {$id}";
  $result = mysqli_query($connection, $query);
  echo $result;
}
?>