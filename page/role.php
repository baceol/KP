<div class="row ms-auto mb-3">
    <div class="col-md-4">
        <button type="button" class="btn btn-primary" onclick="insertRole()">Tambah</button>
    </div>
</div>

<div class="bd-example">
    <table id="tableId" class="table table-striped">
        <thead>
        <tr>
            <th scope="col">Nama Jabatan</th>
            <th scope="col">Keterangan</th>
            <th scope="col">Jumlah User</th>
            <th scope="col"></th>
        </tr>
        </thead>
        <tbody>
            <?php
            foreach ($result as $role) {
                ?>
                <tr>
                    <td><?php echo $role->role_name ?></td>
                    <td>
                        <?php
                        if ($role->role_status) {
                            echo 'Active';
                        } else {
                            echo 'Inactive';
                        } ?>
                    </td>
                    <td>
                        <?php
                        $jumlah = 0;
                        foreach ($result2 as $user) {
                            if ($role->role_id == $user->tbuser_role) {
                                $jumlah = $user->jumlah;
                                break;
                            }
                        }
                        echo $jumlah; ?>
                    </td>
                    <td class="col-3 text-end">
                        <?php
                        echo '<button type="button" class="btn btn-primary"  title="edit role" aria-label="edit" onclick="editRole(' . $role->role_id . ')"><i class="bi bi-pencil-square"></i></button>';
                        echo '<button type="button" class="btn btn-primary ms-2" title="delete role" aria-label="delete" onclick="deleteRole(' . $role->role_id . ',' . $jumlah . ')"><i class="bi bi-trash"></i></button>';
                        if ($role->role_status) {
                            echo '<button type="button" class="btn btn-primary ms-2" title="lock role" aria-label="lock" onclick="unlockRole(' . $role->role_id . ')"><i class="bi bi-lock"></i></button>';
                        } else {
                            echo '<button type="button" class="btn btn-primary ms-2" title="unlock role" aria-label="unlock" onclick="unlockRole(' . $role->role_id . ')"><i class="bi bi-unlock"></i></button>';
                        }
                        ?>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>