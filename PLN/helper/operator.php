<?php 
	$BASE_URL = 'http://localhost/pln';
	@session_start();
	if (@$_SESSION['Level'] != 'Admin' AND @$_SESSION['Level'] != 'Operator' ) {
		alert('Anda Tidak Memiliki Akses', $BASE_URL."/index.php", 'error');
		die();
	}
 ?>