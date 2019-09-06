<?php 
	require_once '../../../config/conn.php';
	require_once '../../../helper/alert.php';
	require_once '../../../helper/admin.php';
	if (isset($_POST['btn_submit'])) {
		$KodeLogin = $conn->real_escape_string($_POST['KodeLogin']);
		$password = $conn->real_escape_string($_POST['Password']);
		$namaLengkap = $conn->real_escape_string($_POST['NamaLengkap']);
		$level = $conn->real_escape_string($_POST['Level']);

		if (!empty($password)) {
			$passwordHash = password_hash($password, PASSWORD_BCRYPT, ['cost' => 12]);

			$queryUpdate = "UPDATE tblogin SET Password = '$passwordHash', NamaLengkap='$namaLengkap', Level = '$level' WHERE KodeLogin = $KodeLogin";
			$queryUpdate = $conn->query($queryUpdate);
			if ($queryUpdate) {
				alert('Data Berhasil Di Update', '../index.php', 'success');
			}
			else{
				alert('Data Gagal Di Update', '../edit.php', 'error');
			}
		}
		else{
			$queryUpdate = "UPDATE tblogin SET NamaLengkap='$namaLengkap', Level = '$level' WHERE KodeLogin = $KodeLogin";
			$queryUpdate = $conn->query($queryUpdate);
			if ($queryUpdate) {
				alert('Data Berhasil Di Update', '../index.php', 'success');
			}
			else{
				alert('Data Gagal Di Update', '../edit.php', 'error');
			}
		}
	}
	else{
		header('location: ../index.php');
	}
 ?>