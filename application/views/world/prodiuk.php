<?php

$idproduk = $_POST['idproduk'];
$idlike = $_POST['idlike'];

$data = array(
    'idlike' => $idlike,
    'idproduk' => $idproduk,
);
$cek = $this->Mfrontend->insert('tbl_liked', $data);
if ($this->db->affected_rows($cek)) {
    echo "data inserted";
} else {
    echo "failed";
}
