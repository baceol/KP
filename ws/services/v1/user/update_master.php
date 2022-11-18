<?php
include_once '../../../dao/MasterRoleDAO.php';
include_once '../../../entity/MasterRole.php';
include_once '../../../utility/PDOUtil.php';

//menerima id, name
//membuat array
$name = filter_input(INPUT_POST, 'name');
$id = filter_input(INPUT_POST, 'id');
header("content-type:application/json");
$jsonData = array();

if (!empty($id) && !empty($name)) {
    //membuat object MasterRoleDAO dan MasterRole
    //memasang id, name pada object MasterRole
    //memanggil fungsi updateMasterRole MasterRoleDAO
    $MasterRoleDAO = new MasterRoleDAO();
    $role = new MasterRole();
    $role->setRoleId($id);
    $role->setRoleName($name);
    $response = $MasterRoleDAO->updateMasterRole($role);
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