<?php
include_once '../../../dao/DocumentDAO.php';
include_once '../../../entity/User.php';
include_once '../../../entity/Document.php';
include_once '../../../utility/PDOUtil.php';

//menerima role, isi, type
//membuat object DocumentDAO, User, Document
//memasang role pada object User
//memasang isi, type pada object Document
//memanggil fungsi searchAllDraft
//return hasil
$role = filter_input(INPUT_POST, 'role');
$isi = filter_input(INPUT_POST, 'isi');
$type = filter_input(INPUT_POST, 'type');
header("content-type:application/json");
$DocumentDAO = new DocumentDAO();
$user = new User();
$user->setTbuserRole($role);
$document = new Document();
$document->setTbdocIsi($isi);
$document->setTbdocJenis($type);
$found = $DocumentDAO->searchAllDraft($user, $document);
echo json_encode($found);