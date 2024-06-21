<?php
include "../../../../koneksi.php";
$kode_nilai = $_POST['kode_nilai'];
$nis = $_POST['nis'];
$kode_guru = $_POST['kode_guru'];
$kode_sk = $_POST['kode_sk'];
$absensi = $_POST['absensi'];
$nilai_tugas = $_POST['nilai_tugas'];
$uts = $_POST['uts'];
$uas = $_POST['uas'];
$angka_nilai = $_POST['total_nilai'];

if(isset($_POST['submit'])){
	mysqli_query($connect, "update nilai set 
	total_nilai = '$angka_nilai',
	absensi = '$absensi',
	nilai_tugas = '$nilai_tugas',
	uts = '$uts',
	uas = '$uas'
	where kode_nilai='$kode_nilai'");
	header('location:../../../../halaman_utama.php?tabel_nilai=$tabel_nilai');
}
else
{
	echo "Update gagal dijalankan";
}

?>