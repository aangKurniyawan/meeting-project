<?php
	class M_login extends CI_Model{
		public	function cek_login($where){	
			$email 		= $where['email'];
			$password 	= $where['password'];	
			$query = $this->db->query("SELECT * FROM tb_user WHERE email='$email' AND password='$password'")->num_rows();
			return $query;
		}	
		public function cek_user($where){
			$email 		= $where['email'];
			$password 	= $where['password'];

			$query = $this->db->query(" SELECT * FROM tb_user WHERE email='$email' AND password = '$password' ")->result_array();
			return $query;
		}
	}
?>