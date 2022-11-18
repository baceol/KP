<?php
include_once '../../../dao/UserDAO.php';
include_once '../../../entity/User.php';
include_once '../../../utility/PDOUtil.php';

//menerima id, username, password, name, role, salah
//membuat array
$username = filter_input(INPUT_POST, 'username');
$password = filter_input(INPUT_POST, 'password');
$name = filter_input(INPUT_POST, 'name');
$role = filter_input(INPUT_POST, 'role');
$salah = filter_input(INPUT_POST, 'salah');
$id = filter_input(INPUT_POST, 'id');
header("content-type:application/json");
$jsonData = array();

if (!empty($password) && !empty($username) && !empty($name) && !empty($role) && !empty($id)) {
    //membuat object UserDAO dan User
    //memasang id, username, password, name, role, salah pada object User
    //memanggil fungsi updateUser UserDAO
    $UserDAO = new UserDAO();
    $user = new User();
    $user->setTbuserId($id);
    $user->setTbuserUsername($username);
    $user->setTbuserPassword($password);
    $user->setTbuserNama($name);
    $user->setTbuserRole($role);
    $user->setTbuserSalah($salah);
    $response = $UserDAO->updateUser($user);
    if ($response) {
        //memasukan status 1, pesan "Success"
        $jsonData['status'] = 1;
        $jsonData['message'] = "Success";
    } else {
        //memasukan status 2, pesan "Failed"
        $jsonData['status'] = 2;
        $jsonData['message'] = "Failed";
    }
} else {
    //memasukan status 0, pesan "Missing attribute"
    $jsonData['status'] = 0;
    $jsonData['message'] = "Missing Attribute";
}

//return array
echo json_encode($jsonData);