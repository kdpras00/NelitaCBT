<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Akun extends CI_Controller {

	public function __construct() {
		parent::__construct();

		if ($this->session->userdata('status') != 'admin_login') {
			redirect(base_url('auth'));
		}
	}

	public function index()
	{
		$data['akun'] = $this->m_data->get_data('tb_admin')->result();
		$this->load->view('admin/v_akun', $data);
	}

	public function akun_aksi()
	{
		$nama 		= $this->input->post('nama');		
		$username	= $this->input->post('username');
		$password	= $this->input->post('password');

		$data = array(
			'nama_user'=>$nama,
			'username'=>$username,
			'password'=>$password,
		);

		$this->m_data->insert_data($data, 'tb_admin');
		$this->session->set_flashdata('message', '<div class="alert alert-success alert-message"><i class="icon fa fa-check"></i><b>Selamat ! <br></b> Anda telah berhasil menambahkan data admin</div>');
		redirect(base_url('akun'));
	}

	public function hapus($id) 
	{
		$where = array(
					'id'=>$id
				);

		$this->m_data->delete_data($where,'tb_admin');
		$this->session->set_flashdata('message', '<div class="alert alert-danger alert-message"><i class="icon fa fa-check"></i><b>Selamat ! <br></b> Anda telah berhasil menghapus data admin</div>');
		redirect(base_url('akun'));
	}

	public function edit($id) 
	{
		$where	= array('id'=>$id);
		$data['akun']=$this->m_data->edit_data($where,'tb_admin')->result();
		$this->load->view('admin/v_akun_edit',$data);
	}
	
	public function update()
	{
		$id 		= $this->input->post('id');
		$nama 		= $this->input->post('nama');
		$username	= $this->input->post('username');
		$password	= $this->input->post('password');

		$where = array('id'=>$id);		
		$data = array(
						'nama_user'=>$nama,
						'username'=> $username,
						'password'=>$password,
					);
		$this->m_data->update_data($where,$data,'tb_admin');
		$this->session->set_flashdata('message', '<div class="alert alert-success alert-message"><i class="icon fa fa-check"></i><b>Selamat ! <br></b> Anda telah berhasil mengupdate data admin</div>');
		redirect(base_url('akun'));
	}
}
