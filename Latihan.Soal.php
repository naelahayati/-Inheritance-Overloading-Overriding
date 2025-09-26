<?php
// Class induk
class Kendaraan {
    public $merek;
    public $harga;

    function __construct($merek, $harga) {
        $this->merek = $merek;
        $this->harga = $harga;
    }
}

// Class turunan
class Pesawat extends Kendaraan {
    private $tinggiMaks;
    private $kecepatanMaks;

    // Setter
    public function setTinggiMaks($tinggi) {
        $this->tinggiMaks = $tinggi;
    }

    public function setKecepatanMaks($kecepatan) {
        $this->kecepatanMaks = $kecepatan;
    }

    // Getter
    public function bacaTinggiMaks() {
        return $this->tinggiMaks;
    }

    // Hitung biaya operasional
    public function biayaOperasional() {
        if ($this->tinggiMaks > 5000 && $this->kecepatanMaks > 800) {
            return 0.30 * $this->harga;
        } elseif ($this->tinggiMaks >= 3000 && $this->tinggiMaks <= 5000 
                  && $this->kecepatanMaks >= 500 && $this->kecepatanMaks <= 800) {
            return 0.20 * $this->harga;
        } elseif ($this->tinggiMaks < 3000 && $this->kecepatanMaks < 500) {
            return 0.10 * $this->harga;
        } else {
            return 0.05 * $this->harga;
        }
    }
}

// Data pesawat
$pesawat1 = new Pesawat("Boeing 737", 2000000000);
$pesawat1->setTinggiMaks(7500);
$pesawat1->setKecepatanMaks(650);

$pesawat2 = new Pesawat("Boeing 747", 3500000000);
$pesawat2->setTinggiMaks(5800);
$pesawat2->setKecepatanMaks(750);

$pesawat3 = new Pesawat("Fokker F28", 1500000000);
$pesawat3->setTinggiMaks(2500);
$pesawat3->setKecepatanMaks(500);

// Cetak hasil
echo "Biaya operasional pesawat {$pesawat1->merek} dengan harga Rp {$pesawat1->harga} adalah Rp " . number_format($pesawat1->biayaOperasional(), 0, ',', '.') . "<br>";
echo "Biaya operasional pesawat {$pesawat2->merek} dengan harga Rp {$pesawat2->harga} adalah Rp " . number_format($pesawat2->biayaOperasional(), 0, ',', '.') . "<br>";
echo "Biaya operasional pesawat {$pesawat3->merek} dengan harga Rp {$pesawat3->harga} adalah Rp " . number_format($pesawat3->biayaOperasional(), 0, ',', '.') . "<br>";
?>
