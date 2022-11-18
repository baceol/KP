<?php
include_once '../../../dao/DocumentDAO.php';
include_once '../../../entity/Document.php';
include_once '../../../utility/PDOUtil.php';

//menerima id, status
//membuat array
$id = filter_input(INPUT_POST, 'id');
$status = filter_input(INPUT_POST, 'status');
header("content-type:application/json");
$jsonData = array();

if (!empty($id)) {
    //membuat object DocumentDAO dan Document
    //memasang id, status pada object Document
    //memanggil fungsi archiveStatus DocumentDAO
    $DocumentDAO = new DocumentDAO();
    $document = new Document();
    $document->setTbdocId($id);
    $document->setTbdocStatusArsip($status);
    $response = $DocumentDAO->archiveStatus($document);
    if ($response) {
        //memasukan status 1, pesan "Success"
        $jsonData['status'] = 1;
        $jsonData['message'] = "Success";
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