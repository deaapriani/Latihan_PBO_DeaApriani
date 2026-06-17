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
// ABSTRACT CLASS
// ======================
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

// ======================
// CLASS TIKET REGULAR
// ======================
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
        return $this->jumlah_kursi * $this->hargaDasarTiket;
    }

    public function tampilkanInfoFasilitas()
    {
        return "Audio : {$this->tipeAudio}<br>
                Baris : {$this->lokasiBaris}";
    }
}

// ======================
// CLASS TIKET IMAX
// ======================
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
        return ($this->jumlah_kursi * $this->hargaDasarTiket)
                + 35000;
    }

    public function tampilkanInfoFasilitas()
    {
        return "Kacamata 3D : {$this->kacamata3dId}<br>
                Efek Gerak : {$this->efekGerakFitur}";
    }
}

// ======================
// CLASS TIKET VELVET
// ======================
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
        return ($this->jumlah_kursi * $this->hargaDasarTiket)
                * 1.50;
    }

    public function tampilkanInfoFasilitas()
    {
        return "Bantal & Selimut : {$this->bantalSelimutPack}<br>
                Butler : {$this->layananButler}";
    }
}

// ======================
// AMBIL DATA DATABASE
// ======================
$query = mysqli_query(
    $koneksi,
    "SELECT * FROM tabel_tiket"
);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Sistem Manajemen Tiket Bioskop</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
          rel="stylesheet">
</head>

<body class="bg-light">

<div class="container mt-5">

    <h2 class="text-center mb-4">
        Sistem Manajemen Tiket & Fasilitas Studio Bioskop
    </h2>

    <table class="table table-bordered table-striped">

        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Nama Film</th>
                <th>Jadwal</th>
                <th>Studio</th>
                <th>Jumlah Kursi</th>
                <th>Fasilitas</th>
                <th>Total Harga</th>
            </tr>
        </thead>

        <tbody>

        <?php
        while ($row = mysqli_fetch_assoc($query)) {

            if ($row['jenis_studio'] == 'Regular') {

                $tiket = new TiketRegular(
                    $row['id_tiket'],
                    $row['nama_film'],
                    $row['jadwal_tayang'],
                    $row['jumlah_kursi'],
                    $row['harga_dasar_tiket'],
                    $row['tipe_audio'],
                    $row['lokasi_baris']
                );

            } elseif ($row['jenis_studio'] == 'IMAX') {

                $tiket = new TiketIMAX(
                    $row['id_tiket'],
                    $row['nama_film'],
                    $row['jadwal_tayang'],
                    $row['jumlah_kursi'],
                    $row['harga_dasar_tiket'],
                    $row['kacamata_3d_id'],
                    $row['efek_gerak_fitur']
                );

            } else {

                $tiket = new TiketVelvet(
                    $row['id_tiket'],
                    $row['nama_film'],
                    $row['jadwal_tayang'],
                    $row['jumlah_kursi'],
                    $row['harga_dasar_tiket'],
                    $row['bantal_selimut_pack'],
                    $row['layanan_butler']
                );
            }
        ?>

        <tr>
            <td><?= $row['id_tiket']; ?></td>
            <td><?= $tiket->getNamaFilm(); ?></td>
            <td><?= $tiket->getJadwal(); ?></td>
            <td><?= $row['jenis_studio']; ?></td>
            <td><?= $tiket->getJumlahKursi(); ?></td>
            <td><?= $tiket->tampilkanInfoFasilitas(); ?></td>
            <td>
                Rp <?= number_format(
                    $tiket->hitungTotalHarga(),
                    0,
                    ',',
                    '.'
                ); ?>
            </td>
        </tr>

        <?php } ?>

        </tbody>

    </table>

</div>

</body>
</html>