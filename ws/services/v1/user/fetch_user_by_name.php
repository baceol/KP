<?php
include_once '../../../dao/UserDAO.php';
include_once '../../../entity/User.php';
include_once '../../../utility/PDOUtil.php';

//menerima username
//membuat object UserDAO
//memanggil fungsi fetchUserName
//return hasil
$username = filter_input(INPUT_POST, 'username');
header("content-type:application/json");
$UserDAO = new UserDAO();
$user = $UserDAO->fetchUserName($username);
echo json_encode($user);