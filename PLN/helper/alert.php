<?php 
	function alert($message, $location, $status){
		$base_url = 'http://localhost/pln';
		if ($status == 'success') {
			?>
			<link rel="stylesheet" type="text/css" href="<?= $base_url ?>/css/alert.css">
			<div class="wrapper-shadow">
				<div class="alert">
					<div class="logo-success">
						<img src="<?= $base_url ?>/images/success.png">
					</div>
					<h1>Success</h1>
					<p><?= $message ?></p>

					<div class="btn-oke-s">
						<a href="<?= $location ?>">Oke</a>
					</div>
				</div>
			</div>
			<?php
		}
		else{
			?>
			<link rel="stylesheet" type="text/css" href="<?= $base_url ?>/css/alert.css">
			<div class="wrapper-shadow">
				<div class="alert">
					<div class="logo-success">
						<img src="<?= $base_url ?>/images/error.png">
					</div>
					<h1>Error</h1>
					<p><?= $message ?></p>

					<div class="btn-oke-e">
						<a href="<?= $location ?>" focus>Oke</a>
					</div>
				</div>
			</div>
			<?php
		}
	}
 ?>