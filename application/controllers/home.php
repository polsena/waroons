<?php

class home extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('script_m');
        $this->load->model('news_m');
        $this->load->model('member_m');
        $this->load->model('select_m');
    }

    /*
     * index
     */

    function index() {
        $data['content'] = "home/content_v";
        $this->load->view('home/template_v', $data);
    }

    //load news show
    function ajax_get_grid_v($offset = 0) {
        $txtsearch = $this->input->post('txtsearch');

//update view
//        $sql = "update tbnews set view = view+1 where id =" . $id;
//        mysql_query($sql);
        $array = $this->news_m->get_allUpdateHome($txtsearch, $offset);
        $data['query'] = $array['query'];
        $data['pagination'] = $array['pagination'];

        $data['mydate'] = $this->mydate;
        $data['select_m'] = $this->select_m;
        $this->load->view('home/content_grid_v', $data);
    }

    /*
     * 
     * get type
     */

    function GetByID($id = '') {

        $r = $this->db->get_where('tbtype',array('type_name_en' => $id))->row_array();
        $type_id = $r['id'];
       // $data['type_name']  = $r['type_name'];
        //$id = (int)$_GET['id']; //วิธีนี้ถูกต้อง
        //$r = $this->db->get_where('tbtype',array('id' => (int)$id))->row_array();
        //$type_id = $r['id'];

        $data['rs'] = $this->db->get_where('tbtype',array('id' => $type_id))->row_array();
        $data['content'] = "home/content_type_v";
        $this->load->view('home/template_v', $data);
    }

    //load news show news type
    function ajax_get_grid_type($offset = 0) {
        $txtsearch = $this->input->post('txtsearch');
        $id = $this->input->post('id');

        $array = $this->news_m->get_all_Hometype($txtsearch, $id, $offset);
        $data['query'] = $array['query'];
        $data['pagination'] = $array['pagination'];

        $data['mydate'] = $this->mydate;
        $data['select_m'] = $this->select_m;
        $this->load->view('home/content_type_grid_v', $data);
    }

    //อ่านข่าว
    function ReadNew($id = NULL) {
        //update view
        $sql = "update tbnews set view = view+1 where id =" . $id;
        $this->db->query($sql);

        $data['rs'] = $this->db->get_where('tbnews', array('id' => $id))->row_array();

        //แสดงประเภทข่าว
        $data['type'] = $this->db->get_where('tbtype', array('id' => $data['rs']['type_id']))->row_array();
        //ผู้ประกาศ
        $data['user'] = $this->db->get_where('tbmember', array('id' => $data['rs']['user_id']))->row_array();

        $data['mydate'] = $this->mydate;
        $data['content'] = "home/detail/index_v";
        $this->load->view('home/template_v', $data);
    }
    
      //อ่านข่าว
    function ReadSlider($id = NULL) {
          //update view
        $sql = "update tbslide set view = view+1 where id =" . $id;
        mysql_query($sql);
        
        $this->db->where('id',$id);
        $data['rs'] = $this->db->get('tbslide')->row_array();
        $data['page_title'] = $data['rs']['topic'];

        //ผู้ประกาศ
        $data['user'] = $this->db->get_where('tbmember', array('id' => $data['rs']['user_id']))->row_array();

        $data['mydate'] = $this->mydate;
        $data['content'] = "home/detail/slider_content_v";
        $this->load->view('home/template_v', $data);
    }

    // hotnews // online
    function hotnewsv2() {

        $this->load->view('home/hotnews/index_v');
    }
    function search($offset=0) {
        if ($this->input->post('btnsearch')) {

            $this->session->set_userdata('s_user_id', trim($this->input->post('user_id')));
        }

        $user_id = $this->session->userdata('s_user_id');
        $data['user_id'] = $user_id;

        $array = $this->news_m->search($user_id, $offset, 20, '/home/search');
        $data['query'] = $array['query'];
        
        $data['name'] = $this->db->get_where('tbmember',array('id'=>$user_id))->row_array();
        
        $data['page_links'] = $array['page_links'];
        $data['total'] = $array['total'];

        $data['mydate'] = $this->mydate;
        $data['content'] = "home/search_v";
        $this->load->view('home/template_v', $data);
    }
    // slider // online
    function slider() { 
        $this->load->view('home/slider/index_2_v'); //index_v
    }
    
    function slider2(){
        $this->load->view('home/slider/index_2_v');
    }
    // intro // online
    function intro() { 
        $this->load->view('home/intro/index_v');
    }

}
