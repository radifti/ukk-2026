<?php
    include 'db.php';

?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>aspirasi</title>
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <link href="https://fonts.googleapis.com/css2?family=Quicksand&display=swap" rel="stylesheet">
</head>
<body> 
    <!-- header -->
     <header>
        <div class="container">
        <h1><a href="index.php">aspirasi</a></h1>
            <ul>
                <li><a href="index.php">dashboard</a></li>
                <li><a href="aspirasi-siswa.php">aspirasi</a></li>
                <li><a href="login.php">login</a></li>
            </ul>
        </div>
     </header>
    <!-- content -->
    <div class="section">
        <div class="container">
            <h3>Dashboard</h3>
            <div class="section">
        <div class="container">
            <div class="box">
                <form action="" method="POST" enctype="multipart/form-data">
                    <input type="number" name="nis" class="input-control" placeholder="nis" required>
                    <select class="input-control" name="kategori" required>
                        <option value="">--pilih kategori--</option>
                        <?php
                        $kat = mysqli_query($conn, "SELECT * FROM kategori ORDER BY id_kategori DESC");
                        while ($k = mysqli_fetch_array($kat)) {
                            ?>
                            <option value="<?php echo $k['id_kategori'] ?> "><?php echo $k['ket_kategori'] ?></option>
                        <?php } ?>
                    </select>
                    <input type="text" name="lokasi" class="input-control" placeholder="lokasi" required>
                    <textarea name="keterangan" class="input-control" maxlength="50" placeholder="Keterangan (50 Character max)"></textarea>
                    <input type="submit" name="submit" value="Submit" class="btn">
                </form>
                <?php

                if (isset($_POST['submit'])) {
                    $nis       = $_POST['nis'];
                    $kategori       = $_POST['kategori'];
                    $lokasi      = $_POST['lokasi'];
                    $keterangan  = $_POST['keterangan'];
                    $tanggal     = date('Y-m-d');

                    $check_siswa = mysqli_query($conn, "SELECT * FROM siswa WHERE nis = '$nis'");
    
                    if (mysqli_num_rows($check_siswa) == 0) {
                        echo '<script>alert("NIS tidak terdaftar!")</script>';
                    } else {

                    $insert = mysqli_query($conn, "INSERT INTO input_aspirasi VALUES (
                                                    null,
                                                    '".$nis."', 
                                                    '".$kategori."',
                                                    '".$lokasi."',
                                                    '".$keterangan."',
                                                    '".$tanggal."'
                                                    ) ");

                        if($insert){
                            echo '<script>alert("Tambah data berhasil")</script>';
                              echo '<script>window.location="index.php"</script>';
                        }else{
                            echo 'gagal' .mysqli_error($conn);
                        }
                    } 
                }
                ?>
            </div>
        </div>
    </div>
        </div>
    </div>
     <footer>
        <div class="container">
            <small>Copyright &copy; 2026 - givan</small>
        </div>
     </footer>
</body>
</html>