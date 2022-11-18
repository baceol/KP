<?php


class DocumentController
{
    public $extension = [".pdf", ".docx"];

    public function indexDocument()
    {
        //menerima variable cmd
        $cmd = filter_input(INPUT_GET, "cmd");
        if (!empty($cmd)) {
            //mengambil id dari dokumen yang dipilih
            $id = filter_input(INPUT_GET, 'id');
            switch ($cmd) {
                case 'archive' :
                    //jika cmd = archive
                    //maka akan mengirimkan status dokumen dan id dokumen ke web service
                    //lalu akan merubah dokumen aktif menjadi dokumen arsip
                    //kembali ke halamana arsip
                    $sendData = array('id' => $id, 'status' => 0);
                    Utility::curl_post(APIService::ARCHIVE_DOC, $sendData);
                    header("location:index.php?menu=archive");
                    break;
                case 'undo' :
                    //jika cmd = undo
                    //maka akan mengirimkan status dokumen dan id dokumen ke web service
                    //lalu akan merubah dokumen aktif menjadi dokumen draft
                    //kembali ke halaman draft
                    $sendData = array('id' => $id, 'status' => 0);
                    Utility::curl_post(APIService::DRAFT_DOC, $sendData);
                    header("location:index.php?menu=draft");
                    break;
                case 'download' :
                    //jika cmd = download
                    //maka akan mendownload dokumen dengan id yang telah dipilih
                    $wsResponse = Utility::curl_post(APIService::FETCH_SPEC_DOC, array('id' => $id));
                    $doc = json_decode($wsResponse);
                    $filepath = $doc->tbdoc_storage;
                    header('Content-Description: File Transfer');
                    header('Content-Type: application/octet-stream; charset=utf-8');
                    header('Content-Disposition: attachment; filename=' . basename($filepath));
                    header('Content-Transfer-Encoding: binary');
                    header('Content-Length: ' . filesize($filepath));
                    ob_clean();
                    flush();
                    readfile($filepath);
                    break;
            }
        }

        //mengirimkan data role agar dapat menentukan dokumen apa saja yang dapat dilihat
        //mengembalikan data dan memunculkannya pada page dokumen
        $sendData = array('id' => $_SESSION['session_user']->tbuser_id,'role' => $_SESSION['session_user']->tbuser_role);
        $wsResponse = Utility::curl_post(APIService::FETCH_DOC, $sendData);
        $btnSubmit = filter_input(INPUT_POST, 'btnSubmit');
        if ($btnSubmit) {
            //jika button search ditekan maka akan mengirimkan role user, isi dokumen, dan tipe dokuemn untuk dicari
            //mengembalikan data dan akan memunculkan hasil search dan bukan seluruh dokumen
            $content = filter_input(INPUT_POST, 'content');
            $type = filter_input(INPUT_POST, 'type');
            if (!empty($content) || !empty($type)) {
                $sendData = array('role' => $_SESSION['session_user']->tbuser_role, 'isi' => $content, 'type' => $type);
                $wsResponse = Utility::curl_post(APIService::SEARCH_DOC, $sendData);
            }
        }
        $result = json_decode($wsResponse);
        $wsResponse = Utility::curl_post(APIService::FETCH_ACTIVE_MASTER_DOC, array());
        $result2 = json_decode($wsResponse);

        include_once 'page/document.php';
    }

    public function indexArchive()
    {
        //menerima variable cmd
        $cmd = filter_input(INPUT_GET, "cmd");
        if (!empty($cmd) && $cmd == 'undo') {
            //mengambil id dari dokumen yang dipilih
            //mengirimkan status dokumen dan id dokumen ke web service
            //lalu akan merubah dokumen arsip menjadi dokumen aktif
            //kembali ke halaman dokumen
            $id = filter_input(INPUT_GET, 'id');
            $sendData = array('id' => $id, 'status' => 1);
            Utility::curl_post(APIService::ARCHIVE_DOC, $sendData);
            header("location:index.php?menu=document");
        }

        //mengirimkan data role agar dapat menentukan dokumen apa saja yang dapat dilihat
        //mengembalikan data dan memunculkannya pada page dokumen
        $sendData = array('id' => $_SESSION['session_user']->tbuser_id,'role' => $_SESSION['session_user']->tbuser_role);
        $wsResponse = Utility::curl_post(APIService::FETCH_ARCHIVE, $sendData);
        $btnSubmit = filter_input(INPUT_POST, 'btnSubmit');
        if ($btnSubmit) {
            //jika button search ditekan maka akan mengirimkan role user, isi dokumen, dan tipe dokuemn untuk dicari
            //mengembalikan data dan akan memunculkan hasil search dan bukan seluruh dokumen
            $content = filter_input(INPUT_POST, 'content');
            $type = filter_input(INPUT_POST, 'type');
            if (!empty($content) || !empty($type)) {
                $sendData = array('role' => $_SESSION['session_user']->tbuser_role, 'isi' => $content, 'type' => $type);
                $wsResponse = Utility::curl_post(APIService::SEARCH_ARCHIVE, $sendData);
            }
        }
        $result = json_decode($wsResponse);
        $wsResponse = Utility::curl_post(APIService::FETCH_ACTIVE_MASTER_DOC, array());
        $result2 = json_decode($wsResponse);

        include_once 'page/archive.php';
    }

    public function indexDraft()
    {
        //menerima variable cmd
        $cmd = filter_input(INPUT_GET, "cmd");
        if (!empty($cmd)) {
            //mengambil id dari dokumen yang dipilih
            $id = filter_input(INPUT_GET, 'id');
            switch ($cmd) {
                case 'publish' :
                    //jika cmd = publish
                    //maka akan mengirimkan status dokumen dan id dokumen ke web service
                    //lalu akan merubah dokumen draft menjadi dokumen aktif
                    //kembali ke halaman dokumen
                    $sendData = array('id' => $id, 'status' => 1);
                    Utility::curl_post(APIService::DRAFT_DOC, $sendData);
                    header("location:index.php?menu=document");
                    break;
                case 'download' :
                    //jika cmd = download
                    //maka akan mendownload dokumen dengan id yang telah dipilih
                    $wsResponse = Utility::curl_post(APIService::FETCH_SPEC_DOC, array('id' => $id));
                    $doc = json_decode($wsResponse);
                    $filepath = $doc->tbdoc_storage;
                    header('Content-Description: File Transfer');
                    header('Content-Type: application/octet-stream; charset=utf-8');
                    header('Content-Disposition: attachment; filename=' . basename($filepath));
                    header('Content-Transfer-Encoding: binary');
                    header('Content-Length: ' . filesize($filepath));
                    ob_clean();
                    flush();
                    readfile($filepath);
                    break;
            }
        }

        //mengirimkan data role agar dapat menentukan dokumen apa saja yang dapat dilihat
        //mengembalikan data dan memunculkannya pada page dokumen
        $sendData = array('id' => $_SESSION['session_user']->tbuser_id,'role' => $_SESSION['session_user']->tbuser_role);
        $wsResponse = Utility::curl_post(APIService::FETCH_DRAFT, $sendData);
        $btnSubmit = filter_input(INPUT_POST, 'btnSubmit');
        if ($btnSubmit) {
            //jika button search ditekan maka akan mengirimkan role user, isi dokumen, dan tipe dokuemn untuk dicari
            //mengembalikan data dan akan memunculkan hasil search dan bukan seluruh dokumen
            $content = filter_input(INPUT_POST, 'content');
            $type = filter_input(INPUT_POST, 'type');
            if (!empty($content) || !empty($type)) {
                $sendData = array('role' => $_SESSION['session_user']->tbuser_role, 'isi' => $content, 'type' => $type);
                $wsResponse = Utility::curl_post(APIService::SEARCH_DRAFT, $sendData);
            }
        }
        $result = json_decode($wsResponse);
        $wsResponse = Utility::curl_post(APIService::FETCH_ACTIVE_MASTER_DOC, array());
        $result2 = json_decode($wsResponse);

        include_once 'page/draft.php';
    }

    public function indexInsert()
    {
        //mengambil semua tipe dokumen aktif dan semua jabatan aktif
        $status = filter_input(INPUT_GET, "status");
        $wsResponse = Utility::curl_post(APIService::FETCH_ACTIVE_MASTER_ROLE, array());
        $result = json_decode($wsResponse);
        $wsResponse = Utility::curl_post(APIService::FETCH_ACTIVE_MASTER_DOC, array());
        $result2 = json_decode($wsResponse);

        $btnSubmit = filter_input(INPUT_POST, 'btnSubmit');
        if ($btnSubmit) {
            //mengambil id paling besar yang ada di database
            //mengambil id + 1 untuk menjadi id dokumen sekarang
            $wsResponse = Utility::curl_get(APIService::FETCH_MAX_ID, array());
            $document = json_decode($wsResponse);

            //mengambil input nomor dokumen, tanggal dibuat, keterangan dokumen, isi dokumen, jabatan yang dapat melihat, tipe dokumen
            //menyimpan file di server dan nama file yang disimpan menjadi id dokumen
            //mengirimkan data kepada server untuk disimpan
            //kembali ke halaman dokumen
            $id = $document->tbdoc_id + 1;
            $nomor = filter_input(INPUT_POST, 'nomor');
            $tanggal = filter_input(INPUT_POST, 'tanggal');
            $keterangan = filter_input(INPUT_POST, 'keterangan');
            $isi = filter_input(INPUT_POST, 'isi');
            $role = filter_input(INPUT_POST, 'role', FILTER_DEFAULT, FILTER_FORCE_ARRAY);
            $type = filter_input(INPUT_POST, 'type');
            if (isset($_FILES['document']['name'])) {
                $targetDirectory = "upload/";
                $fileExtension = '.' . pathinfo($_FILES['document']['name'], PATHINFO_EXTENSION);
                $newFileName = $id . $fileExtension;
                $targetFile = $targetDirectory . $newFileName;
                if (in_array($fileExtension, $this->extension)) {
                    move_uploaded_file($_FILES['document']['tmp_name'], $targetFile);
                }
            }
            if (in_array($fileExtension, $this->extension)) {
                $sendData = array('id' => $id, 'nomor' => $nomor, 'tanggal' => $tanggal, 'keterangan' => $keterangan, 'isi' => $isi, 'status' => $status, 'user' => $_SESSION['session_user']->tbuser_id, 'type' => $type, 'storage' => $targetFile, 'role' => $role);
                Utility::curl_post(APIService::INSERT_DOC, $sendData);
                if ($status) {
                    header("location:index.php?menu=draft");
                } else {
                    header("location:index.php?menu=document");
                }
            } else {
                //mengirimkan pesan error "File hanya boleh berbentuk pdf atau docx"
                echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                    File hanya boleh berbentuk pdf atau docx<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>';
            }
        }

        include_once 'page/formDocument.php';
    }

    public function indexUpdate()
    {
        //menerima id dokumen
        $id = filter_input(INPUT_GET, "id");
        $sendData = array('id' => $id);
        if (isset($id)) {
            //mengambil data dokumen yang akan di edit
            //mengambil data semua tipe dokumen aktif
            //mengambil data semua jabatan aktif
            $wsResponse = Utility::curl_post(APIService::FETCH_SPEC_DOC, $sendData);
            $result = json_decode($wsResponse);
            $wsResponse = Utility::curl_post(APIService::FETCH_ACTIVE_MASTER_DOC, array());
            $result2 = json_decode($wsResponse);
            $used = $this->usedRole($sendData);
        }

        $btnSubmit = filter_input(INPUT_POST, 'btnSubmit');
        if ($btnSubmit) {
            //mengambil input nomor dokumen, tanggal dibuat, keterangan dokumen, isi dokumen, jabatan yang dapat melihat, tipe dokumen
            $nomor = filter_input(INPUT_POST, 'nomor');
            $tanggal = filter_input(INPUT_POST, 'tanggal');
            $keterangan = filter_input(INPUT_POST, 'keterangan');
            $isi = filter_input(INPUT_POST, 'isi');
            $role = filter_input(INPUT_POST, 'role', FILTER_DEFAULT, FILTER_FORCE_ARRAY);
            $type = filter_input(INPUT_POST, 'type');
            $targetFile = $result->tbdoc_storage;
            if ($_FILES['document']['name'] != "") {
                //menghapus file dokumen yang sebelumnya
                //mengganti naam filedokumen baru menjadi id dan menyimpan pada sever
                unlink($result->tbdoc_storage);
                $targetDirectory = "upload/";
                $fileExtension = '.' . pathinfo($_FILES['document']['name'], PATHINFO_EXTENSION);
                $newFileName = $id . $fileExtension;
                $targetFile = $targetDirectory . $newFileName;
                if (in_array($fileExtension, $this->extension)) {
                    move_uploaded_file($_FILES['document']['tmp_name'], $targetFile);
                }
            }
            //menentukan jabatan apa saja yang dipakai atau tidak dipakai
            $change = $this->changeRole($used, $role);
            $used = $change[0];
            $role = $change[1];
            //mengirim data ke web service
            //kemabali ke halaman dokumen
            if (in_array($fileExtension, $this->extension)) {
                $sendData = array('id' => $id, 'nomor' => $nomor, 'tanggal' => $tanggal, 'keterangan' => $keterangan, 'isi' => $isi, 'user' => $_SESSION['session_user']->tbuser_id, 'type' => $type, 'storage' => $targetFile, 'role' => $role, 'used' => $used);
                Utility::curl_post(APIService::UPDATE_DOC, $sendData);
                header("location:index.php?menu=draft");
            } else {
                //mengirimkan pesan error "File hanya boleh berbentuk pdf atau docx"
                echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                    File hanya boleh berbentuk pdf atau docx<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>';
            }
        }

        include_once 'page/editDocument.php';
    }

    function usedRole($sendData)
    {
        $wsResponse = Utility::curl_post(APIService::FETCH_ACTIVE_MASTER_ROLE, array());
        $result = json_decode($wsResponse);
        $wsResponse = Utility::curl_post(APIService::FETCH_RESTRICTION, $sendData);
        $result2 = json_decode($wsResponse);
        $used = array();

        foreach ($result as $role) {
            $check = true;
            foreach ($result2 as $restriction) {
                if ($role->role_id == $restriction->tbres_role) {
                    $new = array('id' => $role->role_id, 'name' => $role->role_name, 'status' => 1);
                    $check = false;
                    break;
                }
            }
            if ($check) {
                $new = array('id' => $role->role_id, 'name' => $role->role_name, 'status' => 0);
            }
            array_push($used, $new);
        }

        return $used;
    }

    function changeRole($result, $result2)
    {
        $array = array();

        foreach ($result as $used) {
            if ($used['status'] == 1) {
                foreach ($result2 as $role) {
                    if ($used['id'] == $role) {
                        unset($result[array_search($used, $result)]);
                        unset($result2[array_search($role, $result2)]);
                    }
                }
            } else {
                unset($result[array_search($used, $result)]);
            }
        }

        array_push($array, $result);
        array_push($array, $result2);
        return $array;
    }
}