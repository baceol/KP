function insertDocument() {
    window.location = "?menu=insert_document&status=0";
}

function insertDraft() {
    window.location = "?menu=insert_document&status=1";
}

function downloadDocument(id) {
    window.location = "?menu=document&id=" + id + "&cmd=download";
}

function editDocument(id) {
    window.location = "?menu=edit_document&id=" + id;
}

function archiveDocument(id) {
    let confirmation = window.confirm("Apakah akan mengarsip dokumen ?");
    if (confirmation) {
        window.location = "?menu=document&id=" + id + "&cmd=archive";
    }
}

function undoArchive(id) {
    let confirmation = window.confirm("Apakah akan mengembalikan dokumen ?");
    if (confirmation) {
        window.location = "?menu=archive&id=" + id + "&cmd=undo";
    }
}

function publishDocument(id) {
    let confirmation = window.confirm("Apakah akan mempublikasi dokumen ?");
    if (confirmation) {
        window.location = "?menu=draft&id=" + id + "&cmd=publish";
    }
}

function undoDraft(id) {
    let confirmation = window.confirm("Apakah akan mengembalikan dokumen ?");
    if (confirmation) {
        window.location = "?menu=document&id=" + id + "&cmd=undo";
    }
}

function insertUser() {
    window.location = "?menu=insert_user";
}

function editUser(id) {
    window.location = "?menu=edit_user&id=" + id;
}

function deleteUser(id, jumlah) {
    window.location = "?menu=user&id=" + id + "&jumlah=" + jumlah + "&cmd=delete";
}

function unlockUser(id) {
    window.location = "?menu=user&id=" + id + "&cmd=unlock";
}

function resetUser(id) {
    window.location = "?menu=user&id=" + id + "&cmd=reset";
}

function insertRole() {
    window.location = "?menu=insert_role";
}

function editRole(id) {
    window.location = "?menu=edit_role&id=" + id;
}

function deleteRole(id, jumlah) {
    window.location = "?menu=role&id=" + id + "&jumlah=" + jumlah + "&cmd=delete";
}

function unlockRole(id) {
    window.location = "?menu=role&id=" + id + "&cmd=unlock";
}

function insertType() {
    window.location = "?menu=insert_type";
}

function editType(id) {
    window.location = "?menu=edit_type&id=" + id;
}

function deleteType(id, jumlah) {
    window.location = "?menu=type&id=" + id + "&jumlah=" + jumlah +  "&cmd=delete";
}

function unlockType(id) {
    window.location = "?menu=type&id=" + id + "&cmd=unlock";
}