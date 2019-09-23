<?php

class Db_m extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    //เช็คซ้ำ  return True = ซ้ำ
    //idrow=5,code=001
    function validate($table, $id, $field, $field_value) {
        $this->db->where($field, $field_value);
        $data['row'] = $this->db->get($table)->row_array();

        if ($data['row'] == null) {
            return FALSE;
        } else {
            if ($data['row'][$field] == $field_value && $data['row']['id'] == $id) {
                return FALSE;
            } else if ($data['row'][$field] == $field_value && $data['row']['id'] != $id) {
                return TRUE;
            }
        }
    }

    /* บันทึกข้อมูลลงฐานข้อมูล โดยจะเช็คกับ filed id เป็นหลัก
     * 1. ถ้ารหัสนี้ซ้ำ ให้แจ้งกลับว่ารหัสซ้ำ
     * 2. ถ้ารหัสไม่ซ้ำ ตรวจสอบว่าเป็นการเพิ่มใหม่หรือปรับปรุง
     */

    function validate_save($table, $id, $field, $field_value, $data) {
        $msg = '0';
        $msg_text = '';
        if ($this->validate($table, $id, $field, $field_value)) {
            //รหัสซ้ำ
            $msg = '1';
            $msg_text = 'รหัสนี้มีการใช้งานแล้ว กรุณากำหนดรหัสใหม่';
        } else {
            if ($id == '') {
                $this->db->insert($table, $data);
                $id = $this->db->insert_id();
            } else {
                $this->db->where('id', $id);
                $this->db->update($table, $data);
            }
        }

        $data = array();
        $data['msg'] = $msg;
        $data['msg_text'] = $msg_text;
        $data['id'] = $id;
        return $data;
    }

    function save_board($table, $id, $data) {
        $msg = '0';
        $msg_text = 'โพสกระทู้แล้ว';

        if ($id == '') {
            $this->db->insert($table, $data);
            $id = $this->db->insert_id();
        } else {
            $this->db->where('id', $id);
            $this->db->update($table, $data);
        }


        $data = array();
        $data['msg'] = $msg;
        $data['msg_text'] = $msg_text;
        $data['id'] = $id;
        return $data;
    }

}

?>
