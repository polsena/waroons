<?php
//ทลบ
class student_m_1 extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function get_all($txtsearch, $offset, $per_page = 50, $url = '/student_1/ajax_get_grid') {
        $sql = "SELECT * FROM  sp2_57_BachelorofTechnology";

        if ($txtsearch != '') {
            $sql.= " Where (name like '%$txtsearch%') or (std_code like '%$txtsearch%')";
        }
        $total = $this->db->query($sql)->num_rows();


        $sql.= "  Order by order_no  asc limit $offset, $per_page";
        $query = $this->db->query($sql)->result_array();

        $this->load->library('pagination');
        $data['pagination'] = $this->pagination->pagin($total, $url, $per_page);
        $data['query'] = $query;
        return $data;
    }
}