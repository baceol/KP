<?php
include_once '../../../dao/DocumentDAO.php';
include_once '../../../entity/Document.php';
include_once '../../../utility/PDOUtil.php';

//membuat object DocumentDAO
//memanggil fungsi countDocumentUser
//return hasil
header("content-type:application/json");
$DocumentDAO = new DocumentDAO();
$document = $DocumentDAO->countDocumentUser();
echo json_encode($document);