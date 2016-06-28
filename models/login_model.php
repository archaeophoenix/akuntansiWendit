<?php
class Login_Model extends Model{
	
	function __construct(){
		parent::__construct();
	}

	function logon(){
		return $this->db->one('user',"WHERE username = '$_POST[username]' AND password = '$_POST[password]' ");
	}

	function login($id){
		return $this->db->one('user',"WHERE id = '$id'");
	}

}