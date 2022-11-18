<div class="row ms-auto mb-3">
    <div class="col-md-4">
        <button type="button" class="btn btn-primary" onclick="insertType()">Tambah</button>
    </div>
</div>

<div class="bd-example">
    <table id="tableId" class="table table-striped">
        <thead>
        <tr>
            <th scope="col">Jenis Dokumen</th>
            <th scope="col">Keterangan</th>
            <th scope="col">Jumlah Dokumen</th>
            <th scope="col"></th>
        </tr>
        </thead>
        <tbody>
        <?php
        foreach ($result as $type) {
            ?>
            <tr>
                <td><?php echo $type->doc_jenis ?></td>
                <td>
                    <?php
                    if ($type->doc_status) {
                        echo 'Active';
                    } else {
                        echo 'Inactive';
                    } ?>
                </td>
                <td>
                    <?php
                    $jumlah = 0;
                    foreach ($result2 as $document) {
                        if ($type->doc_id == $document->tbdoc_jenis) {
                            $jumlah = $document->jumlah;
                            break;
                        }
                    }
                    echo $jumlah; ?>
                </td>
                <td class="col-3 text-end">
                    <?php
                    echo '<button type="button" class="btn btn-primary"  title="edit document type" aria-label="edit" onclick="editType(' . $type->doc_id . ')"><i class="bi bi-pencil-square"></i></button>';
                    echo '<button type="button" class="btn btn-primary ms-2" title="delete document type" aria-label="delete" onclick="deleteType(' . $type->doc_id . ',' . $jumlah . ')"><i class="bi bi-trash"></i></button>';
                    if ($type->doc_status) {
                        echo '<button type="button" class="btn btn-primary ms-2" title="lock document type" aria-label="unlock" onclick="unlockType(' . $type->doc_id . ')"><i class="bi bi-lock"></i></button>';
                    } else {
                        echo '<button type="button" class="btn btn-primary ms-2" title="unlock document type" aria-label="unlock" onclick="unlockType(' . $type->doc_id . ')"><i class="bi bi-unlock"></i></button>';
                    }
                    ?>
                </td>
            </tr>
        <?php } ?>
        </tbody>
    </table>
</div>