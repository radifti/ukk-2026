<?php
    session_start();
    include 'db.php';
    if($_SESSION['status_login'] != true){
        echo '<script>window.location="login.php"</script>';
    }

    // --- COMBINED FILTER LOGIC ---
    $where = " WHERE 1=1 "; 

    if(!empty($_GET['search'])){
        $search = mysqli_real_escape_string($conn, $_GET['search']);
        // This checks if the input matches NIS OR Kelas
        $where .= " AND (nis LIKE '%$search%' OR kelas LIKE '%$search%') ";
    }

    $query_str = "SELECT * FROM siswa $where ORDER BY nis DESC";
    $siswa = mysqli_query($conn, $query_str);
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Siswa - aspirasi</title>
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <link href="https://fonts.googleapis.com/css2?family=Quicksand&display=swap" rel="stylesheet">
</head>
<body>
    <header>
        <div class="container">
            <h1><a href="dashboard.php">aspirasi</a></h1>
            <ul>
                <li><a href="dashboard.php">dashboard</a></li>
                <li><a href="profil.php">profil</a></li>
                <li><a href="pelaporan.php">pelaporan</a></li>
                <li><a href="aspirasi.php">aspirasi</a></li>
                <li><a href="siswa.php" class="active">siswa</a></li>
                <li><a href="kategori.php">kategori</a></li>
                <li><a href="keluar.php">keluar</a></li>
            </ul>
        </div>
    </header>

    <div class="section">
        <div class="container">
            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px; flex-wrap: wrap; gap: 10px;">
                <h3>Data Siswa</h3>
            </div>

            <div class="box">
                <form action="" method="POST" class="filter-form">
                    <div class="filter-inputs-wrapper">
                        <label>Tambah siswa</label>
                        <div class="filter-inputs-inline">
                            <input type="text" name="nis"  placeholder="nis" required>               
                            <input type="text" name="kelas"  placeholder="kelas" required>
                            <input type="submit" name="submit" value="submit" class="btn-filter">
                        </div>
                    </div>

                </form> 
                <?php
                if(isset($_POST['submit'])){
                    $nis       = $_POST['nis'];
                    $kelas     = $_POST['kelas'];       

                    $check = mysqli_query($conn, "SELECT nis FROM siswa WHERE nis = '$nis'");
                    if(mysqli_num_rows($check) > 0){
                        echo '<script>alert("nis sudah ada")</script>';
                    } else {
                        $insert = mysqli_query($conn, "INSERT INTO siswa (nis, kelas) VALUES ('$nis', '$kelas')");
                        if($insert){
                            echo '<script>alert("Tambah siswa berhasil")</script>';
                            echo '<script>window.location="siswa.php"</script>';
                            exit;
                        } else {
                            echo 'Gagal '.mysqli_error($conn);
                        }
                    }
                }
                ?>
            </div>

            <div class="box" style="padding: 15px;">
                <div class="table-responsive">
                    <table border="0" cellspacing="0" class="table" style="width: 100%; table-layout: fixed;">
                        <thead>
                            <tr>
                                <th style="width: 80px;">No</th>
                                <th>NIS</th>
                                <th>Kelas</th>
                                <th style="width: 200px;">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                $no = 1;
                                if(mysqli_num_rows($siswa) > 0){
                                    while($row = mysqli_fetch_array($siswa)){
                            ?>
                            <tr>
                                <td align="center"><?php echo $no++ ?></td>
                                <td align="center"><strong><?php echo $row['nis'] ?></strong></td>
                                <td align="center"><?php echo $row['kelas'] ?></td>
                                <td>
                                    <div class="btn-container" style="justify-content: center;">
                                        <a href="edit-siswa.php?id=<?php echo $row['nis'] ?>" class="btn-edit">Edit</a>
                                        <a href="proses-hapus.php?siswa=<?php echo $row['nis'] ?>" class="btn-hapus" onclick="return confirm('Yakin ingin menghapus siswa ini?')">Hapus</a>
                                    </div>
                                </td>
                            </tr>
                            <?php }} else { ?>
                                <tr>
                                    <td colspan="4" align="center" style="padding: 30px;">Data tidak ditemukan.</td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <footer>
        <div class="container">
            <small>Copyright &copy; 2026 - givan.</small>
        </div>
    </footer>
</body>
</html>