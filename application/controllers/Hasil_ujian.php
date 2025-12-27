<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Hasil_ujian extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		if ($this->session->userdata('status') != 'admin_login' && $this->session->userdata('status') != 'kepsek_login' && $this->session->userdata('status') != 'guru_login') {
			redirect(base_url('auth'));
		}
		$this->load->model('m_hasil');
		$this->load->library('mypdf');
	}

	public function index()
	{
		if (isset($_GET['id'])) {
			$id = $this->input->get('id');
			$data['hasil'] = $this->m_hasil->get_peserta2($id);
			$data['kelas']=$this->m_data->get_data('tb_matapelajaran')->result();
		} else {
			$data['hasil'] = $this->m_hasil->get_peserta3();
			$data['kelas']=$this->m_data->get_data('tb_matapelajaran')->result();
		}		
		$this->load->view('admin/v_hasil', $data);
	}

	public function print_all()
	{	
		if (isset($_GET['id'])) {
			$id = $this->input->get('id');
			$data['cetak'] = $this->m_hasil->get_peserta2($id);
		} else {
			$data['cetak'] = $this->m_hasil->get_peserta3();
		}
		$this->mypdf->generate('admin/v_cetak', $data, 'Cetak Hasil Ujian ujian', 'A4', 'Landscape');
	}

	public function cetak($id)
	{
		$where = array('id_peserta' => $id);
		$id = $where['id_peserta'];
		$data['cetak'] = $this->m_hasil->cetak($id);
		$this->mypdf->generate('admin/v_cetak', $data, 'Cetak Hasil Ujian ujian', 'A4', 'Landscape');
	}

	public function belum_ujian()
	{
		if (isset($_GET['id'])) {
			$id = $this->input->get('id');
			$data['belum_ujian'] = $this->m_hasil->get_belum_ujian($id);
			$data['kelas']=$this->m_data->get_data('tb_matapelajaran')->result();
			$this->load->view('admin/v_hasil_belum', $data);
		} else {
			redirect(base_url('hasil_ujian'));
		}
	}
	
	public function export_excel()
	{
		if (isset($_GET['id'])) {
			$id = $this->input->get('id');
			$hasil = $this->m_hasil->get_peserta2($id);
		} else {
			$hasil = $this->m_hasil->get_peserta3();
		}

		include APPPATH . 'libraries/PHPExcel.php';
		$excel = new PHPExcel();

		$excel->getProperties()->setCreator("Ujian CBT")
			->setLastModifiedBy("Ujian CBT")
			->setTitle("Data Hasil Ujian")
			->setSubject("Hasil Ujian")
			->setDescription("Data Hasil Ujian Sekolah")
			->setKeywords("Data Hasil Ujian");

		$style_col = array(
			'font' => array('bold' => true),
			'alignment' => array(
				'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
				'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER 
			),
			'borders' => array(
				'top' => array('style'  => PHPExcel_Style_Border::BORDER_THIN), 
				'right' => array('style'  => PHPExcel_Style_Border::BORDER_THIN),  
				'bottom' => array('style'  => PHPExcel_Style_Border::BORDER_THIN), 
				'left' => array('style'  => PHPExcel_Style_Border::BORDER_THIN) 
			)
		);

		$style_row = array(
			'alignment' => array(
				'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER 
			),
			'borders' => array(
				'top' => array('style'  => PHPExcel_Style_Border::BORDER_THIN), 
				'right' => array('style'  => PHPExcel_Style_Border::BORDER_THIN),  
				'bottom' => array('style'  => PHPExcel_Style_Border::BORDER_THIN), 
				'left' => array('style'  => PHPExcel_Style_Border::BORDER_THIN) 
			)
		);

		$excel->setActiveSheetIndex(0)->setCellValue('A1', "HASIL UJIAN");
		$excel->getActiveSheet()->mergeCells('A1:J1');
		$excel->getActiveSheet()->getStyle('A1')->getFont()->setBold(TRUE);
		$excel->getActiveSheet()->getStyle('A1')->getFont()->setSize(15);
		$excel->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

		$excel->setActiveSheetIndex(0)->setCellValue('A3', "NO");
		$excel->setActiveSheetIndex(0)->setCellValue('B3', "NAMA SISWA");
		$excel->setActiveSheetIndex(0)->setCellValue('C3', "NIS");
		$excel->setActiveSheetIndex(0)->setCellValue('D3', "MATA PELAJARAN");
		$excel->setActiveSheetIndex(0)->setCellValue('E3', "TANGGAL UJIAN");
		$excel->setActiveSheetIndex(0)->setCellValue('F3', "JAM UJIAN");
		$excel->setActiveSheetIndex(0)->setCellValue('G3', "JENIS UJIAN");
		$excel->setActiveSheetIndex(0)->setCellValue('H3', "BENAR");
		$excel->setActiveSheetIndex(0)->setCellValue('I3', "SALAH");
		$excel->setActiveSheetIndex(0)->setCellValue('J3', "NILAI");

		$excel->getActiveSheet()->getStyle('A3')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('B3')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('C3')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('D3')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('E3')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('F3')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('G3')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('H3')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('I3')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('J3')->applyFromArray($style_col);

		$no = 1;
		$numrow = 4;
		foreach ($hasil as $data) {
			$excel->setActiveSheetIndex(0)->setCellValue('A' . $numrow, $no);
			$excel->setActiveSheetIndex(0)->setCellValue('B' . $numrow, $data->nama_siswa);
			$excel->setActiveSheetIndex(0)->setCellValue('C' . $numrow, $data->nis);
			$excel->setActiveSheetIndex(0)->setCellValue('D' . $numrow, $data->nama_matapelajaran);
			$excel->setActiveSheetIndex(0)->setCellValue('E' . $numrow, date('d-m-Y', strtotime($data->tanggal_ujian)));
			$excel->setActiveSheetIndex(0)->setCellValue('F' . $numrow, date('H:i:s', strtotime($data->jam_ujian)));
			$excel->setActiveSheetIndex(0)->setCellValue('G' . $numrow, $data->jenis_ujian);
			$excel->setActiveSheetIndex(0)->setCellValue('H' . $numrow, $data->benar == '' ? 'Belum Ujian' : $data->benar);
			$excel->setActiveSheetIndex(0)->setCellValue('I' . $numrow, $data->salah == '' ? 'Belum Ujian' : $data->salah);
			$excel->setActiveSheetIndex(0)->setCellValue('J' . $numrow, $data->nilai == '' ? 'Belum Ujian' : $data->nilai);

			$excel->getActiveSheet()->getStyle('A' . $numrow)->applyFromArray($style_row);
			$excel->getActiveSheet()->getStyle('B' . $numrow)->applyFromArray($style_row);
			$excel->getActiveSheet()->getStyle('C' . $numrow)->applyFromArray($style_row);
			$excel->getActiveSheet()->getStyle('D' . $numrow)->applyFromArray($style_row);
			$excel->getActiveSheet()->getStyle('E' . $numrow)->applyFromArray($style_row);
			$excel->getActiveSheet()->getStyle('F' . $numrow)->applyFromArray($style_row);
			$excel->getActiveSheet()->getStyle('G' . $numrow)->applyFromArray($style_row);
			$excel->getActiveSheet()->getStyle('H' . $numrow)->applyFromArray($style_row);
			$excel->getActiveSheet()->getStyle('I' . $numrow)->applyFromArray($style_row);
			$excel->getActiveSheet()->getStyle('J' . $numrow)->applyFromArray($style_row);
			
			$no++;
			$numrow++;
		}

		$excel->getActiveSheet()->getColumnDimension('A')->setWidth(5);
		$excel->getActiveSheet()->getColumnDimension('B')->setWidth(30);
		$excel->getActiveSheet()->getColumnDimension('C')->setWidth(15);
		$excel->getActiveSheet()->getColumnDimension('D')->setWidth(25);
		$excel->getActiveSheet()->getColumnDimension('E')->setWidth(15);
		$excel->getActiveSheet()->getColumnDimension('F')->setWidth(15);
		$excel->getActiveSheet()->getColumnDimension('G')->setWidth(15);
		$excel->getActiveSheet()->getColumnDimension('H')->setWidth(10);
		$excel->getActiveSheet()->getColumnDimension('I')->setWidth(10);
		$excel->getActiveSheet()->getColumnDimension('J')->setWidth(10);

		$excel->getActiveSheet()->getDefaultRowDimension()->setRowHeight(-1);
		$excel->getActiveSheet()->getPageSetup()->setOrientation(PHPExcel_Worksheet_PageSetup::ORIENTATION_LANDSCAPE);

		$excel->getActiveSheet(0)->setTitle("Laporan Data Hasil Ujian");
		$excel->setActiveSheetIndex(0);

		header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
		header('Content-Disposition: attachment; filename="Data Hasil Ujian.xlsx"');
		header('Cache-Control: max-age=0');

		$write = PHPExcel_IOFactory::createWriter($excel, 'Excel2007');
		$write->save('php://output');
	}
}
