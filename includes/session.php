<?php

	session_start(); //php function for starting the session
	
	function message() { //for providing any messages on the page, once per page load.
		if (isset($_SESSION["message"])) {

			$output = '<div class="alert alert-success">';
			$output .= '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>';
			$output .= '<strong>' . $_SESSION["message"] .  '</strong></div>';
			
			// clear message after use
			$_SESSION["message"] = null;
			
			return $output;
		}
	}

	function errors() {
		if (isset($_SESSION["errors"])) {

			$errors = '<div class="alert alert-danger">';
			$errors .= '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>';
			$errors .= '<strong>' . $_SESSION["errors"] .  '</strong></div>';
			
			// clear message after use
			$_SESSION["errors"] = null;
			
			return $errors;
		}
	}
	
?>