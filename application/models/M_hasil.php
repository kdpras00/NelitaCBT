<?php
defined('BASEPATH') or exit('no direct script access allowed');

class M_hasil extends CI_Model
{
    public function get_peserta2($id)
    {
        $this->db->select('*');
        $this->db->from('tb_peserta');
        $this->db->join('tb_matapelajaran', 'tb_peserta.id_matapelajaran=tb_matapelajaran.id_matapelajaran');
        $this->db->join('tb_jenis_ujian', 'tb_peserta.id_jenis_ujian=tb_jenis_ujian.id_jenis_ujian');
        $this->db->join('tb_siswa', 'tb_peserta.id_siswa=tb_siswa.id_siswa');
        $this->db->where('tb_peserta.id_matapelajaran', $id);
        $this->db->order_by('nilai', 'DESC');
        $query = $this->db->get();
        return $query->result();
    }

    public function get_peserta3()
    {
        $this->db->select('*');
        $this->db->from('tb_peserta');
        $this->db->join('tb_matapelajaran', 'tb_peserta.id_matapelajaran=tb_matapelajaran.id_matapelajaran');
        $this->db->join('tb_jenis_ujian', 'tb_peserta.id_jenis_ujian=tb_jenis_ujian.id_jenis_ujian');
        $this->db->join('tb_siswa', 'tb_peserta.id_siswa=tb_siswa.id_siswa');
        $this->db->order_by('nilai', 'DESC');
        $query = $this->db->get();
        return $query->result();
    }

    public function cetak($id)
    {
        $this->db->select('*');
        $this->db->from('tb_peserta');
        $this->db->join('tb_matapelajaran', 'tb_peserta.id_matapelajaran=tb_matapelajaran.id_matapelajaran');
        $this->db->join('tb_jenis_ujian', 'tb_peserta.id_jenis_ujian=tb_jenis_ujian.id_jenis_ujian');
        $this->db->join('tb_siswa', 'tb_peserta.id_siswa=tb_siswa.id_siswa');
        $this->db->where('tb_peserta.id_peserta', $id);
        $query = $this->db->get();
        return $query->result();
    }

    public function get_belum_ujian($id_mapel)
    {
        // Get all students who are NOT in tb_peserta for this mapel
        $query = $this->db->query("
            SELECT s.*, k.nama_kelas 
            FROM tb_siswa s 
            JOIN tb_kelas k ON s.id_kelas = k.id_kelas
            WHERE s.id_siswa NOT IN (
                SELECT p.id_siswa 
                FROM tb_peserta p 
                WHERE p.id_matapelajaran = '$id_mapel'
            )
            ORDER BY k.nama_kelas ASC, s.nama_siswa ASC
        ");
        return $query->result();
    }
}

