<?php

class Mfrontend extends  Ci_Model
{
    public function get_all_data($data)
    {
        return $this->db->get($data);
    }
    public function get_all_data_by_id($data, $id)
    {
        $this->db->where($id);
        return $this->db->get($data);
    }
    public function insert($tabel, $data)
    {
        $this->db->insert($tabel, $data);
    }
    public function update($tabel, $data, $id)
    {
        $this->db->where($id);
        $this->db->update($tabel, $data);
    }
    public function get_by_id($tabel, $id)
    {
        return $this->db->get_where($tabel, $id);
    }
    public function get_all_data_2_table($table1, $table2, $data1, $id)
    {
        $this->db->select('*');
        $this->db->from($table1); // this is first table name // this is first table name
        $this->db->join($table2, $table1 . '.' . $data1 . '=' . $table2 . '.' . $data1); // this is second table name with both table ids
        $this->db->where($id); // this is first table name // this is first table name
        return $this->db->get();
    }
    public function get_all_produk_newest()
    {
        $this->db->order_by('idproduk', 'DESC');
        $this->db->limit(4);
        return  $this->db->get('tbl_produk');
    }
    public function query($query)
    {
        return $this->db->query($query);
    }
    public function get_all_data_3_table($table1, $table2, $table3, $data1, $data2, $data3, $data4)
    {
        $this->db->select("idbiayakirim,b.namakota,c.namakota AS 'Kota Tujuan',a.namakurir,biaya,idkota,idkurir ");
        $this->db->from($table1); // this is first table name
        $this->db->join($table2 . ' AS a', $table1 . '.' . $data2 . '=' . 'a' . '.' . $data2); // this is second table name with both table ids
        $this->db->join($table3 . ' AS b', $table1 . '.' . $data1 . '=' . 'b' . '.' . $data3); // this is second table name with both table ids
        $this->db->join($table3 . ' AS c', $table1 . '.' . $data4 . '=' . 'c' . '.' . $data3); // this is second table name with both table ids
        return $this->db->get();
    }
}
