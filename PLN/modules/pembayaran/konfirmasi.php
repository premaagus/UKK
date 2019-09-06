<?php 
	require_once '../../config/conn.php';
	require_once '../../helper/alert.php';
	require_once '../../helper/operator.php';


	if (!isset($_GET['id'])) {
		header('location: ./index.php');
	}

	$id = $_GET['id'];
	$queryCheck = "SELECT * FROM tbpembayaran WHERE KodeTagihan = '$id'";
	$queryCheck = $conn->query($queryCheck);

	if ($queryCheck->num_rows == 1) {
		$queryUpdate = "UPDATE tbtagihan SET Status = 'Lunas' WHERE KodeTagihan = '$id'";
		$queryUpdate = $conn->query($queryUpdate);
		if ($queryUpdate) {
			$queryUpdate1 = "UPDATE tbpembayaran SET Status = 'Lunas' WHERE KodeTagihan = '$id'";
			$queryUpdate1 = $conn->query($queryUpdate1);
			if ($queryUpdate1) {
				alert('Berhasil Dikonfirmasi', './index.php', 'success');
			}
			else{
				alert('Gagal Update Status Pembayaran', './index.php', 'error');
			}
		}
		else{
			alert('Gagal Update Status Tagihan', './index.php', 'error');
		}
	}
	else{
		alert('Data Tidak Ada', './index.php', 'error');
	}
 ?>