<?php

class DB
{
    var $db_host = "";
    var $db_user = "";
    var $db_pass = "";
    var $db_name = "";
    var $db_link = null; // Inisialisasi dengan null
    /**
     * @var mixed $result Menyimpan hasil eksekusi query.
     */

    public $result;

    function __construct($db_host, $db_user, $db_pass, $db_name)
    {
        $this->db_host = $db_host;
        $this->db_user = $db_user;
        $this->db_pass = $db_pass;
        $this->db_name = $db_name;
    }

    function open()
    {
        $this->db_link = mysqli_connect($this->db_host, $this->db_user, $this->db_pass, $this->db_name);
        // Periksa apakah koneksi berhasil dibuat
        if (!$this->db_link) {
            die("Connection failed: " . mysqli_connect_error());
        }
    }

    function execute($query, $params = [])
    {
        // Periksa apakah objek koneksi telah dibuat
        if (!$this->db_link) {
            $this->open(); // Jika belum, buka koneksi
        }
        
        // Prepare statement
        $stmt = $this->db_link->prepare($query);
        
        if ($stmt === false) {
            die('Error in query: ' . $this->db_link->error);
        }
        
        // Bind parameters
        if (!empty($params)) {
            $types = str_repeat('s', count($params)); // Assuming all parameters are strings
            $stmt->bind_param($types, ...$params);
        }

        // Execute statement
        $stmt->execute();
        
        // Store result
        $this->result = $stmt->get_result();

        return $this->result;
    }

    function getResult()
    {
        // Periksa apakah objek koneksi telah dibuat
        if (!$this->db_link) {
            $this->open(); // Jika belum, buka koneksi
        }
        return mysqli_fetch_array($this->result);
    }

    function close()
    {
        // Periksa apakah objek koneksi telah dibuat
        if ($this->db_link) {
            mysqli_close($this->db_link); // Jika telah dibuat, tutup koneksi
        }
    }

    function isConnected() {
        return !!$this->db_link;
    }

}
?>
