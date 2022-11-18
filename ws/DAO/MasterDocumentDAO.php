<?php


class MasterDocumentDAO
{
    public function fetchAllMasterDocument()
    {
        //membuka koneksi dengan database
        //membuat query untuk mengambil semua jenis dokumen
        //mengaktifkan query di database
        //memasang hasil ke object MasterDocument
        //menutup koneksi dengan database
        //mengembalikan hasil
        $link = PDOUtil::createConnection();
        $query = "SELECT * FROM master_doc";
        $result = $link->query($query);
        $result->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, 'MasterDocument');
        PDOUtil::closeConnection($link);
        return $result->fetchAll();
    }

    public function fetchActiveMasterDocument()
    {
        //membuka koneksi dengan database
        //membuat query untuk mengambil semua jenis dokumen yang aktif
        //mengaktifkan query di database
        //memasang hasil ke object MasterDocument
        //menutup koneksi dengan database
        //mengembalikan hasil
        $link = PDOUtil::createConnection();
        $query = "SELECT * FROM master_doc WHERE doc_status = 1";
        $result = $link->query($query);
        $result->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, 'MasterDocument');
        PDOUtil::closeConnection($link);
        return $result->fetchAll();
    }

    /**
     * @param $id
     * @return MasterDocument
     */
    public function fetchMasterDocument($id)
    {
        //membuka koneksi dengan database
        //membuat query untuk mengambil jenis dokumen berdasarkan id
        //memasang parameter id di query
        //mengaktifkan query di database
        //menutup koneksi dengan database
        //mengembalikan hasil sebgai object MasterDocument
        $link = PDOUtil::createConnection();
        $query = "SELECT * FROM master_doc WHERE doc_id = ?";
        $stmt = $link->prepare($query);
        $stmt->bindParam(1, $id);
        $stmt->setFetchMode(PDO::FETCH_OBJ);
        $stmt->execute();
        PDOUtil::closeConnection($link);
        return $stmt->fetchObject('MasterDocument');
    }

    public function addMasterDocument(MasterDocument $masterDocument)
    {
        $result = 0;

        //membuat variable status = 0
        //membuka koneksi dengan database
        //membuat query untuk menambahkan jenis dokumen
        //memasang parameter nama di query
        $link = PDOUtil::createConnection();
        $query = "INSERT into master_doc (doc_jenis, doc_status) VALUES (?,1)";
        $stmt = $link->prepare($query);
        $stmt->bindValue(1, $masterDocument->getDocJenis());
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

    public function deleteMasterDocument(MasterDocument $masterDocument)
    {
        $result = 0;

        //membuat variable status = 0
        //membuka koneksi dengan database
        //membuat query untuk menghapus jenis dokumen
        //memasang parameter id di query
        $link = PDOUtil::createConnection();
        $query = "DELETE FROM master_doc WHERE doc_id = ?";
        $stmt = $link->prepare($query);
        $stmt->bindValue(1, $masterDocument->getDocId());
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

    public function updateMasterDocument(MasterDocument $masterDocument)
    {
        $result = 0;

        //membuat variable status = 0
        //membuka koneksi dengan database
        //membuat query untuk mengubah jenis dokumen
        //memasang parameter nama, id di query
        $link = PDOUtil::createConnection();
        $query = "UPDATE master_doc SET doc_jenis = ? WHERE doc_id = ?";
        $stmt = $link->prepare($query);
        $stmt->bindValue(1, $masterDocument->getDocJenis());
        $stmt->bindValue(2, $masterDocument->getDocId());
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

    public function statusMasterDocument(MasterDocument $masterDocument)
    {
        $result = 0;

        //membuat variable status = 0
        //membuka koneksi dengan database
        //membuat query untuk mengubah status jenis dokumen
        $link = PDOUtil::createConnection();
        if ($masterDocument->getDocStatus() == 1) {
            //status jenis dokumen = 1
            $query = "UPDATE master_doc SET doc_status = 0 WHERE doc_id = ?";
        } else {
            //status jenis dokumen = 1
            $query = "UPDATE master_doc SET doc_status = 1 WHERE doc_id = ?";
        }
        //memasang parameter id di query
        $stmt = $link->prepare($query);
        $stmt->bindValue(1, $masterDocument->getDocId());
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