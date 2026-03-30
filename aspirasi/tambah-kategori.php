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
    <meta name="viewport" content="width, initial-scale=1">
    <title>aspirasi</title>
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
                <li><a href="kategori.php">kategori</a></li>
                <li><a href="keluar.php">keluar</a></li>
            </ul>
        </div>
    </header>

    <div class="section">
        <div class="container">
            <h3>tambah kategori</h3>
            <div class="box">
            <form action="" method="POST" enctype="multipart/form-data">
                <input type="text" name="kategori" class="input-control" placeholder="keterangan kategori" required>
                <input type="submit" name="submit" value="submit" class="btn">
            </form> 
                <?php
                if(isset($_POST['submit'])){
                    $kategori       = $_POST['kategori'];        

                    $insert = mysqli_query($conn, "INSERT INTO kategori VALUES (                     
                                        null,
                                        '".$kategori."'
                                    )");
                    
                    if($insert){
                        echo '<script>alert("Tambah kategori berhasil")</script>';
                        echo '<script>window.location="kategori.php"</script>';
                    } else {
                        echo 'Gagal '.mysqli_error($conn);
                    }
                }
            ?>
            </div>  
        </div>
    </div>

    <footer>
        <div class="container">
            <small>Copyright &copy; 2026 - givan.</small>
        </div>
    </footer>
    <script>
        CKEDITOR.replace( 'deskripsi');
    </script>
</body>
</html>