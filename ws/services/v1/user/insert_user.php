<?php
include_once '../../../dao/UserDAO.php';
include_once '../../../entity/User.php';
include_once '../../../utility/PDOUtil.php';

//menerima username, name, role
//membuat array
$username = filter_input(INPUT_POST, 'username');
$name = filter_input(INPUT_POST, 'name');
$role = filter_input(INPUT_POST, 'role');
header("content-type:application/json");
$jsonData = array();

if (!empty($username) && !empty($name) && !empty($role)) {
    //membuat object UserDAO dan User
    //memasang username, name, role pada object User
    //memanggil fungsi addUser UserDAO
    $UserDAO = new UserDAO();
    $user = new User();
    $user->setTbuserUsername($username);
    $user->setTbuserNama($name);
    $user->setTbuserRole($role);
    $response = $UserDAO->addUser($user);
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
    $jsonData['message'] = "Missing attribute";
}

//return array
echo json_encode($jsonData);