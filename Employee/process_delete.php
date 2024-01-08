<?php 
	include '../config.php';
	include '../includes/function_delete.php';

	// DELETE PRODUCT - PRODUCT.PHP
	if (isset($_POST['delete_request'])) {
	    $req_ID = $_POST['req_ID'];
	    deleteRecord($conn, "requisition", "req_ID", $req_ID, "requisition.php");
	}

	// DELETE PRODUCT - PRODUCT.PHP
	if (isset($_POST['delete_product'])) {
	    $prod_ID = $_POST['prod_ID'];
	    deleteRecord($conn, "products", "prod_ID", $prod_ID, "product.php");
	}

?>





