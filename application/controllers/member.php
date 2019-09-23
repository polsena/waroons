<?php

class member extends MY_Controller {

    public $page_title = 'ข้อมูลสมาชิก';

    function __construct() {
        parent::__construct();
        $this->load->model('db_m');
        $this->load->model('script_m');
        $this->load->model('member_m');
    }

    function index() {
        $data['page_title'] = $this->page_title;
        $data['content'] = 'admin/member/member_v';
        $this->load->view('admin/template_v', $data);
    }

    function news() {

        $data['page_title'] = $this->page_title . " (เพิ่มข้อมูล)";
        $data['content'] = 'admin/member/member_frm_v';
        $this->load->view('admin/template_v', $data);
    }

    function edit($id, $success = '0') {

        $this->db->where('id', $id);
        $row = $this->db->get('tbmember')->row_array();
        $data['row'] = $row;
        if ($success == '1') {
            $data['msg'] = 'บันทึกข้อมูเสร็จเรียบร้อย';
        }

        $data['page_title'] = $this->page_title;
        $data['content'] = 'admin/member/member_frm_v';
        $this->load->view('admin/template_v', $data);
    }

    //แก้ไขข้อมุลส่วนตัว
    function Profileedit($id, $success = '0') {

        $this->db->where('id', $id);
        $row = $this->db->get('tbmember')->row_array();
        $data['row'] = $row;
        if ($success == '1') {
            $data['msg_text'] = 'แก้ไขข้อมูลส่วนตัวเสร็จเรียบร้อย';
        }



        $data['page_title'] = "แก้ไขข้อมูลสมาชิก";
        $data['content'] = 'admin/member/member_profile_frm_v';
        $this->load->view('admin/template_v', $data);
    }

   
    function ajax_validate() {
        $id = trim($_POST['id']);
        $usename = trim($_POST['username']);

        $data['msg'] = '0';
        if ($this->db_m->validate('tbmember', $id, 'username', $usename)) {
            $data['msg'] = '1';
            $data['msg_text'] = 'ชื่อเข้าใช้งานนี้มีแล้ว ไม่สามารถสร้างซ้ำได้';
        }
        echo json_encode($data);
    }

    function save() {
        $id = $this->input->post('id');
        $password = $this->input->post('password');

        $data = array(
            'name' => $this->input->post('name'),
            'username' => $this->input->post('username'),
            'faculity' => $this->input->post('faculity'),
            'fac_short' => $this->input->post('fac_short'),
            'status' => $this->input->post('status'),
            'mem_type' => $this->input->post('mem_type'),
            'email' => $this->input->post('email'),
           'date' => date("Y-m-d H:i:s")
          
        );

        if ($password != '') {
            $this->load->library('encrypt');
            $data['password'] = $this->encrypt->encode($password);
        }

        if ($id == '') {
            $this->db->insert('tbmember', $data);
            $id = $this->db->insert_id();
        } else {
            $this->db->where('id', $id);
            $this->db->update('tbmember', $data);
        }
        redirect("member/edit/$id/1");
    }

    //บันทึกการแก้ไขข้อมุลส่วนตัว
    function saveprofile() {
        $id = $this->input->post('id');
        $password = $this->input->post('password1');
        
        $data = array(
            'name' => $this->input->post('name'),
            'nickname' => $this->input->post('nickname'),
            //  'username' => $this->input->post('username'),
            'tel' => $this->input->post('tel'),
//            'status' => 1,
//            'mem_type' => $this->input->post('mem_type'),
            'email' => $this->input->post('email'),
            'address' => $this->input->post('address'),
            'lineid' => $this->input->post('lineid'),
            'facebook' => $this->input->post('facebook')
        );

        if ($password != '') {
            $this->load->library('encrypt');
            $data['password'] = $this->encrypt->encode($password);
        }

        if ($id == '') {
            $this->db->insert('tbmember', $data);
        } else {
            $this->db->where('id', $id);
            $this->db->update('tbmember', $data);
        }
        redirect("member/Profileedit/$id/1");
    }

    function ajax_get_grid($offset = 0) {
        $txtsearch = $this->input->post('txtsearch');

        $array = $this->member_m->get_all($txtsearch, $offset);
        $data['query'] = $array['query'];
        $data['pagination'] = $array['pagination'];
        $data['member_m'] = $this->member_m;
        $this->load->view('admin/member/member_grid_v', $data);
    }

    function ajax_delete() {
        $this->db->where('id', $this->input->post('id'));
        $this->db->delete('tbmember');
        echo true;
    }

}

?>
