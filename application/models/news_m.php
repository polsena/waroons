<?php

class News_m extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function get_all($txtsearch, $offset, $per_page = 20, $url = '/news/ajax_get_grid') {

        $sql = "SELECT * FROM tbnews";

        if ($txtsearch != '') {
            $sql.= " Where (topic like '%$txtsearch%') or (detail like '%$txtsearch%')";
        }
        $total = $this->db->query($sql)->num_rows();


        $sql.= "  Order by id desc limit $offset, $per_page";
        $query = $this->db->query($sql)->result_array();

        $this->load->library('pagination');
        $data['pagination'] = $this->pagination->pagin($total, $url, $per_page);
        $data['query'] = $query;
        return $data;
    }

    //แสดงหน้า admin
    function get_allUpdate($txtsearch, $offset, $per_page = 20, $url = '/news/ajax_get_grid_v') {

        $s_login = $this->session->userdata('s_login');
        if ($s_login['login_type'] == 1) {
            $sql = "SELECT * FROM tbnews where (user_id like '%$txtsearch%')";
        } else {
            $sql = "SELECT * FROM tbnews where user_id ={$s_login['login_id']}";
        }

        if ($txtsearch != '') {
            $sql.= " and (user_id like '%$txtsearch%')";
        }
        $total = $this->db->query($sql)->num_rows();


        $sql.= "  Order by id desc limit $offset, $per_page";
        $query = $this->db->query($sql)->result_array();

        $this->load->library('pagination');
        $data['pagination'] = $this->pagination->pagin($total, $url, $per_page);
        $data['query'] = $query;
        return $data;
    }

    //แสดงหน้า admin
    function get_all_type($txtsearch, $id, $offset, $per_page = 20, $url = '/news/ajax_get_grid') {

        $s_login = $this->session->userdata('s_login');
        if ($s_login['login_type'] == 1) {
            $sql = "SELECT * FROM tbnews";
        } else {
            $sql = "SELECT * FROM tbnews where type_id ={$id} and user_id ={$s_login['login_id']}";
        }


        if ($txtsearch != '') {
            $sql.= " Where (user_id like '%$txtsearch%') or (detail like '%$txtsearch%')";
        }
        $total = $this->db->query($sql)->num_rows();


        $sql.= "  Order by id desc limit $offset, $per_page";
        $query = $this->db->query($sql)->result_array();

        $this->load->library('pagination');
        $data['pagination'] = $this->pagination->pagin($total, $url, $per_page);
        $data['query'] = $query;
        return $data;
    }

    // แสดงหน้าเว็บ
    function get_allUpdateHome($txtsearch, $offset, $per_page = 50, $url = '/home/ajax_get_grid_v') {

        $sql = "SELECT * FROM tbnews";

        if ($txtsearch != '') {
            $sql.= " Where (topic like '%$txtsearch%') or (user_id like '%$txtsearch%')";
        }
        $total = $this->db->query($sql)->num_rows();


        $sql.= "  Order by id desc limit $offset, $per_page";
        $query = $this->db->query($sql)->result_array();

        $this->load->library('pagination');
        $data['pagination'] = $this->pagination->pagin($total, $url, $per_page);
        $data['query'] = $query;
        return $data;
    }

    //แสดงหน้า home ตามประเภทข่าวที่เลือก
    function get_all_Hometype($txtsearch, $id, $offset, $per_page = 50, $url = '/home/ajax_get_grid_type') {


        $sql = "SELECT * FROM tbnews where type_id ={$id}";

        if ($txtsearch != '') {
            $sql.= " and (user_id like '%$txtsearch%')";
        }
        $total = $this->db->query($sql)->num_rows();


        $sql.= "  Order by id desc limit $offset, $per_page";
        $query = $this->db->query($sql)->result_array();

        $this->load->library('pagination');
        $data['pagination'] = $this->pagination->pagin($total, $url, $per_page);
        $data['query'] = $query;
        return $data;
    }

     //get ข้อมูลทุกรายการโดยกรองตามเงื่อนไข และแสดงหน้าละ 20 รายการ
    function search($user_id, $offset, $per_page = 20, $url = '/home/search') {

        $total = $this->db->get_where('tbnews',array('user_id'=>$user_id))->num_rows();

        if ($user_id != ''){
            $this->db->where('user_id', $user_id);
        }
        $this->db->limit($per_page, $offset);
        $this->db->order_by('id', 'desc');
        $query = $this->db->get('tbnews')->result_array();

        $this->load->library('pagination');
        $data['page_links'] = $this->pagination->pagin($total, $url, $per_page);
        $data['total'] = $total;

        $data['query'] = $query;
        return $data;
    }
}
