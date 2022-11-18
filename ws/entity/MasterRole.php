<?php


class MasterRole implements JsonSerializable
{
    private $role_id;
    private $role_name;
    private $role_status;

    /**
     * @return mixed
     */
    public function getRoleId()
    {
        return $this->role_id;
    }

    /**
     * @param mixed $role_id
     */
    public function setRoleId($role_id)
    {
        $this->role_id = $role_id;
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
    public function getRoleStatus()
    {
        return $this->role_status;
    }

    /**
     * @param mixed $role_status
     */
    public function setRoleStatus($role_status)
    {
        $this->role_status = $role_status;
    }

    public function jsonSerialize()
    {
        return get_object_vars($this);
    }
}