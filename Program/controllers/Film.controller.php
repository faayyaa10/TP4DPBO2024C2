<?php
include_once("models/DB.class.php");
include_once("models/Film.class.php");
include_once("views/Film.view.php");
include_once("conf.php");

class FilmController {
    private $db;
    private $film;

    function __construct(){
        $this->db = new DB(Conf::$db_host, Conf::$db_user, Conf::$db_pass, Conf::$db_name);
        $this->film = new FilmClass(Conf::$db_host, Conf::$db_user, Conf::$db_pass, Conf::$db_name); // inisialisasi properti $film
    }

    public function index() {
        $this->film->open();
        $this->film->getAllFilm();
  
        $data = array(
          'film' => array(),
        );
        while($row = $this->film->getResult()){
          array_push($data['film'], $row);
        }
    
        $this->film->close();
    
        $view = new FilmView();
        $view->render($data);
        
      }
    
      function addFormFilm(){
        // Memanggil fungsi renderAddForm dengan filmikan daftar film
        $view = new FilmView();
        $view->renderAddForm();
      }

      function addFilm($nama_film){
        // Memanggil fungsi add pada model film dengan data yang diterima
        $result = $this->add(array(
            'nama_film' => $nama_film,
        ));
      
        return $result; // Mengembalikan hasil operasi tambah
      }
      
      function add($data){
        $this->film->open();
        $result = $this->film->add($data);
        $this->film->close();
        
        return $result; // Mengembalikan hasil operasi tambah
      }

      function editFormFilm($id){
        // Dapatkan data film yang akan diedit berdasarkan ID
        $filmData = $this->film->getFilmById($id);
        
        // Memanggil fungsi renderEditForm dengan memberikan data film yang akan diedit
        $view = new FilmView();
        $view->renderEditForm($filmData);
    }
    
    function edit($id, $nama_film){
        // Memanggil fungsi edit pada model film dengan data yang diterima
        $result = $this->film->edit($id, $nama_film);
        
        return $result; // Mengembalikan hasil operasi edit
    }
    

    function deleteFilm($id){
      $this->film->open();
      $this->film->delete($id);
      $this->film->close();
  
      header("location:film.php");
    }
}
