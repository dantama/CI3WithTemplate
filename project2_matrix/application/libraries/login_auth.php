<?php if(! defined('BASEPATH')) exit('Akses langsung tidak diperbolehkan'); 

class login_auth 
{
	// SET SUPER GLOBAL
	var $CI = NULL;
	public function __construct() 
	{
		$this->CI =& get_instance();
	}
	// Fungsi login
	public function login($username, $password) 
	{
		$query = $this->CI->db->get_where('users_web',array('username'=>$username,'password' => md5($password)));
		if($query->num_rows() == 1) 
		{
			$row 	= $this->CI->db->query("SELECT * FROM users_web a, guru b WHERE a.pegawai_id=b.id and username ='$username'");
			$admin 	= $row->row();
			
			$id 			= $admin->id;
			$username 		= $admin->username;
			$nama_login 	= $admin->nama_lengkap;
			$user_level 	= $admin->access_level;
			$guru_id 		= $admin->pegawai_id;
			
			//get tahun ajaran
			$thn = $this->CI->db->query("SELECT id FROM tahun_ajaran WHERE tgl_mulai <= '".date('Y-m-d')."' and tgl_akhir >= '".date('Y-m-d')."'");
			$thn_id 	= $thn->row();
			$x 			= $thn_id->id;
			//echo $thn_id->id;

			//get semester
			$smt = $this->CI->db->query("SELECT id FROM semester WHERE bln_awal <= '".date('m')."' and bln_akhir >= '".date('m')."'");
			$semester 	= $smt->row();
			$y 			= $semester->id;

			$this->CI->session->set_userdata('user_name', $nama_login);
			$this->CI->session->set_userdata('id_login', uniqid(rand()));
			$this->CI->session->set_userdata('user_id', $id);
			$this->CI->session->set_userdata('user_level', $user_level);
			$this->CI->session->set_userdata('tahun_ajaran_id', $x);
			$this->CI->session->set_userdata('semester_id', $y);
			$this->CI->session->set_userdata('pegawai_id', $guru_id);
			redirect(site_url('welcome'));
		}
		else
		{
			echo "Username dan password salah !";
			redirect(site_url());
		}
	return false;
	}
	// Proteksi halaman
	public function cek_auth() {
		if($this->CI->session->userdata('user_name') == '') {
			$this->CI->session->set_flashdata('error','Anda belum login');
			redirect(site_url('login'));
		}
	}
	// Fungsi logout
	public function logout() {
		
		$this->CI->session->unset_userdata('user_name');
		$this->CI->session->unset_userdata('id_login');
		$this->CI->session->unset_userdata('user_id');
		$this->CI->session->unset_userdata('user_level');
		$this->CI->session->unset_userdata('tahun_ajaran_id');
		$this->CI->session->unset_userdata('semester_id');
		$this->CI->session->unset_userdata('pegawai_id');
		$this->CI->session->unset_userdata('piket');
		
		$this->CI->session->set_flashdata('success','Anda berhasil logout');
		redirect(site_url('login'));
	}
}