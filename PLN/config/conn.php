<?php 
	session_start();
	$host		= 'localhost';
	$user		= 'root';
	$pass		= '';
	$db			= 'db_listrik';

	$conn = @new Mysqli($host, $user, $pass, $db);

	if ($conn->connect_error) {
		?>
		<script type="text/javascript">
			alert("Something Error: <?= $conn->connect_error ?>");
		</script>
		<?php
		die();
	}

 ?>