<?php
include_once '../../../dao/MasterDocumentDAO.php';
include_once '../../../entity/MasterDocument.php';
include_once '../../../utility/PDOUtil.php';

//membuat object MasterDocumentDAO
//memanggil fungsi fetchAllMasterDocument
//return hasil
header("content-type:application/json");
$MasterDocumentDAO = new MasterDocumentDAO();
$document = $MasterDocumentDAO->fetchAllMasterDocument();
echo json_encode($document);