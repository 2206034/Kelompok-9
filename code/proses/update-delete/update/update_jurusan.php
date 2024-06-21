<?php
include "../../../../koneksi.php";
$tingkat_kelas = $_POST['tingkat_kelas'];
$kelas = $_POST['kelas'];

$updateJurusan = "UPDATE kelas set tingkat_kelas='$tingkat_kelas' , kelas='$kelas' where tingkat_kelas='$tingkat_kelas'";

$updateJurusan_query = mysqli_query($connect,$updateJurusan);

if ($updateJurusan_query)
{
	header('location:../../../../halaman_utama.php?tabel_jurusan=$tabel_jurusan');
}
else
{
	echo "Update gagal dijalankan";
}

?>