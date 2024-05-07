<?php
include_once("models/DB.class.php");
include_once("models/Member.class.php");
include_once("models/Film.class.php");
include_once "conf.php"; // Pastikan file Conf.php di-import dengan benar
include_once "views/Member.view.php"; // Import file Member.view.php untuk mendapatkan definisi kelas MemberView

class MemberController {
    private $member;
    private $film;
  
    function __construct(){
      $this->member = new Member(conf::$db_host, conf::$db_user, conf::$db_pass, conf::$db_name);
      $this->film = new FilmClass(conf::$db_host, conf::$db_user, conf::$db_pass, conf::$db_name);
    }
  
    public function index() {
      $this->member->open();
      $this->member->getAllMember();

      $data = array(
        'member' => array(),
      );
      while($row = $this->member->getResult()){
        array_push($data['member'], $row);
      }
  
      $this->member->close();
  
      $view = new MemberView();
      $view->render($data);
      
    }

    function getFilms() {
      $this->film->open();
      $this->film->getAllFilm();
    
      $films = array();
      while($row = $this->film->getResult()){
          $films[] = $row;
      }
  
      $this->film->close();
  
      return $films;
  }
  
  function addForm(){
    // Dapatkan daftar film untuk ditampilkan dalam formulir
    $films = $this->getFilms();

    // Memanggil fungsi renderAddForm dengan memberikan daftar film
    $view = new MemberView();
    $view->renderAddForm($films);
  }

  function addData($nama, $email, $no_telp, $tanggal_join, $id_film){
    // Memanggil fungsi add pada model Member dengan data yang diterima
    $result = $this->add(array(
        'nama' => $nama,
        'email' => $email,
        'no_telp' => $no_telp,
        'tanggal_join' => $tanggal_join,
        'id_film' => $id_film
    ));

    return $result; // Mengembalikan hasil operasi tambah
  }

  function add($data){
    $this->member->open();
    $result = $this->member->add($data);
    $this->member->close();
    
    return $result; // Mengembalikan hasil operasi tambah
  }
  
  function editForm($id) {
    // Mengambil data member yang akan diedit berdasarkan ID
    $memberData = $this->member->getMemberById($id);

    // Memastikan data member tersedia sebelum menampilkan formulir edit
    if ($memberData) {
        // Dapatkan daftar film untuk ditampilkan dalam formulir
        $films = $this->getFilms();

        // Memanggil fungsi renderEditForm dengan data member dan daftar film
        $view = new MemberView();
        $view->renderEditForm($memberData, $films);
    } else {
        // Tampilkan pesan kesalahan jika data member tidak ditemukan
        echo "Data member tidak ditemukan.";
    }
  }


function editData($id, $nama, $email, $no_telp, $tanggal_join, $id_film) {
    // Memanggil fungsi edit pada model Member dengan data yang diterima
    $result = $this->member->edit($id, array(
        'nama' => $nama,
        'email' => $email,
        'no_telp' => $no_telp,
        'tanggal_join' => $tanggal_join,
        'id_film' => $id_film
    ));

    return $result; // Mengembalikan hasil operasi edit
}


  function deleteData($id){
    $this->member->open();
    $this->member->delete($id);
    $this->member->close();

    header("location:index.php");
  }

}
?>
