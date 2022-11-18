<?php
include_once '../../../dao/UserDAO.php';
include_once '../../../entity/User.php';
include_once '../../../utility/PDOUtil.php';

//menerima id
//membuat object UserDAO
//memanggil fungsi fetchUserId
//return hasil
$id = filter_input(INPUT_POST, 'id');
header("content-type:application/json");
$UserDAO = new UserDAO();
$user = $UserDAO->fetchUserId($id);
echo json_encode($user);