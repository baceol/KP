<?php
include_once '../../../dao/DocumentDAO.php';
include_once '../../../entity/Document.php';
include_once '../../../utility/PDOUtil.php';

//membuat object DocumentDAO
//memanggil fungsi countDocumentType
//return hasil
header("content-type:application/json");
$DocumentDAO = new DocumentDAO();
$document = $DocumentDAO->countDocumentType();
echo json_encode($document);