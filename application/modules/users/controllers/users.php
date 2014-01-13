<?php

class Users extends MX_Controller
{

function __construct() {
parent::__construct();

$this->load->module('template');
$this->load->module('admintemplate');
$this->load->library('pagination');
//$this->output->enable_profiler(TRUE);
}

function get($order_by){
$this->load->model('mdl_users');
$query = $this->mdl_users->get($order_by);
return $query;
}

function get_with_limit($limit, $offset, $order_by) {
$this->load->model('mdl_users');
$query = $this->mdl_users->get_with_limit($limit, $offset, $order_by);
return $query;
}

function get_where($id){
$this->load->model('mdl_users');
$query = $this->mdl_users->get_where($id);
return $query;
}

function get_where_custom($col, $value) {
$this->load->model('mdl_users');
$query = $this->mdl_users->get_where_custom($col, $value);
return $query;
}

function get_where_like($field,$key){
$this->load->model('mdl_users');
$query = $this->mdl_users->get_where_like($field,$key);
return $query;
}


function _insert($data){
$this->load->model('mdl_users');
$this->mdl_users->_insert($data);
}

function _update($id, $data){
$this->load->model('mdl_users');
$this->mdl_users->_update($id, $data);
}

function _update_where($col,$col_val, $data){
    $this->load->model('mdl_users');
    $this->mdl_users->_update_where($col,$col_val, $data);
}

function _delete($id){
$this->load->model('mdl_users');
$this->mdl_users->_delete($id);
}

function count_where($column, $value) {
$this->load->model('mdl_users');
$count = $this->mdl_users->count_where($column, $value);
return $count;
}

function get_max() {
$this->load->model('mdl_users');
$max_id = $this->mdl_users->get_max();
return $max_id;
}

function _custom_query($mysql_query) {
$this->load->model('mdl_users');
$query = $this->mdl_users->_custom_query($mysql_query);
return $query;
}

function get_where_custom_with_limit($col, $value, $limit, $offset, $order_by) {
$this->load->model('mdl_users');
$query = $this->mdl_users->get_where_custom_with_limit($col, $value, $limit, $offset, $order_by);
return $query;
}

function get_form_data(){
    $data = $this->input->post();
    return $data;
}

function index(){
    if($this->session->userdata('usertype') == "administrator"){
                    $this->getusers();
                }else{
                    $this->updateuser();
                } 
    //$this->getusers();
}

function login($alert = array()){
    $userdetail = $this->get_form_data();
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
                $data['module'] = "users";
                $this->admintemplate->build(false,$data); 
            }else{
                foreach($checkuser->result() as $usergo){
                    $this->session->set_userdata('usertype',$usergo->usertype);
                    $this->session->set_userdata('id',$usergo->id);
                    $this->session->set_userdata('email',$usergo->email);
                    $this->session->set_userdata('username',$usergo->username);
                    redirect('users');
                    //$this->getusers();   
                    //echo 'go';
                }
                
            }
        }else{
            $data['alert'] = "Wrong Username or Password, Please Try Again";
            $data['alert_type'] = "Warning";
            $data['title'] = "Wrong Login Details";
            $data['view_file'] = "login";
            $data['module'] = "users";
            $this->admintemplate->build(false,$data); 
        }
        
        
    }else{
        if($this->session->userdata('id')){
            redirect('users');
        }else{
            if(!empty($alert)){
                $data['alert'] = $alert['message'];
                $data['alert_type'] = $alert['type'];
            }
        $data['no_visible_elements'] = true;
        $data['title'] = "Login";
        $data['view_file'] = "login";
        $data['module'] = "users";
        $this->admintemplate->build(false,$data);    
        }
    
    }
    
    
   
}

function adduser(){
$userdata = $this->get_form_data();
$data = $userdata;
unset($userdata['agree']);
//check if user exist in database
$checkemail = $this->count_where('email',$userdata['email']);

if($checkemail < 1){
    
    $userdata['status'] = "pending";
    $userdata['link'] = base_url('users/updateuser/'.urlencode($userdata['firstname']).'/'.urlencode($userdata['lastname']).'/'.urlencode($userdata['email']).'/'.urlencode($userdata['homeaddress']).'/'.urlencode($userdata['telephonenumber']).'');
        $this->_insert($userdata);
        $message = "
        You have been invited to paylater.
        Click the link to complete your registration.".base_url('users/updateuser/'.urlencode($userdata['firstname']).'/'.urlencode($userdata['lastname']).'/'.urlencode($userdata['email']).'/'.urlencode($userdata['homeaddress']).'/'.urlencode($userdata['telephonenumber']).'')."
        ";
        
        $sendemail = $this->sendmail($userdata['email'],"PayLater Invitation",$message);
        $data['alert'] = "The user has been added successfully and an alert has been sent";
        $data['alert_type'] = "success";
        $data['message'] = $data['alert'];
        $data['type'] = $data['alert_type'];
        if($this->session->userdata('id')){
        $this->getusers($data['alert_type'],$data['message']);
        }else{
             $data['alert'] = "Your account has been created.";
    $data['alert_type'] = "success";
    $data['title'] = "Paylater is a service by One Credit that enables you to pay for the goods you buy at selected retailers later. ";
    $data['view_file'] = "updateuser";
    $data['module'] = "users";
    $this->template->build(false,$data);
        }
        
 
    
}else{
    unset($this->input);
    
    if($this->session->userdata('id')){
        $data['alert'] = "This user already exists.";
    $data['alert_type'] = "warning";
    $data['message'] = $data['alert'];
    $data['type'] = $data['alert_type'];
        $this->getusers($data['alert_type'],$data['message']);
        }else{
        $data['alert'] = "This user already exists.";
    $data['alert_type'] = "warning";
    $data['message'] = $data['alert'];
        $data['type'] = $data['alert_type'];
    $data['title'] = "Paylater is a service by One Credit that enables you to pay for the goods you buy at selected retailers later. ";
    $data['view_file'] = "updateuser";
    $data['module'] = "users";
    $this->template->build(false,$data);
        }
    
        
}

}


function getusers($alerttype = "",$alertmessage = ""){
    
    $alluser = $this->get('id');
    $total = $alluser->num_rows();
    $config['base_url'] = base_url('users/getusers');
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
    $users = $this->get_with_limit($config['per_page'],$offset,'id');
    
    
    
    $data['access'] = 'administrator';
    
    $data['users'] = $users;
    $data['title'] = "Users";
    $data['view_file'] = "users";
    $data['module'] = "users";
    $this->admintemplate->build(true,$data);
}

function getuser(){
    $data['access'] = "administrator";
    $data['title'] = "User";
    $data['view_file'] = "user";
    $data['module'] = "users";
    $this->template->build(true,$data);
}

function updateuser(){
    $userdata = $this->get_form_data();
    if(isset($userdata['id'])){
       unset($userdata['agree']);
    $userdata['link'] = base_url('users/updateuser/'.urlencode($userdata['firstname']).'/'.urlencode($userdata['lastname']).'/'.urlencode($userdata['email']).'/'.urlencode($userdata['homeaddress']).'/'.urlencode($userdata['telephonenumber']).'');
    $this->_update($userdata['id'],$userdata);
    $alert['message'] = "The user has been Updated successfully";
    $alert['type'] = "success";
    if($this->session->userdata('id')){
            $this->getusers($alert['type'],$alert['message']);
        }else{
    $data['alert'] = "Your account has been created.";
    $data['alert_type'] = "success";
    $data['message'] = $data['alert'];
    $data['type'] = $data['alert_type'];
    $data['title'] = "Paylater is a service by One Credit that enables you to pay for the goods you buy at selected retailers later. ";
    $data['view_file'] = "updateuser";
    $data['module'] = "users";
    $this->template->build(false,$data);
        }
    
}else{
    $data['title'] = "Paylater is a service by One Credit that enables you to pay for the goods you buy at selected retailers later. ";
    $data['view_file'] = "updateuser";
    $data['module'] = "users";
    $this->template->build(false,$data);
}
}

function deleteuser(){
    $id = $this->uri->segment(3);
    $this->_delete($id);
    redirect('users');
}

function searchuser(){
    $data['access'] = "administrator";
    $key = $this->get_form_data();
    $users = $this->get_where_like('firstname',$key['usersearch']);
        $count = count($users->result());
        if($count > 0){
            $data['users'] = $users;
            }else{
        $users = $this->get_where_like('lastname',$key['usersearch']);
        $count = count($users->result());
        if($count > 0){
            $data['users'] = $users;
            }else{
                $users = $this->get_where_like('email',$key['usersearch']);
        $count = count($users->result());
        if($count > 0){
            $data['users'] = $users;
        }else{
            
        }
            }
            }
    $data['users'] = $users;
    $data['title'] = "User Search Result";
    $data['view_file'] = "users";
    $data['module'] = "users";
    $this->admintemplate->build(true,$data);
}


/**
 * Users::getAvi()
 * gets the current user avatar
 * @param mixed $width
 * @param mixed $height
 * @return string
 */
function getAvi($width,$height){
    $userid = $this->session->userdata('id');
    $query = $this->get_where_custom('id',$userid );
    foreach($query->result() as $row){
        $avi = $row->avi;
    }
    if($avi){
    $urlarray = explode('.',$avi);
    $urlarray['0'] .= '_'.$width.'by'.$height.'';
    $aviurlnew = implode('.',$urlarray);
    
    $config['image_library'] = 'gd2';
    $config['source_image']	= 'assets/user-assets/avi/'.$avi.'';//$aviurl;
    $config['create_thumb'] = TRUE;
    $config['maintain_ratio'] = TRUE;
    $config['width']	 = $width;
    $config['height']	= $height;
    $config['thumb_marker']	= '_'.$width.'by'.$height.'';
    
    $this->load->library('image_lib', $config); 
    
    $this->image_lib->resize();
    
    $aviurl = base_url('assets/user-assets/avi/'.$aviurlnew.'');
    return $aviurl;
    }else{
        
        return false;
    }
}

/**
 * Users::makeHash()
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
                
                redirect('users/login');

            
        
  
}

/**
 * Users::accessLocker()
 * use 0 to accept all users and the respective role id for other users
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

function downloadform(){
    $data = file_get_contents(base_url('assets/user-assets/registrationform/Creditapplicationform.pdf')); // Read the file's contents
    $name = 'registrationForm.pdf';
    if(!$data){
        die('File does not exist');
    }
    force_download($name, $data);
}

function downloaduserform(){
    $usernm = $this->uri->segment(3);
    $data = file_get_contents(base_url('assets/user-assets/userforms/'.$usernm.'.pdf')); // Read the file's contents
    if(!$data){
        die('File does not exist');
    }
    $name = $usernm.'_registration_form.pdf';
    
    force_download($name, $data);
}

function sendmail($to,$subject,$message){
    $this->email->from('servicedesk@special-brand.com', 'Supplies');
    $this->email->to($to);
    
    $this->email->subject($subject);
    $this->email->message($message);	
    
    $send = $this->email->send();
    if(!$send){
        return false;
    }else{
        return true;
    }
}

function dashboard(){
    $data['access'] = 'all';
    $this->load->module('spreadsheets');
    $data['link'] = $this->spreadsheets->getlatestlinkbyuser();
    $data['title'] = "Dashboard";
    $data['view_file'] = "dashboard";
    $data['module'] = "users";
    $this->template->build(true,$data);
}

function frontend(){
    $this->dashboard();
}

function backend(){
    $data['access'] = 'all';
    $data['title'] = "Dashboard";
    $data['view_file'] = "backend";
    $data['module'] = "users";
    $this->template->build(true,$data);
}

function approveuser(){
    $userdt = $this->get_form_data();
    $data['usertype'] = "regular";
    $data['id'] = $userdt['userid']; 
    $userdetails = $this->get_where_custom('id',$userdt['userid']);
    foreach($userdetails->result() as $userd){
        $email = $userd->email;
        $company = $userd->companyname;
        $username = $userd->username;
    }
    $approve = $this->_update_where('id',$userdt['userid'],$data);
    $this->load->module('spreadsheets');
    $this->spreadsheets->create($userdt['userid'],$userdt['name'],$userdt['link'],true);
    $message = "
        Congratulations ".$company.", 
        Your Supplies account at ".base_url()." has been approved.
        Login here (".base_url().") with your username(".$username.") and password to continue.
        ";
    $this->sendmail($email,'SUPPLIES: Account Approval',$message);
        $data['message'] = "The User has been approved.";
        $data['type'] = "success";
        $this->getusers($data['type'],$data['message']);
}

function getusername($userid){
    $userdetail = $this->get_where($userid);
    foreach($userdetail->result() as $user){
        $username = $user->username;
    }
    return $username;
}

function getuserid($email){
    $userdetail = $this->get_where_custom("email",$email);
    foreach($userdetail->result() as $user){
        $userid = $user->id;
    }
    return $userid;
}
 
}

?>