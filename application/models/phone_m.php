<?php

class phone_m extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function get_all($txtsearch, $offset, $per_page = 20, $url = '/phone/ajax_get_grid') {
        $sql = "SELECT * FROM tbrmuphone";

        if ($txtsearch != '') {
            $sql.= " Where (name like '%$txtsearch%') or (fuculty like '%$txtsearch%')";
        }
        $total = $this->db->query($sql)->num_rows();


        $sql.= "  Order by name limit $offset, $per_page";
        $query = $this->db->query($sql)->result_array();

        $this->load->library('pagination');
        $data['pagination'] = $this->pagination->pagin($total, $url, $per_page);
        $data['query'] = $query;
        return $data;
    }
}