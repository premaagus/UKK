<?php
	require_once './helper/alert.php'; 
	session_start();
	session_destroy();
	alert('Sampai Jumpa', './index.php', 'success');
 ?>