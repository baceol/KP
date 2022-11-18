<?php


class RestrictionDAO {
public function fetchRestriction(Restriction $restriction) {
    //membuka koneksi dengan database
    //membuat query untuk mengambil semua restriction berdasarkan id dokumen
    //mengaktifkan query di database
    //memasang hasil ke object Restriction
    //menutup koneksi dengan database
    //mengembalikan hasil
    $link = PDOUtil::createConnection();
    $query = "SELECT * FROM tbRestriction WHERE tbres_doc = " . $restriction->getTbresDoc();
    $result = $link->query($query);
    $result->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, 'Restriction');
    PDOUtil::closeConnection($link);
    return $result->fetchAll();
}

public function addRestriction(Restriction $restriction) {
    $result = 0;

    //membuat variable status = 0
    //membuka koneksi dengan database
    //membuat query untuk menambahkan restriction
    //memasang parameter id dokumen, id jabatan di query
    $link = PDOUtil::createConnection();
    $query = "INSERT into tbRestriction (tbres_role, tbres_doc) VALUES (?,?)";
    $stmt = $link->prepare($query);
    $stmt->bindValue(1, $restriction->getTbresRole());
    $stmt->bindValue(2, $restriction->getTbresDoc());
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

public function deleteRestriction(Restriction $restriction) {
    $result = 0;

    //membuat variable status = 0
    //membuka koneksi dengan database
    //membuat query untuk menambahkan restriction
    //memasang parameter id dokumen, id jabatan di query
    $link = PDOUtil::createConnection();
    $query = "DELETE FROM tbRestriction WHERE tbres_role = ? AND tbres_doc = ?";
    $stmt = $link->prepare($query);
    $stmt->bindValue(1, $restriction->getTbresRole());
    $stmt->bindValue(2, $restriction->getTbresDoc());
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
}