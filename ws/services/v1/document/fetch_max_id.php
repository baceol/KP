<?php
include_once '../../../dao/DocumentDAO.php';
include_once '../../../entity/Document.php';
include_once '../../../utility/PDOUtil.php';

//membuat object DocumentDAO
//memanggil fungsi maxId
//return hasil
header("content-type:application/json");
$DocumentDAO = new DocumentDAO();
$document = $DocumentDAO->maxId();
echo json_encode($document);