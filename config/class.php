<?php

class dbObj {

    var $DB_Host = "localhost"; //koneksi localhost
    // var $DB_Host = "192.168.0.128"; //koneksi ip/domain
    var $DB_Name = "evote"; //nama database
    var $DB_User = "root"; //user database
    // var $DB_Pass = "password"; //password database
    var $DB_Pass = ""; //no password
    var $conn;

    function getConstring() {
        $con = mysqli_connect($this->DB_Host, $this->DB_User, $this->DB_Pass, $this->DB_Name) or
                die("Connection failed: " . mysqli_connect_error());

        if (mysqli_connect_errno()) {
            printf("Connect failed: %s\n", mysqli_connect_error());
            exit();
        } else {
            $this->conn = $con;
        }

        return $this->conn;
    }

}

class Main {

    function get_page() {
        if (!isset($_GET['page'])) {
            include_once 'view/home.php';
        } else {
            $pages = htmlentities($_GET['page']);
            $page_root = "view/" . $pages . ".php";

            if (file_exists($page_root)) {
                include_once $page_root;
            } elseif ($_GET['page'] == "logout") {
                $db = new dbObj();
                $connString = $db->getConstring();
                $user = new User($connString);
                $user->logout();
            } else {
                include_once 'model/404.php';
            }
        }
    }

    function get_head() {
        include_once 'model/head.php';
    }

    function get_topbar() {
        include_once 'model/topbar.php';
    }

    function get_menu() {
        include_once 'model/menu.php';
    }

    function get_login_page() {
        include_once 'model/login.php';
    }

    function getActScript() {
        if (isset($_GET['page'])) {
            $page = htmlentities($_GET['page']);
            if($page != "logout") {
                $actRoot = "application/" . $page . "/script.js";

                echo '<script src="' . $actRoot . '"></script>';
            }
            
        }  else {
            $page = "home";
            $actRoot = "application/" . $page . "/script.js";

            echo '<script src="' . $actRoot . '"></script>';
        }
    }

}//end Main Class

class User {

    protected $conn;
    protected $data = [];
    
    function __construct($connString) {
        $this->conn = $connString;
    }
    
    public function getData($req, $col) {
        $this->data = $this->getRecords($req, $col);
        echo json_encode($this->data);
    }

    function getRecords($req, $col) {                

        $sqlTot = "SELECT *";
        $sqlTot .= " FROM master_user";    

        $sql = $sqlTot;
        
        $qTot = mysqli_query($this->conn, $sqlTot) or die("error fetch data: ");
        
        $totalData = mysqli_num_rows($qTot);
        $totalFiltered = $totalData;
        
        if(!empty($req['search']['value'])) {

            $sql .= " WHERE username LIKE '%" . $req['search']['value'] . "%' ";
            $sql .= " OR fullname LIKE '%" . $req['search']['value'] . "%' ";
            
            $query = mysqli_query($this->conn, $sql) or die("ajax-grid-data.php: get PO");
            $totalFiltered = mysqli_num_rows($query);

            $sql .=" ORDER BY " . $col[$req['order'][0]['column']] . " " . 
            $req['order'][0]['dir'] . " LIMIT " . $req['start'] . " ," . $req['length'] . " "; 
            $query = mysqli_query($this->conn, $sql) or die("ajax-grid-data.php: get PO"); 

        }else{

            $sql .=" ORDER BY " . $col[$req['order'][0]['column']] . " 
            " . $req['order'][0]['dir'] . " LIMIT " . $req['start'] . " ,
            " . $req['length'] . " ";
            $query = mysqli_query($this->conn, $sql) or die("ajax-grid-data.php: get PO");
        }

        $user = new User($this->conn);

        while ($row = mysqli_fetch_assoc($query)) {
            $nestedData = [];
            
            $nestedData[] = $user->linkAct($row['id']);
            $nestedData[] = $row['username'];
            $nestedData[] = $row['fullname'];
            $nestedData[] = $row['role'];
            
            $data[] = $nestedData;            
        }

        if($totalData > 0) {
            $json_data = array(
                "draw" => intval($req['draw']), 
                "recordsTotal" => intval($totalData), 
                "recordsFiltered" => intval($totalFiltered), 
                "data" => $data
            );
        }else{
            $json_data = array(
                "draw" => 0,
                "recordsTotal" => 0,
                "recordsFiltered" => 0,
                "data" => []
            );
        }

        return $json_data;
    }

    public function linkAct($id) {

        return '
        <div class="text-center">
        <a href="#" id="' . $id . '" class="act_btn text-success" data-toggle="tooltip" data-placement="top" data-original-title="Edit" title="Edit">
        <i class="fa fa-pencil-square-o fa-fw"></i>                                    
        </a>
        <a href="#" id="' . $id . '" class="act_btn text-danger" data-toggle="tooltip" data-placement="top" data-original-title="Delete" title="Delete">
        <i class="fa fa-trash fa-fw"></i>                                    
        </a>
        </div>';
    }

    function logout() {
        session_destroy();
        echo '<meta http-equiv="refresh" content="0;url=index.php" >';
    }

}//end class user
