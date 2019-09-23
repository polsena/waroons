<?php

class news extends MY_Controller {

    var $page_title = "รายการข่าวในระบบ";
    var $tbname = 'tbnews';

    function __construct() {
        parent::__construct();
        $this->load->model('script_m');
        $this->load->model('news_m');
        $this->load->model('select_m');


    }

    function index($id = '') {
        $data['id'] = $id;
        $data['page_title'] = $this->page_title;
        $data['content'] = 'admin/news/news_v';
        $this->load->view('admin/template_v', $data);
    }

    function add() {
        

        $data['extraHeadContent'] = $this->script_m->calendar();
        $data['extraHeadContent'].= $this->script_m->ckeditor();
        $data['ckeditor'] = $this->script_m->get_ckeditor('detail');


        $this->db->order_by('id', 'asc');
        $data['typenews'] = $this->db->get('tbtype')->result_array();

        $data['page_title'] = $this->page_title . " (เพิ่ม)";
        $data['content'] = 'admin/news/news_frm_v';
        $this->load->view('admin/template_v', $data);
    }

    function save() {
        $id = $this->input->post('id');

        $s_login = $this->session->userdata('s_login');
        $user_id = $s_login['login_id'];
        $data = array(
           'topic' => $this->security->xss_clean($this->input->post('topic')),
            'date' => date("Y-m-d H:i:s"),
            // 'name' => $this->input->post('name'),
            'detail' => $this->input->post('detail'),
            'status' => $this->security->xss_clean($this->input->post('status')),
            'quick' => $this->security->xss_clean($this->input->post('quick')),
            'user_id' => $user_id,
            'type_id' => $this->security->xss_clean($this->input->post('type_id'))
        );
         if ($id != 0) {
            $this->db->where('id', $id);
            $this->db->update($this->tbname, $data);
        } else {
            $this->db->insert($this->tbname, $data);
            $id = $this->db->insert_id();
        }

    //upload file การประชุม
            $file_element_name = 'filename';
            $config['upload_path'] = './assets/upload/file/';
            $config['encrypt_name'] = TRUE;
            $config['allowed_types'] = '*';
            $config['max_size'] = 20480;

            $this->load->library('upload', $config);
            if ($this->upload->do_upload($file_element_name)) {
                //$this->upload->do_upload($file_element_name);
                $data_file = $this->upload->data();
                $data = array(
                    'filename' => $data_file['orig_name'],
                    'filetmp' => $data_file['file_name'],
                    'file_size' => $data_file['file_size'],
                    //'file_fullpath' => $data_file['full_path']
                );

              if ($id != 0) {
            $this->db->where('id', $id);
            $this->db->update($this->tbname, $data);
        } else {
            $this->db->insert($this->tbname, $data);
            $id = $this->db->insert_id();
        }
            }

        redirect('news/edit/' . $id . '/1');
    }

    function edit($id, $success = '0') {
        $data['extraHeadContent'] = $this->script_m->calendar();
        $data['extraHeadContent'].= $this->script_m->ckeditor();

        $this->db->order_by('id', 'asc');
        $data['typenews'] = $this->db->get('tbtype')->result_array();

        $data['ckeditor'] = $this->script_m->get_ckeditor('detail');

        $this->db->where('id', $id);
        $row = $this->db->get($this->tbname)->row_array();
        $data['row'] = $row;

        if ($success == '1') {
            $data['msg_text'] = 'บันทึกข้อมูเสร็จเรียบร้อย';
        }

        $data['mydate'] = $this->mydate;
        $data['page_title'] = $this->page_title . " (แก้ไข)";
        $data['content'] = 'admin/news/news_frm_v';
        $this->load->view('admin/template_v', $data);
    }

    function ajax_validate() {
        $id = trim($_POST['id']);
        $name_research = trim($_POST['topic']);

        $data['msg'] = '0';
        if ($this->db_m->validate('tbnews', $id, 'topic', $name_research)) {
            $data['msg'] = '1';
            $data['msg_text'] = 'รายการนี้มีแล้ว ไม่สามารถสร้างซ้ำได้';
        }
        echo json_encode($data);
    }

    function ajax_get_grid($offset = 0) {
        $txtsearch = $this->input->post('txtsearch');
         $id = $this->input->post('id');
//update view
//        $sql = "update tbnews set view = view+1 where id =" . $id;
//        mysql_query($sql);
        $array = $this->news_m->get_all_type($txtsearch,$id,$offset);
        $data['query'] = $array['query'];
        $data['pagination'] = $array['pagination'];

        $data['mydate'] = $this->mydate;

        $this->load->view('admin/news/news_grid_v', $data);
    }

    function ajax_get_grid_v($offset = 0) {
        $txtsearch = $this->input->post('txtsearch');

        $array = $this->news_m->get_allUpdate($txtsearch, $offset);
        $data['query'] = $array['query'];
        $data['pagination'] = $array['pagination'];

        $data['mydate'] = $this->mydate;

        $this->load->view('admin/news/content_grid_v', $data);
    }

    function ajax_delete() {
        $this->db->where('id', $this->input->post('id'));
        $this->db->delete('tbnews');
        echo true;
    }

}
