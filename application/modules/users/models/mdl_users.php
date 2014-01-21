<?php

class Mdl_users extends CI_Model {

function __construct() {
parent::__construct();
}

function get_table() {
$table = "users";
return $table;
}

function get($order_by){
$table = $this->get_table();
$this->db->order_by($order_by);
$query=$this->db->get($table);
return $query;
}

function get_with_limit($limit, $offset, $order_by) {
$table = $this->get_table();
$this->db->limit($limit, $offset);
$this->db->order_by($order_by);
$query=$this->db->get($table);
return $query;
}

function get_where($id){
$table = $this->get_table();
$this->db->where('id', $id);
$query=$this->db->get($table);
return $query;
}

function get_where_custom($col, $value) {
$table = $this->get_table();
$this->db->where($col, $value);
$query=$this->db->get($table);
return $query;
}

function get_where_like($field,$key) {
$table = $this->get_table();
$this->db->like($field,$key);
$query=$this->db->get($table);
return $query;
}

function _insert($data){
$table = $this->get_table();
$this->db->insert($table, $data);
}

function _update($id, $data){
$table = $this->get_table();
$this->db->where('id', $id);
$this->db->update($table, $data);
}

function _delete($id){
$table = $this->get_table();
$this->db->where('id', $id);
$this->db->delete($table);
}

function count_where($column, $value) {
$table = $this->get_table();
$this->db->where($column, $value);
$query=$this->db->get($table);
$num_rows = $query->num_rows();
return $num_rows;
}

function count_all() {
$table = $this->get_table();
$query=$this->db->get($table);
$num_rows = $query->num_rows();
return $num_rows;
}

function get_max() {
$table = $this->get_table();
$this->db->select_max('id');
$query = $this->db->get($table);
$row=$query->row();
$id=$row->id;
return $id;
}

function _update_where($col,$col_val, $data){
$table = $this->get_table();
$this->db->where($col, $col_val);
$this->db->update($table, $data);
}

function _custom_query($mysql_query) {
$query = $this->db->query($mysql_query);
return $query;
}

function get_where_custom_with_limit($col, $value, $limit, $offset, $order_by) {
$table = $this->get_table();
$this->db->where($col, $value);
$this->db->limit($limit, $offset);
$this->db->order_by($order_by);
$query=$this->db->get($table);
return $query;
}

function get_userlinks_as_csv(){
    $this->load->dbutil();
    $table = $this->get_table();
    $this->db->select('firstname,lastname,email,link');
    $query = $this->db->get($table);
    $csvdata = $this->dbutil->csv_from_result($query);
    return $csvdata;
    
}

function get_activeusers_as_csv(){
    $this->load->dbutil();
    $table = $this->get_table();
    $this->db->select('uniqueid,title,firstname,lastname,gender,maritalstatus,dateofbirth,email,homeaddress,residentialstatus,howlonglived,telephonenumber,alternativecontactnumber,employmenttype,employmentlength,nameofemployer,officeaddress,monthlyincome,noofdependants,bankaccounttype,bank,doyouhaveloans,loanvalue,contacttime');
    $this->db->where('status','Active');
    $query = $this->db->get($table);
    $csvdata = $this->dbutil->csv_from_result($query);
    return $csvdata;
    
}

function todaysusers(){
    $query = $this->db->query('SELECT * FROM '.$this->get_table().'
WHERE date >= UNIX_TIMESTAMP(CURDATE())');
    $count = $query->num_rows();
    return $count;
}

}

?>