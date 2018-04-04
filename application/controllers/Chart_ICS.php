<?php 
 
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Chart_ICS extends CI_Controller { 
    function __construct() { 
        parent::__construct(); 
        $this->load->model('Chart_ics_model');                
        $this->load->helper('string', 'url'); 
    } 
 
    function index() { 
        $this->load->helper('url');
        $this->load->view('Chart_ics');        
    } 
 
    function getdata() {
        $responce = array(['seq', 'csrConnectTime', 'cssDataConnectTime', 'cssIMGConnectTime', 'downloadIMGTime', 'drawIMGTime']);
        // print_r ($responce);
        
        $data = $this->Chart_ics_model->gets(); 

        // print_r ($data);        
        // echo count($data);
        foreach($data as $cd) {            
            // print_r ($cd);
            $rowArray = array((int)$cd->seq, (int)$cd->csrConnectTime, (int)$cd->cssDataConnectTime, (int)$cd->cssIMGConnectTime, (int)$cd->downloadIMGTime, (int)$cd->drawIMGTime);
            // print_r ($rowArray);
            array_push($responce, ($rowArray));     
        }
        
        // print_r ($responce);
        echo json_encode($responce);       
    } 
}