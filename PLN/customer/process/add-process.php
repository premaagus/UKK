<?php 
	require_once '../../config/conn.php';
	require_once '../../helper/alert.php';
	require_once '../../helper/helper.php';

	if (isset($_POST['btn_submit'])) {
		$KodeTagihan = $conn->real_escape_string($_POST['KodeTagihan']);
		$dataTagihan = $conn->query("SELECT * FROM tbtagihan WHERE KodeTagihan = $KodeTagihan");
		$dataTagihan = $dataTagihan->fetch_assoc();
		$TglBayar = date('Y-m-d');
		$JumlahTagihan = $dataTagihan['TotalBayar'];
		$ImgEx = $_FILES['Invoice']['type'];
		$ImgSize = $_FILES['Invoice']['size'];
		$ImgTmp = $_FILES['Invoice']['tmp_name'];
		$invoice = $_FILES['Invoice'];
		@$Status = $conn->real_escape_string($_POST['Status']);

		if (empty($Status)) {
			$Status = 'Belum Dikonfirmasi';
		}

		//validasi Image
		

		$queryCheck = "SELECT * FROM tbpembayaran WHERE KodeTagihan = $KodeTagihan";
		$queryCheck = $conn->query($queryCheck);
		if ($queryCheck->num_rows == 0) {
			if (!empty($_FILES['Invoice']['name'])) {
				$maxSize = 2048 * 1024;
				$allowedType = ['image/jpeg', 'image/jpg', 'image/png'];
				if (in_array($ImgEx, $allowedType)) {
					if ($ImgSize <= $maxSize) {
						$namaFile = randString(6) . '-' . $_FILES['Invoice']['name'];
						if (move_uploaded_file($invoice['tmp_name'], "../../uploads/invoice/" . $namaFile)) {
							$queryInsert = "INSERT INTO tbpembayaran VALUES(NULL, '$KodeTagihan', '$TglBayar', '$JumlahTagihan', '$namaFile', '$Status')";
							$queryInsert = $conn->query($queryInsert);
							if ($queryInsert) {
								$queryUpdate = "UPDATE tbtagihan SET Status = '$Status' WHERE KodeTagihan = $KodeTagihan";
								$queryUpdate = $conn->query($queryUpdate);
								if ($queryUpdate) {
									alert('Data Berhasil Ditambahkan', '../index.php', 'success');
								}
								else{
									alert('Data Gagal Diupdate', '../add.php', 'error');
								}
							}
							else{
								alert('Data Gagal Ditambahkan', '../add.php', 'error');
							}
						}
						else{
							alert('Gagal Upload File', '../add.php', 'error');
						}
					}
					else{
						alert('File Terlalu Besar. Max 2Mb', '../add.php', 'error');
					}
				}
				else{
					alert('Ekstensi Tidak Diperkenankan', '../add.php', 'error');
				}
			}
			else{
				$queryInsert = "INSERT INTO tbpembayaran VALUES(NULL, '$KodeTagihan', '$TglBayar', '$JumlahTagihan', '', '$Status')";
				$queryInsert = $conn->query($queryInsert);
				if ($queryInsert) {
					$queryUpdate = "UPDATE tbtagihan SET Status = '$Status'";
					$queryUpdate = $conn->query($queryUpdate);
					if ($queryUpdate) {
						alert('Data Berhasil Ditambahkan', '../index.php', 'success');
					}
					else{
						alert('Data Gagal Diupdate', '../add.php', 'error');
					}
				}
				else{
					alert('Data Gagal Ditambahkan', '../add.php', 'error');
				}
			}
		}
		else{
			alert('Data Sudah Ada', '../add.php', 'error');
		}

		// $queryInsert = "INSERT INTO tbtarif VALUES(NULL, '$Daya', '$TarifPerKwh', '$Beban')";
		// $queryInsert = $conn->query($queryInsert);
		// if ($queryInsert) {
		// 	alert('Data Berhasil Ditambahkan', '../index.php', 'success');
		// }
		// else{
		// 	alert('Data Gagal Ditambahkan', '../add.php', 'error');
		// }
	}
	else{
		header('location: ../index.php');
	}
 ?>