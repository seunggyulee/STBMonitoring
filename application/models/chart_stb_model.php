<?php
class chart_stb_model extends CI_Model {
 
    function __construct()
    {       
        parent::__construct();
        $this->load->database();
        log_message('debug', 'chart_ics_model init');
    }
 
    public function index() { 
        $this->load->view('Chart_stb'); 
    } 
 
    public function getCPUs($mode){
        return $this->db->query("SELECT seq, cpu FROM logSTBInfoTable WHERE mode='$mode'")->result();
        // return $this->db->get('logicsinfotable')->result();
    }

    public function getMEMs($mode){
        return $this->db->query("SELECT seq, mem FROM logSTBInfoTable WHERE mode='$mode'")->result();
        // return $this->db->get('logicsinfotable')->result();
    }
}