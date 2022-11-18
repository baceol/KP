<?php
include_once '../../../dao/MasterDocumentDAO.php';
include_once '../../../entity/MasterDocument.php';
include_once '../../../utility/PDOUtil.php';

//menerima name
//membuat array
$name = filter_input(INPUT_POST, 'name');
header("content-type:application/json");
$jsonData = array();

if (!empty($name)) {
    //membuat object MasterDocumentDAO dan MasterDocument
    //memasang name pada object MasterDocument
    //memanggil fungsi addMasterDocument MasterDocumentDAO
    $MasterDocumentDAO = new MasterDocumentDAO();
    $document = new MasterDocument();
    $document->setDocJenis($name);
    $response = $MasterDocumentDAO->addMasterDocument($document);
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