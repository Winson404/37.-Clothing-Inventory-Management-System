<?php 
	require_once '../config.php';
	// include('../phpqrcode/qrlib.php');
	require_once '../includes/function_create.php';
	
	// SAVE PRODUCT - PRODUCT.PHP
	if (isset($_POST['create_product'])) {
		create_product($conn, "product.php");
	}


	// SAVE REQUISITION - REQUISITION.PHP
	if (isset($_POST['create_request'])) {
		create_request($conn, "requisition.php");
	}


	// RESTOCK REQUISITION - REQUISITION.PHP
	if (isset($_POST['restock_request'])) {
		restock_request($conn, "requisition.php");
	}


	
	// CONTACT EMAIL MESSAGING - CONTACT-US.PHP
	if (isset($_POST['sendEmail'])) {
	    $name = mysqli_real_escape_string($conn, $_POST['name']);
	    $email = mysqli_real_escape_string($conn, $_POST['email']);
	    $subject = mysqli_real_escape_string($conn, $_POST['subject']);
	    $msg = mysqli_real_escape_string($conn, $_POST['message']);

	    $message = '<h3>' . $subject . '</h3>
	        <p>
	            Good day!<br>
	            ' . $msg . '
	        </p>
	        <p>
	            Name of Sender: ' . $name . '<br>
	            Email: ' . $email . '
	        </p>
	        <p><b>Note:</b> This is a system generated email please do not reply.</p>';

	    sendEmail($subject, $message, $recipientEmail="sonerwin12@gmail.com", "contact-us.php");

	}

?>



