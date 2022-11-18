<?php


class UserController {
public function indexLogin() {
    $signInPressed = filter_input(INPUT_POST, 'btnSignIn');
    if ($signInPressed) {
        //mengambil input username dan password
        //mengirimkan username dan password ke web service lalu menerima data dari web service
        $username = filter_input(INPUT_POST, 'username');
        $password = filter_input(INPUT_POST, 'password');
        $sendData = array('username' => md5($username), 'password' => md5($password));
        $wsResponse = Utility::curl_post(APIService::AUTHENTICATE, $sendData);
        $response = json_decode($wsResponse);
        if (!empty($response->user)) {
            $user = $response->user;
            if ($user->tbuser_status == 1) {
                //mereset kesalahan user menjadi 0 melalui web service
                //mengupdate tanggal login user pada database melalui web service
                //membuat session untuk user
                $user->tbuser_salah = "0";
                $sendData = array('username' => $user->tbuser_username, 'password' => $user->tbuser_password, 'name' => $user->tbuser_nama, 'role' => $user->tbuser_role, 'salah' => $user->tbuser_salah, 'id' => $user->tbuser_id);
                Utility::curl_post(APIService::UPDATE_USER, $sendData);
                $sendData = array('id' => $user->tbuser_id);
                Utility::curl_post(APIService::STAMP_LOGIN, $sendData);
                $_SESSION['my_session'] = true;
                $_SESSION['session_user'] = $user;
                if ($user->tbuser_tgl_login == null) {
                    //membuka halaman ubah password
                    header("location:index.php?menu=password");
                } else {
                    //masuk ke halaman dokumen
                    header("location:index.php");
                }
            } else {
                //memberikan error "Akun yang akan digunakan telah terkunci"
                echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                      Akun yang akan digunakan telah terkunci<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                      </div>';
            }
        } else {
            //memberikan pesan error "Invalid username or password"
            echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                 ' . $response->message . '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                  </div>';
            //mengirimkan username ke webservice lalu menerima data dari web service
            $sendData = array('username' => md5($username));
            $wsResponse = Utility::curl_post(APIService::FETCH_USER_BY_NAME, $sendData);
            $user = json_decode($wsResponse);
            if (!empty($user)) {
                if ($user->tbuser_status == 1) {
                    //menambah kesalahan user
                    $user->tbuser_salah = strval($user->tbuser_salah + 1);
                    if ($user->tbuser_salah < 3) {
                        //mengupdate total kesalahan user di database melalui web service
                        $sendData = array('username' => $user->tbuser_username,'password' => $user->tbuser_password, 'name' => $user->tbuser_nama, 'role' => $user->tbuser_role, 'salah' => $user->tbuser_salah, 'id' => $user->tbuser_id);
                        Utility::curl_post(APIService::UPDATE_USER, $sendData);
                    } else {
                        //mengupdate total kesalahan user melalui web service
                        //mengubah status user menjadi terkunci melalui web service
                        $sendData = array('username' => $user->tbuser_username,'password' => $user->tbuser_password, 'name' => $user->tbuser_nama, 'role' => $user->tbuser_role, 'salah' => $user->tbuser_salah, 'id' => $user->tbuser_id);
                        Utility::curl_post(APIService::UPDATE_USER, $sendData);
                        $sendData = array('id' => $user->tbuser_id, 'status' => $user->tbuser_status);
                        Utility::curl_post(APIService::STATUS_USER, $sendData);
                    }
                }
            }
        }
    }

    include_once 'page/login.php';
}

public function indexLogout() {
    //mengupdate tanggal terakhir logout user pada database melalui web service
    //menghapus session untuk user
    //membuka halaman login
    $sendData = array('id' => $_SESSION['session_user']->tbuser_id, 'status' => $_SESSION['session_user']->tbuser_status);
    Utility::curl_post(APIService::STAMP_LOGOUT, $sendData);
    session_unset();
    session_destroy();
    header("location:index.php");
}

public function indexChangePassword() {
    $btnSubmit = filter_input(INPUT_POST, 'btnSubmit');
    if ($btnSubmit) {
        //mengambil data password baru dan retype password
        $password = filter_input(INPUT_POST, 'password');
        $re_password = filter_input(INPUT_POST, 're_password');
        if (!empty(str_replace(" ", "", $password)) || !empty(str_replace(" ", "", $re_password))) {
            if ($password == $re_password) {
                //mengupdate password user menjadi password yang baru
                //membuka halaman dokumen
                $sendData = array('username' => $_SESSION['session_user']->tbuser_username, 'password' => md5($password), 'name' => $_SESSION['session_user']->tbuser_nama, 'role' => $_SESSION['session_user']->tbuser_role, 'salah' => $_SESSION['session_user']->tbuser_salah, 'id' => $_SESSION['session_user']->tbuser_id);
                Utility::curl_post(APIService::UPDATE_USER, $sendData);
                header("location:index.php");
            } else {
                //membarikan pesan error "Password tidak sama"
                echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                  Password tidak sama<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                  </div>';
            }
        } else {
            //mengirimkan pesan error "Field tidak boleh kosong"
            echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                  Field tidak boleh kosong<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                  </div>';
        }
    }

    include_once 'page/changePassword.php';
}

public function indexUser() {
    //menerima variable cmd
    $cmd = filter_input(INPUT_GET, "cmd");
    if (!empty($cmd)) {
        //menerima id user
        $id = filter_input(INPUT_GET, "id");
        switch ($cmd) {
            case 'delete' :
                //jika cmd = delete
                //mengambil jumlah terpakainya jabatan
                $jumlah = filter_input(INPUT_GET, "jumlah");
                if ($jumlah == 0) {
                    //mengirimkan id ke webservice dan menghapus user yang dipilih
                    $sendData = array('id' => $id);
                    Utility::curl_post(APIService::DELETE_USER, $sendData);
                } else {
                    //mengirimkan pesan error "User memiliki dokumen"
                    echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                    user memiliki dokumen<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>';
                }
                break;
            case 'unlock' :
                //jika cmd = unlock
                //mengirimkan id ke web service dan menerima data user yang diminta
                //mengirimkan id dan status ke web service dan mengaktifkan user
                $sendData = array('id' => $id);
                $wsResponse = Utility::curl_post(APIService::FETCH_USER_BY_ID, $sendData);
                $user = json_decode($wsResponse);
                $sendData = array('id' => $id, 'status' => $user->tbuser_status);
                Utility::curl_post(APIService::STATUS_USER, $sendData);
                break;
            case 'reset' :
                //jika cmd = reset
                //mengirimkan id ke web service dan mereset password ke awal
                $sendData = array('id' => $id);
                Utility::curl_post(APIService::RESET_PASSWORD, $sendData);
                break;
        }
    }

    //menerima semua data user yang ada
    //menerima semua jumlah dokumen yang dimiliki user
    $wsResponse = Utility::curl_get(APIService::FETCH_USER, array());
    $result = json_decode($wsResponse);
    $wsResponse = Utility::curl_get(APIService::COUNT_DOC_USER, array());
    $result2 = json_decode($wsResponse);

    include_once 'page/user.php';
}

public function indexInsert() {
    //menerima semua data jabatan yang aktif
    $wsResponse = Utility::curl_get(APIService::FETCH_ACTIVE_MASTER_ROLE, array());
    $result = json_decode($wsResponse);

    $btnSubmit = filter_input(INPUT_POST, 'btnSubmit');
    if ($btnSubmit) {
        //mengambil input username, nama, dan role
        $username = md5(filter_input(INPUT_POST, 'username'));
        $name = filter_input(INPUT_POST, 'name');
        $role = filter_input(INPUT_POST, 'role');
        if (!empty(str_replace(" ", "", $name)) && !empty(str_replace(" ", "", $username))) {
            if ($this->checkUsername($username)) {
                //mengirmkan data ke web service dan menambahkan user baru
                //kembali ke halaman user
                $sendData = array('username' => $username, 'name' => $name, 'role' => $role);
                Utility::curl_post(APIService::INSERT_USER, $sendData);
                header("location:index.php?menu=user");
            } else {
                //mengirimkan pesan error "Username sudah diambil"
                echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                  Username sudah diambil<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                  </div>';
            }
        } else {
            //mengirimkan pesan error "Field tidak boleh kosong"
            echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                  Field tidak boleh kosong<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                  </div>';
        }
    }

    include_once 'page/formUser.php';
}

public function indexUpdate() {
    //menerima id user
    $id = filter_input(INPUT_GET, "id");
    $sendData = array('id' => $id);
    if (isset($id)) {
        //menerima data user berdasarkan id yang didapatkan
        //menerima semua data jabtan aktif
        $wsResponse = Utility::curl_post(APIService::FETCH_USER_BY_ID, $sendData);
        $result = json_decode($wsResponse);
        $wsResponse = Utility::curl_post(APIService::FETCH_ACTIVE_MASTER_ROLE, $sendData);
        $result2 = json_decode($wsResponse);
    }

    $btnSubmit = filter_input(INPUT_POST, 'btnSubmit');
    if ($btnSubmit) {
        //menerima input username, nama, role
        $username = md5(filter_input(INPUT_POST, 'username'));
        $name = filter_input(INPUT_POST, 'name');
        $role = filter_input(INPUT_POST, 'role');
        if (empty($username)) {
            //username memakai username lama
            $username = $result->tbuser_username;
        }
        if (!empty(str_replace(" ", "", $name)) && !empty(str_replace(" ", "", $username))) {
            if ($this->checkUsername($username)) {
                //mengirimkan data ke webservice dan mengubah data user
                //kembali ke halaman user
                $sendData = array('username' => $username, 'password' => $result->tbuser_password, 'name' => $name, 'role' => $role, 'salah' => $result->tbuser_salah, 'id' => $id);
                Utility::curl_post(APIService::UPDATE_USER, $sendData);
                header("location:index.php?menu=user");
            } else {
                //mengirimkan pesan error "Username sudah diambil"
                echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                  Username sudah diambil<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                  </div>';
            }
        } else {
            //mengirimkan pesan error "Field tidak boleh kosong"
            echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                  Field tidak boleh kosong<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                  </div>';
        }
    }

    include_once 'page/editUser.php';
}

function checkUsername($username) {
    $wsResponse = Utility::curl_get(APIService::FETCH_USER, array());
    $result = json_decode($wsResponse);
    foreach ($result as $user) {
        if ($user->tbuser_username == $username) {
            return false;
        }
    }

    return true;
}
}