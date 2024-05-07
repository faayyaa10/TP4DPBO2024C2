<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

include_once("models/DB.class.php");
include_once("controllers/Member.controller.php");

$member = new MemberController();

if (isset($_GET['add'])) {
    // Memeriksa apakah formulir telah disubmit
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])) {
        // Memanggil fungsi addData dengan $_POST sebagai parameter
        $result = $member->addData(
            $_POST['nama'],
            $_POST['email'],
            $_POST['no_telp'],
            $_POST['tanggal_join'],
            $_POST['id_film']
        );

        if ($result) {
            // Jika operasi tambah berhasil, redirect pengguna ke halaman index
            header("location:index.php");
            exit(); // Hentikan eksekusi skrip setelah melakukan pengalihan
        } else {
            // Jika operasi tambah gagal, berikan pesan kesalahan kepada pengguna atau tangani secara memadai
            header("location:index.php");
        }
    } else {
        // Jika formulir belum disubmit, tampilkan formulir tambah
        $member->addForm();
    }
} elseif (!empty($_GET['id_hapus'])) {
    // Memanggil fungsi deleteData jika parameter id_hapus tidak kosong
    $id = $_GET['id_hapus'];
    $result = $member->deleteData($id);

    if ($result) {
        // Jika operasi hapus berhasil, redirect pengguna ke halaman index
        header("location:index.php");
    } else {
        // Jika operasi hapus gagal, berikan pesan kesalahan kepada pengguna atau tangani secara memadai
        echo "Gagal menghapus member.";
    }
} elseif (!empty($_GET['id_edit'])) {
    // Memanggil fungsi editForm jika parameter id_edit tidak kosong
    $id = $_GET['id_edit'];
    $member->editForm($id);

} else {
    // Memanggil fungsi index jika tidak ada operasi tambah, edit, atau hapus
    $member->index();
}
?>
