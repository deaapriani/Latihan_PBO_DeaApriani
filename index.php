<?php
// ======================
// KONEKSI DATABASE
// ======================
$koneksi = new mysqli(
    "localhost",
    "root",
    "",
    "db_latihan_pbo_trpl1b_deaapriani"
);

if ($koneksi->connect_error) {
    die("Koneksi gagal : " . $koneksi->connect_error);
}

// ======================
// HITUNG JUMLAH STUDIO
// ======================
$total = mysqli_num_rows(
    mysqli_query($koneksi, "SELECT * FROM tabel_tiket")
);

$regular = mysqli_num_rows(
    mysqli_query(
        $koneksi,
        "SELECT * FROM tabel_tiket
         WHERE jenis_studio='Regular'"
    )
);

$imax = mysqli_num_rows(
    mysqli_query(
        $koneksi,
        "SELECT * FROM tabel_tiket
         WHERE jenis_studio='IMAX'"
    )
);

$velvet = mysqli_num_rows(
    mysqli_query(
        $koneksi,
        "SELECT * FROM tabel_tiket
         WHERE jenis_studio='Velvet'"
    )
);

// ======================
// AMBIL DATA TIKET
// ======================
$data = mysqli_query(
    $koneksi,
    "SELECT * FROM tabel_tiket
     ORDER BY jenis_studio"
);
?>

<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport"
      content="width=device-width, initial-scale=1">

<title>CinemaRiani</title>

<link
href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
rel="stylesheet">

<style>

body{
    min-height:100vh;
    font-family:'Segoe UI',sans-serif;

    background:
    linear-gradient(
        rgba(5,20,50,0.75),
        rgba(5,20,50,0.75)
    ),
    url('assets/riri.jpg');

    background-size:cover;
    background-position:center;
    background-attachment:fixed;

    color:white;
}

/* efek kaca */
.glass{
    background:
    rgba(255,255,255,0.08);

    backdrop-filter:blur(18px);
    -webkit-backdrop-filter:blur(18px);

    border:
    1px solid
    rgba(255,255,255,0.15);

    border-radius:25px;

    box-shadow:
    0 8px 32px
    rgba(0,0,0,0.3);
}

/* judul */
.logo{
    font-size:45px;
    font-weight:bold;
    color:#7dd3fc;

    text-shadow:
    0 0 15px
    rgba(125,211,252,0.8);
}

/* statistik */
.stat-card{
    background:
    rgba(255,255,255,0.08);

    backdrop-filter:blur(20px);

    border:
    1px solid
    rgba(125,211,252,0.3);

    border-radius:20px;

    transition:0.4s;
}

.stat-card:hover{
    transform:translateY(-10px);

    box-shadow:
    0 0 25px
    rgba(125,211,252,0.5);
}

/* tiket */
.ticket-card{
    background:
    rgba(255,255,255,0.08);

    backdrop-filter:blur(20px);

    border:
    1px solid
    rgba(125,211,252,0.25);

    border-radius:20px;

    transition:0.4s;
}

.ticket-card:hover{
    transform:scale(1.03);

    box-shadow:
    0 0 30px
    rgba(96,165,250,0.5);
}

/* badge studio */
.badge-studio{
    background:
    linear-gradient(
        90deg,
        #2563eb,
        #38bdf8
    );

    padding:10px;
    border-radius:12px;

    font-weight:bold;
    text-align:center;
}

/* total */
.total{
    background:
    rgba(37,99,235,0.2);

    border:
    1px solid
    rgba(125,211,252,0.3);

    border-radius:15px;

    padding:12px;

    color:#bfdbfe;
    font-size:20px;
    font-weight:bold;
}

.info-box{
    background:
    rgba(255,255,255,0.05);

    border-radius:15px;
    padding:15px;
}

</style>
</head>

<body>

<div class="container py-5">

    <!-- HEADER -->
    <div class="glass p-4 mb-5">
        <h1 class="logo">
            🎬 CinemaRiani
        </h1>
    </div>

    <!-- STATISTIK -->
    <div class="glass p-5 mb-5">

        <h2 class="mb-4">
            🎬 Sistem Manajemen Tiket Bioskop
        </h2>

        <div class="row">

            <div class="col-md-3 mb-3">
                <div class="stat-card p-4 text-center">
                    <h4>🎟️ Tiket</h4>
                    <h1><?= $total ?></h1>
                </div>
            </div>

            <div class="col-md-3 mb-3">
                <div class="stat-card p-4 text-center">
                    <h4>🍿 Regular</h4>
                    <h1><?= $regular ?></h1>
                </div>
            </div>

            <div class="col-md-3 mb-3">
                <div class="stat-card p-4 text-center">
                    <h4>🎥 IMAX</h4>
                    <h1><?= $imax ?></h1>
                </div>
            </div>

            <div class="col-md-3 mb-3">
                <div class="stat-card p-4 text-center">
                    <h4>🛋️ Velvet</h4>
                    <h1><?= $velvet ?></h1>
                </div>
            </div>

        </div>

    </div>

    <!-- DAFTAR TIKET -->
    <div class="glass p-4 mb-4">
        <h2>
            🎬 Daftar Tiket &
            Fasilitas Studio
        </h2>
    </div>

    <div class="row">

    <?php while($row = mysqli_fetch_assoc($data)){ ?>

        <div class="col-md-4 mb-4">

            <div class="ticket-card p-4 h-100">

                <div class="badge-studio mb-4">
                    <?= $row['jenis_studio']; ?>
                </div>

                <h3>
                    🎬
                    <?= $row['nama_film']; ?>
                </h3>

                <hr>

                <p>
                    <b>ID Tiket :</b>
                    <?= $row['id_tiket']; ?>
                </p>

                <p>
                    <b>Jadwal :</b><br>
                    <?= $row['jadwal_tayang']; ?>
                </p>

                <p>
                    <b>Jumlah Kursi :</b>
                    <?= $row['jumlah_kursi']; ?>
                </p>

                <p>
                    <b>Harga Dasar :</b>
                    Rp
                    <?= number_format(
                        $row['harga_dasar_tiket'],
                        0,
                        ',',
                        '.'
                    ); ?>
                </p>

                <div class="info-box mb-3">
                    <b>Fasilitas :</b><br><br>

                    <?php
                    if(
                        $row['jenis_studio']
                        == 'Regular'
                    ){
                        echo
                        "Audio :
                        ".$row['tipe_audio']
                        ."<br>";

                        echo
                        "Baris :
                        ".$row['lokasi_baris'];
                    }

                    elseif(
                        $row['jenis_studio']
                        == 'IMAX'
                    ){
                        echo
                        "Kacamata 3D :
                        ".$row['kacamata_3d_id']
                        ."<br>";

                        echo
                        "Efek Gerak :
                        ".$row['efek_gerak_fitur'];
                    }

                    else{
                        echo
                        "Bantal & Selimut :
                        ".$row['bantal_selimut_pack']
                        ."<br>";

                        echo
                        "Layanan Butler :
                        ".$row['layanan_butler'];
                    }
                    ?>

                </div>

                <?php
                if(
                    $row['jenis_studio']
                    == 'Regular'
                ){
                    $totalHarga =
                    $row['jumlah_kursi']
                    *
                    $row['harga_dasar_tiket'];
                }

                elseif(
                    $row['jenis_studio']
                    == 'IMAX'
                ){
                    $totalHarga =
                    (
                        $row['jumlah_kursi']
                        *
                        $row['harga_dasar_tiket']
                    )
                    + 35000;
                }

                else{
                    $totalHarga =
                    (
                        $row['jumlah_kursi']
                        *
                        $row['harga_dasar_tiket']
                    )
                    * 1.5;
                }
                ?>

                <div class="total text-center">

                    Total Harga :
                    Rp
                    <?= number_format(
                        $totalHarga,
                        0,
                        ',',
                        '.'
                    ); ?>

                </div>

            </div>

        </div>

    <?php } ?>

    </div>

</div>

</body>
</html>