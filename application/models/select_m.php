<?php

class select_m extends CI_Model {

    function __construct() {
        parent::__construct();
    }


    //ประเภทข่าว
   function type_news($id) {
        $this->db->where('id',$id);
        $row = $this->db->get('tbtypenews')->row_array();
        if(count($row)==0) {
            $row['name'] = '';
        }

        return $row;
    }

    function slide_status($type) {
        $ret = '';
        switch ($type) {
            case '1':
                $ret = 'แสดง';
                break;
            case '2':
                $ret = 'ไม่แสดง';
                break;
        }
        return $ret;
    }
      

}
