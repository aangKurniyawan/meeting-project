<?php
	class M_admin extends CI_Model{

		public function insert_user($data){
			$query = $this->db->insert("tb_user",$data);
			return $query;
		}

		public function data_user(){
			$query = $this->db->query(" SELECT a.*,b.* FROM tb_user a
				LEFT JOIN m_jabatan b ON a.id_jabatan = b.id_jabatan
				where a.deleted !=1")->result_array();
			return $query;
		}

		public function update_user($whereid,$data){
			$this->db->where($whereid);
			$query = $this->db->update("tb_user",$data);
			return $query;
		}

		public function delete_user($whereid,$data){
			$this->db->where($whereid);
			$query = $this->db->update("tb_user",$data);
			return $query;
		}

		public function cekPhoneMember($wherePhone){
			$this->db->where($wherePhone);
			$query = $this->db->get("tb_user");
			return $query->num_rows();
		}

		public function cekEmailMember($whereEmail){
			$this->db->where($whereEmail);
			$query = $this->db->get("tb_user");
			return $query->num_rows();
		}

		public function simpan_jabatan($data){
			$query = $this->db->insert("m_jabatan",$data);
			return $query;
		}

		public function cek_jabatan($data){
			$this->db->where($data);
			$query = $this->db->get("m_jabatan");
			return $query->num_rows();
		}

		public function dataJabatan(){
			$query = $this->db->get("m_jabatan");
			return $query->result_array();
		}

		public function edit_jabatan($where,$data){
			$this->db->where($where);
			$query = $this->db->update("m_jabatan",$data);
			return $query;
		}

		public function hapus_jabatan($where){
			$this->db->where($where);
			$query = $this->db->delete("m_jabatan");
			return $query;
		}

		public function list_room(){
			$query = $this->db->query("SELECT * FROM m_room WHERE deleted !='1'");
			return $query->result_array();
		}

		public function cek_room($data){
			$nama_ruangan = $data['nama_ruangan'];
			$query = $this->db->query("SELECT * FROM m_room WHERE nama_ruangan 
			LIKE '%$nama_ruangan%'  AND deleted !='1'")->num_rows();
			return $query;
		}

		public function addRoom($data){
			$query = $this->db->insert("m_room",$data);
			return $query;
		}

		public function updateRoom($where,$data){
			$this->db->where($where);
			$query = $this->db->update("m_room",$data);
			return $query;
		}

		public function delete_room($where,$data){
			$this->db->where($where);
			$query = $this->db->update("m_room",$data);
			return $query;
		}

		public function cek_schedule($data){
			$tanggal 		= $data["tanggal"];
			$requestor 		= $data["requestor"];
			$tittle_meeting = $data["tittle_meeting"];
			$id_room 		= $data['id_room'];
			$starting_hour 	= $data["starting_hour"];
			$ending_hour 	= $data["ending_hour"];
			//print_r($ending_hour);die;
			$query = $this->db->query("SELECT * FROM schedule WHERE tanggal='$tanggal' AND requestor='$requestor'
			 		AND tittle_meeting='$tittle_meeting' AND id_room ='$id_room' AND starting_hour='$starting_hour' 
			 		AND ending_hour='$ending_hour' AND status='Aktif' AND deleted='0'");
			return $query->num_rows();
		}

		public function insert_schedule($data){
			$query = $this->db->insert("schedule",$data);
			return $query;
		}

		public function list_schdule(){
			$query = $this->db->query("SELECT a.*,b.* FROM schedule a
			LEFT JOIN m_room b ON a.id_room = b.id_room WHERE a.deleted !='1' ORDER BY id_schedule DESC ")->result_array();
			return $query;
		}

		public function schedule_delete($where,$data){
			$this->db->where($where);
			$query = $this->db->update("schedule",$data);
			return $query;
		}

		public function update_schedule($where,$data){
			$this->db->where($where);
			$query = $this->db->update("schedule",$data);
			return $query;
		}

		public function detailScedule($where){
			$this->db->where($where);
			$this->db->select('*');
			$this->db->from('schedule');
			$this->db->join('m_room', 'm_room.id_room = schedule.id_room');
			$query = $this->db->get();
			return $query->result_array();
		}

		public function listMember(){
			$query = $this->db->query(" SELECT a.*,b.* FROM tb_user a
				LEFT JOIN m_jabatan b ON a.id_jabatan = b.id_jabatan
				WHERE a.level='Dosen' AND a.deleted !=1")->result_array();
			return $query;
		}

		public function list_member_absent($id_schedule){
			$query = $this->db->query("select a.*,b.*,c.*,d.nama_jabatan from absent a 
			left join tb_user b on a.id_user = b.id_user
			left join schedule c on c.id_schedule = a.id_schedule
			left join m_jabatan d on b.id_jabatan = d.id_jabatan
			where b.deleted !='1' and a.status_konfirmasi = 'Terdaftar' and a.id_schedule='$id_schedule'")->result_array();
			return $query;
		}

		public function list_member_hadir($id_schedule){
			$query = $this->db->query("select a.*,b.*,c.*,d.nama_jabatan from absent a 
			left join tb_user b on a.id_user = b.id_user
			left join schedule c on c.id_schedule = a.id_schedule
			left join m_jabatan d on b.id_jabatan = d.id_jabatan
			where b.deleted !='1' and a.status_konfirmasi = 'Hadir' and a.id_schedule='$id_schedule'")->result_array();
			return $query;
		}

		public function cek_absen($data){
			$id_user = $data['id_user'];
			$id_schedule = $data['id_schedule'];

			$query = $this->db->query("SELECT * FROM absent WHERE id_schedule = '$id_schedule' AND id_user = '$id_user'")->num_rows();
			return $query;
		}

		public function addAbsen($data){
			$query = $this->db->insert("absent",$data);
			return $query;
		}

		public function updateHadir($where,$whereUser,$data){
			$this->db->where($where);
			$this->db->where($whereUser);
			$query = $this->db->update("absent",$data);
			return $query;
		}

		public function add_result($data){
			$query = $this->db->insert("meetingresults",$data);
			return $query;
		}

		public function list_undangan($id_user){
			$query = $this->db->query("select a.*,b.*,c.*,d.*  from absent a 
			left join schedule b on a.id_schedule = b.id_schedule
			left join tb_user c on a.id_user = c.id_user
			left join m_room d on b.id_room = b.id_room
			where a.id_user='$id_user' and b.deleted !='1' 
			and b.status='Aktif' and a.status_konfirmasi !='Hadir' 
			group by a.id_schedule")->result_array();
			return $query;
		}

		public function update_konfirmasi($whereSchdule,$whereUser,$data){
			$this->db->where($whereSchdule);
			$this->db->where($whereUser);
			$query = $this->db->update("absent",$data);
			return $query;
		}

		public function riwayat_meeting($id_user){
			$query = $this->db->query("select a.*,b.*,c.*,d.*  from absent a 
			left join schedule b on a.id_schedule = b.id_schedule
			left join tb_user c on a.id_user = c.id_user
			left join m_room d on b.id_room = b.id_room
			where a.id_user='$id_user' and b.deleted !='1' group by a.id_schedule")->result_array();
			return $query;
		}

		public function result_meeting($id_schedule){
			$query = $this->db->query("select a.*,b.* from meetingresults a
			left join schedule b on a.id_schedule = b.id_schedule
			where a.id_schedule='$id_schedule'")->result_array();
			return $query;
		}

		public function meeting_selesai(){
			$query = $this->db->query("select count(*) as data from schedule where status='Selesai'")->result_array();
			return $query;
		}

		public function meeting_aktif(){
			$query = $this->db->query("select count(*) as data from schedule where status='Aktif' and deleted !='1'")->result_array();
			return $query;
		}

		public function jumlah_member(){
			$query = $this->db->query("select count(*) as data from tb_user where level ='Dosen' and deleted !='1'")->result_array();
			return $query;
		}

		public function scheduleCancel(){
			$query = $this->db->query("select count(*) as data from schedule where status='Batal'")->result_array();
			return $query;
		}

		public function schduleData(){
			$query = $this->db->query("select a.*,b.* from schedule a 
				left join m_room b on a.id_room = b.id_room 
				where a.status='Aktif' and a.deleted !='1' order by id_schedule desc limit 6")->result_array();
			return $query;
		}

		public function data_member(){
			$query = $this->db->query("select * from tb_user where level ='Dosen' 
				and deleted !='1' order by id_user desc limit 5")->result_array();
			return $query;
		}

		public function dataTidakHadir(){
			$query = $this->db->query("select a.*,b.*,c.*,d.* from absent a
			left join schedule b on a.id_schedule = b.id_schedule
			left join tb_user c on a.id_user = c.id_user
			left join m_room d on b.id_room = d.id_room
			where a.status_konfirmasi='Tidak Hadir' and c.level='Dosen'")->result_array();
			return $query;
		}

		public function meetingReport(){
			$query = $this->db->query("select a.*,b.*,c.*,count(id_user)as jumlah from absent a 
			left join schedule b on a.id_schedule = b.id_schedule
			left join m_room c on b.id_room = c.id_room
			where b.deleted !='1'
			group by b.id_schedule ")->result_array();
			return $query;
		}

		public function cekResult($where){
			$this->db->where($where);
			$query = $this->db->get("meetingresults");
			return $query->num_rows();
		}

		public function persentase($id_schedule){
			$query = $this->db->query("SELECT id_schedule,
			count(id_user) as Total,
			sum(case when status_konfirmasi='Terdaftar' then 1 else 0 end) as Terdaftar,
			sum(case when status_konfirmasi='Bisa Hadir' then 1 else 0 end) as Konfirmasi_Hadir,
			sum(case when status_konfirmasi='Hadir' then 1 else 0 end) as Hadir,
			sum(case when status_konfirmasi='Tidak Hadir' then 1 else 0 end) as Tidak_Hadir
			FROM absent
			where id_schedule='$id_schedule'
			group by id_schedule");
			return $query->result_array();
		}

		public function confirmation($id_schedule){
			$query = $this->db->query("select a.*,b.*,c.*,d.nama_jabatan from absent a 
			left join tb_user b on a.id_user = b.id_user
			left join schedule c on c.id_schedule = a.id_schedule
			left join m_jabatan d on b.id_jabatan = d.id_jabatan
			where b.deleted !='1' and a.status_konfirmasi = 'Bisa Hadir' and a.id_schedule='$id_schedule'")->result_array();
			return $query;
		}

		public function notpresent($id_schedule){
			$query = $this->db->query("select a.*,b.*,c.*,d.nama_jabatan from absent a 
			left join tb_user b on a.id_user = b.id_user
			left join schedule c on c.id_schedule = a.id_schedule
			left join m_jabatan d on b.id_jabatan = d.id_jabatan
			where b.deleted !='1' and a.status_konfirmasi = 'Tidak Hadir' and a.id_schedule='$id_schedule'")->result_array();
			return $query;
		}
	}
?>