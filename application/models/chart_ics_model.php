<?php
class chart_ics_model extends CI_Model {
 
    function __construct()
    {       
        parent::__construct();
        $this->load->database();
        log_message('debug', 'chart_ics_model init');
    }
 
    public function index() { 
        $this->load->view('Chart_ics'); 
    } 
 
    public function gets(){
        return $this->db->query("SELECT seq, csrConnectTime, cssDataConnectTime, cssIMGConnectTime, downloadIMGTime, drawIMGTime FROM logicsinfotable")->result();
        // return $this->db->get('logicsinfotable')->result();
    }
}