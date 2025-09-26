<?php
class Shape {
    // Konstanta untuk nilai Pi
    const PI = 3.142; 

    // Magic method yang dipanggil ketika mencoba memanggil method yang tidak ada
    function __call($name, $arg) {
        // Cek apakah method yang dipanggil adalah 'area'
        if ($name == 'area') {
            // Cek jumlah argumen yang diberikan
            switch (count($arg)) {
                // Jika tidak ada argumen (case 0)
                case 0: 
                    return 0;
                // Jika 1 argumen (dianggap jari-jari lingkaran: Luas = PI * r)
                case 1: 
                    return self::PI * $arg[0]; 
                // Jika 2 argumen (dianggap panjang dan lebar persegi/persegi panjang: Luas = p * l)
                case 2: 
                    return $arg[0] * $arg[1];
            }
        }
    }
}

// Instansiasi objek untuk Lingkaran
$circle = new Shape();
// Memanggil method 'area' dengan 1 argumen (jari-jari). 
// Karena method 'area' tidak ada, maka __call() akan dipanggil.
echo $circle->area(3); 

// Instansiasi objek untuk Persegi Panjang
$rect = new Shape();
// Memanggil method 'area' dengan 2 argumen (panjang dan lebar).
echo $rect->area(8, 6);

?>