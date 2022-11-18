<?php
include_once '../../../dao/MasterDocumentDAO.php';
include_once '../../../entity/MasterDocument.php';
include_once '../../../utility/PDOUtil.php';

//mengambil id
//membuat object MasterDocumentDAO
//memanggil fungsi fetchMasterDocument
//return hasil
$id = filter_input(INPUT_POST, 'id');
header("content-type:application/json");
$MasterDocumentDAO = new MasterDocumentDAO();
$document = $MasterDocumentDAO->fetchMasterDocument($id);
echo json_encode($document);