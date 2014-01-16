<?php

class Adminusers extends MX_Controller
{

function __construct() {
parent::__construct();

$this->load->module('template');
$this->load->module('admintemplate');
$this->load->library('pagination');
//$this->output->enable_profiler(TRUE);
}

function get($order_by){
$this->load->model('mdl_adminusers');
$query = $this->mdl_adminusers->get($order_by);
return $query;
}

function get_with_limit($limit, $offset, $order_by) {
$this->load->model('mdl_adminusers');
$query = $this->mdl_adminusers->get_with_limit($limit, $offset, $order_by);
return $query;
}

function get_where($id){
$this->load->model('mdl_adminusers');
$query = $this->mdl_adminusers->get_where($id);
return $query;
}

function get_where_custom($col, $value) {
$this->load->model('mdl_adminusers');
$query = $this->mdl_adminusers->get_where_custom($col, $value);
return $query;
}

function get_where_like($field,$key){
$this->load->model('mdl_adminusers');
$query = $this->mdl_adminusers->get_where_like($field,$key);
return $query;
}


function _insert($data){
$this->load->model('mdl_adminusers');
$this->mdl_adminusers->_insert($data);
}

function _update($id, $data){
$this->load->model('mdl_adminusers');
$this->mdl_adminusers->_update($id, $data);
}

function _update_where($col,$col_val, $data){
    $this->load->model('mdl_adminusers');
    $this->mdl_adminusers->_update_where($col,$col_val, $data);
}

function _delete($id){
$this->load->model('mdl_adminusers');
$this->mdl_adminusers->_delete($id);
}

function count_where($column, $value) {
$this->load->model('mdl_adminusers');
$count = $this->mdl_adminusers->count_where($column, $value);
return $count;
}

function get_max() {
$this->load->model('mdl_adminusers');
$max_id = $this->mdl_adminusers->get_max();
return $max_id;
}

function _custom_query($mysql_query) {
$this->load->model('mdl_adminusers');
$query = $this->mdl_adminusers->_custom_query($mysql_query);
return $query;
}

function get_where_custom_with_limit($col, $value, $limit, $offset, $order_by) {
$this->load->model('mdl_adminusers');
$query = $this->mdl_adminusers->get_where_custom_with_limit($col, $value, $limit, $offset, $order_by);
return $query;
}

function get_form_data(){
    $data = $this->input->post();
    return $data;
}

function index(){
    if($this->session->userdata('usertype') == "administrator"){
            redirect('users');
            //$this->getadminusers();
                }else{
                    $this->login();
                } 
    //$this->getadminusers();
}

function login($alert = array()){
    $userdetail = $this->get_form_data();
    $data['no_visible_elements'] = true;
    //check for submit action
    //echo 1;
    if(!empty($userdetail) && $userdetail['username'] != "" && $userdetail['password'] != ""){
        //make hash
        //echo 2;
        $password = $this->makeHash($userdetail['password']);
        //first level check
        //echo 3;
        if($this->count_where('username',$userdetail['username']) > 0 && $this->count_where('password',$password) > 0){
            //get the user from db
            //echo 4;
            $checkuser = $this->get_where_custom('username',$userdetail['username']);
            foreach($checkuser->result() as $userdb){
                $passw = $userdb->password;
                $usern = $userdb->username;
            }
            //second level check
            //echo 5;
            if($userdetail['username'] != $usern || $password != $passw ){
                $data['alert'] = "Wrong Username or Password, Please Try Again";
                $data['alert_type'] = "Warning";
                $data['title'] = "Wrong Login Details";
                $data['view_file'] = "login";
                $data['module'] = "adminusers";
                $this->admintemplate->build(false,$data); 
            }else{
                foreach($checkuser->result() as $usergo){
                    $this->session->set_userdata('usertype','administrator');
                    $this->session->set_userdata('id',$usergo->id);
                    $this->session->set_userdata('email',$usergo->email);
                    $this->session->set_userdata('username',$usergo->username);
                    redirect('adminusers');
                    //$this->getadminusers();   
                    //echo 'go';
                }
                
            }
        }else{
            $data['alert'] = "Wrong Username or Password, Please Try Again";
            $data['alert_type'] = "Warning";
            $data['title'] = "Wrong Login Details";
            $data['view_file'] = "login";
            $data['module'] = "adminusers";
            $this->admintemplate->build(false,$data); 
        }
        
        
    }else{
        if($this->session->userdata('id')){
            redirect('adminusers');
        }else{
            if(!empty($alert)){
                $data['alert'] = $alert['message'];
                $data['alert_type'] = $alert['type'];
            }
        $data['title'] = "Login";
        $data['view_file'] = "login";
        $data['module'] = "adminusers";
        $this->admintemplate->build(false,$data);    
        }
    
    }
    
    
   
}

function adduser(){
$userdata = $this->get_form_data();
$data = $userdata;
$data['access'] = 'administrator';
//check if user exist in database
$checkusername = $this->count_where('username',$userdata['username']);

if($checkusername < 1){
    $rawpassword = $userdata['password'];
    unset($userdata['password']);
    $userdata['password'] = $this->makeHash($rawpassword);
     /*if(isset($data['userfile'])){*/
    
        $this->_insert($userdata);
        /*$message = "
        Thank you ".$userdata['firstname']." for registering with Supplies.
        Your Username is ".$userdata['username'].".
        You will recieve an email once your account has been approved.
        ";*/
        
        //$sendemail = $this->sendmail($userdata['email'],"SUPPLIES: Thank you for registering",$message);
        $data['alert'] = "Admin User Created Successfully";
        $data['alert_type'] = "success";
        $data['message'] = $data['alert'];
        $data['type'] = $data['alert_type'];
        if($this->session->userdata('usertype') == "administrator"){
            $this->getadminusers($data['alert_type'],$data['message']);
        }else{
            $data['title'] = "Registration Successful";
            $data['view_file'] = "login";
            $data['module'] = "adminusers";
            $this->admintemplate->build(true,$data);   
            //$this->login($alert); 
        }
        
      
    
}else{
    unset($this->input);
    $data['alert'] = "This admin user already exists. Registration failed. Try a different username or email.";
    $data['alert_type'] = "warning";
    $data['message'] = $data['alert'];
    $data['type'] = $data['alert_type'];
    if($this->session->userdata('usertype') == "administrator"){
            $this->getadminusers($data['type'],$data['message']);
        }else{
    $data['title'] = "User Already Exists";
    $data['view_file'] = "login";
    $data['module'] = "adminusers";
    $this->admintemplate->build(true,$data);   
    }
}
}


function getadminusers($alerttype = "",$alertmessage = ""){
    
    $alluser = $this->get('id');
    $total = $alluser->num_rows();
    $config['base_url'] = base_url('adminusers/getadminusers');
    $config['total_rows'] = $total;
    $config['per_page'] = 50;
    $config['full_tag_open'] = '<ul>';
    $config['full_tag_close'] = '</ul>';
    $config['num_tag_open'] = '<li>';
    $config['num_tag_close'] = '</li>';
    $config['prev_tag_open'] = '<li>';
    $config['prev_tag_close'] = '</li>';
    $config['next_tag_close'] = '</li>';
    $config['next_tag_open'] = '<li>';
    $config['cur_tag_open'] = '<li class="active"><a href="#">';
    $config['cur_tag_close'] = '</a></li>';
    $this->pagination->initialize($config); 
    $data['pagenavi'] = $this->pagination->create_links();
    if($alerttype != "" && $alertmessage != ""){
        $data['alert'] = $alertmessage;
        $data['alert_type'] = $alerttype;
    }
    
    if(!$this->uri->segment(3)){
        $offset = 0;
    }else{
        $offset = $this->uri->segment(3);
        $data['c'] = $offset + 1;
    }
    $adminusers = $this->get_with_limit($config['per_page'],$offset,'id');
    
    
    
    $data['access'] = 'administrator';
    
    $data['users'] = $adminusers;
    $data['title'] = "Administrators";
    $data['view_file'] = "users";
    $data['module'] = "adminusers";
    $this->admintemplate->build(true,$data);
}

function updateuser(){
    $userdata = $this->get_form_data();
    if(isset($userdata['id'])){
    if(isset($userdata['password'])){
       $rawpassword = $userdata['password'];
        unset($userdata['password']);
        $userdata['password'] = $this->makeHash($rawpassword); 
    }
    
    
    $this->_update($userdata['id'],$userdata);
    $alert['message'] = "The admin user has been updated successfully";
    $alert['type'] = "success";
    $this->getadminusers($alert['type'],$alert['message']);
}
}

function deleteuser(){
    $id = $this->uri->segment(3);
    $this->_delete($id);
    redirect('adminusers/getadminusers');
}

/**
 * adminusers::makeHash()
 * generate a secure hash string from a sring and a salt
 * @param mixed $data
 * @param string $salt
 * @return string
 */
function makeHash($data, $salt = "%gd:FG{hdfVFDds6egNNKYRfe dr"){
    
    /* Really? I think this is a little crazy, but not too crazy though..  */
    
    $secString = "";
    $hashData = do_hash($data);
    $hashSalt = do_hash($salt);
    $secString .= $hashData;
    $secString .= $hashSalt;
    $secString .= $hashData;
    
    $hash = do_hash($secString);
    $secHash = do_hash($hash);
    $token = do_hash($secHash);
   // echo $token."<br />";
    return $token;
    
}

function logout(){

                $this->session->unset_userdata('usertype');
                $this->session->unset_userdata('id');
                $this->session->unset_userdata('email');
                $this->session->unset_userdata('username');
                
                redirect('adminusers/login');

}

/**
 * adminusers::accessLocker()
 * use 0 to accept all adminusers and the respective role id for other adminusers
 * @param mixed $role
 * @return boolean
 */
function accessLocker($role){
    $userrole = $this->session->userdata('usertype');
    if($userrole = "administrator"){
        return true;
    }elseif($role == "all"){
        return true;
    }elseif($role != $userrole){
        return false;
    }else{
        return false;
    }
    
}

function getusername($userid){
    $userdetail = $this->get_where($userid);
    foreach($userdetail->result() as $user){
        $username = $user->username;
    }
    return $username;
}

function getuserid($username){
    $userdetail = $this->get_where_custom("username",$username);
    foreach($userdetail->result() as $user){
        $userid = $user->id;
    }
    return $userid;
}
 
}

?>