<?php
require '../../../config/class.php';
$db = new dbObj();
$connString = $db->getConstring();
$kandidatClass = new Kandidat($connString);

$requestData = $_REQUEST;

$columns = array(    
    0 => 'id',
    1 => 'nama_ketua',
    2 => 'nama_wakil',
    3 => 'photo'
);

$kandidatClass->getData($requestData, $columns);

class Kandidat {
    
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
        $sqlTot .= " FROM master_kandidat";    

        $sql = $sqlTot;

        $qTot = mysqli_query($this->conn, $sqlTot) or die("error fetch data: ");
        $totalData = mysqli_num_rows($qTot);
        $totalFiltered = $totalData;
        
        if(!empty($req['search']['value'])) {

            $sql .= " WHERE nama_ketua LIKE '%" . $req['search']['value'] . "%' ";
            $sql .= " OR nama_wakil LIKE '%".$req['search']['value']."%'";
            
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
            $nestedData[] = $row['nama_ketua'];
            $nestedData[] = $row['nama_wakil'];
            $nestedData[] = '<img src="../'.$row['photo'].'" height="100"/>';

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
}//end class kandidat
