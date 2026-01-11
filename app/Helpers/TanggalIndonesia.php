<?php

namespace App\Helpers;

use Carbon\Carbon;

class tanggal_indonesia
{
	private static array $nama_hari = [
		'Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'
	];

	private static array $nama_bulan = [
		1 => 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'
	];

	public static function format($tanggal, bool $tampil_hari = true): string{
		$date = $tanggal instanceof Carbon ? $tanggal : Carbon::parse($tanggal);
        
        $text = '';
        
       if ($tampil_hari){
		$hari = self::$nama_hari[$date->dayOfWeek];
		$text .= $hari . ', ';
	   }

	   $bulan = self::$nama_bulan[$date->month];
	   $text .= $date->day . ' ' . $date->year;

	   return $text;
	}

	public static function formatFull($tanggal, $jenis)
	{
		$date = $tanggal instanceof Carbon ? $tanggal : Carbon::parse($tanggal);
        $now = Carbon::now();

		return match($jenis) {
            '0' => $date->format('d') . ' ' . self::$nama_bulan[(int)$date->format('m')] . ' ' . $date->format('Y'),
            '1' => self::$nama_hari[$date->dayOfWeek] . ', ' . $date->format('d') . ' ' . self::$nama_bulan[(int)$date->format('m')] . ' ' . $date->format('Y'),
            '2', '99' => $date->format('Y-m-d'),
            '3' => $date->format('d/m'),
            '4' => $date->timestamp,
            '5' => $date->format('Y-m-d') . ' ' . $now->format('H:i:s'),
            '6' => $date->format('Y-m-d H:i:s'),
            '7' => $date->format('Y-m-d') . ' 00:00:00',
            '8' => $date->format('d-m-Y H:i:s'),
            '10' => $date->format('d/m/Y') . ' ' . $now->format('H:i'),
            '11' => $date->format('Y/m/d'),
            '26' => $date->format('d/m/Y'),
            '98' => $date->format('d-m-Y'),
            'hari' => self::$nama_hari[$date->dayOfWeek],
            
            default => $date->format('d-m-Y'),
        };
	}
}

