<?php
include_once '../../../dao/UserDAO.php';
include_once '../../../entity/User.php';
include_once '../../../utility/PDOUtil.php';

//menerima username dan password
//membuat array
$username = filter_input(INPUT_POST, 'username');
$password = filter_input(INPUT_POST, 'password');
header('content-type:application/json');
$jsonData = array();

if (!empty($username) && !empty($password)) {
    //membuat object UserDAO dan User
    //memasang username dan password ke object User
    //memanggil fungsi login UserDAO
    $UserDAO = new UserDAO();
    $user = new User();
    $user->setTbuserUsername($username);
    $user->setTbuserPassword($password);
    $user = $UserDAO->login($user);
    if (isset($user) && $user != null) {
        //memasukan status 1, pesan "Login success" dan object user ke array
        $jsonData['status'] = 1;
        $jsonData['message'] = "Login success";
        $jsonData['user'] = $user;
    } else {
        //memasukan pesan 2, pesan "Invalid username or password"
        $jsonData['status'] = 2;
        $jsonData['message'] = "Invalid username or password";
    }
} else {
    //memasukan pesan 0, pesan "Missing attribute"
    $jsonData['status'] = 0;
    $jsonData['message'] = "Missing attribute";
}

//return array
echo json_encode($jsonData);