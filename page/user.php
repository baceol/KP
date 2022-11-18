<div class="row ms-auto mb-3">
    <div class="col-md-4">
        <button type="button" class="btn btn-primary" onclick="insertUser()">Tambah User</button>
    </div>
</div>

<div class="bd-example">
    <table id="tableId" class="table table-striped">
        <thead>
        <tr>
            <th scope="col">Nama</th>
            <th scope="col">Role</th>
            <th scope="col">Jumlah Dokumen</th>
            <th scope="col"></th>
        </tr>
        </thead>
        <tbody>
        <?php
        foreach ($result as $user) {
            ?>
            <tr>
                <td><?php echo $user->tbuser_nama ?></td>
                <td><?php echo $user->role_name ?></td>
                <td>
                    <?php
                    $jumlah = 0;
                    foreach ($result2 as $document) {
                        if ($user->tbuser_id == $document->tbdoc_user_upload) {
                            $jumlah = $document->jumlah;
                            break;
                        }
                    }
                    echo $jumlah; ?>
                </td>
                <td class="col-3 text-end">
                    <?php
                    if (!$user->tbuser_status) {
                        echo '<button type="button" class="btn btn-primary" title="unlock user" aria-label="unlock" onclick="unlockUser(' . $user->tbuser_id . ')"><i class="bi bi-unlock"></i></button>';
                    }
                    echo '<button type="button" class="btn btn-primary ms-2" title="edit user" aria-label="edit" onclick="editUser(' . $user->tbuser_id . ')"><i class="bi bi-pencil-square"></i></button>';
                    echo '<button type="button" class="btn btn-primary ms-2" title="delete user" aria-label="delete" onclick="deleteUser(' . $user->tbuser_id . ',' . $jumlah . ')"><i class="bi bi-trash"></i></button>';
                    echo '<button type="button" class="btn btn-primary ms-2" title="reset user" aria-label="reset" onclick="resetUser(' . $user->tbuser_id . ')"><i class="bi bi-arrow-repeat"></i></button>';
                    ?>
                </td>
            </tr>
        <?php } ?>
        </tbody>
    </table>
</div>