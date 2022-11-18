<?php


class MasterRoleDAO {
public function fetchAllMasterRole() {
    //membuka koneksi dengan database
    //membuat query untuk mengambil semua jabatan
    //mengaktifkan query di database
    //memasang hasil ke object MasterRole
    //menutup koneksi dengan database
    //mengembalikan hasil
    $link = PDOUtil::createConnection();
    $query = "SELECT * FROM master_role";
    $result = $link->query($query);
    $result->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, 'MasterRole');
    PDOUtil::closeConnection($link);
    return $result->fetchAll();
}

public function fetchActiveMasterRole() {
    //membuka koneksi dengan database
    //membuat query untuk mengambil semua jabatan yang aktif
    //mengaktifkan query di database
    //memasang hasil ke object MasterRole
    //menutup koneksi dengan database
    //mengembalikan hasil
    $link = PDOUtil::createConnection();
    $query = "SELECT * FROM master_role WHERE role_status = 1";
    $result = $link->query($query);
    $result->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, 'MasterRole');
    PDOUtil::closeConnection($link);
    return $result->fetchAll();
}

/**
 * @param $id
 * @return MasterRole
 */
public function fetchMasterRole($id) {
    //membuka koneksi dengan database
    //membuat query untuk mengambil jabatan berdasarkan id
    //memasang parameter id di query
    //mengaktifkan query di database
    //menutup koneksi dengan database
    //mengembalikan hasil sebgai object MasterRole
    $link = PDOUtil::createConnection();
    $query = "SELECT * FROM master_role WHERE role_id = ?";
    $stmt = $link->prepare($query);
    $stmt->bindParam(1, $id);
    $stmt->setFetchMode(PDO::FETCH_OBJ);
    $stmt->execute();
    PDOUtil::closeConnection($link);
    return $stmt->fetchObject('MasterRole');
}

public function addMasterRole(MasterRole $masterRole) {
    $result = 0;

    //membuat variable status = 0
    //membuka koneksi dengan database
    //membuat query untuk menambahkan jabatan
    //memasang parameter nama di query
    $link = PDOUtil::createConnection();
    $query = "INSERT into master_role (role_name, role_status) VALUES (?,1)";
    $stmt = $link->prepare($query);
    $stmt->bindValue(1, $masterRole->getRoleName());
    $link->beginTransaction();
    if ($stmt->execute()) {
        //mengaktifkan query di database
        //mengubah status menjadi 1
        $link->commit();
        $result = 1;
    } else {
        //mengembalikan database ke keadaan sebelum insert
        $link->rollBack();
    }
    //menutup koneksi dengan database
    //mengembalikan status
    PDOUtil::closeConnection($link);
    return $result;
}

public function deleteMasterRole(MasterRole $masterRole) {
    $result = 0;

    //membuat variable status = 0
    //membuka koneksi dengan database
    //membuat query untuk menghapus jabatan
    //memasang parameter id di query
    $link = PDOUtil::createConnection();
    $query = "DELETE FROM master_role WHERE role_id = ?";
    $stmt = $link->prepare($query);
    $stmt->bindValue(1, $masterRole->getRoleId());
    $link->beginTransaction();
    if ($stmt->execute()) {
        //mengaktifkan query di database
        //mengubah status menjadi 1
        $link->commit();
        $result = 1;
    } else {
        //mengembalikan database ke keadaan sebelum delete
        $link->rollBack();
    }
    //menutup koneksi dengan database
    //mengembalikan status
    PDOUtil::closeConnection($link);
    return $result;
}

public function updateMasterRole(MasterRole $masterRole) {
    $result = 0;

    //membuat variable status = 0
    //membuka koneksi dengan database
    //membuat query untuk mengubah jabatan
    //memasang parameter nama, id di query
    $link = PDOUtil::createConnection();
    $query = "UPDATE master_role SET role_name = ? WHERE role_id = ?";
    $stmt = $link->prepare($query);
    $stmt->bindValue(1, $masterRole->getRoleName());
    $stmt->bindValue(2, $masterRole->getRoleId());
    $link->beginTransaction();
    if ($stmt->execute()) {
        //mengaktifkan query di database
        //mengubah status menjadi 1
        $link->commit();
        $result = 1;
    } else {
        //mengembalikan database ke keadaan sebelum update
        $link->rollBack();
    }
    //menutup koneksi dengan database
    //mengembalikan status
    PDOUtil::closeConnection($link);
    return $result;
}

public function statusMasterRole(MasterRole $masterRole) {
    $result = 0;

    //membuat variable status = 0
    //membuka koneksi dengan database
    //membuat query untuk mengubah status jabatan
    $link = PDOUtil::createConnection();
    if ($masterRole->getRoleStatus() == 1) {
        //query status jabatan = 1
        $query = "UPDATE master_role SET role_status = 0 WHERE role_id = ?";
    } else {
        //query status jabatan = 1
        $query = "UPDATE master_role SET role_status = 1 WHERE role_id = ?";
    }
    //memasang parameter id di query
    $stmt = $link->prepare($query);
    $stmt->bindValue(1, $masterRole->getRoleId());
    $link->beginTransaction();
    if ($stmt->execute()) {
        //mengaktifkan query di database
        //mengubah status menjadi 1
        $link->commit();
        $result = 1;
    } else {
        //mengembalikan database ke keadaan sebelum update
        $link->rollBack();
    }
    //menutup koneksi dengan database
    //mengembalikan status
    PDOUtil::closeConnection($link);
    return $result;
}
}