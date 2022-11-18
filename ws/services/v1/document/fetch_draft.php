<?php
include_once '../../../dao/DocumentDAO.php';
include_once '../../../entity/User.php';
include_once '../../../utility/PDOUtil.php';

//menerima role
//membuat object DocumentDAO dan User
//memasang role pada object User
//memanggil fungsi fetchAllDraft
//return hasil
$id = filter_input(INPUT_POST, 'id');
$role = filter_input(INPUT_POST, 'role');
header("content-type:application/json");
$DocumentDAO = new DocumentDAO();
$user = new User();
$user->setTbuserId($id);
$user->setTbuserRole($role);
$document = $DocumentDAO->fetchAllDraft($user);
echo json_encode($document);