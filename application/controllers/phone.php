<?php

class phone extends CI_Controller {

    public $page_title = 'ข้อมูล';

    function __construct() {
        parent::__construct();

        $this->load->model('phone_m');
    }

    function index() {
        $data['page_title'] = $this->page_title;
        $data['content'] = 'home/phone/phone_v';
        $this->load->view('home/phone/template_v', $data);
    }

    function ajax_get_grid($offset = 0) {
        $txtsearch = $this->input->post('txtsearch');

        $array = $this->phone_m->get_all($txtsearch, $offset);
        $data['query'] = $array['query'];
        $data['pagination'] = $array['pagination'];
        $data['phone_m'] = $this->phone_m;
        $this->load->view('home/phone/phone_grid_v', $data);
    }

}
