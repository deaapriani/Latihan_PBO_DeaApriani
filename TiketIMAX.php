<?php

require_once '../abstract/Tiket.php';

class TiketIMAX extends Tiket
{
    protected $kacamata3dId;
    protected $efekGerakFitur;

    public function hitungTotalHarga()
    {
        return ($this->jumlah_kursi * $this->hargaDasarTiket)
               + 35000;
    }

    public function tampilkanInfoFasilitas()
    {
        return "Kacamata 3D : " . $this->kacamata3dId .
               " | Efek Gerak : " . $this->efekGerakFitur;
    }
}

?>