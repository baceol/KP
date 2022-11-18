<?php
include_once '../../../dao/UserDAO.php';
include_once '../../../entity/User.php';
include_once '../../../utility/PDOUtil.php';

//membuat object userDAO
//memanggil fungsi countUserRole
//return hasil
header("content-type:application/json");
$UserDAO = new UserDAO();
$user = $UserDAO->countUserRole();
echo json_encode($user);