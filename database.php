<?php

class Database
{
    public $koneksi;

    public function __construct()
    {
        $this->koneksi = new mysqli(
            "localhost",
            "root",
            "",
            "db_latihan_pbo_trpl1b_deaapriani"
        );

        if ($this->koneksi->connect_error) {
            die("Koneksi gagal : " . $this->koneksi->connect_error);
        }
    }
}

$db = new Database();

?>