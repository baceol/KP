<?php


class RoleController {
public function indexRole() {
    //menerima variable cmd
    $cmd = filter_input(INPUT_GET, "cmd");
    if (!empty($cmd)) {
        //menerima id jabatan
        $id = filter_input(INPUT_GET, "id");
        switch ($cmd) {
            case 'delete' :
                //jika cmd = delete
                //mengambil jumlah terpakainya jabatan
                $jumlah = filter_input(INPUT_GET, "jumlah");
                if ($jumlah == 0) {
                    //mengirim id ke web service dan menghapus jabatan yang dipilih
                    $sendData = array('id' => $id);
                    Utility::curl_post(APIService::DELETE_MASTER_ROLE, $sendData);
                } else {
                    //mengirimkan pesan error "jabatan sedang dipakai"
                    echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                    Jabatan sedang dipakai<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>';
                }
                break;
            case 'unlock' :
                //jika cmd = unlock
                //mengirimkan id ke web service dan menerima data jabatan yang diminta
                //mengirimkan id dan status ke web service dan mengaktifkan atau menonaktifkan jabatan
                $sendData = array('id' => $id);
                $wsResponse = Utility::curl_post(APIService::FETCH_SPEC_MASTER_ROLE, $sendData);
                $role = json_decode($wsResponse);
                $sendData = array('id' => $id, 'status' => $role->role_status);
                Utility::curl_post(APIService::STATUS_MASTER_ROLE, $sendData);
                break;
        }
    }

    //menerima semua data jabtan yang ada
    //menerima data jumlah jabatan yang sedang dipakai
    $wsResponse = Utility::curl_get(APIService::FETCH_MASTER_ROLE, array());
    $result = json_decode($wsResponse);
    $wsResponse = Utility::curl_get(APIService::COUNT_USER_ROLE, array());
    $result2 = json_decode($wsResponse);

    include_once 'page/role.php';
}

public function indexInsert() {
    $btnSubmit = filter_input(INPUT_POST, 'btnSubmit');
    if ($btnSubmit) {
        //mengambil input nama
        $name = filter_input(INPUT_POST, 'name');
        if (!empty(str_replace(" ", "", $name))) {
            if ($this->checkRole($name)) {
                //mengirimkan data ke webservice dan dimasukan kedalam data base
                //kembali ke halaman role
                $sendData = array('name' => $name);
                Utility::curl_post(APIService::INSERT_MASTER_ROLE, $sendData);
                header("location:index.php?menu=role");
            } else {
                //mengirimkan pesan error "Nama jabatan sudah ada"
                echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                  Nama jabatan sudah ada<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                  </div>';
            }
        } else {
            //mengirimkan pesan error "Field tidak boleh kosong"
            echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                  Field tidak boleh kosong<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                  </div>';
        }
    }

    include_once 'page/formRole.php';
}

public function indexUpdate() {
    //menerima id jabatan
    $id = filter_input(INPUT_GET, "id");
    $sendData = array('id' => $id);
    if (isset($id)) {
        //mengirimkan id jabatan ke web service dan menerima data jabatan dengan id jabatan tersebut
        $wsResponse = Utility::curl_post(APIService::FETCH_SPEC_MASTER_ROLE, $sendData);
        $result = json_decode($wsResponse);
    }

    $btnSubmit = filter_input(INPUT_POST, 'btnSubmit');
    if ($btnSubmit) {
        //mengambil input nama
        $name = filter_input(INPUT_POST, 'name');
        if (!empty(str_replace(" ", "", $name))) {
            if ($this->checkRole($name)) {
                //mengirimkan nama dan id ke webservice dan melakukan proses update data pada database
                //kembali ke halaman jabatan
                $sendData = array('name' => $name, 'id' => $id);
                Utility::curl_post(APIService::UPDATE_MASTER_ROLE, $sendData);
                header("location:index.php?menu=role");
            } else {
                //mengirimkan pesan error "Nama jabatan sudah ada"
                echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                  Nama jabatan sudah ada<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                  </div>';
            }
        } else {
            //mengirimkan pesan error "Field tidak boleh kosong"
            echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                  Field tidak boleh kosong<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                  </div>';
        }
    }

    include_once 'page/editRole.php';
}

function checkRole($name) {
    $wsResponse = Utility::curl_get(APIService::FETCH_MASTER_ROLE, array());
    $result = json_decode($wsResponse);
    foreach ($result as $role) {
        if ($role->role_name == $name) {
            return false;
        }
    }

    return true;
}
}