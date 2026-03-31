<?php
    session_start();
    include 'db.php';
    if($_SESSION['status_login'] != true){
        echo '<script>window.location="login.php"</script>';
    }

    // --- DASHBOARD COUNTS ---
    $total_aspirasi = mysqli_num_rows(mysqli_query($conn, "SELECT id_aspirasi FROM aspirasi"));
    $total_menunggu = mysqli_num_rows(mysqli_query($conn, "SELECT id_aspirasi FROM aspirasi WHERE status = 'menunggu'"));
    $total_proses   = mysqli_num_rows(mysqli_query($conn, "SELECT id_aspirasi FROM aspirasi WHERE status = 'proses'"));
    $total_selesai  = mysqli_num_rows(mysqli_query($conn, "SELECT id_aspirasi FROM aspirasi WHERE status = 'selesai'"));

    // --- FILTER LOGIC ---
    $where = " WHERE 1=1 "; 

    if(!empty($_GET['search_nis'])){
        $nis = mysqli_real_escape_string($conn, $_GET['search_nis']);
        $where .= " AND input_aspirasi.nis = '$nis' ";
    }
    
    if(!empty($_GET['filter_kat'])){
        $kat = mysqli_real_escape_string($conn, $_GET['filter_kat']);
        $where .= " AND input_aspirasi.id_kategori = '$kat' ";
    }

    if(!empty($_GET['filter_month'])){
        $month = mysqli_real_escape_string($conn, $_GET['filter_month']);
        $where .= " AND MONTH(input_aspirasi.tanggal_input) = '$month' ";
    }

    if(!empty($_GET['date_from']) && !empty($_GET['date_to'])){
        $from = mysqli_real_escape_string($conn, $_GET['date_from']);
        $to = mysqli_real_escape_string($conn, $_GET['date_to']);
        $where .= " AND input_aspirasi.tanggal_input BETWEEN '$from' AND '$to' ";
    }

    if(!empty($_GET['filter_status'])){
        $status = mysqli_real_escape_string($conn, $_GET['filter_status']);
        $where .= " AND aspirasi.status = '$status' ";
    }

    // Main Query joining aspirasi, input, and kategori
    $query_str = "SELECT * FROM aspirasi 
                  LEFT JOIN input_aspirasi USING (id_pelaporan) 
                  LEFT JOIN kategori ON input_aspirasi.id_kategori = kategori.id_kategori
                  $where 
                  ORDER BY id_aspirasi DESC";
    $aspirasi_data = mysqli_query($conn, $query_str);
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin - Data Aspirasi</title>
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
                <li><a href="aspirasi.php" class="active">aspirasi</a></li>
                <li><a href="siswa.php">siswa</a></li>
                <li><a href="kategori.php">kategori</a></li>
                <li><a href="keluar.php">keluar</a></li>
            </ul>
        </div>
    </header>

    <div class="section">
        <div class="container">
            <div>
                <h3>Semua Aspirasi</h3>
            </div>

            <div class="box dashboard-wrapper">
                <div class="card">
                    <h4>Total Data</h4>
                    <p><?php echo $total_aspirasi; ?></p>
                </div>
                <div class="card">
                    <h4>Menunggu</h4>
                    <p><?php echo $total_menunggu; ?></p>
                </div>
                <div class="card">
                    <h4>Proses</h4>
                    <p><?php echo $total_proses; ?></p>
                </div>
                <div class="card">
                    <h4>Selesai</h4>
                    <p><?php echo $total_selesai; ?></p>
                </div>
            </div>

            <div class="box">
                <form action="" method="GET" class="filter-form">
                    <div class="filter-group">
                        <label>NIS Siswa</label>
                        <input type="number" name="search_nis" placeholder="Cari NIS..." value="<?php echo @$_GET['search_nis'] ?> " style="max-width: 160px;">
                    </div>

                    <div class="filter-group">
                        <label>Kategori</label>
                        <select name="filter_kat">
                            <option value="">- Semua -</option>
                            <?php 
                                $kategori = mysqli_query($conn, "SELECT * FROM kategori ORDER BY ket_kategori ASC");
                                while($k = mysqli_fetch_array($kategori)){
                            ?>
                            <option value="<?php echo $k['id_kategori'] ?>" <?php echo (@$_GET['filter_kat'] == $k['id_kategori']) ? 'selected':'' ?>><?php echo $k['ket_kategori'] ?></option>
                            <?php } ?>
                        </select>
                    </div>

                    <!-- <div class="filter-group">
                        <label>Status</label>
                            <select name="filter_status">
                                <option value="">- Semua -</option>
                                <option value="menunggu" <?php echo (@$_GET['filter_status'] == 'menunggu') ? 'selected' : '' ?>>Menunggu</option>
                                <option value="proses" <?php echo (@$_GET['filter_status'] == 'proses') ? 'selected' : '' ?>>Proses</option>
                                <option value="selesai" <?php echo (@$_GET['filter_status'] == 'selesai') ? 'selected' : '' ?>>Selesai</option>
                            </select>
                    </div> -->

                    <div class="filter-group">
                        <label>Bulan</label>
                        <select name="filter_month">
                            <option value="">- Semua -</option>
                            <?php
                                for($m=1; $m<=12; $m++) {
                                    $mVal = str_pad($m, 2, "0", STR_PAD_LEFT);
                                    $mName = date('F', mktime(0, 0, 0, $m, 1));
                                    echo "<option value='$mVal' ".((@$_GET['filter_month']==$mVal)?'selected':'').">$mName</option>";
                                }
                            ?>
                        </select>
                    </div>

                    <div class="filter-group">
                        <label>Dari Tanggal</label>
                        <input type="date" name="date_from" value="<?php echo @$_GET['date_from'] ?>">
                    </div>
                    <div class="filter-group">
                        <label>Sampai Tanggal</label>
                        <input type="date" name="date_to" value="<?php echo @$_GET['date_to'] ?>">
                    </div>

                    <div class="filter-btn">
                        <button type="submit" class="btn-filter">Filter</button>
                        <a href="aspirasi.php" class="btn-reset">Reset</a>
                    </div>
                </form>
            </div>

            <div style="display: flex; justify-content: flex-end; margin-bottom: 20px;">
                <a href="tambah-aspirasi.php" class="btn" style="width: auto; padding: 10px 25px;">Tambah Aspirasi</a>
            </div>

            <div class="box">
                <table border="0" cellspacing="0" class="table" style="width: 100%; table-layout: fixed;">
                    <thead>
                        <tr>
                            <!-- <th style="width: 50px;">ID</th> -->
                            <th style="width: 110px;">Tanggal</th>
                            <th style="width: 90px;">NIS</th>
                            <th style="width: 130px;">Status</th>
                            <th style="width: 140px;">Kategori</th>
                            <th>Feedback Admin</th> <th style="width: 160px;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            if(mysqli_num_rows($aspirasi_data) > 0){
                                while($row = mysqli_fetch_array($aspirasi_data)){
                                    $status_class = "status-" . $row['status'];
                        ?>
                        <tr>
                            <!-- <td align="center"><strong><?php echo $row['id_aspirasi'] ?></strong></td> -->
                            <td align="center"><?php echo date('d/m/Y', strtotime($row['tanggal_input'])) ?></td>
                            <td align="center"><?php echo $row['nis'] ?></td>
                            <td align="center">
                                <span class="status-badge <?php echo $status_class ?>">
                                    <?php echo strtoupper($row['status']) ?>
                                </span>
                            </td>
                            <td><?php echo $row['ket_kategori'] ?></td>
                            <td style="text-align: left; word-wrap: break-word; white-space: normal;">
                                <?php echo $row['feedback'] ?>
                            </td>
                            <td>
                                <div class="btn-container" style="justify-content: center;">
                                    <a href="edit-aspirasi.php?id=<?php echo $row['id_aspirasi'] ?>" class="btn-edit">Edit</a>
                                    <a href="proses-hapus.php?aspirasi=<?php echo $row['id_aspirasi'] ?>" class="btn-hapus" onclick="return confirm('Yakin ingin menghapus data ini?')">Hapus</a>
                                </div>
                            </td>
                        </tr>
                        <?php }} else { ?>
                            <tr>
                                <td colspan="7" align="center" style="padding: 30px;">Tidak ada data aspirasi ditemukan.</td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
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