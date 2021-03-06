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

function adduser(){
$userdata = $this->get_form_data();
$data = $userdata;
unset($userdata['agree']);
//check if user exist in database
$checkemail = $this->count_where('email',$userdata['email']);

if($checkemail < 1){
    
    $userdata['status'] = "pending";
    $userdata['link'] = base_url('users/updateuser/'.urlencode($userdata['firstname']).'/'.urlencode($userdata['lastname']).'/'.urlencode($userdata['email']).'/'.$this->makeHash($userdata['firstname'].'-'.$userdata['lastname'].'-'.$userdata['email']));//base_url('users/updateuser/'.urlencode($userdata['firstname']).'/'.urlencode($userdata['lastname']).'/'.urlencode($userdata['email']).'/'.urlencode($userdata['homeaddress']).'/'.urlencode($userdata['telephonenumber']).'');
        $userdata['hash'] = $this->makeHash($userdata['firstname'].'-'.$userdata['lastname'].'-'.$userdata['email']);
        $userdata['uniqueid'] = $this->createuniqueid();
        $this->_insert($userdata);
        /*$message = "
        You have been invited to paylater.
        Click the link to complete your registration.".base_url('users/updateuser/'.urlencode($userdata['firstname']).'/'.urlencode($userdata['lastname']).'/'.urlencode($userdata['email']).'/'.$this->makeHash($userdata['firstname'].'-'.$userdata['lastname'].'-'.$userdata['email']))/*base_url('users/updateuser/'.urlencode($userdata['firstname']).'/'.urlencode($userdata['lastname']).'/'.urlencode($userdata['email']).'/'.urlencode($userdata['homeaddress']).'/'.urlencode($userdata['telephonenumber']).'')*//*."
        ";*/
        
        //$sendemail = $this->sendmail($userdata['email'],"PayLater Invitation",$message);
        $data['alert'] = "Account Created Successfully";
        $data['alert_type'] = "success";
        $data['message'] = $data['alert'];
        $data['type'] = $data['alert_type'];
        if($this->session->userdata('id')){
        $this->getusers($data['alert_type'],$data['message']);
        }else{
             $data['alert'] = "Your account has been created.";
    $data['alert_type'] = "success";
    $data['title'] = "Paylater is a service by One Credit that allows you buy now and pay later on selected websites";
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
    $data['title'] = "Paylater is a service by One Credit that allows you buy now and pay later on selected websites";
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

function updateuser(){
    $userdata = $this->get_form_data();
    if(isset($userdata['id'])){
       
    if(!isset($userdata['agree'])){
        $userdata['link'] = base_url('users/updateuser/'.urlencode($userdata['firstname']).'/'.urlencode($userdata['lastname']).'/'.urlencode($userdata['email']).'/'.$this->makeHash($userdata['firstname'].'-'.$userdata['lastname'].'-'.$userdata['email']));//base_url('users/updateuser/'.urlencode($userdata['firstname']).'/'.urlencode($userdata['lastname']).'/'.urlencode($userdata['email']).'/'.urlencode($userdata['homeaddress']).'/'.urlencode($userdata['telephonenumber']).'');
    }else{
        $userdata['date'] = $this->currenttime();
    }
    unset($userdata['agree']);
    if(isset($userdata['firstname'],$userdata['lastname'],$userdata['email'])){
    $userdata['hash'] = $this->makeHash($userdata['firstname'].'-'.$userdata['lastname'].'-'.$userdata['email']);
    }
    $this->load->module('companies');
    $this->companies->create($userdata['nameofemployer']);
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
    $data['title'] = "Paylater is a service by One Credit that allows you buy now and pay later on selected websites";
    $data['view_file'] = "updateuser";
    $data['module'] = "users";
    $this->template->build(false,$data);
        }
    
}else{
    $data['title'] = "Paylater is a service by One Credit that allows you buy now and pay later on selected websites";
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

function importusers(){
   
   $config['upload_path'] = './assets/importusers/';
	$config['allowed_types'] = 'csv';
	$config['max_size']	= '4123';
    $this->upload->initialize($config);

	if ( ! $this->upload->do_upload())
	{
		$alert['message'] = $this->upload->display_errors();
        $alert['type'] = "error";
        $this->getusers($alert['type'],$alert['message']);
	}
	else
	{
    $uploaddata = $this->upload->data();
    $file = fopen(base_url('assets/importusers/'.$uploaddata['file_name']),'r');
    $cc = 0;
     while (($filedecode = fgetcsv($file)) !== FALSE) {
        $cc++;
        $splitname = explode(' ',$filedecode[0]);
        $firstname = $splitname[0];
        $lastname = $splitname[1];
        $email = $filedecode[1];
        
        $checkemail = $this->count_where('email',$email);
        if($checkemail < 1){
            $data['firstname'] = $firstname;
            $data['lastname'] = $lastname;
            $data['email'] = $email;
            $data['status'] = "pending";
            $data['link'] = base_url('users/updateuser/'.urlencode($data['firstname']).'/'.urlencode($data['lastname']).'/'.urlencode($data['email']).'/'.$this->makeHash($firstname.'-'.$lastname.'-'.$email));
             $data['hash'] = $this->makeHash($firstname.'-'.$lastname.'-'.$email);
             $data['uniqueid'] = $this->createuniqueid();
             $this->_insert($data);
        }
        
       }  
        $alert['message'] = 'You have successfully imported '.$cc.' users';
        $alert['type'] = "success";
        $this->getusers($alert['type'],$alert['message']);
	}
   

}

function createuniqueid(){
    $count;
     for($count = 1; $count > 0; $uid = random_string('numeric',10), $count = $this->count_where('uniqueid',$uid), $final = $uid);
     return $final;
}

function downloaduserlinks(){
    $this->load->helper('file');
    $this->load->model('mdl_users');
    $csvdata = $this->mdl_users->get_userlinks_as_csv();
    $time = time();
    if ( !write_file('./assets/csvdownloads/'.$time.'.csv', $csvdata)){
        $alert['message'] = "User Export Failed";
        $alert['type'] = "error";
        $this->getusers($alert['type'],$alert['message']);
    }else{
        $alert['message'] = "User Export Successful";
        $alert['type'] = "success";
        $this->getusers($alert['type'],$alert['message']);
        $data = file_get_contents('./assets/csvdownloads/'.$time.'.csv'); // Read the file's contents
        if(!$data){
        die('File does not exist');
        }
        $name = 'users_'.$time.'.csv';
        
        force_download($name, $data);  
    }

    
}
 
function currenttime(){
$timestamp = time();
$timezone = 'UP1';
$daylight_saving = FALSE;
$times = gmt_to_local($timestamp, $timezone, $daylight_saving);
return $times;
}

function formattime($timestamp){
    $datestring = "%d/%m/%Y - %h:%i %a";
    $time = mdate($datestring, $timestamp);
    return $time;
}

function sendmail($to,$subject,$message,$attach = false,$attachment_path = ""){
    $this->email->from('olufemi@kvpafrica.com', 'PayLater - One Credit MFB');
    $this->email->to($to);
    
    $this->email->subject($subject);
    $this->email->message($message);
   	if($attach){
    $this->email->attach($attachment_path);
    }
    $send = $this->email->send();
    if(!$send){
        return false;
    }else{
        return true;
    }
}

function generatetc($firstname="Olanipekun",$lastname="Olufemi",$hash="iefjnfkhdf"){
    $data['firstname'] = $firstname;
    $data['lastname'] = $lastname;
    $this->load->library('pdf');
   	$this->pdf->load_view('tc',$data);
	$this->pdf->render();
	echo $this->pdf->output();

}

}

?>