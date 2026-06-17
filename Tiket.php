<?php

abstract class Tiket
{
    protected $id_tiket;
    protected $nama_film;
    protected $jadwal_tayang;
    protected $jumlah_kursi;
    protected $hargaDasarTiket;

    abstract public function hitungTotalHarga();

    abstract public function tampilkanInfoFasilitas();
}

?>