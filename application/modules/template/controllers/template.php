<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Template extends MX_Controller {
    
var $asset;

    function __construct() {
    parent::__construct();
    $this->asset = base_url('assets');
    }
    
    function get_asset(){
        return $this->asset;
    }
    
    
    function build($require_login = false, $data = array()){
        //echo $data['access'];
        if(!$require_login){
            $this->header($data);

            $this->frontend($data);
            
            $this->footer($data);
        }else{
            if(!$this->session->userdata('id')){
                redirect('users/login');
            }else{
                $this->load->module('users');
            $this->header($data);
            if(!$this->users->accessLocker($data['access'])){
                 exit("Access Denied");
            }else{
            $this->frontend($data);
            }
            $this->footer($data);
            }
        }
        
        
    }

    function header($data = array()){
        $this->load->view('header',$data);
    }
    
    function footer($data = array()){
        $this->load->view('footer',$data);
    }
    
    function frontend($data = array()){
        $this->load->view('frontend',$data);
    }
        
        
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */