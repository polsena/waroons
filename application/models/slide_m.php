<?php
class Slide_m extends CI_Model {
    function __construct() {
        parent::__construct();
    }

    function get_all($offset, $per_page = 50, $url = '/slide/ajax_get_grid') {
       
        $total = $this->db->get('tbslide')->num_rows();


        $this->db->limit($per_page, $offset);
        $this->db->order_by('id', 'desc');
        $query = $this->db->get('tbslide')->result_array();

        $this->load->library('pagination');
        $data['pagination'] = $this->pagination->pagin($total, $url, $per_page);
        $data['query'] = $query;
        return $data;
    }
}