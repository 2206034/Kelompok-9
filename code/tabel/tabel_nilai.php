<b>
	<font color="#2133F8"> NILAI</font>
</b> <br><br>
<hr color="#2133F8" size="3px" width="100%"><br>
<?php
if ($_SESSION['type_user'] == "Admin") {
?>
	<a href="halaman_utama.php?formulir_nilai=$formulir_nilai"><input class="button" type="button" value="Tambah"></a><br><br>
<?php } else if ($_SESSION['type_user'] == "Guru") { ?>
	<a href="halaman_utama.php?formulir_nilai_untuk_guru=$formulir_nilai_untuk_guru"><input class="button" type="button" value="Tambah"></a><br><br>
<?php } ?>

<link type="text/css" href="development-bundle/themes/base/jquery.ui.all.css" rel="stylesheet" />

<script type="text/javascript" src="development-bundle/jquery-1.4.2.js"></script>

<script type="text/javascript" src="development-bundle/ui/jquery.ui.core.js"></script>

<script type="text/javascript" src="development-bundle/ui/jquery.ui.widget.js"></script>

<script type="text/javascript" src="development-bundle/ui/jquery.ui.tabs.js"></script>

<script type="text/javascript">
	$(document).ready(function() {
		$("#tabs").tabs();
	});
</script>

<div id="tabs">

	<ul>
		<li><a href="#tabs-1">7</a></li>
		<li><a href="#tabs-2">8</a></li>
		<li><a href="#tabs-3">9</a></li>
	</ul>

	<!-- VII -->
	<div id="tabs-1">
		<form action="halaman_utama.php?tabel_nilai=$tabel_nilai" method="post">
			Search : <input type="search" name="cari" placeholder="" style="
    width: 200px;
    padding: 10px 10px;
    height:40px;
    margin: 5px 0;
    display: inline-block;
    border: 1px solid #ccc;
    border-radius: 4px;
    box-sizing: border-box;
	font-family:Calibri;
	font-size:15px;">
		</form>

		<font face="Calibri" size="2"><u>Harap gunakan <b>Nama Siswa</b> dalam pencarian Nilai</u> !</font><br><br>

		<table id="daftar-table" border='0' bordercolor="black" cellpading='2' cellspacing='2' width='100%'>
			<tr align='center'>
				<th class="normal">Nama </th>
				<th class="normal">Nama Guru</th>
				<th class="normal">Mata Pelajaran / Standar Kompetensi</th>
				<th class="normal">Absensi</th>
				<th class="normal">Nilai Tugas</th>
				<th class="normal">UTS</th>
				<th class="normal">UAS</th>
				<th class="normal">Nilai Angka</th>
				<th class="normal">Nilai Huruf</th>
				<?php
				if ($_SESSION['type_user'] == "Admin") {
				?>
					<th class="normal">Tools</th>
				<?php } ?>
			</tr>
			<?php
			include "koneksi.php";

			$tampilkan_isi = "select * from nilai n,siswa s,guru g,standar_kompetensi sk,mata_pelajaran mp,kelas j
					  where s.nis=n.nis AND g.kode_guru=n.kode_guru AND sk.kode_sk=n.kode_sk AND mp.kode_mp=sk.kode_mp AND j.tingkat_kelas=s.tingkat_kelas AND s.tingkat_kelas='JU0001';";

			if (isset($_POST['cari']) and $_POST['cari'] <> "") {
				$key = $_POST['cari'];
				$tampilkan_isi = "select * from nilai n,siswa s,guru g,standar_kompetensi sk,mata_pelajaran mp,kelas j
					  where s.nis=n.nis AND g.kode_guru=n.kode_guru AND sk.kode_sk=n.kode_sk AND mp.kode_mp=sk.kode_mp AND j.tingkat_kelas=s.tingkat_kelas AND s.tingkat_kelas='JU0001' and nama_siswa like '%$key%'";

				echo "<font size='3' face='Calibri'>Pencarian data nilai dengan kata '$key'</font>";
			} else if (isset($_POST['cari']) and $_POST['cari'] == "") {
				$tampilkan_isi = "select * from nilai n,siswa s,guru g,standar_kompetensi sk,mata_pelajaran mp,kelas j
					  where s.nis=n.nis AND g.kode_guru=n.kode_guru AND sk.kode_sk=n.kode_sk AND mp.kode_mp=sk.kode_mp AND j.tingkat_kelas=s.tingkat_kelas AND s.tingkat_kelas='JU0001';";
			}

			$tampilkan_isi_sql = mysqli_query($connect, $tampilkan_isi);

			while ($isi = mysqli_fetch_array($tampilkan_isi_sql)) {
				$kode_nilai = $isi['kode_nilai'];
				$nama_siswa = $isi['nama_siswa'];
				$nama_guru = $isi['nama_guru'];
				$nama_mp = $isi['nama_mp'];
				$absensi = $isi['absensi'];
				$nilai_tugas = $isi['nilai_tugas'];
				$uts = $isi['uts'];
				$uas = $isi['uas'];
				$nama_sk = $isi['nama_sk'];
				$total_nilai = $isi['total_nilai'];

			?>
				<tr class="isi" align='left'>
					<td><?php echo $nama_siswa ?>
					<td><?php echo $nama_guru ?></td>
					<td><?php echo $nama_mp ?> | <?php echo $nama_sk ?></td>
					<td><?php echo $absensi ?></td>
					<td><?php echo $nilai_tugas ?></td>
					<td><?php echo $uts ?></td>
					<td><?php echo $uas ?></td>
					<td>
						<?php
						if ($total_nilai <= 65) {
							echo "<b><font color='red'>" . $total_nilai . "</b></font>";
						} else {
							echo $total_nilai;
						}
						?>
					</td>
					<td>
						<?php
						if ($total_nilai >= 101) {
							echo "Angka melebihi kriteria penilaian";
						} else if ($total_nilai >= 85 and $total_nilai <= 100) {
							echo "A";
						}  else if ($total_nilai >= 75 and $total_nilai <= 85) {
							echo "B";
						}  else if ($total_nilai >= 65 and $total_nilai <= 75) {
							echo "C";
						} else if ($total_nilai >= 0 and $total_nilai <= 65) {
							echo "<b><font color='red'>D</font></b>";
						}
						?>
					</td>
					<?php
					if ($_SESSION['type_user'] == "Admin") {
					?>
						<td>
							<form action="halaman_utama.php?aksi_nilai=$aksi_nilai" method="post">
								<input type="hidden" name="kode_nilai" value="<?php echo $kode_nilai; ?>">
								<input class="update" name="proses" type="submit" value="Update" style="font-size:15px;">
								<input class="delete" name="proses" type="submit" value="Delete" style="font-size:15px;" onClick="return confirm('Apakah Anda ingin menghapus data nilai <?php echo $kode_nilai; ?> ?')">
						</td>
					<?php } ?>
				</tr>
				</form>
			<?php
			}
			?>
		</table>
	</div>
	<!-- VII -->
	<div id="tabs-2">
		<form action="halaman_utama.php?tabel_nilai=$tabel_nilai" method="post">
			Search : <input type="search" name="cari" placeholder="" style="
    width: 200px;
    padding: 10px 10px;
    height:40px;
    margin: 5px 0;
    display: inline-block;
    border: 1px solid #ccc;
    border-radius: 4px;
    box-sizing: border-box;
	font-family:Calibri;
	font-size:15px;">
		</form>

		<font face="Calibri" size="2"><u>Harap gunakan <b>Nama Siswa</b> dalam pencarian Nilai</u> !</font><br><br>

		<table id="daftar-table" border='0' bordercolor="black" cellpading='2' cellspacing='2' width='100%'>
			<tr align='center'>
				<th class="normal">Nama </th>
				<th class="normal">Nama Guru</th>
				<th class="normal">Mata Pelajaran / Standar Kompetensi</th>
				<th class="normal">Absensi</th>
				<th class="normal">Nilai Tugas</th>
				<th class="normal">UTS</th>
				<th class="normal">UAS</th>
				<th class="normal">Nilai Angka</th>
				<th class="normal">Nilai Huruf</th>
				<?php
				if ($_SESSION['type_user'] == "Admin") {
				?>
					<th class="normal">Tools</th>
				<?php } ?>
			</tr>
			<?php
			include "koneksi.php";

			$tampilkan_isi = "select * from nilai n,siswa s,guru g,standar_kompetensi sk,mata_pelajaran mp,kelas j
					  where s.nis=n.nis AND g.kode_guru=n.kode_guru AND sk.kode_sk=n.kode_sk AND mp.kode_mp=sk.kode_mp AND j.tingkat_kelas=s.tingkat_kelas AND s.tingkat_kelas='JU0002';";

			if (isset($_POST['cari']) and $_POST['cari'] <> "") {
				$key = $_POST['cari'];
				$tampilkan_isi = "select * from nilai n,siswa s,guru g,standar_kompetensi sk,mata_pelajaran mp,kelas j
					  where s.nis=n.nis AND g.kode_guru=n.kode_guru AND sk.kode_sk=n.kode_sk AND mp.kode_mp=sk.kode_mp AND j.tingkat_kelas=s.tingkat_kelas AND s.tingkat_kelas='JU0002' and nama_siswa like '%$key%'";

				echo "<font size='3' face='Calibri'>Pencarian data nilai dengan kata '$key'</font>";
			} else if (isset($_POST['cari']) and $_POST['cari'] == "") {
				$tampilkan_isi = "select * from nilai n,siswa s,guru g,standar_kompetensi sk,mata_pelajaran mp,kelas j
					  where s.nis=n.nis AND g.kode_guru=n.kode_guru AND sk.kode_sk=n.kode_sk AND mp.kode_mp=sk.kode_mp AND j.tingkat_kelas=s.tingkat_kelas AND s.tingkat_kelas='JU0002';";
			}

			$tampilkan_isi_sql = mysqli_query($connect, $tampilkan_isi);

			while ($isi = mysqli_fetch_array($tampilkan_isi_sql)) {
				$kode_nilai = $isi['kode_nilai'];
				$nama_siswa = $isi['nama_siswa'];
				$nama_guru = $isi['nama_guru'];
				$nama_mp = $isi['nama_mp'];
				$absensi = $isi['absensi'];
				$nilai_tugas = $isi['nilai_tugas'];
				$uts = $isi['uts'];
				$uas = $isi['uas'];
				$nama_sk = $isi['nama_sk'];
				$total_nilai = $isi['total_nilai'];

			?>
				<tr class="isi" align='left'>
					<td><?php echo $nama_siswa ?>
					<td><?php echo $nama_guru ?></td>
					<td><?php echo $nama_mp ?> | <?php echo $nama_sk ?></td>
					<td><?php echo $absensi ?></td>
					<td><?php echo $nilai_tugas ?></td>
					<td><?php echo $uts ?></td>
					<td><?php echo $uas ?></td>
					<td>
						<?php
						if ($total_nilai <= 65) {
							echo "<b><font color='red'>" . $total_nilai . "</b></font>";
						} else {
							echo $total_nilai;
						}
						?>
					</td>
					<td>
						<?php
						if ($total_nilai >= 101) {
							echo "Angka melebihi kriteria penilaian";
						} else if ($total_nilai >= 85 and $total_nilai <= 100) {
							echo "A";
						}  else if ($total_nilai >= 75 and $total_nilai <= 85) {
							echo "B";
						}  else if ($total_nilai >= 65 and $total_nilai <= 75) {
							echo "C";
						} else if ($total_nilai >= 0 and $total_nilai <= 65) {
							echo "<b><font color='red'>D</font></b>";
						}
						?>
					</td>
					<?php
					if ($_SESSION['type_user'] == "Admin") {
					?>
						<td>
							<form action="halaman_utama.php?aksi_nilai=$aksi_nilai" method="post">
								<input type="hidden" name="kode_nilai" value="<?php echo $kode_nilai; ?>">
								<input class="update" name="proses" type="submit" value="Update" style="font-size:15px;">
								<input class="delete" name="proses" type="submit" value="Delete" style="font-size:15px;" onClick="return confirm('Apakah Anda ingin menghapus data nilai <?php echo $kode_nilai; ?> ?')">
						</td>
					<?php } ?>
				</tr>
				</form>
			<?php
			}
			?>
		</table>
	</div>
	<!-- IX -->
	<div id="tabs-3">
		<form action="halaman_utama.php?tabel_nilai=$tabel_nilai" method="post">
			Search : <input type="search" name="cari" placeholder="" style="
    width: 200px;
    padding: 10px 10px;
    height:40px;
    margin: 5px 0;
    display: inline-block;
    border: 1px solid #ccc;
    border-radius: 4px;
    box-sizing: border-box;
	font-family:Calibri;
	font-size:15px;">
		</form>

		<font face="Calibri" size="2"><u>Harap gunakan <b>Nama Siswa</b> dalam pencarian Nilai</u> !</font><br><br>

		<table id="daftar-table" border='0' bordercolor="black" cellpading='2' cellspacing='2' width='100%'>
			<tr align='center'>
				<th class="normal">Nama </th>
				<th class="normal">Nama Guru</th>
				<th class="normal">Mata Pelajaran / Standar Kompetensi</th>
				<th class="normal">Absensi</th>
				<th class="normal">Nilai Tugas</th>
				<th class="normal">UTS</th>
				<th class="normal">UAS</th>
				<th class="normal">Nilai Angka</th>
				<th class="normal">Nilai Huruf</th>
				<?php
				if ($_SESSION['type_user'] == "Admin") {
				?>
					<th class="normal">Tools</th>
				<?php } ?>
			</tr>
			<?php
			include "koneksi.php";

			$tampilkan_isi = "select * from nilai n,siswa s,guru g,standar_kompetensi sk,mata_pelajaran mp,kelas j
					  where s.nis=n.nis AND g.kode_guru=n.kode_guru AND sk.kode_sk=n.kode_sk AND mp.kode_mp=sk.kode_mp AND j.tingkat_kelas=s.tingkat_kelas AND s.tingkat_kelas='JU0003';";

			if (isset($_POST['cari']) and $_POST['cari'] <> "") {
				$key = $_POST['cari'];
				$tampilkan_isi = "select * from nilai n,siswa s,guru g,standar_kompetensi sk,mata_pelajaran mp,kelas j
					  where s.nis=n.nis AND g.kode_guru=n.kode_guru AND sk.kode_sk=n.kode_sk AND mp.kode_mp=sk.kode_mp AND j.tingkat_kelas=s.tingkat_kelas AND s.tingkat_kelas='JU0003' and nama_siswa like '%$key%'";

				echo "<font size='3' face='Calibri'>Pencarian data nilai dengan kata '$key'</font>";
			} else if (isset($_POST['cari']) and $_POST['cari'] == "") {
				$tampilkan_isi = "select * from nilai n,siswa s,guru g,standar_kompetensi sk,mata_pelajaran mp,kelas j
					  where s.nis=n.nis AND g.kode_guru=n.kode_guru AND sk.kode_sk=n.kode_sk AND mp.kode_mp=sk.kode_mp AND j.tingkat_kelas=s.tingkat_kelas AND s.tingkat_kelas='JU0003';";
			}

			$tampilkan_isi_sql = mysqli_query($connect, $tampilkan_isi);

			while ($isi = mysqli_fetch_array($tampilkan_isi_sql)) {
				$kode_nilai = $isi['kode_nilai'];
				$nama_siswa = $isi['nama_siswa'];
				$nama_guru = $isi['nama_guru'];
				$nama_mp = $isi['nama_mp'];
				$absensi = $isi['absensi'];
				$nilai_tugas = $isi['nilai_tugas'];
				$uts = $isi['uts'];
				$uas = $isi['uas'];
				$nama_sk = $isi['nama_sk'];
				$total_nilai = $isi['total_nilai'];

			?>
				<tr class="isi" align='left'>
					<td><?php echo $nama_siswa ?>
					<td><?php echo $nama_guru ?></td>
					<td><?php echo $nama_mp ?> | <?php echo $nama_sk ?></td>
					<td><?php echo $absensi ?></td>
					<td><?php echo $nilai_tugas ?></td>
					<td><?php echo $uts ?></td>
					<td><?php echo $uas ?></td>
					<td>
						<?php
						if ($total_nilai <= 65) {
							echo "<b><font color='red'>" . $total_nilai . "</b></font>";
						} else {
							echo $total_nilai;
						}
						?>
					</td>
					<td>
						<?php
						if ($total_nilai >= 101) {
							echo "Angka melebihi kriteria penilaian";
						} else if ($total_nilai >= 85 and $total_nilai <= 100) {
							echo "A";
						}  else if ($total_nilai >= 75 and $total_nilai <= 85) {
							echo "B";
						}  else if ($total_nilai >= 65 and $total_nilai <= 75) {
							echo "C";
						} else if ($total_nilai >= 0 and $total_nilai <= 65) {
							echo "<b><font color='red'>D</font></b>";
						}
						?>
					</td>
					<?php
					if ($_SESSION['type_user'] == "Admin") {
					?>
						<td>
							<form action="halaman_utama.php?aksi_nilai=$aksi_nilai" method="post">
								<input type="hidden" name="kode_nilai" value="<?php echo $kode_nilai; ?>">
								<input class="update" name="proses" type="submit" value="Update" style="font-size:15px;">
								<input class="delete" name="proses" type="submit" value="Delete" style="font-size:15px;" onClick="return confirm('Apakah Anda ingin menghapus data nilai <?php echo $kode_nilai; ?> ?')">
						</td>
					<?php } ?>
				</tr>
				</form>
			<?php
			}
			?>
		</table>
	</div>
	</div>

	</body>

	</html>