<?php 
	require_once './config/conn.php';
	require_once './helper/alert.php';
	if (isset($_POST['btn_submit'])) {
		$username = $conn->real_escape_string($_POST['Username']);
		$password = $conn->real_escape_string($_POST['Password']);

		$queryCheck = "SELECT * FROM tblogin WHERE Username = '$username'";
		$queryCheck = $conn->query($queryCheck);

		if ($queryCheck->num_rows == 1) {
			$data = $queryCheck->fetch_assoc();
			$dbPass = $data['Password'];
			if (password_verify($password, $dbPass)) {
				$_SESSION['Username'] = $username;
				$_SESSION['NamaLengkap'] = $data['NamaLengkap'];
				$_SESSION['Level'] = $data['Level'];

				if ($data['Level'] == 'Customer') {
					alert('Berhasil Login. Selamat datang ' .$data['NamaLengkap'], './customer/index.php', 'success');
					die();
				}

				alert('Berhasil Login. Selamat datang ' .$data['NamaLengkap'], './dashboard/index.php', 'success');
			}
			else{
				alert('Username Atau Password Salah', './index.php', 'error');
			}
		}
		else{
			alert('Username Tidak Ada', './index.php', 'error');
		}
	}
	else{
		header('location: ./index.php');
	}
 ?>