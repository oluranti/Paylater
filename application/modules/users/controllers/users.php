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
    /*if(isset($userdata['firstname'],$userdata['lastname'],$userdata['email'])){*/
    $userdata['hash'] = $this->makeHash($userdata['firstname'].'-'.$userdata['lastname'].'-'.$userdata['email']);
    /*}*/
    $this->load->module('companies');
    $this->companies->create($userdata['nameofemployer']);
    $this->_update($userdata['id'],$userdata);
    $this->generatetc($userdata['title'],$userdata['firstname'],$userdata['lastname'],$userdata['homeaddress'],$userdata['hash']);
    $message = '
    <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xmlns="http://www.w3.org/1999/xhtml" style="font-family: \'Helvetica Neue\', \'Helvetica\', Helvetica, Arial, sans-serif; font-size: 100%; line-height: 1.6; margin: 0; padding: 0;">
  <head>
    <meta name="viewport" content="width=device-width" />
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title>Really Simple HTML Email Template</title>
  </head>
  <body bgcolor="#f6f6f6" style="font-family: \'Helvetica Neue\', \'Helvetica\', Helvetica, Arial, sans-serif; font-size: 100%; line-height: 1.6; -webkit-font-smoothing: antialiased; -webkit-text-size-adjust: none; width: 100% !important; height: 100%; margin: 0; padding: 0;">&#13;
&#13;
<!-- body -->&#13;
<table class="body-wrap" style="font-family: \'Helvetica Neue\', \'Helvetica\', Helvetica, Arial, sans-serif; font-size: 100%; line-height: 1.6; width: 100%; margin: 0; padding: 20px;"><tr style="font-family: \'Helvetica Neue\', \'Helvetica\', Helvetica, Arial, sans-serif; font-size: 100%; line-height: 1.6; margin: 0; padding: 0;"><td style="font-family: \'Helvetica Neue\', \'Helvetica\', Helvetica, Arial, sans-serif; font-size: 100%; line-height: 1.6; margin: 0; padding: 0;"></td>&#13;
		<td class="container" bgcolor="#FFFFFF" style="font-family: \'Helvetica Neue\', \'Helvetica\', Helvetica, Arial, sans-serif; font-size: 100%; line-height: 1.6; display: block !important; max-width: 600px !important; clear: both !important; margin: 0 auto; padding: 20px; border: 1px solid #f0f0f0;">&#13;
&#13;
			<!-- content -->&#13;
			<div class="content" style="font-family: \'Helvetica Neue\', \'Helvetica\', Helvetica, Arial, sans-serif; font-size: 100%; line-height: 1.6; max-width: 600px; display: block; margin: 0 auto; padding: 0;">&#13;
			<table style="font-family: \'Helvetica Neue\', \'Helvetica\', Helvetica, Arial, sans-serif; font-size: 100%; line-height: 1.6; width: 100%; margin: 0; padding: 0;"><tr style="font-family: \'Helvetica Neue\', \'Helvetica\', Helvetica, Arial, sans-serif; font-size: 100%; line-height: 1.6; margin: 0; padding: 0;"><td style="font-family: \'Helvetica Neue\', \'Helvetica\', Helvetica, Arial, sans-serif; font-size: 100%; line-height: 1.6; margin: 0; padding: 0;">&#13;
						<p style="font-family: \'Helvetica Neue\', \'Helvetica\', Helvetica, Arial, sans-serif; font-size: 14px; line-height: 1.6; font-weight: normal; margin: 0 0 10px; padding: 0;">Hello '.$userdata['firstname'].',</p>&#13;
						<p style="font-family: \'Helvetica Neue\', \'Helvetica\', Helvetica, Arial, sans-serif; font-size: 14px; line-height: 1.6; font-weight: normal; margin: 0 0 10px; padding: 0;">Thank you for submitting your Paylater credit information form. Attached is the copy of the Agreement you executed by agreeing to our terms and conditions.</p>&#13;
						<p style="font-family: \'Helvetica Neue\', \'Helvetica\', Helvetica, Arial, sans-serif; font-size: 14px; line-height: 1.6; font-weight: normal; margin: 0 0 10px; padding: 0;">One Credit will call you within the next 48 hours to review your details and ensure you meet a few other criteria.</p>&#13;
						<p style="font-family: \'Helvetica Neue\', \'Helvetica\', Helvetica, Arial, sans-serif; font-size: 14px; line-height: 1.6; font-weight: normal; margin: 0 0 10px; padding: 0;">For further information on this mail or queries regarding the Paylater Credit Limit please contact One Credit on <a href="call:08091112274" style="font-family: \'Helvetica Neue\', \'Helvetica\', Helvetica, Arial, sans-serif; font-size: 100%; line-height: 1.6; color: #348eda; margin: 0; padding: 0;">0809-111-CASH (08091112274)</a> or email <a href="mailto:paylater@one-cred.com" target="_blank" style="font-family: \'Helvetica Neue\', \'Helvetica\', Helvetica, Arial, sans-serif; font-size: 100%; line-height: 1.6; color: #348eda; margin: 0; padding: 0;">paylater@one-cred.com</a> </p>&#13;
						<p style="font-family: \'Helvetica Neue\', \'Helvetica\', Helvetica, Arial, sans-serif; font-size: 14px; line-height: 1.6; font-weight: normal; margin: 0 0 10px; padding: 0;">Happy Spending!</p>&#13;
						<p style="font-family: \'Helvetica Neue\', \'Helvetica\', Helvetica, Arial, sans-serif; font-size: 14px; line-height: 1.6; font-weight: normal; margin: 0 0 10px; padding: 0;"><a href="'.base_url().'" style="font-family: \'Helvetica Neue\', \'Helvetica\', Helvetica, Arial, sans-serif; font-size: 100%; line-height: 1.6; color: #348eda; margin: 0; padding: 0;"><img src="'.$this->template->get_asset().'/images/logo.png" width="232" height="146" style="font-family: \'Helvetica Neue\', \'Helvetica\', Helvetica, Arial, sans-serif; font-size: 100%; line-height: 1.6; max-width: 100%; margin: 0; padding: 0;" /></a></p>&#13;
					</td>&#13;
				</tr></table></div>&#13;
			<!-- /content -->&#13;
									&#13;
		</td>&#13;
		<td style="font-family: \'Helvetica Neue\', \'Helvetica\', Helvetica, Arial, sans-serif; font-size: 100%; line-height: 1.6; margin: 0; padding: 0;"></td>&#13;
	</tr></table><!-- /body --></body>
</html>

    ';
    $this->sendmail($userdata['email'],'Paylater Account Activity',$message,true,'./assets/tc/'.$userdata['hash'].'.pdf');
    $alert['message'] = "The user has been Updated successfully";
    $alert['type'] = "success";
    if($this->session->userdata('id')){
            $this->getusers($alert['type'],$alert['message']);
        }else{
    $data['alert'] = "<strong>Application Submitted!</strong> We will contact you in 48 hours.";
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
    $this->email->from('noreply@one-cred.com', 'PayLater - Credit account offered by One Credit');
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
/*
function testmail(){
    $this->sendmail('olufemi@kvpafrica.com','Test','fooooo');
}
*/

function generatetc($title,$firstname, $lastname, $address,$hash){
    date_default_timezone_set('Africa/Lagos');
    $data['day'] = date('jS');
    $data['month'] = date('F');
    $data['year'] = date('Y');
    $data['title'] = $title;
    $data['firstname'] = $firstname;
    $data['lastname'] = $lastname;
    $data['address'] = $address;
    $this->load->library('pdf');
   	$this->pdf->load_view('tc',$data);
	$this->pdf->render();
	$output = $this->pdf->output();
    $this->load->helper('file');
    write_file('./assets/tc/'.$hash.'.pdf', $output);
}

function downloadactiveuserscsv(){
    $this->load->helper('file');
    $this->load->model('mdl_users');
    $csvdata = $this->mdl_users->get_activeusers_as_csv();
    $time = time();
    if ( !write_file('./assets/activeusersdownloads/'.$time.'.csv', $csvdata)){
        $alert['message'] = "User Export Failed";
        $alert['type'] = "error";
        $this->getusers($alert['type'],$alert['message']);
    }else{
        $alert['message'] = "User Export Successful";
        $alert['type'] = "success";
        $this->getusers($alert['type'],$alert['message']);
        $data = file_get_contents('./assets/activeusersdownloads/'.$time.'.csv'); // Read the file's contents
        if(!$data){
        die('File does not exist');
        }
        $name = 'registed_users_'.$time.'.csv';
        
        force_download($name, $data);  
    }

    
}


function viewactiveusers(){
    $data['access'] = "administrator";
    $users = $this->get_where_like('status','Active');

    $data['users'] = $users;

    $data['title'] = "Registered Users";
    $data['view_file'] = "users";
    $data['module'] = "users";
    $this->admintemplate->build(true,$data);
}

/*
function viewme(){
    $this->load->view('tc',true);
}
*/
}

?>