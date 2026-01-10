<?php
	function tanggal_indonesia($tgl, $tampil_hari=true){
		$nama_hari = array("Minggu", "Senin", "Selasa", "Rabu", "Kamis", "Jum'at", "Sabtu");
		$nama_bulan = array(1=>"Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember");
		$tahun = substr($tgl, 0, 4);
		$bulan = $nama_bulan[(int)substr($tgl,5,2)];
		$tanggal = substr($tgl, 8,2);

		$text="";
		if($tampil_hari){
			$urutan_hari = date('w', mktime(0,0,0, substr($tgl, 5,2), $tanggal, $tahun));
			$hari = $nama_hari[$urutan_hari];
			$text .= $hari.", ";
		}
		$text .= $tanggal ." ". $bulan ." ". $tahun;
		return $text;
	}

	function tgl_full($tgl, $jenis){
	$hari_h = array("Minggu", "Senin", "Selasa", "Rabu", "Kamis", "Jumat", "Sabtu");
	$tg = date("d", strtotime($tgl));
	$bln = date("m", strtotime($tgl));
	$bln2 = date("m", strtotime($tgl));
	$thn = date("Y", strtotime($tgl));
	$bln_h = array('01' => "Januari", "02" => "Februari", "03" => "Maret", "04" => "April", "05" => "Mei", "06" => "Juni", "07" => "Juli", "08" => "Agustus", "09" => "September", "10" => "Oktober", "11" => "Nopember", "12" => "Desember");
	$bln = $bln_h[$bln];
	$hari = $hari_h[date("w", strtotime($tgl))];

	$jam = date('H');
	$menit = date('i');
	$detik = date('s');

	$get_jam = date("H", strtotime($tgl));
	$get_menit = date("i", strtotime($tgl));
	$get_detik = date("s", strtotime($tgl));

	$zero_jam = '00';
	$zero_menit = '00';
	$zero_detik = '00';

	if($jenis == '0'){
		$print = $tg.' '.$bln.' '.$thn;
	}elseif($jenis == '1'){
		$print = $hari.', '.$tg.' '.$bln.' '.$thn;
	}elseif($jenis == '2'){
		$print = $thn.'-'.$bln2.'-'.$tg;
	}elseif($jenis == '3'){
		$print = $tg."/".$bln2;
	}elseif($jenis == '4'){
		$print = strtotime($tgl);
	}elseif($jenis == '5'){
		$print = $thn."-".$bln2."-".$tg." ".$jam.":".$menit.":".$detik;
	}elseif($jenis == '6'){
		$print = $thn."-".$bln2."-".$tg." ".$get_jam.":".$get_menit.":".$get_detik;
	}elseif($jenis == '7'){
		$print = $thn."-".$bln2."-".$tg." ".$zero_jam.":".$zero_menit.":".$zero_detik;
	}elseif($jenis == '98'){
		$print = $tg."-".$bln2."-".$thn;
	}elseif($jenis == '99'){
		$print = $thn."-".$bln2."-".$tg;
	}elseif($jenis == 'hari'){
		$print = $hari;
	}elseif($jenis == '8'){
		$print = $tg."-".$bln2."-".$thn." ".$get_jam.":".$get_menit.":".$get_detik;
	}elseif($jenis == '10') {
		$print = $tg.'/'.$bln2.'/'.$thn.' '.$jam.':'.$menit;
	}elseif($jenis == '11') {
		$print = $thn.'/'.$bln2.'/'.$tg;
	}elseif($jenis == '26') {
		$print = $tg.'/'.$bln2.'/'.$thn;
	}else{
		$print = $tg.'-'.$bln2.'-'.$thn;
	}
	return $print;
}

 ?>
