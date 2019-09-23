<?php
class typenews_m extends CI_Model {
    function __construct() {
        parent::__construct();
    }

    function get_all($txtsearch, $offset, $per_page = 20, $url = '/typenews/ajax_get_grid') {
        if ($txtsearch != '') {
            $this->db->like('type_name',$txtsearch);
           
        }
        $total = $this->db->get('tbtype')->num_rows();

        if ($txtsearch != '') {
            $this->db->like('type_name',$txtsearch);
           
        }
        $this->db->limit($per_page, $offset);
        $this->db->order_by('id', 'asc');
        $query = $this->db->get('tbtype')->result_array();

        $this->load->library('pagination');
        $data['pagination'] = $this->pagination->pagin($total, $url, $per_page);
        $data['query'] = $query;
        return $data;
    }
}
?>
