<?php

require '../../../config/class.php';

$db = new dbObj();
$connString = $db->getConstring();
$eClass = new Pemilih($connString);
$tb_name = "data_pemilih";

$requestData = $_REQUEST;

$columns = array(        
    0 => 'kelas',
    1 => 'nama_peserta',
    2 => 'no_reg',
    3 => 'status_vote'
);

$eClass->getData($requestData, $columns, $tb_name);

class Pemilih  {
    
    protected $conn;
    protected $data = [];

    function __construct($connString) {
        $this->conn = $connString;
    }

    public function getData($req, $col, $tb_name) {
        $this->data = $this->getRecords($req, $col, $tb_name);
        echo json_encode($this->data);
    }

    function getRecords($req, $col, $tb_name) {                

        $sqlTot = "SELECT no_reg, nama_peserta, kelas, CASE WHEN status_vote = 0 THEN 'Belum memilih' ELSE 'Sudah memilih' END AS status_vote";
        $sqlTot .= " FROM ". $tb_name;    

        $sql = $sqlTot;

        $qTot = mysqli_query($this->conn, $sqlTot) or die("error fetch data: ");
        $totalData = mysqli_num_rows($qTot);
        $totalFiltered = $totalData;
        
        if(!empty($req['search']['value'])) {

            $sql .= " WHERE nama_peserta LIKE '%" . $req['search']['value'] . "%' ";
            $sql .= " OR status_vote LIKE '%" . $req['search']['value'] . "%' ";
            
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
            
            $nestedData[] = $row['no_reg'];
            $nestedData[] = $row['nama_peserta'];
            $nestedData[] = $row['kelas'];
            $nestedData[] = $row['status_vote'];
            
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
}//end class pemilih