<?php
include_once '../../../dao/MasterRoleDAO.php';
include_once '../../../entity/MasterRole.php';
include_once '../../../utility/PDOUtil.php';

//membuat object MasterRoleDAO
//memanggil fungsi fetchAllMasterRole
//return hasil
header("content-type:application/json");
$MasterRoleDAO = new MasterRoleDAO();
$role = $MasterRoleDAO->fetchAllMasterRole();
echo json_encode($role);