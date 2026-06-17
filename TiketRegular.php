<?php

require_once '../abstract/Tiket.php';

class TiketRegular extends Tiket
{
    protected $tipeAudio;
    protected $lokasiBaris;
}

?>

<?php

require_once '../abstract/Tiket.php';

class TiketRegular extends Tiket
{
    protected $tipeAudio;
    protected $lokasiBaris;

    public function hitungTotalHarga()
    {
        return $this->jumlah_kursi * $this->hargaDasarTiket;
    }

    public function tampilkanInfoFasilitas()
    {
        return "Tipe Audio : " . $this->tipeAudio .
               " | Lokasi Baris : " . $this->lokasiBaris;
    }
}

?>