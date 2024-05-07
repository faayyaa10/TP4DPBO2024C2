<?php

class Member extends DB
{
    function getAllMember()
    {
        $query = "SELECT member.*, film.nama_film FROM member JOIN film ON member.id_film = film.id_film";
        return $this->execute($query);
    }

    function getMemberById($id) {
        $query = "SELECT member.*, film.nama_film FROM member JOIN film ON member.id_film = film.id_film WHERE id_member = '$id'";
        $result = $this->execute($query);
        return ($result->num_rows > 0) ? $result->fetch_assoc() : null; // Mengembalikan baris data sebagai array asosiatif atau null jika tidak ada data
    }
    
    
    function add($data){
        // Mendapatkan nilai dari array data yang diterima
        $nama = $data['nama'];
        $email = $data['email'];
        $no_telp = $data['no_telp'];
        $tanggal_join = $data['tanggal_join'];
        $id_film = $data['id_film'];
        
        // Menyesuaikan query dengan parameter yang diterima
        $query = "INSERT INTO member (nama, email, no_telp, tanggal_join, id_film) 
                  VALUES ('$nama', '$email', '$no_telp', '$tanggal_join', '$id_film')";
        
        // Eksekusi query
        return $this->execute($query);
    }
    
    // Fungsi untuk mengedit data member berdasarkan ID
    function edit($id, $data) {
        // Mendapatkan nilai dari array data yang diterima
        $nama = $data['nama'];
        $email = $data['email'];
        $no_telp = $data['no_telp'];
        $tanggal_join = $data['tanggal_join'];
        $id_film = $data['id_film'];
        
        // Menyesuaikan query dengan parameter yang diterima
        $query = "UPDATE member SET 
                  nama = '$nama', 
                  email = '$email', 
                  no_telp = '$no_telp', 
                  tanggal_join = '$tanggal_join', 
                  id_film = '$id_film' 
                  WHERE id_member = '$id'";
        
        // Eksekusi query
        return $this->execute($query);
    }

    function delete($id)
    {
        $query = "DELETE FROM member WHERE id_member = '$id'";

        // Mengeksekusi query
        return $this->execute($query);
    }

    // Tambahan fungsi jika diperlukan, seperti edit atau status member
}

?>
