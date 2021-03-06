<?php
	require_once('connect.php');
	require_once('security_check.php');
	
	//admin login
	if (isset($_POST['login'])) {
		$username = test_input($_POST['username']);
		$password = test_input($_POST['password']);

		if (empty($username) || empty($password)) {
			$msg = 'Required Fields';
			header('Location:index.php?msg='.$msg.'');
		}
		else {
			$encpassword = md5($password);
			$sql = "SELECT * FROM `user` WHERE `username` = '$username' AND `password` = '$encpassword' AND `usertype` = 'admin'";
			$result = mysqli_query($dbconn, $sql);
			$count = mysqli_num_rows($result);

			//if username exists and matches password
			if ($count == 1) {
				$row = mysqli_fetch_array($result);
				$userid = $row['userid'];
				$firstname = $row['firstname'];
				$lastname = $row['lastname'];
				$admin_announcement = $row['admin_announcement'];
				$admin_incidentreport = $row['admin_incidentreport'];
				$admin_billinfo = $row['admin_billinfo'];

				session_start();
				$_SESSION['user_id'] = $userid;
				$_SESSION['firstname'] = $firstname;
				$_SESSION['lastname'] = $lastname;
				$_SESSION['is_admin_ann'] = $admin_announcement;
				$_SESSION['is_admin_inc'] = $admin_incidentreport;
				$_SESSION['is_admin_bill'] = $admin_billinfo;
				header('Location:home.php');
			}
			else {
				$sql = "SELECT * FROM `user` WHERE `username` = '$username'";
				$result = mysqli_query($dbconn, $sql);
				$count = mysqli_num_rows($result);

				if ($count == 1) {
					$msg = 'Wrong password';
				}
				else {
					$msg = "Username does not exist";
				}
				mysqli_close($dbconn);
				header('Location:index.php?msg='.$msg.'');
			}
		}
	}
	else {
		echo "<center><h1>Illegal access detected!<h1></center>";
	}
?>