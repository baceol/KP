<?php


class Document implements JsonSerializable{
    private $tbdoc_id;
    private $tbdoc_no_doc;
    private $tbdoc_tgl_dibuat;
    private $tbdoc_ket;
    private $tbdoc_isi;
    private $tbdoc_status_draft;
    private $tbdoc_status_arsip;
    private $tbdoc_tgl_arsip;
    private $tbdoc_user_upload;
    private $tbdoc_tgl_upload;
    private $tbdoc_jenis;
    private $tbdoc_storage;
    private $jumlah;

    /**
     * @return mixed
     */
    public function getTbdocId()
    {
        return $this->tbdoc_id;
    }

    /**
     * @param mixed $tbdoc_id
     */
    public function setTbdocId($tbdoc_id)
    {
        $this->tbdoc_id = $tbdoc_id;
    }

    /**
     * @return mixed
     */
    public function getTbdocNoDoc()
    {
        return $this->tbdoc_no_doc;
    }

    /**
     * @param mixed $tbdoc_no_doc
     */
    public function setTbdocNoDoc($tbdoc_no_doc)
    {
        $this->tbdoc_no_doc = $tbdoc_no_doc;
    }

    /**
     * @return mixed
     */
    public function getTbdocTglDibuat()
    {
        return $this->tbdoc_tgl_dibuat;
    }

    /**
     * @param mixed $tbdoc_tgl_dibuat
     */
    public function setTbdocTglDibuat($tbdoc_tgl_dibuat)
    {
        $this->tbdoc_tgl_dibuat = $tbdoc_tgl_dibuat;
    }

    /**
     * @return mixed
     */
    public function getTbdocKet()
    {
        return $this->tbdoc_ket;
    }

    /**
     * @param mixed $tbdoc_ket
     */
    public function setTbdocKet($tbdoc_ket)
    {
        $this->tbdoc_ket = $tbdoc_ket;
    }

    /**
     * @return mixed
     */
    public function getTbdocIsi()
    {
        return $this->tbdoc_isi;
    }

    /**
     * @param mixed $tbdoc_isi
     */
    public function setTbdocIsi($tbdoc_isi)
    {
        $this->tbdoc_isi = $tbdoc_isi;
    }

    /**
     * @return mixed
     */
    public function getTbdocStatusDraft()
    {
        return $this->tbdoc_status_draft;
    }

    /**
     * @param mixed $tbdoc_status_draft
     */
    public function setTbdocStatusDraft($tbdoc_status_draft)
    {
        $this->tbdoc_status_draft = $tbdoc_status_draft;
    }

    /**
     * @return mixed
     */
    public function getTbdocStatusArsip()
    {
        return $this->tbdoc_status_arsip;
    }

    /**
     * @param mixed $tbdoc_status_arsip
     */
    public function setTbdocStatusArsip($tbdoc_status_arsip)
    {
        $this->tbdoc_status_arsip = $tbdoc_status_arsip;
    }

    /**
     * @return mixed
     */
    public function getTbdocTglArsip()
    {
        return $this->tbdoc_tgl_arsip;
    }

    /**
     * @param mixed $tbdoc_tgl_arsip
     */
    public function setTbdocTglArsip($tbdoc_tgl_arsip)
    {
        $this->tbdoc_tgl_arsip = $tbdoc_tgl_arsip;
    }

    /**
     * @return mixed
     */
    public function getTbdocUserUpload()
    {
        return $this->tbdoc_user_upload;
    }

    /**
     * @param mixed $tbdoc_user_upload
     */
    public function setTbdocUserUpload($tbdoc_user_upload)
    {
        $this->tbdoc_user_upload = $tbdoc_user_upload;
    }

    /**
     * @return mixed
     */
    public function getTbdocTglUpload()
    {
        return $this->tbdoc_tgl_upload;
    }

    /**
     * @param mixed $tbdoc_tgl_upload
     */
    public function setTbdocTglUpload($tbdoc_tgl_upload)
    {
        $this->tbdoc_tgl_upload = $tbdoc_tgl_upload;
    }

    /**
     * @return mixed
     */
    public function getTbdocJenis()
    {
        return $this->tbdoc_jenis;
    }

    /**
     * @param mixed $tbdoc_jenis
     */
    public function setTbdocJenis($tbdoc_jenis)
    {
        $this->tbdoc_jenis = $tbdoc_jenis;
    }

    /**
     * @return mixed
     */
    public function getTbdocStorage()
    {
        return $this->tbdoc_storage;
    }

    /**
     * @param mixed $tbdoc_storage
     */
    public function setTbdocStorage($tbdoc_storage)
    {
        $this->tbdoc_storage = $tbdoc_storage;
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

    public function jsonSerialize()
    {
        return get_object_vars($this);
    }
}