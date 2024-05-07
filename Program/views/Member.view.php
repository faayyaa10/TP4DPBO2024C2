<?php
include_once "models/Templates.class.php";

class MemberView {
    public function render($members) {
        $header = "
            <tr>
                <th>No</th>
                <th>Name</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Join Date</th>
                <th>Favorite Film</th>
                <th>Actions</th>
            </tr>";

        // Mengurutkan data member berdasarkan ID member
        usort($members['member'], function($a, $b) {
            return $a[0] <=> $b[0];
        });

        $dataMember = null;
        $no = 1; // Variabel untuk menyimpan nomor urut
        if (!empty($members['member'])) { // Memeriksa apakah array member tidak kosong
            foreach ($members['member'] as $val) {
                // Memeriksa apakah elemen dengan kunci yang diakses ada sebelum mengaksesnya
                if (isset($val[0]) && isset($val[1]) && isset($val[2]) && isset($val[3]) && isset($val[4]) && isset($val[5]) && isset($val[6])) {
                    list($id, $nama, $email, $no_telp, $tanggal_join, $id_film, $nama_film) = $val;
                    $dataMember .= "<tbody><tr>
                                        <td>" . $no++ . "</td> <!-- Menampilkan nomor urut -->
                                        <td>" . $nama . "</td>
                                        <td>" . $email . "</td>
                                        <td>" . $no_telp . "</td>
                                        <td>" . $tanggal_join . "</td>
                                        <td>" . $nama_film . "</td>
                                        <td>
                                            <a href='index.php?id_edit=".$id."' class='btn btn-primary'>Edit</a>
                                            <a href='index.php?id_hapus=".$id."' class='btn btn-danger'>Delete</a>
                                        </td>
                                    </tr></tbody>";
                }
            }
        }

        $tpl = new Template("Templates/index.html"); // Anda perlu mendefinisikan kelas Template atau menggantinya dengan cara lain
        $tpl->replace("DATA_HEADER", $header);
        $tpl->replace("DATA_TABEL", $dataMember);
        $Form = "index.php?add=true";
        $tpl->replace("FORM_TAMBAH", $Form);
        $tpl->write();
    }

    public function renderAddForm($films) {
        $formAddForm = '
        <div class="col-lg-6 m-auto">
            <form method="post" action="index.php?add=true">
                <br><br>
                <div class="card">
                    <div class="card-header bg-primary">
                        <h1 class="text-white text-center">Add New Member</h1>
                    </div><br>
                    <label for="nama">Nama:</label>
                    <input type="text" name="nama" id="nama" class="form-control"><br>
                    <label for="email">Email:</label>
                    <input type="text" name="email" id="email" class="form-control"><br>
                    <label for="phone">Phone:</label>
                    <input type="text" name="no_telp" id="phone" class="form-control"><br>
                    <label for="date">Join Date:</label>
                    <input type="date" name="tanggal_join" id="tanggal_join" class="form-control"><br>
                    <label for="id_film">Favorite Film:</label>
                    <select name="id_film" id="id_film" class="form-control">
                        <option value="" disabled selected>Pilih Film</option>'; // Tambahkan opsi default disini
                
        foreach ($films as $film) {
            $formAddForm .= '<option value="' . $film['id_film'] . '">' . $film['nama_film'] . '</option>';
        }                        
    
        $formAddForm .= '
                    </select><br>
                    <button class="btn btn-success" type="submit" name="submit">Submit</button><br>
                    <a class="btn btn-info" href="index.php">Cancel</a><br>
                </div>
            </form>
        </div>';

        $tpl = new Template("Templates/skinform.html"); // Anda perlu mendefinisikan kelas Template atau menggantinya dengan cara lain
        $tpl->replace("DATA_FORM", $formAddForm);
        $tpl->write();
    }

    public function renderEditForm($memberData, $films) {
        if (!empty($memberData)) { // Memeriksa apakah data member tidak kosong
            $id = $memberData[0] ?? '';
            $nama = $memberData[1] ?? '';
            $email = $memberData[2] ?? '';
            $no_telp = $memberData[3] ?? '';
            $tanggal_join = $memberData[4] ?? '';
            $id_film = $memberData[5] ?? '';
            $nama_film = $memberData[6] ?? '';
    
            $formEditForm = '
            <div class="col-lg-6 m-auto">
                <form method="post" action="index.php">
                    <br><br>
                    <div class="card">
                        <div class="card-header bg-primary">
                            <h1 class="text-white text-center">Edit Member</h1>
                        </div><br>
                        <input type="hidden" name="id" value="' . htmlspecialchars($id, ENT_QUOTES) . '">
                        <label for="nama">Nama:</label>
                        <input type="text" name="nama" id="nama" class="form-control" value="' . htmlspecialchars($nama, ENT_QUOTES) . '"><br>
                        <label for="email">Email:</label>
                        <input type="text" name="email" id="email" class="form-control" value="' . htmlspecialchars($email, ENT_QUOTES) . '"><br>
                        <label for="phone">Phone:</label>
                        <input type="text" name="no_telp" id="phone" class="form-control" value="' . htmlspecialchars($no_telp, ENT_QUOTES) . '"><br>
                        <label for="date">Join Date:</label>
                        <input type="date" name="tanggal_join" id="tanggal_join" class="form-control" value="' . htmlspecialchars($tanggal_join, ENT_QUOTES) . '"><br>
                        <label for="id_film">Favorite Film:</label>
                        <select name="id_film" id="id_film" class="form-control">
                            <option value="" disabled>Pilih Film</option>';
    
            foreach ($films as $film) {
                $selected = ($film['id_film'] == $id_film) ? 'selected' : '';
                $formEditForm .= '<option value="' . htmlspecialchars($film['id_film'], ENT_QUOTES) . '" ' . $selected . '>' . htmlspecialchars($film['nama_film'], ENT_QUOTES) . '</option>';
            }
    
            $formEditForm .= '
                        </select><br>
                        <button class="btn btn-success" type="submit" name="submit_edit">Submit</button><br>
                        <a class="btn btn-info" href="index.php">Cancel</a><br>
                    </div>
                </form>
            </div>';
        } else {
            // Jika data member kosong, berikan pesan atau tindakan yang sesuai
            $formEditForm = '<p>Data member tidak tersedia untuk diedit.</p>';
        }

        $tpl = new Template("Templates/skinform.html"); // Anda perlu mendefinisikan kelas Template atau menggantinya dengan cara lain
        $tpl->replace("DATA_FORM", $formEditForm);
        $tpl->write();
    }
}
