<?php


class TypeController {
public function indexType() {
    //menerima variable cmd
    $cmd = filter_input(INPUT_GET, "cmd");
    if (!empty($cmd)) {
        //menerima id tipe dokumen
        $id = filter_input(INPUT_GET, "id");
        switch ($cmd) {
            case 'delete' :
                //jika cmd = delete
                //mengambil jumlah terpakainya tipe dokumen
                $jumlah = filter_input(INPUT_GET, "jumlah");
                if ($jumlah == 0) {
                    //mengirim id ke web service dan menghapus tipe dokumen yang dipilih
                    $sendData = array('id' => $id);
                    Utility::curl_post(APIService::DELETE_MASTER_DOC, $sendData);
                } else {
                    //mengirimkan pesan error "tipe dokumen sedang dipakai
                    echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                    Tipe dokumen sedang dipakai<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>';
                }
                break;
            case 'unlock' :
                //jika cmd = unlock
                //mengirimkan id ke web service dan menerima data tipe dokumen yang diminta
                //mengirimkan id dan status ke web service dan mengaktifkan atau menonaktifkan tipe dokumen
                $sendData = array('id' => $id);
                $wsResponse = Utility::curl_post(APIService::FETCH_SPEC_MASTER_DOC, $sendData);
                $role = json_decode($wsResponse);
                $sendData = array('id' => $id, 'status' => $role->doc_status);
                Utility::curl_post(APIService::STATUS_MASTER_DOC, $sendData);
                break;
        }
    }

    $wsResponse = Utility::curl_get(APIService::FETCH_MASTER_DOC, array());
    $result = json_decode($wsResponse);
    $wsResponse = Utility::curl_get(APIService::COUNT_DOC_TYPE, array());
    $result2 = json_decode($wsResponse);

    include_once 'page/type.php';
}

public function indexInsert() {
    $btnSubmit = filter_input(INPUT_POST, 'btnSubmit');
    if ($btnSubmit) {
        //mengambil input nama
        $name = filter_input(INPUT_POST, 'name');
        if (!empty(str_replace(" ", "", $name))) {
            if ($this->checkType($name)) {
                //mengirimkan data ke webservice dan dimasukan kedalam data base
                //kembali ke halaman role
                $sendData = array('name' => $name);
                Utility::curl_post(APIService::INSERT_MASTER_DOC, $sendData);
                header("location:index.php?menu=type");
            } else {
                //mengirimkan pesan error "Nama tipe dokumen sudah ada"
                echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                      Nama tipe dokumen sudah ada<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                      </div>';
            }
        } else {
            //mengirimkan pesan error "Field tidak boleh kosong"
            echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                  Field tidak boleh kosong<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                  </div>';
        }
    }

    include_once 'page/formType.php';
}

public function indexUpdate() {
    //menerima id tipe dokumen
    $id = filter_input(INPUT_GET, "id");
    $sendData = array('id' => $id);
    if (isset($id)) {
        //mengirimkan id tipe dokumen ke web service dan menerima data tipe dokumen dengan id tipe dokumen tersebut
        $wsResponse = Utility::curl_post(APIService::FETCH_SPEC_MASTER_DOC, $sendData);
        $result = json_decode($wsResponse);
    }

    $btnSubmit = filter_input(INPUT_POST, 'btnSubmit');
    if ($btnSubmit) {
        //mengambil input nama
        $name = filter_input(INPUT_POST, 'name');
        if (!empty(str_replace(" ", "", $name))) {
            if ($this->checkType($name)) {
                //mengirimkan nama dan id ke webservice dan melakukan proses update data pada database
                //kembali ke halaman jabatan
                $sendData = array('name' => $name, 'id' => $id);
                Utility::curl_post(APIService::UPDATE_MASTER_DOC, $sendData);
                header("location:index.php?menu=type");
            } else {
                //mengirimkan pesan error "Nama tipe dokumen sudah ada"
                echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                  Nama tipe dokumen sudah ada<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                  </div>';
            }
        } else {
            //mengirimkan pesan error "Field tidak boleh kosong"
            echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                  Field tidak boleh kosong<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                  </div>';
        }
    }

    include_once 'page/editType.php';
}

function checkType($name) {
    $wsResponse = Utility::curl_get(APIService::FETCH_MASTER_DOC, array());
    $result = json_decode($wsResponse);
    foreach ($result as $type) {
        if ($type->doc_jenis == $name) {
            return false;
        }
    }

    return true;
}
}