<?php
include_once '../../../dao/UserDAO.php';
include_once '../../../entity/User.php';
include_once '../../../utility/PDOUtil.php';

//membuat object UserDAO
//memanggil fungsi fetchAllUser
//return hasil
header("content-type:application/json");
$UserDAO = new UserDAO();
$user = $UserDAO->fetchAllUser();
echo json_encode($user);