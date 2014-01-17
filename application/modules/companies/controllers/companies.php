<?php

class Companies extends MX_Controller
{

function __construct() {
parent::__construct();
}

function get($order_by){
$this->load->model('mdl_companies');
$query = $this->mdl_companies->get($order_by);
return $query;
}

function get_with_limit($limit, $offset, $order_by) {
$this->load->model('mdl_companies');
$query = $this->mdl_companies->get_with_limit($limit, $offset, $order_by);
return $query;
}

function get_where($id){
$this->load->model('mdl_companies');
$query = $this->mdl_companies->get_where($id);
return $query;
}

function get_where_custom($col, $value) {
$this->load->model('mdl_companies');
$query = $this->mdl_companies->get_where_custom($col, $value);
return $query;
}

function get_where_like($field,$key){
$this->load->model('mdl_companies');
$query = $this->mdl_companies->get_where_like($field,$key);
return $query;
}


function _insert($data){
$this->load->model('mdl_companies');
$this->mdl_companies->_insert($data);
}

function _update($id, $data){
$this->load->model('mdl_companies');
$this->mdl_companies->_update($id, $data);
}

function _update_where($col,$col_val, $data){
    $this->load->model('mdl_companies');
    $this->mdl_companies->_update_where($col,$col_val, $data);
}

function _delete($id){
$this->load->model('mdl_companies');
$this->mdl_companies->_delete($id);
}

function count_where($column, $value) {
$this->load->model('mdl_companies');
$count = $this->mdl_companies->count_where($column, $value);
return $count;
}

function get_max() {
$this->load->model('mdl_companies');
$max_id = $this->mdl_companies->get_max();
return $max_id;
}

function _custom_query($mysql_query) {
$this->load->model('mdl_companies');
$query = $this->mdl_companies->_custom_query($mysql_query);
return $query;
}

function get_where_custom_with_limit($col, $value, $limit, $offset, $order_by) {
$this->load->model('mdl_companies');
$query = $this->mdl_companies->get_where_custom_with_limit($col, $value, $limit, $offset, $order_by);
return $query;
}

function get_form_data(){
    $data = $this->input->post();
    return $data;
}

function create($company){
    
}

function read(){
    
}

function update(){
    
}

function delete(){
    
}

function readall(){
    
}

}

?>