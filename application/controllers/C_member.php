<?php defined('BASEPATH') OR exit('No direct access allowed');
	class C_member extends CI_Controller{
		public function __construct(){
			parent::__construct();
			if($this->session->userdata('status') != "login"){
				$this->load->view("login/v_login");
			}
			$this->load->model("M_admin");
		}
		public function list_undangan(){
			$id_user = $this->session->userdata("id_user");
			$data['list'] = $this->M_admin->list_undangan($id_user);
			$this->load->view("member/undangan_meeting",$data);
		}

		public function hadir_meeting(){
			$id_user 			= $this->input->post("id_user");
			$id_schedule 		= $this->input->post("id_schedule");
			$status_konfirmasi 	= $this->input->post("status_konfirmasi");
			$whereSchdule 		= array("id_schedule" => $id_schedule);
			$whereUser 			= array("id_user" => $id_user);
			$data 				= array("status_konfirmasi" => $status_konfirmasi);

			$update = $this->M_admin->update_konfirmasi($whereSchdule,$whereUser,$data);
			if($update == 1){
				$this->session->set_flashdata('berhasilKonfirmasi','Konfirmasi Berhasil Disimpan');
			}else{
				$this->session->set_flashdata('gagalKonfirmasi','Gagal Simpan Result Meeting');
			}
			$id_user = $this->session->userdata("id_user");
			$data['list'] = $this->M_admin->list_undangan($id_user);
			$this->load->view("member/undangan_meeting",$data);
		}

		public function riwayat_meeting(){
			$id_user = $this->session->userdata("id_user");
			$data['riwayat'] = $this->M_admin->riwayat_meeting($id_user);
			$this->load->view("member/riwayat_meeting",$data);
		}

		public function detail_meeting_member(){
			$id_schedule = $this->uri->segment(2);
			$where = array("id_schedule" => $id_schedule);
			$data['memberList'] 	= $this->M_admin->list_member_absent($id_schedule);
			$data['memberAtendance'] = $this->M_admin->list_member_hadir($id_schedule);
			$data['detailScedule']  = $this->M_admin->detailScedule($where);
			$data['member'] 		= $this->M_admin->listMember();
			$data['result'] 		= $this->M_admin->result_meeting($id_schedule);
			$this->load->view('member/detail_meeting_member',$data);
		}
	}
?>