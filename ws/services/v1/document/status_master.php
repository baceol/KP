<?php
include_once '../../../dao/MasterDocumentDAO.php';
include_once '../../../entity/MasterDocument.php';
include_once '../../../utility/PDOUtil.php';

//menerima id, status
//membuat array
$id = filter_input(INPUT_POST, 'id');
$status = filter_input(INPUT_POST, 'status');
header("content-type:application/json");
$jsonData = array();

if (!empty($id)) {
    //membuat object MasterDocumentDAO dan MasterDocument
    //memasang id, status pada object MasterDocument
    //memanggil fungsi statusMasterDocument MasterDocumentDAO
    $MasterDocumentDAO = new MasterDocumentDAO();
    $document = new MasterDocument();
    $document->setDocId($id);
    $document->setDocStatus($status);
    $response = $MasterDocumentDAO->statusMasterDocument($document);
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