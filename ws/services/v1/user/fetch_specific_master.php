<?php
include_once '../../../dao/MasterRoleDAO.php';
include_once '../../../entity/MasterRole.php';
include_once '../../../utility/PDOUtil.php';

//menerima id
//membuat object MasterRoleDAO
//memanggil fungsi fetchMasterRole
//return hasil
$id = filter_input(INPUT_POST, 'id');
header("content-type:application/json");
$MasterRoleDAO = new MasterRoleDAO();
$role = $MasterRoleDAO->fetchMasterRole($id);
echo json_encode($role);