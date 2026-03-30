<?php
    include 'db.php';

    // 2. BRAIN: Logic for Table Filtering
    $where = " WHERE 1=1 ";

    if(!empty($_GET['search_nis'])){
        $nis = mysqli_real_escape_string($conn, $_GET['search_nis']);
        $where .= " AND input_aspirasi.nis = '$nis' ";
    }
    

    if(!empty($_GET['filter_status'])){
        $status = mysqli_real_escape_string($conn, $_GET['filter_status']);
        $where .= " AND aspirasi.status = '$status' ";
    }

    // Execute the final query once
    $ida = mysqli_query($conn, "SELECT * FROM aspirasi 
                                LEFT JOIN input_aspirasi USING (id_pelaporan) 
                                LEFT JOIN kategori USING (id_kategori) 
                                $where 
                                ORDER BY id_aspirasi DESC");
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>aspirasi</title>
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <link href="https://fonts.googleapis.com/css2?family=Quicksand&display=swap" rel="stylesheet">
</head>
<body>
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

    <div class="section">
        <div class="container">
            <h3>Histori aspirasi</h3>
                <div class="section">
                    <div class="container">

                        <div class="box dashboard-wrapper">
                            <form action="" method="GET" class="filter-form">
                                <div class="filter-group">
                                    <label>NIS</label>
                                    <input type="number" name="search_nis" maxlength="11" placeholder="Masukkan NIS..." value="<?php echo @$_GET['search_nis'] ?>">
                                </div>

                                <div class="filter-group">
                                    <label>Status</label>
                                    <select name="filter_status">
                                        <option value="">- Semua Status -</option>
                                        <option value="menunggu" <?php echo (@$_GET['filter_status'] == 'menunggu') ? 'selected' : '' ?>>Menunggu</option>
                                        <option value="proses" <?php echo (@$_GET['filter_status'] == 'proses') ? 'selected' : '' ?>>Proses</option>
                                        <option value="selesai" <?php echo (@$_GET['filter_status'] == 'selesai') ? 'selected' : '' ?>>Selesai</option>
                                    </select>
                                </div>

                                <div class="">
                                    <button type="submit" class="btn-filter">Filter</button>
                                    <a href="aspirasi-siswa.php" class="btn-reset">Reset</a>
                                </div>
                            </form>
                        </div>

                        <div class="box">
                            <table border="0" cellspacing="0" class="table">
                                <thead>
                                    <tr>
                                        <th width="50px">ID</th>
                                        <th width="120px">Tanggal</th>
                                        <th width="100px">NIS</th>
                                        <th width="120px">Lokasi</th>
                                        <th width="100px">Status</th>
                                        <th>Feedback</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    if(mysqli_num_rows($ida) > 0){
                                        while ($row = mysqli_fetch_array($ida)) {
                                            $status_raw = !empty($row['status']) ? $row['status'] : 'menunggu'; 
                                            $status_class = 'status-' . strtolower($status_raw);
                                    ?>
                                    <tr>
                                        <td><?php echo $row['id_aspirasi'] ?></td>
                                        <td><?php echo $row['tanggal_input'] ?></td>
                                        <td><?php echo $row['nis'] ?></td>
                                        <td><?php echo $row['lokasi'] ?></td>
                                        <td>
                                            <span class="status-badge <?php echo $status_class; ?>">
                                                <?php echo $status_raw; ?>
                                            </span>
                                        </td>
                                        <td>(<?php echo $row['ket_kategori'] ?>) <?php echo $row['feedback'] ?></td>
                                    </tr>
                                    <?php }} else { ?>
                                    <tr>
                                        <td colspan="6" style="text-align:center; padding: 20px;">Tidak ada data ditemukan.</td>
                                    </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
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