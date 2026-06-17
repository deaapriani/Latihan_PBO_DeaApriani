<?php

require_once '../abstract/Tiket.php';

class TiketVelvet extends Tiket
{
    protected $bantalSelimutPack;
    protected $layananButler;

    public function hitungTotalHarga()
    {
        return ($this->jumlah_kursi * $this->hargaDasarTiket)
               * 1.50;
    }

    public function tampilkanInfoFasilitas()
    {
        return "Bantal & Selimut : " .
               $this->bantalSelimutPack .
               " | Butler : " .
               $this->layananButler;
    }
}

?>