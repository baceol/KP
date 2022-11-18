<?php
include_once '../../../dao/MasterDocumentDAO.php';
include_once '../../../entity/MasterDocument.php';
include_once '../../../utility/PDOUtil.php';

//membuat object MasterDocumentDAO
//memanggil fungsi fetchActiveMasterDocument
//return hasil
header("content-type:application/json");
$MasterDocumentDAO = new MasterDocumentDAO();
$role = $MasterDocumentDAO->fetchActiveMasterDocument();
echo json_encode($role);