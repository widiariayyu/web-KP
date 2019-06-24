<?php
namespace App\Helpers;

class Fungsi
{
    public static function autoNumber($id_terakhir, $panjang_kode, $panjang_angka)
    {
	    $kode = substr($id_terakhir, 0, $panjang_kode);
	    $angka = substr($id_terakhir, $panjang_kode, $panjang_angka);
	    $angka_baru = str_repeat("0", $panjang_angka - strlen($angka+1)).($angka+1);
	    $id_baru = $kode.$angka_baru;

	    return $id_baru;
    }

    public static function bulanID($b)
    {
      if ($b) {
        $bulan = array("", "Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember");
        $arr = explode("-", $b);
        $jadi = $arr[2]." ".$bulan[(int)$arr[1]]." ".$arr[0];
  	    return $jadi;
      }
      return $b;
    }
}
