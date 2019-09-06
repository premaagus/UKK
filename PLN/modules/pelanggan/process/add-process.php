<?php 
	require_once '../../../config/conn.php';
	require_once '../../../helper/alert.php';
	require_once '../../../helper/helper.php';
	require_once '../../../helper/admin.php';
	if (isset($_POST['btn_submit'])) {
		$NoPelanggan = randNumber(6);
		$password = randString(6);
		$NoMeter = $conn->real_escape_string($_POST['NoMeter']);
		$KodeTarif = $conn->real_escape_string($_POST['KodeTarif']);
		$NamaLengkap = $conn->real_escape_string($_POST['NamaLengkap']);
		$Telp = $conn->real_escape_string($_POST['Telp']);
		$Alamat = $conn->real_escape_string($_POST['Alamat']);

		$queryCheck = "SELECT * FROM tbpelanggan WHERE NoMeter = '$NoMeter'";
		$queryCheck = $conn->query($queryCheck);

		if ($queryCheck->num_rows == 0) {
			$queryInsert = "INSERT INTO tbpelanggan VALUES(NULL, '$NoPelanggan', '$NoMeter', '$KodeTarif', '$NamaLengkap', '$Telp', '$Alamat')";
			$queryInsert = $conn->query($queryInsert);
			if ($queryInsert) {
				$passwordHash = password_hash($password, PASSWORD_BCRYPT, ['cost' => 12]);
				$queryInsert1 = "INSERT INTO tblogin VALUES(NULL, '$NoPelanggan', '$passwordHash', '$NamaLengkap', 'Customer')";
				$queryInsert1 = $conn->query($queryInsert1);
				if ($queryInsert1) {
					$_SESSION['print']['username'] = $NoPelanggan;
					$_SESSION['print']['password'] = $password;
					$_SESSION['print']['noMeter'] = $NoMeter;
					$_SESSION['print']['namaLengkap'] = $NamaLengkap;
					$_SESSION['print']['KodeTarif'] = $KodeTarif;
					$_SESSION['print']['telp'] = $Telp;
					$_SESSION['print']['alamat'] = $Alamat;
					alert('Data Berhasil Ditambahkan', '../print.php', 'success');
				}
				else{
					alert('Data User Gagal Ditambahkan', '../add.php', 'error');
				}
				
			}
			else{
				alert('Data Pelanggan Gagal Ditambahkan', '../add.php', 'error');
			}
		}
		else{
			alert('No Meter Telah Digunakan', '../add.php', 'error');
		}
	}
	else{
		header('location: ../index.php');
	}
 ?>