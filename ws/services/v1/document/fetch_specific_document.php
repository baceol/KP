<?php
include_once '../../../dao/DocumentDAO.php';
include_once '../../../entity/Document.php';
include_once '../../../utility/PDOUtil.php';

//mengambil id
//membuat object DocumentDAO
//memanggil fungsi fetchDocument
//return hasil
$id = filter_input(INPUT_POST, 'id');
header("content-type:application/json");
$DocumentDAO = new DocumentDAO();
$document = $DocumentDAO->fetchDocument($id);
echo json_encode($document);