<?php 
	require_once '../../../config/conn.php';
	require_once '../../../helper/alert.php';
	require_once '../../../helper/helper.php';
	require_once '../../../helper/operator.php';

	if (isset($_POST['btn_submit'])) {
		$NoTagihan = "INV".randString(9);
		$KodePelanggan = $conn->real_escape_string($_POST['KodePelanggan']);
		$TahunTagih = $conn->real_escape_string($_POST['TahunTagih']);
		$BulanTagih = $conn->real_escape_string($_POST['BulanTagih']);
		$KodePelanggan = $conn->real_escape_string($_POST['KodePelanggan']);
		$TotalPemakaian = $conn->real_escape_string($_POST['TotalPemakaian']);
		$TglPencatatan = date('Y-m-d');

		$queryTarif = "SELECT * FROM tbpelanggan AS a JOIN tbtarif AS b ON a.KodeTarif = b.KodeTarif WHERE a.KodePelanggan = $KodePelanggan";
		$queryTarif = $conn->query($queryTarif);
		
		if ($queryTarif->num_rows == 1) {
			$dataTarif = $queryTarif->fetch_assoc();
			$TarifPerKwh = $dataTarif['TarifPerKwh'];
			$Beban = $dataTarif['Beban'];

			$TotalBayar = ($TotalPemakaian * $TarifPerKwh) + $Beban;
			$status = 'Belum';
			@$Keterangan = $conn->real_escape_string($_POST['Keterangan']);

			$queryCheck = "SELECT * FROM tbtagihan WHERE KodePelanggan = '$KodePelanggan' AND TahunTagih = $TahunTagih AND BulanTagih = $BulanTagih";
			$queryCheck = $conn->query($queryCheck);

			if ($queryCheck->num_rows == 0) {
				$queryCheck1 = "SELECT * FROM tbtagihan WHERE KodePelanggan = '$KodePelanggan' AND TahunTagih = $TahunTagih AND BulanTagih = $BulanTagih - 1";
				$queryCheck1 = $conn->query($queryCheck1);
				if ($queryCheck1->num_rows == 0) {
					$queryInsert = "INSERT INTO tbtagihan VALUES(NULL, '$NoTagihan', '$KodePelanggan', '$TahunTagih', '$BulanTagih', '$TotalPemakaian', '$TglPencatatan', '$TotalBayar', '$status', '$Keterangan') ";
					$queryInsert = $conn->query($queryInsert);
					if ($queryInsert) {
						alert('Data Berhasil Ditambahkan', '../index.php', 'success');
					}
					else{
						alert('Error Add Tagihan', '../add.php', 'error');
					}
				}
				else{
					$dataTagihan = $queryCheck1->fetch_assoc();
					$statusSebelum = $dataTagihan['Status'];

					if ($statusSebelum == 'Lunas') {
						$queryInsert = "INSERT INTO tbtagihan VALUES(NULL, '$NoTagihan', '$KodePelanggan', '$TahunTagih', '$BulanTagih', '$TotalPemakaian', '$TglPencatatan', '$TotalBayar', '$status', '$Keterangan') ";
						$queryInsert = $conn->query($queryInsert);
						if ($queryInsert) {
							alert('Data Berhasil Ditambahkan', '../index.php', 'success');
						}
						else{
							alert('Error Add Tagihan', '../add.php', 'error');
						}
					}
					else{
						alert('Anda belum Membayar Tagihan Bulan Lalu', '../add.php', 'error');
					}
				}
			}
			else{
				alert('Data Tagihan Sudah Ada', '../add.php', 'error');
			}
		}
		else{
			alert('Data Pelanggan Tidak Ada', '../add.php', 'error');
		}
	}
	else{
		header('location: ../index.php');
	}
 ?>