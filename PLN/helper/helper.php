<?php 
	function randNumber($length){
		$number = "1234567890" . time();
		$randNumber	= str_shuffle($number);
		$return = substr($randNumber, 0, $length);
		return $return;
	}

	function randString($length){
		$string = "ABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890";
		$randString = str_shuffle($string);
		$return = substr($randString, 0, $length);
		return $return;
	}

	function getBulan($bulan){
		$listBulan = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];

		return $listBulan[$bulan - 1];
	}
 ?>