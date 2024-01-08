<?php 
	include '../config.php';
	include '../includes/function_delete.php';

	// DELETE ADMIN - ADMIN_DELETE.PHP
	if (isset($_POST['delete_admin'])) {
	    $user_Id = $_POST['user_Id'];
	    deleteRecord($conn, "users", "user_Id", $user_Id, "admin.php");
	}


	// DELETE USER - USERS_DELETE.PHP
	if (isset($_POST['delete_user'])) {
	    $user_Id = $_POST['user_Id'];
	    deleteRecord($conn, "users", "user_Id", $user_Id, "users.php");
	}


	// DELETE CUSTOMIZATION - CUSTOMIZE_UPDATE_DELETE.PHP
	if (isset($_POST['delete_customization'])) {
	    $customID = $_POST['customID'];
	    deleteRecord($conn, "customization", "customID", $customID, "customize.php");
	}


	// DELETE ACTIVITY - ACTIVITY_UPDATE_DELETE.PHP
	if (isset($_POST['delete_activity'])) {
	    $actId = $_POST['actId'];
	    deleteRecord($conn, "announcement", "actId", $actId, "announcement.php");
	}



	// DELETE CUSTOMERS - CUSTOMERS.PHP
	if (isset($_POST['delete_supplier'])) {
	    $supplier_ID = $_POST['supplier_ID'];
	    deleteRecord($conn, "suppliers", "supplier_ID", $supplier_ID, "suppliers.php");
	}


	// DELETE PRODUCT - PRODUCT.PHP
	if (isset($_POST['delete_product'])) {
	    $prod_ID = $_POST['prod_ID'];
	    deleteRecord($conn, "products", "prod_ID", $prod_ID, "product.php");
	}


?>




