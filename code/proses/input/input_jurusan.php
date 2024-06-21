<?php
include "../../../koneksi.php";
$tingkat_kelas = $_POST['tingkat_kelas'];
$kelas = $_POST['kelas'];

$insertJurusan = "INSERT INTO kelas values ('$tingkat_kelas','$kelas')";

$insertJurusan_query = mysqli_query($connect,$insertJurusan);

if ($insertJurusan_query)
{
	header('location:../../../halaman_utama.php?tabel_jurusan=$tabel_jurusan');
}
else
{
	echo "Insert gagal dijalankan";
}

?>