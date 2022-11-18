<?php
include_once '../../../dao/DocumentDAO.php';
include_once '../../../dao/RestrictionDAO.php';
include_once '../../../entity/Document.php';
include_once '../../../entity/Restriction.php';
include_once '../../../utility/PDOUtil.php';

//menerima id, nomor, tanggal, keterangan, isi, user, type, storage, role, used
//membuat array
$id = filter_input(INPUT_POST, 'id');
$nomor = filter_input(INPUT_POST, 'nomor');
$tanggal = filter_input(INPUT_POST, 'tanggal');
$keterangan = filter_input(INPUT_POST, 'keterangan');
$isi = filter_input(INPUT_POST, 'isi');
$user = filter_input(INPUT_POST, 'user');
$type = filter_input(INPUT_POST, 'type');
$storage = filter_input(INPUT_POST, 'storage');
$role = filter_input(INPUT_POST, 'role', FILTER_DEFAULT, FILTER_FORCE_ARRAY);
$used = filter_input(INPUT_POST, 'used', FILTER_DEFAULT, FILTER_FORCE_ARRAY);
header("content-type:application/json");
$jsonData = array();

if (!empty($id) && !empty($nomor) && !empty($tanggal) && !empty($keterangan) && !empty($isi) && !empty($user) && !empty($type) && !empty($storage)) {
    //membuat object DocumentDAO dan Document
    //memasang id, nomor, tanggal, keterangan, isi, user, type, storage pada object Document
    //memanggil fungsi updateDocument DocumentDAO
    $DocumentDAO = new DocumentDAO();
    $document = new Document();
    $document->setTbdocId($id);
    $document->setTbdocNoDoc($nomor);
    $document->setTbdocTglDibuat($tanggal);
    $document->setTbdocKet($keterangan);
    $document->setTbdocIsi($isi);
    $document->setTbdocUserUpload($user);
    $document->setTbdocJenis($type);
    $document->setTbdocStorage($storage);
    $response = $DocumentDAO->updateDocument($document);
    if ($response) {
        //memasukan status 1, pesan "Success"
        //membuat object RestrictionDAO dan Restriction
        $jsonData['status'] = 1;
        $jsonData['message'] = "Success";
        $RestrictionDAO = new RestrictionDAO();
        $restriction = new Restriction();
        if (!empty($role)) {
            foreach ($role as $item) {
                //looping role sebagai item
                //memasang id, item pada object Restriction
                //memanggil fungsi addRestriction RestrictionDAO
                $restriction->setTbresDoc($id);
                $restriction->setTbresRole($item);
                $RestrictionDAO->addRestriction($restriction);
            }
        }
        if (!empty($used)) {
            foreach ($used as $item) {
                //looping used sebagai item
                //memasang id, item['id'] pada object Restriction
                //memanggil fungsi deleteRestriction RestrictionDAO
                $restriction->setTbresDoc($id);
                $restriction->setTbresRole($item['id']);
                $RestrictionDAO->deleteRestriction($restriction);
            }
        }
    } else {
        //memasukan status 2, pesan "Failed"
        $jsonData['status'] = 2;
        $jsonData['message'] = "Failed";
    }
} else {
    //memasukan status 0, pesan "Missing attribute"
    $jsonData['status'] = 0;
    $jsonData['message'] = "Missing attribute";
}

//return array
echo json_encode($jsonData);