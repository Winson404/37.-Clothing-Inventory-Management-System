<?php 
	require_once '../config.php';
	require_once '../includes/function_update.php';


	// UPDATE ADMIN INFO - PROFILE.PHP
	if (isset($_POST['update_profile_info'])) {
	    $user_Id = mysqli_real_escape_string($conn, $_POST['user_Id']);
	    updateProfileInfo($conn, $user_Id, "profile.php");
	}



	// CHANGE USERS PASSWORD - USERS_DELETE.PHP
	if (isset($_POST['update_password_admin'])) {
	    $user_Id     = $_POST['user_Id'];
	    $OldPassword = md5($_POST['OldPassword']);
	    $password    = md5($_POST['password']);
	    $cpassword   = md5($_POST['cpassword']);
	    changePassword($conn, $user_Id, $OldPassword, $password, $cpassword, "profile.php");
	}



	// UPDATE ADMIN PROFILE - PROFILE.PHP
	if (isset($_POST['update_profile_admin'])) {
	    $user_Id = $_POST['user_Id'];
	    updateProfileAdmin($conn, $user_Id, "profile.php");
	}




	// UPDATE PRODUCT - PRODUCT.PHP
	if (isset($_POST['update_product'])) {
		$prod_ID   = $_POST['prod_ID'];
		update_product($conn, $prod_ID, "product.php");
	}



	// UPDATE REQUISITION - REQUISITION.PHP
	if (isset($_POST['update_request'])) {
		$req_ID   = $_POST['req_ID'];
		update_request($conn, $req_ID, "requisition.php");
	}



	

?>
