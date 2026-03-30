<?php
    session_start();
    include 'db.php';
    if($_SESSION['status_login'] != true){
        echo '<script>window.location="login.php"</script>';
    }
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Kategori - aspirasi</title>
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
                <li><a href="siswa.php">siswa</a></li>
                <li><a href="kategori.php" class="active">kategori</a></li>
                <li><a href="keluar.php">keluar</a></li>
            </ul>
        </div>
    </header>

    <div class="section">
        <div class="container">
            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px; flex-wrap: wrap; gap: 10px;">
                <h3>Data Kategori</h3>
                <a href="tambah-kategori.php" class="btn" style="width: auto; padding: 10px 25px;">Tambah Kategori</a>
            </div>

            <div class="box" style="padding: 15px;">
                <div class="table-responsive">
                    <table border="0" cellspacing="0" class="table" style="width: 100%; table-layout: fixed;">
                        <thead>
                            <tr>
                                <th style="width: 80px;">ID</th>
                                <th>Keterangan Kategori</th>
                                <th style="width: 200px;">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                $kategori = mysqli_query($conn, "SELECT * FROM kategori ORDER BY id_kategori DESC");
                                if(mysqli_num_rows($kategori) > 0){
                                    while($row = mysqli_fetch_array($kategori)){
                            ?>
                            <tr>
                                <td align="center"><strong><?php echo $row['id_kategori'] ?></strong></td>
                                <td><?php echo $row['ket_kategori'] ?></td>
                                <td>
                                    <div class="btn-container" style="justify-content: center;">
                                        <a href="edit-kategori.php?id=<?php echo $row['id_kategori'] ?>" class="btn-edit">Edit</a>
                                        <a href="proses-hapus.php?kategori=<?php echo $row['id_kategori'] ?>" class="btn-hapus" onclick="return confirm('Yakin ingin menghapus kategori ini?')">Hapus</a>
                                    </div>
                                </td>
                            </tr>
                            <?php }} else { ?>
                                <tr>
                                    <td colspan="3" align="center" style="padding: 30px;">Tidak ada data kategori.</td>
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