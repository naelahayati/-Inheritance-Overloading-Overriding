<?php
class Employee {
    protected $gaji_pokok; // Gaji dasar
    protected $lama_kerja; // Dalam tahun

    // Constructor untuk inisialisasi
    public function __construct($gaji_pokok, $lama_kerja) {
        $this->gaji_pokok = $gaji_pokok;
        $this->lama_kerja = $lama_kerja;
    }

    // Method dasar untuk menampilkan informasi
    public function getInfoDasar() {
        return "Gaji Pokok: Rp " . number_format($this->gaji_pokok, 0, ',', '.') . 
               ", Lama Kerja: " . $this->lama_kerja . " tahun";
    }
}

class Programmer extends Employee {
    // Method UNIK untuk menghitung gaji Programmer (TIDAK Override Employee::hitungGajiTotal)
    public function hitungGajiProgrammer() {
        $bonus_persen = 0;
        
        // Cek kenaikan gaji berdasarkan lama kerja
        if ($this->lama_kerja >= 1 && $this->lama_kerja <= 10) {
            // Tambahan bonus sebesar 0.01 dari lama kerja
            $bonus_persen = $this->lama_kerja * 0.01;
        } elseif ($this->lama_kerja > 10) {
            // Tambahan bonus sebesar 0.02 dari lama kerja
            $bonus_persen = $this->lama_kerja * 0.02;
        }
        
        // Total Gaji = Gaji Pokok + (Gaji Pokok * Bonus Persen)
        return $this->gaji_pokok + ($this->gaji_pokok * $bonus_persen);
    }
}

class Direktur extends Employee {
    // Method UNIK untuk menghitung gaji Direktur
    public function hitungGajiDirektur() {
        // Bonus = 0.5 dari lama kerja
        $bonus = $this->lama_kerja * 0.5;
        
        // Tunjangan = 0.1 dari lama kerja
        $tunjangan = $this->lama_kerja * 0.1;

        // Total Gaji = Gaji Pokok + (Gaji Pokok * Bonus) + (Gaji Pokok * Tunjangan)
        return $this->gaji_pokok + 
               ($this->gaji_pokok * $bonus) + 
               ($this->gaji_pokok * $tunjangan);
    }
}

class PegawaiMingguan extends Employee {
    protected $harga_barang; 
    protected $stok_harus_terjual; 
    protected $total_penjualan_input; 

    // Constructor override untuk menerima variabel tambahan
    public function __construct($gaji_pokok, $lama_kerja, $harga_barang, $stok_harus_terjual, $total_penjualan_input) {
        // Panggil constructor class induk
        parent::__construct($gaji_pokok, $lama_kerja);
        
        $this->harga_barang = $harga_barang;
        $this->stok_harus_terjual = $stok_harus_terjual;
        $this->total_penjualan_input = $total_penjualan_input;
    }

    // Method UNIK untuk menghitung gaji Pegawai Mingguan
    public function hitungGajiPegawaiMingguan() {
        $target_terjual = $this->stok_harus_terjual * 0.7; // 70% dari stok
        $gaji_tambahan = 0;
        
        // Percabangan kenaikan gaji
        if ($this->total_penjualan_input > $target_terjual) {
            // Gaji tambahan sebesar 10% dari harga barang tiap 1 penjualan
            $gaji_tambahan = 0.10 * $this->harga_barang * $this->total_penjualan_input;
        } else {
            // Bonus gaji tambahan 3% dari harga barang tiap 1 penjualan
            $gaji_tambahan = 0.03 * $this->harga_barang * $this->total_penjualan_input;
        }
        
        // Total Gaji = Gaji Pokok + Gaji Tambahan
        return $this->gaji_pokok + $gaji_tambahan;
    }
}

// 1. Programmer (Lama kerja 5 tahun)
$prog = new Programmer(5000000, 5); 
$gaji_prog = $prog->hitungGajiProgrammer();
echo "<h2>Programmer</h2>";
echo $prog->getInfoDasar() . "<br>";
echo "Gaji Total: Rp " . number_format($gaji_prog, 0, ',', '.') . "<br><hr>";


// 2. Direktur (Lama kerja 15 tahun)
$dir = new Direktur(15000000, 15); 
$gaji_dir = $dir->hitungGajiDirektur();
echo "<h2>Direktur</h2>";
echo $dir->getInfoDasar() . "<br>";
echo "Gaji Total: Rp " . number_format($gaji_dir, 0, ',', '.') . "<br><hr>";


// 3. Pegawai Mingguan (Penjualan aktual 750 unit, Target 700 unit)
$mingguan = new PegawaiMingguan(2000000, 2, 10000, 1000, 750); 
$gaji_mingguan = $mingguan->hitungGajiPegawaiMingguan();
echo "<h2>Pegawai Mingguan</h2>";
echo $mingguan->getInfoDasar() . "<br>";
echo "Gaji Total: Rp " . number_format($gaji_mingguan, 0, ',', '.') . "<br><hr>";
?>