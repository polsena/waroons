<?php

//Admin Page Login Complete
class admin extends MY_Controller {

    public function __construct() {
        parent::__construct();
     
    }

    public function index() {
        $data['page_title'] = 'ระบบบริหารงานเว็บไซต์';
        $data['content'] = 'admin/content_v';
        $this->load->view('admin/template_v',$data);
    }

    
}
