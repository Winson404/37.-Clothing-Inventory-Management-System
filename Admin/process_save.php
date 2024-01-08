<?php 
	include '../config.php';
	// include('../phpqrcode/qrlib.php');
	include '../includes/function_create.php';
	

	// SAVE ADMIN - ADMIN_MGMT.PHP
	if (isset($_POST['create_admin'])) {
	    $user_type = 'Admin';
	    $path = "../images-users/";
	    saveUser($conn, "admin_mgmt.php?page=create", $user_type, $path);
	}


	// SAVE USERS - USERS_MGMT.PHP
	if (isset($_POST['create_user'])) {
		$user_type = "Employee";
		$path = "../images-users/";
	    saveUser($conn, "users_mgmt.php?page=create", $user_type, $path);
	}


	// SAVE SUPPLIER - SUPPLIER.PHP
	if (isset($_POST['create_supplier'])) {
		create_supplier($conn, "suppliers.php");
	}



	// SAVE PRODUCT - PRODUCT.PHP
	if (isset($_POST['create_product'])) {
		create_product($conn, "product.php");
	}



	// SAVE REQUISITION - REQUISITION.PHP
	if (isset($_POST['create_request'])) {
		create_request($conn, "requisition.php");
	}

	


	// SAVE ACTIVITY - ANNOUNCEMENT_ADD.PHP
	if (isset($_POST['create_activity'])) {
		$activity = mysqli_real_escape_string($conn, $_POST['activity']);
		$actDate  = mysqli_real_escape_string($conn, $_POST['actDate']);
		saveActivity($conn, "announcement.php", $activity, $actDate);
	}


	// DATABASE RESTORATION - RESTORE.PHP
	if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['restore'])) {
	    $file = $_FILES['fileToRestore']['tmp_name'];
	    if (!$file) {
	        die("Please choose a file to restore.");
	    }
	    $sql = file_get_contents($file);
	    $queries = explode(';', $sql);
	    foreach ($queries as $query) {
	        if (!empty(trim($query))) {
	            $result = mysqli_query($conn, $query);
	            if (!$result) {
	                die("Error executing SQL query: " . mysqli_error($conn));
	            }
	        }
	    }
	    $_SESSION['message'] = "Database restoration successful";
		$_SESSION['text'] = "Sent successfully!";
		$_SESSION['status'] = "success";
		header("Location: restore.php");
	}

	
	
?>



