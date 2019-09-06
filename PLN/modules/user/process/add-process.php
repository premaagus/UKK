<?php 
	require_once '../../../config/conn.php';
	require_once '../../../helper/alert.php';
	require_once '../../../helper/admin.php';
	if (isset($_POST['btn_submit'])) {
		$username = $conn->real_escape_string($_POST['Username']);
		$password = $conn->real_escape_string($_POST['Password']);
		$namaLengkap = $conn->real_escape_string($_POST['NamaLengkap']);
		$level = $conn->real_escape_string($_POST['Level']);

		$queryCheck = "SELECT * FROM tblogin WHERE Username = '$username'";
		$queryCheck = $conn->query($queryCheck);

		if ($queryCheck->num_rows == 0) {
			$passwordHash = password_hash($password, PASSWORD_BCRYPT, ['cost' => 12]);

			$queryInsert = "INSERT INTO tblogin VALUES(NULL, '$username', '$passwordHash', '$namaLengkap', '$level')";
			$queryInsert = $conn->query($queryInsert);
			if ($queryInsert) {
				alert('Data Berhasil Ditambahkan', '../index.php', 'success');
			}
			else{
				alert('Data Gagal Ditambahkan', '../add.php', 'error');
			}
		}
		else{
			alert('Username Telah Digunakan', '../add.php', 'error');
		}
	}
	else{
		header('location: ../index.php');
	}
 ?>