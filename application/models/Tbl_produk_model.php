<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Tbl_produk_model extends CI_Model
{

    public $table = 'tbl_produk';
    public $id = 'id_produk';
    public $order = 'DESC';

    function __construct()
    {
        parent::__construct();
    }

    // datatables
    function json() {
        $this->datatables->select('id_produk,tbl_supplier.id_supplier,nama_produk,tanggal_masuk,qty,harga,jenis_produk,foto,nama_supplier');
        $this->datatables->from('tbl_produk');
        $this->datatables->join('tbl_supplier', 'tbl_produk.id_supplier = tbl_supplier.id_supplier');
        //add this line for join
        //$this->datatables->join('table2', 'tbl_produk.field = table2.field');
        $this->datatables->add_column('action', anchor(site_url('tbl_produk/add_stok/$1'),'<i class="fa fa-plus" aria-hidden="true"></i>', array('class' => 'btn btn-primary btn-sm'))." 
        ".anchor(site_url('tbl_produk/read/$1'),'<i class="fa fa-eye" aria-hidden="true"></i>', array('class' => 'btn btn-danger btn-sm'))." 
            ".anchor(site_url('tbl_produk/update/$1'),'<i class="fa fa-pencil-square-o" aria-hidden="true"></i>', array('class' => 'btn btn-danger btn-sm'))." 
                ".anchor(site_url('tbl_produk/delete/$1'),'<i class="fa fa-trash-o" aria-hidden="true"></i>','class="btn btn-danger btn-sm" onclick="javasciprt: return confirm(\'Are You Sure ?\')"'), 'id_produk');
        return $this->datatables->generate();
    }

    // get all
    function get_all()
    {
        $this->db->select('id_produk,tbl_supplier.id_supplier,nama_produk,qty,harga,tanggal_masuk,jenis_produk,foto,nama_supplier');
        $this->db->join('tbl_supplier', 'tbl_produk.id_supplier = tbl_supplier.id_supplier');
        $this->db->order_by($this->id, $this->order);
        return $this->db->get($this->table)->result();
    }

    function get_all_restok()
    {
        $this->db->select('id_produk,tbl_supplier.id_supplier,nama_produk,qty,harga,tanggal_masuk,jenis_produk,foto,nama_supplier');
        $this->db->join('tbl_supplier', 'tbl_produk.id_supplier = tbl_supplier.id_supplier');
        $this->db->where('qty <= 10');
        $this->db->order_by($this->id, $this->order);
        return $this->db->get($this->table)->result();
    }

        // get all
    function get_all_tanggal($tanggal_awal,$tanggal_akhir)
    {
        $tanggal_awal = $this->db->escape($tanggal_awal);
        $tanggal_akhir = $this->db->escape($tanggal_akhir);
        $this->db->select('id_produk,tbl_supplier.id_supplier,nama_produk,qty,tanggal_masuk,harga,jenis_produk,foto,nama_supplier');
        $this->db->join('tbl_supplier', 'tbl_produk.id_supplier = tbl_supplier.id_supplier');
        $this->db->where('DATE(tanggal_masuk) BETWEEN '.$tanggal_awal.' AND '.$tanggal_akhir); 
        $this->db->order_by($this->id, $this->order);
        return $this->db->get($this->table)->result();
    }

    function get_jasa()
    {
        $this->db->select('*');
        $this->db->order_by($this->id, $this->order);
        return $this->db->get("tbl_jasa")->result();
    }

    // get data by id
    function get_by_id($id)
    {
        $this->db->select('id_produk,tbl_supplier.id_supplier,tanggal_masuk,nama_produk,qty,harga,jenis_produk,foto,nama_supplier');
        $this->db->join('tbl_supplier', 'tbl_produk.id_supplier = tbl_supplier.id_supplier');
        $this->db->where($this->id, $id);
        return $this->db->get($this->table)->row();
    }
    
    // get total rows
    function total_rows($q = NULL) {
        $this->db->like('id_produk', $q);
	$this->db->or_like('id_supplier', $q);
	$this->db->or_like('nama_produk', $q);
	$this->db->or_like('qty', $q);
	$this->db->or_like('harga', $q);
	$this->db->or_like('jenis_produk', $q);
	$this->db->or_like('foto', $q);
	$this->db->from($this->table);
        return $this->db->count_all_results();
    }

    // get data with limit and search
    function get_limit_data($limit, $start = 0, $q = NULL) {
        $this->db->order_by($this->id, $this->order);
        $this->db->like('id_produk', $q);
	$this->db->or_like('id_supplier', $q);
	$this->db->or_like('nama_produk', $q);
	$this->db->or_like('qty', $q);
	$this->db->or_like('harga', $q);
	$this->db->or_like('jenis_produk', $q);
	$this->db->or_like('foto', $q);
	$this->db->limit($limit, $start);
        return $this->db->get($this->table)->result();
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

    // delete data
    function delete($id)
    {
        $this->db->where($this->id, $id);
        $this->db->delete($this->table);
    }

    public function tambah_order($data)
    {
        $this->db->insert('tbl_order', $data);
        $id = $this->db->insert_id();
        return (isset($id)) ? $id : FALSE;
    }

    public function tambah_order_jasa($data)
    {
        $this->db->insert('tbl_order_jasa', $data);
        $id = $this->db->insert_id();
        return (isset($id)) ? $id : FALSE;
    }

    public function delete_order($ido)
    {
        $this->db->where('id_order', $ido);
        $this->db->delete('tbl_order');
    }

    public function tambah_detail_order($data)
    {
        $this->db->insert('tbl_detail_order', $data);
    }
    public function tambah_detail_order_jasa($data)
    {
        $this->db->insert('tbl_detail_order_jasa', $data);
    }





}

/* End of file Tbl_produk_model.php */
/* Location: ./application/models/Tbl_produk_model.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2023-06-30 05:00:52 */
/* http://harviacode.com */