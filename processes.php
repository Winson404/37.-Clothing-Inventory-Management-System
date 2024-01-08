<?php 

	include 'config.php';
	include 'includes/function_create.php';

	// use PHPMailer\PHPMailer\PHPMailer;
    // use PHPMailer\PHPMailer\Exception;
    // require 'vendor/PHPMailer/src/Exception.php';
    // require 'vendor/PHPMailer/src/PHPMailer.php';
    // require 'vendor/PHPMailer/src/SMTP.php';


	// USERS LOGIN - LOGIN.PHP
	if(isset($_POST['login'])) {
		$email    = $_POST['email'];
		$password = md5($_POST['password']);

		// Check if the user has attempted to log in before
		if (!isset($_SESSION['login_attempts'])) {
		    $_SESSION['login_attempts'] = 0;
		}

		// Check if the user has reached the maximum number of login attempts
		if ($_SESSION['login_attempts'] > 3) {
		    // Check if the user has been blocked for 30 minutes
		    if (time() - $_SESSION['last_login_attempt'] <= 600) {
		        // User is still blocked, display an error message and exit
				displayErrorMessage("You have been blocked for 10 minutes due to multiple failed login attempts.", "login.php");
		    } else {
		        // Block has expired, reset the login attempts counter
		        $_SESSION['login_attempts'] = 0;
		    }
		}


		$check = mysqli_query($conn, "SELECT * FROM users WHERE email='$email' AND password='$password' AND user_type != 'User'");
		if(mysqli_num_rows($check)===1) {
			$row = mysqli_fetch_array($check);
			$position = $row['user_type'];

			$log_ID = $row['user_Id'];
			$login_time = date("Y-m-d h:i A");
			$login = mysqli_query($conn, "INSERT INTO log_history (user_Id, login_time) VALUES ('$log_ID', '$login_time')");

			if($position == 'Admin') {
				$_SESSION['login_attempts'] = 0;
	    		$_SESSION['last_login_attempt'] = time();
				$_SESSION['admin_Id'] = $row['user_Id'];
				$_SESSION['login_time'] = $login_time;
				header("Location: Admin/dashboard.php");
				exit();
			} else {
				$_SESSION['login_attempts'] = 0;
	    		$_SESSION['last_login_attempt'] = time();
				$_SESSION['user_Id'] = $row['user_Id'];
				$_SESSION['login_time'] = $login_time;
				header("Location: Employee/dashboard.php");
				exit();
			}
		} else {
		    $_SESSION['login_attempts']++;
		    $_SESSION['last_login_attempt'] = time();
			displayErrorMessage("Incorrect password.", "login.php");
		}
	}





	// REGISTER USER - REGISTER.PHP 
	if (isset($_POST['create_user'])) {
		saveUser($conn, "register.php");
	}





	// SEARCH EMAIL - FORGOT-PASSWORD.PHP
	if(isset($_POST['search'])) {
      $email = mysqli_real_escape_string($conn, $_POST['email']);
      $fetch = mysqli_query($conn, "SELECT * FROM users WHERE email='$email'");
      if(mysqli_num_rows($fetch) > 0) {
      	$row = mysqli_fetch_array($fetch);
      	$user_Id = $row['user_Id'];
      	header("Location: sendcode.php?user_Id=".$user_Id);
      	exit();
      } else {
		displayErrorMessage("Email not found.", "forgot-password.php");
      }
	}





	// SEND CODE - SENDCODE.PHP
	if(isset($_POST['sendcode'])) {
	    $email    = $_POST['email'];
	    $user_Id  = $_POST['user_Id'];
	    $key      = substr(number_format(time() * rand(), 0, '', ''), 0, 6);

	    $fetch_gender = mysqli_query($conn, "SELECT * FROM users WHERE user_Id='$user_Id'");
		$row = mysqli_fetch_assoc($fetch_gender);
		$name = $row['firstname'].' '.$row['lastname'];
		$gender = '';

		if ($row && isset($row['gender'])) {
		    $userGender = $row['gender'];

		    if ($userGender == 'Male') {
		        $gender = 'Mr.';
		    } elseif ($userGender == 'Female') {
		        $gender = 'Ms./Mrs.';
		    }
		}

	    $insert_code = mysqli_query($conn, "UPDATE users SET verification_code='$key' WHERE email='$email' AND user_Id='$user_Id'");
	    if($insert_code) {
	        $subject = 'Verification Code';

	        // Your HTML email template
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
	                    <h2 style="color: #333;">Verification Code</h2>
	                    <p style="color: #666; margin-bottom: 15px;">Dear '.$gender.' '.$name.',</p>
						<p style="color: #666; margin-bottom: 15px;">Your verification code is: <b>'.$key.'</b>. Please keep this code confidential and do not share it with others. Thank you!</p>
						<p style="color: #666; margin-bottom: 15px;">To change your password, simply click <a href="http://localhost/37.%20Clothing%20Inventory%20Management%20System/changepassword.php?user_Id='.$user_Id.'">here</a>.</p>

	                    <!-- Add more paragraphs or customize as needed -->

	                    <!-- Closing note -->
	                    <p style="color: #666;"><strong>NOTE:</strong> This is a system-generated email. Please do not reply.</p>
	                </div>

	            </body>
	            </html>
	        ';
	        sendEmail($subject, $message, $email, "verifycode.php?user_Id=".$user_Id."&&email=".$email);    
	    } else {
	        displayErrorMessage("Something went wrong while generating the verification code through email.", "sendcode.php?user_Id=".$user_Id);
	    } 
	}



	// VERIFY CODE - VERIFYCODE.PHP
	if(isset($_POST['verify_code'])) {
	    $user_Id = $_POST['user_Id'];
	    $email   = $_POST['email'];
	    $code    = mysqli_real_escape_string($conn, $_POST['code']);
	    $fetch = mysqli_query($conn, "SELECT * FROM users WHERE email='$email' AND verification_code='$code' AND user_Id='$user_Id'");
	    if(mysqli_num_rows($fetch) > 0) {
			header("Location: changepassword.php?user_Id=".$user_Id);
			exit();
		} else {
			displayErrorMessage("Verification code is incorrect.", "verifycode.php?user_Id=".$user_Id."&&email=".$email);
		}
	}



	// CHANGE PASSWORD - CHANGEPASSWORD.PHP
	if(isset($_POST['changepassword'])) {
		$user_Id   = $_POST['user_Id'];
		$cpassword = md5($_POST['cpassword']);

		$update = mysqli_query($conn, "UPDATE users SET password='$cpassword', verification_code=0 WHERE user_Id='$user_Id' ");
		displayUpdateMessage($update, "login.php");
	}


?>
