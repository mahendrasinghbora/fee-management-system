<?php session_start();
define('my_site_path', 'http://localhost/fms');
if (isset($_SESSION['userid'])) {
	$con = new mysqli('localhost', 'root', '', 'fms');
	ob_start();
	$userid = $_POST['userid'];
	$resultPassword = $con->query("SELECT * FROM users WHERE USER_ID = '$userid';");
	$rowPassword = $resultPassword->fetch_assoc();
	$correctPassword = $rowPassword['PASSWORD'];
	$password = $_POST['password'];
	$firstName = $_POST['firstName'];
	$lastName = $_POST['lastName'];
	if ($password == $correctPassword) {
		if (isset($_POST['submitImage'])) {
			if($_FILES['userThumbnail']['size'] > 0) {
				$file = $_FILES['userThumbnail'];
				$fileName = $file['name'];
				$fileTempName = $_FILES['userThumbnail']['tmp_name'];
				$fileSize = $_FILES['userThumbnail']['size'];
				$fileError = $_FILES['userThumbnail']['error'];
				$fileExt = explode('.', $fileName);
				$fileExt = strtolower(end($fileExt));
				$allowed = array('jpg', 'jpeg', 'png', 'gif', 'bmp');

				if (in_array($fileExt, $allowed)) {
					if ($fileError === 0) {
						if ($fileSize < 2000000) {
							$newFileName = $userid . uniqid('',true) . "." . $fileExt;
							$destination = '../img/users/' . $newFileName;
							$imagePath = my_site_path . "/img/users/" . $newFileName;
							move_uploaded_file($fileTempName, $destination);
							$result_y = $con->query("SELECT * FROM users WHERE USER_ID = '$userid';");
							$row = $result_y->fetch_assoc();
							echo $picDel = '../' . substr($row['THUMBNAIL'], 21);

							$result_x = $con->query("UPDATE users SET THUMBNAIL = '$imagePath' WHERE USER_ID = '$userid';");
							if ($result_x) {
								unset($_SESSION["thumbnail"]); 
								$_SESSION["thumbnail"] = $imagePath;
								unlink($picDel);
								if ($_SESSION['userstatus'] == 'ADMIN') {
						        	$page = my_site_path . '/admin/index.php';
						        }
						        elseif ($_SESSION['userstatus'] == 'MANAGEMENT') {
						            $page = my_site_path . '/management/index.php';
						        }
						        elseif ($_SESSION['userstatus'] == 'ACCOUNTS') {
						            $page = my_site_path . '/accounts/index.php';
						        }
						        $_SESSION['passwordMessage'] = "User's profile successfully edited!";
						        header("Location: $page");
							} else {
								$_SESSION['error'] = "Profile picture couldn't be uploaded.";
							}
							
						} else {
							$_SESSION['error'] = "File too big.";
						}
					} else {
						$_SESSION['error'] = "Something went wrong.";
					}
				} else {
					$_SESSION['error'] = "File not allowed.";
					header('location: edit_profile.php');
				}
			}
			else {
				header('location: edit_profile.php');
			}
		}
		$resultName = $con->query("UPDATE users SET FIRST_NAME = '$firstName', LAST_NAME = '$lastName' WHERE USER_ID = '$userid';");
		unset($_SESSION["username"]);
		$_SESSION['username'] = $firstName . " " . $lastName;
		if ($_SESSION['userstatus'] == 'ADMIN') {
        	$page = my_site_path . '/admin/index.php';
        }
        elseif ($_SESSION['userstatus'] == 'MANAGEMENT') {
            $page = my_site_path . '/management/index.php';
        }
        elseif ($_SESSION['userstatus'] == 'ACCOUNTS') {
            $page = my_site_path . '/accounts/index.php';
        }
        $_SESSION['passwordMessage'] = "User's profile successfully edited!";
        header("Location: $page");
	}
	else {
		$_SESSION['error'] = "Incorrect password.";
		header('location: edit_profile.php');
	}
?>

<?php } else {
	$_SESSION['intruder'] = 'Hey, hang on there! You gotta sign in first.';
    header("Location: " . my_site_path . "/index.php");
}