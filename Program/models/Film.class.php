<?php

class FilmClass extends DB
{
    function getAllFilm()
    {
        $query = "SELECT * FROM film";
        return $this->execute($query);
    }

    function getFilmNameById($id_film){
        // Panggil metode execute dari kelas induk (DB)
        $result = $this->execute("SELECT nama_film FROM film WHERE id = $id_film");
        $row = mysqli_fetch_assoc($result);
        return $row['nama_film'];
    }

    function getFilmById($id_film){
        // Panggil metode execute dari kelas induk (DB) untuk mendapatkan data film berdasarkan ID
        $result = $this->execute("SELECT * FROM film WHERE id_film = $id_film");
        $row = mysqli_fetch_assoc($result);
        return $row;
    }

    function add($data){
    $nama_film = $data['nama_film'];

    // Menggunakan prepared statement untuk mencegah SQL injection
    $query = "INSERT INTO film (nama_film) VALUES (?)";
    
    // Mengeksekusi query menggunakan prepared statement
    $stmt = $this->db_link->prepare($query);

    // Periksa apakah prepared statement berhasil
    if ($stmt === false) {
        return false; // Mengembalikan false jika prepared statement gagal
    }

    // Bind parameter ke placeholder dalam prepared statement
    $stmt->bind_param('s', $nama_film);

    // Jalankan prepared statement
    $result = $stmt->execute();

    // Tutup prepared statement
    $stmt->close();
    
    return $result; // Mengembalikan hasil eksekusi prepared statement (true jika berhasil, false jika gagal)
}

function edit($id_film, $nama_film){
    // Menggunakan prepared statement untuk mencegah SQL injection
    $query = "UPDATE film SET nama_film = ? WHERE id_film = ?";
    
    // Mengeksekusi query menggunakan prepared statement
    $stmt = $this->db_link->prepare($query);

    // Periksa apakah prepared statement berhasil
    if ($stmt === false) {
        return false; // Mengembalikan false jika prepared statement gagal
    }

    // Bind parameter ke placeholder dalam prepared statement
    $stmt->bind_param('si', $nama_film, $id_film);

    // Jalankan prepared statement
    $result = $stmt->execute();

    // Tutup prepared statement
    $stmt->close();
    
    return $result; // Mengembalikan hasil eksekusi prepared statement (true jika berhasil, false jika gagal)
}


function delete($id)
    {
        $query = "DELETE FROM film WHERE id_film = '$id'";

        // Mengeksekusi query
        return $this->execute($query);
    }

}
?>
