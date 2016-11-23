<?php 

class Notifications {

  function allUnSeenNotifications() { //query for admin by username
      global $connection;
      
      $admin_id = $_SESSION["admin_id"];
      $query  = "SELECT ";
      $query .= "notifications.id, type, notification, timestamp, seen, notifications.read, notifications.hidden, first_name, last_name ";
      $query .= "FROM notifications ";
      $query .= "LEFT JOIN admins ON admins.id = notifications.assigned_from ";
      $query .= "WHERE assigned_to = '{$admin_id}' AND seen = 0";
      $notifications_set = mysqli_query($connection, $query);
      confirm_query($notifications_set);
      return $notifications_set;
  }
  function allUnSeenNotiCount() { //query for admin by username
      global $connection;
      
      $admin_id = $_SESSION["admin_id"];
      $query  = "SELECT ";
      $query .= "count(*) AS cnt ";
      $query .= "FROM notifications ";
      $query .= "LEFT JOIN admins ON admins.id = notifications.assigned_from ";
      $query .= "WHERE assigned_to = '{$admin_id}' AND seen = 0 AND hidden = 0";
      $notifications_set = mysqli_query($connection, $query);
      confirm_query($notifications_set);
      return $notifications_set;
  }
    function see3Notifications() { //query for admin by username
      global $connection;
      
      $admin_id = $_SESSION["admin_id"];
      $query  = "SELECT ";
      $query .= "notifications.id, type, notification, timestamp, seen, notifications.read, notifications.hidden, first_name, last_name ";
      $query .= "FROM notifications ";
      $query .= "LEFT JOIN admins ON admins.id = notifications.assigned_from ";
      $query .= "WHERE assigned_to = '{$admin_id}' AND hidden <> 1 ORDER BY timestamp ASC LIMIT 3";
      $notifications_set = mysqli_query($connection, $query);
      confirm_query($notifications_set);
      return $notifications_set;
  }
}
?>