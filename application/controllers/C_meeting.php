<?php 
	defined('BASEPATH') OR exit('No direct access allowed');
	class C_meeting extends CI_Controller{

		public function __construct(){
			parent:: __construct();
			if($this->session->userdata('status') != "login"){
				$this->load->view("login/v_login");
			}
			$this->load->helper('form');
			$this->load->model("M_admin");
		}

		public function index(){
			$data['selesai'] = $this->M_admin->meeting_selesai();
			$data['aktif'] = $this->M_admin->meeting_aktif();
			$data['member'] = $this->M_admin->jumlah_member();
			$data['scheduleCancel'] = $this->M_admin->scheduleCancel();
			$data['schdule'] = $this->M_admin->schduleData();
			$data['dataMember'] = $this->M_admin->data_member();
			$data['tidakHadir'] = $this->M_admin->dataTidakHadir();
			$this->load->view('admin/dashboard_admin',$data);
		}

		public function add_user(){
			$data['user'] 		= $this->M_admin->data_user();
			$data['jabatan'] = $this->M_admin->dataJabatan();
			$this->load->view('admin/add_member',$data);
		}

		public function user_add(){
			$nama_user 		= $this->input->post("nama_user");
			$id_jabatan 	= $this->input->post("id_jabatan");
			$no_telepon		= $this->input->post("no_telepon");
			$email 			= $this->input->post("email");
			$password 		= $this->input->post("password");
			$level 			= $this->input->post("level");

			$data = array(
				"nama_user" 	=> $nama_user,
				"id_jabatan" 	=> $id_jabatan,
				"no_telepon" 	=> $no_telepon,
				"email" 		=> $email,
				"password"		=> $password,
				"level"	 		=> $level,
				"deleted" 		=> 0
			);
			$wherePhone 	= array("no_telepon" => $no_telepon);
			$whereEmail  	= array("email" => $email); 
			$cekPhoneMember = $this->M_admin->cekPhoneMember($wherePhone);
			$cekEmailMember = $this->M_admin->cekEmailMember($whereEmail);
			//print_r($cekEmailMember);die;
			if($cekPhoneMember >= '1' && $cekEmailMember >= '1'){
				$this->session->set_flashdata('duplicat','No Telepon dan Email Sudah Terdaftar');
			}else if($cekPhoneMember >= '1'){
				$this->session->set_flashdata('phone','No Telepon Sudah Terdaftar');
			}else if($cekEmailMember >= '1'){
				$this->session->set_flashdata('email','Email Sudah Terdaftar');
			}else{
				$this->session->set_flashdata('success','Data Berhasil Disimpan');
				$insert = $this->M_admin->insert_user($data);
			}
			$data['user'] 		= $this->M_admin->data_user();
			$data['jabatan'] 	= $this->M_admin->dataJabatan();
			$this->load->view('admin/add_member',$data);
		}

		public function user_edit(){
			$id_user 		= $this->input->post("id_user");
			$nama_user 		= $this->input->post("nama_user");
			$id_jabatan 	= $this->input->post("id_jabatan");
			$no_telepon 	= $this->input->post("no_telepon");
			$email 			= $this->input->post("email");
			$password 		= $this->input->post("password");
			$level 			= $this->input->post("level");
			
			$data 			= array(
					"nama_user" 	=> $nama_user,
					"id_jabatan" 	=> $id_jabatan,
					"no_telepon" 	=> $no_telepon,
					"email" 		=> $email,
					"password" 		=> $password,
					"level" 		=> $level
				);
			$whereid 		= array("id_user" 	 => $id_user);
			$wherePhone 	= array("no_telepon" => $no_telepon);
			$whereEmail  	= array("email" 	 => $email); 
			$cekPhoneMember = $this->M_admin->cekPhoneMember($wherePhone);
			$cekEmailMember = $this->M_admin->cekEmailMember($whereEmail);
			// if($cekPhoneMember >= '1' && $cekEmailMember >= '1'){
			// 	$this->session->set_flashdata('duplicat','No Telepon dan Email Sudah Terdaftar');
			// }else{
				$this->session->set_flashdata('successedit','Data Berhasil Dirubah');
				$update = $this->M_admin->update_user($whereid,$data);
				//print_r($email);die;
			// }
			$data['user'] 		= $this->M_admin->data_user();
			$data['jabatan'] 	= $this->M_admin->dataJabatan();
			$this->load->view('admin/add_member',$data);
		}

		public function delete_user(){
			$id_user 		= $this->input->post("id_user");
			$whereid 		= array("id_user" => $id_user);
			$data 			= array("deleted" => 1);
			$delete = $this->M_admin->delete_user($whereid,$data);
			if($delete == 1){
				$this->session->set_flashdata('userSuksesDelete','User Sudah Terhapus');
			}else{
				$this->session->set_flashdata('userGagalDelete','User Gagal Terhapus');
			}
			$data['user'] 		= $this->M_admin->data_user();
			$data['jabatan'] 	= $this->M_admin->dataJabatan();
			$this->load->view('admin/add_member',$data);
		}

		public function menu_jabatan(){
			$data['jabatan'] = $this->M_admin->dataJabatan();
			$this->load->view('admin/data_jabatan',$data);
		}

		public function add_jabatan(){
			$nama_jabatan = $this->input->post("nama_jabatan");
			$data = array(
				"nama_jabatan" 	=> $nama_jabatan,
				"deleted" 		=> 0
			);
			$cekJabatan = $this->M_admin->cek_jabatan($data);

			if($cekJabatan == '1'){
				$this->session->set_flashdata('jabatan','Nama Jabatan Sudah Terdaftar');
			}else{
				$this->session->set_flashdata('simpan_jabatan','Data Berhasil Disimpan');
				$insert = $this->M_admin->simpan_jabatan($data);
			}
			$data['jabatan'] = $this->M_admin->dataJabatan();
			$this->load->view('admin/data_jabatan',$data);
		}

		public function edit_jabatan(){
			$id_jabatan   = $this->input->post("id_jabatan");
			$nama_jabatan = $this->input->post("nama_jabatan");
			$where = array("id_jabatan" => $id_jabatan);
			$data = array(
				"nama_jabatan" 	=> $nama_jabatan,
				"deleted" 		=> 1
			);
			$cekJabatan = $this->M_admin->cek_jabatan($data);
			if($cekJabatan == '1'){
				$this->session->set_flashdata('jabatanDuplicatEdit','Nama Jabatan Sudah Terdaftar');
			}else{
				$this->session->set_flashdata('simpan_jabatanEdit','Data Berhasil Dirubah');
				$update = $this->M_admin->edit_jabatan($where,$data);
			}
			$data['jabatan'] = $this->M_admin->dataJabatan();
			$this->load->view('admin/data_jabatan',$data);
		}

		public function delete_jabatan(){
			$id_jabatan   = $this->input->post("id_jabatan");
			$where = array("id_jabatan" => $id_jabatan);
			$delete = $this->M_admin->hapus_jabatan($where);
			if($delete == 1){
				$this->session->set_flashdata('jabatanSuksesDelete','Nama Jabatan Sudah Terhapus');
			}else{
				$this->session->set_flashdata('jabatanGagalDelete','Nama Jabatan Gagal Terhapus');
			}
			$data['jabatan'] = $this->M_admin->dataJabatan();
			$this->load->view('admin/data_jabatan',$data);
		}

		public function menu_room(){
			$data['room'] = $this->M_admin->list_room();
			$this->load->view("admin/data_room",$data);
		}

		public function add_room(){
			$nama_ruangan = $this->input->post("nama_ruangan");
			$data = array(
				"nama_ruangan" 	=> $nama_ruangan,
				"deleted" 		=> 0
			);
			$cekRoom = $this->M_admin->cek_room($data);
			if($cekRoom == 1){
				$this->session->set_flashdata('cekRoom','Nama Ruangan Sudah Terdaftar Pada Sistem');
			}else{
				$insert = $this->M_admin->addRoom($data);
				if($insert == 1){
					$this->session->set_flashdata('addRoomSuccess','Nama Ruangan Berhasil Ditambah Pada Sistem');
				}else{
					$this->session->set_flashdata('addRoomFailed','Nama Ruangan Gagal Terdaftar Pada Sistem');
				}
			}
			$data['room'] = $this->M_admin->list_room();
			$this->load->view("admin/data_room",$data);
		}

		public function edit_room(){
			$id_room 		= $this->input->post("id_room");
			$nama_ruangan 	= $this->input->post("nama_ruangan");
			$where = array("id_room" => $id_room);
			$data  = array("nama_ruangan" => $nama_ruangan);
			$update = $this->M_admin->updateRoom($where,$data);
			if($update == 1){
				$this->session->set_flashdata('editRoomSuccess','Nama Ruangan Berhasil Dirubah Pada Sistem');
			}else{
				$this->session->set_flashdata('editRoomFailed','Nama Ruangan Gagal Dirubah Pada Sistem');
			}
			$data['room'] = $this->M_admin->list_room();
			$this->load->view("admin/data_room",$data);
		}

		public function delete_room(){
			$id_room 		= $this->input->post("id_room");
			$where = array("id_room" => $id_room);
			$data  = array("deleted" => 1);

			$delete = $this->M_admin->delete_room($where,$data);
			if($delete == 1){
				$this->session->set_flashdata('deleteRoomSuccess','Nama Ruangan Berhasil Dihapus Pada Sistem');
			}else{
				$this->session->set_flashdata('deleteRoomFailed','Nama Ruangan Gagal Dihapus Pada Sistem');
			}
			$data['room'] = $this->M_admin->list_room();
			$this->load->view("admin/data_room",$data);
		}

		public function add_schedule(){
			$data['schedule'] = $this->M_admin->list_schdule();
			$data['room'] = $this->M_admin->list_room();
			$this->load->view('admin/add_schedule',$data);
		}

		public function schedule_add(){
			$tanggal 		= $this->input->post("tanggal");
			$requestor 		= $this->input->post("requestor");
			$tittle_meeting = $this->input->post("tittle_meeting");
			$id_room 		= $this->input->post("id_room");
			$starting_hour 	= $this->input->post("starting_hour");
			$ending_hour 	= $this->input->post("ending_hour");

			$data = array(
				"tanggal" 			=> $tanggal,
				"requestor" 		=> $requestor,
				"tittle_meeting" 	=> $tittle_meeting,
				"id_room" 			=> $id_room,
				"starting_hour" 	=> $starting_hour,
				"ending_hour" 		=> $ending_hour,
				"status" 			=> "Aktif",
				"deleted" 			=> 0
			);

			$cekSchedule = $this->M_admin->cek_schedule($data);
			//print_r($cekSchedule);die;
			if($cekSchedule == 1){
				$this->session->set_flashdata('duplicatSchedule2','Schedule Sudah Terdaftar1');
			}else{
				$insert = $this->M_admin->insert_schedule($data);
				//print_r($insert);die;
				if($insert == 1){
					$this->session->set_flashdata('simpanSchedule','Schedule Berhasil Disimpan');
				}else{
					$this->session->set_flashdata('gagalSchedule','Schedule Gagal Disimpan');
				}
			}
			$data['room'] = $this->M_admin->list_room();
			$data['schedule'] = $this->M_admin->list_schdule();
			$this->load->view('admin/add_schedule',$data);
		}

		public function delete_schdeule(){
			$id_schedule = $this->input->post("id_schedule");
			$where = array("id_schedule" => $id_schedule);
			$data  = array("deleted" => 1);

			$delete = $this->M_admin->schedule_delete($where,$data);
			//print_r($id_schedule);die;
			if($delete == 1){
				$this->session->set_flashdata('berhasilDeleteSchedule','Schedule Berhasil Dihapus');
			}else{
				$this->session->set_flashdata('gagalDeleteSchedule','Schedule Gagal Dihapus');
			}
			$data['room'] = $this->M_admin->list_room();
			$data['schedule'] = $this->M_admin->list_schdule();
			$this->load->view('admin/add_schedule',$data);
		}

		public function schedule_edit(){
			$id_schedule 	= $this->input->post("id_schedule");
			$tanggal 		= $this->input->post("tanggal");
			$requestor 		= $this->input->post("requestor");
			$tittle_meeting = $this->input->post("tittle_meeting");
			$id_room 		= $this->input->post("id_room");
			$starting_hour 	= $this->input->post("starting_hour");
			$ending_hour 	= $this->input->post("ending_hour");
			$status 		= $this->input->post("status");

			$where = array("id_schedule" => $id_schedule);
			$data = array(
				"tanggal" 			=> $tanggal,
				"requestor" 		=> $requestor,
				"tittle_meeting" 	=> $tittle_meeting,
				"id_room" 			=> $id_room,
				"starting_hour" 	=> $starting_hour,
				"ending_hour" 		=> $ending_hour,
				"status" 			=> $status,
				"deleted" 			=> 0
			);

			$update = $this->M_admin->update_schedule($where,$data);

			if($update == 1){
				$this->session->set_flashdata('berhasilUpdateSchedule','Schedule Berhasil Di Edit');
			}else{
				$this->session->set_flashdata('gagallUpdateSchedule','Schedule Berhasil Di Edit');
			}
			$data['room'] = $this->M_admin->list_room();
			$data['schedule'] = $this->M_admin->list_schdule();
			$this->load->view('admin/add_schedule',$data);
		}

		public function detail_schedule(){
			$id_schedule = $this->uri->segment(2);
			$where = array("id_schedule" => $id_schedule);
			$data['memberList'] 	= $this->M_admin->list_member_absent($id_schedule);
			$data['memberAtendance'] = $this->M_admin->list_member_hadir($id_schedule);
			$data['detailScedule']  = $this->M_admin->detailScedule($where);
			$data['member'] 		= $this->M_admin->listMember();
			$data['persentase'] 	= $this->M_admin->persentase($id_schedule);
			$this->load->view('admin/detail_schedule',$data);
		}

		public function add_absen(){
			date_default_timezone_set('Asia/Karachi'); # add your city to set local time zone
			$now = date('Y-m-d H:i:s');
			$id_schedule = $this->input->post("id_schedule");
			$id_user 	 = $this->input->post("id_user");
			$mailTo 	 = $this->input->post("email");
			$tittle_meeting = $this->input->post("tittle_meeting");
			$link = "http://localhost/project-meeting/";
			
			$config = array(  
			    'protocol'  => 'smtp',  
			    'smtp_host' => 'ssl://smtp.googlemail.com',  
			    'smtp_port' =>  465,  
			    'smtp_user' => 'aangmkom2017@gmail.com',   
			    'smtp_pass' => 'suhceetadxmqfhtz',   
			    'mailtype'  => 'html',   
			    'charset'   => 'iso-8859-1'  
			   );  
			   $this->load->library('email', $config);  
			   $this->email->set_newline("\r\n");  
			   $this->email->from('aangmkom2017@gmail.com', 'Admin Re:Undangan Meeting');   
			   $this->email->to($mailTo);   
			   $this->email->subject('Undangan Konfirmasi Kehadiran Meeting : ' . $tittle_meeting);   
			   $this->email->message("Silahkan klik link dibawah ini untuk masuk ke sistem
			    dan silahkan login sesuai dengan username yang anda miliki 
			    ".$link);  
			   if (!$this->email->send()) {  
			    $this->session->set_flashdata('emailGagal','Pesan Email Gagal Terkirim Email Tidak Terdaftar');    
			   }else{  
			    $this->session->set_flashdata('emailBerhasil','Pesan Email Sudah Terkirim');   
			   }  
			$where = array("id_schedule" => $id_schedule);
			$data = array(
				"id_schedule" 		=> $id_schedule,
				"id_user" 			=> $id_user,
				"status_konfirmasi" => "Terdaftar",
				"tgl_konfirmasi" 	=> $now
			);

			$cekAbsen = $this->M_admin->cek_absen($data);
			if($cekAbsen == 1){
				$this->session->set_flashdata('gagalAddAbsen','Peserta Sudah Terdaftar Pada Sistem');
			}else{
				$this->session->set_flashdata('berhasilAddAbsen','Peserta Berhasil Terdaftar Pada Sistem');
				$insert = $this->M_admin->addAbsen($data);
			}
			$data['memberList'] 		= $this->M_admin->list_member_absent($id_schedule);
			$data['memberAtendance'] 	= $this->M_admin->list_member_hadir($id_schedule);
			$data['detailScedule']  	= $this->M_admin->detailScedule($where);
			$data['member'] 			= $this->M_admin->listMember();
			$data['persentase'] 	 	= $this->M_admin->persentase($id_schedule);
			$this->load->view('admin/detail_schedule',$data);
		}

		public function konfirmasi_hadir(){
			$id_schedule = $this->input->post("id_schedule");
			$id_user 	 = $this->input->post("id_user");
			$where = array("id_schedule" => $id_schedule);
			$whereUser = array("id_user" => $id_user);
			$data = array(
				"status_konfirmasi" => "Hadir"
			);

			$insert = $this->M_admin->updateHadir($where,$whereUser,$data);
			if($insert == 1){
				$this->session->set_flashdata('berhasilHadir','Konfirmasi Hadir Berhasil');
			}else{
				$this->session->set_flashdata('gagalHadir','Konfirmasi Hadir Gagal');
			}
			$data['memberList'] 	 = $this->M_admin->list_member_absent($id_schedule);
			$data['memberAtendance'] = $this->M_admin->list_member_hadir($id_schedule);
			$data['detailScedule']   = $this->M_admin->detailScedule($where);
			$data['member'] 		 = $this->M_admin->listMember();
			$data['persentase'] 	 = $this->M_admin->persentase($id_schedule);
			$data['confirmation'] 	 = $this->M_admin->confirmation($id_schedule);
			$data['present'] 		 = $this->M_admin->list_member_hadir($id_schedule);
			$this->load->view('admin/absent_list',$data);
		}

		public function list_user_member(){
			$data = $this->M_admin->listUserMember();
			echo json_encode($data);
		}

		public function data_member(){
			$data['user'] 		= $this->M_admin->data_user();
			$data['jabatan'] 	= $this->M_admin->dataJabatan();
			$this->load->view('admin/data_member',$data);
		}


		public function status(){
			$this->load->view('admin/status');
		}

		public function data_schedule(){
			$this->load->view('admin/data_schedule');
		}

		public function absent(){
			$data['schedule'] = $this->M_admin->list_schdule();
			$this->load->view('admin/absent',$data);
		}

		public function absent_list(){
			$id_schedule = $this->uri->segment(2);
			$where = array("id_schedule" => $id_schedule);
			$data['memberList'] 		= $this->M_admin->list_member_absent($id_schedule);
			$data['present'] 			= $this->M_admin->list_member_hadir($id_schedule);
			$data['detailScedule'] 		= $this->M_admin->detailScedule($where);
			$data['member'] 			= $this->M_admin->listMember();
			$data['persentase'] 	 	= $this->M_admin->persentase($id_schedule);
			$data['confirmation'] 		= $this->M_admin->confirmation($id_schedule);
			$this->load->view('admin/absent_list',$data);
		}

		public function meeting_list(){
			$data['schedule'] = $this->M_admin->list_schdule();
			$this->load->view('admin/meeting_list',$data);
		}

		public function meeting_result(){
			$id_schedule = $this->uri->segment(2);
			$where = array("id_schedule" => $id_schedule);
			$data['memberList'] 	= $this->M_admin->list_member_absent($id_schedule);
			$data['memberAtendance'] = $this->M_admin->list_member_hadir($id_schedule);
			$data['detailScedule']  = $this->M_admin->detailScedule($where);
			$data['member'] 		= $this->M_admin->listMember();
			$data['persentase'] 	 = $this->M_admin->persentase($id_schedule);
			$this->load->view('admin/meeting_result',$data);
		}

		public function add_result(){
			$id_schedule 	= $this->input->post("id_schedule");
			$tanggal 		= $this->input->post("tanggal");
			$tittle_meeting = $this->input->post("tittle_meeting");
			$budget_set 	= $this->input->post("budget_set");
			$budget_used 	= $this->input->post("budget_used");
			$meeting_notes 	= $this->input->post("meeting_notes");

			$data = array(
				"id_schedule" 		=> $id_schedule,
				"tanggal" 			=> $tanggal,
				"budget_set" 		=> $budget_set,
				"budget_used" 		=> $budget_used,
				"meeting_notes" 	=> $meeting_notes
			);
			$where = array("id_schedule" => $id_schedule);
			$cek_result = $this->M_admin->cekResult($where);
			if($cek_result >='1'){
				$this->session->set_flashdata('duplicatResult','Hasil Meeting Sudah Di Masukan Oleh User Lain');
			}else{
				$insert_result = $this->M_admin->add_result($data);
				if($insert_result == 1){
					$this->session->set_flashdata('berhasilResult','Berhasil Simpan Result Meeting');
				}else{
					$this->session->set_flashdata('gagalResult','Gagal Simpan Result Meeting');
				}
			}
			$data['schedule'] = $this->M_admin->list_schdule();
			$this->load->view('admin/meeting_list',$data);
		}

		public function meeting_report(){
			$data['report'] = $this->M_admin->meetingReport();
			$this->load->view('admin/meeting_report',$data);
		}

		public function detailReport(){
			$id_schedule = $this->uri->segment(2);
			$where = array("id_schedule" => $id_schedule);
			$data['memberList'] 	= $this->M_admin->list_member_absent($id_schedule);
			$data['confirmation'] 	= $this->M_admin->confirmation($id_schedule);
			$data['notpresent'] 	= $this->M_admin->notpresent($id_schedule);
			$data['present'] 		= $this->M_admin->list_member_hadir($id_schedule);
			$data['detailScedule']  = $this->M_admin->detailScedule($where);
			$data['member'] 		= $this->M_admin->listMember();
			$data['result'] 		= $this->M_admin->result_meeting($id_schedule);
			$data['persentase'] 	 = $this->M_admin->persentase($id_schedule);
			$this->load->view("admin/detail_report",$data);
		}

		public function absen_schedule(){
			$data['schedule'] = $this->M_admin->list_schdule();
			$this->load->view("notulen/absen_schedule",$data);
		}

		public function absent_list_notulen(){
			$id_schedule = $this->uri->segment(2);
			$where = array("id_schedule" => $id_schedule);
			$data['memberList'] 		= $this->M_admin->list_member_absent($id_schedule);
			$data['confirmation'] 		= $this->M_admin->confirmation($id_schedule);
			$data['present'] 			= $this->M_admin->list_member_hadir($id_schedule);
			$data['detailScedule']  	= $this->M_admin->detailScedule($where);
			$data['member'] 			= $this->M_admin->listMember();
			$data['persentase'] 	 	= $this->M_admin->persentase($id_schedule);
			$this->load->view('notulen/absent_list_notulen',$data);
		}

		public function konfirmasi_hadir_notulen(){
			$id_schedule = $this->input->post("id_schedule");
			$id_user 	 = $this->input->post("id_user");
			$where = array("id_schedule" => $id_schedule);
			$whereUser = array("id_user" => $id_user);
			$data = array(
				"status_konfirmasi" => "Hadir"
			);

			$insert = $this->M_admin->updateHadir($where,$whereUser,$data);
			if($insert == 1){
				$this->session->set_flashdata('berhasilHadir','Berhasil Absen');
			}else{
				$this->session->set_flashdata('gagalHadir','Gagal Absen');
			}
			$data['memberList'] 	 = $this->M_admin->list_member_absent($id_schedule);
			$data['present'] 		 = $this->M_admin->list_member_hadir($id_schedule);
			$data['detailScedule']   = $this->M_admin->detailScedule($where);
			$data['member'] 		 = $this->M_admin->listMember();
			$data['persentase'] 	 = $this->M_admin->persentase($id_schedule);
			$data['confirmation'] 	 = $this->M_admin->confirmation($id_schedule);
			$this->load->view('notulen/absent_list_notulen',$data);
		}
		public function meeting_list_notulen(){
			$data['schedule'] = $this->M_admin->list_schdule();
			$this->load->view('notulen/meeting_list_notulen',$data);
		}

		public function meeting_result_notulen(){
			$id_schedule = $this->uri->segment(2);
			$where = array("id_schedule" => $id_schedule);
			$data['memberList'] 	= $this->M_admin->list_member_absent($id_schedule);
			$data['memberAtendance'] = $this->M_admin->list_member_hadir($id_schedule);
			$data['detailScedule']  = $this->M_admin->detailScedule($where);
			$data['member'] 		= $this->M_admin->listMember();
			$data['persentase'] 	 	= $this->M_admin->persentase($id_schedule);
			$this->load->view('notulen/meeting_result_notulen',$data);
		}

		public function add_result_notulen(){
			$id_schedule 	= $this->input->post("id_schedule");
			$tanggal 		= $this->input->post("tanggal");
			$tittle_meeting = $this->input->post("tittle_meeting");
			$budget_set 	= $this->input->post("budget_set");
			$budget_used 	= $this->input->post("budget_used");
			$meeting_notes 	= $this->input->post("meeting_notes");

			$data = array(
				"id_schedule" 		=> $id_schedule,
				"tanggal" 			=> $tanggal,
				"budget_set" 		=> $budget_set,
				"budget_used" 		=> $budget_used,
				"meeting_notes" 	=> $meeting_notes
			);

			$where = array("id_schedule" => $id_schedule);
			$cek_result = $this->M_admin->cekResult($where);
			//print_r($cek_result);die;
			if($cek_result =='1'){
				$this->session->set_flashdata('duplicatResult','Hasil Meeting Sudah Di Masukan Oleh User Lain');
			}else{
				$insert_result = $this->M_admin->add_result($data);
				if($insert_result == 1){
					$this->session->set_flashdata('berhasilResult','Berhasil Simpan Result Meeting');
				}else{
					$this->session->set_flashdata('gagalResult','Gagal Simpan Result Meeting');
				}
			}
			$data['schedule'] = $this->M_admin->list_schdule();

			$this->load->view('notulen/meeting_list_notulen',$data);
		}

		public function meeting_report_notulen(){
			$data['report'] = $this->M_admin->meetingReport();
			$this->load->view("notulen/meeting_report_notulen",$data);
		}

		public function detailReport_notulen(){
			$id_schedule = $this->uri->segment(2);
			$where = array("id_schedule" => $id_schedule);
			$data['memberList'] 		= $this->M_admin->list_member_absent($id_schedule);
			$data['present'] 			= $this->M_admin->list_member_hadir($id_schedule);
			$data['detailScedule']  	= $this->M_admin->detailScedule($where);
			$data['member'] 			= $this->M_admin->listMember();
			$data['result'] 			= $this->M_admin->result_meeting($id_schedule);
			$data['persentase'] 	 	= $this->M_admin->persentase($id_schedule);
			$data['confirmation'] 		= $this->M_admin->confirmation($id_schedule);
			$data['notpresent'] 		= $this->M_admin->notpresent($id_schedule);
			$this->load->view("notulen/detail_report_notulen",$data);
		}
	}
?>