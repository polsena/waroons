<?php
//JSON GET TYPE AND NEWS
class getjson extends CI_Controller {

    function __construct() {
        parent::__construct();
      
    }
     //JSON DATA waroon.rmu.ac.th ip : 202.29.22.2
    //เรียกประเภทข่าว
    function gettypedate() {

        $this->db->order_by('id', 'asc');
        $row = $this->db->get('tbtype')->result_array();

        echo json_encode($row);

    }

//ดึงรายการข่าวทั้งหมดตามประเภท
    public function getDataView($id) {
        $this->db->limit(13);
        $this->db->order_by('id', 'desc');
        $row = $this->db->get_where('tbnews', array('type_id' => $id))->result_array();
        echo json_encode($row);
    }

    public function hello(){
        echo 'ssss';
    }
}
