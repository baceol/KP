<?php


class MasterDocument implements JsonSerializable {
    private $doc_id;
    private $doc_jenis;
    private $doc_status;

    /**
     * @return mixed
     */
    public function getDocId()
    {
        return $this->doc_id;
    }

    /**
     * @param mixed $doc_id
     */
    public function setDocId($doc_id)
    {
        $this->doc_id = $doc_id;
    }

    /**
     * @return mixed
     */
    public function getDocJenis()
    {
        return $this->doc_jenis;
    }

    /**
     * @param mixed $doc_jenis
     */
    public function setDocJenis($doc_jenis)
    {
        $this->doc_jenis = $doc_jenis;
    }

    /**
     * @return mixed
     */
    public function getDocStatus()
    {
        return $this->doc_status;
    }

    /**
     * @param mixed $doc_status
     */
    public function setDocStatus($doc_status)
    {
        $this->doc_status = $doc_status;
    }

    public function jsonSerialize()
    {
        return get_object_vars($this);
    }
}