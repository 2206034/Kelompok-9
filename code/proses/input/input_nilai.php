<?php
include "../../../koneksi.php";
$kode_nilai = $_POST['kode_nilai'];
$nis = $_POST['nis'];
$kode_guru = $_POST['kode_guru'];
$kode_sk = $_POST['kode_sk'];
$absensi = $_POST['absensi'];
$nilai_tugas = $_POST['nilai_tugas'];
$uts = $_POST['uts'];
$uas = $_POST['uas'];
$angka_nilai = $_POST['angka_nilai'];

$insertNilai = "INSERT INTO nilai values ('$kode_nilai','$nis','$kode_guru','$kode_sk','$absensi','$nilai_tugas','$uts','$uas','$angka_nilai')";

$insertNilai_query = mysqli_query($connect,$insertNilai);

if ($insertNilai_query)
{
	header('location:../../../halaman_utama.php?tabel_nilai=$tabel_nilai');
}
else
{
	echo "Insert gagal dijalankan";
}

?>