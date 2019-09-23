<?php

class member_m extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function get_all($txtsearch, $offset, $per_page = 20, $url = '/member/ajax_get_grid') {
        $sql = "SELECT * FROM tbmember";

        if ($txtsearch != '') {
            $sql.= " Where (name like '%$txtsearch%') or (username like '%$txtsearch%')";
            $sql.= " or (email like '%$txtsearch%')";
        }
        $total = $this->db->query($sql)->num_rows();


        $sql.= "  Order by name limit $offset, $per_page";
        $query = $this->db->query($sql)->result_array();

        $this->load->library('pagination');
        $data['pagination'] = $this->pagination->pagin($total, $url, $per_page);
        $data['query'] = $query;
        return $data;
    }

    //แสดงข้อมูลของลูกทีม
     function GetworkforceById($counselor,$txtsearch, $offset, $per_page = 20, $url = '/admin/ajax_get_grid') {
        if ($txtsearch != '') {
            $this->db->like('name',$txtsearch);
            $this->db->or_like('email',$txtsearch);
            $this->db->where('counselor',$counselor);
        }
        $this->db->where('counselor',$counselor);
        $total = $this->db->get('tbmember')->num_rows();

        if ($txtsearch != '') {
            $this->db->like('name',$txtsearch);
            $this->db->or_like('email',$txtsearch);
            $this->db->where('counselor',$counselor);
        }
        $this->db->limit($per_page, $offset);
        $this->db->order_by('id', 'asc');
        $this->db->where('counselor',$counselor);
        $query = $this->db->get('tbmember')->result_array();

        $this->load->library('pagination');
        $data['pagination'] = $this->pagination->pagin($total, $url, $per_page);
        $data['query'] = $query;

        return $data;
    }
    
    function display_status($status) {
        //0=รอการอนุมัติ,1=ปกติ,2=ระงับการใช้งาน
        $ret = '';
        switch ($status) {
            case '0':
                 //สถานะ รออนุมัติ
                $ret = '<img src ="'.base_url().'assets/admin/img/loading.gif"/>';
                break;
            case '1':
                //สถานะ ใช้งานปกติ
                $ret = '<img src ="'.base_url().'assets/admin/img/checked.gif"/>';
                break;
            case '2':
                //สถานะ ระงับการใช้งาน
                $ret = '<img src ="'.base_url().'assets/admin/img/unchecked.gif"/>';
                break;
                
        }
        return $ret;
    }

    function display_memtype($memtype) {
  
        $ret = '';
        switch ($memtype) {
            
            case '1':
                $ret = '<span class ="label label-primary">ผู้ดูแลระบบ</span>';
                break;
            case '2':
                $ret = '<span class="label label-success">ผู้ประกาศข่าวประจำหน่วยงาน</span>';
                 
                break;
                
        }
        return $ret;
    }

}

?>
