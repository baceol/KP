<?php
session_start();
include_once 'controller/UserController.php';
include_once 'controller/DocumentController.php';
include_once 'controller/RoleController.php';
include_once 'controller/TypeController.php';
include_once 'utility/APIService.php';
include_once 'utility/Utility.php';
if (!isset($_SESSION['my_session'])) {
    $_SESSION['my_session'] = false;
}
?>

<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="generator" content="Hugo 0.80.0">
        <title>Document</title>

        <link rel="canonical" href="https://getbootstrap.com/docs/5.0/examples/starter-template/">


        <!-- Bootstrap core CSS -->
        <link href="assets/dist/css/bootstrap.min.css" rel="stylesheet">
        <style>
            .bd-placeholder-img {
                font-size: 1.125rem;
                text-anchor: middle;
                -webkit-user-select: none;
                -moz-user-select: none;
                user-select: none;
            }

            @media (min-width: 768px) {
                .bd-placeholder-img-lg {
                    font-size: 3.5rem;
                }
            }
        </style>
        <!-- Custom styles for this template -->
        <link href="css/starter-template.css" rel="stylesheet">
        <link rel="stylesheet" type="text/css" href="css/datatables.css">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.0/font/bootstrap-icons.css">


    </head>
    <body>

        <nav class="navbar navbar-expand-md navbar-dark bg-dark fixed-top">
            <div class="container-fluid">
                <a class="navbar-brand">Document</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarsExampleDefault"
                        aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarsExampleDefault">
                    <ul class="navbar-nav me-auto mb-2 mb-md-0">
                        <?php
                        if (!$_SESSION['my_session']) {
                            echo '<li class="nav-item">
                                <a class="nav-link" href="?menu=login">Masuk</a>
                            </li>';
                        } else {
                            echo '<li class="nav-item">
                                <a class="nav-link" href="?menu=draft">Draft</a>
                            </li>';
                            echo '<li class="nav-item">
                                <a class="nav-link" href="?menu=document">Dokumen</a>
                            </li>';
                            echo '<li class="nav-item">
                                <a class="nav-link" href="?menu=archive">Arsip</a>
                            </li>';
                            if ($_SESSION['session_user']->role_name == 'Direktur' || $_SESSION['session_user']->role_name == 'Ketua Divisi Ketenagakerjaan' || $_SESSION['session_user']->role_name == 'Anggota Divisi Ketenagakerjaan') {
                                echo '<li class="nav-item">
                                    <a class="nav-link" href="?menu=user">User</a>
                                </li>';
                                echo '<li class="nav-item">
                                    <a class="nav-link" href="?menu=role">Jabatan User</a>
                                </li>';
                            }
                            if ($_SESSION['session_user']->role_name == 'Direktur' || $_SESSION['session_user']->role_name == 'Ketua Divisi Sekretaris' || $_SESSION['session_user']->role_name == 'Anggota Divisi Sekretaris') {
                                echo '<li class="nav-item">
                                    <a class="nav-link" href="?menu=type">Tipe Dokumen</a>
                                </li>';
                            }
                        }
                        ?>
                    </ul>
                    <ul class="navbar-nav ms-auto mb-2 mb-md-0">
                        <?php
                        if ($_SESSION['my_session']) {
                            echo '<a class="navbar-text me-3 text-white">' . $_SESSION['session_user']->tbuser_nama . '</a>';
                            echo '<li class="nav-item">
                                <a class="nav-link" href="?menu=logout">Keluar</a>
                            </li>';
                        }
                        ?>
                    </ul>
                </div>
            </div>
        </nav>

        <main class="container">
            <?php
            $DocumentController = new DocumentController();
            $UserController = new UserController();
            $RoleController = new RoleController();
            $TypeController = new TypeController();
            $nav = filter_input(INPUT_GET, "menu");
            switch ($nav) {
                case 'archive' :
                    $DocumentController->indexArchive();
                    break;
                case 'document' :
                    $DocumentController->indexDocument();
                    break;
                case 'draft' :
                    $DocumentController->indexDraft();
                    break;
                case 'insert_document':
                    echo'<link href="css/form-validation.css" rel="stylesheet">';
                    $DocumentController->indexInsert();
                    break;
                case 'edit_document':
                    echo'<link href="css/form-validation.css" rel="stylesheet">';
                    $DocumentController->indexUpdate();
                    break;
                case 'user':
                    $UserController->indexUser();
                    break;
                case 'password':
                    echo'<link href="css/signin.css" rel="stylesheet">';
                    $UserController->indexChangePassword();
                    break;
                case 'insert_user':
                    echo'<link href="css/form-validation.css" rel="stylesheet">';
                    $UserController->indexInsert();
                    break;
                case 'edit_user':
                    echo'<link href="css/form-validation.css" rel="stylesheet">';
                    $UserController->indexUpdate();
                    break;
                case 'role':
                    $RoleController->indexRole();
                    break;
                case 'insert_role':
                    echo'<link href="css/form-validation.css" rel="stylesheet">';
                    $RoleController->indexInsert();
                    break;
                case 'edit_role':
                    echo'<link href="css/form-validation.css" rel="stylesheet">';
                    $RoleController->indexUpdate();
                    break;
                case 'type':
                    $TypeController->indexType();
                    break;
                case 'insert_type':
                    echo'<link href="css/form-validation.css" rel="stylesheet">';
                    $TypeController->indexInsert();
                    break;
                case 'edit_type':
                    echo'<link href="css/form-validation.css" rel="stylesheet">';
                    $TypeController->indexUpdate();
                    break;
                case 'logout':
                    $UserController->indexLogout();
                    break;
                default:
                    if ($_SESSION['my_session']) {
                        $DocumentController->indexDocument();
                        break;
                    } else {
                        echo'<link href="css/signin.css" rel="stylesheet">';
                        $UserController->indexLogin();
                        break;
                    }

            }
            ?>
        </main><!-- /.container -->

        <script src="js/controller.js"></script>
        <script src="js/form-validation.js"></script>
        <script src="assets/dist/js/bootstrap.bundle.min.js"></script>
        <script type="text/javascript" src="js/datatables.js"></script>
        <script type="text/javascript">
            $(document).ready(function () {
                $('#tableId').DataTable();
            });
        </script>

    </body>
</html>
