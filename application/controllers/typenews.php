<?php

class typenews extends MY_Controller {
    public $page_title = 'ประเภทข่าว';

    function __construct() {
        parent::__construct();
        $this->load->model('db_m');
        $this->load->model('script_m');
        $this->load->model('typenews_m');
        
        
    }

    function index() {
        $data['extraHeadContent'] = $this->script_m->bootstrap_modal();
        $data['page_title'] = $this->page_title;
        $data['content'] = 'admin/typenews/typenews_v';
        $this->load->view('admin/template_v', $data);
    }

    function ajax_get_grid($offset = 0) {
        $txtsearch = $this->input->post('txtsearch');

        $array = $this->typenews_m->get_all($txtsearch, $offset);
        $data['query'] = $array['query'];
        $data['pagination'] = $array['pagination'];
        $this->load->view('admin/typenews/typenews_grid_v', $data);
    }

    function ajax_get_data() {
        $id = $this->input->post('id');
        $this->db->where('id', $id);
        $row = $this->db->get('tbtype')->row_array();

        echo json_encode($row);
    }

    function ajax_save() {
        $id = $this->input->post('id');

        $data = array(
            //'code' => $this->input->post('code'),
            'type_name' => $this->input->post('type_name'),
        
        );

        $result = $this->db_m->validate_save('tbtyp', $id, 'type_name', $this->input->post('type_name'), $data);

        echo json_encode($result);
    }

    function ajax_delete() {
        $this->db->where('id', $this->input->post('id'));
        $this->db->delete('tbtypenews');
        echo true;
    }

}

?>