<?php 

class Admins {

  function find_admin_by_username($username) { //query for admin by username
      global $connection;
      
      $safe_username = mysqli_real_escape_string($connection, $username);
      
      $query  = "SELECT * ";
      $query .= "FROM admins ";
      $query .= "WHERE username = '{$safe_username}' ";
      $query .= "LIMIT 1";
      $admin_set = mysqli_query($connection, $query);
      confirm_query($admin_set);
      if($admin = mysqli_fetch_assoc($admin_set)) {
        return $admin;
      } else {
        return null;
      }
  }

  function findAll($user) {
    global $connection;
    
    $query  = "SELECT * ";
    $query .= "FROM admins ";
    $query .= "WHERE id = ".$user;
    $userInfo = mysqli_query($connection, $query);
    confirm_query($userInfo);
    $userInfo = mysqli_fetch_assoc($userInfo);
    return $userInfo;
  }

  function username($user) {
    global $connection;
    
    $query  = "SELECT username ";
    $query .= "FROM admins ";
    $query .= "WHERE id = ".$user;
    $userName = mysqli_query($connection, $query);
    confirm_query($userName);
    $userName = mysqli_fetch_assoc($userName);
    return $userName;
  }

  function firstName($user) {
    global $connection;
    
    $query  = "SELECT first_name ";
    $query .= "FROM admins ";
    $query .= "WHERE id = ".$user;
    $firstName = mysqli_query($connection, $query);
    confirm_query($firstName);
    $firstName = mysqli_fetch_assoc($firstName);
    return $firstName;
  }

  function lastName($user) {
    global $connection;
    
    $query  = "SELECT last_name ";
    $query .= "FROM admins ";
    $query .= "WHERE id = ".$user;
    $lastName = mysqli_query($connection, $query);
    confirm_query($lastName);
    $lastName = mysqli_fetch_assoc($lastName);
    return $lastName;
  }

  function email($user) {
    global $connection;
    
    $query  = "SELECT email ";
    $query .= "FROM admins ";
    $query .= "WHERE id = ".$user;
    $email = mysqli_query($connection, $query);
    confirm_query($email);
    $email = mysqli_fetch_assoc($email);
    return $email;
  }

  function image($user) {
    global $connection;
    
    $query  = "SELECT avatar ";
    $query .= "FROM admins ";
    $query .= "WHERE id = ".$user;
    $image = mysqli_query($connection, $query);
    confirm_query($image);
    $image = mysqli_fetch_assoc($image);
    return $image;
  }

  function phone($user) {
    global $connection;
    
    $query  = "SELECT phone_number ";
    $query .= "FROM admins ";
    $query .= "WHERE id = ".$user;
    $phone = mysqli_query($connection, $query);
    confirm_query($phone);
    $phone = mysqli_fetch_assoc($phone);
    return $phone;
  }
}

?>