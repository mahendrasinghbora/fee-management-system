<?php session_start();
define('my_site_path', 'http://localhost/fms');
if (isset($_SESSION['userid'])) {
	$con = new mysqli('localhost', 'root', '', 'fms');
	$userid = $_POST['userid'];
	$resultPassword = $con->query("SELECT * FROM users WHERE USER_ID = '$userid';");
	$rowPassword = $resultPassword->fetch_assoc();
	$correctPassword = $rowPassword['PASSWORD'];
	$password = $_POST['currentPassword'];
	$newPassword = $_POST['newPassword'];
	$repeatPassword = $_POST['repeatPassword'];
	if ($password == $correctPassword) {
		if ($newPassword == $repeatPassword) {
			$con->query("UPDATE users SET PASSWORD = '$newPassword' WHERE USER_ID = '$userid';");
			if ($_SESSION['userstatus'] == 'ADMIN') {
            	$page = my_site_path . '/admin/index.php';
	        }
	        elseif ($_SESSION['userstatus'] == 'MANAGEMENT') {
	            $page = my_site_path . '/management/index.php';
	        }
	        elseif ($_SESSION['userstatus'] == 'ACCOUNTS') {
	            $page = my_site_path . '/accounts/index.php';
	        }
	        $_SESSION['passwordMessage'] = "Password successfully changed!";
	        header("Location: $page");
		}
		else {
			$_SESSION['error'] = "The two password fields didn't match.";
			header('location: change_password.php');	
		}
	}
	else {
		$_SESSION['error'] = "Incorrect password.";
		header('location: change_password.php');
	}
?>

<?php } else {
	$_SESSION['intruder'] = 'Hey, hang on there! You gotta sign in first.';
    header("Location: " . my_site_path . "/index.php");
}