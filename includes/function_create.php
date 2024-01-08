<?php 

	use PHPMailer\PHPMailer\PHPMailer;
	use PHPMailer\PHPMailer\Exception;
	// require '../vendor/PHPMailer/src/Exception.php';
	// require '../vendor/PHPMailer/src/PHPMailer.php';
	// require '../vendor/PHPMailer/src/SMTP.php';
	if (!class_exists('PHPMailer\PHPMailer\Exception')) { require __DIR__ . '/../vendor/PHPMailer/src/Exception.php'; }
	if (!class_exists('PHPMailer\PHPMailer\PHPMailer')) { require __DIR__ . '/../vendor/PHPMailer/src/PHPMailer.php'; }
	if (!class_exists('PHPMailer\PHPMailer\SMTP')) { require __DIR__ . '/../vendor/PHPMailer/src/SMTP.php'; }

	
	// SAVE SYSTEM USERS - ADMIN/ADMIN_MGMT.PHP || ADMIN/USERS_MGMT.PHP
	function saveUser($conn, $page, $user_type = "User", $path = "images-users/") {
		$firstname      = ucwords(mysqli_real_escape_string($conn, $_POST['firstname']));
		$middlename     = ucwords(mysqli_real_escape_string($conn, $_POST['middlename']));
		$lastname       = ucwords(mysqli_real_escape_string($conn, $_POST['lastname']));
		$suffix         = ucwords(mysqli_real_escape_string($conn, $_POST['suffix']));
		$dob            = ucwords(mysqli_real_escape_string($conn, $_POST['dob']));
		$age            = ucwords(mysqli_real_escape_string($conn, $_POST['age']));
		$birthplace     = ucwords(mysqli_real_escape_string($conn, $_POST['birthplace']));
		$gender         = ucwords(mysqli_real_escape_string($conn, $_POST['gender']));
		$civilstatus    = ucwords(mysqli_real_escape_string($conn, $_POST['civilstatus']));
		$occupation     = ucwords(mysqli_real_escape_string($conn, $_POST['occupation']));
		$religion       = ucwords(mysqli_real_escape_string($conn, $_POST['religion']));
		$email          = mysqli_real_escape_string($conn, $_POST['email']);
		$contact        = mysqli_real_escape_string($conn, $_POST['contact']);
		$house_no       = ucwords(mysqli_real_escape_string($conn, $_POST['house_no']));
		$street_name    = ucwords(mysqli_real_escape_string($conn, $_POST['street_name']));
		$purok          = ucwords(mysqli_real_escape_string($conn, $_POST['purok']));
		$zone           = ucwords(mysqli_real_escape_string($conn, $_POST['zone']));
		$barangay       = ucwords(mysqli_real_escape_string($conn, $_POST['barangay']));
		$municipality   = ucwords(mysqli_real_escape_string($conn, $_POST['municipality']));
		$province       = ucwords(mysqli_real_escape_string($conn, $_POST['province']));
		$region         = ucwords(mysqli_real_escape_string($conn, $_POST['region']));
		$password         = md5($_POST['password']);
		$file             = basename($_FILES["fileToUpload"]["name"]);

	    $check_email = mysqli_query($conn, "SELECT * FROM users WHERE email='$email'");
	    if (mysqli_num_rows($check_email) > 0) {
	        displayErrorMessage("Email already exists!", $page);
	    } else {
	        $target_dir = $path;
	        $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
	        $uploadOk = 1;
	        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
	        $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
	        if ($check == false) {
	            displayErrorMessage("File is not an image.", $page);
	            $uploadOk = 0;
	        } elseif ($_FILES["fileToUpload"]["size"] > 500000) {
	            displayErrorMessage("File must be up to 500KB in size.", $page);
	            $uploadOk = 0;
	        } elseif ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
	            displayErrorMessage("Only JPG, JPEG, PNG & GIF files are allowed.", $page);
	            $uploadOk = 0;
	        } elseif ($uploadOk == 0) {
	            displayErrorMessage("Your file was not uploaded.", $page);
	        } else {
	            if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
	            	$save = mysqli_query($conn, "INSERT INTO users (firstname, middlename, lastname, suffix, dob, age, email, contact, birthplace, gender, civilstatus, occupation, religion, house_no, street_name, purok, zone, barangay, municipality, province, region, image, password, user_type, date_registered) VALUES ('$firstname', '$middlename', '$lastname', '$suffix', '$dob', '$age', '$email', '$contact', '$birthplace', '$gender', '$civilstatus', '$occupation', '$religion', '$house_no', '$street_name', '$purok', '$zone', '$barangay', '$municipality', '$province', '$region', '$file', '$password', '$user_type', NOW())");
	            	displaySaveMessage($save, $page);
	            } else {
	            	displayErrorMessage("There was an error uploading your profile picture.", $page); 
	            }
	        }
	    }
	}



	// SAVE ACTIVITY - ADMIN/ANNOUNCEMENT_ADD.PHP
	function saveActivity($conn, $page, $activity, $actDate) {
		$save = mysqli_query($conn, "INSERT INTO announcement (actName, actDate, date_added) VALUES ('$activity', '$actDate', NOW())");
		displaySaveMessage($save, $page);
	}



	// SAVE SUPPLIERS - SUPPLIERS.PHP
	function create_supplier($conn, $page) {
		$f_name  = ucwords(mysqli_real_escape_string($conn, $_POST['f_name']));
		$m_name  = ucwords(mysqli_real_escape_string($conn, $_POST['m_name']));
		$l_name  = ucwords(mysqli_real_escape_string($conn, $_POST['l_name']));
		$address = ucwords(mysqli_real_escape_string($conn, $_POST['address']));
		$contact = mysqli_real_escape_string($conn, $_POST['contact']);
		$save = mysqli_query($conn, "INSERT INTO suppliers (f_name, m_name, l_name, address, contact) VALUES ('$f_name', '$m_name', '$l_name', '$address', '$contact')");
    	displaySaveMessage($save, $page);
	}



	// SAVE PRODUCT - PRODUCT.PHP
	function create_product($conn, $page) {
		$prod_name  = ucwords(mysqli_real_escape_string($conn, $_POST['prod_name']));
		$prod_desc  = mysqli_real_escape_string($conn, $_POST['prod_desc']);
		$prod_size  = ucwords(mysqli_real_escape_string($conn, $_POST['prod_size']));
		$prod_color = ucwords(mysqli_real_escape_string($conn, $_POST['prod_color']));
		$prod_qty   = mysqli_real_escape_string($conn, $_POST['prod_qty']);
		$prod_price = mysqli_real_escape_string($conn, $_POST['prod_price']);
		$supplier_ID = mysqli_real_escape_string($conn, $_POST['supplier_ID']);
		$save = mysqli_query($conn, "INSERT INTO products (prod_name, prod_desc, prod_size, prod_color, prod_qty, prod_qty_orig, prod_price, supplier_ID) VALUES ('$prod_name', '$prod_desc', '$prod_size', '$prod_color', '$prod_qty', '$prod_qty', '$prod_price', '$supplier_ID')");
    	displaySaveMessage($save, $page);
	}



	// SAVE REQUISITION - REQUISITION.PHP
	function create_request($conn, $page) {
		$emp_ID       = mysqli_real_escape_string($conn, $_POST['emp_ID']);
		$prod_ID      = mysqli_real_escape_string($conn, $_POST['prod_ID']);
		$req_qty      = mysqli_real_escape_string($conn, $_POST['req_qty']);
		$requirements = mysqli_real_escape_string($conn, $_POST['requirements']);
		$reason       = mysqli_real_escape_string($conn, $_POST['reason']);
		$notes        = mysqli_real_escape_string($conn, $_POST['notes']);
		$check = mysqli_query($conn, "SELECT * FROM products WHERE prod_ID='$prod_ID'");
		$row = mysqli_fetch_array($check);
		$stock = $row['prod_qty'];
		if($req_qty <= $stock) {
			$save = mysqli_query($conn, "INSERT INTO requisition (emp_ID, prod_ID, req_qty, requirements, reason, notes) VALUES ('$emp_ID', '$prod_ID', '$req_qty', '$requirements', '$reason', '$notes')");
    		displaySaveMessage($save, $page);
		} else {
			displayErrorMessage("Request quantity should be lesser than or equal to number of stocks of the product.", $page);
		}
	}




	// RESTOCK REQUISITION - REQUISITION.PHP
	function restock_request($conn, $page) {
		$emp_ID       = mysqli_real_escape_string($conn, $_POST['emp_ID']);
		$prod_ID      = mysqli_real_escape_string($conn, $_POST['prod_ID']);
		$req_qty      = mysqli_real_escape_string($conn, $_POST['req_qty']);
		$requirements = mysqli_real_escape_string($conn, $_POST['requirements']);
		$reason       = mysqli_real_escape_string($conn, $_POST['reason']);
		$notes        = mysqli_real_escape_string($conn, $_POST['notes']);
		$check = mysqli_query($conn, "SELECT * FROM products WHERE prod_ID='$prod_ID'");
		$row = mysqli_fetch_array($check);
		$stock = $row['prod_qty'];
		if($req_qty <= $stock) {
			$save = mysqli_query($conn, "INSERT INTO requisition (emp_ID, prod_ID, req_qty, requirements, reason, notes) VALUES ('$emp_ID', '$prod_ID', '$req_qty', '$requirements', '$reason', '$notes')");
    		displaySaveMessage($save, $page);
		} else {
			displayErrorMessage("Request quantity should be lesser than or equal to number of stocks of the product.", $page);
		}
	}









	// CONTACT EMAIL MESSAGING
	function sendEmail($subject, $message, $recipientEmail, $page) {
	    $mail = new PHPMailer(true);
	    try {
	        // Server settings
	        $mail->isSMTP();
	        $mail->Host = 'smtp.gmail.com';
	        $mail->SMTPAuth = true;
	        $mail->Username = 'tatakmedellin@gmail.com';
	        $mail->Password = 'nzctaagwhqlcgbqq';
	        $mail->SMTPOptions = array(
	            'ssl' => array(
	                'verify_peer' => false,
	                'verify_peer_name' => false,
	                'allow_self_signed' => true
	            )
	        );
	        $mail->SMTPSecure = 'ssl';
	        $mail->Port = 465;

	        // Send Email
	        $mail->setFrom('tatakmedellin@gmail.com', 'Cebu & Co');

	        // Recipients
	        $mail->addAddress($recipientEmail);
	        $mail->addReplyTo('tatakmedellin@gmail.com');

	        // Content
	        $mail->isHTML(true);
	        $mail->Subject = $subject;
	        $mail->Body = $message;

	        $mail->send();

	        $_SESSION['message'] = "Email sent successfully!";
			$_SESSION['text'] = "Sent successfully!";
			$_SESSION['status'] = "success";
			header("Location: $page");

	    } catch (Exception $e) {
	        $_SESSION['message'] = "Message could not be sent. Mailer Error: " . $mail->ErrorInfo;
	        header("Location: $page");
	    }
	}


?>



