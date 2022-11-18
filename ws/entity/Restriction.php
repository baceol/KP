<?php


class Restriction implements JsonSerializable {
    private $tbres_id;
    private $tbres_role;
    private $tbres_doc;

    /**
     * @return mixed
     */
    public function getTbresId()
    {
        return $this->tbres_id;
    }

    /**
     * @param mixed $tbres_id
     */
    public function setTbresId($tbres_id)
    {
        $this->tbres_id = $tbres_id;
    }

    /**
     * @return mixed
     */
    public function getTbresRole()
    {
        return $this->tbres_role;
    }

    /**
     * @param mixed $tbres_role
     */
    public function setTbresRole($tbres_role)
    {
        $this->tbres_role = $tbres_role;
    }

    /**
     * @return mixed
     */
    public function getTbresDoc()
    {
        return $this->tbres_doc;
    }

    /**
     * @param mixed $tbres_doc
     */
    public function setTbresDoc($tbres_doc)
    {
        $this->tbres_doc = $tbres_doc;
    }

    public function jsonSerialize()
    {
        return get_object_vars($this);
    }
}