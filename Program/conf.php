<?php
class Conf {
    public static $db_host = "localhost";
    public static $db_user = "root";
    public static $db_pass = "";
    public static $db_name = "db_film";

    // Fungsi untuk membuat koneksi database
    public static function createConnection() {
        return new mysqli(self::$db_host, self::$db_user, self::$db_pass, self::$db_name);
    }
}

// Penggunaan:
$conn = Conf::createConnection(); // Membuat objek koneksi dengan memanggil metode createConnection()
?>
