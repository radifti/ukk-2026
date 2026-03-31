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
     <header>
        <div class="container">
        <h1><a href="index.php">aspirasi</a></h1>
            <ul>
                <li><a href="index.php">home</a></li>
                <li><a href="input-aspirasi.php">input aspirasi</a></li>
                <li><a href="aspirasi-siswa.php">aspirasi</a></li>
                <li><a href="login.php">🔒 login</a></li>
            </ul>
        </div>
     </header>
    <!-- content -->
    <div class="section">
        <div class="container">
            <div class="section">
                <h1>Selamat Datang, Siswa!</h1>
                <p>Platform Aspirasi adalah wadah resmi bagi seluruh siswa untuk berpartisipasi dalam kemajuan sekolah.</p>
                <a href="input-aspirasi.php" class="btn-large">
                    Sampaikan Aspirasi Sekarang →
                </a>
            </div>

            <div class="dashboard-wrapper">
                <div class="card">
                    <h4>Suarakan</h4>
                    <p>Sampaikan kritik, saran, atau laporan terkait fasilitas dan kegiatan sekolah secara terbuka.</p>
                </div>
                <div class="card">
                    <h4>Pantau</h4>
                    <p>Lihat status tindak lanjut dari aspirasi yang telah kamu kirimkan melalui dashboard ini.</p>
                </div>
                <div class="card">
                    <h4>Wujudkan</h4>
                    <p>Bantu kami menciptakan lingkungan sekolah yang lebih nyaman, aman, dan inovatif untuk kita semua.</p>
                </div>
            </div>

            <div class="box" style="margin-top: 20px;">
                <h3>Tentang Sistem Aspirasi</h3>
                <p>
                    Sistem ini dikembangkan untuk memastikan setiap suara siswa didengar oleh pihak sekolah. 
                    Setiap laporan yang masuk akan dikategorikan mulai dari <strong>Kebersihan</strong>, 
                    <strong>Fasilitas</strong>, hingga <strong>Keamanan</strong>. Pastikan aspirasi 
                    yang kamu sampaikan bersifat membangun dan menggunakan bahasa yang sopan.
                </p>
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