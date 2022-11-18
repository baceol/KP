<?php


class UserDAO
{
    /**
     * @param User $user
     * @return User
     */
    public function login(User $user)
    {
        //membuka koneksi dengan database
        //membuat query untuk mengambil user berdasarkan username dan password
        //memasang parameter username dan password di query
        //mengaktifkan query di database
        //menutup koneksi dengan database
        //mengembalikan hasil sebgai object User
        $link = PDOUtil::createConnection();
        $query = "SELECT u.*, r.role_name as 'role_name' FROM tbUser u JOIN master_role r ON u.tbuser_role = r.role_id WHERE tbuser_username = ? AND tbuser_password = ?";
        $stmt = $link->prepare($query);
        $stmt->bindValue(1, $user->getTbuserUsername());
        $stmt->bindValue(2, $user->getTbuserPassword());
        $stmt->setFetchMode(PDO::FETCH_OBJ);
        $stmt->execute();
        PDOUtil::closeConnection($link);
        return $stmt->fetchObject('User');
    }

    public function fetchAllUser()
    {
        //membuka koneksi dengan database
        //membuat query untuk mengambil semua user
        //mengaktifkan query di database
        //memasang hasil ke object User
        //menutup koneksi dengan database
        //mengembalikan hasil
        $link = PDOUtil::createConnection();
        $query = "SELECT u.*, r.role_name as 'role_name' FROM tbUser u JOIN master_role r ON u.tbuser_role = r.role_id";
        $result = $link->query($query);
        $result->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, 'User');
        PDOUtil::closeConnection($link);
        return $result->fetchAll();
    }

    public function countUserRole()
    {
        //membuka koneksi dengan database
        //membuat query untuk menghitung jabatan yang digunakan
        //mengaktifkan query di database
        //memasang hasil ke object User
        //menutup koneksi dengan database
        //mengembalikan hasil
        $link = PDOUtil::createConnection();
        $query = "SELECT tbuser_role, COUNT(tbuser_role) as jumlah FROM tbuser GROUP BY tbuser_role";
        $result = $link->query($query);
        $result->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, 'User');
        PDOUtil::closeConnection($link);
        return $result->fetchAll();
    }

    /**
     * @param $id
     * @return User
     */
    public function fetchUserId($id)
    {
        //membuka koneksi dengan database
        //membuat query untuk mengambil user berdasarkan id
        //memasang parameter id di query
        //mengaktifkan query di database
        //menutup koneksi dengan database
        //mengembalikan hasil sebgai object User
        $link = PDOUtil::createConnection();
        $query = "SELECT u.*, r.role_name as 'role_name' FROM tbUser u JOIN master_role r ON u.tbuser_role = r.role_id WHERE tbuser_id = ?";
        $stmt = $link->prepare($query);
        $stmt->bindParam(1, $id);
        $stmt->setFetchMode(PDO::FETCH_OBJ);
        $stmt->execute();
        PDOUtil::closeConnection($link);
        return $stmt->fetchObject('User');
    }

    /**
     * @param $name
     * @return User
     */
    public function fetchUserName($name)
    {
        //membuka koneksi dengan database
        //membuat query untuk mengambil user berdasarkan username
        //memasang parameter username di query
        //mengaktifkan query di database
        //menutup koneksi dengan database
        //mengembalikan hasil sebgai object User
        $link = PDOUtil::createConnection();
        $query = "SELECT * FROM tbUser WHERE tbuser_username = ?";
        $stmt = $link->prepare($query);
        $stmt->bindParam(1, $name);
        $stmt->setFetchMode(PDO::FETCH_OBJ);
        $stmt->execute();
        PDOUtil::closeConnection($link);
        return $stmt->fetchObject('User');
    }

    public function addUser(User $user)
    {
        $result = 0;

        //membuat variable status = 0
        //membuka koneksi dengan database
        //membuat query untuk menambahkan user
        //memasang parameter username, nama, role di query
        $link = PDOUtil::createConnection();
        $query = "INSERT into tbUser (tbuser_username, tbuser_password, tbuser_nama, tbuser_role, tbuser_salah, tbuser_status) VALUES (?,'19758b13d6fa99953351706c73c43acc',?,?,0,1)";
        $stmt = $link->prepare($query);
        $stmt->bindValue(1, $user->getTbuserUsername());
        $stmt->bindValue(2, $user->getTbuserNama());
        $stmt->bindValue(3, $user->getTbuserRole());
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

    public function deleteUser(User $user)
    {
        $result = 0;

        //membuat variable status = 0
        //membuka koneksi dengan database
        //membuat query untuk menghapus user
        //memasang parameter id di query
        $link = PDOUtil::createConnection();
        $query = "DELETE FROM tbUser WHERE tbuser_id = ?";
        $stmt = $link->prepare($query);
        $stmt->bindValue(1, $user->getTbuserId());
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

    public function updateUser(User $user)
    {
        $result = 0;

        //membuat variable status = 0
        //membuka koneksi dengan database
        //membuat query untuk menambahkan user
        //memasang parameter username, password, nama, role, salah, id di query
        $link = PDOUtil::createConnection();
        $query = "UPDATE tbUser SET tbuser_username = ?, tbuser_password = ?, tbuser_nama = ?, tbuser_role = ?, tbuser_salah = ? WHERE tbuser_id = ?";
        $stmt = $link->prepare($query);
        $stmt->bindValue(1, $user->getTbuserUsername());
        $stmt->bindValue(2, $user->getTbuserPassword());
        $stmt->bindValue(3, $user->getTbuserNama());
        $stmt->bindValue(4, $user->getTbuserRole());
        $stmt->bindValue(5, $user->getTbuserSalah());
        $stmt->bindValue(6, $user->getTbuserId());
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

    public function statusUser(User $user)
    {
        $result = 0;

        //membuat variable status = 0
        //membuka koneksi dengan database
        //membuat query untuk mengubah status user
        $link = PDOUtil::createConnection();
        if ($user->getTbuserStatus() == 1) {
            //query status user = 0
            $query = "UPDATE tbUser SET tbuser_tgl_lock = (SELECT CURRENT_TIMESTAMP()), tbuser_status = 0 WHERE tbuser_id = ?";
        } else {
            //query status user = 1
            $query = "UPDATE tbUser SET tbuser_tgl_lock = NULL, tbuser_status = 1 WHERE tbuser_id = ?";
        }
        //memasang parameter id di query
        $stmt = $link->prepare($query);
        $stmt->bindValue(1, $user->getTbuserId());
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

    public function resetPassword(User $user)
    {
        $result = 0;

        //membuat variable status = 0
        //membuka koneksi dengan database
        //membuat query untuk mengubah password user
        //memasang parameter id di query
        $link = PDOUtil::createConnection();
        $query = "UPDATE tbUser SET tbuser_tgl_login = NULL, tbuser_tgl_logout = NULL, tbuser_tgl_lock = NULL, tbuser_password = '19758b13d6fa99953351706c73c43acc' WHERE tbuser_id = ?";
        $stmt = $link->prepare($query);
        $stmt->bindValue(1, $user->getTbuserId());
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

    public function stampLogin(User $user)
    {
        $result = 0;

        //membuat variable status = 0
        //membuka koneksi dengan database
        //membuat query untuk mengubah tanggal login terakhir user
        //memasang parameter id di query
        $link = PDOUtil::createConnection();
        $query = "UPDATE tbUser SET tbuser_tgl_login = (SELECT CURRENT_TIMESTAMP()) WHERE tbuser_id = ?";
        $stmt = $link->prepare($query);
        $stmt->bindValue(1, $user->getTbuserId());
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

    public function stampLogout(User $user)
    {
        $result = 0;

        //membuat variable status = 0
        //membuka koneksi dengan database
        //membuat query untuk mengubah tanggal logout terakhir user
        //memasang parameter id di query
        $link = PDOUtil::createConnection();
        $query = "UPDATE tbUser SET tbuser_tgl_logout = (SELECT CURRENT_TIMESTAMP()) WHERE tbuser_id = ?";
        $stmt = $link->prepare($query);
        $stmt->bindValue(1, $user->getTbuserId());
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