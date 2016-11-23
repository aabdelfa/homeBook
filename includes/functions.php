<?php

function redirect_to($new_location) { //redirect to $new_location func.
  header("Location: " . $new_location);
  exit;
}

function mysql_prep($string) { //for refining query search and searching database using $connection
	global $connection;
	
	$escaped_string = mysqli_real_escape_string($connection, $string);
	return $escaped_string;
}

function confirm_query($result_set) { //Makes sure query is executed correctly
	if (!$result_set) {
		die("Database query failed.");
	}
}

function password_encrypt($password) {
	$hash_format = "$2y$10$";   // Tells PHP to use Blowfish with a "cost" of 10
  $salt_length = 22; 					// Blowfish salts should be 22-characters or more
  $salt = generate_salt($salt_length);
  $format_and_salt = $hash_format . $salt;
  $hash = crypt($password, $format_and_salt);
	return $hash;
}

function generate_salt($length) {
  // Not 100% unique, not 100% random, but good enough for a salt
  // MD5 returns 32 characters
  $unique_random_string = md5(uniqid(mt_rand(), true));
  
	// Valid characters for a salt are [a-zA-Z0-9./]
  $base64_string = base64_encode($unique_random_string);
  
	// But not '+' which is valid in base64 encoding
  $modified_base64_string = str_replace('+', '.', $base64_string);
  
	// Truncate string to the correct length
  $salt = substr($modified_base64_string, 0, $length);
  
	return $salt;
}

function password_check($password, $existing_hash) { //for matching the password in database after converting to the hashed password
	// existing hash contains format and salt at start
  $hash = crypt($password, $existing_hash);
  if ($hash === $existing_hash) {
    return true;
  } else {
    return false;
  }
}


function find_page_by_id($id) { //query for user by id
	global $connection;
	
	$page_id = $id;
	
	$query  = "SELECT * ";
	$query .= "FROM pages ";
	$query .= "WHERE id = {$page_id} ";
	$query .= "LIMIT 1";
	$sp = mysqli_query($connection, $query);
	confirm_query($sp);
		return $sp;
}

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

function attempt_login($username, $password) { //used in login page...provided the username and password from user
	$admin = find_admin_by_username($username);
	if ($admin) {
		// found admin, now check password
		if (password_check($password, $admin["hashed_password"])) {
			// password matches
			return $admin;
		} else {
			// password does not match
			return false;
		}
	} else {
		// admin not found
		return false;
	}
}

function logged_in() { //check to see if admin id is generated in the session
	return isset($_SESSION['admin_id']);
}

function confirm_logged_in() { //call the logged_in function to ensure user is logged in
	if (!logged_in()) {
		redirect_to("logout.php");
	} 

}
function limit_text($text, $limit) {
  if (str_word_count($text, 0) > $limit) {
      $words = str_word_count($text, 2);
      $pos = array_keys($words);
      $text = substr($text, 0, $pos[$limit]) . '...';
  }
  return $text;
}

?>