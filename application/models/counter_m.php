<?php

class Counter_m extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function convert() {
        //1282039333
        $original = '1282039333';
        $timestamp = mktime(0, 0, 0, substr($original, 4, 2), substr($original, 6), substr($original, 0, 4));
        echo date('jS F Y', $timestamp);
    }

    function userCounter() {
        if ($this->session->userdata('counted') == FALSE) {
            $this->db->query("update usercounter  set count=(count+1) where id_count=1");
            $this->session->set_userdata('counted', TRUE);
        }
        $this->db->query("update usercounter  set hits=hits+1 where id_count=1");

        $data = array();
        $this->db->select('*');
        $this->db->from('usercounter');
        $this->db->where('id_count', '1');
        $Q = $this->db->get();
        if ($Q->num_rows() > 0) {
            $data = $Q->row_array();
        }
        $Q->free_result();
        return $data;
    }

    function userOnline() {
        $tm = time();
        $now = $tm - 600;    // 1 ชม.
        $ip = $this->input->ip_address();
        $browser = $this->input->user_agent();

        $this->db->query("DELETE FROM useronline   WHERE timevisit<'$now'");
        $query = $this->db->query("SELECT id_online FROM useronline where ip = '$ip'");
        if ($query->num_rows() > 0) {
            $this->db->query("update  useronline  set timevisit='$tm' where ip = '$ip'");
        } else {
            $this->db->query("INSERT INTO useronline (ip,user_agent,timevisit) values('$ip','$browser','$tm')");
            //บันทึกเก็บเป็นสถิติไว้
            $datevisit = date('Y:m:d');
            $timevisit = date('H:i:s');
            $this->db->query("INSERT INTO useronline_log(ip,user_agent,datevisit,timevisit) values('$ip','$browser','$datevisit','$timevisit')");
        }

        $Q = $this->db->query("SELECT * FROM useronline");

        $jmlonline = $Q->num_rows();
        return $jmlonline;
    }

    function userOnlineDay() {
        $tm = time();
        $day = $tm - 86400; // 1 วัน
        $ip = $this->input->ip_address();
        $browser = $this->input->user_agent();

        $this->db->query("DELETE FROM useronlineday   WHERE timevisit<'$day'");
        $query = $this->db->query("SELECT id_onlineday FROM useronlineday where ip = '$ip'");
        if ($query->num_rows() > 0) {
            $this->db->query("update  useronlineday  set timevisit='$tm' where ip='$ip'");
        } else {
            $this->db->query("INSERT INTO useronlineday(ip,user_agent,timevisit) values('$ip','$browser','$tm')");
        }
        $Q = $this->db->query("SELECT * FROM useronlineday");

        $jmlonlineday = $Q->num_rows();
        return $jmlonlineday;
    }

    public function showCounter() {

        $counter = $this->userCounter();
        $online = $this->userOnline();
        $onlineday = $this->userOnlineDay();
        echo "<p class=\"phone\"><span class=\"glyphicon glyphicon-eye-open\"></span> กำลังดู " . $online . " คน</p>";
        echo "<p class=\"phone\"><span class=\"glyphicon glyphicon-globe\"></span> ออนไลน์วันนี้ " . $onlineday . " คน</p>";
        echo "<p class=\"phone\"><span class=\"glyphicon glyphicon-refresh\"></span> ทั้งหมด " . number_format($counter['count']) . " ครั้ง</p>";
    }

}
