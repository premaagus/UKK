<?php 
	$BASE_URL = 'http://localhost/pln';
	@session_start();
	if (isset($_SESSION['Level'])) {
		if ($_SESSION['Level'] == 'Admin' OR $_SESSION['Level'] == 'Operator') {
			header('location: ' . $BASE_URL . '/dashboard/index.php');
		}
		else{
			header('location: ' . $BASE_URL . '/customer/index.php');
		}
	}
 ?>