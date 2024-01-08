<?php 

	use PHPMailer\PHPMailer\PHPMailer;
	use PHPMailer\PHPMailer\Exception;
	// require '../vendor/PHPMailer/src/Exception.php';
	// require '../vendor/PHPMailer/src/PHPMailer.php';
	// require '../vendor/PHPMailer/src/SMTP.php';
	if (!class_exists('PHPMailer\PHPMailer\Exception')) { require __DIR__ . '/../vendor/PHPMailer/src/Exception.php'; }
	if (!class_exists('PHPMailer\PHPMailer\PHPMailer')) { require __DIR__ . '/../vendor/PHPMailer/src/PHPMailer.php'; }
	if (!class_exists('PHPMailer\PHPMailer\SMTP')) { require __DIR__ . '/../vendor/PHPMailer/src/SMTP.php'; }

	
	function updateSystemUser($conn, $user_Id, $page) {
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

		$file             = basename($_FILES["fileToUpload"]["name"]);

		$check_email = mysqli_query($conn, "SELECT * FROM users WHERE email='$email' AND user_Id !='$user_Id'");
		if(mysqli_num_rows($check_email) > 0) {
	       displayErrorMessage("Email already exists.", $page);
		} else {
			if(empty($file)) {
				$update = mysqli_query($conn, "UPDATE users SET firstname='$firstname', middlename='$middlename', lastname='$lastname', suffix='$suffix', dob='$dob', age='$age', email='$email', contact='$contact', birthplace='$birthplace', gender='$gender', civilstatus='$civilstatus', occupation='$occupation', religion='$religion', house_no='$house_no', street_name='$street_name', purok='$purok', zone='$zone', barangay='$barangay', municipality='$municipality', province='$province', region='$region' WHERE user_Id='$user_Id' ");
				displayUpdateMessage($update, $page);
			} else {
				// Check if image file is a actual image or fake image
				$target_dir = "../images-users/";
				$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
				$uploadOk = 1;
				$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

				$check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
				if($check == false) {
				    displayErrorMessage("File is not an image.", $page);
					$uploadOk = 0;
				} 

				// Check file size // 500KB max size
				elseif ($_FILES["fileToUpload"]["size"] > 500000) {
				    displayErrorMessage("File must be up to 500KB in size.", $page);
					$uploadOk = 0;
				}

				// Allow certain file formats
				elseif($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" ) {
				    displayErrorMessage("Only JPG, JPEG, PNG & GIF files are allowed.", $page);
				    $uploadOk = 0;
				}

				// Check if $uploadOk is set to 0 by an error
				elseif ($uploadOk == 0) {
					displayErrorMessage("Your file was not uploaded.", $page);
				// if everything is ok, try to upload file
				} else {

					if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {

					 $update = mysqli_query($conn, "UPDATE users SET firstname='$firstname', middlename='$middlename', lastname='$lastname', suffix='$suffix', dob='$dob', age='$age', email='$email', contact='$contact', birthplace='$birthplace', gender='$gender', civilstatus='$civilstatus', occupation='$occupation', religion='$religion', house_no='$house_no', street_name='$street_name', purok='$purok', zone='$zone', barangay='$barangay', municipality='$municipality', province='$province', region='$region', image='$file' WHERE user_Id='$user_Id' ");
              	     displayUpdateMessage($update, $page);
					} else {
	    	            displayErrorMessage("There was an error uploading your profile picture.", $page);
					}
				}
			}
		}
	}





	// CHANGE ADMIN PASSWORD - ADMIN/ADMIN_DELETE.PHP
	function changePassword($conn, $user_Id, $OldPassword, $password, $cpassword, $page) {

	    $check_old_password = mysqli_query($conn, "SELECT * FROM users WHERE password='$OldPassword' AND user_Id='$user_Id'");

	    if (mysqli_num_rows($check_old_password) === 1) {
	        if ($password != $cpassword) {
	            displayErrorMessage("Password did not match.", $page);
	        } else {
	            $update = mysqli_query($conn, "UPDATE users SET password='$password' WHERE user_Id='$user_Id'");
	            displayUpdateMessage($update, $page);
	        }
	    } else {
	    	displayErrorMessage("Old password is incorrect.", $page);
	    }
	}




	// UPDATE ADMIN PROFILE - ADMIN/PROFILE.PHP || || USER/PROFILE.PHP
	function updateProfileAdmin($conn, $user_Id, $page) {
	    $file = basename($_FILES["fileToUpload"]["name"]);
	    $target_dir = "../images-users/";
	    $target_file = $target_dir . $file;
	    $uploadOk = 1;
	    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

	    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
	    if ($check === false) {
	        displayErrorMessage("Selected file is not an image.", $page);
	    }

	    if ($_FILES["fileToUpload"]["size"] > 500000) {
	        displayErrorMessage("File must be up to 500KB in size.", $page);
	    }

	    if (!in_array($imageFileType, ["jpg", "png", "jpeg", "gif"])) {
	        displayErrorMessage("Only JPG, JPEG, PNG & GIF files are allowed.", $page);
	    }

	    if ($_FILES["fileToUpload"]["error"] != 0) {
	        displayErrorMessage("Your file was not uploaded.", $page);
	    }

	    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
	        $update = mysqli_query($conn, "UPDATE users SET image='$file' WHERE user_Id='$user_Id'");
	        displayUpdateMessage($update, $page);
	    } else {
	        displayErrorMessage("There was an error uploading your file.", $page);
	    }
	}




	// UPDATE ADMIN INFO - ADMIN/PROFILE.PHP || USER/PROFILE.PHP
	function updateProfileInfo($conn, $user_Id, $page) {
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
		

	    $check_email = mysqli_query($conn, "SELECT * FROM users WHERE email='$email' AND user_Id !='$user_Id' ");
		if(mysqli_num_rows($check_email) > 0 ) {
		   $_SESSION['message'] = "";
	       displayErrorMessage("Email already exists!", $page);
		} else {
		  $update = mysqli_query($conn, "UPDATE users SET firstname='$firstname', middlename='$middlename', lastname='$lastname', suffix='$suffix', dob='$dob', age='$age', email='$email', contact='$contact', birthplace='$birthplace', gender='$gender', civilstatus='$civilstatus', occupation='$occupation', religion='$religion', house_no='$house_no', street_name='$street_name', purok='$purok', zone='$zone', barangay='$barangay', municipality='$municipality', province='$province', region='$region' WHERE user_Id='$user_Id' ");

      	  displayUpdateMessage($update, $page);
		}
	}




	// UPDATE SUPPLIERS - SUPPLIERS.PHP
	function update_supplier($conn, $supplier_ID , $page) {
		$supplier_ID   = $_POST['supplier_ID'];
		$f_name  = ucwords(mysqli_real_escape_string($conn, $_POST['f_name']));
		$m_name  = ucwords(mysqli_real_escape_string($conn, $_POST['m_name']));
		$l_name  = ucwords(mysqli_real_escape_string($conn, $_POST['l_name']));
		$address = ucwords(mysqli_real_escape_string($conn, $_POST['address']));
		$contact = mysqli_real_escape_string($conn, $_POST['contact']);
		$update = mysqli_query($conn, "UPDATE suppliers SET f_name='$f_name', m_name='$m_name', l_name='$l_name', address='$address', contact='$contact' WHERE supplier_ID='$supplier_ID'");
    	displayUpdateMessage($update, $page);
	}



	// UPDATE PRODUCT - PRODUCT.PHP
	function update_product($conn, $prod_ID, $page) {
		$prod_ID   = $_POST['prod_ID'];
		$prod_name  = ucwords(mysqli_real_escape_string($conn, $_POST['prod_name']));
		$prod_size  = ucwords(mysqli_real_escape_string($conn, $_POST['prod_size']));
		$prod_color = ucwords(mysqli_real_escape_string($conn, $_POST['prod_color']));
		$prod_qty   = mysqli_real_escape_string($conn, $_POST['prod_qty']);
		$prod_qty_orig = mysqli_real_escape_string($conn, $_POST['prod_qty_orig']);
		$prod_price = mysqli_real_escape_string($conn, $_POST['prod_price']);
		$prod_desc  = mysqli_real_escape_string($conn, $_POST['prod_desc']);
		$supplier_ID = mysqli_real_escape_string($conn, $_POST['supplier_ID']);
		if($prod_qty <= $prod_qty_orig) {
			$update = mysqli_query($conn, "UPDATE products SET prod_name='$prod_name', prod_size='$prod_size', prod_color='$prod_color', prod_qty='$prod_qty', prod_qty_orig='$prod_qty_orig', prod_price='$prod_price', prod_desc='$prod_desc', supplier_ID='$supplier_ID' WHERE prod_ID='$prod_ID'");
    		displayUpdateMessage($update, $page);
		} else {
			displayErrorMessage("Stock must be lower than original stock", $page);
		}
	}


	// UPDATE REQUISITION - REQUISITION.PHP
	function update_request($conn, $req_ID, $page) {
		$req_ID   = $_POST['req_ID'];
		$emp_ID   = $_POST['emp_ID'];
		$prod_ID  = $_POST['prod_ID'];
		$req_qty  = $_POST['req_qty'];
		$requirements = ucwords(mysqli_real_escape_string($conn, $_POST['requirements']));
		$reason   = mysqli_real_escape_string($conn, $_POST['reason']);
		$notes = mysqli_real_escape_string($conn, $_POST['notes']);

		$check = mysqli_query($conn, "SELECT * FROM products WHERE prod_ID='$prod_ID'");
		$row = mysqli_fetch_array($check);
		$stock = $row['prod_qty'];
		if($req_qty <= $stock) {
			$update = mysqli_query($conn, "UPDATE requisition SET emp_ID='$emp_ID', prod_ID='$prod_ID', req_qty='$req_qty', requirements='$requirements', reason='$reason', notes='$notes' WHERE req_ID='$req_ID'");
    		displayUpdateMessage($update, $page);
		} else {
			displayErrorMessage("Request quantity should be lesser than or equal to number of stocks of the product.", $page);
		}
		
	}




	// UPDATE REQUISITION - REQUISITION.PHP
	function delete_request($conn, $req_ID, $page) {
		$req_ID   = $_POST['req_ID'];
		$update = mysqli_query($conn, "UPDATE requisition SET is_deleted=1 WHERE req_ID='$req_ID'");
		displayUpdateMessage($update, $page);
		
	}


	




	// UPDATE REQUISITION - REQUISITION.PHP
	function update_status($conn, $req_ID, $page) {
		$status = $_POST['status'];
		$delivery_date = $_POST['delivery_date'];
		$text = '';
		if($status == 1) {
			$text = 'Approved';
		} else {
			$text = 'Rejected';
		}

		$check = mysqli_query($conn, "SELECT * FROM requisition r JOIN products p ON r.prod_ID=p.prod_ID JOIN users s ON r.emp_ID=s.user_Id JOIN suppliers sup ON p.supplier_ID=sup.supplier_ID WHERE r.req_ID='$req_ID'");
		$row = mysqli_fetch_array($check);
		$email = $row['email'];
		$name = $row['firstname'].' '.$row['middlename'].' '.$row['lastname'].' '.$row['suffix'];
		$gender = '';
		if($row['gender'] == 'Male') {
			$gender = 'Mr.';
		} else {
			$gender = 'Maam';
		}

		if($status == 1) {
			$req_qty = $row['req_qty'];
			$prod_ID = $row['prod_ID'];
			$sql = mysqli_query($conn, "UPDATE products SET prod_qty=prod_qty-$req_qty WHERE prod_ID='$prod_ID'");
			if($sql) {
				$update = mysqli_query($conn, "UPDATE requisition SET status='$status', delivery_date='$delivery_date' WHERE req_ID='$req_ID'");
				if($update) {
					$subject = ''.$text.' Requisition';

			        $message = '
			            <!DOCTYPE html>
			            <html lang="en">
			            <head>
			                <meta charset="UTF-8">
			                <meta name="viewport" content="width=device-width, initial-scale=1.0">
			            </head>
			            <body style="font-family: \'Segoe UI\', Tahoma, Geneva, Verdana, sans-serif; line-height: 1.6; margin: 0; padding: 2px; background-color: #f4f4f4;">

			                <div style="max-width: 600px; margin: 20px auto; padding: 20px; border: 1px solid #ddd; border-radius: 10px; background-color: #fff; box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);">

			                    <!-- Header with logo and system name -->
			                    <div style="display: flex; flex-direction: column; align-items: center; margin-bottom: 20px;">
			                    	<!-- <img src="images-users/academia.png" alt="Logo" style="max-width: 100px; height: auto; border-radius: 50%; margin-bottom: 10px;"> -->
			                        <div style="font-size: 20px; font-weight: bold; color: #007BFF;">Cebu & Co.</div>
			                    </div>

			                    <!-- Heading and message section -->
			                    <h2 style="color: #333;">'.$text.' Requisition</h2>
			                    <p style="color: #666; margin-bottom: 15px;">Dear '.$gender.' '.$name.',</p>
								<p style="color: #666; margin-bottom: 15px;">Good day! This email is to inform you that your product requisition has been '.$text.' by the administrator. Thank you!</p>
			                    <!-- Add more paragraphs or customize as needed -->

			                    <!-- Closing note -->
			                    <p style="color: #666;"><strong>NOTE:</strong> This is a system-generated email. Please do not reply.</p>
			                </div>

			            </body>
			            </html>
			        ';
			        sendEmail($subject, $message, $email, $page);  

				} else {
					displayErrorMessage("Error updation of requisition record.", $page);
				}
			} else {
				displayErrorMessage("Error updation of product record.", $page);
			}
		} else {
			$update = mysqli_query($conn, "UPDATE requisition SET status='$status' WHERE req_ID='$req_ID'");
			if($update) {
				$subject = ''.$text.' Requisition';

		        $message = '
		            <!DOCTYPE html>
		            <html lang="en">
		            <head>
		                <meta charset="UTF-8">
		                <meta name="viewport" content="width=device-width, initial-scale=1.0">
		            </head>
		            <body style="font-family: \'Segoe UI\', Tahoma, Geneva, Verdana, sans-serif; line-height: 1.6; margin: 0; padding: 2px; background-color: #f4f4f4;">

		                <div style="max-width: 600px; margin: 20px auto; padding: 20px; border: 1px solid #ddd; border-radius: 10px; background-color: #fff; box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);">

		                    <!-- Header with logo and system name -->
		                    <div style="display: flex; flex-direction: column; align-items: center; margin-bottom: 20px;">
		                    	<!-- <img src="images-users/academia.png" alt="Logo" style="max-width: 100px; height: auto; border-radius: 50%; margin-bottom: 10px;"> -->
		                        <div style="font-size: 20px; font-weight: bold; color: #007BFF;">Cebu & Co.</div>
		                    </div>

		                    <!-- Heading and message section -->
		                    <h2 style="color: #333;">'.$text.' Requisition</h2>
		                    <p style="color: #666; margin-bottom: 15px;">Dear '.$gender.' '.$name.',</p>
							<p style="color: #666; margin-bottom: 15px;">Good day! This email is to inform you that your product requisition has been '.$text.' by the administrator. Thank you!</p>
		                    <!-- Add more paragraphs or customize as needed -->

		                    <!-- Closing note -->
		                    <p style="color: #666;"><strong>NOTE:</strong> This is a system-generated email. Please do not reply.</p>
		                </div>

		            </body>
		            </html>
		        ';
		        sendEmail($subject, $message, $email, $page);  

			} else {
				displayErrorMessage("Error updation of requisition record.", $page);
			}
		}
		displayUpdateMessage($update, $page);
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



