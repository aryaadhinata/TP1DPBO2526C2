<?php

class Penayangan {
    private $judulFilm;
    private $tanggal;
    private $jam;
    private $studio;
    private $hargaTiket;
    private $gambar; // menyimpan PATH FILE LOKAL, contoh: "uploads/poster1.jpg"

    public function __construct($judulFilm = "", $tanggal = "", $jam = "", $studio = "", $hargaTiket = 0, $gambar = "") {
        $this->judulFilm = $judulFilm;
        $this->tanggal = $tanggal;
        $this->jam = $jam;
        $this->studio = $studio;
        $this->hargaTiket = $hargaTiket;
        $this->gambar = $gambar;
    }

    // Getter & Setter
    public function getJudulFilm() {
        return $this->judulFilm;
    }

    public function setJudulFilm($judulFilm) {
        $this->judulFilm = $judulFilm;
    }

    public function getTanggal() {
        return $this->tanggal;
    }

    public function setTanggal($tanggal) {
        $this->tanggal = $tanggal;
    }

    public function getJam() {
        return $this->jam;
    }

    public function setJam($jam) {
        $this->jam = $jam;
    }

    public function getStudio() {
        return $this->studio;
    }

    public function setStudio($studio) {
        $this->studio = $studio;
    }

    public function getHargaTiket() {
        return $this->hargaTiket;
    }

    public function setHargaTiket($hargaTiket) {
        $this->hargaTiket = $hargaTiket;
    }

    public function getGambar() {
        return $this->gambar;
    }

    public function setGambar($gambar) {
        $this->gambar = $gambar;
    }
}