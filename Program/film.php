<?php

include_once("models/Templates.class.php");
include_once("models/DB.class.php");
include_once("controllers/Film.controller.php");

$film = new FilmController();

if (isset($_GET['add'])) {
    // Memanggil fungsi add jika data dikirim melalui metode POST dan tombol "submit" diklik
        $film->AddFormFilm();
        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])) {
            // Memanggil fungsi addData dengan $_POST sebagai parameter
            $result = $film->addFilm(
                $_POST['nama_film'],
            );
    
            if ($result) {
                // Jika operasi tambah berhasil, redirect pengguna ke halaman index
                header("location:film.php");
                exit(); // Hentikan eksekusi skrip setelah melakukan pengalihan
            } else {
                // Jika operasi tambah gagal, berikan pesan kesalahan kepada pengguna atau tangani secara memadai
                echo "Gagal menambahkan film.";
            }
        } 
} elseif (!empty($_GET['id_hapus'])) {
    // Memanggil fungsi deleteData jika parameter id_hapus tidak kosong
    $id = $_GET['id_hapus'];
    $result = $film->deleteFilm($id);

    if ($result) {
        // Jika operasi hapus berhasil, redirect pengguna ke halaman index
        header("location:index.php");
    } else {
        // Jika operasi hapus gagal, berikan pesan kesalahan kepada pengguna atau tangani secara memadai
        echo "Gagal menghapus film.";
    }
} elseif (!empty($_GET['id_edit'])) {
    // Memanggil fungsi editForm jika parameter id_edit tidak kosong
    $id = $_GET['id_edit'];
    $film->editFormFilm($id);

} else {
    // Memanggil fungsi index jika tidak ada operasi tambah, edit, atau hapus
    $film->index();
}

