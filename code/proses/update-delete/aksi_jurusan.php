<body>
    <?php
    include "koneksi.php";
    $aksi = strtolower($_POST['proses']);
    $tingkat_kelas = $_POST['tingkat_kelas'];


    if ($aksi == "delete") {
        $delete_jurusan = "DELETE from kelas where tingkat_kelas='$tingkat_kelas'";

        $delete_jurusan_query = mysqli_query($connect, $delete_jurusan);

        if ($delete_jurusan_query) {
            header("location:halaman_utama.php?tabel_jurusan=$tabel_jurusan");
        } else {
            echo "Delete gagal dijalankan";
        }
    } else {

        include "koneksi.php";

        $query = mysqli_query($connect, "select * from kelas where tingkat_kelas='$tingkat_kelas'");
    ?>

        <br>
        <center>
            <h2>Update Data Kelas</h2>
        </center><br>

        <form action="code/proses/update-delete/update/update_jurusan.php" method="POST">

            <table id="tabel-pendaftaran">
                <?php
                while ($isi = mysqli_fetch_array($query)) {
                ?>
                    <tr>
                        <td><b>Tingkat Kelas</b></td>
                    </tr>
                    <tr>
                        <td><input type="text" name='tingkat_kelas' size="25px" maxlength="6" style="background-color:#E0DFDF" value="<?php echo $tingkat_kelas; ?>" readonly></td>
                    </tr>

                    <tr>
                        <td><b>Kelas</b></td>
                    </tr>
                    <tr>
                        <td><input type="text" name="kelas" size="25px" maxlength="35" placeholder="ketikkan kelas." value="<?php echo $isi['kelas']; ?>" required>&nbsp;&nbsp;&nbsp; <input class="button" type="submit" value="Update"></td>
                    </tr>
                <?php } ?>
            </table>
        <?php
    }
        ?>