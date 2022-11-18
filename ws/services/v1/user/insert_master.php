<?php
include_once '../../../dao/MasterRoleDAO.php';
include_once '../../../entity/MasterRole.php';
include_once '../../../utility/PDOUtil.php';

//menerima name
//membuat array
$name = filter_input(INPUT_POST, 'name');
header("content-type:application/json");
$jsonData = array();

if (!empty($name)) {
    //membuat object MasterRoleDAO dan MasterRole
    //memasang nama pada object MasterRole
    //memanggil fungsi addMasterRole MasterRoleDAO
    $MasterRoleDAO = new MasterRoleDAO();
    $role = new MasterRole();
    $role->setRoleName($name);
    $response = $MasterRoleDAO->addMasterRole($role);
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