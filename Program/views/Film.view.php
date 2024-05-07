<?php
include_once "models/Templates.class.php";

class FilmView {
    public function render($film) {
        
        $header = "
            <tr>
                <th>No</th>
                <th>Nama Film</th>
                <th>Actions</th>
            </tr>";

        // Mengurutkan data film berdasarkan ID film
        usort($film['film'], function($a, $b) {
            return $a[0] <=> $b[0];
        });

        $dataFilm = null;
        $no = 1; // Variabel untuk menyimpan nomor urut
        foreach($film['film'] as $val){
            list($id, $nama_film) = $val;
            $dataFilm .= "<tbody><tr>
                    <td>" . $no++ . "</td> <!-- Menampilkan nomor urut -->
                    <td>" . $nama_film . "</td>
                    <td>
                        <a href='film.php?id_edit=".$id."' class='btn btn-primary'>Edit</a>
                        <a href='film.php?id_hapus=".$id."' class='btn btn-danger'>Delete</a>
                    </td>
                </tr></tbody>";
        }

        $tpl = new Template("Templates/index.html"); // Anda perlu mendefinisikan kelas Template atau menggantinya dengan cara lain
        $tpl->replace("DATA_HEADER", $header);
        $tpl->replace("DATA_TABEL", $dataFilm);
        $Form = "film.php?add=true";
        $tpl->replace("FORM_TAMBAH", $Form);

        $tpl->write();

    }
    public function renderAddForm() {
        $formAddForm = '
        <div class="col-lg-6 m-auto">
            <form method="post" action="film.php?add=true">
                <br><br>
                <div class="card">
                    <div class="card-header bg-primary">
                        <h1 class="text-white text-center">Add New Film</h1>
                    </div><br>
                    <label for="nama_film">Nama Film:</label>
                    <input type="text" name="nama_film" id="nama_film" class="form-control"><br>
                        ';
    
        $formAddForm .= '
                    </select><br>
                    <button class="btn btn-success" type="submit" name="submit">Submit</button><br>
                    <a class="btn btn-info" href="film.php">Cancel</a><br>
                </div>
            </form>
        </div>';
    

        $tpl = new Template("Templates/skinform.html"); // Anda perlu mendefinisikan kelas Template atau menggantinya dengan cara lain
        $tpl->replace("DATA_FORM", $formAddForm);
        $tpl->write();
    }

    public function renderEditForm($filmData) {
        $id = $filmData['id_film'];
        $nama_film = $filmData['nama_film'];
    
        $formEditForm = '
        <div class="col-lg-6 m-auto">
            <form method="post" action="film.php?id_edit=' . $id . '">
                <br><br>
                <div class="card">
                    <div class="card-header bg-primary">
                        <h1 class="text-white text-center">Edit Film</h1>
                    </div><br>
                    <input type="hidden" name="id_film" value="' . $id . '"> <!-- Menambahkan input tersembunyi untuk menyimpan ID film -->
                    <label for="nama_film">Nama Film:</label>
                    <input type="text" name="nama_film" id="nama_film" class="form-control" value="' . $nama_film . '"><br>
                    <button class="btn btn-success" type="submit" name="submit_edit">Submit</button><br>
                    <a class="btn btn-info" href="film.php">Cancel</a><br>
                </div>
            </form>
        </div>';
    
        $tpl = new Template("Templates/skinform.html"); // Anda perlu mendefinisikan kelas Template atau menggantinya dengan cara lain
        $tpl->replace("DATA_FORM", $formEditForm);
        $tpl->write();
    }
    
    
}