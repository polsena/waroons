<?php

class intro extends MY_Controller {

    public $page_title = 'Intro Homepage';

    function __construct() {
        parent::__construct();
        $this->load->model('script_m');
        $this->load->model('intro_m');
        $this->load->model('select_m');
        $this->load->library('myfile');
        $this->load->library('mydate');
    }

    function index() {
        $data['extraHeadContent'] = $this->script_m->calendar();
        $data['extraHeadContent'].= $this->script_m->ckeditor();
        $data['ckeditor'] = $this->script_m->get_ckeditor('detail');
        $data['page_title'] = $this->page_title;
        $data['content'] = 'admin/intro/intro_frm_v';
        $this->load->view('admin/template_v', $data);
    }

    function news() {
        $data['extraHeadContent'] = $this->script_m->calendar();
        $data['extraHeadContent'].= $this->script_m->ckeditor();
        $data['ckeditor'] = $this->script_m->get_ckeditor('detail');
        $this->db->order_by('id');
        $data['slide'] = $this->db->get('tbintro')->result_array();

        $data['page_title'] = $this->page_title . " (เพิ่มข้อมูล)";
        $data['content'] = 'admin/intro/intro_frm_v';
        $this->load->view('admin/template_v', $data);
    }

    function edit($id, $success = '0') {

        $data['extraHeadContent'] = $this->script_m->calendar();
        $data['extraHeadContent'].= $this->script_m->ckeditor();
        $data['ckeditor'] = $this->script_m->get_ckeditor('detail');

        $this->db->where('id', $id);
        $row = $this->db->get('tbintro')->row_array();
        $data['row'] = $row;
        if ($success == '1') {
            $data['msg_text'] = 'บันทึกข้อมูเสร็จเรียบร้อย';
        }

        $this->db->order_by('id');
        $data['slide'] = $this->db->get('tbintro')->result_array();

        $data['page_title'] = $this->page_title . "(แก้ไข)";
        $data['content'] = 'admin/intro/intro_frm_v';
        $this->load->view('admin/template_v', $data);
    }

    function save() {
        $s_login = $this->session->userdata('s_login');
        $user_id = $s_login['login_id'];
        $id = $this->input->post('id');
        //upload file pdf , doc , zip
        if (isset($_FILES['filename'])) {
            $file_temp = $_FILES['filename']['tmp_name'];
            $file_name = basename($_FILES['filename']['name']);
            $name = $_FILES['filename']['name'];

            // rename
            $ext_file = explode(".", $file_name);
            $ext_file = $ext_file[count($ext_file) - 1];
            $file_name = md5(microtime()) . "." . $ext_file;

            // upload here
            if ($name != "") {
                if (move_uploaded_file($file_temp, "assets/upload/intro/file/" . $file_name)) {
                    $data['filename'] = $name;
                    $data['filetmp'] = $file_name;
                    //        print_r($data) ;
                    if ($id == '') {
                        $this->db->insert('tbintro', $data);
                        $id = $this->db->insert_id();
                    } else {
                        $this->db->where('id', $id);
                        $this->db->update('tbintro', $data);
                    }
                }
            }
        }



        $config['upload_path'] = './assets/upload/intro/';
        $config['allowed_types'] = 'gif|jpg|png';
//            $config['max_size'] = '10024';
//            $config['max_width'] = '1024';
//            $config['max_height'] = '768';
        $this->load->library('upload', $config);
        $this->upload->do_upload();

        $data = $this->upload->data();
        $config['image_library'] = 'gd2';
        $config['source_image'] = $data['full_path'];
        $config['create_thumb'] = TRUE;
        $config['maintain_ratio'] = TRUE;
        $config['width'] = 880;
        $config['height'] = 340;
        $this->load->library('image_lib', $config);
        $this->image_lib->resize();

        $file = array(
            'user_id' => $user_id,
            'url' => $this->input->post('url'),
            'status' => $this->input->post('status'),
            'topic' => $this->input->post('topic'),
            'detail' => $this->input->post('detail'),
            'created' => date('Y-m-d H:i:s'),
            'img_name' => $data['raw_name'],
            'thumb_name' => $data['raw_name'] . '_thumb',
            'ext' => $data['file_ext'],
        );

        if ($id == '') {
            $this->db->insert('tbintro', $file);
            $id = $this->db->insert_id();
        } else {
            $this->db->where('id', $id);
            $this->db->update('tbintro', $file);
        }



        redirect("intro");
    }

    function ajax_get_grid($offset = 0) {

        $array = $this->intro_m->get_all($offset);
        $data['query'] = $array['query'];
        $data['pagination'] = $array['pagination'];
        $data['intro_m'] = $this->intro_m;
        $data['select_m'] = $this->select_m;
        $this->load->view('admin/intro/intro_grid_v', $data);
    }

    function ajax_delete() {
        $id = $this->input->post('id');
        //ลบรูปภาพ
        $this->db->where('id', $id);
        $row = $this->db->get('tbintro')->row_array();
        if (count($row) > 0) {
            $full_path = $this->myfile->GetPhysicalFromURL() . 'assets/upload/intro/';
            $file_path = $this->myfile->GetPhysicalFromURL() . 'assets/upload/intro/file/';
            $img_name = $full_path . $row['img_name'];
            if ($row['img_name'] != '') {
                if (file_exists($img_name)) {
                    //ตรวจสอบว่ามีไฟล์ตามรหัสนี้หรือยัง
                    unlink($img_name);
                }
            }
            $thumb_name = $full_path . $row['thumb_name'];
            if ($row['thumb_name'] != '') {
                if (file_exists($thumb_name)) {
                    //ตรวจสอบว่ามีไฟล์ตามรหัสนี้หรือยัง
                    unlink($thumb_name);
                }
            }

            $filetmp = $file_path . $row['filetmp'];
            if ($row['thumb_name'] != '') {
                if (file_exists($filetmp)) {
                    //ตรวจสอบว่ามีไฟล์ตามรหัสนี้หรือยัง
                    unlink($filetmp);
                }
            }
        }
        $this->db->where('id', $id);
        $this->db->delete('tbintro');
        echo true;
    }

}
