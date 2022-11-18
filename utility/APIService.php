<?php


class APIService {
    //document
    const ARCHIVE_DOC = "http://localhost/KP/ws/services/v1/document/archive_status.php";
    const COUNT_DOC_TYPE = "http://localhost/KP/ws/services/v1/document/count_document_type.php";
    const COUNT_DOC_USER = "http://localhost/KP/ws/services/v1/document/count_document_user.php";
    const DELETE_MASTER_DOC = "http://localhost/KP/ws/services/v1/document/delete_master.php";
    const DRAFT_DOC = "http://localhost/KP/ws/services/v1/document/draft_status.php";
    const FETCH_ACTIVE_MASTER_DOC = "http://localhost/KP/ws/services/v1/document/fetch_active_master.php";
    const FETCH_ARCHIVE = "http://localhost/KP/ws/services/v1/document/fetch_archive.php";
    const FETCH_DOC = "http://localhost/KP/ws/services/v1/document/fetch_document.php";
    const FETCH_DRAFT = "http://localhost/KP/ws/services/v1/document/fetch_draft.php";
    const FETCH_MASTER_DOC = "http://localhost/KP/ws/services/v1/document/fetch_master.php";
    const FETCH_MAX_ID = "http://localhost/KP/ws/services/v1/document/fetch_max_id.php";
    const FETCH_SPEC_DOC = "http://localhost/KP/ws/services/v1/document/fetch_specific_document.php";
    const FETCH_SPEC_MASTER_DOC = "http://localhost/KP/ws/services/v1/document/fetch_specific_master.php";
    const INSERT_DOC = "http://localhost/KP/ws/services/v1/document/insert_document.php";
    const INSERT_MASTER_DOC = "http://localhost/KP/ws/services/v1/document/insert_master.php";
    const SEARCH_ARCHIVE = "http://localhost/KP/ws/services/v1/document/search_archive.php";
    const SEARCH_DOC = "http://localhost/KP/ws/services/v1/document/search_document.php";
    const SEARCH_DRAFT = "http://localhost/KP/ws/services/v1/document/search_draft.php";
    const STATUS_MASTER_DOC = "http://localhost/KP/ws/services/v1/document/status_master.php";
    const UPDATE_DOC = "http://localhost/KP/ws/services/v1/document/update_document.php";
    const UPDATE_MASTER_DOC = "http://localhost/KP/ws/services/v1/document/update_master.php";

    //user
    const AUTHENTICATE = "http://localhost/KP/ws/services/v1/user/authenticate.php";
    const COUNT_USER_ROLE = "http://localhost/KP/ws/services/v1/user/count_user_role.php";
    const DELETE_MASTER_ROLE = "http://localhost/KP/ws/services/v1/user/delete_master.php";
    const DELETE_USER = "http://localhost/KP/ws/services/v1/user/delete_user.php";
    const FETCH_MASTER_ROLE = "http://localhost/KP/ws/services/v1/user/fetch_master.php";
    const FETCH_ACTIVE_MASTER_ROLE = "http://localhost/KP/ws/services/v1/user/fetch_active_master.php";
    const FETCH_SPEC_MASTER_ROLE = "http://localhost/KP/ws/services/v1/user/fetch_specific_master.php";
    const FETCH_USER = "http://localhost/KP/ws/services/v1/user/fetch_user.php";
    const FETCH_USER_BY_ID = "http://localhost/KP/ws/services/v1/user/fetch_user_by_id.php";
    const FETCH_USER_BY_NAME = "http://localhost/KP/ws/services/v1/user/fetch_user_by_name.php";
    const INSERT_MASTER_ROLE = "http://localhost/KP/ws/services/v1/user/insert_master.php";
    const INSERT_USER = "http://localhost/KP/ws/services/v1/user/insert_user.php";
    const RESET_PASSWORD = "http://localhost/KP/ws/services/v1/user/reset_password.php";
    const STAMP_LOGIN = "http://localhost/KP/ws/services/v1/user/stamp_login.php";
    const STAMP_LOGOUT = "http://localhost/KP/ws/services/v1/user/stamp_logout.php";
    const STATUS_MASTER_ROLE = "http://localhost/KP/ws/services/v1/user/status_master.php";
    const STATUS_USER = "http://localhost/KP/ws/services/v1/user/status_user.php";
    const UPDATE_MASTER_ROLE = "http://localhost/KP/ws/services/v1/user/update_master.php";
    const UPDATE_USER = "http://localhost/KP/ws/services/v1/user/update_user.php";

    //restriction
    const FETCH_RESTRICTION = "http://localhost/KP/ws/services/v1/restriction/fetch_restriction.php";
}