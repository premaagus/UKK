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
			  <li><a href="../../logout.php">Logout</a></li>
		</ul>
	</div>
</div>
<div class="space"></div>