<?php


class User implements JsonSerializable {
    private $tbuser_id;
    private $tbuser_username;
    private $tbuser_password;
    private $tbuser_nama;
    private $tbuser_role;
    private $tbuser_salah;
    private $tbuser_tgl_login;
    private $tbuser_tgl_logout;
    private $tbuser_tgl_lock;
    private $tbuser_status;
    private $role_name;
    private $jumlah;

    /**
     * @return mixed
     */
    public function getTbuserId()
    {
        return $this->tbuser_id;
    }

    /**
     * @param mixed $tbuser_id
     */
    public function setTbuserId($tbuser_id)
    {
        $this->tbuser_id = $tbuser_id;
    }

    /**
     * @return mixed
     */
    public function getTbuserUsername()
    {
        return $this->tbuser_username;
    }

    /**
     * @param mixed $tbuser_username
     */
    public function setTbuserUsername($tbuser_username)
    {
        $this->tbuser_username = $tbuser_username;
    }

    /**
     * @return mixed
     */
    public function getTbuserPassword()
    {
        return $this->tbuser_password;
    }

    /**
     * @param mixed $tbuser_password
     */
    public function setTbuserPassword($tbuser_password)
    {
        $this->tbuser_password = $tbuser_password;
    }

    /**
     * @return mixed
     */
    public function getTbuserNama()
    {
        return $this->tbuser_nama;
    }

    /**
     * @param mixed $tbuser_nama
     */
    public function setTbuserNama($tbuser_nama)
    {
        $this->tbuser_nama = $tbuser_nama;
    }

    /**
     * @return mixed
     */
    public function getTbuserRole()
    {
        return $this->tbuser_role;
    }

    /**
     * @param mixed $tbuser_role
     */
    public function setTbuserRole($tbuser_role)
    {
        $this->tbuser_role = $tbuser_role;
    }

    /**
     * @return mixed
     */
    public function getTbuserSalah()
    {
        return $this->tbuser_salah;
    }

    /**
     * @param mixed $tbuser_salah
     */
    public function setTbuserSalah($tbuser_salah)
    {
        $this->tbuser_salah = $tbuser_salah;
    }

    /**
     * @return mixed
     */
    public function getTbuserTglLogin()
    {
        return $this->tbuser_tgl_login;
    }

    /**
     * @param mixed $tbuser_tgl_login
     */
    public function setTbuserTglLogin($tbuser_tgl_login)
    {
        $this->tbuser_tgl_login = $tbuser_tgl_login;
    }

    /**
     * @return mixed
     */
    public function getTbuserTglLogout()
    {
        return $this->tbuser_tgl_logout;
    }

    /**
     * @param mixed $tbuser_tgl_logout
     */
    public function setTbuserTglLogout($tbuser_tgl_logout)
    {
        $this->tbuser_tgl_logout = $tbuser_tgl_logout;
    }

    /**
     * @return mixed
     */
    public function getTbuserTglLock()
    {
        return $this->tbuser_tgl_lock;
    }

    /**
     * @param mixed $tbuser_tgl_lock
     */
    public function setTbuserTglLock($tbuser_tgl_lock)
    {
        $this->tbuser_tgl_lock = $tbuser_tgl_lock;
    }

    /**
     * @return mixed
     */
    public function getTbuserStatus()
    {
        return $this->tbuser_status;
    }

    /**
     * @param mixed $tbuser_status
     */
    public function setTbuserStatus($tbuser_status)
    {
        $this->tbuser_status = $tbuser_status;
    }

    /**
     * @return mixed
     */
    public function getRoleName()
    {
        return $this->role_name;
    }

    /**
     * @param mixed $role_name
     */
    public function setRoleName($role_name)
    {
        $this->role_name = $role_name;
    }

    /**
     * @return mixed
     */
    public function getJumlah()
    {
        return $this->jumlah;
    }

    /**
     * @param mixed $jumlah
     */
    public function setJumlah($jumlah)
    {
        $this->jumlah = $jumlah;
    }

    public function jsonSerialize() {
        return get_object_vars($this);
    }
}