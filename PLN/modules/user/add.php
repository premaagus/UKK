<?php 
	require_once '../../config/conn.php';
	require_once '../../helper/alert.php';
	require_once '../../helper/admin.php';
 ?>

 <!DOCTYPE html>
 <html>
 <head>
 	<title>Add User</title>
 	<link rel="stylesheet" type="text/css" href="../../css/dashboard.css">
 </head>
 <body>

 	<div class="wrapper">
 		<div class="left-menu">
			<div class="logo">
				<img src="../../images/logo.png">
			</div>
			<h3>Global Electric</h3>

			<div class="menu-list">
				<ul>
					<li><a href="../../dashboard/index.php">Dashboard</a></li>
					<li><a href="../tagihan/index.php">Tagihan</a></li>
					<li><a href="../pembayaran/index.php">Pembayaran</a></li>
					<?php 
						if ($_SESSION['Level'] == 'Admin') {
							?>
							<li><a class="active" href="../user/index.php">User</a></li>
							<li><a href="../tarif/index.php">Tarif</a></li>
							<li><a href="../pelanggan/index.php">Pelanggan</a></li>
							<?php
						}
					 ?>
					 <li><a href="../logout.php">Logout</a></li>
				</ul>
			</div>
		</div>

		<div class="space"></div>

		<div class="content">
			<h1>Add User</h1>
		 	<hr>

		 	<form action="./process/add-process.php" method="POST">
		 		<div class="container-form">
		 			<div class="form-control">
						<div class="label">Username</div>
						<div class="form">
							<input type="text" name="Username" required>
						</div>
					</div>
					<div class="form-control">
						<div class="label">Password</div>
						<div class="form">
							<input type="password" name="Password" required>
						</div>
					</div>
					<div class="form-control">
						<div class="label">Nama Lengkap</div>
						<div class="form">
							<input type="text" name="NamaLengkap" required>
						</div>
					</div>
					<div class="form-control">
						<div class="label">Level</div>
						<div class="form">
							<select name="Level">
			 					<option value="Admin">Admin</option>
			 					<option value="Operator">Operator</option>
			 				</select>
						</div>
					</div>
					<div class="btn btn-submit">
						<button type="submit" name="btn_submit">Tambah</button>
					</div>
		 		</div>
		 	</form>
		</div>
 	</div>
 

 </body>
 </html>