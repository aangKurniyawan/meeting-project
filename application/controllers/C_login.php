<?php defined('BASEPATH') OR exit('No direct access allowed');

	class C_login extends CI_Controller{
		public function __construct(){
			parent::__construct();
			$this->load->model('M_login');
			$this->load->model("M_admin");
		}

		public function index(){
			$this->load->view("login/v_login");
		}

		public function aksi_login(){
			$email 		= $this->input->post("email");
			$password 	= $this->input->post("password");

			$where = array(
				"email" 	=> $email,
				"password" 	=> $password
			);

			$cekData =  $this->M_login->cek_login($where);
			//print_r($cekData);die;
			if($cekData >0){
				$cekUser 		= $this->M_login->cek_user($where);
				$id_user 		= $cekUser[0]['id_user'];
				$nama_user 		= $cekUser[0]['nama_user'];
				$id_jabatan 	= $cekUser[0]['id_jabatan'];
				$no_telepon 	= $cekUser[0]['no_telepon'];
				$email 			= $cekUser[0]['email'];
				$password 		= $cekUser[0]['password'];
				$level 			= $cekUser[0]['level'];

				$data_session = array(
					"id_user" 		=> $id_user,
					"nama_user" 	=> $nama_user,
					"id_jabatan" 	=> $id_jabatan,
					"no_telepon" 	=> $no_telepon,
					"email" 		=> $email,
					"password" 		=> $password,
					"level" 		=> $level,
					'status' 		=> "login"
				);

				if($level == "Admin"){
					$this->session->set_userdata($data_session);
					$data['selesai'] = $this->M_admin->meeting_selesai();
					$data['aktif'] = $this->M_admin->meeting_aktif();
					$data['member'] = $this->M_admin->jumlah_member();
					$data['scheduleCancel'] = $this->M_admin->scheduleCancel();
					$data['schdule'] = $this->M_admin->schduleData();
					$data['dataMember'] = $this->M_admin->data_member();
					$data['tidakHadir'] = $this->M_admin->dataTidakHadir();
					$this->load->view("admin/dashboard_admin",$data);
				}else if($level == "Dosen"){
					$this->session->set_userdata($data_session);
					$id_user = $this->session->userdata("id_user");
					$data['list'] = $this->M_admin->list_undangan($id_user);
					$this->load->view("member/undangan_meeting",$data);
				}else{
					$this->session->set_userdata($data_session);
					$data['schedule'] = $this->M_admin->list_schdule();
					$this->load->view("notulen/absen_schedule",$data);
				}
			}else{
				$this->session->set_flashdata('gagalLogin','Username atau Password Salah');
				$this->load->view("login/v_login");
			}
		}

		public function logout(){
			$this->session->sess_destroy();
			$this->load->view("login/v_login");
		}
	}
?>