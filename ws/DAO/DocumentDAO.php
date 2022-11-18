<?php


class DocumentDAO
{
    public function fetchAllDocument(User $user)
    {
        //membuka koneksi dengan database
        //membuat query untuk mengambil semua dokumen aktif berdasarkan role user
        //mengaktifkan query di database
        //memasang hasil ke object Document
        //menutup koneksi dengan database
        //mengembalikan hasil
        $link = PDOUtil::createConnection();
        $query = "SELECT * FROM tbDoc d JOIN tbRestriction r ON d.tbdoc_id = r.tbres_doc WHERE d.tbdoc_status_arsip = 0 AND d.tbdoc_status_draft = 0 AND (r.tbres_role = " . $user->getTbuserRole() . " OR tbdoc_user_upload = " . $user->getTbuserId() . ") GROUP BY tbdoc_no_doc";
        $result = $link->query($query);
        $result->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, 'Document');
        PDOUtil::closeConnection($link);
        return $result->fetchAll();
    }

    public function fetchAllArchive(User $user)
    {
        //membuka koneksi dengan database
        //membuat query untuk mengambil semua dokumen arsip berdasarkan role user
        //mengaktifkan query di database
        //memasang hasil ke object Document
        //menutup koneksi dengan database
        //mengembalikan hasil
        $link = PDOUtil::createConnection();
        $query = "SELECT * FROM tbDoc d JOIN tbRestriction r ON d.tbdoc_id = r.tbres_doc WHERE d.tbdoc_status_arsip = 1 AND (r.tbres_role = " . $user->getTbuserRole() . " OR tbdoc_user_upload = " . $user->getTbuserId() . ") GROUP BY tbdoc_no_doc";
        $result = $link->query($query);
        $result->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, 'Document');
        PDOUtil::closeConnection($link);
        return $result->fetchAll();
    }

    public function fetchAllDraft(User $user)
    {
        //membuka koneksi dengan database
        //membuat query untuk mengambil semua dokumen draft berdasarkan role user
        //mengaktifkan query di database
        //memasang hasil ke object Document
        //menutup koneksi dengan database
        //mengembalikan hasil
        $link = PDOUtil::createConnection();
        $query = "SELECT * FROM tbDoc d JOIN tbRestriction r ON d.tbdoc_id = r.tbres_doc WHERE d.tbdoc_status_draft = 1 AND (r.tbres_role = " . $user->getTbuserRole() . " OR tbdoc_user_upload = " . $user->getTbuserId() . ") GROUP BY tbdoc_no_doc";
        $result = $link->query($query);
        $result->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, 'Document');
        PDOUtil::closeConnection($link);
        return $result->fetchAll();
    }

    /**
     * @param $id
     * @return Document
     */
    public function fetchDocument($id)
    {
        //membuka koneksi dengan database
        //membuat query untuk mengambil dokumen berdasarkan id
        //memasang parameter id di query
        //mengaktifkan query di database
        //menutup koneksi dengan database
        //mengembalikan hasil sebgai object Document
        $link = PDOUtil::createConnection();
        $query = "SELECT * FROM tbDoc WHERE tbdoc_id = ?";
        $stmt = $link->prepare($query);
        $stmt->bindParam(1, $id);
        $stmt->setFetchMode(PDO::FETCH_OBJ);
        $stmt->execute();
        PDOUtil::closeConnection($link);
        return $stmt->fetchObject('Document');
    }

    public function searchAllDocument(User $user, Document $document)
    {
        //membuka koneksi dengan database
        $link = PDOUtil::createConnection();
        if ($document->getTbdocIsi() == "") {
            //membuat query untuk mengambil semua dokumen aktif berdasarkan role user dan tipe dokumen
            $query = "SELECT * FROM tbDoc d JOIN tbRestriction r ON d.tbdoc_id = r.tbres_doc WHERE d.tbdoc_status_arsip = 0 AND d.tbdoc_status_draft = 0 AND (r.tbres_role = " . $user->getTbuserRole() . " OR tbdoc_user_upload = " . $user->getTbuserRole() . ") AND tbdoc_jenis = " . $document->getTbdocJenis();
        } elseif ($document->getTbdocJenis() == "") {
            //membuat query untuk mengambil semua dokumen aktif berdasarkan role user dan isi dokumen
            $query = "SELECT * FROM tbDoc d JOIN tbRestriction r ON d.tbdoc_id = r.tbres_doc WHERE d.tbdoc_status_arsip = 0 AND d.tbdoc_status_draft = 0 AND (r.tbres_role = " . $user->getTbuserRole() . " OR tbdoc_user_upload = " . $user->getTbuserRole() . ") AND tbdoc_isi LIKE '%" . $document->getTbdocIsi() . "%'";
        } else {
            //membuat query untuk mengambil semua dokumen aktif berdasarkan role user, isidokumen, dan tipe dokumen
            $query = "SELECT * FROM tbDoc d JOIN tbRestriction r ON d.tbdoc_id = r.tbres_doc WHERE d.tbdoc_status_arsip = 0 AND d.tbdoc_status_draft = 0 AND (r.tbres_role = " . $user->getTbuserRole() . " OR tbdoc_user_upload = " . $user->getTbuserRole() . ") AND tbdoc_isi LIKE '%" . $document->getTbdocIsi() . "%' AND tbdoc_jenis = " . $document->getTbdocJenis();
        }
        //mengaktifkan query di database
        //memasang hasil ke object Document
        //menutup koneksi dengan database
        //mengembalikan hasil
        $result = $link->query($query);
        $result->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, 'Document');
        PDOUtil::closeConnection($link);
        return $result->fetchAll();
    }

    public function searchAllArchive(User $user, Document $document)
    {
        //membuka koneksi dengan database
        $link = PDOUtil::createConnection();
        if ($document->getTbdocIsi() == "") {
            //membuat query untuk mengambil semua dokumen arsip berdasarkan role user dan tipe dokumen
            $query = "SELECT * FROM tbDoc d JOIN tbRestriction r ON d.tbdoc_id = r.tbres_doc WHERE d.tbdoc_status_arsip = 1 AND (r.tbres_role = " . $user->getTbuserRole() . " OR tbdoc_user_upload = " . $user->getTbuserRole() . ") AND tbdoc_jenis = " . $document->getTbdocJenis();
        } elseif ($document->getTbdocJenis() == "") {
            //membuat query untuk mengambil semua dokumen arsip berdasarkan role user dan isi dokumen
            $query = "SELECT * FROM tbDoc d JOIN tbRestriction r ON d.tbdoc_id = r.tbres_doc WHERE d.tbdoc_status_arsip = 1 AND (r.tbres_role = " . $user->getTbuserRole() . " OR tbdoc_user_upload = " . $user->getTbuserRole() . ") AND tbdoc_isi LIKE '%" . $document->getTbdocIsi() . "%'";
        } else {
            //membuat query untuk mengambil semua dokumen arsip berdasarkan role user, isidokumen, dan tipe dokumen
            $query = "SELECT * FROM tbDoc d JOIN tbRestriction r ON d.tbdoc_id = r.tbres_doc WHERE d.tbdoc_status_arsip = 1 AND (r.tbres_role = " . $user->getTbuserRole() . " OR tbdoc_user_upload = " . $user->getTbuserRole() . ") AND tbdoc_isi LIKE '%" . $document->getTbdocIsi() . "%' AND tbdoc_jenis = " . $document->getTbdocJenis();
        }
        //mengaktifkan query di database
        //memasang hasil ke object Document
        //menutup koneksi dengan database
        //mengembalikan hasil
        $result = $link->query($query);
        $result->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, 'Document');
        PDOUtil::closeConnection($link);
        return $result->fetchAll();
    }

    public function searchAllDraft(User $user, Document $document)
    {
        //membuka koneksi dengan database
        $link = PDOUtil::createConnection();
        if ($document->getTbdocIsi() == "") {
            //membuat query untuk mengambil semua dokumen draft berdasarkan role user dan tipe dokumen
            $query = "SELECT * FROM tbDoc d JOIN tbRestriction r ON d.tbdoc_id = r.tbres_doc WHERE d.tbdoc_status_draft = 1 AND (r.tbres_role = " . $user->getTbuserRole() . " OR tbdoc_user_upload = " . $user->getTbuserRole() . ") AND tbdoc_jenis = " . $document->getTbdocJenis();
        } elseif ($document->getTbdocJenis() == "") {
            //membuat query untuk mengambil semua dokumen draft berdasarkan role user dan isi dokumen
            $query = "SELECT * FROM tbDoc d JOIN tbRestriction r ON d.tbdoc_id = r.tbres_doc WHERE d.tbdoc_status_draft = 1 AND (r.tbres_role = " . $user->getTbuserRole() . " OR tbdoc_user_upload = " . $user->getTbuserRole() . ") AND tbdoc_isi LIKE '%" . $document->getTbdocIsi() . "%'";
        } else {
            //membuat query untuk mengambil semua dokumen draft berdasarkan role user, isidokumen, dan tipe dokumen
            $query = "SELECT * FROM tbDoc d JOIN tbRestriction r ON d.tbdoc_id = r.tbres_doc WHERE d.tbdoc_status_draft = 1 AND (r.tbres_role = " . $user->getTbuserRole() . " OR tbdoc_user_upload = " . $user->getTbuserRole() . ") AND tbdoc_isi LIKE '%" . $document->getTbdocIsi() . "%' AND tbdoc_jenis = " . $document->getTbdocJenis();
        }
        //mengaktifkan query di database
        //memasang hasil ke object Document
        //menutup koneksi dengan database
        //mengembalikan hasil
        $result = $link->query($query);
        $result->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, 'Document');
        PDOUtil::closeConnection($link);
        return $result->fetchAll();
    }

    public function countDocumentType()
    {
        //membuka koneksi dengan database
        //membuat query untuk menghitung jenis dokumen yang digunakan
        //mengaktifkan query di database
        //memasang hasil ke object Document
        //menutup koneksi dengan database
        //mengembalikan hasil
        $link = PDOUtil::createConnection();
        $query = "SELECT tbdoc_jenis, COUNT(tbdoc_jenis) as jumlah FROM tbdoc GROUP BY tbdoc_jenis";
        $result = $link->query($query);
        $result->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, 'Document');
        PDOUtil::closeConnection($link);
        return $result->fetchAll();
    }

    public function countDocumentUser()
    {
        //membuka koneksi dengan database
        //membuat query untuk menghitung user yang mengunggah dokumen
        //mengaktifkan query di database
        //memasang hasil ke object Document
        //menutup koneksi dengan database
        //mengembalikan hasil
        $link = PDOUtil::createConnection();
        $query = "SELECT tbdoc_user_upload, COUNT(tbdoc_user_upload) as jumlah FROM tbdoc GROUP BY tbdoc_user_upload";
        $result = $link->query($query);
        $result->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, 'Document');
        PDOUtil::closeConnection($link);
        return $result->fetchAll();
    }

    public function addDocument(Document $document)
    {
        $result = 0;

        //membuat variable status = 0
        //membuka koneksi dengan database
        //membuat query untuk menambahkan dokumen
        //memasang parameter id, nomor, tanggal, keterangan, isi, status, user, type, storage di query
        $link = PDOUtil::createConnection();
        $query = "INSERT into tbDoc (tbdoc_id, tbdoc_no_doc, tbdoc_tgl_dibuat, tbdoc_ket, tbdoc_isi, tbdoc_status_draft, tbdoc_status_arsip, tbdoc_user_upload, tbdoc_tgl_upload, tbdoc_jenis, tbdoc_storage) VALUES (?,?,?,?,?,?,0,?,(SELECT CURRENT_TIMESTAMP()),?,?)";
        $stmt = $link->prepare($query);
        $stmt->bindValue(1, $document->getTbdocId());
        $stmt->bindValue(2, $document->getTbdocNoDoc());
        $stmt->bindValue(3, $document->getTbdocTglDibuat());
        $stmt->bindValue(4, $document->getTbdocKet());
        $stmt->bindValue(5, $document->getTbdocIsi());
        $stmt->bindValue(6, $document->getTbdocStatusDraft());
        $stmt->bindValue(7, $document->getTbdocUserUpload());
        $stmt->bindValue(8, $document->getTbdocJenis());
        $stmt->bindValue(9, $document->getTbdocStorage());
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

    public function updateDocument(Document $document)
    {
        $result = 0;

        //membuat variable status = 0
        //membuka koneksi dengan database
        //membuat query untuk mengubah dokumen
        //memasang parameter nomor, tanggal, keterangan, isi, user, type, storage, id di query
        $link = PDOUtil::createConnection();
        $query = "UPDATE tbDoc SET tbdoc_no_doc = ?, tbdoc_tgl_dibuat = ?, tbdoc_ket = ?, tbdoc_isi = ?, tbdoc_user_upload = ?, tbdoc_tgl_upload = (SELECT CURRENT_TIMESTAMP()), tbdoc_jenis = ?, tbdoc_storage = ? WHERE tbdoc_id = ?";
        $stmt = $link->prepare($query);
        $stmt->bindValue(1, $document->getTbdocNoDoc());
        $stmt->bindValue(2, $document->getTbdocTglDibuat());
        $stmt->bindValue(3, $document->getTbdocKet());
        $stmt->bindValue(4, $document->getTbdocIsi());
        $stmt->bindValue(5, $document->getTbdocUserUpload());
        $stmt->bindValue(6, $document->getTbdocJenis());
        $stmt->bindValue(7, $document->getTbdocStorage());
        $stmt->bindValue(8, $document->getTbdocId());
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

    public function draftStatus(Document $document)
    {
        $result = 0;

        //membuat variable status = 0
        //membuka koneksi dengan database
        //membuat query untuk mengubah status draft dokumen
        $link = PDOUtil::createConnection();
        if ($document->getTbdocStatusDraft() == 1) {
            //status draft = 0
            $query = "UPDATE tbDoc SET tbdoc_status_draft = 0 WHERE tbdoc_id = ?";
        } else {
            //status draft = 1
            $query = "UPDATE tbDoc SET tbdoc_status_draft = 1 WHERE tbdoc_id = ?";
        }
        //memasang parameter id di query
        $stmt = $link->prepare($query);
        $stmt->bindValue(1, $document->getTbdocId());
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

    public function archiveStatus(Document $document)
    {
        $result = 0;

        //membuat variable status = 0
        //membuka koneksi dengan database
        //membuat query untuk mengubah status arsip dokumen
        $link = PDOUtil::createConnection();
        if ($document->getTbdocStatusArsip() == 0) {
            //query status arsip = 1
            $query = "UPDATE tbDoc SET tbdoc_tgl_arsip = (SELECT CURRENT_TIMESTAMP()),  tbdoc_status_arsip = 1 WHERE tbdoc_id = ?";
        } else {
            //query status arsip = 0
            $query = "UPDATE tbDoc SET tbdoc_status_arsip = 0 WHERE tbdoc_id = ?";
        }
        //memasang parameter id di query
        $stmt = $link->prepare($query);
        $stmt->bindValue(1, $document->getTbdocId());
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

    /**
     * @return Document
     */
    public function maxId()
    {
        //membuka koneksi dengan database
        //membuat query untuk mengambil dokumen dengan id paling besar
        //mengaktifkan query di database
        //menutup koneksi dengan database
        //mengembalikan hasil sebagai object Document
        $link = PDOUtil::createConnection();
        $query = "SELECT MAX(tbdoc_id) AS 'tbdoc_id' FROM tbDoc";
        $stmt = $link->prepare($query);
        $stmt->setFetchMode(PDO::FETCH_OBJ);
        $stmt->execute();
        PDOUtil::closeConnection($link);
        return $stmt->fetchObject('Document');
    }
}