<?php
// ==========================
// KONEKSI DATABASE
// ==========================
$koneksi = new mysqli(
    "localhost",
    "root",
    "",
    "db_latihan_pbo_trpl1b_deaapriani"
);

if ($koneksi->connect_error) {
    die("Koneksi Gagal : " . $koneksi->connect_error);
}

// ==========================
// ABSTRACT CLASS
// ==========================
abstract class Tiket
{
    protected $id_tiket;
    protected $nama_film;
    protected $jadwal_tayang;
    protected $jumlah_kursi;
    protected $hargaDasarTiket;

    public function __construct(
        $id_tiket,
        $nama_film,
        $jadwal_tayang,
        $jumlah_kursi,
        $hargaDasarTiket
    ) {
        $this->id_tiket = $id_tiket;
        $this->nama_film = $nama_film;
        $this->jadwal_tayang = $jadwal_tayang;
        $this->jumlah_kursi = $jumlah_kursi;
        $this->hargaDasarTiket = $hargaDasarTiket;
    }

    public function getNamaFilm()
    {
        return $this->nama_film;
    }

    public function getJadwal()
    {
        return $this->jadwal_tayang;
    }

    public function getJumlahKursi()
    {
        return $this->jumlah_kursi;
    }

    abstract public function hitungTotalHarga();
    abstract public function tampilkanInfoFasilitas();
}

// ==========================
// TIKET REGULAR
// ==========================
class TiketRegular extends Tiket
{
    protected $tipeAudio;
    protected $lokasiBaris;

    public function __construct(
        $id_tiket,
        $nama_film,
        $jadwal_tayang,
        $jumlah_kursi,
        $hargaDasarTiket,
        $tipeAudio,
        $lokasiBaris
    ) {
        parent::__construct(
            $id_tiket,
            $nama_film,
            $jadwal_tayang,
            $jumlah_kursi,
            $hargaDasarTiket
        );

        $this->tipeAudio = $tipeAudio;
        $this->lokasiBaris = $lokasiBaris;
    }

    public function hitungTotalHarga()
    {
        return $this->jumlah_kursi *
               $this->hargaDasarTiket;
    }

    public function tampilkanInfoFasilitas()
    {
        return "
        Audio : {$this->tipeAudio}<br>
        Baris : {$this->lokasiBaris}";
    }
}

// ==========================
// TIKET IMAX
// ==========================
class TiketIMAX extends Tiket
{
    protected $kacamata3dId;
    protected $efekGerakFitur;

    public function __construct(
        $id_tiket,
        $nama_film,
        $jadwal_tayang,
        $jumlah_kursi,
        $hargaDasarTiket,
        $kacamata3dId,
        $efekGerakFitur
    ) {
        parent::__construct(
            $id_tiket,
            $nama_film,
            $jadwal_tayang,
            $jumlah_kursi,
            $hargaDasarTiket
        );

        $this->kacamata3dId = $kacamata3dId;
        $this->efekGerakFitur = $efekGerakFitur;
    }

    public function hitungTotalHarga()
    {
        return ($this->jumlah_kursi *
                $this->hargaDasarTiket)
                + 35000;
    }

    public function tampilkanInfoFasilitas()
    {
        return "
        Kacamata 3D : {$this->kacamata3dId}<br>
        Efek Gerak : {$this->efekGerakFitur}";
    }
}

// ==========================
// TIKET VELVET
// ==========================
class TiketVelvet extends Tiket
{
    protected $bantalSelimutPack;
    protected $layananButler;

    public function __construct(
        $id_tiket,
        $nama_film,
        $jadwal_tayang,
        $jumlah_kursi,
        $hargaDasarTiket,
        $bantalSelimutPack,
        $layananButler
    ) {
        parent::__construct(
            $id_tiket,
            $nama_film,
            $jadwal_tayang,
            $jumlah_kursi,
            $hargaDasarTiket
        );

        $this->bantalSelimutPack = $bantalSelimutPack;
        $this->layananButler = $layananButler;
    }

    public function hitungTotalHarga()
    {
        return ($this->jumlah_kursi *
                $this->hargaDasarTiket)
                * 1.50;
    }

    public function tampilkanInfoFasilitas()
    {
        return "
        Bantal & Selimut : {$this->bantalSelimutPack}<br>
        Butler : {$this->layananButler}";
    }
}

// ==========================
// AMBIL DATA DATABASE
// ==========================
$query = mysqli_query(
    $koneksi,
    "SELECT * FROM tabel_tiket"
);

$total = mysqli_num_rows($query);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Sistem Manajemen Tiket Bioskop</title>

    <link
    href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
    rel="stylesheet">

    <style>

        body{
            background:
            linear-gradient(
                135deg,
                #dbeafe,
                #bfdbfe,
                #93c5fd
            );
            min-height:100vh;
        }

        .header-card{
            background:
            linear-gradient(
                90deg,
                #1e40af,
                #2563eb,
                #60a5fa
            );
            border-radius:25px;
        }

        .stat-card,
        .ticket-card{
            border:none;
            border-radius:20px;
            box-shadow:
            0 5px 20px
            rgba(0,0,0,0.15);
        }

        .ticket-card{
            transition:0.3s;
        }

        .ticket-card:hover{
            transform:translateY(-8px);
        }

        .section-title{
            color:#1e3a8a;
            font-weight:bold;
        }

    </style>
</head>

<body>

<div class="container py-5">

    <!-- HEADER -->
    <div class="card header-card shadow-lg mb-5">
        <div class="card-body text-center text-white p-5">
            <h1>🎬 Sistem Manajemen Tiket Bioskop</h1>
            <h5>
                Kelola Tiket dan Fasilitas Studio Bioskop
            </h5>
        </div>
    </div>

    <!-- STATISTIK -->
    <div class="row mb-5">

        <div class="col-md-3">
            <div class="card stat-card">
                <div class="card-body text-center">
                    <h5>Total Tiket</h5>
                    <h2><?= $total ?></h2>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card stat-card">
                <div class="card-body text-center">
                    <h5>Regular</h5>
                    <h2>🎫</h2>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card stat-card">
                <div class="card-body text-center">
                    <h5>IMAX</h5>
                    <h2>🎥</h2>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card stat-card">
                <div class="card-body text-center">
                    <h5>Velvet</h5>
                    <h2>🛋️</h2>
                </div>
            </div>
        </div>

    </div>

    <h2 class="section-title mb-4">
        🎫 Daftar Tiket Penonton
    </h2>

    <div class="row">

        <?php
        mysqli_data_seek($query,0);

        while($row = mysqli_fetch_assoc($query))
        {
            if($row['jenis_studio']=="Regular")
            {
                $tiket = new TiketRegular(
                    $row['id_tiket'],
                    $row['nama_film'],
                    $row['jadwal_tayang'],
                    $row['jumlah_kursi'],
                    $row['harga_dasar_tiket'],
                    $row['tipe_audio'],
                    $row['lokasi_baris']
                );

                $warna = "primary";
            }
            elseif($row['jenis_studio']=="IMAX")
            {
                $tiket = new TiketIMAX(
                    $row['id_tiket'],
                    $row['nama_film'],
                    $row['jadwal_tayang'],
                    $row['jumlah_kursi'],
                    $row['harga_dasar_tiket'],
                    $row['kacamata_3d_id'],
                    $row['efek_gerak_fitur']
                );

                $warna = "info";
            }
            else
            {
                $tiket = new TiketVelvet(
                    $row['id_tiket'],
                    $row['nama_film'],
                    $row['jadwal_tayang'],
                    $row['jumlah_kursi'],
                    $row['harga_dasar_tiket'],
                    $row['bantal_selimut_pack'],
                    $row['layanan_butler']
                );

                $warna = "dark";
            }
        ?>

        <div class="col-md-4 mb-4">

            <div class="card ticket-card h-100">

                <div class="card-header bg-<?= $warna ?> text-white">
                    <?= $row['jenis_studio']; ?>
                </div>

                <div class="card-body">

                    <h4>
                        🎬 <?= $tiket->getNamaFilm(); ?>
                    </h4>

                    <hr>

                    <p>
                        <b>Jadwal :</b><br>
                        <?= $tiket->getJadwal(); ?>
                    </p>

                    <p>
                        <b>Jumlah Kursi :</b><br>
                        <?= $tiket->getJumlahKursi(); ?>
                    </p>

                    <p>
                        <b>Fasilitas :</b><br>
                        <?= $tiket->tampilkanInfoFasilitas(); ?>
                    </p>

                    <h5 class="text-primary">
                        Rp <?= number_format(
                            $tiket->hitungTotalHarga(),
                            0,
                            ',',
                            '.'
                        ); ?>
                    </h5>

                </div>

            </div>

        </div>

        <?php } ?>

    </div>

</div>

</body>
</html>