<?php 
 
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Chart_STB extends CI_Controller { 
    function __construct() { 
        parent::__construct(); 
        $this->load->model('Chart_stb_model');                
        $this->load->helper('string', 'url'); 
    } 
 
    function index() { 
        $this->load->helper('url');
        $this->load->view('Chart_stb');        
    } 
 
    function getCPUdata($test_mode) {
        $responce = array();
        // print_r ($responce);
        
        $data = $this->Chart_stb_model->getCPUs($test_mode); 

        // print_r ($data);        
        // echo count($data);
        foreach($data as $cd) {            
            // print_r ($cd);
            $rowArray = array((int)$cd->seq, (int)$cd->cpu);
            // print_r ($rowArray);
            array_push($responce, ($rowArray));     
        }
        
        // print_r ($responce);
        echo json_encode($responce);       
    } 

    function getMEMdata($test_mode) {
        $responce = array();
   
        $data = $this->Chart_stb_model->getMEMs($test_mode); 

        // print_r ($data);        
        // echo count($data);
        foreach($data as $cd) {            
            // print_r ($cd);
            $rowArray = array((int)$cd->seq, (int)$cd->mem);
            // print_r ($rowArray);
            array_push($responce, ($rowArray));     
        }
        
        // print_r ($responce);
        echo json_encode($responce);       
    } 
}