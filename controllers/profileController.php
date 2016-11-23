<?php
require_once("../includes/session.php");
require_once("../includes/functions.php");
require_once("../includes/db_connection.php");
require_once("../models/Admins.php");
if(isset($_GET["submit"])) {
    global $connection;
    $id = $_SESSION['admin_id'];
    $username = mysql_prep($_GET["username"]);
    if(!empty($_GET["password"])) {
      $password = password_encrypt($_GET["password"]);
    }
    $first_name = mysql_prep($_GET["first_name"]);
    $last_name = mysql_prep($_GET["last_name"]);
    $email = mysql_prep($_GET["email"]);
    $phone = mysql_prep($_GET["phone"]);

    $query  = "UPDATE admins SET ";
    $query .= "username = '{$username}', ";
    if(isset($password)) {
      $query .= "hashed_password = '{$password}', ";
    }
    $query .= "first_name = '{$first_name}', ";
    $query .= "last_name = '{$last_name}', ";
    $query .= "email = '{$email}', ";
    $query .= "phone_number = '{$phone}' ";
    $query .= "WHERE id = {$id} ";
    $query .= "LIMIT 1";
    $result = mysqli_query($connection, $query);

    if ($result && mysqli_affected_rows($connection) == 1) {
      // Success
      echo 'Your information has been updated successfully';
    } else {
      // Failure
      echo 'You have not updated any fields';
      header('HTTP/1.1 400 Bad Request');
    }
}
else if(isset($_GET["imageUpload"])) {
  // First check is there are any existing files.
  // This is there to be on the safe side, because the files input is 'required'
  if(!empty($_FILES['image']['name'])) {
    global $connection;
    $files = $_FILES['image'];
    $file_name = $files['name'];
    $id = $_SESSION['admin_id'];
    $files = $_FILES['image'];
    $file_name = $files['name'];
    $file_tmp = $files['tmp_name'];
    $file_size = $files['size'];
    $file_error = $files['error'];
    // Check is file has no errors
    if($file_error === 1) {
      $_SESSION['errors'] = "Image can't be larger than 3Mb";
      redirect_to('../pages/profile'); // redirect with failure
    }
    if($file_error === 0) {
      // Check is file size is less than 16Mbs
      if($file_size <= 3000000) {
        // Push the file with in the correct category and make sure the filename doesn't have any spaces.
        $file_destination = "../images/" . str_replace(' ', '_', $file_name);
        // PHP's upload function
        move_uploaded_file($file_tmp, $file_destination);    
      } //end if
      else {
        $_SESSION['errors'] = "Image can't be larger than 3Mb";
        redirect_to('../pages/profile');
      } // end else 
      $query  = "UPDATE admins SET ";
      $query .= "avatar = '{$file_name}' ";
      $query .= "WHERE id = {$id} ";
      $query .= "LIMIT 1";
      $result = mysqli_query($connection, $query);
      if ($result && mysqli_affected_rows($connection) == 1) {
        $_SESSION['message'] =   "Profile picture updated successfully"; //successful upload message
      } else{
        $_SESSION['errors'] = "Oops something went wrong.";
      }
    } // end if
    
    redirect_to('../pages/profile'); // redirect with success 
  } // end if
}
else {
  $user = new Admins();
  $userInfo = $user->findAll($_SESSION["admin_id"]);
  $username = $userInfo["username"];
  $email = $userInfo["email"];
  $firstName  = $userInfo["first_name"];
  $lastName = $userInfo["last_name"];
  $image  = $userInfo["avatar"];
  $phone  = $userInfo["phone_number"];
}

?>