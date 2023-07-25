<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Tbl_order_model extends CI_Model
{

    public $table = 'tbl_order';
    public $id = 'id_order';
    public $order = 'DESC';

    function __construct()
    {
        parent::__construct();
    }

    // get all
    function get_all()
    {
        $this->db->select('*,tbl_order.id_users');
        $this->db->join('tbl_user', 'tbl_user.id_users = tbl_order.id_users');
        $this->db->order_by($this->id, $this->order);
        return $this->db->get($this->table)->result();
    }

    // get all
    function get_all_tanggal($tanggal_awal, $tanggal_akhir)
    {
        $tanggal_awal = $this->db->escape($tanggal_awal);
        $tanggal_akhir = $this->db->escape($tanggal_akhir);
        $this->db->select('*,tbl_order.id_users');
        $this->db->join('tbl_user', 'tbl_user.id_users = tbl_order.id_users');
        $this->db->where('DATE(tanggal) BETWEEN '.$tanggal_awal.' AND '.$tanggal_akhir); 
        $this->db->order_by($this->id, $this->order);
        return $this->db->get($this->table)->result();
    }

    function get_all_jasa_tanggal($tanggal_awal, $tanggal_akhir)
    {
        $tanggal_awal = $this->db->escape($tanggal_awal);
        $tanggal_akhir = $this->db->escape($tanggal_akhir);
        $this->db->select('*,tbl_order_jasa.id_users');
        $this->db->join('tbl_user', 'tbl_user.id_users = tbl_order_jasa.id_users');
        $this->db->where('DATE(tanggal) BETWEEN '.$tanggal_awal.' AND '.$tanggal_akhir); 
        $this->db->order_by($this->id, $this->order);
        return $this->db->get("tbl_order_jasa")->result();
    }

    function get_kinerja()
    {
        $this->db->select('id_karyawan, full_name');
        $this->db->distinct();
        $this->db->join('tbl_user', 'tbl_order.id_karyawan = tbl_user.id_users', 'LEFT');
        $this->db->order_by($this->id, $this->order);
        return $this->db->get($this->table)->result();
    }

    function get_kinerja_jasa()
    {
        $this->db->select('id_karyawan, full_name');
        $this->db->distinct();
        $this->db->join('tbl_user', 'tbl_order_jasa.id_karyawan = tbl_user.id_users', 'LEFT');
        $this->db->order_by($this->id, $this->order);
        return $this->db->get("tbl_order_jasa")->result();
    }

    function get_all_jasa()
    {
        $this->db->select('*,tbl_order_jasa.id_users');
        $this->db->join('tbl_user', 'tbl_user.id_users = tbl_order_jasa.id_users');
        $this->db->order_by($this->id, $this->order);
        return $this->db->get("tbl_order_jasa")->result();
    }

    function get_all_id()
    {
        $ids = $this->session->userdata('id_users');
        $this->db->select('*,tbl_order.id_users');
        $this->db->join('tbl_user', 'tbl_user.id_users = tbl_order.id_users');
        $this->db->where('tbl_order.id_users', $ids);
        $this->db->order_by($this->id, $this->order);
        return $this->db->get($this->table)->result();
    }

    function get_all_id_jasa()
    {
        $ids = $this->session->userdata('id_users');
        $this->db->select('*,tbl_order_jasa.id_users');
        $this->db->join('tbl_user', 'tbl_user.id_users = tbl_order_jasa.id_users');
        $this->db->where('tbl_order_jasa.id_users', $ids);
        $this->db->order_by($this->id, $this->order);
        return $this->db->get("tbl_order_jasa")->result();
    }

    // get data by id
    function get_by_id($id)
    {
        $this->db->select('*,tbl_order.id_users');
        $this->db->join('tbl_user', 'tbl_user.id_users = tbl_order.id_users');
        $this->db->where($this->id, $id);
        return $this->db->get($this->table)->row();
    }

    function get_by_id_jasa($id)
    {
        $this->db->select('*,tbl_order_jasa.id_users');
        $this->db->join('tbl_user', 'tbl_user.id_users = tbl_order_jasa.id_users');
        $this->db->where($this->id, $id);
        return $this->db->get("tbl_order_jasa")->row();
    }
    
    // get total rows
    function total_rows($q = NULL) {
        $this->db->like('id_order', $q);
	$this->db->or_like('tanggal', $q);
	$this->db->or_like('id_users', $q);
	$this->db->or_like('status', $q);
	$this->db->from($this->table);
        return $this->db->count_all_results();
    }

    function total_rows_jasa($q = NULL) {
        $this->db->like('id_order', $q);
	$this->db->or_like('tanggal', $q);
	$this->db->or_like('id_users', $q);
	$this->db->or_like('status', $q);
	$this->db->from("tbl_order_jasa");
        return $this->db->count_all_results();
    }

    // get data with limit and search
    function get_limit_data($limit, $start = 0, $q = NULL) {
        $this->db->order_by($this->id, $this->order);
        $this->db->like('id_order', $q);
	$this->db->or_like('tanggal', $q);
	$this->db->or_like('id_users', $q);
	$this->db->or_like('status', $q);
	$this->db->limit($limit, $start);
        return $this->db->get($this->table)->result();
    }

        // get data with limit and search
        function get_limit_data_jasa($limit, $start = 0, $q = NULL) {
            $this->db->order_by($this->id, $this->order);
            $this->db->like('id_order', $q);
        $this->db->or_like('tanggal', $q);
        $this->db->or_like('id_users', $q);
        $this->db->or_like('status', $q);
        $this->db->limit($limit, $start);
            return $this->db->get("tbl_order_jasa")->result();
        }

    // insert data
    function insert($data)
    {
        $this->db->insert($this->table, $data);
    }

    // update data
    function update($id, $data)
    {
        $this->db->where($this->id, $id);
        $this->db->update($this->table, $data);
    }

    function update_jasa($id, $data)
    {
        $this->db->where($this->id, $id);
        $this->db->update("tbl_order_jasa", $data);
    }

    // delete data
    function delete($id)
    {
        $this->db->where($this->id, $id);
        $this->db->delete($this->table);
    }

    function delete_do($id)
    {
        $this->db->where($this->id, $id);
        $this->db->delete("tbl_detail_order");
    }

    function delete_do_jasa($id)
    {
        $this->db->where($this->id, $id);
        $this->db->delete("tbl_detail_order_jasa");
    }

    function delete_jasa($id)
    {
        $this->db->where($this->id, $id);
        $this->db->delete("tbl_order_jasa");
    }

    function get_penghasilan($tanggal, $bulan, $tahun) {
        $this->db->select('sum(qty*harga) AS hasil');
       
        $this->db->where('DAY(tanggal)', $tanggal);
        $this->db->where('MONTH(tanggal)', $bulan);
        $this->db->where('YEAR(tanggal)', $tahun);
        
        return $this->db->get("tbl_detail_order")->result();
    }

    function get_penghasilan_ongkir($tanggal, $bulan, $tahun) {
        $this->db->select('count(ongkir) AS hasilongkir');
       
        $this->db->where('DAY(tanggal)', $tanggal);
        $this->db->where('MONTH(tanggal)', $bulan);
        $this->db->where('YEAR(tanggal)', $tahun);
        $this->db->where('ongkir', '2');
        
        return $this->db->get("tbl_order")->result();
    }

    function get_penghasilan_jasa($tanggal, $bulan, $tahun) {
        $this->db->select('sum(qty*harga) AS hasil');
       
        $this->db->where('DAY(tanggal)', $tanggal);
        $this->db->where('MONTH(tanggal)', $bulan);
        $this->db->where('YEAR(tanggal)', $tahun);
        
        return $this->db->get("tbl_detail_order_jasa")->result();
    }

    function get_penghasilan_ongkir_jasa($tanggal, $bulan, $tahun) {
        $this->db->select('count(ongkir) AS hasilongkir');
       
        $this->db->where('DAY(tanggal)', $tanggal);
        $this->db->where('MONTH(tanggal)', $bulan);
        $this->db->where('YEAR(tanggal)', $tahun);
        $this->db->where('ongkir', '2');
        
        return $this->db->get("tbl_order_jasa")->result();
    }

}

/* End of file Tbl_order_model.php */
/* Location: ./application/models/Tbl_order_model.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2023-07-02 14:05:46 */
/* http://harviacode.com */