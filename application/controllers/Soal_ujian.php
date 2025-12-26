<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class soal_ujian extends CI_Controller {

	public function __construct() 
	{
		parent::__construct();
		if ($this->session->userdata('status') !='admin_login') {
			if ($this->session->userdata('status') !='guru_login'){
				redirect('auth');
			}
		}
		$this->load->model('m_soal');
	}

	public function index()
	{	
		$id_mapel = $this->input->get('id');
		$id_kelas = $this->input->get('id_kelas');

		$where = "";
		if ($id_mapel) {
			$where .= " AND tb_soal_ujian.id_matapelajaran='$id_mapel'";
		}
		if ($id_kelas) {
			$where .= " AND tb_soal_ujian.id_kelas='$id_kelas'";
		}

		$data['soal_ujian'] = $this->db->query("SELECT * FROM tb_soal_ujian join tb_matapelajaran ON tb_soal_ujian.id_matapelajaran=tb_matapelajaran.id_matapelajaran WHERE 1=1 $where order by id_soal_ujian desc")->result();
		$data['kelas']=$this->m_data->get_data('tb_matapelajaran')->result();
		$data['list_kelas']=$this->m_data->get_data('tb_kelas')->result();
		$this->load->view('admin/v_soal_ujian', $data);
	}

	public function edit($id)
	{
		if ($this->session->userdata('status') != 'guru_login') {
			redirect('soal_ujian');
		}
		$data['soal']=$this->m_soal->get_joinsoal($id)->result();
		$data['kelas']=$this->m_data->get_data('tb_matapelajaran')->result();
		$data['list_kelas']=$this->m_data->get_data('tb_kelas')->result();		
		$this->load->view('admin/v_soal_ujian_edit', $data);		
	}

	public function update()
	{
		if ($this->session->userdata('status') != 'guru_login') {
			redirect('soal_ujian');
		}
		$id 					= $this->input->post('id');
		$nama_matapelajaran 	= $this->input->post('nama_matapelajaran');
		$id_kelas 				= $this->input->post('id_kelas');
		$soal					= $this->input->post('soal');
		$a 						= $this->input->post('a');
		$b						= $this->input->post('b');
		$c						= $this->input->post('c');
		$d						= $this->input->post('d');
		$e						= $this->input->post('e');
		$kunci					= $this->input->post('kunci');

		$where = array('id_soal_ujian'=>$id);
		$data = array(
			'id_matapelajaran'=>$nama_matapelajaran,
			'id_kelas'=>$id_kelas,
			'pertanyaan'=>$soal,
			'a'=>$a,
			'b'=>$b,
			'c'=>$c,
			'd'=>$d,
			'e'=>$e,
			'kunci_jawaban'=>$kunci
		);
		$this->m_data->update_data($where, $data, 'tb_soal_ujian');
		$this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><h4><i class="icon fa fa-check"></i> Selamat, Soal telah berhasil diupdate!</h4></div>');
		redirect(base_url('soal_ujian'));
	}	

	public function hapus($id) 
	{
		if ($this->session->userdata('status') != 'guru_login') {
			redirect('soal_ujian');
		}
		$where = array(
					'id_soal_ujian'=>$id
				);
		$this->m_data->delete_data($where,'tb_soal_ujian');
		$this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><h4><i class="icon fa fa-check"></i> Perhatian, Data telah berhasil dihapus!</h4></div>');
		redirect(base_url('soal_ujian'));
	}
}