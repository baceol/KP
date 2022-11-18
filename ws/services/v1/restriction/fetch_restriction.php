<?php
include_once '../../../dao/RestrictionDAO.php';
include_once '../../../entity/Restriction.php';
include_once '../../../utility/PDOUtil.php';

//menerima id
//membuat object RestrictionDAO dan Restriction
//memasang id pada object Restriction
//memanggil fungsi fetchRestriction pada RestrictionDAO
//return hasil
$id = filter_input(INPUT_POST, 'id');
header("content-type:application/json");
$RestrictionDAO = new RestrictionDAO();
$restriction = new Restriction();
$restriction->setTbresDoc($id);
$document = $RestrictionDAO->fetchRestriction($restriction);
echo json_encode($document);